<?php
/* @var $this CustomerOrderController */
/* @var $model CustomerOrder */

$this->breadcrumbs=array(
        $model->customer->title=>array("customer/view", 'id'=>$model->customer->id),
	'Orders'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Orders', 'url'=>array('index')),
	array('label'=>'View Orders', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Orders', 'url'=>array('admin')),
);
?>

<h1>Update Order <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>