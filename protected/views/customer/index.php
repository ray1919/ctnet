<?php
/* @var $this CustomerController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Contact',
);

$this->menu=array(
	array('label'=>'Create Contact', 'url'=>array('create')),
	array('label'=>'Manage Contact', 'url'=>array('admin')),
);
?>

<h1>Contacts</h1>

<?php 
        $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
        'viewData'=>array('times'=>$times),
)); ?>
