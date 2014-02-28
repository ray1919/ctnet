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
                'gene_symbol',
                'gene_id',
                'gene_name',
                'tax_name',
                'synonyms',
                'type_of_gene',
                ),
        ));
    }
    echo " * Blank lines represent symbols not found.";
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'Gene-form',
	'enableAjaxValidation'=>false,
)); ?>

<div class="row">
<label for="Gene_type_of_input">Type Of Input</label>
<select name="Gene[type]" id="Gene_type_of_Gene">
<option value="gene_symbol">Gene Symbol => ID</option>
<option value="gene_id">Gene ID => Symbol</option>
</select>
</div>

	<div class="row">
		<label>Species:</label>
                <?php echo CHtml::dropDownList('Gene[tax_id]', 9606, $this->getSpecies()); ?>
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