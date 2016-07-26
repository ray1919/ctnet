<noscript><link rel="stylesheet" href="/~zhaorui/ctnet/css/fileupload/jquery.fileupload-noscript.css"></noscript>
<noscript><link rel="stylesheet" href="/~zhaorui/ctnet/css/fileupload/jquery.fileupload-ui-noscript.css"></noscript>

<?php
/* @var $this PrimerController */
/* @var $dataProvider */

$this->breadcrumbs=array(
        'Report ' . $model->id=>array('view', 'id'=>$model->id),
        '上传实验数据',
);

$this->menu=array(
        array('label'=>'List Report', 'url'=>array('index')),
        array('label'=>'Manage Report', 'url'=>array('admin')),
);

?>
<!-- The file upload form used as target for the file upload widget -->
<form id="fileupload" action="/~zhaorui/ctnet/scripts/fileupload/server/" method="POST" enctype="multipart/form-data">
    <!-- Redirect browsers with JavaScript disabled to the origin page -->
    <noscript><input type="hidden" name="redirect" value="https://blueimp.github.io/jQuery-File-Upload/"></noscript>
    <!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
    <div class="fileupload-buttonbar">
        <div class="fileupload-buttons">
            <!-- The fileinput-button span is used to style the file input field as button -->
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


    <link rel="stylesheet" href="/~zhaorui/ctnet/scripts/progress/progress.css" type="text/css">
<script>
  $(function() {
    $( "#Report_sample" ).selectmenu({
      width: 260
    });
    $( "#resizable" ).resizable({
      handles: "se",
    });
  });
  function curve(name){
    var run_id = $('select[name="Report[sample]"]').val();
    var poss = $('#resizable').val();
    ifrm = document.createElement("IFRAME");
    ifrm.setAttribute("src", "/~zhaorui/ctnet/scripts/progress/pcr_curve.php?rid=<?php echo $model->id; ?>&type="+name+"&run="+run_id+"&poss="+poss); 
    ifrm.style.width = 0+"px"; 
    ifrm.style.height = 0+"px"; 
    ifrm.style.border = 0; 
    document.body.appendChild(ifrm); 
  }
  function stream(name){
      ifrm = document.createElement("IFRAME"); 
      ifrm.setAttribute("src", "/~zhaorui/ctnet/scripts/progress/pcr_service.php?rid=<?php echo $model->id; ?>&type="+name); 
      ifrm.style.width = 0+"px"; 
      ifrm.style.height = 0+"px"; 
      ifrm.style.border = 0; 
      document.body.appendChild(ifrm); 
      $(".my-btn, .my-btn2").attr('onclick', '');
      $(".my-btn")[0].style.color='gray';
      $(".my-btn2")[0].style.color='gray';
  }
  var timestamp = +new Date;
  var logfile = '/~zhaorui/ctnet/scripts/fileupload/server/files/<?php echo $model->id; ?>/.log?t=' + timestamp;
  $.ajax({
      url:logfile,
      type:'HEAD',
      error: function()
      {
          //file not exists
      },
      success: function()
      {
          //file exists
          $("#divProgress").load(logfile);
      }
  });
  $(document).ready(function(){
    $("#tip").hide();
    $("#help").click(function(){
        $("#tip").toggle(1111);
    });
  });
</script>

    <div id="imageBox">
    </div>
    <div>
      <a class="isa_info" id="help">请先阅读使用说明</a>
      <div id="tip">
        <h2 style="font-style:italic;">实验报告数据上传使用说明</h2>

        <ol>
          <li>在创建并填写保存完实验报告后，在实验报告页面右侧点击&ldquo;Upload Data&rdquo;&lsquo;；</li>
          <li>PCR服务实验报告需要上传所有PCR实验（罗氏LC480）导出的CT文件、TM文件和实验原始数据(Experiment Data)，及PCR服务信息（填写参考Excel模板，<a href="/~zhaorui/ctnet/scripts/fileupload/server/files/PCR_Layout_Template.xlsx">点击此处下载</a>）；</li>
          <li>技术重复的样本用-1, -2, -3...来表示。数据分析前，会将通过质检的技术重复取CT平均值做下一步比较：</li>
          <li>验证实验及体系开发只需要上传所有PCR实验（罗氏LC480）导出的CT文件、TM文件和实验原始数据；</li>
          <li>导出的CT文件、TM文件孔位对应，文件命名没有要求，每张芯片仅能有1个CT文件和1个TM文件；</li>
          <li>正确上传后点击下方&ldquo;分析PCR服务（实验）数据&rdquo;，分析开始。右侧分析记录逐行显示运行记录，直至运行完毕；</li>
          <li>若分析过程出错，分析记录显示红色错误提示，分析停止，需要找到错误原因，重新分析；</li>
          <li>成功完成分析后，刷新页面，分析记录任然保留，文件列表中新增&ldquo;workbook.xlsx&rdquo;文件，点击下载；</li>
          <li>同时可以点击溶解曲线/扩增曲线，对指定孔位进行作图。</li>
        </ol>
      </div>
    </div>
    <div class='float_left'>
        <div id='progress_wrapper'>
            <div id="progressor"></div>
        </div>
        <?php
          if ( $model->type == '服务' ) {
            echo '<a onclick=stream("service"); class="my-btn">分析PCR服务数据</a>';
          } else {
            echo '<a onclick=stream("dev"); class="my-btn">分析PCR实验数据</a>';
          }
        ?>
        <div class="form">
        <?php $form=$this->beginWidget('CActiveForm', array(
        	'id'=>'position-form',
        	'enableAjaxValidation'=>false,
        )); ?>
        	<?php echo $form->errorSummary($model); ?>
            <span>Run Name:</span>
        	<div class="row">
            <?php echo $form->dropDownList($model,'sample', $model->getRunNames($model->id)); ?>
        	</div>
            <span>孔位 (A1,A2...):</span>
        	<div class="row">
            <textarea id="resizable" name="positions" rows="1">A1</textarea>
        	</div>
        <?php $this->endWidget(); ?>
        </div><!-- form -->
        <a onclick="curve('temp');" class='my-btn2'>溶解曲线</a>

        <a onclick="curve('cycle');" class='my-btn3'>扩增曲线</a>
    </div>
    <div class='float_left'>
        <h4 align="right">分析记录</h4>
        <div id="divProgress"></div>
    </div>
