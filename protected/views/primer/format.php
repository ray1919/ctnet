<?php
/* @var $this PrimerController */
/* @var $dataProvider */

$this->breadcrumbs=array(
	'Primers'=>array('index'),
	'Check Primer',
);

?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'primer-form',
	'enableAjaxValidation'=>false,
  'htmlOptions' => array('enctype'=>'multipart/form-data'),
)); ?>

<div class="row">
<label for="Primer_type_of_input">Type Of Input</label>
<select name="Primer[type]" id="Primer_type_of_primer">
<option value="gene id">Gene ID</option>
<option value="miRNA id">miRNA ID</option>
<option value="miRNA acc">miRNA Acc/Primer ID</option>
</select>
</div>
    <p>Example of Input (separate by space or new line):</p>
    <ul>
        <li>Gene ID: 93 9131 207 98</li>
        <li>miRNA ID: hsa-let-7a-1 hsa-miR-214 hsa-miR-142-5p</li>
        <li>miRNA acc: MIMAT0004560 MIMAT0000433 MIMAT0000062</li>
    </ul>
<div class="row">
<label for="Primer_content">Conent</label>
<input type="file" name="Primer[content]" id="Primer_content" />
</div>

<div class="row buttons">
<input type="submit" name="yt0" value="Check" />
</div>  

<?php $this->endWidget(); ?>


</div>
