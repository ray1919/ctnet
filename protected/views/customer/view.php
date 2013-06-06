<?php
/* @var $this CustomerController */
/* @var $model Customer */

$this->breadcrumbs=array(
	'Contacts'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List Contact', 'url'=>array('index')),
	array('label'=>'Create Contact', 'url'=>array('create')),
	array('label'=>'Update Contact', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Contact', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Contact', 'url'=>array('admin')),
        array('label'=>'Create Communication', 'url'=>array('visit/create', 'customer_id'=>$model->id)),
        array('label'=>'Create Order', 'url'=>array('CustomerOrder/create', 'customer_id'=>$model->id)),
        array('label'=>'Create PCR Service', 'url'=>array('PCRService/create', 'customer_id'=>$model->id)),
);
?>

<h1>View Contact #<?php echo $model->id; ?></h1>

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
                'source',
                'add_date',
		'comment',
	),
)); ?>

<br />
<h1>Communication</h1>
<?php $this->widget('zii.widgets.CListView', array(
    'dataProvider'=>$visitDataProvider,
    'itemView'=>'/visit/_view',
)); ?>

<br />
<h1>Orders</h1>
<?php $this->widget('zii.widgets.CListView', array(
    'dataProvider'=>$orderDataProvider,
    'itemView'=>'/customerOrder/_view',
)); ?>

<br />
<h1>PCR Service</h1>
<?php $this->widget('zii.widgets.CListView', array(
    'dataProvider'=>$serviceDataProvider,
    'itemView'=>'/pCRService/_view',
)); ?>

