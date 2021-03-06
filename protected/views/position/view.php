<?php
/* @var $this PositionController */
/* @var $model Position */
$this->breadcrumbs=array(
	'Positions'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Position', 'url'=>array('index')),
	array('label'=>'Update Position', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Position', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Position', 'url'=>array('admin')),
);
?>

<h1>View Position <?php echo $model->plate->name; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		//'id',
		//'plate_id',
                array(
                  // 'label' => 'Plate',
                  'label' => CHtml::link(CHtml::encode('Plate'), array('plate/view', 'id'=>$model->plate->id)),
                  'value' => $model->plate->name,
                ),
                            'well',
                array (
                  'label' => 'Gene Symbol / miRNA ID',
                  // 'value' => $model->primer->gene_symbol,
                  'value' => $model->getPrimerColumn($model->id, 'gene_symbol'),
                ),
                array (
                  'label' => 'Gene ID / miRNA Accession',
                  // 'value' => $model->primer->gene_id,
                  'value' => $model->getPrimerColumn($model->id, 'gene_id'),
                ),
                array (
                  'label' => CHtml::link(CHtml::encode('Primer ID'), array('primer/view', 'id'=>$model->getPrimerColumn($model->id, 'id'))),
                  // 'value' => $model->primer->primer_id,
                  'value' => $model->getPrimerColumn($model->id, 'primer_id'),
                ),
                'synthetic_name',
                array(
                  'label' => 'Store Type',
                  'value' => $model->storeType->name,
                ),
		'comment',
		'store_date',
	),
)); ?>
