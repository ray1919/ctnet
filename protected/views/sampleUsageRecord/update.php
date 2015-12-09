<?php
/* @var $this SampleUsageRecordController */
/* @var $model SampleUsageRecord */

$this->breadcrumbs=array(
	'Sample Usage Records'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List SampleUsageRecord', 'url'=>array('index')),
	array('label'=>'Create SampleUsageRecord', 'url'=>array('create')),
	array('label'=>'View SampleUsageRecord', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage SampleUsageRecord', 'url'=>array('admin')),
);
?>

<h1>Update SampleUsageRecord <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>