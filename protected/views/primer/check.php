<?php
/* @var $this PrimerController */
/* @var $dataProvider */

$this->breadcrumbs=array(
	'Primers'=>array('admin'),
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
                'synthetic_name',
                'plate',
                'well',
                'qc',
                'type',
                'note',
                ),
        ));
        //echo "-1 => 被替换, 0 => 不合格, 1=> 合格, 2 => 未测定, 40 => ct40";
    }
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'primer-form',
	'enableAjaxValidation'=>false,
)); ?>

        <h4>查询策略修改：输出结果显示固定浓度级别的引物位置信息
        <br />可以将使用浓度<b>未搜索到结果的基因</b>重新在存储浓度查询一遍
        <br />输出结果按出入顺序排列。</h4>
<div class="row">
<label for="Primer_type_of_input">Type Of Input</label>
<select name="Primer[type]" id="Primer_type_of_primer">
<option value="gene id">Gene ID (使用浓度)</option>
<option value="miRNA id">miRNA ID (使用浓度)</option>
<option value="miRNA acc">miRNA Acc/Primer ID (使用浓度)</option>
<option value="gene store">Gene ID (存储浓度)</option>
<option value="miRNA id store">miRNA ID (存储浓度)</option>
<option value="miRNA acc store">miRNA Acc/Primer ID (存储浓度)</option>
<option value="gene solid">Gene ID (干粉)</option>
<option value="miRNA id solid">miRNA ID (干粉)</option>
<option value="miRNA acc solid">miRNA Acc/Primer ID (干粉)</option>
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
