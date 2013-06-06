<?php
/* @var $this PCRSampleController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Pcrsamples',
);

$this->menu=array(
	//array('label'=>'Create PCRSample', 'url'=>array('create')),
	array('label'=>'Manage PCR Sample', 'url'=>array('admin')),
);
?>

<h1>PCR Samples</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
