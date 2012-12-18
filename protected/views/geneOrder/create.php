<?php
/* @var $this GeneOrderController */
/* @var $model GeneOrder */

$this->breadcrumbs=array(
	'Gene Orders'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List GeneOrder', 'url'=>array('index')),
	array('label'=>'Manage GeneOrder', 'url'=>array('admin')),
);
?>

<h1>Create GeneOrder</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>