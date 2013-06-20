<?php
/* @var $this PCRExperimentController */
/* @var $model PCRExperiment */

$this->breadcrumbs=array(
	'Pcrexperiments'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List PCRExperiment', 'url'=>array('index')),
	array('label'=>'Create PCRExperiment', 'url'=>array('create')),
	array('label'=>'Update PCRExperiment', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete PCRExperiment', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage PCRExperiment', 'url'=>array('admin')),
);
?>

<h1>View PCRExperiment #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'gene_id',
		'primer_id',
		'primer_fk',
		'ct',
		'tm1',
		'tm2',
		'service_id',
		'pos',
		'plate_type',
		'status',
		'sample_id',
	),
)); ?>
