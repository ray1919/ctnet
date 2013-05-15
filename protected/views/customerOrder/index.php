<?php
/* @var $this CustomerOrderController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
        "Contact"=>array('Customer/index'),
	'Orders',
);

$this->menu=array(
	array('label'=>'Manage Orders', 'url'=>array('admin')),
);
?>

<h1>Orders</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
