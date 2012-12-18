<?php
/* @var $this SpeciesController */
/* @var $model Species */

$this->breadcrumbs=array(
	'Species'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Species', 'url'=>array('index')),
	array('label'=>'Manage Species', 'url'=>array('admin')),
);
?>

<h1>Create Species</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>