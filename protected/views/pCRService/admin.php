<?php
/* @var $this PCRServiceController */
/* @var $model PCRService */

$this->breadcrumbs=array(
	'PCR Services'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List PCRService', 'url'=>array('index')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('pcrservice-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage PCR Services</h1>

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
	'id'=>'pcrservice-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		//'id',
		'date',
		//'customer_id',
		'service_type',
		//'sample_arrival_date',
		'report_date',
		/*
		'note',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
