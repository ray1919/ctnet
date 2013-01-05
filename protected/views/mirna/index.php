<?php
/* @var $this MirnaController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Mirnas',
);

$this->menu=array(
	array('label'=>'Create Mirna', 'url'=>array('create')),
	array('label'=>'Manage Mirna', 'url'=>array('admin')),
);
?>

<h1>Mirnas</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
