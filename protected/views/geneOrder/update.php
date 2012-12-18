<?php
/* @var $this GeneOrderController */
/* @var $model GeneOrder */

$this->breadcrumbs=array(
	'Gene Orders'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List GeneOrder', 'url'=>array('index')),
	array('label'=>'Create GeneOrder', 'url'=>array('create')),
	array('label'=>'View GeneOrder', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage GeneOrder', 'url'=>array('admin')),
);
?>

<h1>Update GeneOrder <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>