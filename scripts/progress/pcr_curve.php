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
$run_id = $_GET['run'];
$type = $_GET['type'];
$poss = $_GET['poss'];
if (!is_numeric($run_id) or $poss == "") {
  exit;
}
$wd = "/home/zhaorui/public_html/ctnet/scripts/fileupload/server/files/$report_id/";


function pcr_curve($name,$wd,$run_id,$poss, $report_id) {
  global $baseDir;
  list($return_code, $stdout, $stderr) = pipe_exec("Rscript --save $baseDir/pcr_$name.R $wd $run_id $poss");
  $stdout = preg_replace('/\[1\] "(.*)"/','$1',$stdout);
  if (!$return_code) {
    $nocache = rand();
    echo '<script type="text/javascript">window.parent.document.getElementById("imageBox").innerHTML = "<img src=\'' . "/~zhaorui/ctnet/scripts/fileupload/server/files/$report_id/cycle.png?$nocache" . '\'>";</script>';
  } else {
    $message = "<span class='isa_success'>$stdout</span> <span class='isa_error'> $stderr </span> <span class='isa_info'>server time: " . date("H:i:s Ymd", time()) . "</span>";
    $message = preg_replace('/\"/', "'", $message);
    $message = preg_replace('/\n/', "<br />", $message);

    echo '<script type="text/javascript">window.parent.document.getElementById("divProgress").innerHTML = "'.$message.'" + "<br />";</script>';
  }
  return $return_code;
}

pcr_curve($type, $wd, $run_id, $poss, $report_id);


