<?php
/* @var $this GeneController */
/* @var $model Gene */

$this->breadcrumbs=array(
	'Genes'=>array('index'),
	$model->gene_id=>array('view','id'=>$model->gene_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Gene', 'url'=>array('index')),
	array('label'=>'Create Gene', 'url'=>array('create')),
	array('label'=>'View Gene', 'url'=>array('view', 'id'=>$model->gene_id)),
	array('label'=>'Manage Gene', 'url'=>array('admin')),
);
?>

<h1>Update Gene <?php echo $model->gene_id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>