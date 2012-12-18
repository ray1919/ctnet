<?php
/* @var $this GeneOrderController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Gene Orders',
);

$this->menu=array(
	array('label'=>'Create GeneOrder', 'url'=>array('create')),
	array('label'=>'Manage GeneOrder', 'url'=>array('admin')),
);
?>

<h1>Gene Orders</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
