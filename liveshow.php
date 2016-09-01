<?php require_once('Connections/radioRecords.php'); ?>
<?php
$desShow = '598';
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
  $insertSQL = sprintf("INSERT INTO 58_memberShows (memberID, showID) VALUES (%s, %s)",GetSQLValueString($_POST['memberID'], "int"), GetSQLValueString($desShow, "int"));
  mysql_select_db($database_radioRecords, $radioRecords);
  $Result1 = mysql_query($insertSQL, $radioRecords) or die(mysql_error());
}

$colname_liveLink = "999";
if (isset($desShow)) {
  $colname_liveLink = (get_magic_quotes_gpc()) ? $desShow : addslashes($desShow);
}
mysql_select_db($database_radioRecords, $radioRecords);
$query_liveLink = sprintf("SELECT linkID, linknum, operator, linkshow, linkstatus, UNIX_TIMESTAMP(linktime) AS date FROM liveUpdate WHERE linkshow = %s ORDER BY linknum ASC", $colname_liveLink);
$liveLink = mysql_query($query_liveLink, $radioRecords) or die(mysql_error());
$row_liveLink = mysql_fetch_assoc($liveLink);
$totalRows_liveLink = mysql_num_rows($liveLink);

$colname_showDetails = "1";
if (isset($desShow)) {
  $colname_showDetails = (get_magic_quotes_gpc()) ? $desShow : addslashes($desShow);
}
mysql_select_db($database_radioRecords, $radioRecords);
$query_showDetails = sprintf("SELECT showlist_db.showEventName, showlist_db.show_tour, showlist_db.showSupport1, showlist_db.showComments, countryresolver.countryName, countryresolver.countryID, localityresolver.localityName, localityresolver.localityID, cityresolver.cityName, cityresolver.cityID, venuedetails.venueName, showlist_db.showID, venuedetails.venueID, showlist_db.showDate FROM showlist_db, tourresolver, venuedetails, cityresolver, localityresolver, countryresolver WHERE cityresolver.localityID = localityresolver.localityID AND localityresolver.countryID = countryresolver.countryID AND venuedetails.venueCity = cityresolver.cityID AND venuedetails.venueID = showlist_db.showVenueID AND showlist_db.showID = %s", $colname_showDetails);
$showDetails = mysql_query($query_showDetails, $radioRecords) or die(mysql_error());
$row_showDetails = mysql_fetch_assoc($showDetails);
$totalRows_showDetails = mysql_num_rows($showDetails);

//////
$colname_tourDetails = "1";
if (isset($desShow)) {
  $colname_tourDetails = (get_magic_quotes_gpc()) ? $desShow : addslashes($desShow);
}
mysql_select_db($database_radioRecords, $radioRecords);
$query_tourDetails = sprintf("SELECT tourresolver.tourName, tourresolver.tourID FROM showlist_db, tourresolver WHERE tourresolver.tourID = showlist_db.show_tour AND showlist_db.showID = %s", $colname_tourDetails);
$tourDetails = mysql_query($query_tourDetails, $radioRecords) or die(mysql_error());
$row_tourDetails = mysql_fetch_assoc($tourDetails);
$totalRows_tourDetails = mysql_num_rows($tourDetails);
//////



$maxRows_showComments = 1;
$pageNum_showComments = 0;
if (isset($HTTP_GET_VARS['pageNum_showComments'])) {
  $pageNum_showComments = $HTTP_GET_VARS['pageNum_showComments'];
}
$startRow_showComments = $pageNum_showComments * $maxRows_showComments;

$colname_showComments = "1";
if (isset($desShow)) {
  $colname_showComments = (get_magic_quotes_gpc()) ? $desShow : addslashes($desShow);
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
if (isset($desShow)) {
  $colname_setlistDetails2 = (get_magic_quotes_gpc()) ? $desShow : addslashes($desShow);
}
mysql_select_db($database_radioRecords, $radioRecords);
$query_setlistDetails2 = sprintf("SELECT livetracks_db.showID, livetracks_db.songNumber, titleresolver.trackTitle, titleresolver.trackID, livetracks_db.songType FROM livetracks_db, titleresolver WHERE titleresolver.trackID = livetracks_db.trackID AND livetracks_db.showID = %s AND livetracks_db.songType = '1' ORDER BY livetracks_db.songNumber", $colname_setlistDetails2);
$setlistDetails2 = mysql_query($query_setlistDetails2, $radioRecords) or die(mysql_error());
$row_setlistDetails2 = mysql_fetch_assoc($setlistDetails2);
$totalRows_setlistDetails2 = mysql_num_rows($setlistDetails2);

$colname_setlistDetails3 = "9999";
if (isset($desShow)) {
  $colname_setlistDetails3 = (get_magic_quotes_gpc()) ? $desShow : addslashes($desShow);
}
mysql_select_db($database_radioRecords, $radioRecords);
$query_setlistDetails3 = sprintf("SELECT livetracks_db.showID, livetracks_db.songNumber, titleresolver.trackTitle, titleresolver.trackID, livetracks_db.songType FROM livetracks_db, titleresolver WHERE titleresolver.trackID = livetracks_db.trackID AND livetracks_db.showID = %s AND livetracks_db.songType = '2' ORDER BY livetracks_db.songNumber", $colname_setlistDetails3);
$setlistDetails3 = mysql_query($query_setlistDetails3, $radioRecords) or die(mysql_error());
$row_setlistDetails3 = mysql_fetch_assoc($setlistDetails3);
$totalRows_setlistDetails3 = mysql_num_rows($setlistDetails3);

$colname_setlistDetails4 = "9999";
if (isset($desShow)) {
  $colname_setlistDetails4 = (get_magic_quotes_gpc()) ? $desShow : addslashes($desShow);
}
mysql_select_db($database_radioRecords, $radioRecords);
$query_setlistDetails4 = sprintf("SELECT livetracks_db.showID, livetracks_db.songNumber, titleresolver.trackTitle, titleresolver.trackID, livetracks_db.songType FROM livetracks_db, titleresolver WHERE titleresolver.trackID = livetracks_db.trackID AND livetracks_db.showID = %s AND livetracks_db.songType = '3' ORDER BY livetracks_db.songNumber", $colname_setlistDetails4);
$setlistDetails4 = mysql_query($query_setlistDetails4, $radioRecords) or die(mysql_error());
$row_setlistDetails4 = mysql_fetch_assoc($setlistDetails4);
$totalRows_setlistDetails4 = mysql_num_rows($setlistDetails4);

$targetShow=$row_showDetails['showDate'];
mysql_select_db($database_radioRecords, $radioRecords);
$nextShow = mysql_query("SELECT `showID`,`showDate`,`showactive` FROM `showlist_db` WHERE showDate > \"'$targetShow'\" ORDER BY `showDate` ASC LIMIT 1", $radioRecords) or die(mysql_error());
$row_nextShow = mysql_fetch_assoc($nextShow);
$totalRows_nextShow = mysql_num_rows($nextShow);

$targetPrevShow=$row_showDetails['showDate'];
mysql_select_db($database_radioRecords, $radioRecords);
$prevShow = mysql_query("SELECT `showID`,`showDate` FROM `showlist_db` WHERE showDate < \"'$targetPrevShow'\" ORDER BY `showDate` DESC LIMIT 1", $radioRecords) or die(mysql_error());
$row_prevShow = mysql_fetch_assoc($prevShow);
$totalRows_prevShow = mysql_num_rows($prevShow);

$colname_supportDetails = "9999";
if (isset($desShow)) {
  $colname_supportDetails = (get_magic_quotes_gpc()) ? $desShow : addslashes($desShow);
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
<link href="css/styles.css" rel="stylesheet" type="text/css" />
<style type="text/css"> 
body 
{ 
background-image: url('images/bgstripes.gif'); 
} 
</style>
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
	color: #FFFFFF;
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

<table width="300" height="750" border="0" align="center" cellpadding="0" cellspacing="0">
<tr><td valign="top">

<table width="300" height="750" border="0" align="center" cellpadding="1" cellspacing="1" bgcolor="#FFFFFF">
  <tr>
    <td valign="top">
<table width="300" height="750" border="0" align="center" cellpadding="5" cellspacing="0" bgcolor="#FFFFFF">

    <tr>
      <td colspan="2" bgcolor="#000033">
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
			  <br />
              <font color="#CCCCCC" size="1" face="Arial, Helvetica, sans-serif"><?php if ($totalRows_supportDetails > 0) { // Show if recordset empty ?>show support: <?php echo $row_supportDetails['supportName']; ?> <br><?php } ?>
              <?php if (($totalRows_nextShow == 0)&&($row_nextShow['showactive']=='0')) { // Show if recordset empty ?>THIS IS THE MOST RECENT SHOW<br><?php } ?>
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
		echo " bgcolor=#000033";
		}
		else
		{
		echo " bgcolor=#000033";
		}
		?>>
                        <td height="2" nowrap>
						<font color="#CCCCCC" size="1" face="Arial, Helvetica, sans-serif">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php
                        if($row_setlistDetails['songNumber']==0) echo "intro";
                        else echo $row_setlistDetails['songNumber']."."; 
                        ?>&nbsp;&nbsp;
                              <?php if($totalRows_setlistDetails>0) {?>
                          <a href="58_trackDetails.php?trackID=<?php echo $row_setlistDetails['trackID']; ?>" class="linkageStuff"><?php echo $row_setlistDetails['trackTitle']; ?></a>
                              <?php }else{?>
                              <a href="#" class="linkageStuff" onClick="MM_openBrWindow('post_comments.php?showID=<?php echo $row_showDetails['showID']; ?>','postit','status=yes,width=450,height=350')">none yet... click here to add.</a>
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
		echo " bgcolor=#000033";
		}
		else
		{
		echo " bgcolor=#000033";
		}
		?>>
                        <td height="2" nowrap><font color="#CCCCCC" size="1" face="Arial, Helvetica, sans-serif">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row_setlistDetails2['songNumber']."."; ?>&nbsp;&nbsp;
                              <?php if($totalRows_setlistDetails2>0) {?>
                          <a href="58_trackDetails.php?trackID=<?php echo $row_setlistDetails2['trackID']; ?>" class="linkageStuff"><?php echo $row_setlistDetails2['trackTitle']; ?></a>
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
		echo " bgcolor=#000033";
		}
		else
		{
		echo " bgcolor=#000033";
		}
		?>>
                        <td height="2" nowrap><font color="#CCCCCC" size="1" face="Arial, Helvetica, sans-serif">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row_setlistDetails3['songNumber']."."; ?>&nbsp;&nbsp;
                              <?php if($totalRows_setlistDetails3>0) {?>
                          <a href="58_trackDetails.php?trackID=<?php echo $row_setlistDetails3['trackID']; ?>" class="linkageStuff"><?php echo $row_setlistDetails3['trackTitle']; ?></a>
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
		echo " bgcolor=#000033";
		}
		else
		{
		echo " bgcolor=#000033";
		}
		?>>
                        <td height="2" nowrap><font color="#CCCCCC" size="1" face="Arial, Helvetica, sans-serif">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row_setlistDetails4['songNumber']."."; ?>&nbsp;&nbsp;&nbsp;
                              <?php if($totalRows_setlistDetails4>0) {?>
                          <a href="58_trackDetails.php?trackID=<?php echo $row_setlistDetails4['trackID']; ?>" class="linkageStuff"><?php echo $row_setlistDetails4['trackTitle']; ?></a>
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
			  
              <br />
              
			  <table width="250" border="0" cellspacing="0" cellpadding="4">
			<tr>
      <td><font size="1" face="Arial, Helvetica, sans-serif">[SHOW NOTES]<br>
			  <font color="#FFFFFF"><?php echo $row_showDetails['showComments']; ?>
              </font> </font>

  <br /><p><br /></p></td>
            <td align="right" valign="top"></td></tr><tr><td>
			<br>
		 </td>
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

</td><td valign="top" bgcolor="#000000"><img src="images/google_spacer.gif" height="150" width="160"><br/>
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

mysql_free_result($setlistDetails2);

mysql_free_result($setlistDetails3);

mysql_free_result($setlistDetails4);


mysql_free_result($showComments);

mysql_free_result($memberName);

mysql_free_result($attendedShow);

mysql_free_result($attendingMembers);

mysql_free_result($perfImages);

?>
