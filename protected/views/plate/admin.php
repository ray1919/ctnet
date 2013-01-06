<?php
/* @var $this PlateController */
/* @var $model Plate */

$this->breadcrumbs=array(
	'Plates'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Plate', 'url'=>array('index')),
	array('label'=>'Create Plate', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('plate-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Plates</h1>

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
	'id'=>'plate-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'name',
		'type',
		'feature',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
