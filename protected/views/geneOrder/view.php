<?php
/* @var $this GeneOrderController */
/* @var $model GeneOrder */

$this->breadcrumbs=array(
	'Gene Orders'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List GeneOrder', 'url'=>array('index')),
	array('label'=>'Create GeneOrder', 'url'=>array('create')),
	array('label'=>'Update GeneOrder', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete GeneOrder', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage GeneOrder', 'url'=>array('admin')),
);
?>

<h1>View GeneOrder #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'gene_id',
		'customer_id',
		'price',
		'quantity',
		'date',
		'status',
		'comment',
		'create_time',
	),
)); ?>
