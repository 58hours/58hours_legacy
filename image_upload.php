<?php
if ($_FILES['Filedata']['name']) {
   $uploadDir = "/home/httpd/vhosts/58hours.com/httpdocs/uploaded_images/";
   $fPrefic = md5($_REQUEST['guid']);
   $uploadFile = $uploadDir . $fPrefic . "_" . basename($_FILES['Filedata']['name']);
   move_uploaded_file($_FILES['Filedata']['tmp_name'], $uploadFile);
   chmod($uploadFile, 0644);
   exit;
}
?>