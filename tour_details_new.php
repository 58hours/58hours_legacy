<?php require_once('Connections/radioRecords.php'); ?>
<?php

if(empty($_GET['tour'])) header("location: index.php");

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


$colname_justTourName = "1";
if (isset($HTTP_GET_VARS['tour'])) {
  $colname_justTourName = (get_magic_quotes_gpc()) ? $HTTP_GET_VARS['tour'] : addslashes($HTTP_GET_VARS['tour']);
}
mysql_select_db($database_radioRecords, $radioRecords);
$query_justTourName = sprintf("SELECT tourresolver.tourName, tourresolver.tourID FROM showlist_db, tourresolver WHERE showlist_db.show_tour = tourresolver.tourID AND tourresolver.tourID = %s", $colname_justTourName);
$justTourName = mysql_query($query_justTourName, $radioRecords) or die(mysql_error());
$row_justTourName = mysql_fetch_assoc($justTourName);
$totalRows_justTourName = mysql_num_rows($justTourName);



$colname_tourDetails = "1";
if (isset($HTTP_GET_VARS['tour'])) {
  $colname_tourDetails = (get_magic_quotes_gpc()) ? $HTTP_GET_VARS['tour'] : addslashes($HTTP_GET_VARS['tour']);
}
mysql_select_db($database_radioRecords, $radioRecords);
$query_tourDetails = sprintf("SELECT tourresolver.tourName, countryresolver.countryName, countryresolver.countryID, localityresolver.localityName, localityresolver.localityID, cityresolver.cityName, cityresolver.cityID, venuedetails.venueName, showlist_db.showID, venuedetails.venueID, showlist_db.showDate FROM showlist_db, tourresolver, venuedetails, cityresolver, localityresolver, countryresolver WHERE cityresolver.localityID = localityresolver.localityID AND localityresolver.countryID = countryresolver.countryID AND venuedetails.venueCity = cityresolver.cityID AND venuedetails.venueID = showlist_db.showVenueID AND showlist_db.show_tour = tourresolver.tourID AND tourresolver.tourID = %s ORDER BY showlist_db.showDate DESC", $colname_tourDetails);
$tourDetails = mysql_query($query_tourDetails, $radioRecords) or die(mysql_error());
//$row_tourDetails = mysql_fetch_assoc($tourDetails);
$totalRows_tourDetails = mysql_num_rows($tourDetails);


$colname_tourtuneDetails = "1";
if (isset($HTTP_GET_VARS['tour'])) {
  $colname_tourtuneDetails = (get_magic_quotes_gpc()) ? $HTTP_GET_VARS['tour'] : addslashes($HTTP_GET_VARS['tour']);
}
mysql_select_db($database_radioRecords, $radioRecords);
$query_tourtuneDetails = sprintf("SELECT titleresolver.trackID, COUNT(*) AS perfTimes, titleresolver.trackTitle FROM showlist_db, livetracks_db, titleresolver, tourresolver WHERE livetracks_db.showID = showlist_db.showID AND titleresolver.trackID = livetracks_db.trackID AND showlist_db.show_tour = tourresolver.tourID AND tourresolver.tourID = %s GROUP BY titleresolver.trackID ORDER BY perfTimes DESC", $colname_tourtuneDetails);
$tourtuneDetails = mysql_query($query_tourtuneDetails, $radioRecords) or die(mysql_error());
//$row_tourtuneDetails = mysql_fetch_assoc($tourtuneDetails);
$totalRows_tourtuneDetails = mysql_num_rows($tourtuneDetails);

$colname_tourmissingDetails = "1";
if (isset($HTTP_GET_VARS['tour'])) {
  $colname_tourmissingDetails = (get_magic_quotes_gpc()) ? $HTTP_GET_VARS['tour'] : addslashes($HTTP_GET_VARS['tour']);
}
mysql_select_db($database_radioRecords, $radioRecords);
$query_tourmissingDetails = sprintf("SELECT DISTINCT titleresolver.trackName, titleresolver.trackID FROM (SELECT DISTINCT livetracks_db.trackID FROM showlist_db, livetracks_db, tourresolver WHERE livetracks_db.showID = showlist_db.showID AND showlist_db.show_tour = %s) AS preqID, titleresolver, tourresolver, livetracks_db, showlist_db WHERE preqID.trackID != titleresolver.trackID AND livetracks_db.showID = showlist_db.showID AND showlist_db.show_tour = tourresolver.prior_tour AND tourresolver.tourID = %s ORDER BY titlereolver.trackName DESC;", $colname_tourmissingDetails, $row_justTourName['tourID']);
$tourmissingDetails = mysql_query($query_tourmissingDetails, $radioRecords) or die(mysql_error());
//$row_tourmemberDetails = mysql_fetch_assoc($tourmemberDetails);
$totalRows_tourmissingDetails = mysql_num_rows($tourmissingDetails);


$colname_tourmemberDetails = "1";
if (isset($HTTP_GET_VARS['tour'])) {
  $colname_tourmemberDetails = (get_magic_quotes_gpc()) ? $HTTP_GET_VARS['tour'] : addslashes($HTTP_GET_VARS['tour']);
}
mysql_select_db($database_radioRecords, $radioRecords);
$query_tourmemberDetails = sprintf("SELECT tourresolver.tourName, countryresolver.countryName, countryresolver.countryID, localityresolver.localityName, localityresolver.localityID, cityresolver.cityName, cityresolver.cityID, venuedetails.venueName, showlist_db.showID, venuedetails.venueID, showlist_db.showDate FROM showlist_db, tourresolver, venuedetails, cityresolver, localityresolver, countryresolver WHERE cityresolver.localityID = localityresolver.localityID AND localityresolver.countryID = countryresolver.countryID AND venuedetails.venueCity = cityresolver.cityID AND venuedetails.venueID = showlist_db.showVenueID AND showlist_db.show_tour = tourresolver.tourID AND tourresolver.tourID = %s", $colname_tourmemberDetails);
$tourmemberDetails = mysql_query($query_tourmemberDetails, $radioRecords) or die(mysql_error());
//$row_tourmemberDetails = mysql_fetch_assoc($tourmemberDetails);
$totalRows_tourmemberDetails = mysql_num_rows($tourmemberDetails);

?>
<?php echo "<?xml version=\"1.0\" encoding=\"iso-8859-1\"?".">"; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>58hours.com |  Radiohead Tour Details for <?php echo $row_justTourName['tourName']; ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/styles.css" rel="stylesheet" type="text/css" />
<script language="JavaScript" type="text/JavaScript">
<!--
function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}
//-->
</script>
<style type="text/css">
<!--
.primaryStyle {
	color: #FFFFFF;
	font-family: Arial, Helvetica, sans-serif;
	font-size: 10px;
	text-decoration: none;
	A:link {text-decoration: none};
	A:visited {text-decoration: none};
	A:active {text-decoration: none};
	A:hover {text-decoration: underline; color: white;};
}
.style4 {color: #666666; text-decoration: none; font-family: Arial, Helvetica, sans-serif;}
-->
</style>
</head>

<body bgcolor="#000000" text="#FFFFFF" link="#0066CC" vlink="#0066CC" alink="#0066CC" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" class="blueishlinks">
<br />
<table width="800" border="0" align="center" cellpadding="1" cellspacing="1" bgcolor="#FFFFFF">
  <tr>
    <td>
		<table width="800" border="0" align="center" cellpadding="5" cellspacing="0" bgcolor="#FFFFFF">
    		<tr>
      			<td colspan="2" bgcolor="#000033" class="darkerLinkage"><a href="/"><img src="../images/58hrs_header_taller.jpg" border="0"></a></td>
    		</tr>
			<tr>
				<td align="right" valign="top" bgcolor="#000033">
					<table width="100%">
						<tr>
          					<td align="left"></td>
          					<td align="right" valign="bottom">&nbsp;</td>
        				</tr>
        			</table>
        		</td>
        		<td align="right" valign="top" bgcolor="#000033"></td>
			</tr>
    		<tr>
      			<td colspan="2" bgcolor="#000033">
      				<table width="100%" border="0" cellspacing="0" cellpadding="1">
          				<tr> 
            				<td width="700" height="72" valign="top">
            					<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0" width="300" height="30">
              <param name="movie" value="flash_elements/trackNameSmall.swf?name=Tour%20Details" />
              <param name="quality" value="high" />
              <embed src="flash_elements/trackNameSmall.swf?name=Tour%20Details" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="300" height="30"></embed>
            </object>
              <br />
              <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0" width="300" height="30">
              <param name="movie" value="flash_elements/trackNameSmall.swf?name=<?php echo urlencode($row_justTourName['tourName']); ?>" />
              <param name="quality" value="high" />
              <embed src="flash_elements/trackNameSmall.swf?name=<?php echo urlencode($row_justTourName['tourName']); ?>" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="300" height="30"></embed>
            </object>
              <br>
			  <br>  
			  <table width="700" border="0" cellspacing="1" cellpadding="1">
                <tr>
                  <td></td>
                </tr>
                <tr>
                	<td valign="top" class="primaryStyle"><h3>Shows played on this tour:</h3><h1> <? echo $totalRows_tourDetails; ?></h1><br />
                		<? 
                		while($tourRow = mysql_fetch_assoc($tourDetails))
                		{
                			echo "<a href='./58_displayshow.php?showID=".$tourRow['showID']."'>[>>]</a> ".$tourRow['showDate']."<br>";
                			echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$tourRow['venueName']."<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(".$tourRow['cityName']." -  ".$tourRow['countryName'].")<br><br>";
                		} 
                		?>
                	</td>
                	<td valign="top" class="primaryStyle"><h3>Songs played on this tour:</h3><h1><? echo $totalRows_tourtuneDetails; ?></h1><br />(sorted by frequency)<br /><br />
                		<? 
                		while($tourRow = mysql_fetch_assoc($tourtuneDetails))
                		{
                			echo "<a href='./58_trackDetails.php?trackID=".$tourRow['trackID']."'>[>>]</a> ".$tourRow['trackTitle']." (".$tourRow['perfTimes'].") <font color='#666666'>(".number_format (($tourRow['perfTimes']/$totalRows_tourDetails)*100, 2)."%)</font> <br>";
                		} 
                		?>
                	</td>
                	
                	<td valign="top" class="primaryStyle"><h3>Songs played last tour, but now missing:</h3><h1><? echo $totalRows_tourtuneDetails; ?></h1><br />(sorted by frequency)<br /><br />
                		<? 
                		while($tourRow = mysql_fetch_assoc($tourtuneDetails))
                		{
                			echo "<a href='./58_trackDetails.php?trackID=".$tourRow['trackID']."'>[>>]</a> ".$tourRow['trackTitle']." (".$tourRow['perfTimes'].") <font color='#666666'>(".number_format (($tourRow['perfTimes']/$totalRows_tourDetails)*100, 2)."%)</font> <br>";
                		} 
                		?>
                	</td>

                </tr>
              </table>
              
              </tr>
            </table></td>
          </tr>
  </table>
  </td>
    </tr>
    <tr bgcolor="#333366"><td colspan="2"><font color="#FFFFFF"><?php require_once('58ss_includes/58disclaimer.php'); ?></font></td></tr>
  </table>
	</td>
  </tr>
</table>
</body>
</html>
<?php
mysql_free_result($justTourName);
mysql_free_result($tourDetails);
mysql_free_result($tourtuneDetails);
mysql_free_result($tourmissingDetails);
mysql_free_result($tourmemberDetails);


?>
