<?php
/* @var $this PCRServiceController */
/* @var $model PCRService */

$this->breadcrumbs=array(
	'PCR Services'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List PCRService', 'url'=>array('index')),
	array('label'=>'Manage PCRService', 'url'=>array('admin')),
);
?>

<h1>Create PCR Service</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>