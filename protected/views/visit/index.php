<?php
/* @var $this VisitController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
        "Customer"=>array('index'),
	'Visits',
);

$this->menu=array(
	array('label'=>'Manage Visit', 'url'=>array('admin')),
);
?>

<h1>Visits</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
