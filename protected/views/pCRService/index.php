<?php
/* @var $this PCRServiceController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'PCR Services',
);

$this->menu=array(
	array('label'=>'Manage PCRService', 'url'=>array('admin')),
);
?>

<h1>PCR Services</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
