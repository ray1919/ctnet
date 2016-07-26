<?php
if(!empty($_POST['data'])){
  $data = $_POST['data'];
  $fname = mktime() . ".txt";//generates random name

  $file = fopen("/home/zhaorui/public_html/ctnet/scripts/fileupload/server/files/31/" .$fname, 'w');//creates new file
  fwrite($file, $data);
  fclose($file);
}
?>
