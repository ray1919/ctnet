<?php
/* @var $this VisitController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
        "Contact"=>array('index'),
	'Communication',
);

$this->menu=array(
	array('label'=>'Manage Communication', 'url'=>array('admin')),
);
?>

<h1>Communication</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
