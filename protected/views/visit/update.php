<?php
/* @var $this VisitController */
/* @var $model Visit */

$this->breadcrumbs=array(
        $model->customer->title=>array("customer/view", 'id'=>$model->customer->id),
	'Communication'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Communication', 'url'=>array('index')),
	array('label'=>'View Communication', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Communication', 'url'=>array('admin')),
);
?>

<h1>Update Communication <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>