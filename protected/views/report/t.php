<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'position-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
    <?php echo $form->dropDownList($model,'run_id', $model->getRunNames()); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
