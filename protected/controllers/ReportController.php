<?php

class ReportController extends Controller
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
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view','admin','upload'),
				'pbac'=>array('read'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'pbac'=>array('write'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
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
		$model=new Report;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Report']))
		{
			$model->attributes=$_POST['Report'];
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

		if(isset($_POST['Report']))
		{
			$model->attributes=$_POST['Report'];
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
    $dataProvider=new CActiveDataProvider('Report', array (
      'criteria'=>array( 'order'=>'date DESC',)));
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Report('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Report']))
			$model->attributes=$_GET['Report'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

  public function actionUpload($report_id)
  {
    // $report_id = $_GET['report_id'];
        /* @var $cs CClientScript */
        $cs = Yii::app()->clientScript;
        $cs->registerScript('rid',"var report_id = $report_id;",CClientScript::POS_HEAD);
        $cs->registerScriptFile( Yii::app()->getBaseUrl() . '/scripts/fileupload/jquery.min.js' );
        $cs->registerScriptFile( Yii::app()->getBaseUrl() . '/scripts/fileupload/jquery-ui.min.js' );
        $cs->registerScriptFile( Yii::app()->getBaseUrl() . '/scripts/fileupload/tmpl.min.js' );
        $cs->registerScriptFile( Yii::app()->getBaseUrl() . '/scripts/fileupload/load-image.all.min.js' );
        $cs->registerScriptFile( Yii::app()->getBaseUrl() . '/scripts/fileupload/canvas-to-blob.min.js' );
        $cs->registerScriptFile( Yii::app()->getBaseUrl() . '/scripts/fileupload/jquery.blueimp-gallery.min.js' );
        $cs->registerScriptFile( Yii::app()->getBaseUrl() . '/scripts/fileupload/jquery.iframe-transport.js' );
        $cs->registerScriptFile( Yii::app()->getBaseUrl() . '/scripts/fileupload/jquery.fileupload.js' );
        $cs->registerScriptFile( Yii::app()->getBaseUrl() . '/scripts/fileupload/jquery.fileupload-process.js' );
        $cs->registerScriptFile( Yii::app()->getBaseUrl() . '/scripts/fileupload/jquery.fileupload-image.js' );
        $cs->registerScriptFile( Yii::app()->getBaseUrl() . '/scripts/fileupload/jquery.fileupload-audio.js' );
        $cs->registerScriptFile( Yii::app()->getBaseUrl() . '/scripts/fileupload/jquery.fileupload-video.js' );
        $cs->registerScriptFile( Yii::app()->getBaseUrl() . '/scripts/fileupload/jquery.fileupload-validate.js' );
        $cs->registerScriptFile( Yii::app()->getBaseUrl() . '/scripts/fileupload/jquery.fileupload-ui.js' );
        $cs->registerScriptFile( Yii::app()->getBaseUrl() . '/scripts/fileupload/jquery.fileupload-jquery-ui.js' );
        $cs->registerScriptFile( Yii::app()->getBaseUrl() . '/scripts/fileupload/main.js' );
        $cs->registerCssFile( Yii::app()->getBaseUrl() . '/css/fileupload/blueimp-gallery.min.css');
        $cs->registerCssFile( Yii::app()->getBaseUrl() . '/css/fileupload/jquery-ui.css');
        $cs->registerCssFile( Yii::app()->getBaseUrl() . '/css/fileupload/demo.css');
        $cs->registerCssFile( Yii::app()->getBaseUrl() . '/css/fileupload/jquery.fileupload.css');
        $cs->registerCssFile( Yii::app()->getBaseUrl() . '/css/fileupload/jquery.fileupload-ui.css');

    $this->render('upload',array(
      'model'=>$this->loadModel($report_id),
    ));
  }

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Report the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Report::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Report $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='report-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
