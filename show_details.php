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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "claimShow")) {
  $insertSQL = sprintf("INSERT INTO 58_memberShows (memberID, showID) VALUES (%s, %s)",GetSQLValueString($_POST['memberID'], "int"), GetSQLValueString($_POST['showID'], "int"));
  mysql_select_db($database_radioRecords, $radioRecords);
  $Result1 = mysql_query($insertSQL, $radioRecords) or die(mysql_error());
}

$colname_liveLink = "999";
if (isset($HTTP_GET_VARS['showID'])) {
  $colname_liveLink = (get_magic_quotes_gpc()) ? $HTTP_GET_VARS['showID'] : addslashes($HTTP_GET_VARS['showID']);
}
mysql_select_db($database_radioRecords, $radioRecords);
$query_liveLink = sprintf("SELECT linkID, linknum, operator, linkshow, linkstatus, UNIX_TIMESTAMP(linktime) AS date FROM liveUpdate WHERE linkshow = %s ORDER BY linknum ASC", $colname_liveLink);
$liveLink = mysql_query($query_liveLink, $radioRecords) or die(mysql_error());
$row_liveLink = mysql_fetch_assoc($liveLink);
$totalRows_liveLink = mysql_num_rows($liveLink);

$colname_showDetails = "1";
if (isset($HTTP_GET_VARS['showID'])) {
  $colname_showDetails = (get_magic_quotes_gpc()) ? $HTTP_GET_VARS['showID'] : addslashes($HTTP_GET_VARS['showID']);
}
mysql_select_db($database_radioRecords, $radioRecords);
$query_showDetails = sprintf("SELECT showlist_db.showEventName, showlist_db.show_tour, showlist_db.showSupport1, showlist_db.showComments, countryresolver.countryName, countryresolver.countryID, localityresolver.localityName, localityresolver.localityID, cityresolver.cityName, cityresolver.cityID, venuedetails.venueName, showlist_db.showID, venuedetails.venueID, showlist_db.showDate FROM showlist_db, tourresolver, venuedetails, cityresolver, localityresolver, countryresolver WHERE cityresolver.localityID = localityresolver.localityID AND localityresolver.countryID = countryresolver.countryID AND venuedetails.venueCity = cityresolver.cityID AND venuedetails.venueID = showlist_db.showVenueID AND showlist_db.showID = %s", $colname_showDetails);
$showDetails = mysql_query($query_showDetails, $radioRecords) or die(mysql_error());
$row_showDetails = mysql_fetch_assoc($showDetails);
$totalRows_showDetails = mysql_num_rows($showDetails);

//////
$colname_tourDetails = "1";
if (isset($HTTP_GET_VARS['showID'])) {
  $colname_tourDetails = (get_magic_quotes_gpc()) ? $HTTP_GET_VARS['showID'] : addslashes($HTTP_GET_VARS['showID']);
}
mysql_select_db($database_radioRecords, $radioRecords);
$query_tourDetails = sprintf("SELECT tourresolver.tourName, tourresolver.tourID FROM showlist_db, tourresolver WHERE tourresolver.tourID = showlist_db.show_tour AND showlist_db.showID = %s", $colname_tourDetails);
$tourDetails = mysql_query($query_tourDetails, $radioRecords) or die(mysql_error());
$row_tourDetails = mysql_fetch_assoc($tourDetails);
$totalRows_tourDetails = mysql_num_rows($tourDetails);
//////


$colname_setlistDetails = "9999";
if (isset($HTTP_GET_VARS['showID'])) {
  $colname_setlistDetails = (get_magic_quotes_gpc()) ? $HTTP_GET_VARS['showID'] : addslashes($HTTP_GET_VARS['showID']);
}

mysql_select_db($database_radioRecords, $radioRecords);
$query_perfImages = sprintf("SELECT * FROM galleryBin, 58_members WHERE galleryBin.posterID = 58_members.pn_uid AND galleryBin.showID = %s", $colname_showDetails);
$perfImages = mysql_query($query_perfImages, $radioRecords) or die(mysql_error());
$row_perfImages = mysql_fetch_assoc($perfImages);
$totalRows_perfImages = mysql_num_rows($perfImages);

mysql_select_db($database_radioRecords, $radioRecords);
$query_setlistDetails = sprintf("SELECT livetracks_db.showID, livetracks_db.songNumber, titleresolver.trackTitle, titleresolver.trackID, livetracks_db.songType FROM livetracks_db, titleresolver WHERE titleresolver.trackID = livetracks_db.trackID AND livetracks_db.showID = %s AND livetracks_db.songType = '0' ORDER BY livetracks_db.songNumber", $colname_setlistDetails);
$setlistDetails = mysql_query($query_setlistDetails, $radioRecords) or die(mysql_error());
$row_setlistDetails = mysql_fetch_assoc($setlistDetails);
$totalRows_setlistDetails = mysql_num_rows($setlistDetails);

$maxRows_showComments = 1;
$pageNum_showComments = 0;
if (isset($HTTP_GET_VARS['pageNum_showComments'])) {
  $pageNum_showComments = $HTTP_GET_VARS['pageNum_showComments'];
}
$startRow_showComments = $pageNum_showComments * $maxRows_showComments;

$colname_showComments = "1";
if (isset($HTTP_GET_VARS['showID'])) {
  $colname_showComments = (get_magic_quotes_gpc()) ? $HTTP_GET_VARS['showID'] : addslashes($HTTP_GET_VARS['showID']);
}
mysql_select_db($database_radioRecords, $radioRecords);
$query_showComments = sprintf("SELECT commentID, commentBody, commentAuthor, commentShowID, UNIX_TIMESTAMP(commentTimestamp) AS date FROM `58_comments` WHERE commentShowID = '%s' AND commentActive=1 ORDER BY date DESC", $colname_showComments);
if($_GET['allComments']==1) $query_limit_showComments = $query_showComments;
else $query_limit_showComments = sprintf("%s LIMIT %d, %d", $query_showComments, $startRow_showComments, $maxRows_showComments);
$showComments = mysql_query($query_limit_showComments, $radioRecords) or die(mysql_error());
$row_showComments = mysql_fetch_assoc($showComments);

if (isset($HTTP_GET_VARS['totalRows_showComments'])) {
  $totalRows_showComments = $HTTP_GET_VARS['totalRows_showComments'];
} else {
  $all_showComments = mysql_query($query_showComments);
  $totalRows_showComments = mysql_num_rows($all_showComments);
}
$totalPages_showComments = ceil($totalRows_showComments/$maxRows_showComments)-1;

$colname_setlistDetails2 = "9999";
if (isset($HTTP_GET_VARS['showID'])) {
  $colname_setlistDetails2 = (get_magic_quotes_gpc()) ? $HTTP_GET_VARS['showID'] : addslashes($HTTP_GET_VARS['showID']);
}
mysql_select_db($database_radioRecords, $radioRecords);
$query_setlistDetails2 = sprintf("SELECT livetracks_db.showID, livetracks_db.songNumber, titleresolver.trackTitle, titleresolver.trackID, livetracks_db.songType FROM livetracks_db, titleresolver WHERE titleresolver.trackID = livetracks_db.trackID AND livetracks_db.showID = %s AND livetracks_db.songType = '1' ORDER BY livetracks_db.songNumber", $colname_setlistDetails2);
$setlistDetails2 = mysql_query($query_setlistDetails2, $radioRecords) or die(mysql_error());
$row_setlistDetails2 = mysql_fetch_assoc($setlistDetails2);
$totalRows_setlistDetails2 = mysql_num_rows($setlistDetails2);

$colname_setlistDetails3 = "9999";
if (isset($HTTP_GET_VARS['showID'])) {
  $colname_setlistDetails3 = (get_magic_quotes_gpc()) ? $HTTP_GET_VARS['showID'] : addslashes($HTTP_GET_VARS['showID']);
}
mysql_select_db($database_radioRecords, $radioRecords);
$query_setlistDetails3 = sprintf("SELECT livetracks_db.showID, livetracks_db.songNumber, titleresolver.trackTitle, titleresolver.trackID, livetracks_db.songType FROM livetracks_db, titleresolver WHERE titleresolver.trackID = livetracks_db.trackID AND livetracks_db.showID = %s AND livetracks_db.songType = '2' ORDER BY livetracks_db.songNumber", $colname_setlistDetails3);
$setlistDetails3 = mysql_query($query_setlistDetails3, $radioRecords) or die(mysql_error());
$row_setlistDetails3 = mysql_fetch_assoc($setlistDetails3);
$totalRows_setlistDetails3 = mysql_num_rows($setlistDetails3);

$colname_setlistDetails4 = "9999";
if (isset($HTTP_GET_VARS['showID'])) {
  $colname_setlistDetails4 = (get_magic_quotes_gpc()) ? $HTTP_GET_VARS['showID'] : addslashes($HTTP_GET_VARS['showID']);
}
mysql_select_db($database_radioRecords, $radioRecords);
$query_setlistDetails4 = sprintf("SELECT livetracks_db.showID, livetracks_db.songNumber, titleresolver.trackTitle, titleresolver.trackID, livetracks_db.songType FROM livetracks_db, titleresolver WHERE titleresolver.trackID = livetracks_db.trackID AND livetracks_db.showID = %s AND livetracks_db.songType = '3' ORDER BY livetracks_db.songNumber", $colname_setlistDetails4);
$setlistDetails4 = mysql_query($query_setlistDetails4, $radioRecords) or die(mysql_error());
$row_setlistDetails4 = mysql_fetch_assoc($setlistDetails4);
$totalRows_setlistDetails4 = mysql_num_rows($setlistDetails4);

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

$colname_supportDetails = "9999";
if (isset($HTTP_GET_VARS['showID'])) {
  $colname_supportDetails = (get_magic_quotes_gpc()) ? $HTTP_GET_VARS['showID'] : addslashes($HTTP_GET_VARS['showID']);
}
mysql_select_db($database_radioRecords, $radioRecords);
$query_supportDetails = sprintf("SELECT supportResolver.supportName, supportResolver.supportID FROM supportReference, supportResolver WHERE supportResolver.supportID = supportReference.supportID AND supportReference.showID = %s ORDER BY supportResolver.supportID", $colname_supportDetails);
$supportDetails = mysql_query($query_supportDetails, $radioRecords) or die(mysql_error());
$row_supportDetails = mysql_fetch_assoc($supportDetails);
$totalRows_supportDetails = mysql_num_rows($supportDetails);

$colname_memberName = "9999";
if (isset($_COOKIE['memberID'])) {
  $colname_memberName = (get_magic_quotes_gpc()) ? $_COOKIE['memberID'] : addslashes($_COOKIE['memberID']);
}
mysql_select_db($database_radioRecords, $radioRecords);


$query_memberName = sprintf("SELECT pn_uname FROM `58_members` WHERE pn_uid = %s", $colname_memberName);
$memberName = mysql_query($query_memberName, $radioRecords) or die(mysql_error());
$row_memberName = mysql_fetch_assoc($memberName);
$totalRows_memberName = mysql_num_rows($memberName);

$colname2_attendedShow = "0";
if (isset($_COOKIE['memberID'])) {
  $colname2_attendedShow = (get_magic_quotes_gpc()) ? $_COOKIE['memberID'] : addslashes($_COOKIE['memberID']);
}
$colname_attendedShow = "1";
if (isset($_GET['showID'])) {
  $colname_attendedShow = (get_magic_quotes_gpc()) ? $_GET['showID'] : addslashes($_GET['showID']);
}
mysql_select_db($database_radioRecords, $radioRecords);
$query_attendedShow = sprintf("SELECT keyID, memberID, showID FROM 58_memberShows WHERE showID = '%s' AND memberID = '%s'", $colname_attendedShow,$colname2_attendedShow);
$attendedShow = mysql_query($query_attendedShow, $radioRecords) or die(mysql_error());
$row_attendedShow = mysql_fetch_assoc($attendedShow);
$totalRows_attendedShow = mysql_num_rows($attendedShow);

$colname_attendingMembers = "0";
if (isset($_GET['showID'])) {
  $colname_attendingMembers = (get_magic_quotes_gpc()) ? $_GET['showID'] : addslashes($_GET['showID']);
}
mysql_select_db($database_radioRecords, $radioRecords);
$query_attendingMembers = sprintf("SELECT 58_memberShows.keyID, 58_memberShows.memberID, 58_memberShows.showID, 58_members.pn_uname FROM 58_memberShows, 58_members WHERE 58_memberShows.showID = '%s' AND 58_members.pn_uid = 58_memberShows.memberID ORDER BY memberID ASC", $colname_attendingMembers);
$attendingMembers = mysql_query($query_attendingMembers, $radioRecords) or die(mysql_error());
$row_attendingMembers = mysql_fetch_assoc($attendingMembers);
$totalRows_attendingMembers = mysql_num_rows($attendingMembers);
?>
<?php echo "<?xml version=\"1.0\" encoding=\"iso-8859-1\"?".">"; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>58hours.com |  Radiohead setlist for <?php echo date('l, F d, Y',strtotime($row_showDetails['showDate'])); ?> (<?php echo $row_showDetails['venueName']; ?>)</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/styles_v2.css" rel="stylesheet" type="text/css" />
<script language="JavaScript" type="text/JavaScript">
<!--
function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}
//-->
</script>

<script type="text/javascript"><!--
google_ad_client = "pub-4681937497066114";
google_ad_width = 160;
google_ad_height = 600;
google_ad_format = "160x600_as";
google_ad_type = "text";
google_ad_channel ="6294685603";
google_color_border = "000000";
google_color_link = "FFFFFF";
google_color_bg = "000000";
google_color_text = "CCCCCC";
google_color_url = "999999";
//--></script>


<style type="text/css">
<!--
.style3 {
	color: #000000;
	font-style: italic;
	font-family: Arial, Helvetica, sans-serif;
	font-size: 10px;
}
.style4 {color: #666666; text-decoration: none; font-family: Arial, Helvetica, sans-serif;}
-->
</style>
</head>

<body bgcolor="#000000" text="#FFFFFF" link="#0066CC" vlink="#0066CC" alink="#0066CC" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" class="blueishlinks">
<br />
<table width="800" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
<tr><td>
<table width="800" border="0" align="center" cellpadding="1" cellspacing="1" bgcolor="#FFFFFF">
  <tr>
    <td>
<table width="800" border="0" align="center" cellpadding="5" cellspacing="0" bgcolor="#FFFFFF">
    <tr>
      <td colspan="2" bgcolor="#FFFFFF" class="darkerLinkage"><a href="/"><img src="./images/logobar_800x113.gif" border="0" width="800" height="113"></a>
      </td>
    </tr>

	<tr><td align="right" valign="top" bgcolor="#FFFFFF">
	<table width="100%"><tr>
	<td>
	<table width="250" border="0" cellspacing="0" cellpadding="1">
                <tr>
                  <td align="left" nowrap="nowrap"><?php if ($totalRows_prevShow != 0) { // Show if recordset empty ?><a href="show_details.php?showID=<?php echo $row_prevShow['showID'];?>"><img src="images/bt_previous.gif" alt="Previous Show" width="58" height="13" border="0"></a><?php } ?>
                    <?php if ($totalRows_prevShow == 0) { // Show if recordset empty ?><font size="1" face="Arial, Helvetica, sans-serif">NO PREVIOUS SHOWS</font><?php } ?>
                  <font size="1" face="Arial, Helvetica, sans-serif"><?php if ($totalRows_nextShow != 0) { // Show if recordset empty ?><a href="show_details.php?showID=<?php echo $row_nextShow['showID'];?>"><img src="images/bt_next.gif" alt="Next Show" width="58" height="13" border="0" /></a><?php } ?></font></td>
              </table>
	</td>
	</tr>
	<tr>
          <td align="left"><font color="#999999" size="1" face="Arial, Helvetica, sans-serif"><a href="browse.php?cityID=<?php echo $row_showDetails['cityID']; ?>" class="darkerLinkage"><?php echo $row_showDetails['cityName']; ?> </a> | <a href="browse.php?localityID=<?php echo $row_showDetails['localityID']; ?>" class="darkerLinkage"><?php echo $row_showDetails['localityName']; ?> </a> | <a href="browse.php?countryID=<?php echo $row_showDetails['countryID']; ?>" class="darkerLinkage"> <?php echo $row_showDetails['countryName']; ?></a></font><br /<font face="Arial, Helvetica, sans-serif" color="#FFFFFF" size="2"><a href="browse.php?venueID=<?php echo $row_showDetails['venueID']; ?>" class="darkerLinkage"><?php echo $row_showDetails['venueName']; ?></a></font></td>
          <td align="right" valign="bottom">&nbsp;</td>
        </tr></table></td><td align="right" valign="top" bgcolor="#FFFFFF"><font size="1"><span class="style4"><font color="#FFFFFF" face="Arial, Helvetica, sans-serif">Browse by: <a href="./simple_index.php?browse=showDate" class="style4">date</a></font></span><font color="#FFFFFF" face="Arial, Helvetica, sans-serif"><span class="style4"> | <a href="./simple_index.php?browse=showVenue" class="style4">venue</a>  | <a href="./simple_index.php?browse=songTitle" class="style4">song title</a></span></font></font></td>
	</tr>
    <tr>
      <td colspan="2" bgcolor="#FFFFFF">
      
      
      <table width="100%" border="0" cellspacing="0" cellpadding="1">
          <tr> 
            <td width="300" height="72" valign="top">
            <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0" width="300" height="30">
              <param name="movie" value="flash_elements/trackNameSmall.swf" />
              <param name="quality" value="high" />
			  <param name="flashVars" value="name=<?php echo urlencode($row_showDetails['venueName']); ?>" />
              <embed src="flash_elements/trackNameSmall.swf" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="300" height="30" flashVars="name=<?php echo urlencode($row_showDetails['venueName']); ?>"></embed>
            </object>
              <br />
              &nbsp;&nbsp;<font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif">-<? echo date('l, F d, Y',strtotime($row_showDetails['showDate'])); ?></font>
			  <?
			  if($totalRows_tourDetails>0)
			  {
					echo "<br />&nbsp;&nbsp;&nbsp;<a href='./tour_details.php?tour=".$row_tourDetails['tourID']."' class='linkageStuff'>".$row_tourDetails['tourName']." Tour</a>";
				}	
				?>
			  <br /><br />
              <font color="#CCCCCC" size="1" face="Arial, Helvetica, sans-serif"><?php if ($totalRows_supportDetails > 0) { // Show if recordset empty ?>show support: <?php echo $row_supportDetails['supportName']; ?> <br><?php } ?>
              <?php if ($totalRows_nextShow == 0) { // Show if recordset empty ?>THIS IS THE MOST RECENT SHOW<br><?php } ?>
              <br></font>
              
            <table width="250" border="0" cellspacing="0" cellpadding="1">
                <tr>
                  <td align="center"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td><img src="images/setlistheadermain.gif" /></td>
                      </tr>
                      <?php $recordCounter = 0; ?>
                      <?php do { ?>
                      <tr<?php
		$recordCounter=$recordCounter+1;
		if ($recordCounter % 2 == 1)
		{
		echo " bgcolor=#FFFFFF";
		}
		else
		{
		echo " bgcolor=#FFFFFF";
		}
		?>>
                        <td height="2" nowrap>
						<font color="#CCCCCC" size="1" face="Arial, Helvetica, sans-serif">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php
                        if($row_setlistDetails['songNumber']==0) echo "intro";
                        else echo $row_setlistDetails['songNumber']."."; 
                        ?>&nbsp;&nbsp;
                              <?php if($totalRows_setlistDetails>0) {?>
                          <a href="song_details.php?trackID=<?php echo $row_setlistDetails['trackID']; ?>" class="linkageStuff"><?php echo $row_setlistDetails['trackTitle']; ?></a>
                              <?php }else{?>
                              <a href="#" class="linkageStuff" onClick="MM_openBrWindow('post_comments.php?showID=<?php echo $row_showDetails['showID']; ?>','postit','status=yes,width=450,height=500')">none yet... click here to add.</a>
                              <?php } ?>
                        </font></td>
                      </tr>
                      <?php } while ($row_setlistDetails = mysql_fetch_assoc($setlistDetails)); ?>
                      <?php if ($totalRows_setlistDetails2 > 0) { // Show if encore recordset not empty ?>
                      <tr>
                        <td><img src="images/setlistheaderenc1a.gif" /></td>
                      </tr>
                      <?php do { ?>
                      <tr<?php
		$recordCounter=$recordCounter+1;
		if ($recordCounter % 2 == 1)
		{
		echo " bgcolor=#FFFFFF";
		}
		else
		{
		echo " bgcolor=#FFFFFF";
		}
		?>>
                        <td height="2" nowrap><font color="#CCCCCC" size="1" face="Arial, Helvetica, sans-serif">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row_setlistDetails2['songNumber']."."; ?>&nbsp;&nbsp;
                              <?php if($totalRows_setlistDetails2>0) {?>
                          <a href="song_details.php?trackID=<?php echo $row_setlistDetails2['trackID']; ?>" class="linkageStuff"><?php echo $row_setlistDetails2['trackTitle']; ?></a>
                              <?php }?>
                        </font></td>
                      </tr>
                      <?php } while ($row_setlistDetails2 = mysql_fetch_assoc($setlistDetails2)); ?>
                      <?php } // Show if encore recordset not empty ?>

                      <?php if ($totalRows_setlistDetails3 > 0) { // Show if second encore recordset not empty ?>
                      <tr>
                        <td><br><img src="images/setlistheaderenc2a.gif" /></td>
                      </tr>
                      <?php do { ?>
                      <tr<?php
		$recordCounter=$recordCounter+1;
		if ($recordCounter % 2 == 1)
		{
		echo " bgcolor=#FFFFFF";
		}
		else
		{
		echo " bgcolor=#FFFFFF";
		}
		?>>
                        <td height="2" nowrap><font color="#CCCCCC" size="1" face="Arial, Helvetica, sans-serif">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row_setlistDetails3['songNumber']."."; ?>&nbsp;&nbsp;
                              <?php if($totalRows_setlistDetails3>0) {?>
                          <a href="song_details.php?trackID=<?php echo $row_setlistDetails3['trackID']; ?>" class="linkageStuff"><?php echo $row_setlistDetails3['trackTitle']; ?></a>
                              <?php }?>
                        </font></td>
                      </tr>
                      <?php } while ($row_setlistDetails3 = mysql_fetch_assoc($setlistDetails3)); ?>
                      <?php } // Show if second encore recordset not empty ?>
					   <?php if ($totalRows_setlistDetails4 > 0) { // Show if second encore recordset not empty ?>
                      <tr>
                        <td><img src="images/setlistheaderenc3.gif" /></td>
                      </tr>
                      <?php do { ?>
                      <tr<?php
		$recordCounter=$recordCounter+1;
		if ($recordCounter % 2 == 1)
		{
		echo " bgcolor=#FFFFFF";
		}
		else
		{
		echo " bgcolor=#FFFFFF";
		}
		?>>
                        <td height="2" nowrap><font color="#CCCCCC" size="1" face="Arial, Helvetica, sans-serif">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row_setlistDetails4['songNumber']."."; ?>&nbsp;&nbsp;&nbsp;
                              <?php if($totalRows_setlistDetails4>0) {?>
                          <a href="song_details.php?trackID=<?php echo $row_setlistDetails4['trackID']; ?>" class="linkageStuff"><?php echo $row_setlistDetails4['trackTitle']; ?></a>
                              <?php }?>
                        </font></td>

                      </tr>
                      <?php } while ($row_setlistDetails4 = mysql_fetch_assoc($setlistDetails4)); ?>
                      <?php } // Show if second encore recordset not empty ?>
                    </table>
                  </td>
                </tr>
              </table>
              <br>
			  <br>  
			  <table width="250" border="0" cellspacing="1" cellpadding="1">
                <tr>
                  <td><font size="1" face="Arial, Helvetica, sans-serif">[58HOURS.COM MEMBERS AT THIS SHOW]</font><br />
                    <font size="1" color="#CCCCCC" face="Arial, Helvetica, sans-serif">
				  <?php do { ?>
                      <?php echo $row_attendingMembers['pn_uname']; ?>
                      <?php if ($totalRows_attendingMembers > 1) {?>,
                      <?php }?>
                      <?php } while ($row_attendingMembers = mysql_fetch_assoc($attendingMembers)); ?>
                      </font><br /><br /><?php if ($totalRows_attendedShow > 0) { // Show if recordset not empty ?>
                      <font face="Arial, Helvetica, sans-serif" size="1" color="#CCCCCC">You were at this show <a href="memberDetails.php">[remove]</a><br /><a href="user_shows.php">View Your Personal Show Details</a></font><?php } ?>
                      <?php if (($totalRows_memberName > 0)&&($totalRows_attendedShow <= 0)) { // Show if recordset not empty ?>
                      <form action="<?php echo $editFormAction; ?>" method="post" name="claimShow" id="claimShow">
                        <input name="showID" type="hidden" value="<?php echo $_GET['showID']; ?>" />
                        <input name="memberID" type="hidden" value="<?php echo $_COOKIE['memberID']; ?>" />
                        <font face="Arial, Helvetica, sans-serif" size="1" color="#CCCCCC"><a href="#" class="linkageStuff" onClick="javascript:document.claimShow.submit();">[add me to the list of members at this show]</a> </font>
                        <input type="hidden" name="MM_insert" value="claimShow" />
                      </form>
                      <?php } // Show if recordset not empty ?></td>
                </tr>
              </table>
              <br />
              <?php if ($totalRows_liveLink != 0) { //show if recordset not empty ?><font color="#CCCCCC" size="1" face="Arial, Helvetica, sans-serif">
              <a href="about58.php">UPLINK CHECKS:</a><br>
              <?php do { ?>
              [#<?php echo $row_liveLink['linknum']; ?>] at <?php echo date('g:i A',$row_liveLink['date']); ?> (PST) by <?php echo $row_liveLink['operator']; ?> - 
              status: <?php echo $row_liveLink['linkstatus']; ?><br><?php } while ($row_liveLink = mysql_fetch_assoc($liveLink)); ?>
              </font><br><?php } //show if recordset not empty ?>
			  <?php if($row_showDetails['showComments']!="") {?>
			  <table width="250" border="0" cellspacing="0" cellpadding="4">
    <tr>
      <td><font size="1" face="Arial, Helvetica, sans-serif">[SHOW NOTES]<br>
			  <font color="#FFFFFF"><?php echo $row_showDetails['showComments']; ?>
              </font> </font>
	  </td>
    </tr>
  </table><?php } ?>
  <br /><p><br /></p></td>
            <td align="right" valign="top">
			<br>
		  <table width="450" border="0" cellpadding="1" cellspacing="1">
              <?php if($totalRows_perfImages != 0) {?><tr>
                <td width="454"><img src="images/showimages-wide.gif" width="450" height="13" /></td>
              </tr>
			  <tr>
			  <td>
			  <table width="450" border="0" cellspacing="0" cellpadding="0">
                       <tr>
                         <td>
						 <table width="450" border="0" cellspacing="1" cellpadding="0">
                           <tr><?php $iRow=0; do { ?>
						   <?php if (($iRow%4==0)&&($iRow!=0)) echo "</tr><tr>" ?>
                             <td width="100" valign="bottom"><div align="center"><img src="<?php echo $row_perfImages['photoTbLoc']; ?>"><br></div><div align="left"><font class="style3"><?php echo $row_perfImages['photoTitle']; ?><br>from: <?php echo $row_perfImages['pn_uname']; ?></font></div></td>
                           <?php $iRow++;} while ($row_perfImages = mysql_fetch_assoc($perfImages)); ?></tr>
                         </table>
                           </td>
                       </tr>
                     </table>
					 
					 </td>
              </tr><?php } ?>
              <tr>
                <td><img src="images/showreviews-wide.gif" width="450" height="13" /></td>
              </tr>
              <tr>
                <td><table cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
                  <tr>
                    <td colspan="2"> <font size="1" face="Arial, Helvetica, sans-serif">
                      <?php if ($totalRows_showComments == 0) { // Show if recordset empty ?>
&nbsp;none currently posted.
      <?php } // Show if recordset empty ?>
      <br />
      <?php if ($totalRows_showComments > 0) { // Show if recordset empty ?>
      <?php 
      do { ?>
      <table>
        <tr>
          <td> <font color="#000000" face="Arial, Helvetica, sans-serif" size="1"> <?php echo $row_showComments['commentBody']; ?><br />
                <br />
            submitted by: <b> <?php echo $row_showComments['commentAuthor']; ?> </b> <br />
            </font><font face="Arial, Helvetica, sans-serif" size="1" color="#3366CC"><i>( <?php echo date('g:i A',$row_showComments['date']); ?> [PST], <?php echo date('l, F d, Y',$row_showComments['date']); ?> ) </i></font> <br />
            <hr />
            <br />
          </td>
        </tr>
      </table>
      <?php } while ($row_showComments = mysql_fetch_assoc($showComments)); ?>
                      </font>
                        <?php } // Show if recordset empty ?>
                        <!-- <a href="#" class="linkageStuff" onclick="MM_openBrWindow('post_comments.php?showID=<?php echo $row_showDetails['showID']; ?>','postit','status=yes,width=450,height=350')"><em>[click
                        to add a comment for this show]</em> </a><br />
                        <br /> -->
                        <!--<a href="#" class="linkageStuff" onclick="MM_openBrWindow('post_comments.php?showID=<?php echo $row_showDetails['showID']; ?>','postit','status=yes,width=450,height=350')"><em>[click
                        to add a review for this show]</em> </a> <br />
                        <br /> -->
                    </td>
                  </tr>
                  <tr>
                    <td align="left" width="250"><a href="#" class="linkageStuff" onclick="MM_openBrWindow('post_comments.php?showID=<?php echo $row_showDetails['showID']; ?>','postit','status=yes,width=450,height=500')"><img src="images/cornering_r3_c1.gif" width="30" height="30" border="0"/><img src="images/addcomments.gif" alt="add comment" width="130" height="13" vspace="5" border="0" /></a></td>
                    <td align="right" width="250"><? if($_GET['allComments']!='1') {?><a href="<?=$REQUEST_URI?>&allComments=1"><img src="images/viewothercomments.gif" alt="View Comments" width="119" height="13" vspace="5" border="0" /></a><? } ?><img src="images/cornering_r3_c3.gif" width="30" height="30" border="0"/></td>
                  </tr>
                </table></td>
              </tr>
            </table></td>
          </tr>
  </table>
  </td>
    </tr>
    <tr bgcolor="#333366">

      <td colspan="2"><font color="#FFFFFF">
        <?php require_once('58ss_includes/58disclaimer.php'); ?>
      </font></td>
    </tr>
  </table>
	</td>
  </tr>
</table>
</td><td>

<script type="text/javascript"
  src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>
</td></tr></table>
</body>
</html>
<?php
mysql_free_result($showDetails);

mysql_free_result($tourDetails);

mysql_free_result($setlistDetails);

mysql_free_result($showComments);

mysql_free_result($memberName);

mysql_free_result($attendedShow);

mysql_free_result($attendingMembers);

mysql_free_result($perfImages);

?>
