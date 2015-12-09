<?php
/* @var $this SampleUsageRecordController */
/* @var $model SampleUsageRecord */

$this->breadcrumbs=array(
	'Sample Usage Records'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List SampleUsageRecord', 'url'=>array('index')),
	array('label'=>'Update SampleUsageRecord', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete SampleUsageRecord', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage SampleUsageRecord', 'url'=>array('admin')),
);
?>

<h1>Sample Usage Record #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
    array(
      'label'=>'样本名称',
      'value'=>$model->sample->name,
    ),
		'date',
		'person',
		'volume_left',
		'memo',
		'timestamp',
	),
)); ?>
