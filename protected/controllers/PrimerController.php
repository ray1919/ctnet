<?php

class PrimerController extends Controller
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
				'actions'=>array('create','update','check'),
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
                $positionDataProvider=new CActiveDataProvider('Position', array(
                  'criteria'=>array(
                    'condition'=>'primer_id=:id',
                    'params'=>array(':id'=>$this->loadModel($id)->id),
                  ),
                  'pagination'=>array(
                    'pageSize'=>5,
                  ),
                ));
		$this->render('view',array(
			'model'=>$this->loadModel($id),
      'positionDataProvider'=>$positionDataProvider,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Primer;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Primer']))
		{
			$model->attributes=$_POST['Primer'];
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

		if(isset($_POST['Primer']))
		{
			$model->attributes=$_POST['Primer'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Check primer.
         * find primer info using gene id or miRNA id
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
                    /*
                     * gene
                    'select o.id, g.gene_id, p.primer_id, barcode, g.gene_symbol,
                    l.name plate, o.well, s.name type, CONCAT_WS("",p.comment, o.comment) note
                    from plate l, store_type s, primer p
                    left join gene g on g.gene_id = p.gene_fk
                    right join position o on p.id = o.primer_id
                    where p.gene_fk in (1032, 103, 93, 207)
                    and o.plate_id = l.id
                    and o.store_type_id = s.id';
                     * gene null
                    select o.id, g.gene_id, g.gene_symbol, p.primer_id,
                    barcode, l.name plate, o.well, p.qc, s.name type,
                    CONCAT_WS("",p.comment, o.comment) note
                    from gene g
                    left join primer p on p.gene_fk = g.gene_id
                    left join position o on p.id = o.primer_id
                    left join plate l on o.plate_id = l.id
                    left join store_type s on o.store_type_id = s.id
                    where g.gene_id in (10000,93,1)
                    group by g.gene_id, g.gene_symbol, p.primer_id
                    
                     * miRNA
                    select o.id, p.gene_symbol miRNA_id, p.primer_id, barcode,
                    l.name plate, o.well, s.name type, CONCAT_WS("",p.comment, o.comment) note
                    from plate l, store_type s, primer p
                    right join position o on p.id = o.primer_id
                    where p.gene_symbol in ('hsa-miR-214', 'hsa-miR-27a')
                    and o.plate_id = l.id
                    and o.store_type_id = s.id
                    
                    select o.id, m.miRNA_id gene_id, p.primer_id,
                    barcode, l.name plate, o.well, p.qc, s.name type,
                    CONCAT_WS("",p.comment, o.comment) note
                    from mirna m
                    left join primer p on p.gene_symbol = m.miRNA_id
                    left join position o on p.id = o.primer_id
                    left join plate l on o.plate_id = l.id
                    left join store_type s on o.store_type_id = s.id
                    where m.miRNA_id in ('hsa-miR-214', 'hsa-miR-27a', 'hsa-miR-17')
                    */
                    if ($_POST['Primer']['type'] === 'gene id') {
                        $ids = array_map("str2int",preg_split("/\D+/",$_POST['Primer']['content']));
                        $ids = array_filter($ids, "is_int");
                        $ids = join(',',$ids);
                        /*
                        $count = Yii::app()->db->createCommand()
                                ->select('count(*)')
                                ->from('plate l, store_type s, primer p')
                                ->leftJoin('gene g','g.gene_id = p.gene_fk')
                                ->rightJoin('position o','p.id = o.primer_id')
                                ->andWhere("p.gene_fk in ($ids)")
                                ->andWhere('o.plate_id = l.id')
                                ->andWhere('o.store_type_id = s.id')
                                ->queryScalar();

                        $sql = Yii::app()->db->createCommand()
                                ->select('o.id, g.gene_id, g.gene_symbol, p.primer_id,
                                    barcode, l.name plate, o.well, p.qc, s.name type,
                                    CONCAT_WS("",p.comment, o.comment) note')
                                ->from('plate l, store_type s, primer p')
                                ->leftJoin('gene g','g.gene_id = p.gene_fk')
                                ->rightJoin('position o','p.id = o.primer_id')
                                ->andWhere("p.gene_fk in ($ids)")
                                ->andWhere('o.plate_id = l.id')
                                ->andWhere('o.store_type_id = s.id');

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
                         */
                        $sql = "select o.id, g.gene_id, g.gene_symbol, p.primer_id,
                            barcode, l.name plate, o.well, q.name qc, s.name type,
                            CONCAT_WS(\"\",p.comment, o.comment) note
                            from gene g
                            left join primer p on p.gene_fk = g.gene_id
                            left join (select * from position
			    order by store_type_id desc, id desc) o on p.id = o.primer_id
                            left join plate l on o.plate_id = l.id
                            left join store_type s on o.store_type_id = s.id
                            left join qc q on p.qc = q.id
                            where g.gene_id in ($ids)
                            group by g.gene_id, g.gene_symbol, p.primer_id
                            order by field(g.gene_id, $ids)";
                        $count = Yii::app()->db->createCommand("
                            SELECT COUNT(*) FROM ($sql) A
                          ")->queryScalar();

                        $sql = Yii::app()->db->createCommand("$sql");
                    }elseif ($_POST['Primer']['type'] === 'miRNA acc') {
                        $ids = preg_split("/\s+/",$_POST['Primer']['content']);
                        $ids = '"' . join('","',$ids) . '"';
                        $sql = "select o.id, m.miRNA_id gene_id, p.primer_id,
                                barcode, l.name plate, o.well, q.name qc, s.name type,
                                CONCAT_WS(\"\",p.comment, o.comment) note
                                from mirna m
                                left join primer p on p.mirna_fk = m.id
                                left join position o on p.id = o.primer_id
                                left join plate l on o.plate_id = l.id
                                left join store_type s on o.store_type_id = s.id
                                left join qc q on p.qc = q.id
                                where m.accession in ($ids)
                                group by m.miRNA_id, p.primer_id
                                order by field(m.accession, $ids)";
                        $count = Yii::app()->db->createCommand("
                            SELECT COUNT(*) FROM ($sql) A
                          ")->queryScalar();
                    }else{
                        $ids = preg_split("/\s+/",$_POST['Primer']['content']);
                        $ids = '"' . join('","',$ids) . '"';
                        $sql = "select o.id, m.miRNA_id gene_id, p.primer_id,
                                barcode, l.name plate, o.well, q.name qc, s.name type,
                                CONCAT_WS(\"\",p.comment, o.comment) note
                                from mirna m
                                left join primer p on p.mirna_fk = m.id
                                left join position o on p.id = o.primer_id
                                left join plate l on o.plate_id = l.id
                                left join store_type s on o.store_type_id = s.id
                                left join qc q on p.qc = q.id
                                where m.miRNA_id in ($ids)
                                or p.gene_symbol in ($ids)
                                group by m.miRNA_id, p.primer_id
                                order by field(m.miRNA_id, $ids)";
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
		$dataProvider=new CActiveDataProvider('Primer');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Primer('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Primer']))
			$model->attributes=$_GET['Primer'];

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
		$model=Primer::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='primer-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

}
