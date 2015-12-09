<?php
/* @var $this SampleController */
/* @var $model Sample */

$this->breadcrumbs=array(
	'Samples'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Sample', 'url'=>array('index')),
	array('label'=>'Create Sample', 'url'=>array('create')),
	array('label'=>'Update Sample', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Sample', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Sample', 'url'=>array('admin')),
  array('label'=>'添加使用记录', 'url'=>array('sampleUsageRecord/create', 'sample_id'=>$model->id)),
);
?>

<h1 align="center"><?php echo $model->name; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'source',
		'type',
		'organism',
		'purpose',
		'arrival_date',
		'total_volume',
		'sample_acc',
		'name',
		'location',
		'person_in_charge',
		'memo',
	),
)); ?>

<br />
<h1>样本使用记录</h1>
<?php $this->widget('zii.widgets.CListView', array(
  'dataProvider'=>$usageDP,
  'itemView'=>'/sampleUsageRecord/_view',
)); ?>

