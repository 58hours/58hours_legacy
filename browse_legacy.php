<?php require_once('Connections/radioRecords.php'); ?>
<?php

$colname_availableCountries = "999";
if (isset($HTTP_GET_VARS['viewAll'])) {
  $colname_availableCountries = (get_magic_quotes_gpc()) ? $HTTP_GET_VARS['viewAll'] : addslashes($HTTP_GET_VARS['viewAll']);
}
mysql_select_db($database_radioRecords, $radioRecords);
$query_availableCountries = sprintf("SELECT DISTINCT countryresolver.countryID, countryresolver.countryName FROM countryresolver, cityresolver, venuedetails, showlist_db, localityresolver WHERE localityresolver.countryID = countryresolver.countryID AND localityresolver.localityID = cityresolver.localityID AND showlist_db.showVenueID = venuedetails.venueID AND cityresolver.cityID = venuedetails.venueCity AND '%s' = 'countries' ORDER BY countryresolver.countryName", $colname_availableCountries);
$availableCountries = mysql_query($query_availableCountries, $radioRecords) or die(mysql_error());
$row_availableCountries = mysql_fetch_assoc($availableCountries);
$totalRows_availableCountries = mysql_num_rows($availableCountries);

$colname_cityGrouping = "999";
if (isset($HTTP_GET_VARS['cityID'])) {
  $colname_cityGrouping = (get_magic_quotes_gpc()) ? $HTTP_GET_VARS['cityID'] : addslashes($HTTP_GET_VARS['cityID']);
}
mysql_select_db($database_radioRecords, $radioRecords);
$query_cityGrouping = sprintf("SELECT DISTINCT countryresolver.countryID, countryresolver.countryName, showlist_db.showID, cityresolver.cityID, cityresolver.cityName, localityresolver.localityName, cityresolver.localityID, venuedetails.venueName, venuedetails.venueID, showlist_db.showDate FROM countryresolver, cityresolver, venuedetails, showlist_db, localityresolver WHERE localityresolver.countryID = countryresolver.countryID AND localityresolver.localityID = cityresolver.localityID AND showlist_db.showVenueID = venuedetails.venueID AND cityresolver.cityID = venuedetails.venueCity AND venuedetails.venueCity = %s ORDER BY showlist_db.showDate DESC", $colname_cityGrouping);
$cityGrouping = mysql_query($query_cityGrouping, $radioRecords) or die(mysql_error());
$row_cityGrouping = mysql_fetch_assoc($cityGrouping);
$totalRows_cityGrouping = mysql_num_rows($cityGrouping);

$colname_localityGrouping = "999";
if (isset($HTTP_GET_VARS['localityID'])) {
  $colname_localityGrouping = (get_magic_quotes_gpc()) ? $HTTP_GET_VARS['localityID'] : addslashes($HTTP_GET_VARS['localityID']);
}
mysql_select_db($database_radioRecords, $radioRecords);
$query_localityGrouping = sprintf("SELECT DISTINCT countryresolver.countryName, countryresolver.countryID, showlist_db.showID, cityresolver.cityID, cityresolver.cityName, cityresolver.localityID, venuedetails.venueName, venuedetails.venueID, showlist_db.showDate, localityresolver.localityName FROM countryresolver, cityresolver, venuedetails, showlist_db, localityresolver WHERE countryresolver.countryID = localityresolver.countryID AND showlist_db.showVenueID = venuedetails.venueID AND cityresolver.cityID = venuedetails.venueCity AND venuedetails.venueCity = cityresolver.cityID AND cityresolver.localityID= %s AND localityresolver.localityID = cityresolver.localityID ORDER BY showlist_db.showDate DESC", $colname_localityGrouping);
$localityGrouping = mysql_query($query_localityGrouping, $radioRecords) or die(mysql_error());
$row_localityGrouping = mysql_fetch_assoc($localityGrouping);
$totalRows_localityGrouping = mysql_num_rows($localityGrouping);

mysql_select_db($database_radioRecords, $radioRecords);
$query_allTitles = "SELECT * FROM titleresolver ORDER BY trackTitle ASC";
$allTitles = mysql_query($query_allTitles, $radioRecords) or die(mysql_error());
$row_allTitles = mysql_fetch_assoc($allTitles);
$totalRows_allTitles = mysql_num_rows($allTitles);

$colname_venueGrouping = "9999";
if (isset($HTTP_GET_VARS['venueID'])) {
  $colname_venueGrouping = (get_magic_quotes_gpc()) ? $HTTP_GET_VARS['venueID'] : addslashes($HTTP_GET_VARS['venueID']);
}
mysql_select_db($database_radioRecords, $radioRecords);
$query_venueGrouping = sprintf("SELECT DISTINCT venuedetails.venueCapacity, venuedetails.venueID, countryresolver.countryID, countryresolver.countryName, showlist_db.showID, cityresolver.cityID, cityresolver.cityName, venuedetails.venueAddress, localityresolver.localityName, cityresolver.localityID, venuedetails.venueName, showlist_db.showDate FROM countryresolver, cityresolver, venuedetails, showlist_db, localityresolver WHERE localityresolver.countryID = countryresolver.countryID AND localityresolver.localityID = cityresolver.localityID AND showlist_db.showVenueID = venuedetails.venueID AND cityresolver.cityID = venuedetails.venueCity AND venuedetails.venueID = %s ORDER BY showlist_db.showDate DESC", $colname_venueGrouping);
$venueGrouping = mysql_query($query_venueGrouping, $radioRecords) or die(mysql_error());
$row_venueGrouping = mysql_fetch_assoc($venueGrouping);
$totalRows_venueGrouping = mysql_num_rows($venueGrouping);

$colname_countryGrouping = "9999";
if (isset($HTTP_GET_VARS['countryID'])) {
  $colname_countryGrouping = (get_magic_quotes_gpc()) ? $HTTP_GET_VARS['countryID'] : addslashes($HTTP_GET_VARS['countryID']);
}
mysql_select_db($database_radioRecords, $radioRecords);
$query_countryGrouping = sprintf("SELECT DISTINCT countryresolver.countryID, countryresolver.countryName, showlist_db.showID, venuedetails.venueName, venuedetails.venueID, showlist_db.showDate, localityresolver.localityName FROM cityresolver, venuedetails, showlist_db, localityresolver, countryresolver WHERE showlist_db.showVenueID = venuedetails.venueID AND cityresolver.cityID = venuedetails.venueCity AND venuedetails.venueCity = cityresolver.cityID AND countryresolver.countryID = localityresolver.countryID AND countryresolver.countryID= %s AND localityresolver.localityID = cityresolver.localityID ORDER BY showlist_db.showDate DESC", $colname_countryGrouping);
$countryGrouping = mysql_query($query_countryGrouping, $radioRecords) or die(mysql_error());
$row_countryGrouping = mysql_fetch_assoc($countryGrouping);
$totalRows_countryGrouping = mysql_num_rows($countryGrouping);

$colname_availableLocalities = "7";
if (isset($HTTP_GET_VARS['countryID'])) {
  $colname_availableLocalities = (get_magic_quotes_gpc()) ? $HTTP_GET_VARS['countryID'] : addslashes($HTTP_GET_VARS['countryID']);
}
mysql_select_db($database_radioRecords, $radioRecords);
$query_availableLocalities = sprintf("SELECT DISTINCT countryresolver.countryName, countryresolver.countryID, localityresolver.localityName, localityresolver.localityID FROM showlist_db, venuedetails, cityresolver, localityresolver, countryresolver WHERE venuedetails.venueID = showlist_db.showVenueID AND localityresolver.countryID = countryresolver.countryID AND localityresolver.localityID = cityresolver.localityID AND venuedetails.venueCity = cityresolver.cityID AND countryresolver.countryID = %s ORDER BY localityresolver.localityName ASC", $colname_availableLocalities);
$availableLocalities = mysql_query($query_availableLocalities, $radioRecords) or die(mysql_error());
$row_availableLocalities = mysql_fetch_assoc($availableLocalities);
$totalRows_availableLocalities = mysql_num_rows($availableLocalities);

$colname_availableCities = "9999";
if (isset($HTTP_GET_VARS['localityID'])) {
  $colname_availableCities = (get_magic_quotes_gpc()) ? $HTTP_GET_VARS['localityID'] : addslashes($HTTP_GET_VARS['localityID']);
}
mysql_select_db($database_radioRecords, $radioRecords);
$query_availableCities = sprintf("SELECT DISTINCT cityresolver.cityName, cityresolver.cityID FROM venuedetails, cityresolver, localityresolver, showlist_db WHERE venuedetails.venueID = showlist_db.showVenueID AND venuedetails.venueCity = cityresolver.cityID AND localityresolver.localityID= cityresolver.localityID AND localityresolver.localityID = %s ORDER BY cityresolver.cityName ASC", $colname_availableCities);
$availableCities = mysql_query($query_availableCities, $radioRecords) or die(mysql_error());
$row_availableCities = mysql_fetch_assoc($availableCities);
$totalRows_availableCities = mysql_num_rows($availableCities);

$colname_availableVenues = "9999";
if (isset($HTTP_GET_VARS['cityID'])) {
  $colname_availableVenues = (get_magic_quotes_gpc()) ? $HTTP_GET_VARS['cityID'] : addslashes($HTTP_GET_VARS['cityID']);
}
mysql_select_db($database_radioRecords, $radioRecords);
$query_availableVenues = sprintf("SELECT DISTINCT venuedetails.venueName, venuedetails.venueID FROM showlist_db, venuedetails, cityresolver WHERE venuedetails.venueID = showlist_db.showVenueID AND venuedetails.venueCity = cityresolver.cityID AND cityresolver.cityID = %s ORDER BY venuedetails.venueName ASC", $colname_availableVenues);
$availableVenues = mysql_query($query_availableVenues, $radioRecords) or die(mysql_error());
$row_availableVenues = mysql_fetch_assoc($availableVenues);
$totalRows_availableVenues = mysql_num_rows($availableVenues);
?>
<?php echo "<?xml version=\"1.0\" encoding=\"iso-8859-1\"?".">"; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>58hours.com | setlist groupings</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/styles.css" rel="stylesheet" type="text/css" />
<link href="css/stylebook.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
#Layer1 {
	position:absolute;
	width:990px;
	z-index:1;
}
-->
</style>
<script type="text/javascript">
<!--
function MM_reloadPage(init) {  //reloads the window if Nav4 resized
  if (init==true) with (navigator) {if ((appName=="Netscape")&&(parseInt(appVersion)==4)) {
    document.MM_pgW=innerWidth; document.MM_pgH=innerHeight; onresize=MM_reloadPage; }}
  else if (innerWidth!=document.MM_pgW || innerHeight!=document.MM_pgH) location.reload();
}
MM_reloadPage(true);
//-->
</script>
</head>
<body bgcolor="#000000" text="#FFFFFF" link="#FFFFFF" vlink="#FFFFFF" alink="#FFFFFF" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<br />
<div id="primarycontent">
  <div id="primaryheader"><img src="images/logobar_800x113.gif" alt="58hours.com - a radiohead gig database" /></div>
  <br /><div id="dbstatusbar">
    <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,19,0" width="800" height="20">
      <param name="movie" value="flashStats.swf" />
      <param name="quality" value="high" />
      <embed src="flashStats.swf" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="800" height="20"></embed>
    </object>
    </div>
	<div class="darkerLinkage" id="browseresult">Content for class "browseresult" Goes Here</div>
    <div id="mapwrapper">Content for class "mapwrapper" Goes Here</div>
</div>


</body>
</html>
<?php
mysql_free_result($availableCountries);

mysql_free_result($cityGrouping);

mysql_free_result($localityGrouping);

mysql_free_result($allTitles);

mysql_free_result($venueGrouping);

mysql_free_result($countryGrouping);

mysql_free_result($availableLocalities);

mysql_free_result($availableCities);

mysql_free_result($availableVenues);
?>
