<?php
/* @var $this TaskController */
/* @var $model Task */

$this->breadcrumbs=array(
	'Tasks'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Task', 'url'=>array('index')),
	array('label'=>'Create Task', 'url'=>array('create')),
	array('label'=>'Update Task', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Task', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Task', 'url'=>array('admin')),
);
?>

<h1>View Task #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		//'id',
		'name',
		'description',
		'type',
		'status',
                array(
                  "name"=>'owner_id',
                  "value"=>$model->owner->username,
                ),
                array(
                  "name"=>'requester_id',
                  "value"=>$model->requester->username,
                ),
		//'owner_id',
		//'requester_id',
		'acceptance_date',
		'due_date',
                array(
                    'name'=>'weekly_remind',
                    'value'=>CHtml::encode($model->getWRText()),
                ),
                //'weekly_remind',
		'note',
		'create_time',
                array(
                  "name"=>'create_user_id',
                  "value"=>$model->createUser->username,
                ),
		//'create_user_id',
		'update_time',
                array(
                  "name"=>'update_user_id',
                  "value"=>$model->updateUser->username,
                ),
		//'update_user_id',
	),
)); ?>
