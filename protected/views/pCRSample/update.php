<?php
/* @var $this PCRSampleController */
/* @var $model PCRSample */

$this->breadcrumbs=array(
	'Pcrsamples'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List PCR Sample', 'url'=>array('index')),
	//array('label'=>'Create PCR Sample', 'url'=>array('create')),
	array('label'=>'View PCR Sample', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage PCR Sample', 'url'=>array('admin')),
);
?>

<h1>Update PCR Sample <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>