<?php
set_time_limit(0); 
ob_implicit_flush(true);
ob_end_flush();

function pipe_exec($cmd, $input='') {
    $proc = proc_open($cmd, array(array('pipe', 'r'),
                                  array('pipe', 'w'),
                                  array('pipe', 'w')), $pipes);
    fwrite($pipes[0], $input);
    fclose($pipes[0]);
 
    $stdout = stream_get_contents($pipes[1]);
    fclose($pipes[1]);
 
    $stderr = stream_get_contents($pipes[2]);
    fclose($pipes[2]);
 
    $return_code = (int)proc_close($proc);
 
    return array($return_code, $stdout, $stderr);
}

$baseDir="/home/zhaorui/public_html/ctnet/scripts/progress/";

$report_id = $_GET['rid'];
$type = $_GET['type'];
$wd = "/home/zhaorui/public_html/ctnet/scripts/fileupload/server/files/$report_id/";
$message = "<span class='isa_info'>开始分析PCR实验数据...(预计需要数分钟，请不要刷新网页或重复点击按钮)</span>";
file_put_contents("$wd.log", $message . "<br />");

$progress = 0;
    echo '<script type="text/javascript">window.parent.document.getElementById("divProgress").innerHTML = "'.$message.'" + "<br />";window.parent.document.getElementById("progressor").style.width = "'.$progress.'" + "%";</script>';

function pcr_step($script,$pifsuc) {
  global $baseDir;
  global $wd;
  global $report_id;
  list($return_code, $stdout, $stderr) = pipe_exec("Rscript --save $baseDir/$script $wd $report_id");
  $stdout = preg_replace('/\[1\] "(.*)"/','$1',$stdout);
  if (!$return_code) {
    $progress = $pifsuc;
    $message = "<span class='isa_success'>$stdout</span><span class='isa_info'>$progress% complete. server time: " . date("H:i:s Ymd", time()) . "</span>";
  } else {
    $progress = $pifsuc - 10;
    $message = "<span class='isa_success'>$stdout</span> <span class='isa_error'> $stderr </span> <span class='isa_info'>$progress% complete. server time: " . date("H:i:s Ymd", time()) . "</span>";
  }
  $message = preg_replace('/\"/', "'", $message);
  $message = preg_replace('/\n/', "<br />", $message);
  file_put_contents("$wd.log", $message . "<br />", FILE_APPEND);

  echo '<script type="text/javascript">window.parent.document.getElementById("divProgress").innerHTML += "'.$message.'" + "<br />";window.parent.document.getElementById("progressor").style.width = "'.$progress.'" + "%";</script>';
  return $return_code;
}

if ($type == 'service') {
  $scripts = array(10 => 'pcr_step1.R', 30 => 'pcr_step2.R',40 => 'pcr_step3.R',
                50 => 'pcr_step4.R', 70 => 'pcr_step5.R', 100 => 'pcr_step6.R');
} else if ($type == 'dev') {
  $scripts = array(50 => 'dev_step1.R', 100 => 'dev_step2.R');
}

foreach ($scripts as $p => $script) {
  if (pcr_step($script, $p))
    break;
}

