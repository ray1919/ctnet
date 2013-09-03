<?php
/* @var $this PCRExperimentController */
/* @var $model PCRExperiment */

$this->breadcrumbs=array(
	'PCR Service'=>array('pCRService/view','id'=>$model->service_id),
	$model->id,
);

$this->menu=array(
	//array('label'=>'List PCRExperiment', 'url'=>array('index')),
	//array('label'=>'Create PCRExperiment', 'url'=>array('create')),
	//array('label'=>'Update PCRExperiment', 'url'=>array('update', 'id'=>$model->id)),
	//array('label'=>'Delete PCRExperiment', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	//array('label'=>'Manage PCRExperiment', 'url'=>array('admin')),
);
?>

<h1>View PCRExperiment Gene: <b><?php echo $model->gene->gene_symbol; ?></b></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		//'id',
		//'gene_id',
                array(
                    'label'=>'Gene',
                    'type'=>'raw',
                    'value' => CHtml::link(
                            $model->gene->gene_symbol . ' (' . $model->gene_id . ')',
                            array('gene/view', 'id'=>$model->gene_id)),
                ),
		//'primer_id',
		//'primer_fk',
                array(
                  'label'=>'Primer ID',
                  'type'=>'raw',
                  'value'=>CHtml::link($model->primer_id, array('primer/view', 'id'=>$model->primer_fk)),
                ),
		'ct',
		'tm1',
		'tm2',
		'array_name',
		'pos',
		'plate_type',
		//'sample_id',
                array(
                  'label'=>'Sample ID',
                  'type'=>'raw',
                  'value'=>CHtml::link($model->sample->name, array('pCRSample/view', 'id'=>$model->sample_id)),
                ),
		'status',
	),
)); ?>
<?php
    function str2float($v) {
        if ($v==="") return '';
        return floatval($v);
    }
    foreach ($stats as $key => $value) {
        $pid[] = 'Primer id: ' . $stats[$key]['primer_id'];
        $ct_dot[] = array_map("str2float",preg_split('/,/',$stats[$key]['cts']));
        $cts[] = new boxPlot($ct_dot[$key]);
        foreach ($ct_dot[$key] as $i => $j) {
            $ct_dots[] = array($key,$j);
        }
        $ctdata[$key] = $cts[$key]->box_para();
        
        $tm1_dot[] = array_map("str2float",preg_split('/,/',$stats[$key]['tm1s']));
        $tm1s[] = new boxPlot($tm1_dot[$key]);
        foreach ($tm1_dot[$key] as $i => $j) {
            $tm1_dots[] = array($key,$j);
        }
        $tm1data[$key] = $tm1s[$key]->box_para();
    }
    //print_r(!isset($stats[$key]['cts']));

if (isset($stats[$key]['cts']))
$this->Widget('ext.highcharts.HighchartsWidget', array(
    'options'=>array(
    'chart' => array(
        'type' => 'boxplot',
        'inverted' => true,
        'height' => 150+count($ctdata)*50,
    ),
    'title' => array('text' => $model->gene->gene_symbol . ' CT Boxplot'),
     'xAxis' => array(
        'categories' => $pid,
     ),
    'yAxis' => array(
        'title' => array('text' => 'Ct'),
        'plotLines' => array(
            array(
            'color' => '#FF0000',
            'width' => 2,
            'value' => $model->ct,
            'zIndex' => 5,
            'label' => array(
                'text' => $model->ct,
                'align' => 'left',
            ),
            )
        ),
    ),
    'series' => array(
        array(
            'name' => 'Ct',
            'data' => $ctdata,
        ),
        array(
            'name' => 'ct values',
            'type' => 'scatter',
            'data' => $ct_dots,
        ),
    ),
    )
));
if (isset($stats[$key]['tm1s']))
$this->Widget('ext.highcharts.HighchartsWidget', array(
    'options'=>array(
    'chart' => array(
        'type' => 'boxplot',
        'inverted' => true,
        'height' => 150+count($tm1data)*50,
    ),
    'title' => array('text' => $model->gene->gene_symbol . ' TM1 Boxplot'),
     'xAxis' => array(
        'categories' => $pid,
     ),
    'tooltip' => array(
        'valueSuffix' => '°C',
    ),
    'yAxis' => array(
        'title' => array('text' => 'Tm1 (°C)'),
        'plotLines' => array(
            array(
            'color' => '#FF0000',
            'width' => 2,
            'value' => $model->tm1,
            'zIndex' => 5,
            'label' => array(
                'text' => $model->tm1,
                'align' => 'left',
            ),
            )
        ),
    ),
    'series' => array(
        array(
            'name' => 'Tm1',
            'data' => $tm1data,
            'color' => 'DarkGreen',
        ),
        array(
            'name' => 'tm1 values',
            'type' => 'scatter',
            'color' => 'DeepPink',
            'data' => $tm1_dots,
        ),
    ),
    )
));
?>