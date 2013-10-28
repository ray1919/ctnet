<?php

class TaskController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'userGroupsAccessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'admin' and 'index' and 'view' actions
				'actions'=>array('index','view','admin'),
				'pbac'=>array('read'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','CalendarEvents'),
				'pbac'=>array('write'),
			),
			array('allow', // allow admin user to perform 'delete' actions
				'actions'=>array('delete'),
				'pbac'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Task;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Task']))
		{
			$model->attributes=$_POST['Task'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Task']))
		{
			$model->attributes=$_POST['Task'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Task', array(
			'criteria'=>array(
                            'condition'=>'owner_id=:user_id OR requester_id=:user_id OR create_user_id=:user_id',
                            'params' => array(':user_id' => Yii::app()->user->id),
                            'order'=>'create_time DESC',
			),
                ));
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Task('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Task']))
			$model->attributes=$_GET['Task'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Task the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Task::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Task $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='task-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

        public function actionCalendarEvents()
        {
            $colors = array("aqua", "lime", "silver", "black", "maroon", "teal", "blue",
                "navy", "fuchsia", "olive", "yellow", "gray", "purple", "green", "red");
            $uid = Yii::app()->user->id;
            $burl = Yii::app()->request->baseUrl;
          $sql1 = "select name title, acceptance_date start, due_date end,
                    'silver' as color,
                    CONCAT('$burl/task/',id) as url
                    from task
                    where owner_id = $uid
                    and status = '完成'";
          $sql2 = "select name title, acceptance_date start, due_date end,
                    CASE create_time%11
                    WHEN 3 THEN 'black' 
                    WHEN 4 THEN 'maroon' 
                    WHEN 5 THEN 'teal' 
                    WHEN 6 THEN 'blue' 
                    WHEN 7 THEN 'navy' 
                    WHEN 8 THEN 'fuchsia' 
                    WHEN 9 THEN 'olive' 
                    WHEN 1 THEN 'purple' 
                    WHEN 2 THEN 'green' 
                    WHEN 0 THEN 'red'
                    END as color,
                    CONCAT('$burl/task/',id) as url
                    from task where owner_id = $uid
                    and status != '完成'";
          //$query = Yii::app()->db->createCommand($sql)->queryAll();
          $query1 = Yii::app()->db->createCommand($sql1)->queryAll();
          $query2 = Yii::app()->db->createCommand($sql2)->queryAll();
          $query = array_merge($query1,$query2);
          //var_dump($query);
          //exit;
          // color: '#' . strtoupper(dechex(rand(0,10000000)));
          /*
            $items[]=array(
                'title'=>'Meeting reminder',
                'start'=>'2013-09-02',
                'end'=>'2013-09-05',

                // can pass unix timestamp too
                // 'start'=>time()

                'color'=>'blue',
            );
            $items[]=array(
                'title'=>'Meeting',
                'start'=>'2013-09-3',
                'color'=>'#CC0000',
                'allDay'=>true,
                'url'=>'http://anyurl.com'
            );
            */
            echo CJSON::encode($query);
            Yii::app()->end();
        }

}
