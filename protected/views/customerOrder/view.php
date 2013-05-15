<?php
/* @var $this CustomerOrderController */
/* @var $model CustomerOrder */

$this->breadcrumbs=array(
        "Contact"=>array('Customer/index'),
        $model->customer->title=>array("customer/view", 'id'=>$model->customer->id),
	'Orders'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Orders', 'url'=>array('index')),
	array('label'=>'Update Orders', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Orders', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Orders', 'url'=>array('admin')),
);
?>

<h1>View Order #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		/*'id',*/
		array(
                    "label"=>'Customer',
                    "value"=>$model->customer->title,
                ),
		'price',
		'quantity',
		'date',
		'status',
		'comment',
		'create_time',
	),
)); ?>
