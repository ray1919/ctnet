<?php
/* @var $this CustomerOrderController */
/* @var $model CustomerOrder */

$this->breadcrumbs=array(
	'Customer Orders'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List CustomerOrder', 'url'=>array('index')),
	array('label'=>'Manage CustomerOrder', 'url'=>array('admin')),
);
?>

<h1>Create CustomerOrder</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>