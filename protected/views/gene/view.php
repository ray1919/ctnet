<?php
/* @var $this GeneController */
/* @var $model Gene */

$this->breadcrumbs=array(
	'Genes'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Gene', 'url'=>array('index')),
	array('label'=>'Create Gene', 'url'=>array('create')),
	array('label'=>'Update Gene', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Gene', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Gene', 'url'=>array('admin')),
);
?>

<h1>View Gene #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'symbol',
		'name',
		'tax_id',
		'synonyms',
		'type_of_gene',
	),
)); ?>
