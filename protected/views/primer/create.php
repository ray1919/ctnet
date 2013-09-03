<?php
/* @var $this PrimerController */
/* @var $model Primer */

$this->breadcrumbs=array(
	'Primers'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Primer', 'url'=>array('index')),
	array('label'=>'Manage Primer', 'url'=>array('admin')),
	array('label'=>'Check Primer', 'url'=>array('check')),
);
?>

<h1>Create Primer</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>