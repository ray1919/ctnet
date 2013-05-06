<?php
/* @var $this PrimerController */
/* @var $model Primer */

$this->breadcrumbs=array(
	'Primers'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Primer', 'url'=>array('index')),
	array('label'=>'Create Primer', 'url'=>array('create')),
	array('label'=>'Update Primer', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Primer', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Primer', 'url'=>array('admin')),
	array('label'=>'Check Primer', 'url'=>array('check', 'id'=>$model->id)),
);
?>

<h1>View Primer #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		//'id',
		'gene_symbol',
    'gene_id',
    'primer_id',
		'barcode',
		//'tax_id',
    array(
      'label'=>'Organsim',
      'value'=>$model->tax->name,
    ),
		'type_of_primer',
    'qc',
		//'gene_fk',
    array(
      'label'=>'Gene Link',
      'type'=>'raw',
      'value'=>CHtml::link(CHtml::encode($model->gene_fk), array('gene/view', 'id'=>$model->gene_fk)),
    ),
		//'mirna_fk',
    array(
      'label'=>'miRNA Link',
      'type'=>'raw',
      'value'=>CHtml::link(CHtml::encode($model->mirna_fk), array('mirna/view', 'id'=>$model->mirna_fk)),
    ),
		'comment',
		'create_date',
		'update_date',
	),
)); ?>

<br />
<h1>Primer Position</h1>

<div id="_view">
<h4>
<table>
<tr>
<td><b>Plate</b></td>
<td><b>Well</b></td>
<td><b>Gene Symbol</b></td>
<td><b>Gene ID</b></td>
<td><b>Primer ID</b></td>
<td><b>Store Type</b></td>
</tr>
</h4>
</table>
</div>

<?php $this->widget('zii.widgets.CListView', array(
  'dataProvider'=>$positionDataProvider,
  'itemView'=>'/position/_view',
)); ?>

