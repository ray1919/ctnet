<?php
/* @var $this StoreTypeController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Store Types',
);

$this->menu=array(
	array('label'=>'Create StoreType', 'url'=>array('create')),
	array('label'=>'Manage StoreType', 'url'=>array('admin')),
);
?>

<h1>Store Types</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
