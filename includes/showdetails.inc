<?
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
$query_showDetails = sprintf("SELECT showlist_db.showEventName, showlist_db.showTourLeg, showlist_db.showSupport1, showlist_db.showComments, countryresolver.countryName, countryresolver.countryID, localityresolver.localityName, localityresolver.localityID, cityresolver.cityName, cityresolver.cityID, venuedetails.venueName, showlist_db.showID, venuedetails.venueID, showlist_db.showDate FROM showlist_db, venuedetails, cityresolver, localityresolver, countryresolver WHERE cityresolver.localityID = localityresolver.localityID AND localityresolver.countryID = countryresolver.countryID AND venuedetails.venueCity = cityresolver.cityID AND venuedetails.venueID = showlist_db.showVenueID AND showlist_db.showID = %s", $colname_showDetails);
$showDetails = mysql_query($query_showDetails, $radioRecords) or die(mysql_error());
$row_showDetails = mysql_fetch_assoc($showDetails);
$totalRows_showDetails = mysql_num_rows($showDetails);

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
$query_limit_showComments = sprintf("%s LIMIT %d, %d", $query_showComments, $startRow_showComments, $maxRows_showComments);
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
$nextShow = mysql_query("SELECT showID,showDate FROM showlist_db WHERE showDate > $targetShow ORDER BY showDate DESC LIMIT 1", $radioRecords) or die(mysql_error());
$row_nextShow = mysql_fetch_assoc($nextShow);
$totalRows_nextShow = mysql_num_rows($nextShow);

$targetPrevShow=$row_showDetails['showDate'];
$prevShow = mysql_query("SELECT showID,showDate FROM showlist_db WHERE showDate < $targetShow ORDER BY showDate DESC LIMIT 1", $radioRecords) or die(mysql_error());
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