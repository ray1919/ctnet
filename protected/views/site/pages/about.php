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
<table id="table_id">
    <thead>
        <tr>
            <th>Catagory</th>
            <th>Name</th>
            <th>URL</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>a wiki investigating human genetics</td>
            <td>SNPedia</td>
            <td><a href="http://www.snpedia.com/" target="_blank">http://www.snpedia.com/</a></td>
        </tr>
        <tr>
            <td>The Human Gene Mutation Database</td>
            <td>HGMD</td>
            <td><a href="http://www.hgmd.cf.ac.uk/" target="_blank">http://www.hgmd.cf.ac.uk/</a></td>
        </tr>
        <tr>
            <td>The human disease database</td>
            <td>MalaCards</td>
            <td><a href="http://www.malacards.org/" target="_blank">http://www.malacards.org/</a></td>
        </tr>
        <tr>
            <td>SNP regulatory annotation DB</td>
            <td>RegulomeDB</td>
            <td><a href="http://regulome.stanford.edu/" target="_blank">http://regulome.stanford.edu/</a></td>
        </tr>
        <tr>
            <td>miRNA target prediction and functional annotations</td>
            <td>miRDB</td>
            <td><a href="http://mirdb.org/miRDB/" target="_blank">http://mirdb.org/miRDB/</a></td>
        </tr>
        <tr>
            <td>Predicted microRNA targets & target downregulation scores</td>
            <td>miRanda</td>
            <td><a href="http://www.microrna.org/microrna/home.do" target="_blank">http://www.microrna.org/microrna/home.do</a></td>
        </tr>
        <tr>
            <td>MicroRNA target prediction tools</td>
            <td>Catalog</td>
            <td><a href="http://www.exiqon.com/microrna-target-prediction" target="_blank">http://www.exiqon.com/microrna-target-prediction</a></td>
        </tr>
        <tr>
            <td>microRNA target detection</td>
            <td>RNA22</td>
            <td><a href="https://cm.jefferson.edu/rna22v2/" target="_blank">https://cm.jefferson.edu/rna22v2/</a></td>
        </tr>
    </tbody>
</table>
<div id="holder"></div>
<div id="example"></div>
