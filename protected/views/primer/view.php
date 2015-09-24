<?php
/* @var $this PrimerController */
/* @var $model Primer */

$this->breadcrumbs=array(
	'Primers'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Primer', 'url'=>array('index')),
	array('label'=>'Create Primer', 'url'=>array('create')),
	array('label'=>'Update Primer', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Primer', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Primer', 'url'=>array('admin')),
	array('label'=>'Check Primer', 'url'=>array('check')),
        array('label'=>'Add Primer Position', 'url'=>array('position/create', 'primer_id'=>$model->id)),
);
?>

<h1>View Primer #<?php echo $model->primer_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		//'id',
		'gene_symbol',
                'gene_id',
                'primer_id',
		'barcode',
		//'tax_id',
                array(
                  'label'=>'Organsim',
                  'value'=>$model->tax->name,
                ),
		'type_of_primer',
                array(
                    'name'=>'qc_search',
                    //'value'=>CHtml::encode($model->getQcText()),
                    'value'=>$model->qcFk->name,
                ),
                //'qc',
		//'gene_fk',
                array(
                  'label'=>'Gene Link',
                  'type'=>'raw',
                  'value'=>CHtml::link($model->gene_fk, array('gene/view', 'id'=>$model->gene_fk)),
                ),
		//'mirna_fk',
                array(
                  'label'=>'miRNA Link',
                  'type'=>'raw',
                  'value'=>CHtml::link(CHtml::encode($model->mirna_fk), array('mirna/view', 'id'=>$model->mirna_fk)),
                ),
		'comment',
		'create_date',
		'update_date',
	),
)); ?>

<br />
<h1>Primer Position</h1>

<div id="_view">
<h4>
<table>
<tr>
<td><b>Plate</b></td>
<td><b>Well</b></td>
<td><b>Gene Symbol</b></td>
<td><b>Gene ID</b></td>
<td><b>Primer ID</b></td>
<td><b>Store Type</b></td>
</tr>
</h4>
</table>
</div>

<?php $this->widget('zii.widgets.CListView', array(
  'dataProvider'=>$positionDataProvider,
  'itemView'=>'/position/_view',
)); ?>

<?php
    function str2float($v) {
        if ($v==="") return '';
        return floatval($v);
    }
    foreach ($stats as $key => $value) {
      // print_r($stats[$key]['tms']);exit;
        $pid[] = 'Primer id: ' . $stats[$key]['primer_id'];
        $ct_dot[] = array_map("str2float",preg_split('/,/',$stats[$key]['cts']));
        $cts[] = new boxPlot($ct_dot[$key]);
        foreach ($ct_dot[$key] as $i => $j) {
            $ct_dots[] = array($key,$j);
        }
        $ctdata[$key] = $cts[$key]->box_para();

        $tm1_dot[] = array_map("str2float",preg_split('/,/',$stats[$key]['tms']));
        $tm1s[] = new boxPlot($tm1_dot[$key]);
        foreach ($tm1_dot[$key] as $i => $j) {
            $tm1_dots[] = array($key,$j);
        }
        $tm1data[$key] = $tm1s[$key]->box_para();
    }
    //print_r(!isset($stats[$key]['cts']));
    // print_r(( $tm1_dots) );exit;

if (isset($key))
$this->Widget('ext.highcharts.HighchartsWidget', array(
    'options'=>array(
    'chart' => array(
        'type' => 'boxplot',
        'inverted' => true,
        'height' => 150+count($ctdata)*50,
    ),
    'title' => array('text' => $model->gene_symbol . ' CT Boxplot'),
     'xAxis' => array(
        'categories' => $pid,
     ),
    'yAxis' => array(
        'title' => array('text' => 'Ct'),
        /*
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
        ),*/
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
if (isset($key))
$this->Widget('ext.highcharts.HighchartsWidget', array(
    'options'=>array(
    'chart' => array(
        'type' => 'boxplot',
        'inverted' => true,
        'height' => 150+count($tm1data)*50,
    ),
    'title' => array('text' => $model->gene_symbol . ' TM Boxplot'),
     'xAxis' => array(
        'categories' => $pid,
     ),
    'tooltip' => array(
        'valueSuffix' => '°C',
    ),
    'yAxis' => array(
        'title' => array('text' => 'Tm (°C)'),
        /*
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
        ),*/
    ),
    'series' => array(
        array(
            'name' => 'TM',
            'data' => $tm1data,
            'color' => 'DarkGreen',
        ),
        array(
            'name' => 'TM values',
            'type' => 'scatter',
            'color' => 'DeepPink',
            'data' => $tm1_dots,
        ),
    ),
    )
));
?>

