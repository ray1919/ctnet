<?php
/* @var $this PrimerController */
/* @var $dataProvider */

$this->breadcrumbs=array(
	'Primers'=>array('index'),
	'Check Primer',
);

?>

<?php
    if (isset($dataProvider)) {
        $this->widget('zii.widgets.grid.CGridView', array(
        'id'=>'primer-grid',
        'dataProvider'=>$dataProvider,
        'columns'=>array(
                'gene_id',
                'gene_symbol',
                'primer_id',
                'barcode',
                'plate',
                'well',
                'qc',
                'type',
                'note',
                ),
        ));
        //echo "-1 => 被替换, 0 => 不合格, 1=> 合格, 2 => 未测定, 40 => ct40";
        echo "<h4>每个基因显示各引物最近一次添加的位置信息，使用浓度 优先于 存储浓度 优先于 干粉。";
        echo "<br />输出结果按出入顺序排列。</h4>";
    }
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'primer-form',
	'enableAjaxValidation'=>false,
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
<label for="Primer_content">Content</label>
<textarea rows="20" cols="35" name="Primer[content]" id="Primer_content"></textarea>
</div>

<div class="row buttons">
<input type="submit" name="yt0" value="Check" />
</div>  

<?php $this->endWidget(); ?>


</div>
