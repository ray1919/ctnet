<?php
/* @var $this CustomerController */
/* @var $model Customer */

$this->breadcrumbs=array(
	'Customers'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List Customer', 'url'=>array('index')),
	array('label'=>'Create Customer', 'url'=>array('create')),
	array('label'=>'Update Customer', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Customer', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Customer', 'url'=>array('admin')),
        array('label'=>'Create Visit', 'url'=>array('visit/create', 'customer_id'=>$model->id)),
        array('label'=>'Create Order', 'url'=>array('CustomerOrder/create', 'customer_id'=>$model->id)),
);
?>

<h1>View Customer #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'title',
		'name',
		'tel1',
		'tel2',
		'tel3',
		'email',
		'IM',
		'address',
		'organization',
                'add_date',
		'comment',
	),
)); ?>

<br />
<h1>Customer visits</h1>
<?php $this->widget('zii.widgets.CListView', array(
    'dataProvider'=>$visitDataProvider,
    'itemView'=>'/visit/_view',
)); ?>
<br />
<h1>Customer orders</h1>
<?php $this->widget('zii.widgets.CListView', array(
    'dataProvider'=>$orderDataProvider,
    'itemView'=>'/customerOrder/_view',
)); ?>

