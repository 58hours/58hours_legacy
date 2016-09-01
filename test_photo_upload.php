<?php echo "<?xml version=\"1.0\" encoding=\"iso-8859-1\"?".">"; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>58hours.com |  photo upload</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="../css/styles.css" rel="stylesheet" type="text/css" />
<style type="text/css"> 
body 
{ 
background-image: url('images/bgstripes.gif'); 
} 
</style>
</head>
<body>
<div id="maincontainer" align="center" width="800" style="darkLinkage">
	<div id="upload_centre" align="left" width="500">
	<form enctype="multipart/form-data" action="ops/process_photo.php" method="POST">
    <!-- MAX_FILE_SIZE must precede the file input field -->
    <input type="hidden" name="MAX_FILE_SIZE" value="30000" />
    <!-- Name of input element determines name in $_FILES array -->
    Photo: <input name="userfile" type="file" /><br />
    <input type="submit" value="Upload" />
</form>
<?

?>
	inside of the div
	</div>
	outside of the div
</div>
</body>
</html>