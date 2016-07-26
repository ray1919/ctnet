<?php
/* @var $this MirnaController */
/* @var $dataProvider */

$this->breadcrumbs=array(
  'Mirna'=>array('index'),
  'Check Mirna',
);

?>

<?php
    if (isset($dataProvider)) {
        $this->widget('zii.widgets.grid.CGridView', array(
        'id'=>'gene-grid',
        'dataProvider'=>$dataProvider,
        'columns'=>array(
                'mirna_id',
                'accession',
                'description',
                'name',
                ),
        ));
    }
    echo " * Blank lines represent symbols not found.";
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
  'id'=>'Mirna-form',
  'enableAjaxValidation'=>false,
)); ?>

<div class="row">
<label for="Mirna_type_of_input">Type Of Input</label>
<select name="Mirna[type]" id="Mirna_type_of_Mirna">
<option value="accession">Mirna Accession => ID</option>
<option value="mirna_id">Mirna ID => Accession</option>
</select>
</div>


<div class="row">
<label for="Mirna_content">Content</label>
<textarea rows="20" cols="35" name="Mirna[content]" id="Mirna_content"></textarea>
</div>

<div class="row buttons">
<input type="submit" name="yt0" value="Check" />
</div>  

<?php $this->endWidget(); ?>


</div><!-- form 
