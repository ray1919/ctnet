<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>

<h1>Welcome to <i><?php echo CHtml::encode(Yii::app()->name); ?></i></h1>
<?php $this->widget('ext.EFullCalendar.EFullCalendar', array(
    'themeCssFile'=>'cupertino/theme.css',
    'options'=>array(
        'lazyFetching'=>true,
        'events'=>Yii::app()->request->baseUrl.'/task/CalendarEvents',
        'header'=>array(
            'left'=>'prev,next',
            'center'=>'title',
            'right'=>'today'
        )
    ))); ?>

<p></p>

