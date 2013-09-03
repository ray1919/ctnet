<?php
/* @var $this PositionController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Positions',
);

$this->menu=array(
	array('label'=>'Manage Position', 'url'=>array('admin')),
	array('label'=>'Check Primer', 'url'=>array('primer/check')),
);
?>

<h1>Positions</h1>

<div id="_view">
<h4>
<table>
<tr>
<td><b>Plate</b></td>
<td><b>Well</b></td>
<td><b>Gene Symbol</b></td>
<td><b>Gene ID</b></td>
<td><b>Primer ID</b></td>
<td><b>Store Type</b></td>
</tr>
</h4>
</table>
</div>
<?php
  $dataProvider->pagination->pageSize=20;
  $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
