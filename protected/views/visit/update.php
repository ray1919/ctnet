<?php
/* @var $this VisitController */
/* @var $model Visit */

$this->breadcrumbs=array(
	'Visits'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Visit', 'url'=>array('index')),
	array('label'=>'Create Visit', 'url'=>array('create')),
	array('label'=>'View Visit', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Visit', 'url'=>array('admin')),
);
?>

<h1>Update Visit <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>