<?php
/* @var $this PCRExperimentController */
/* @var $model PCRExperiment */

$this->breadcrumbs=array(
	'Pcrexperiments'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List PCRExperiment', 'url'=>array('index')),
	array('label'=>'Create PCRExperiment', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('pcrexperiment-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Pcrexperiments</h1>

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
	'id'=>'pcrexperiment-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'gene_id',
		'primer_id',
		'primer_fk',
		'ct',
		'tm1',
		/*
		'tm2',
		'service_id',
		'pos',
		'plate_type',
		'status',
		'sample_id',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
