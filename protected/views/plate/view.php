<?php
/* @var $this PlateController */
/* @var $model Plate */

$this->breadcrumbs=array(
	'Plates'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Plate', 'url'=>array('index')),
	array('label'=>'Create Plate', 'url'=>array('create')),
	array('label'=>'Update Plate', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Plate', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Plate', 'url'=>array('admin')),
);
?>

<h1>View Plate <?php echo $model->name; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'type',
		'feature',
	),
)); ?>
