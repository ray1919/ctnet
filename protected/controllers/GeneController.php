<?php

class GeneController extends Controller
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
				'actions'=>array('index','view','admin','check'),
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
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}
	/**
	 * Check gene.
         * find gene id or symbol info using gene id or symbol
	 */
	public function actionCheck()
	{
                //$model=$this->loadModel($id);
                function str2int($v) {
                    if ($v==="") return '';
                    return intval($v);
                }

		if(isset($_POST['Primer']) and $_POST['Primer']['content'] !== '')
		{
                    if ($_POST['Primer']['type'] === 'gene id') {
                        $ids = array_map("str2int",preg_split("/\D+/",$_POST['Primer']['content']));
                        $ids = array_filter($ids, "is_int");
                        $ids = join(',',$ids);

                        $count = Yii::app()->db->createCommand()
                                ->select('count(*)')
                                ->from('gene g')
                                ->leftJoin('primer p','p.gene_fk = g.gene_id')
                                ->leftJoin('position o','p.id = o.primer_id')
                                ->leftJoin('plate l','o.plate_id = l.id')
                                ->leftJoin('store_type s','o.store_type_id = s.id')
                                ->where("g.gene_id in ($ids)")
                                ->queryScalar();

                        $sql = Yii::app()->db->createCommand()
                                ->select('o.id, g.gene_id, g.gene_symbol, p.primer_id,
                                    barcode, l.name plate, o.well, p.qc, s.name type,
                                    CONCAT_WS("",p.comment, o.comment) note')
                                ->from('gene g')
                                ->leftJoin('primer p','p.gene_fk = g.gene_id')
                                ->leftJoin('position o','p.id = o.primer_id')
                                ->leftJoin('plate l','o.plate_id = l.id')
                                ->leftJoin('store_type s','o.store_type_id = s.id')
                                ->where("g.gene_id in ($ids)");
                    }else{
                        $ids = preg_split("/\s+/",$_POST['Primer']['content']);
                        $ids = '"' . join('","',$ids) . '"';
                        
                        $count = Yii::app()->db->createCommand()
                                ->select('count(*)')
                                ->from('mirna m')
                                ->leftJoin('primer p','p.gene_symbol = m.miRNA_id')
                                ->leftJoin('position o','p.id = o.primer_id')
                                ->leftJoin('plate l','o.plate_id = l.id')
                                ->leftJoin('store_type s','o.store_type_id = s.id')
                                ->where("m.miRNA_id in ($ids)")
                                ->queryScalar();

                        $sql = Yii::app()->db->createCommand()
                                ->select('o.id, m.miRNA_id gene_id, p.primer_id,
                                    barcode, l.name plate, o.well, p.qc, s.name type,
                                    CONCAT_WS("",p.comment, o.comment) note')
                                ->from('mirna m')
                                ->leftJoin('primer p','p.gene_symbol = m.miRNA_id')
                                ->leftJoin('position o','p.id = o.primer_id')
                                ->leftJoin('plate l','o.plate_id = l.id')
                                ->leftJoin('store_type s','o.store_type_id = s.id')
                                ->where("m.miRNA_id in ($ids)");
                        
                    }
                    $dataProvider=new CSqlDataProvider($sql, array(
                        'totalItemCount'=>$count,
                        'pagination'=>array(
                            'pageSize'=>$count,
                        ),
                    ));
                    
                    $this->render('check',array(
                        'dataProvider'=>$dataProvider,
                    ));
		
                }else{
                    $this->render('check');
                }
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	public function actionCreate()
	{
		$model=new Gene;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Gene']))
		{
			$model->attributes=$_POST['Gene'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->gene_id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}
	 */

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Gene']))
		{
			$model->attributes=$_POST['Gene'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->gene_id));
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
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Gene');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Gene('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Gene']))
			$model->attributes=$_GET['Gene'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Gene::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='gene-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
