<?php
/* @var $this PrimerController */
/* @var $model Primer */

$this->breadcrumbs=array(
	'Primers'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Primer', 'url'=>array('index')),
	array('label'=>'Create Primer', 'url'=>array('create')),
	array('label'=>'View Primer', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Primer', 'url'=>array('admin')),
	array('label'=>'Check Primer', 'url'=>array('check')),
);
?>

<h1>Update Primer <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>