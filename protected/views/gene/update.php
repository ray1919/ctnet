<?php
/* @var $this GeneController */
/* @var $model Gene */

$this->breadcrumbs=array(
	'Genes'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Gene', 'url'=>array('index')),
	array('label'=>'Create Gene', 'url'=>array('create')),
	array('label'=>'View Gene', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Gene', 'url'=>array('admin')),
);
?>

<h1>Update Gene <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>