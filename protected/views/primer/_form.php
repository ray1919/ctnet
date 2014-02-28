<?php
/* @var $this PrimerController */
/* @var $model Primer */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'primer-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'gene_id'); ?>
		<?php echo $form->textField($model,'gene_id',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'gene_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'gene_symbol'); ?>
		<?php echo $form->textField($model,'gene_symbol',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'gene_symbol'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'primer_id'); ?>
		<?php echo $form->textField($model,'primer_id',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'primer_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'barcode'); ?>
		<?php echo $form->textField($model,'barcode',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'barcode'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'tax_id'); ?>
                <?php echo $form->dropDownList($model,'tax_id', $model->getSpecies()); ?>
		<?php echo $form->error($model,'tax_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'qc'); ?>
                <?php echo $form->dropDownList($model,'qc', $model->getQcOptions()); ?>
		<?php echo $form->error($model,'qc'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'type_of_primer'); ?>
                <?php echo $form->dropDownList($model,'type_of_primer', array('gene'=>'gene','miRNA'=>'miRNA')); ?>
		<?php echo $form->error($model,'type_of_primer'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'gene_fk'); ?>
		<?php echo $form->textField($model,'gene_fk'); ?>
		<?php echo $form->error($model,'gene_fk'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'mirna_fk'); ?>
		<?php echo $form->textField($model,'mirna_fk'); ?>
		<?php echo $form->error($model,'mirna_fk'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'comment'); ?>
		<?php echo $form->textArea($model,'comment',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'comment'); ?>
	</div>

	<div class="row">
    <?php if (!isset($model->create_date)) $model->create_date=date('Y-m-d'); ?>
		<?php echo $form->labelEx($model,'create_date'); ?>
		<?php echo $form->dateField($model,'create_date'); ?>
		<?php echo $form->error($model,'create_date'); ?>
	</div>

	<div class="row">
    <?php $model->update_date=date('Y-m-d'); ?>
		<?php echo $form->labelEx($model,'update_date'); ?>
		<?php echo $form->dateField($model,'update_date'); ?>
		<?php echo $form->error($model,'update_date'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
