<?php
/* @var $this GeneController */
/* @var $model Gene */

$this->breadcrumbs=array(
	'Genes'=>array('index'),
	$model->gene_symbol,
);

$this->menu=array(
	array('label'=>'List Gene', 'url'=>array('index')),
	array('label'=>'Manage Gene', 'url'=>array('admin')),
);
?>

<h1>View Gene <?php echo $model->gene_symbol; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
    'gene_id',
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
