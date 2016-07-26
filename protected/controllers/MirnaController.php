<?php

class MirnaController extends Controller
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
        'actions'=>array('index','view','admin', 'check'),
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
   * Creates a new model.
   * If creation is successful, the browser will be redirected to the 'view' page.
  public function actionCreate()
  {
    $model=new Mirna;

    // Uncomment the following line if AJAX validation is needed
    // $this->performAjaxValidation($model);

    if(isset($_POST['Mirna']))
    {
      $model->attributes=$_POST['Mirna'];
      if($model->save())
        $this->redirect(array('view','id'=>$model->id));
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

    if(isset($_POST['Mirna']))
    {
      $model->attributes=$_POST['Mirna'];
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
   */
  public function actionIndex()
  {
    $dataProvider=new CActiveDataProvider('Mirna');
    $this->render('index',array(
      'dataProvider'=>$dataProvider,
    ));
  }

  /**
   * Manages all models.
   */
  public function actionAdmin()
  {
    $model=new Mirna('search');
    $model->unsetAttributes();  // clear any default values
    if(isset($_GET['Mirna']))
      $model->attributes=$_GET['Mirna'];

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
    $model=Mirna::model()->findByPk($id);
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
    if(isset($_POST['ajax']) && $_POST['ajax']==='mirna-form')
    {
      echo CActiveForm::validate($model);
      Yii::app()->end();
    }
  }

  public function actionCheck()
  {
                function str2int($v) {
                    if ($v==="") return '';
                    return intval($v);
                }

    if(isset($_POST['Mirna']) and $_POST['Mirna']['content'] !== '')
    {
                    $ids = preg_split("/\s+/",$_POST['Mirna']['content']);
                    if (end($ids) == '') {array_pop($ids);}
                    $ids = '"' . join('","',$ids) . '"';
                    if ($_POST['Mirna']['type'] === 'mirna_id') {

                        $sql = "select m.id, accession,  mirna_id, description, name
                                from mirna m
                                left join species s on tax_id = s.id
                                where mirna_id in ($ids)
                                order by field(mirna_id, $ids)";
                                // and length(accession) = 12
                        $count = Yii::app()->db->createCommand("
                            SELECT COUNT(*) FROM ($sql) A
                          ")->queryScalar();

                    }elseif ($_POST['Mirna']['type'] === 'accession') {
                        $sql = "select m.id, accession,  mirna_id, description, name
                                from mirna m
                                left join species s on tax_id = s.id
                                where accession in ($ids)
                                group by accession
                                order by field(accession, $ids)";

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
}
