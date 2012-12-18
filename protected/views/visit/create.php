<?php
/* @var $this VisitController */
/* @var $model Visit */

$this->breadcrumbs=array(
	'Visits'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Visit', 'url'=>array('index')),
	array('label'=>'Manage Visit', 'url'=>array('admin')),
);
?>

<h1>Create Visit</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>