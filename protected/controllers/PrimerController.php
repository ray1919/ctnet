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
        'actions'=>array('index','view'),
        'pbac'=>array('read'),
      ),
      array('allow', // allow authenticated user to perform 'create' and 'update' actions
        'actions'=>array('create','update','admin','check'),
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
                $positionDataProvider=new CActiveDataProvider('Position', array(
                  'criteria'=>array(
                    'with'=>array(
                        'primerPositions' => array('alias' => 'pp')
                    ),
                    'condition'=>'pp.primer_id=:id',
                    'params'=>array(':id'=>$this->loadModel($id)->id),
                    'together'=>true,
                  ),
                  'pagination'=>array(
                    'pageSize'=>6,
                  ),
                ));

            /*  select primer_id,group_concat(ct) cts
                from PCR_experiment
                where gene_id = 22800
                group by primer_id;
                */
            $stats = Yii::app()->db->createCommand()
                    ->select('primer_id,group_concat(ct) cts,
                    concat_ws("",group_concat(tm1),group_concat(tm2)) tms')
                    ->from('PCR_experiment')
                    ->where('gene_id=:id', array(':id'=>$model->gene_fk))
                    ->group('primer_id')
                    ->queryAll();

    $this->render('view',array(
      'model'=>$model,
      'positionDataProvider'=>$positionDataProvider,
      'stats'=>$stats,
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
      function mir_sql_temp ($type, $key1, $key2, $ids) {
        return "
SELECT o.id, m.miRNA_id gene_id, m.accession gene_symbol, p.primer_id,
o.synthetic_name, l.name plate, o.well, q.name qc, o.name type,
CONCAT_WS(\"\",p.comment, o.comment) note
FROM mirna m
LEFT JOIN primer p ON p.mirna_fk = m.id
LEFT JOIN (SELECT p.*, s.name, pp.primer_id primer_fk
  FROM position p, store_type s, primer_position pp
  WHERE s.type = \"$type\" AND p.store_type_id = s.id
  AND pp.position_id = p.id) o
  ON p.id = o.primer_fk
LEFT JOIN plate l ON o.plate_id = l.id
LEFT JOIN qc q ON p.qc = q.id
WHERE $key1 in ($ids)
  OR $key2 in ($ids)
HAVING primer_id IS NOT NULL
ORDER BY field($key1, $ids)";
      }
      function gene_sql_temp ($type, $ids) {
return "
SELECT o.id, g.gene_id, g.gene_symbol, p.primer_id,
o.synthetic_name, l.name plate, o.well, q.name qc, o.name type,
CONCAT_WS(\"\",p.comment, o.comment) note
FROM gene g
LEFT JOIN primer p ON p.gene_fk = g.gene_id
LEFT JOIN (SELECT p.*, s.name, pp.primer_id primer_fk
  FROM position p, store_type s, primer_position pp
  WHERE s.type = \"$type\" AND p.store_type_id = s.id
  AND pp.position_id = p.id) o
  ON p.id = o.primer_fk
LEFT JOIN plate l ON o.plate_id = l.id
LEFT JOIN qc q ON p.qc = q.id
WHERE g.gene_id in ($ids)
HAVING primer_id IS NOT NULL
ORDER BY field(g.gene_id, $ids)";
      }
      if ($_POST['Primer']['type'] === 'gene id') {
        # 基因使用浓度
          $ids = array_map("str2int",preg_split("/\D+/",$_POST['Primer']['content']));
          $ids = array_filter($ids, "is_int");
          $ids = join(',',$ids);
          $sql = gene_sql_temp('使用浓度', $ids);
      }elseif ($_POST['Primer']['type'] === 'gene store') {
        # 基因存储浓度
          $ids = array_map("str2int",preg_split("/\D+/",$_POST['Primer']['content']));
          $ids = array_filter($ids, "is_int");
          $ids = join(',',$ids);
          $sql = gene_sql_temp('储液', $ids);
      }elseif ($_POST['Primer']['type'] === 'gene solid') {
        # 基因干粉浓度
          $ids = array_map("str2int",preg_split("/\D+/",$_POST['Primer']['content']));
          $ids = array_filter($ids, "is_int");
          $ids = join(',',$ids);
          $sql = gene_sql_temp('干粉', $ids);
      }elseif ($_POST['Primer']['type'] === 'miRNA acc') {
        # miRNA使用浓度, acc
          $ids = preg_split("/\s+/",$_POST['Primer']['content']);
          $ids = '"' . join('","',$ids) . '"';
          $sql = mir_sql_temp('使用浓度', 'm.accession', "p.primer_id", $ids);
      }elseif ($_POST['Primer']['type'] === 'miRNA acc store') {
        # miRNA存储浓度
          $ids = preg_split("/\s+/",$_POST['Primer']['content']);
          $ids = '"' . join('","',$ids) . '"';
          $sql = mir_sql_temp('储液', 'm.accession', "p.primer_id", $ids);
      }elseif ($_POST['Primer']['type'] === 'miRNA acc solid') {
        # miRNA干粉
          $ids = preg_split("/\s+/",$_POST['Primer']['content']);
          $ids = '"' . join('","',$ids) . '"';
          $sql = mir_sql_temp('干粉', 'm.accession', "p.primer_id", $ids);
      }elseif ($_POST['Primer']['type'] === 'miRNA id') {
        # miRNA使用浓度, id
          $ids = preg_split("/\s+/",$_POST['Primer']['content']);
          $ids = '"' . join('","',$ids) . '"';
          $sql = mir_sql_temp('使用浓度', 'm.miRNA_id', "p.gene_symbol", $ids);
      }elseif ($_POST['Primer']['type'] === 'miRNA id store') {
        # miRNA存储浓度
          $ids = preg_split("/\s+/",$_POST['Primer']['content']);
          $ids = '"' . join('","',$ids) . '"';
          $sql = mir_sql_temp('储液', 'm.miRNA_id', "p.gene_symbol", $ids);
      }elseif ($_POST['Primer']['type'] === 'miRNA id solid') {
        # miRNA干粉
          $ids = preg_split("/\s+/",$_POST['Primer']['content']);
          $ids = '"' . join('","',$ids) . '"';
          $sql = mir_sql_temp('干粉', 'm.miRNA_id', "p.gene_symbol", $ids);
      }
      $count = Yii::app()->db->createCommand("
                  SELECT COUNT(*) FROM ($sql) A
                ")->queryScalar();
      $sql = Yii::app()->db->createCommand("$sql");
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
