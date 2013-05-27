<?php
/* @var $this VisitController */
/* @var $model Visit */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'visit-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'customer_id'); ?>
		<?php echo $this->customer_title; ?>
                <?php echo $form->error($model,'customer_id'); ?>
	</div>

	<div class="row">
    <?php if (!isset($model->executor)) $model->executor=Yii::app()->user->email; ?>
		<?php echo $form->labelEx($model,'executor'); ?>
		<?php echo $form->emailField($model,'executor',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'executor'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'status'); ?>
		<?php echo $form->dropDownList($model,'status', $model->getStatusOptions()); ?>
		<?php echo $form->error($model,'status'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'way'); ?>
		<?php echo $form->dropDownList($model,'way', $model->getWayOptions()); ?>
		<?php echo $form->error($model,'way'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'class'); ?>
		<?php echo $form->dropDownList($model,'class', $model->getClassOptions()); ?>
		<?php echo $form->error($model,'class'); ?>
	</div>

	<div class="row">
                <?php if (!isset($model->time)) $model->time=date('Y-m-d'); ?>
		<?php echo $form->labelEx($model,'time'); ?>
		<?php echo $form->dateField($model,'time'); ?>
		<?php echo $form->error($model,'time'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'comment'); ?>
		<?php echo $form->textArea($model,'comment',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'comment'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'return_visit'); ?>
		<?php echo $form->dropDownList($model,'return_visit', $model->getReturnVisitOptions()); ?>
		<?php echo $form->error($model,'return_visit'); ?>
	</div>

	<div class="row">
                <?php if (!isset($model->scheduled)) $model->scheduled=date('Y-m-d',strtotime('+30 day')); ?>
		<?php echo $form->labelEx($model,'scheduled'); ?>
		<?php echo $form->dateField($model,'scheduled'); ?>
		<?php echo $form->error($model,'scheduled'); ?>
	</div>

	<div class="row">
                <?php if (!isset($model->create_time)) $model->create_time=date('Y-m-d'); ?>
		<?php echo $form->labelEx($model,'create_time'); ?>
		<?php echo $form->dateField($model,'create_time'); ?>
		<?php echo $form->error($model,'create_time'); ?>
	</div>

        <?php
            if (!isset($model->create_user_id)) $model->create_user_id=Yii::app()->user->id;
            echo $form->hiddenField($model,'create_user_id');
        ?>
        
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
