<?php
/* @var $this MirnaController */
/* @var $model Mirna */

$this->breadcrumbs=array(
	'Mirnas'=>array('index'),
	$model->miRNA_id,
);

$this->menu=array(
	array('label'=>'List Mirna', 'url'=>array('index')),
	array('label'=>'Manage Mirna', 'url'=>array('admin')),
  array('label'=>'Check Mirna(New!)', 'url'=> Yii::app()->baseUrl . '/site/page?view=mir_checklist'),
);
?>

<h1>View Mirna <?php echo $model->miRNA_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'miRNA_id',
		'accession',
		'description',
		'tax_id',
    array(
      'label'=>'Organism',
      'value'=>$model->tax->name,
    ),
	),
)); ?>
