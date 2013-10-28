<?php

class PCRExperimentController extends Controller
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
				'actions'=>array('create','update'),
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
            $model = $this->loadModel($id);
            /*  select primer_id,group_concat(ct) cts
                from PCR_experiment
                where gene_id = 22800
                group by primer_id;
                */
                $stats = Yii::app()->db->createCommand()
                    ->select('primer_id,group_concat(ct) cts,group_concat(tm1) tm1s')
                    ->from('PCR_experiment')
                    ->where('gene_id=:id', array(':id'=>$model->gene_id))
                    ->group('primer_id')
                    ->queryAll();
		$this->render('view',array(
			'model'=>$model,
                        'stats'=>$stats,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new PCRExperiment;
		if(isset($_GET['service_id']))
                        $model->service_id = $_GET['service_id'];
		else
			throw new CHttpException(403,'Must specify a customer before performing this action.');

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['PCRExperiment']))
		{
			$model->attributes=$_POST['PCRExperiment'];
                        $model->tmfile=CUploadedFile::getInstance($model,'tmfile');
                        $model->ctfile=CUploadedFile::getInstance($model,'ctfile');
			if($model->validate()){
                                $model->tmfile->saveAs('/tmp/tmfile');
                                $model->ctfile->saveAs('/tmp/ctfile');
                                $ctfile=fopen("/tmp/ctfile","r");
                                $tmfile=fopen("/tmp/tmfile","r");
                                $array_name = null;
                                $i = -1;
                                //for ($i = 0; $i < 98; $i++) {
                                  //$ctline=fgets($ctfile);
                                while($ctline=fgets($ctfile)) {
                                  $i++;
                                  $tmline=fgets($tmfile);
                                  $ctcells = preg_split("/\t/", $ctline);
                                  $tmcells = preg_split("/\t/", $tmline);
                                  if ($i == 0 && preg_match('/^Experiment: (.*) Selected Filter: /', $ctcells[0],$matches)) {
                                      $array_name = $matches[1];
                                      continue;
                                  }
                                  if ($i == 1) continue;
                                  if ($ctcells[3] !== '') { // valid sample id
                                      $expmodel[$i-2] = new PCRExperiment;
                                      $expmodel[$i-2]->service_id = $model->service_id;
                                      $expmodel[$i-2]->plate_type = $model->plate_type;
                                      $expmodel[$i-2]->array_name = $array_name;
                                      $expmodel[$i-2]->gene_id = $ctcells[0];
                                      $expmodel[$i-2]->primer_id = $ctcells[1];
                                      if ($ctcells[1] !== '') { // valid primer id
                                          $primer_fk = Yii::app()->db->createCommand()
                                            ->select('id')
                                            ->from('primer')
                                            ->where('primer_id=:id', array(':id'=>$ctcells[1]))
                                            ->order('id desc')
                                            ->queryRow();
                                          $expmodel[$i-2]->primer_fk = $primer_fk['id'];
                                      }
                                      $expmodel[$i-2]->ct = $ctcells[4];
                                      // suppose poss were always sorted
                                      $expmodel[$i-2]->pos = $ctcells[2];
                                      $ctcells[7] = isset($ctcells[7]) ? $ctcells[7] : '';
                                      $expmodel[$i-2]->status = $ctcells[7];
                                      $expmodel[$i-2]->sample_id = $ctcells[3];
                                      $expmodel[$i-2]->tm1 = $tmcells[4];
                                      $expmodel[$i-2]->tm2 = $tmcells[5];
                                      $expmodel[$i-2]->save();
                                  }
                                }
                                fclose($ctfile);
				$this->redirect(array('pCRService/view','id'=>$model->service_id));
                        }
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

        /**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['PCRExperiment']))
		{
			$model->attributes=$_POST['PCRExperiment'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}
	 */

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}
	 */

	/**
	 * Lists all models.
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('PCRExperiment');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}
	 */

	/**
	 * Manages all models.
	public function actionAdmin()
	{
		$model=new PCRExperiment('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['PCRExperiment']))
			$model->attributes=$_GET['PCRExperiment'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}
	 */

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=PCRExperiment::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='pcrexperiment-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
