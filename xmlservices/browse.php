<?php require_once('../Connections/radioRecords.php'); ?>
<?php

//discover what type we're browsing for...
$browsingType="";

mysql_select_db($database_radioRecords, $radioRecords);

if(isset($HTTP_GET_VARS['cityID']))
{
	$browsingType="city";
}
elseif(isset($HTTP_GET_VARS['localityID']))
{
	$browsingType="locality";
}
elseif(isset($HTTP_GET_VARS['countryID']))
{
	$browsingType="country";
}
elseif(isset($HTTP_GET_VARS['venueID']))
{
	$browsingType="venue";
}


switch($browsingType)
{
	case "venue":
	
	$colname_venueGrouping = "9999";
	if (isset($HTTP_GET_VARS['venueID'])) {
  		$colname_venueGrouping = (get_magic_quotes_gpc()) ? $HTTP_GET_VARS['venueID'] : addslashes($HTTP_GET_VARS['venueID']);
	}
	$query_venueGrouping = sprintf("SELECT DISTINCT venuedetails.venueCapacity, venuedetails.venueID, countryresolver.countryID, countryresolver.countryName, showlist_db.showID, cityresolver.cityID, cityresolver.cityName, venuedetails.venueAddress, localityresolver.localityName, cityresolver.localityID, venuedetails.venueName, showlist_db.showDate FROM countryresolver, cityresolver, venuedetails, showlist_db, localityresolver WHERE localityresolver.countryID = countryresolver.countryID AND localityresolver.localityID = cityresolver.localityID AND showlist_db.showVenueID = venuedetails.venueID AND cityresolver.cityID = venuedetails.venueCity AND venuedetails.venueID = %s ORDER BY showlist_db.showDate DESC", $colname_venueGrouping);
	$venueGrouping = mysql_query($query_venueGrouping, $radioRecords) or die(mysql_error());
	$row_venueGrouping = mysql_fetch_assoc($venueGrouping);
	$totalRows_venueGrouping = mysql_num_rows($venueGrouping);
	
	$targetRecordset = $venueGrouping;
	$targetRecordsetRow = $row_venueGrouping;
	break;
	case "city":
	
	$colname_cityGrouping = "999";
	if (isset($HTTP_GET_VARS['cityID'])) {
  		$colname_cityGrouping = (get_magic_quotes_gpc()) ? $HTTP_GET_VARS['cityID'] : addslashes($HTTP_GET_VARS['cityID']);
	}
	$query_cityGrouping = sprintf("SELECT DISTINCT countryresolver.countryID, countryresolver.countryName, cityresolver.cityLat, cityresolver.cityLon, cityresolver.gmapZ, showlist_db.showID, cityresolver.cityID, cityresolver.cityName, localityresolver.localityName, cityresolver.localityID, venuedetails.venueName, venuedetails.venueID, showlist_db.showDate FROM countryresolver, cityresolver, venuedetails, showlist_db, localityresolver WHERE localityresolver.countryID = countryresolver.countryID AND localityresolver.localityID = cityresolver.localityID AND showlist_db.showVenueID = venuedetails.venueID AND cityresolver.cityID = venuedetails.venueCity AND venuedetails.venueCity = %s ORDER BY showlist_db.showDate DESC", $colname_cityGrouping);
	$cityGrouping = mysql_query($query_cityGrouping, $radioRecords) or die(mysql_error());
	$row_cityGrouping = mysql_fetch_assoc($cityGrouping);
	$totalRows_cityGrouping = mysql_num_rows($cityGrouping);
	
	$targetRecordset = $cityGrouping;
	$targetRecordsetRow = $row_cityGrouping;
	break;
	case "locality":
	
	
	$colname_localityGrouping = "999";
	if (isset($HTTP_GET_VARS['localityID'])) {
  		$colname_localityGrouping = (get_magic_quotes_gpc()) ? $HTTP_GET_VARS['localityID'] : addslashes($HTTP_GET_VARS['localityID']);
	}
	$query_localityGrouping = sprintf("SELECT DISTINCT countryresolver.countryName, countryresolver.countryID, showlist_db.showID, cityresolver.cityID, cityresolver.cityName, cityresolver.localityID, venuedetails.venueName, venuedetails.venueID, showlist_db.showDate, localityresolver.localityName FROM countryresolver, cityresolver, venuedetails, showlist_db, localityresolver WHERE countryresolver.countryID = localityresolver.countryID AND showlist_db.showVenueID = venuedetails.venueID AND cityresolver.cityID = venuedetails.venueCity AND venuedetails.venueCity = cityresolver.cityID AND cityresolver.localityID= %s AND localityresolver.localityID = cityresolver.localityID ORDER BY showlist_db.showDate DESC", $colname_localityGrouping);
	$localityGrouping = mysql_query($query_localityGrouping, $radioRecords) or die(mysql_error());
	$row_localityGrouping = mysql_fetch_assoc($localityGrouping);
	$totalRows_localityGrouping = mysql_num_rows($localityGrouping);

	
	$targetRecordset = $localityGrouping;
	$targetRecordsetRow = $row_localityGrouping;
	break;
	case "country":
	
	$colname_countryGrouping = "9999";
	if (isset($HTTP_GET_VARS['countryID'])) {
		$colname_countryGrouping = (get_magic_quotes_gpc()) ? $HTTP_GET_VARS['countryID'] : addslashes($HTTP_GET_VARS['countryID']);
	}
	$query_countryGrouping = sprintf("SELECT DISTINCT countryresolver.countryID, countryresolver.countryName, showlist_db.showID, venuedetails.venueName, venuedetails.venueID, showlist_db.showDate, localityresolver.localityName, localityresolver.localityID, cityresolver.cityName, cityresolver.cityID FROM cityresolver, venuedetails, showlist_db, localityresolver, countryresolver WHERE showlist_db.showVenueID = venuedetails.venueID AND cityresolver.cityID = venuedetails.venueCity AND venuedetails.venueCity = cityresolver.cityID AND countryresolver.countryID = localityresolver.countryID AND countryresolver.countryID= %s AND localityresolver.localityID = cityresolver.localityID ORDER BY showlist_db.showDate DESC", $colname_countryGrouping);
	$countryGrouping = mysql_query($query_countryGrouping, $radioRecords) or die(mysql_error());
	$row_countryGrouping = mysql_fetch_assoc($countryGrouping);
	$totalRows_countryGrouping = mysql_num_rows($countryGrouping);
	
	$targetRecordset = $countryGrouping;
	$targetRecordsetRow = $row_countryGrouping;
	break;
}

header("Content-type: text/xml; charset=ISO-8859-1");
echo '<?xml version="1.0" encoding="ISO-8859-1"?>';
if(isset($targetRecordsetRow['venueID']))
{
	echo "\n<response method=\"browse\" status=\"success\">";
	echo "\n\t<results type=\"".$browsingType."\">";
	// eventually implement this so that we can streamline things
	//if($browsingType=="venue")
	//{
	//	$constring=" venueName=\"\"
	//}
	//echo "<constants 
	do{
		echo "\n\t\t<fitem fid=\"".$targetRecordsetRow['showID']."\" date=\"".$targetRecordsetRow['showDate']."\" venueName=\"".urlencode($targetRecordsetRow['venueName'])."\" venueID=\"".$targetRecordsetRow['venueID']."\" cityName=\"".urlencode($targetRecordsetRow['cityName'])."\" cityID=\"".$targetRecordsetRow['cityID']."\" localityName=\"".urlencode($targetRecordsetRow['localityName'])."\" localityID=\"".$targetRecordsetRow['localityID']."\" countryName=\"".urlencode($targetRecordsetRow['countryName'])."\" countryID=\"".$targetRecordsetRow['countryID']."\" />";
	}while ($targetRecordsetRow = mysql_fetch_assoc($targetRecordset));
	echo "\n\t".'</results>';
}
else echo "\n<response method=\"browse\" status=\"failed\">";
echo "\n</response>";

mysql_close($radioRecords);

if(isset($targetRecordset)) mysql_free_result($targetRecordset);
?>
