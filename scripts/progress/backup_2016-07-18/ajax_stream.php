<?php
set_time_limit(0); 
ob_implicit_flush(true);
ob_end_flush();

for($i = 0; $i < 10; $i++){
    //Hard work!!
    sleep(1);
    $p = ($i+1)*10; //Progress
    $message = $p . '% complete. server time: ' . date("h:i:s", time());
    $progress = $p;

    echo '<script type="text/javascript">window.parent.document.getElementById("divProgress").innerHTML += "'.$message.'" + "<br />";window.parent.document.getElementById("progressor").style.width = "'.$progress.'" + "%";</script>';
}

sleep(1);
$message = 'Complete';
$progress = 100;

echo '<script type="text/javascript">window.parent.document.getElementById("divProgress").innerHTML += "'.$message.'" + "<br />";window.parent.document.getElementById("progressor").style.width = "'.$progress.'" + "%";</script>';

?>
