<?php
/* @var $this PlateController */
/* @var $model Plate */

$this->breadcrumbs=array(
	'Plates'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Plate', 'url'=>array('index')),
	array('label'=>'Create Plate', 'url'=>array('create')),
	array('label'=>'View Plate', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Plate', 'url'=>array('admin')),
);
?>

<h1>Update Plate <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>