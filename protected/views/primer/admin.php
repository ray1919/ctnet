<?php
/* @var $this PrimerController */
/* @var $model Primer */

$this->breadcrumbs=array(
	'Primers'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Primer', 'url'=>array('index')),
	array('label'=>'Create Primer', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('primer-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Primers</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'primer-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		//'id',
		'gene_id',
		'gene_symbol',
		'primer_id',
		'barcode',
		'tax_id',
    array('name'=>'tax_search', 'value'=>'$data->tax->name'),
		'type_of_primer',
		/*
		'gene_fk',
		'mirna_fk',
		'comment',
		'create_date',
		'update_date',
		*/
		array(
			'class'=>'CButtonColumn',
      'template' => '{view} {delete}',
		),
	),
)); ?>
