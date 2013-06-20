<?php
/* @var $this PCRExperimentController */
/* @var $model PCRExperiment */

$this->breadcrumbs=array(
	'Pcrexperiments'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List PCRExperiment', 'url'=>array('index')),
	array('label'=>'Manage PCRExperiment', 'url'=>array('admin')),
);
?>

<h1>Create PCRExperiment</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>