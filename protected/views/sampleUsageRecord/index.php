<?php
/* @var $this SampleUsageRecordController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Sample Usage Records',
);

$this->menu=array(
	array('label'=>'Manage SampleUsageRecord', 'url'=>array('admin')),
);
?>

<h1>Sample Usage Records</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
