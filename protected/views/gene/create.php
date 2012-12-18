<?php
/* @var $this GeneController */
/* @var $model Gene */

$this->breadcrumbs=array(
	'Genes'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Gene', 'url'=>array('index')),
	array('label'=>'Manage Gene', 'url'=>array('admin')),
);
?>

<h1>Create Gene</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>