<?php
/* @var $this TaskController */
/* @var $model Task */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'task-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'type'); ?>
		<?php echo $form->textField($model,'type',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'type'); ?>
	</div>

	<div class="row">
                <?php echo $form->labelEx($model,'status'); ?>
		<?php echo $form->dropDownList($model,'status', $model->getStatusOptions()); ?>
		<?php echo $form->error($model,'status'); ?>
	</div>

	<div class="row">
                <?php if (!isset($model->owner_id)) $model->owner_id=Yii::app()->user->id; ?>
		<?php echo $form->labelEx($model,'owner_id'); ?>
		<?php echo $form->dropDownList($model,'owner_id', $model->getUsers()); ?>
		<?php echo $form->error($model,'owner_id'); ?>
	</div>

	<div class="row">
                <?php if (!isset($model->requester_id)) $model->requester_id=Yii::app()->user->id; ?>
		<?php echo $form->labelEx($model,'requester_id'); ?>
		<?php echo $form->dropDownList($model,'requester_id', $model->getUsers()); ?>
		<?php echo $form->error($model,'requester_id'); ?>
	</div>

	<div class="row">
                <?php if (!isset($model->acceptance_date)) $model->acceptance_date=date('Y-m-d'); ?>
		<?php echo $form->labelEx($model,'acceptance_date'); ?>
		<?php echo $form->dateField($model,'acceptance_date'); ?>
		<?php echo $form->error($model,'acceptance_date'); ?>
	</div>

	<div class="row">
                <?php if (!isset($model->due_date)) $model->due_date=date('Y-m-d'); ?>
		<?php echo $form->labelEx($model,'due_date'); ?>
		<?php echo $form->dateField($model,'due_date'); ?>
		<?php echo $form->error($model,'due_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'weekly_remind'); ?>
		<?php echo $form->checkbox($model,'weekly_remind'); ?>
		<?php echo $form->error($model,'weekly_remind'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'note'); ?>
		<?php echo $form->textArea($model,'note',array('rows'=>3, 'cols'=>50)); ?>
		<?php echo $form->error($model,'note'); ?>
	</div>

        <?php
            if ($model->isNewRecord) $model->create_time=date('Y-m-d H:m:s');
            echo $form->hiddenField($model,'create_time');
            $model->update_time=date('Y-m-d H:m:s');
            echo $form->hiddenField($model,'update_time');
            if (!isset($model->create_user_id)) $model->create_user_id=Yii::app()->user->id;
            echo $form->hiddenField($model,'create_user_id');
            $model->update_user_id=Yii::app()->user->id;
            echo $form->hiddenField($model,'update_user_id');
        ?>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
