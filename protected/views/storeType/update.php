<?php
/* @var $this StoreTypeController */
/* @var $model StoreType */

$this->breadcrumbs=array(
	'Store Types'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List StoreType', 'url'=>array('index')),
	array('label'=>'Create StoreType', 'url'=>array('create')),
	array('label'=>'View StoreType', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage StoreType', 'url'=>array('admin')),
);
?>

<h1>Update StoreType <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>