<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name . ' - About';
$this->breadcrumbs=array(
	'About',
);
?>
<h1>About</h1>

<p>This is a local website of CTBioscience.</p>

<?php
  $baseUrl = Yii::app()->baseUrl; 
  $cs = Yii::app()->getClientScript();
  $cs->registerScriptFile($baseUrl.'/scripts/raphael.js');
  $cs->registerScriptFile($baseUrl.'/scripts/graffle.js');
?>
<div id="holder"></div>
<div id="example"></div>
<table id="table_id">
    <thead>
        <tr>
            <th>Column 1</th>
            <th>Column 2</th>
            <th>etc</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Row 1 Data 1</td>
            <td>Row 1 Data 2</td>
            <td>etc</td>
        </tr>
        <tr>
            <td>Row 2 Data 1</td>
            <td>Row 2 Data 2</td>
            <td>etc</td>
        </tr>
    </tbody>
</table>
