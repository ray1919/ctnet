<?php
/* @var $this StoreTypeController */
/* @var $model StoreType */

$this->breadcrumbs=array(
	'Store Types'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List StoreType', 'url'=>array('index')),
	array('label'=>'Create StoreType', 'url'=>array('create')),
	array('label'=>'Update StoreType', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete StoreType', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage StoreType', 'url'=>array('admin')),
);
?>

<h1>View StoreType #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'description',
	),
)); ?>
