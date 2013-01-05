<?php
/* @var $this MirnaController */
/* @var $model Mirna */

$this->breadcrumbs=array(
	'Mirnas'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Mirna', 'url'=>array('index')),
	array('label'=>'Create Mirna', 'url'=>array('create')),
	array('label'=>'Update Mirna', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Mirna', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Mirna', 'url'=>array('admin')),
);
?>

<h1>View Mirna #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'miRNA_id',
		'accession',
		'description',
		'tax_id',
	),
)); ?>
