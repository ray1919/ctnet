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

		if(isset($_POST['Gene']) and $_POST['Gene']['content'] !== '')
		{
                    if ($_POST['Gene']['type'] === 'gene_id') {
                        $ids = array_map("str2int",preg_split("/\D+/",$_POST['Gene']['content']));
                        $ids = array_filter($ids, "is_int");
                        $ids = join(',',$ids);

                        $sql = "select gene_id id,gene_symbol,gene_id,gene_name,
                                s.name tax_name,synonyms,type_of_gene from gene
                                left join species s on tax_id = s.id
                                where gene_id in ($ids)
                                order by field(gene_id, $ids)";
                        $count = Yii::app()->db->createCommand("
                            SELECT COUNT(*) FROM ($sql) A
                          ")->queryScalar();
                        
                    }elseif ($_POST['Gene']['type'] === 'gene_symbol') {
                        $ids = preg_split("/\s+/",$_POST['Gene']['content']);
                        if (end($ids) == '') {array_pop($ids);}
                        $symbols = '"' . join('","',$ids) . '"';
                        $tax_id = $_POST['Gene']['tax_id'];
                        $inss = '("' . join("\",$tax_id),(\"",$ids) . "\",$tax_id)";
                        /*
                        foreach ($ids as $id) {
                             $sqls[] = "(select gene_id id,gene_symbol,gene_id,gene_name,
                                s.name tax_name,synonyms,type_of_gene from gene
                                left join species s on tax_id = s.id
                                where tax_id = $tax_id
                                and gene_symbol = '$id'
                                or synonyms regexp '^$id\\\\||\\\\|$id$|^$id$'))"; 
                        }
                        $sql = join(" union ", $sqls);
                        */
                        Yii::app()->db->createCommand("insert IGNORE into tmp_varchar20"
                            . " values $inss")->execute();
                        $sql = "select gene_id id,gene_symbol,gene_id,gene_name,
                                s.name tax_name,synonyms,type_of_gene
                                from tmp_varchar20
                                left join gene on (gene_symbol = string and `int` = tax_id)
                                left join species s on tax_id = s.id
                                where `int` = $tax_id
                                and string in ($symbols)
                                order by field(string, $symbols)";

                        $count = Yii::app()->db->createCommand("
                            SELECT COUNT(*) FROM ($sql) A
                          ")->queryScalar();
                        
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

        public function getSpecies()
        {
            $getStoreType = CHtml::listData(Species::model()->findAll(), 'id', 'name');
            return $getStoreType;
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
