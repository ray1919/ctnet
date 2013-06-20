<?php
/* @var $this PCRExperimentController */
/* @var $model PCRExperiment */

$this->breadcrumbs=array(
	'Pcrexperiments'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List PCRExperiment', 'url'=>array('index')),
	array('label'=>'Create PCRExperiment', 'url'=>array('create')),
	array('label'=>'View PCRExperiment', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage PCRExperiment', 'url'=>array('admin')),
);
?>

<h1>Update PCRExperiment <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>