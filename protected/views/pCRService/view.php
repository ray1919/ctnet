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
		//'customer_id',
                array(
                  'label'=>'Contact Title',
                  'type'=>'raw',
                  'value'=>CHtml::link($model->customer->title, array('customer/view', 'id'=>$model->customer_id)),
                ),
		'service_type',
		'sample_arrival_date',
		'report_date',
		//'note',
    array(
      "name"=>'note',
      "value"=>"<pre>".$model->note."</pre>",
      'type'=>'raw',
    ),
	),
)); ?>

<br />
<h1>PCR Sample</h1>
<?php $this->widget('zii.widgets.CListView', array(
    'dataProvider'=>$sampleDataProvider,
    'itemView'=>'/pCRSample/_view',
)); ?>

<br />
<?php
if (!empty($ctdata)) {
$categories = preg_split('/,/',$ctdata[0]['gs']);
function str2float($v) {
    if ($v==="") return '';
    return floatval($v);
}
function ctdata($v) {
    $a = array();
    foreach ($v as $key => $value) {
        $a[$key]['name'] = $v[$key]['name'];
        $a[$key]['data'] = array_map("str2float",preg_split('/,/',$v[$key]['ct']));
    }
    return $a;
}
$this->Widget('ext.highcharts.HighchartsWidget', array(
    'options'=>array(
    'chart' => array(
        'type' => 'scatter',
        'inverted' => true,
        'zoomType' => 'xy',
        'height' => 100+sizeof($categories) * 10,
    ),
    'title' => array('text' => 'PCR Array Ct'),
     'xAxis' => array(
        'title' => array('text' => 'Gene symbol'),
        'categories' => $categories,
         'gridLineWidth' => 1,
     ),
    'yAxis' => array(
        'title' => array('text' => 'Ct value'),
    ),
    'tooltip' => array(
        "formatter" => "js:function() {         
                            return this.series.name + '<br/>'
                            + this.x + ': <b>' + this.y + '</b>';
                        }",
        "shared" => true,
    ),
    'series' => ctdata($ctdata),
    )
));
}
?>
<h1>PCR Experiment</h1>

<?php
    $pageSize=Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']);
    $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'pcrexperiment-grid',
        'dataProvider'=>$expmodel->search($model->id),
        'filter'=>$expmodel,
        //'pager'=>array(
          //'class'=>'CLinkPager',
          //'pageSize'=>'3',
        //),
        'columns'=>array(
		//'id',
		'pos',
		'gene_id',
                array('name'=>'gene_search', 'value'=>'isset($data->gene->gene_symbol) ? $data->gene->gene_symbol : ""'),
		'primer_id',
		//'primer_fk',
		'ct',
		'tm1',
		'tm2',
		//'sample_id',
                array(
                    'name' => 'sample_search',
                    'value' => '$data->sample->name',
                ),
                //'array_name',
		/*
		'service_id',
		'plate_type',
		'status',
		*/
		array(
			'class'=>'CButtonColumn',
                        'template' => '{view}',
                        'buttons'=>array(
                                'view'=>array(
                                    'label'=>'View Ct boxplot',
                                    'url'=>'isset($data->gene->gene_symbol) // check the gene_id is set
                                        ? Yii::app()->createUrl("pCRExperiment/view", array("id"=>$data->id))
                                        : ""',
                                ),
                        ),
		),
            ),
)); ?>
