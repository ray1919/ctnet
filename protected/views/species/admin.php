<?php
/* @var $this SpeciesController */
/* @var $model Species */

$this->breadcrumbs=array(
	'Species'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Species', 'url'=>array('index')),
	array('label'=>'Create Species', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('species-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Species</h1>

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
	'id'=>'species-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'name',
		'common',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
