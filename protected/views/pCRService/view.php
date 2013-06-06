<?php
/* @var $this PCRServiceController */
/* @var $model PCRService */

$this->breadcrumbs=array(
	'PCR Services'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List PCRService', 'url'=>array('index')),
	array('label'=>'Update PCRService', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete PCRService', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage PCRService', 'url'=>array('admin')),
        array('label'=>'Create PCR Sample', 'url'=>array('PCRSample/create', 'service_id'=>$model->id)),
);
?>

<h1>View PCR Service #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'date',
		'customer_id',
		'service_type',
		'sample_arrival_date',
		'report_date',
		'note',
	),
)); ?>

<br />
<h1>PCR Sample</h1>
<?php $this->widget('zii.widgets.CListView', array(
    'dataProvider'=>$sampleDataProvider,
    'itemView'=>'/pCRSample/_view',
)); ?>
