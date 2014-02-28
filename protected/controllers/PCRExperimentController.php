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
            if(isset($_GET['service_id'])) {
                $model->service_id = $_GET['service_id'];
            } else {
                throw new CHttpException(403,'Must specify a customer before performing this action.');
            }
            // Uncomment the following line if AJAX validation is needed
            // $this->performAjaxValidation($model);

            if(isset($_POST['PCRExperiment']))
            {
                $model->attributes=$_POST['PCRExperiment'];
                $model->tmfile=CUploadedFile::getInstance($model,'tmfile');
                $model->tm2file=CUploadedFile::getInstance($model,'tm2file');
                $model->ctfile=CUploadedFile::getInstance($model,'ctfile');
                if($model->validate()){
                    $model->tmfile->saveAs('/tmp/tmfile');
                    $model->ctfile->saveAs('/tmp/ctfile');
                    if ($model->tm2file) {
                      $model->tm2file->saveAs('/tmp/tm2file');
                      $tm2file=fopen("/tmp/tm2file","r");
                    }
                    $ctfile=fopen("/tmp/ctfile","r");
                    $tmfile=fopen("/tmp/tmfile","r");
                    $array_name = null;
                    $i = -1;
                    
                    // Total processes for process bar
                    $total = intval(exec("wc -l /tmp/ctfile"));
                    ob_start();
                    echo '<div id="progress" style="width:500px;border:1px solid #ccc;"></div>
                        <div id="information" style="width"></div>';
                    
                    while($ctline=fgets($ctfile)) {
                        $i++;
                        $tmline=fgets($tmfile);
                        $ctline = rtrim($ctline,"\r\n");
                        $tmline = rtrim($tmline,"\r\n");
                        $ctcells = preg_split("/\t/", $ctline);
                        $tmcells = preg_split("/\t/", $tmline);
                        
                        if ($model->file_type === 'roche') {
                            # Roche format
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
                        elseif ($model->file_type === 'exptxt') {
                            # Expression profile format
                            $tm2line=fgets($tm2file);
                            $tm2line = rtrim($tm2line,"\r\n");
                            $tm2cells = preg_split("/\t/", $tm2line);
                            if ($i == 0) {
                                array_splice($ctcells,0,3);
                                $sample_ids = $ctcells;
                                continue;
                            }
                            if ($ctcells[2] !== '') { // valid well
                                $primer_id = $ctcells[1];
                                if ( $primer_id === '' ) {
                                    $primer_id = Yii::app()->db->createCommand()
                                      ->select('primer_id')
                                      ->from('primer')
                                      ->where('gene_fk=:gk', array(':gk'=>$ctcells[0]))
                                      ->order('id asc')
                                      ->queryRow();                                    
                                    $primer_id = $primer_id["primer_id"];
                                }
                                if ($primer_id !== '') { // valid primer id
                                    $primer_fk = Yii::app()->db->createCommand()
                                      ->select('id')
                                      ->from('primer')
                                      ->where('primer_id=:id', array(':id'=>$primer_id))
                                      ->andwhere('gene_fk=:gk', array(':gk'=>$ctcells[0]))
                                      ->queryRow();
                                }
                                foreach ($sample_ids as $idx=>$sample_id) {
                                    $expmodel = new PCRExperiment;
                                    $expmodel->service_id = $model->service_id;
                                    $expmodel->plate_type = $model->plate_type;
                                    $expmodel->array_name = $array_name;
                                    $expmodel->gene_id = $ctcells[0];
                                    $expmodel->primer_id = $primer_id;
                                    $expmodel->ct = $ctcells[$idx+3];
                                    $expmodel->primer_fk = $primer_fk['id'];
                                    // suppose poss were always sorted
                                    $expmodel->pos = $ctcells[2];
                                    $expmodel->status = '';
                                    $expmodel->sample_id = $sample_id;
                                    $expmodel->tm1 = $tmcells[$idx+3];
                                    if ( isset($tm2file) ) {
                                      $expmodel->tm2 = $tm2cells[$idx+3];
                                    } else {
                                      $expmodel->tm2 = NULL;
                                    }
                                    $expmodel->save();
                                }
                            }
                        }
                                    
                        // Calculate the percentation
                        $percent = intval($i/$total * 100)."%";

                        // Javascript for updating the progress bar and information
                        echo '<script language="javascript">
                        document.getElementById("progress").innerHTML="<div style=\"width:'.$percent.';background-color:#ddd;\">&nbsp;</div>";
                        document.getElementById("information").innerHTML="'.$i.' rows processed. Please wait ...";
                        </script>';

                        // This is for the buffer achieve the minimum size in order to flush data
                        echo str_repeat(' ', ini_get('output_buffering'));
                        ob_flush();
                        // Send output to browser immediately
                        flush();                        
                    }

                    fclose($tmfile);
                    fclose($ctfile);
                    //$this->redirect(array('pCRService/view','id'=>$model->service_id));
                    $this->js_redirect(Yii::app()->baseUrl.'/pCRService/view/'
                        .$model->service_id);
                }
            }

            $this->render('create',array(
                    'model'=>$model,
            ));
	}

        private function js_redirect($url)
        {
            $string = '<script type="text/javascript">';
            $string .= 'window.location = "' . $url . '"';
            $string .= '</script>';

            echo $string;
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
