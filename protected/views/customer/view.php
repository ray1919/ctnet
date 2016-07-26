<noscript><link rel="stylesheet" href="/~zhaorui/ctnet/css/fileupload/jquery.fileupload-noscript.css"></noscript>
<noscript><link rel="stylesheet" href="/~zhaorui/ctnet/css/fileupload/jquery.fileupload-ui-noscript.css"></noscript>

<?php
/* @var $this CustomerController */
/* @var $model Customer */

$this->breadcrumbs=array(
	'Contacts'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List Contact', 'url'=>array('index')),
	array('label'=>'Create Contact', 'url'=>array('create')),
	array('label'=>'Update Contact', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Contact', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Contact', 'url'=>array('admin')),
        array('label'=>'Create Communication', 'url'=>array('visit/create', 'customer_id'=>$model->id)),
        array('label'=>'Create Order', 'url'=>array('CustomerOrder/create', 'customer_id'=>$model->id)),
        array('label'=>'Create PCR Service', 'url'=>array('PCRService/create', 'customer_id'=>$model->id)),
);
?>

<h1>View Contact #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'title',
		'name',
		'tel1',
		'tel2',
		'tel3',
		'email',
		'IM',
		'address',
		'organization',
                'source',
                'add_date',
		'comment',
	),
)); ?>

<br />
<h1>Communication</h1>
<?php $this->widget('zii.widgets.CListView', array(
    'dataProvider'=>$visitDataProvider,
    'itemView'=>'/visit/_view',
)); ?>

<br />
<h1>Orders</h1>
<?php $this->widget('zii.widgets.CListView', array(
    'dataProvider'=>$orderDataProvider,
    'itemView'=>'/customerOrder/_view',
)); ?>

<br />
<h1>PCR Service</h1>
<?php $this->widget('zii.widgets.CListView', array(
    'dataProvider'=>$serviceDataProvider,
    'itemView'=>'/pCRService/_view',
  )); 
?>

<!-- The file upload form used as target for the file upload widget -->
<form id="fileupload" action="/~zhaorui/ctnet/scripts/fileupload/serverC/" method="POST" enctype="multipart/form-data">
    <!-- Redirect browsers with JavaScript disabled to the origin page -->
    <noscript><input type="hidden" name="redirect" value="https://blueimp.github.io/jQuery-File-Upload/"></noscript>
    <!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
    <div class="fileupload-buttonbar">
        <div class="fileupload-buttons">
            <!-- The fileinput-button span is used to style the file input field as button -->
            <param name="encoding" value="UTF8">
            <span class="fileinput-button">
                <span>添加文件</span>
                <input type="file" name="files[]" multiple>
            </span>
            <button type="submit" class="start">开始上传</button>
            <button type="reset" class="cancel">取消上传</button>
            <button type="button" class="delete">删除选定文件</button>
            <input type="checkbox" class="toggle">
            <!-- The global file processing state -->
            <span class="fileupload-process"></span>
        </div>
        <!-- The global progress state -->
        <div class="fileupload-progress fade" style="display:none">
            <!-- The global progress bar -->
            <div class="progress" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
            <!-- The extended global progress state -->
            <div class="progress-extended">&nbsp;</div>
        </div>
    </div>
    <!-- The table listing the files available for upload/download -->
    <table role="presentation"><tbody class="files"></tbody></table>
</form>
<br>
<!-- The blueimp Gallery widget -->
<div id="blueimp-gallery" class="blueimp-gallery blueimp-gallery-controls" data-filter=":even">
    <div class="slides"></div>
    <h3 class="title"></h3>
    <a class="prev">‹</a>
    <a class="next">›</a>
    <a class="close">×</a>
    <a class="play-pause"></a>
    <ol class="indicator"></ol>
</div>
<!-- The template to display files available for upload -->
<script id="template-upload" type="text/x-tmpl">
{% for (var i=0, file; file=o.files[i]; i++) { %}
    <tr class="template-upload fade">
        <td>
            <span class="preview"></span>
        </td>
        <td>
            <p class="name">{%=file.name%}</p>
            <strong class="error"></strong>
        </td>
        <td>
            <p class="size">Processing...</p>
            <div class="progress"></div>
        </td>
        <td>
            {% if (!i && !o.options.autoUpload) { %}
                <button class="start" disabled>Start</button>
            {% } %}
            {% if (!i) { %}
                <button class="cancel">Cancel</button>
            {% } %}
        </td>
    </tr>
{% } %}
</script>
<!-- The template to display files available for download -->
<script id="template-download" type="text/x-tmpl">
{% for (var i=0, file; file=o.files[i]; i++) { %}
    <tr class="template-download fade">
        <td>
            <span class="preview">
                {% if (file.thumbnailUrl) { %}
                    <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" data-gallery><img src="{%=file.thumbnailUrl%}"></a>
                {% } %}
            </span>
        </td>
        <td>
            <p class="name">
                <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" {%=file.thumbnailUrl?'data-gallery':''%}>{%=file.name%}</a>
            </p>
            {% if (file.error) { %}
                <div><span class="error">Error</span> {%=file.error%}</div>
            {% } %}
        </td>
        <td>
            <span class="size">{%=o.formatFileSize(file.size)%}</span>
        </td>
        <td>
            <button class="delete" data-type="{%=file.deleteType%}" data-url="{%=file.deleteUrl%}"{% if (file.deleteWithCredentials) { %} data-xhr-fields='{"withCredentials":true}'{% } %}>删除</button>
            <input type="checkbox" name="delete" value="1" class="toggle">
        </td>
    </tr>
{% } %}
</script>


