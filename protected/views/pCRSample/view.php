<?php
/* @var $this PCRSampleController */
/* @var $model PCRSample */

$this->breadcrumbs=array(
	'Pcrsamples'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List PCR Sample', 'url'=>array('index')),
	//array('label'=>'Create PCRSample', 'url'=>array('create')),
	array('label'=>'Update PCR Sample', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete PCR Sample', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage PCR Sample', 'url'=>array('admin')),
);
?>

<h1>View PCR Sample #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		//'service_id',
                array(
                  'label'=>'Service ID',
                  'type'=>'raw',
                  'value'=>CHtml::link($model->service_id, array('pCRService/view', 'id'=>$model->service_id)),
                ),
		'name',
		'type',
		//'species_id',
                array(
                  'label'=>'Species ID',
                  'type'=>'raw',
                  'value'=>CHtml::link($model->species->name, array('species/view', 'id'=>$model->species_id)),
                ),
		'note',
	),
)); ?>
