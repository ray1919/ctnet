<?php
/* @var $this ReportController */
/* @var $model Report */
/* @var $form CActiveForm */
?>

<div class="form">
<?php
  $baseUrl = Yii::app()->baseUrl;
  $cs = Yii::app()->getClientScript();
    $cs->registerScriptFile($baseUrl.'/scripts/tm/tinymce.min.js');
?>
<script>tinymce.init({
  selector:'textarea',
    plugins: [
      "advlist autolink lists link image charmap print preview anchor",
      "searchreplace visualblocks code fullscreen responsivefilemanager",
      "insertdatetime media table contextmenu paste imagetools"
    ],
    toolbar1: "undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent",
    toolbar2: "| responsivefilemanager | link unlink anchor | image media | forecolor backcolor  | fullscreen preview code ",
    image_advtab: true ,

    external_filemanager_path:"/~zhaorui/ctnet/scripts/filemanager/",
    filemanager_title:"Responsive Filemanager" ,
    external_plugins: { "filemanager" : "/~zhaorui/ctnet/scripts/filemanager/plugin.min.js"},
    autosave_ask_before_unload: false,
    max_height: 600,
    min_height: 160,
    height : 180
});</script>


<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'report-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">带<span class="required">*</span>号的项目是必须填写的。</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'type'); ?>
    <?php echo $form->dropDownList($model,'type', $model->getTypeOptions()); ?>
		<?php echo $form->error($model,'type'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'purpose'); ?>
		<?php echo $form->textArea($model,'purpose',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'purpose'); ?>
	</div>

  <?php if (!isset($model->date)) $model->date=date('Y-m-d'); ?>
	<div class="row">
		<?php echo $form->labelEx($model,'date'); ?>
		<?php echo $form->dateField($model,'date'); ?>
		<?php echo $form->error($model,'date'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'experimenter'); ?>
		<?php echo $form->textField($model,'experimenter',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'experimenter'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sample'); ?>
		<?php echo $form->textArea($model,'sample',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'sample'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sampleLayout'); ?>
		<?php echo $form->textArea($model,'sampleLayout',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'sampleLayout'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cycleProgram'); ?>
		<?php echo $form->textArea($model,'cycleProgram',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'cycleProgram'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'formula'); ?>
		<?php echo $form->textArea($model,'formula',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'formula'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'result'); ?>
		<?php echo $form->textArea($model,'result',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'result'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'conclusion'); ?>
		<?php echo $form->textArea($model,'conclusion',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'conclusion'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? '保存' : '保存修改'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
