<?php
/* @var $this GeneController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Genes',
);

$this->menu=array(
	array('label'=>'Manage Gene', 'url'=>array('admin')),
);
?>

<h1>Genes</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
