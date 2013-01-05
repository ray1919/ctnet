<?php
/* @var $this MirnaController */
/* @var $model Mirna */

$this->breadcrumbs=array(
	'Mirnas'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Mirna', 'url'=>array('index')),
	array('label'=>'Manage Mirna', 'url'=>array('admin')),
);
?>

<h1>Create Mirna</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>