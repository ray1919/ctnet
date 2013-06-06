<?php
/* @var $this PCRServiceController */
/* @var $model PCRService */

$this->breadcrumbs=array(
	'PCR Services'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List PCRService', 'url'=>array('index')),
	array('label'=>'View PCRService', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage PCRService', 'url'=>array('admin')),
);
?>

<h1>Update PCR Service <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>