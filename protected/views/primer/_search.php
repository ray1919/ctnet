<?php
/* @var $this PrimerController */
/* @var $model Primer */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'gene_id'); ?>
		<?php echo $form->textField($model,'gene_id',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'gene_symbol'); ?>
		<?php echo $form->textField($model,'gene_symbol',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'primer_id'); ?>
		<?php echo $form->textField($model,'primer_id',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'barcode'); ?>
		<?php echo $form->textField($model,'barcode',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'tax_id'); ?>
		<?php echo $form->textField($model,'tax_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'type_of_primer'); ?>
		<?php echo $form->textField($model,'type_of_primer',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'gene_fk'); ?>
		<?php echo $form->textField($model,'gene_fk'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'mirna_fk'); ?>
		<?php echo $form->textField($model,'mirna_fk'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'comment'); ?>
		<?php echo $form->textArea($model,'comment',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'create_date'); ?>
		<?php echo $form->textField($model,'create_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'update_date'); ?>
		<?php echo $form->textField($model,'update_date'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->