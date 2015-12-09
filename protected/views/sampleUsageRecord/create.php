<?php
/* @var $this SampleUsageRecordController */
/* @var $model SampleUsageRecord */

$this->breadcrumbs=array(
	'Sample Usage Records'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List SampleUsageRecord', 'url'=>array('index')),
	array('label'=>'Manage SampleUsageRecord', 'url'=>array('admin')),
);
?>

<h1>Create SampleUsageRecord</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>