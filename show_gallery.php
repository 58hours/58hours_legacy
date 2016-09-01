<?php require_once('Connections/radioRecords.php'); ?>
<?php

// preprocess our showID
$internalShowID = $_GET['showID'];
if( number_format($internalShowID)!=$internalShowID) header("location: http://58hours.com");


function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  $theValue = (!get_magic_quotes_gpc()) ? addslashes($theValue) : $theValue;

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? "'" . doubleval($theValue) . "'" : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}

$colname_showDetails = "1";
if (isset($HTTP_GET_VARS['showID'])) {
  $colname_showDetails = (get_magic_quotes_gpc()) ? $HTTP_GET_VARS['showID'] : addslashes($HTTP_GET_VARS['showID']);
}
mysql_select_db($database_radioRecords, $radioRecords);
$query_showDetails = sprintf("SELECT showlist_db.showEventName, showlist_db.show_tour, showlist_db.showSupport1, showlist_db.showComments, countryresolver.countryName, countryresolver.countryID, localityresolver.localityName, localityresolver.localityID, cityresolver.cityName, cityresolver.cityID, venuedetails.venueName, showlist_db.showID, venuedetails.venueID, showlist_db.showDate FROM showlist_db, tourresolver, venuedetails, cityresolver, localityresolver, countryresolver WHERE cityresolver.localityID = localityresolver.localityID AND localityresolver.countryID = countryresolver.countryID AND venuedetails.venueCity = cityresolver.cityID AND venuedetails.venueID = showlist_db.showVenueID AND showlist_db.showID = %s", $colname_showDetails);
$showDetails = mysql_query($query_showDetails, $radioRecords) or die(mysql_error());
$row_showDetails = mysql_fetch_assoc($showDetails);
$totalRows_showDetails = mysql_num_rows($showDetails);


$colname_perfID = "9999";
if (isset($HTTP_GET_VARS['showID'])) {
  $colname_perfID = (get_magic_quotes_gpc()) ? $HTTP_GET_VARS['showID'] : addslashes($HTTP_GET_VARS['showID']);
}

mysql_select_db($database_radioRecords, $radioRecords);
$query_perfImages = sprintf("SELECT * FROM galleryBin, 58_members WHERE galleryBin.posterID = 58_members.pn_uid AND galleryBin.showID = %s", $colname_perfID);
$perfImages = mysql_query($query_perfImages, $radioRecords) or die(mysql_error());
$row_perfImages = mysql_fetch_assoc($perfImages);
$totalRows_perfImages = mysql_num_rows($perfImages);




?>
<html>
<head>
<title>58hours.com |  User images submitted for <?php echo date('l, F d, Y',strtotime($row_showDetails['showDate'])); ?> (<?php echo $row_showDetails['venueName']; ?>)
</title>

<style type="text/css">
<!--
.style3 {
	color: #FFFFFF;
	font-style: italic;
	font-family: Arial, Helvetica, sans-serif;
	font-size: 10px;
}
.style4 {color: #666666; text-decoration: none; font-family: Arial, Helvetica, sans-serif;}
-->
</style>
<script language="javascript">

function showImage(targetImage)
{
	window.open(targetImage, "_gallerywin");
}

</script>

</head>
<body bgcolor="#000000" text="#FFFFFF" link="#0066CC" vlink="#0066CC" alink="#0066CC" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" class="blueishlinks">
<br />
<table width="454" border="0" align="center" cellpadding="1" cellspacing="0" bgcolor="#FFFFFF">
<tr><td>
<table width="454" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#000033">
<tr><td>

<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0" width="300" height="30">
              <param name="movie" value="flash_elements/trackName.swf" />
              <param name="quality" value="high" />
			  <param name="flashVars" value="name=IMAGES:%20<?php echo urlencode($row_showDetails['venueName']); ?>" />
              <embed src="flash_elements/trackName.swf" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="300" height="30" flashVars="name=IMAGES:%20<?php echo urlencode($row_showDetails['venueName']); ?>"></embed>
            </object>
              <br />

<?php



 if($totalRows_perfImages != 0) {?><tr>
                <td width="454"><img src="images/showimages-wide.gif" width="450" height="13" /></td>
              </tr>
			  <tr>
			  <td>
			  <table width="450" border="0" cellspacing="0" cellpadding="0">
                       <tr>
                         <td>
						 <table width="450" border="0" cellspacing="1" cellpadding="0">
                           <tr><?php $iRow=0; do { ?>
						   <?php if (($iRow%3==0)&&($iRow!=0)) echo "</tr><tr>" ?>
                             <td width="100" valign="bottom"><div align="center"><a href="javascript:showImage('<? echo $row_perfImages['photoLoc']?>');" border="0"><img src="<?php echo $row_perfImages['photoTbLoc']; ?>"></a><br></div><div align="left"><font class="style3"><?php echo $row_perfImages['timestamp_ed']; ?><br>from: <?php echo $row_perfImages['pn_uname']; ?></font></div></td>
                           <?php $iRow++;} while ($row_perfImages = mysql_fetch_assoc($perfImages)); ?></tr>
<tr><td colspan="3" class="style3"></td><a href="image_upload.php">[SUBMIT PHOTO]</a></td></tr>
                         </table>
                           </td>
                       </tr>
                     </table>
					 
					 </td>
              </tr><?php } ?>
</td></tr></table></td></tr></table></td></tr></table>
</body>
</html>