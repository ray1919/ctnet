<?php
/* @var $this ReportController */
/* @var $model Report */

$this->breadcrumbs=array(
	'Reports'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Report', 'url'=>array('index')),
	array('label'=>'Create Report', 'url'=>array('create')),
	array('label'=>'Update Report', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Report', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Report', 'url'=>array('admin')),
	array('label'=>'Upload Data', 'url'=>array('upload','report_id'=>$model->id)),
  array('label'=>'PCR Data Online Processing App', 'url'=> Yii::app()->baseUrl . '/site/page?view=pdopa'),
);
?>

<h1>实验报告 编号<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'type',
    array(
      'name'=>'purpose',
      'value'=>"<div  style=\"overflow:auto;\">".$model->purpose."</div>",
      'type'=>'raw',
    ),
		'date',
		'experimenter',
    array(
      'name'=>'sample',
      'value'=>"<div>".$model->sample."</div>",
      'type'=>'raw',
    ),
    array(
      'name'=>'sampleLayout',
      'value'=>"<div  style=\"overflow: auto\">".$model->sampleLayout."</div>",
      'type'=>'raw',
    ),
    array(
      'name'=>'cycleProgram',
      'value'=>"<div>".$model->cycleProgram."</div>",
      'type'=>'raw',
    ),
    array(
      'name'=>'formula',
      'value'=>"<div>".$model->formula."</div>",
      'type'=>'raw',
    ),
    array(
      'name'=>'result',
      'value'=>"<div>".$model->result."</div>",
      'type'=>'raw',
    ),
    array(
      'name'=>'conclusion',
      'value'=>"<div>".$model->conclusion."</div>",
      'type'=>'raw',
    ),
	),
)); ?>
