<?php
/* @var $this PCRExperimentController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Pcrexperiments',
);

$this->menu=array(
	array('label'=>'Create PCRExperiment', 'url'=>array('create')),
	array('label'=>'Manage PCRExperiment', 'url'=>array('admin')),
);
?>

<h1>Pcrexperiments</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
