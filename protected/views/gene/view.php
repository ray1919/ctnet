<?php
/* @var $this GeneController */
/* @var $model Gene */

$this->breadcrumbs=array(
	'Genes'=>array('index'),
	$model->gene_symbol,
);

$this->menu=array(
	array('label'=>'List Gene', 'url'=>array('index')),
	array('label'=>'Create Gene', 'url'=>array('create')),
	array('label'=>'Update Gene', 'url'=>array('update', 'id'=>$model->gene_id)),
	array('label'=>'Delete Gene', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->gene_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Gene', 'url'=>array('admin')),
);
?>

<h1>View Gene <?php echo $model->gene_symbol; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
    array(
      'label' => 'Gene ID',
      'name' => 'gene_id',
    ),
		'gene_symbol',
		'gene_name',
		'tax_id',
    array(
      'label' => 'Organism',
      'value' => $model->tax->name,
    ),
		'synonyms',
		'type_of_gene',
	),
)); ?>
