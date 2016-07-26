<?php
/* @var $this StoreTypeController */
/* @var $model StoreType */

$this->breadcrumbs=array(
	'Store Types'=>array('admin'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List StoreType', 'url'=>array('index')),
	array('label'=>'Create StoreType', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('store-type-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Store Types</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'store-type-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
        'enablePagination' => true,
	'columns'=>array(
		'id',
		'name',
    'type',
		'description',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
