<?php
/* @var $this MirnaController */
/* @var $model Mirna */

$this->breadcrumbs=array(
	'Mirnas'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Mirna', 'url'=>array('index')),
	array('label'=>'Create Mirna', 'url'=>array('create')),
	array('label'=>'View Mirna', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Mirna', 'url'=>array('admin')),
);
?>

<h1>Update Mirna <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>