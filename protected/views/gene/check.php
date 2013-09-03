<?php
/* @var $this GeneController */
/* @var $dataProvider */

$this->breadcrumbs=array(
	'Gene'=>array('index'),
	'Check Gene',
);

?>

<?php
    if (isset($dataProvider)) {
        $this->widget('zii.widgets.grid.CGridView', array(
        'id'=>'gene-grid',
        'dataProvider'=>$dataProvider,
        'columns'=>array(
                'gene_id',
                'gene_symbol',
                'Gene_id',
                'barcode',
                'plate',
                'well',
                'qc',
                'type',
                'note',
                ),
        ));
        echo "-1 => 被替换, 0 => 不合格, 1=> 合格, 2 => 未测定, 40 => ct40";
    }
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'Gene-form',
	'enableAjaxValidation'=>false,
)); ?>

<div class="row">
<label for="Gene_type_of_input">Type Of Input</label>
<select name="Gene[type]" id="Gene_type_of_Gene">
<option value="gene id">gene id</option>
<option value="miRNA id">miRNA id</option>
</select>
</div>

<div class="row">
<label for="Gene_content">Content</label>
<textarea rows="20" cols="35" name="Gene[content]" id="Gene_content"></textarea>
</div>

<div class="row buttons">
<input type="submit" name="yt0" value="Check" />
</div>  

<?php $this->endWidget(); ?>


</div><!-- form 