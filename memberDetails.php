<?php require_once('Connections/radioRecords.php'); ?>
<?php
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

if (($_COOKIE['memberID'] != "") && (isset($_GET['removeShow']))) {
  $deleteSQL = sprintf("DELETE FROM 58_memberShows WHERE showID='".$_GET['removeShow']."' AND memberID='".$_COOKIE['memberID']."'");
  mysql_select_db($database_radioRecords, $radioRecords);
  $Result1 = mysql_query($deleteSQL, $radioRecords) or die(mysql_error());
}

$targetShow=$row_showDetails['showDate'];
mysql_select_db($database_radioRecords, $radioRecords);
$nextShow = mysql_query("SELECT `showID`,`showDate` FROM `showlist_db` WHERE showDate > \"'$targetShow'\" ORDER BY `showDate` ASC LIMIT 1", $radioRecords) or die(mysql_error());
$row_nextShow = mysql_fetch_assoc($nextShow);
$totalRows_nextShow = mysql_num_rows($nextShow);

$targetPrevShow=$row_showDetails['showDate'];
mysql_select_db($database_radioRecords, $radioRecords);
$prevShow = mysql_query("SELECT `showID`,`showDate` FROM `showlist_db` WHERE showDate < \"'$targetPrevShow'\" ORDER BY `showDate` DESC LIMIT 1", $radioRecords) or die(mysql_error());
$row_prevShow = mysql_fetch_assoc($prevShow);
$totalRows_prevShow = mysql_num_rows($prevShow);

$colname_memberName = "1";
if (isset($_COOKIE['memberID'])) {
  $colname_memberName = (get_magic_quotes_gpc()) ? $_COOKIE['memberID'] : addslashes($_COOKIE['memberID']);
}
mysql_select_db($database_radioRecords, $radioRecords);
$query_memberName = sprintf("SELECT * FROM `58_members` WHERE pn_uid = %s", $colname_memberName);
$memberName = mysql_query($query_memberName, $radioRecords) or die(mysql_error());
$row_memberName = mysql_fetch_assoc($memberName);
$totalRows_memberName = mysql_num_rows($memberName);

$colname_claimedShows = "0";
if (isset($_COOKIE['memberID'])) {
  $colname_claimedShows = (get_magic_quotes_gpc()) ? $_COOKIE['memberID'] : addslashes($_COOKIE['memberID']);
}
mysql_select_db($database_radioRecords, $radioRecords);
$query_claimedShows = sprintf("SELECT 58_memberShows.keyID, 58_memberShows.memberID, 58_memberShows.showID, showlist_db.showDate, venuedetails.venueName FROM 58_memberShows, showlist_db, venuedetails WHERE showlist_db.showVenueID = venuedetails.venueID AND showlist_db.showID = 58_memberShows.showID AND 58_memberShows.memberID = '%s' ORDER BY showlist_db.showDate ASC", $colname_claimedShows);
$claimedShows = mysql_query($query_claimedShows, $radioRecords) or die(mysql_error());
$row_claimedShows = mysql_fetch_assoc($claimedShows);
$totalRows_claimedShows = mysql_num_rows($claimedShows);
?>
<?php if(!$_COOKIE['memberID']) header("Location: index.php");
else {?>
<?php echo "<?xml version=\"1.0\" encoding=\"iso-8859-1\"?".">"; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>58hours.com |  Member details for: <?php echo $row_memberName['pn_uname']; ?></title>
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
.style1 {color: #FFFFFF}
.style4 {color: #000033}
-->
</style>
</head>

<body bgcolor="#000000" text="#FFFFFF" link="#0066CC" vlink="#0066CC" alink="#0066CC" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" class="blueishlinks">
<br />
<table width="800" border="0" align="center" cellpadding="1" cellspacing="1" bgcolor="#FFFFFF">
  <tr>
    <td>
	<table width="800" align="center" cellpadding="0" cellspacing="0" cols="1" bgcolor="#FFFFFF" rows="2">
<tr><td width="688" background="images/58hrs_header_taller.jpg" bgcolor="#FFFFFF"><img src="images/pixelshim.gif" width="20" height="150" />
  </td>
  <td width="108" align="right" bgcolor="#000000"><?php include('loginModule.php'); ?>
  </td>
</tr><tr><td colspan="2" bgcolor="#FFFFFF">
  	<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0" width="800" height="20">
      <param name="movie" value="flashStats.swf" />
      <param name="quality" value="high" />
      <embed src="flashStats.swf" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="800" height="20"></embed>
    </object></td>
</tr>
</table>
<div align="center">
  <table width="800" border="0" align="center" cellpadding="5" cellspacing="0" bgcolor="#FFFFFF">
    <tr>
      <td nowrap="nowrap" class="darkerLinkage"><font face="Arial, Helvetica, sans-serif">&nbsp;</font></td>
      <td align="right" valign="bottom" nowrap="nowrap">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="2" bgcolor="#000033"><font color="#999999" size="1" face="Arial, Helvetica, sans-serif">
        <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0" width="450" height="30">
          <param name="movie" value="trackName.swf?name=Member%2Bdetails%2Bfor%2B<?php echo $row_memberName['pn_uname']; ?>" />
          <param name="quality" value="high" />
          <embed src="trackName.swf?name=Member%2Bdetails%2Bfor%2B<?php echo $row_memberName['pn_uname']; ?>" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="450" height="30"></embed>
        </object>
        </font></td>
    </tr>
    <tr>
      <td colspan="2" bgcolor="#000033"><table width="100%" border="0" cellspacing="0" cellpadding="1">
          <tr> 
            <td width="300" height="72" valign="top"><font color="#CCCCCC" size="1" face="Arial, Helvetica, sans-serif">&nbsp;</font>
              <table width="300" border="0" cellspacing="1" cellpadding="2">
                <tr>
                  <td width="89" nowrap="nowrap"><span class="style1">Member email: </span></td>
                  <td width="200" nowrap="nowrap"><span class="style1"><?php echo $row_memberName['pn_email']; ?></span></td>
                </tr>
                <tr>
                  <td valign="top" nowrap="nowrap"><span class="style1">Member URL: </span></td>
                  <td nowrap="nowrap"><span class="style1"><?php echo $row_memberName['pn_url']; ?><br /> </td>
                </tr>
				
               
              </table>
              <p><br />
                </p>
            </td>
            <td align="right" valign="top"><table width="100%" border="0" cellspacing="1" cellpadding="1">
                <tr>
                  <th colspan="3" bgcolor="#FFFFFF"><span class="style4">Shows attended : <?php echo $totalRows_claimedShows ?></span> </th>
                </tr>
                <?php do { ?>
                <tr>
                    <td width="20%"><?php echo $row_claimedShows['showDate']; ?></td>
                    <td width="42%" nowrap="nowrap"><a href="/58_displayshow.php?showID=<?php echo $row_claimedShows['showID']; ?>"><?php echo $row_claimedShows['venueName']; ?></a></td>
                    <td width="17%"><a href="memberDetails.php?removeShow=<?php echo $row_claimedShows['showID']; ?>"><span class="style1">[remove]</span></a></td>
                </tr>
                <?php } while ($row_claimedShows = mysql_fetch_assoc($claimedShows)); ?>
                <tr>
                  <td colspan="3"><div align="center"><span class="style1">View your personal performance numbers.  (coming soon) </span></div></td>
                </tr>
              </table>
			  <br>
			</td>
    </tr>
  </table>
  </td>
    </tr>
    <tr bgcolor="#000033">
      <td colspan="2"><font color="#FFFFFF">
        <?php require_once('58ss_includes/58disclaimer.php'); ?>
      </font></td>
    </tr>
  </table>
	</td>
  </tr>
</table>
<script src="http://www.google-analytics.com/urchin.js" type="text/javascript">
</script>
<script type="text/javascript">
_uacct = "UA-584621-1";
urchinTracker();
</script>
</body>
</html>
<?php
mysql_free_result($memberName);

mysql_free_result($claimedShows);
?>
<?php } ?>
