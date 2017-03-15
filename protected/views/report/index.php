<?php
/* @var $this ReportController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Reports',
);

$this->menu=array(
	array('label'=>'Create Report', 'url'=>array('create')),
	array('label'=>'Manage Report', 'url'=>array('admin')),
  array('label'=>'PCR Data Online Processing App', 'url'=> Yii::app()->baseUrl . '/site/page?view=pdopa'),
);
?>

<h1>Reports</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
