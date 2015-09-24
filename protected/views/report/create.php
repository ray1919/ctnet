<?php
/* @var $this ReportController */
/* @var $model Report */

$this->breadcrumbs=array(
	'Reports'=>array('index'),
	'新建实验报告',
);

$this->menu=array(
	array('label'=>'List Report', 'url'=>array('index')),
	array('label'=>'Manage Report', 'url'=>array('admin')),
);
?>

<h1>新建实验报告</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
