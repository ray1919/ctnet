<?php
/* @var $this PositionController */
/* @var $model Position */

$this->breadcrumbs=array(
	'Positions'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Position', 'url'=>array('index')),
	array('label'=>'Create Position', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('position-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Positions</h1>

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
	'id'=>'position-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		//'id',
		'plate_id',
		'well',
		//'primer_id',
    array( 'header'=>'Gene Symbol',  'name'=>'primer_search1', 'value'=>'$data->primer->gene_symbol' ),
    array( 'header'=>'Gene ID',  'name'=>'primer_search2', 'value'=>'$data->primer->gene_id' ),
    array( 'header'=>'Primer ID',  'name'=>'primer_search3', 'value'=>'$data->primer->primer_id' ),
		'store_type_id',
		'comment',
		/*
		'store_date',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
