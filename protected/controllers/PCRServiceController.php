<?php

class PCRServiceController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';
	private $_customer = null; 
        public $customer_title = "";

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'userGroupsAccessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
                        'customerContext + create', //check to ensure valid customer context // index admin
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
		$sampleDataProvider=new CActiveDataProvider('PCRSample', array(
			'criteria'=>array(
				'condition'=>'service_id=:serviceId',
				'params'=>array(':serviceId'=>$id),
			),
			'pagination'=>array(
				'pageSize'=>1,
			),
		));
		//$expDataProvider=new CActiveDataProvider('PCRExperiment', array(
		//	'criteria'=>array(
		//		'condition'=>'service_id=:serviceId',
		//		'params'=>array(':serviceId'=>$id),
		//	),
		//	'pagination'=>array(
		//		'pageSize'=>96,
		//	),
		//));
                /*  get gene symbol array
                 *  select name,
                    concat("'",group_concat(IFNULL(gene_symbol, 'Unknow') order by e.id separator "', '"),"'") gs,
                    concat("'",group_concat(IFNULL(ct, '') order by e.id separator "', '"),"'") ct
                    from PCR_experiment e left join gene g
                    on e.gene_id = g.gene_id
                    left join PCR_sample s
                    on e.sample_id = s.id
                    where service_id = $id
                    group by sample_id
                 */
                $ctdata = Yii::app()->db->createCommand()
                            ->select('name,
                            group_concat(IFNULL(gene_symbol, "Unknow") order by e.id separator ",") gs,
                            group_concat(IFNULL(ct, "") order by e.id separator ",") ct')
                            ->from('PCR_experiment e')
                            ->leftJoin('gene g','e.gene_id = g.gene_id')
                            ->leftJoin('PCR_sample s','e.sample_id = s.id')
                            ->where("e.service_id = $id")
                            ->group('sample_id')
                            ->queryAll();
                //print_r($ctdata);
                //exit;

		$expmodel=new PCRExperiment('search');
		$expmodel->unsetAttributes();  // clear any default values
		if(isset($_GET['PCRExperiment']))
			$expmodel->attributes=$_GET['PCRExperiment'];

                $this->render('view',array(
			'model'=>$this->loadModel($id),
                        'sampleDataProvider'=>$sampleDataProvider,
                        //'expDataProvider'=>$expDataProvider,
                        'expmodel'=>$expmodel,
                        'ctdata'=>$ctdata,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new PCRService;
                $model->customer_id = $this->_customer->id;
                $this->customer_title = $this->_customer->title;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['PCRService']))
		{
			$model->attributes=$_POST['PCRService'];
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

		if(isset($_POST['PCRService']))
		{
			$model->attributes=$_POST['PCRService'];
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
		$dataProvider=new CActiveDataProvider('PCRService', array(
			'criteria'=>array(
                                'order'=>'date DESC',
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
		$model=new PCRService('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['PCRService']))
			$model->attributes=$_GET['PCRService'];

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
		$model=PCRService::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='pcrservice-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
        
	protected function loadCustomer($customerId)	 
	{
		//if the project property is null, create it based on input id
		if($this->_customer===null)
		{
			$this->_customer= Customer::model()->findByPk($customerId);
			if($this->_customer===null)
	        {
				throw new CHttpException(404,'The requested project does not exist.'); 
			}
		}

		return $this->_customer; 
	} 
	
	/**
	 * In-class defined filter method, configured for use in the above filters() method
	 * It is called before the actionCreate() action method is run in order to ensure a proper project context
	 */
	public function filterCustomerContext($filterChain)
	{   
		//set the project identifier based on either the GET input 
	    //request variables   
		if(isset($_GET['customer_id']))
			$this->loadCustomer($_GET['customer_id']);   
		else
			throw new CHttpException(403,'Must specify a customer before performing this action.');
			
		//complete the running of other filters and execute the requested action
		$filterChain->run(); 
	}
        
	protected function loadPCRExperiment()	 
	{
		$model=new PCRExperiment('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['PCRExperiment']))
			$model->attributes=$_GET['PCRExperiment'];
		return $model;
	} 
	
}
