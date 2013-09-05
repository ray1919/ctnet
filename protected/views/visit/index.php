<?php
/* @var $this VisitController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
        "Contact"=>array('index'),
	'Communication',
);

$this->menu=array(
	array('label'=>'Manage Communication', 'url'=>array('admin')),
);
?>

<h1>Communication</h1>
<?php $this->widget('ext.EFullCalendar.EFullCalendar', array(
    'themeCssFile'=>'cupertino/theme.css',
    'options'=>array(
        'lazyFetching'=>true,
        'events'=>Yii::app()->request->baseUrl.'/visit/CalendarEvents',
        'header'=>array(
            'left'=>'prev,next',
            'center'=>'title',
            'right'=>'today'
        )
    ))); ?>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
