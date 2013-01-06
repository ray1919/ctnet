<?php
/* @var $this GeneController */
/* @var $model Gene */

$this->breadcrumbs=array(
	'Genes'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Gene', 'url'=>array('index')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('gene-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Genes</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'gene-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'gene_id',
		'gene_symbol',
		'gene_name',
		//'tax_id',
    array('name'=>'tax_search', 'value'=>'$data->tax->name'),
		'synonyms',
		'type_of_gene',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
