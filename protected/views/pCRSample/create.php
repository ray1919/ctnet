<?php
/* @var $this PCRSampleController */
/* @var $model PCRSample */

$this->breadcrumbs=array(
	'Pcrsamples'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List PCR Sample', 'url'=>array('index')),
	array('label'=>'Manage PCR Sample', 'url'=>array('admin')),
);
?>

<h1>Create PCR Sample</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>