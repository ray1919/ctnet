<?php
/* @var $this MirnaController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Mirnas',
);

$this->menu=array(
	array('label'=>'Create Mirna', 'url'=>array('create')),
	array('label'=>'Manage Mirna', 'url'=>array('admin')),
	array('label'=>'Check Mirna', 'url'=>array('check')),
);
?>

<h1>Mirnas</h1>

<div id="_view">
<h4>
<table>
<tr>
<td><b>ID</b></td>
<td><b>miRNA ID</b></td>
<td><b>Accession</b></td>
<td><b>Organsim</b></td>
</tr>
</h4>
</table>
</div>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
