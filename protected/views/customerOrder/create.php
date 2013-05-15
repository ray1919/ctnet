<?php
/* @var $this CustomerOrderController */
/* @var $model CustomerOrder */

$this->breadcrumbs=array(
        $model->customer->title=>array("customer/view", 'id'=>$model->customer->id),
	'Orders'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Orders', 'url'=>array('index')),
	array('label'=>'Manage Orders', 'url'=>array('admin')),
);
?>

<h1>Create Order</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>