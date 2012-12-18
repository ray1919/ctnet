<?php
/* @var $this CustomerOrderController */
/* @var $model CustomerOrder */

$this->breadcrumbs=array(
	'Customer Orders'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List CustomerOrder', 'url'=>array('index')),
	array('label'=>'Create CustomerOrder', 'url'=>array('create')),
	array('label'=>'View CustomerOrder', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage CustomerOrder', 'url'=>array('admin')),
);
?>

<h1>Update CustomerOrder <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>