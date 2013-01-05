<?php
/* @var $this PrimerController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Primers',
);

$this->menu=array(
	array('label'=>'Create Primer', 'url'=>array('create')),
	array('label'=>'Manage Primer', 'url'=>array('admin')),
);
?>

<h1>Primers</h1>
<div id="_view">
<h4>
<table>
<tr>
<td><b>Gene Symbol</b></td>
<td><b>Gene ID</b></td>
<td><b>Primer ID</b></td>
<td><b>Barcode</b></td>
<td><b>Organism</b></td>
<td><b>Type</b></td>
</tr>
</h4>
</table>
</div>


<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
