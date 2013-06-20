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
        array('label'=>'Add PCR Sample', 'url'=>array('PCRSample/create', 'service_id'=>$model->id)),
        array('label'=>'Add PCR Experiment', 'url'=>array('PCRExperiment/create', 'service_id'=>$model->id)),
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

<br />
<h1>PCR Experiment</h1>

<?php
    $pageSize=Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']);
    $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'pcrexperiment-grid',
        'dataProvider'=>$expmodel->search(),
        'filter'=>$expmodel,
        //'pager'=>array(
          //'class'=>'CLinkPager',
          //'pageSize'=>'3',
        //),
        'columns'=>array(
		//'id',
		'pos',
		'gene_id',
		'primer_id',
		//'primer_fk',
		'ct',
		'tm1',
		'tm2',
		'sample_id',
                'array_name',
		/*
		'service_id',
		'plate_type',
		'status',
		array(
			'class'=>'CButtonColumn',
		),
		*/
            ),
)); ?>