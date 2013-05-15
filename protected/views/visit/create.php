<?php
/* @var $this VisitController */
/* @var $model Visit */

$this->breadcrumbs=array(
        $model->customer->title=>array("customer/view", 'id'=>$model->customer->id),
	'Communication'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Communication', 'url'=>array('index')),
	array('label'=>'Manage Communication', 'url'=>array('admin')),
);
?>

<h1>Create Communication</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>