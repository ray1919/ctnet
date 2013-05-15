<?php
/* @var $this VisitController */
/* @var $model Visit */

$this->breadcrumbs=array(
        "Contact"=>array('index'),
        $model->customer->title=>array("customer/view", 'id'=>$model->customer->id),
        'Communication'=>array('index'),
        $model->id,
);

$this->menu=array(
  array('label'=>'List Communication', 'url'=>array('index')),
  array('label'=>'Update Communication', 'url'=>array('update', 'id'=>$model->id)),
  array('label'=>'Delete Communication', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
  array('label'=>'Manage Communication', 'url'=>array('admin')),
);
?>

<h1>View Communication #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
  'data'=>$model,
  'attributes'=>array(
    /*'id',*/
    array(
      "label"=>'Customer',
      "value"=>$model->customer->title,
    ),
    'executor',
    'status',
    'way',
    'class',
    'time',
    array(
      "name"=>'comment',
      "value"=>"<pre>".$model->comment."</pre>",
      'type'=>'raw',
    ),
    'scheduled',
    'create_time',
    array(
      "label"=>'Create User',
      "value"=>$model->createUser->username,
    ),
  ),
)); ?>
