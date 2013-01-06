<?php
/* @var $this PlateController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Plates',
);

$this->menu=array(
	array('label'=>'Create Plate', 'url'=>array('create')),
	array('label'=>'Manage Plate', 'url'=>array('admin')),
);
?>

<h1>Plates</h1>
<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
