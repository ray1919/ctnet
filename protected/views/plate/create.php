<?php
/* @var $this PlateController */
/* @var $model Plate */

$this->breadcrumbs=array(
	'Plates'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Plate', 'url'=>array('index')),
	array('label'=>'Manage Plate', 'url'=>array('admin')),
);
?>

<h1>Create Plate</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>