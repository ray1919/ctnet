<?php
/* @var $this StoreTypeController */
/* @var $model StoreType */

$this->breadcrumbs=array(
	'Store Types'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List StoreType', 'url'=>array('index')),
	array('label'=>'Manage StoreType', 'url'=>array('admin')),
);
?>

<h1>Create StoreType</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>