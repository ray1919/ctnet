<?php
/* @var $this VisitController */
/* @var $model Visit */

$this->breadcrumbs=array(
        "Customer"=>array('index'),
        $model->customer->title=>array("customer/view", 'id'=>$model->customer->id),
	'Visits'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Visit', 'url'=>array('index')),
	array('label'=>'Update Visit', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Visit', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Visit', 'url'=>array('admin')),
);
?>

<h1>View Visit #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		/*'id',*/
		array(
                    "label"=>'Customer',
                    "value"=>$model->customer->title,
                ),
		'executor',
		'status',
		'way',
		'class',
		'time',
		array(
                    "label"=>'Comment',
                    "value"=>"<pre>".$model->comment."</pre>",
                    'type'=>'raw',
                ),
		'create_time',
		'create_user_id',
	),
)); ?>
