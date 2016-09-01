<?php 
require_once('Connections/random_connect.php');
require_once('_includes/SITEARTIST.php');
require_once('_includes/rhcommon.php');

if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

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
}

$colname_availableCountries = "999";
if (isset($_GET['viewAll'])) {
  $colname_availableCountries = (get_magic_quotes_gpc()) ? $_GET['viewAll'] : addslashes($_GET['viewAll']);
}
mysql_select_db($database_random_connect, $random_connect);
$query_availableCountries = sprintf("(SELECT DISTINCT 
	rhr_countryresolver.external_country_id AS external_country_id, rhr_countryresolver.country_name_display AS country_name_display  
	FROM rhr_countryresolver, rhr_cityresolver, rhr_venueresolver, rhr_performances, rhr_localityresolver 
	WHERE rhr_performances.external_group_id = %s 
	AND rhr_localityresolver.external_country_id = rhr_countryresolver.external_country_id 
	AND rhr_localityresolver.external_locale_id = rhr_cityresolver.external_locale_id 
	AND rhr_performances.external_venue_id = rhr_venueresolver.external_venue_id 
	AND rhr_cityresolver.external_city_id = rhr_venueresolver.external_city_id 
	AND %s = 'countries') 
	UNION
	(SELECT DISTINCT 
	rhr_countryresolver.external_country_id AS external_country_id, rhr_countryresolver.country_name_display AS country_name_display  
	FROM rhr_countryresolver, rhr_cityresolver, rhr_venueresolver, rhr_performances, rhr_localityresolver, rhr_alternatevenuenames  
	WHERE rhr_performances.external_group_id = %s 
	AND rhr_localityresolver.external_country_id = rhr_countryresolver.external_country_id 
	AND rhr_localityresolver.external_locale_id = rhr_cityresolver.external_locale_id 
	AND rhr_performances.external_venue_id = rhr_alternatevenuenames.alt_external_venue_id
	AND rhr_alternatevenuenames.primary_external_venue_id = rhr_venueresolver.external_venue_id 
	AND rhr_cityresolver.external_city_id = rhr_venueresolver.external_city_id 
	AND %s = 'countries')
	
	ORDER BY country_name_display", GetSQLValueString($INTERNAL_SITEGROUP,"text"), GetSQLValueString($colname_availableCountries, "text"), GetSQLValueString($INTERNAL_SITEGROUP,"text"), GetSQLValueString($colname_availableCountries, "text"));
$availableCountries = mysql_query($query_availableCountries, $random_connect) or die(mysql_error());
$row_availableCountries = mysql_fetch_assoc($availableCountries);
$totalRows_availableCountries = mysql_num_rows($availableCountries);

$colname_cityGrouping = "999";
if (isset($_GET['external_city_id'])) {
  $colname_cityGrouping = (get_magic_quotes_gpc()) ? $_GET['external_city_id'] : addslashes($_GET['external_city_id']);
}
mysql_select_db($database_random_connect, $random_connect);
$query_cityGrouping = sprintf("(SELECT DISTINCT 
	rhr_countryresolver.external_country_id AS external_country_id, rhr_countryresolver.country_name_display AS country_name_display, 
	rhr_cityresolver.city_lat AS citylat, 
	rhr_cityresolver.city_lng AS citylon, 
	rhr_cityresolver.gmapzoom AS gmapzoom, 
	rhr_performances.external_show_id AS external_show_id, 
	rhr_cityresolver.external_city_id AS external_city_id, 
	rhr_cityresolver.city_name_display AS city_name_display, rhr_localityresolver.locale_name_display AS locale_name_display, rhr_cityresolver.external_locale_id AS external_locale_id, 
	rhr_venueresolver.venue_name_display AS venue_name_display, 
	rhr_venueresolver.external_venue_id AS external_venue_id, 
	rhr_performances.showDate AS showDate, 
	rhr_groupresolver.group_name_display AS group_name_display 
	FROM rhr_countryresolver, rhr_cityresolver, rhr_venueresolver, rhr_performances, rhr_localityresolver, rhr_groupresolver
	WHERE rhr_performances.external_group_id = %s 
	AND rhr_localityresolver.external_country_id = rhr_countryresolver.external_country_id 
	AND rhr_localityresolver.external_locale_id = rhr_cityresolver.external_locale_id 
	AND rhr_performances.external_venue_id = rhr_venueresolver.external_venue_id 
	AND rhr_performances.external_group_id = rhr_groupresolver.external_group_id 
	AND rhr_cityresolver.external_city_id = rhr_venueresolver.external_city_id 
	AND rhr_venueresolver.external_city_id = %s) 
	UNION
	(SELECT DISTINCT 
	rhr_countryresolver.external_country_id AS external_country_id, rhr_countryresolver.country_name_display AS country_name_display, 
	rhr_cityresolver.city_lat AS citylat, 
	rhr_cityresolver.city_lng AS citylon, 
	rhr_cityresolver.gmapzoom AS gmapzoom, 
	rhr_performances.external_show_id AS external_show_id, 
	rhr_cityresolver.external_city_id AS external_city_id, 
	rhr_cityresolver.city_name_display AS city_name_display, rhr_localityresolver.locale_name_display AS locale_name_display, rhr_cityresolver.external_locale_id AS external_locale_id, 
	rhr_alternatevenuenames.venue_name_display AS venue_name_display, 
	rhr_alternatevenuenames.alt_external_venue_id AS external_venue_id, 
	rhr_performances.showDate AS showDate, 
	rhr_groupresolver.group_name_display AS group_name_display 
	FROM rhr_countryresolver, rhr_cityresolver, rhr_venueresolver, rhr_performances, rhr_localityresolver, rhr_groupresolver, rhr_alternatevenuenames 
	WHERE rhr_performances.external_group_id = %s 
	AND rhr_localityresolver.external_country_id = rhr_countryresolver.external_country_id 
	AND rhr_localityresolver.external_locale_id = rhr_cityresolver.external_locale_id 
	AND rhr_performances.external_venue_id = rhr_alternatevenuenames.alt_external_venue_id
	AND rhr_alternatevenuenames.primary_external_venue_id = rhr_venueresolver.external_venue_id 
	AND rhr_performances.external_group_id = rhr_groupresolver.external_group_id 
	AND rhr_cityresolver.external_city_id = rhr_venueresolver.external_city_id 
	AND rhr_venueresolver.external_city_id = %s)
	
	ORDER BY showDate DESC", GetSQLValueString($INTERNAL_SITEGROUP,"text"),  GetSQLValueString($colname_cityGrouping,"text"), GetSQLValueString($INTERNAL_SITEGROUP,"text"),  GetSQLValueString($colname_cityGrouping,"text"));
$cityGrouping = mysql_query($query_cityGrouping, $random_connect) or die(mysql_error());
$row_cityGrouping = mysql_fetch_assoc($cityGrouping);
$totalRows_cityGrouping = mysql_num_rows($cityGrouping);

$colname_localityGrouping = "999";
if (isset($_GET['external_locale_id'])) {
  $colname_localityGrouping = (get_magic_quotes_gpc()) ? $_GET['external_locale_id'] : addslashes($_GET['external_locale_id']);
}
mysql_select_db($database_random_connect, $random_connect);
/// begin

$query_localityGrouping = sprintf("(SELECT DISTINCT 
	rhr_countryresolver.country_name_display AS country_name_display,
	rhr_countryresolver.external_country_id AS external_country_id, 
	rhr_performances.external_show_id AS external_show_id, 
	rhr_cityresolver.external_city_id AS external_city_id, 
	rhr_cityresolver.city_name_display AS city_name_display, 
	rhr_cityresolver.external_locale_id AS external_locale_id, 
	rhr_venueresolver.venue_name_display AS venue_name_display, 
	rhr_venueresolver.external_venue_id AS external_venue_id, 
	rhr_performances.showDate AS showDate, 
	rhr_localityresolver.locale_name_display AS locale_name_display, 
	rhr_groupresolver.group_name_display AS group_name_display  
	FROM rhr_countryresolver, rhr_cityresolver, rhr_venueresolver, rhr_performances, rhr_localityresolver, rhr_groupresolver
	WHERE rhr_performances.external_group_id = %s 
	AND rhr_countryresolver.external_country_id = rhr_localityresolver.external_country_id 
	AND rhr_performances.external_venue_id = rhr_venueresolver.external_venue_id 
	AND rhr_performances.external_group_id = rhr_groupresolver.external_group_id 
	AND rhr_cityresolver.external_city_id = rhr_venueresolver.external_city_id 
	AND rhr_venueresolver.external_city_id = rhr_cityresolver.external_city_id 
	AND rhr_cityresolver.external_locale_id= %s 
	AND rhr_localityresolver.external_locale_id = rhr_cityresolver.external_locale_id)
	UNION
	(SELECT DISTINCT 
	rhr_countryresolver.country_name_display AS country_name_display,
	rhr_countryresolver.external_country_id AS external_country_id, 
	rhr_performances.external_show_id AS external_show_id, 
	rhr_cityresolver.external_city_id AS external_city_id, 
	rhr_cityresolver.city_name_display AS city_name_display, 
	rhr_cityresolver.external_locale_id AS external_locale_id, 
	rhr_alternatevenuenames.venue_name_display AS venue_name_display, 
	rhr_alternatevenuenames.alt_external_venue_id AS external_venue_id, 
	rhr_performances.showDate AS showDate, 
	rhr_localityresolver.locale_name_display AS locale_name_display, 
	rhr_groupresolver.group_name_display AS group_name_display  
	FROM rhr_countryresolver, rhr_cityresolver, rhr_venueresolver, rhr_performances, rhr_localityresolver, rhr_groupresolver, rhr_alternatevenuenames 
	WHERE rhr_performances.external_group_id = %s 
	AND rhr_countryresolver.external_country_id = rhr_localityresolver.external_country_id 
	AND rhr_performances.external_venue_id = rhr_alternatevenuenames.alt_external_venue_id
	AND rhr_alternatevenuenames.primary_external_venue_id = rhr_venueresolver.external_venue_id
	AND rhr_performances.external_group_id = rhr_groupresolver.external_group_id 
	AND rhr_cityresolver.external_city_id = rhr_venueresolver.external_city_id 
	AND rhr_venueresolver.external_city_id = rhr_cityresolver.external_city_id 
	AND rhr_cityresolver.external_locale_id= %s 
	AND rhr_localityresolver.external_locale_id = rhr_cityresolver.external_locale_id) 
	ORDER BY showDate DESC", GetSQLValueString($INTERNAL_SITEGROUP,"text"),  GetSQLValueString($colname_localityGrouping,"text"), GetSQLValueString($INTERNAL_SITEGROUP,"text"),  GetSQLValueString($colname_localityGrouping,"text"));

/// end
$localityGrouping = mysql_query($query_localityGrouping, $random_connect) or die(mysql_error());
$row_localityGrouping = mysql_fetch_assoc($localityGrouping);
$totalRows_localityGrouping = mysql_num_rows($localityGrouping);


mysql_select_db($database_random_connect, $random_connect);
$query_allTitles = "SELECT * FROM rhr_titleresolver ORDER BY song_name_display ASC";
$allTitles = mysql_query($query_allTitles, $random_connect) or die(mysql_error());
$row_allTitles = mysql_fetch_assoc($allTitles);
$totalRows_allTitles = mysql_num_rows($allTitles);

$colname_venueGrouping = "9999";
if (isset($_GET['external_venue_id'])) {
  $colname_venueGrouping = (get_magic_quotes_gpc()) ? $_GET['external_venue_id'] : addslashes($_GET['external_venue_id']);
}
mysql_select_db($database_random_connect, $random_connect);
$query_venueGrouping = sprintf("(SELECT DISTINCT 
	rhr_venueresolver.venueCapacity AS venueCapacity, 
	rhr_venueresolver.external_venue_id AS external_venue_id, 
	rhr_countryresolver.external_country_id AS external_country_id, 
	rhr_countryresolver.country_name_display AS country_name_display, 
	rhr_performances.external_show_id AS external_show_id, 
	rhr_cityresolver.external_city_id AS external_city_id, 
	rhr_cityresolver.city_name_display AS city_name_display, 
	rhr_venueresolver.venue_address AS venue_address, 
	rhr_localityresolver.locale_name_display AS locale_name_display, 
	rhr_cityresolver.external_locale_id AS external_locale_id, 
	rhr_venueresolver.venue_name_display AS venue_name_display, 
	rhr_performances.showDate AS showDate, 
	rhr_groupresolver.group_name_display AS group_name_display    
	FROM rhr_countryresolver, rhr_cityresolver, rhr_venueresolver, rhr_performances, rhr_localityresolver, rhr_groupresolver 
	WHERE rhr_performances.external_group_id = %s 
	AND rhr_localityresolver.external_country_id = rhr_countryresolver.external_country_id 
	AND rhr_localityresolver.external_locale_id = rhr_cityresolver.external_locale_id 
	AND rhr_performances.external_venue_id = rhr_venueresolver.external_venue_id 
	AND rhr_performances.external_group_id = rhr_groupresolver.external_group_id 
	AND rhr_cityresolver.external_city_id = rhr_venueresolver.external_city_id 
	AND rhr_venueresolver.external_venue_id = %s)
	UNION
	(SELECT DISTINCT 
	rhr_venueresolver.venueCapacity AS venueCapacity, 
	rhr_venueresolver.external_venue_id AS external_venue_id, 
	rhr_countryresolver.external_country_id AS external_country_id, 
	rhr_countryresolver.country_name_display AS country_name_display, 
	rhr_performances.external_show_id AS external_show_id, 
	rhr_cityresolver.external_city_id AS external_city_id, 
	rhr_cityresolver.city_name_display AS city_name_display, 
	rhr_venueresolver.venue_address AS venue_address, 
	rhr_localityresolver.locale_name_display AS locale_name_display, 
	rhr_cityresolver.external_locale_id AS external_locale_id, 
	rhr_venueresolver.venue_name_display AS venue_name_display, 
	rhr_performances.showDate AS showDate, 
	rhr_groupresolver.group_name_display AS group_name_display    
	FROM rhr_countryresolver, rhr_cityresolver, rhr_venueresolver, rhr_performances, rhr_localityresolver, rhr_groupresolver, rhr_alternatevenuenames  
	WHERE rhr_performances.external_group_id = %s 
	AND rhr_localityresolver.external_country_id = rhr_countryresolver.external_country_id 
	AND rhr_localityresolver.external_locale_id = rhr_cityresolver.external_locale_id 
	AND rhr_performances.external_venue_id = rhr_alternatevenuenames.alt_external_venue_id 
	AND rhr_alternatevenuenames.primary_external_venue_id = rhr_venueresolver.external_venue_id 
	AND rhr_performances.external_group_id = rhr_groupresolver.external_group_id 
	AND rhr_cityresolver.external_city_id = rhr_venueresolver.external_city_id 
	AND rhr_alternatevenuenames.alt_external_venue_id = %s)
	ORDER BY showDate DESC", GetSQLValueString($INTERNAL_SITEGROUP,"text"), GetSQLValueString($colname_venueGrouping,"text"), GetSQLValueString($INTERNAL_SITEGROUP,"text"), GetSQLValueString($colname_venueGrouping,"text"));

////

$venueGrouping = mysql_query($query_venueGrouping, $random_connect) or die(mysql_error());
$row_venueGrouping = mysql_fetch_assoc($venueGrouping);
$totalRows_venueGrouping = mysql_num_rows($venueGrouping);
if($totalRows_venueGrouping>0)
{
	// if we have results for the venue grouping, then we need to lookup other alternate names
	$query_altNamesGrouping = sprintf("SELECT DISTINCT rhr_alternatevenuenames.venue_name_display   
	FROM rhr_venueresolver, rhr_alternatevenuenames  
	WHERE rhr_alternatevenuenames.primary_external_venue_id = %s 
	ORDER BY rhr_alternatevenuenames.venue_name_sortable DESC", GetSQLValueString($row_venueGrouping['external_venue_id'],"text"));
	$altNamesGrouping = mysql_query($query_altNamesGrouping, $random_connect) or die(mysql_error());
	$row_altNamesGrouping = mysql_fetch_assoc($altNamesGrouping);
	$totalRows_altNamesGrouping = mysql_num_rows($altNamesGrouping);

}

$colname_countryGrouping = "9999";
if (isset($_GET['external_country_id'])) {
  $colname_countryGrouping = (get_magic_quotes_gpc()) ? $_GET['external_country_id'] : addslashes($_GET['external_country_id']);
}
mysql_select_db($database_random_connect, $random_connect);
$query_countryGrouping = sprintf("(SELECT DISTINCT 
	rhr_countryresolver.external_country_id AS external_country_id, rhr_countryresolver.country_name_display AS country_name_display, 
	rhr_performances.external_show_id AS external_show_id, 
	rhr_venueresolver.venue_name_display AS venue_name_display, 
	rhr_venueresolver.external_venue_id AS external_venue_id, 
	rhr_performances.showDate AS showDate, 
	rhr_localityresolver.locale_name_display AS locale_name_display, rhr_groupresolver.group_name_display AS group_name_display  
	FROM rhr_cityresolver, rhr_venueresolver, rhr_performances, rhr_localityresolver, rhr_countryresolver, rhr_groupresolver 
	WHERE rhr_performances.external_group_id = %s 
	AND rhr_performances.external_venue_id = rhr_venueresolver.external_venue_id 
	AND rhr_performances.external_group_id = rhr_groupresolver.external_group_id 
	AND rhr_cityresolver.external_city_id = rhr_venueresolver.external_city_id 
	AND rhr_venueresolver.external_city_id = rhr_cityresolver.external_city_id 
	AND rhr_countryresolver.external_country_id = rhr_localityresolver.external_country_id 
	AND rhr_countryresolver.external_country_id= %s 
	AND rhr_localityresolver.external_locale_id = rhr_cityresolver.external_locale_id) 
	UNION
	(SELECT DISTINCT 
	rhr_countryresolver.external_country_id AS external_country_id, rhr_countryresolver.country_name_display AS country_name_display, 
	rhr_performances.external_show_id AS external_show_id, 
	rhr_alternatevenuenames.venue_name_display AS venue_name_display, 
	rhr_alternatevenuenames.alt_external_venue_id AS external_venue_id, 
	rhr_performances.showDate AS showDate, 
	rhr_localityresolver.locale_name_display AS locale_name_display, rhr_groupresolver.group_name_display AS group_name_display  
	FROM rhr_cityresolver, rhr_venueresolver, rhr_performances, rhr_localityresolver, rhr_countryresolver, rhr_groupresolver, rhr_alternatevenuenames  
	WHERE rhr_performances.external_group_id = %s 
	AND rhr_performances.external_venue_id = rhr_alternatevenuenames.alt_external_venue_id 
	AND rhr_alternatevenuenames.primary_external_venue_id = rhr_venueresolver.external_venue_id 
	AND rhr_performances.external_group_id = rhr_groupresolver.external_group_id 
	AND rhr_cityresolver.external_city_id = rhr_venueresolver.external_city_id 
	AND rhr_venueresolver.external_city_id = rhr_cityresolver.external_city_id 
	AND rhr_countryresolver.external_country_id = rhr_localityresolver.external_country_id 
	AND rhr_countryresolver.external_country_id= %s 
	AND rhr_localityresolver.external_locale_id = rhr_cityresolver.external_locale_id)
	
	ORDER BY showDate DESC", GetSQLValueString($INTERNAL_SITEGROUP,"text"), GetSQLValueString($colname_countryGrouping,"text"), GetSQLValueString($INTERNAL_SITEGROUP,"text"), GetSQLValueString($colname_countryGrouping,"text"));
$countryGrouping = mysql_query($query_countryGrouping, $random_connect) or die(mysql_error());
$row_countryGrouping = mysql_fetch_assoc($countryGrouping);
$totalRows_countryGrouping = mysql_num_rows($countryGrouping);

$colname_availableLocalities = "7";
if (isset($_GET['external_country_id'])) {
  $colname_availableLocalities = (get_magic_quotes_gpc()) ? $_GET['external_country_id'] : addslashes($_GET['external_country_id']);
}
mysql_select_db($database_random_connect, $random_connect);
$query_availableLocalities = sprintf("(SELECT DISTINCT 
	rhr_countryresolver.country_name_display AS country_name_display, rhr_countryresolver.external_country_id AS external_country_id, rhr_localityresolver.locale_name_display AS locale_name_display, rhr_localityresolver.external_locale_id AS external_locale_id 
	FROM rhr_performances, rhr_venueresolver, rhr_cityresolver, rhr_localityresolver, rhr_countryresolver 
	WHERE rhr_performances.external_group_id = %s 
	AND rhr_venueresolver.external_venue_id = rhr_performances.external_venue_id 
	AND rhr_localityresolver.external_country_id = rhr_countryresolver.external_country_id 
	AND rhr_localityresolver.external_locale_id = rhr_cityresolver.external_locale_id 
	AND rhr_venueresolver.external_city_id = rhr_cityresolver.external_city_id 
	AND rhr_countryresolver.external_country_id = %s)
	UNION
	(SELECT DISTINCT 
	rhr_countryresolver.country_name_display AS country_name_display, rhr_countryresolver.external_country_id AS external_country_id, rhr_localityresolver.locale_name_display AS locale_name_display, rhr_localityresolver.external_locale_id AS external_locale_id 
	FROM rhr_performances, rhr_venueresolver, rhr_cityresolver, rhr_localityresolver, rhr_countryresolver, rhr_alternatevenuenames  
	WHERE rhr_performances.external_group_id = %s 
	AND rhr_venueresolver.external_venue_id = rhr_alternatevenuenames.primary_external_venue_id
	AND rhr_alternatevenuenames.alt_external_venue_id = rhr_performances.external_venue_id 
	AND rhr_localityresolver.external_country_id = rhr_countryresolver.external_country_id 
	AND rhr_localityresolver.external_locale_id = rhr_cityresolver.external_locale_id 
	AND rhr_venueresolver.external_city_id = rhr_cityresolver.external_city_id 
	AND rhr_countryresolver.external_country_id = %s)
	
	ORDER BY locale_name_display ASC", GetSQLValueString($INTERNAL_SITEGROUP,"text"), GetSQLValueString($colname_availableLocalities,"text"), GetSQLValueString($INTERNAL_SITEGROUP,"text"), GetSQLValueString($colname_availableLocalities,"text"));
$availableLocalities = mysql_query($query_availableLocalities, $random_connect) or die(mysql_error());
$row_availableLocalities = mysql_fetch_assoc($availableLocalities);
$totalRows_availableLocalities = mysql_num_rows($availableLocalities);

$colname_availableCities = "9999";
if (isset($_GET['external_locale_id'])) {
  $colname_availableCities = (get_magic_quotes_gpc()) ? $_GET['external_locale_id'] : addslashes($_GET['external_locale_id']);
}
mysql_select_db($database_random_connect, $random_connect);
$query_availableCities = sprintf("(SELECT DISTINCT
	rhr_cityresolver.city_name_display AS city_name_display, 
	rhr_cityresolver.external_city_id AS external_city_id  
	FROM rhr_venueresolver, rhr_cityresolver, rhr_localityresolver, rhr_performances 
	WHERE rhr_performances.external_group_id = %s 
	AND rhr_venueresolver.external_venue_id = rhr_performances.external_venue_id 
	AND rhr_venueresolver.external_city_id = rhr_cityresolver.external_city_id 
	AND rhr_localityresolver.external_locale_id= rhr_cityresolver.external_locale_id
	AND rhr_localityresolver.external_locale_id = %s)
	UNION
	(SELECT DISTINCT
	rhr_cityresolver.city_name_display AS city_name_display, 
	rhr_cityresolver.external_city_id AS external_city_id  
	FROM rhr_venueresolver, rhr_cityresolver, rhr_localityresolver, rhr_performances, rhr_alternatevenuenames  
	WHERE rhr_performances.external_group_id = %s 
	AND rhr_venueresolver.external_venue_id = rhr_alternatevenuenames.primary_external_venue_id 
	AND rhr_alternatevenuenames.alt_external_venue_id = rhr_performances.external_venue_id 
	AND rhr_venueresolver.external_city_id = rhr_cityresolver.external_city_id 
	AND rhr_localityresolver.external_locale_id= rhr_cityresolver.external_locale_id
	AND rhr_localityresolver.external_locale_id = %s)
	
	ORDER BY city_name_display ASC", GetSQLValueString($INTERNAL_SITEGROUP,"text"), GetSQLValueString($colname_availableCities,"text"), GetSQLValueString($INTERNAL_SITEGROUP,"text"), GetSQLValueString($colname_availableCities,"text"));
	
$availableCities = mysql_query($query_availableCities, $random_connect) or die(mysql_error());
$row_availableCities = mysql_fetch_assoc($availableCities);
$totalRows_availableCities = mysql_num_rows($availableCities);

$colname_availableVenues = "9999";
if (isset($_GET['external_city_id'])) {
  $colname_availableVenues = (get_magic_quotes_gpc()) ? $_GET['external_city_id'] : addslashes($_GET['external_city_id']);
}
mysql_select_db($database_random_connect, $random_connect);
$query_availableVenues = sprintf("(SELECT DISTINCT
	rhr_venueresolver.venue_name_display AS venue_name_display, 
	rhr_venueresolver.external_venue_id AS external_venue_id 
	FROM rhr_performances, rhr_venueresolver, rhr_cityresolver 
	WHERE rhr_performances.external_group_id = %s 
	AND rhr_venueresolver.external_venue_id = rhr_performances.external_venue_id 
	AND rhr_venueresolver.external_city_id = rhr_cityresolver.external_city_id 
	AND rhr_cityresolver.external_city_id = %s)
	UNION
	(SELECT DISTINCT
	rhr_alternatevenuenames.venue_name_display AS venue_name_display, 
	rhr_alternatevenuenames.alt_external_venue_id AS external_venue_id 
	FROM rhr_performances, rhr_venueresolver, rhr_cityresolver, rhr_alternatevenuenames  
	WHERE rhr_performances.external_group_id = %s 
	AND rhr_alternatevenuenames.alt_external_venue_id = rhr_performances.external_venue_id
	AND rhr_venueresolver.external_venue_id = rhr_alternatevenuenames.primary_external_venue_id 
	AND rhr_venueresolver.external_city_id = rhr_cityresolver.external_city_id 
	AND rhr_cityresolver.external_city_id = %s)
	
	ORDER BY venue_name_display ASC", GetSQLValueString($INTERNAL_SITEGROUP,"text"), GetSQLValueString($colname_availableVenues,"text"), GetSQLValueString($INTERNAL_SITEGROUP,"text"), GetSQLValueString($colname_availableVenues,"text"));
$availableVenues = mysql_query($query_availableVenues, $random_connect) or die(mysql_error());
$row_availableVenues = mysql_fetch_assoc($availableVenues);
$totalRows_availableVenues = mysql_num_rows($availableVenues);

//////
/*
$colname_alternateVenueNames = "1";
if (isset($_GET['external_venue_id'])) {
  $colname_alternateVenueNames = (get_magic_quotes_gpc()) ? $_GET['external_venue_id'] : addslashes($_GET['external_venue_id']);
}
//mysql_select_db($database_random_connect, $random_connect);
$query_alternateVenueNames = sprintf("SELECT alternatevenuenames.venue_name_display 
FROM alternatevenuenames 
WHERE alternatevenuenames.external_venue_id = %s", GetSQLValueString($colname_alternateVenueNames,"text"));
$alternateVenueNames = mysql_query($query_alternateVenueNames, $random_connect) or die(mysql_error());
$row_alternateVenueNames = mysql_fetch_assoc($alternateVenueNames);
$totalRows_alternateVenueNames = mysql_num_rows($alternateVenueNames);
*/
//////



?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>58hours.com | setlist groupings</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<?php if (($totalRows_cityGrouping > 0)&&($row_cityGrouping['citylat']!=null)) { // Show if recordset not empty ?>
	  
	  <script type="text/javascript">
<!--
function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}
//-->
</script>
	  <?php } ?>
<link href="css/styles.css" rel="stylesheet" type="text/css" />
<link href="css/stylebook.css" rel="stylesheet" type="text/css" />
<script src="Scripts/AC_RunActiveContent.js" type="text/javascript"></script>
</head>
<body onload="load()" onunload="GUnload()">
<a href="/"><img src="i/rainbowheader_v2.jpg" width="800" height="114" border="0"></a>

<?php if ($totalRows_venueGrouping > 0) { // Show if recordset not empty ?>
<a href="browse.php?external_city_id=<?php echo $row_venueGrouping['external_city_id']; ?>" class="linkageStuff"><?php echo $row_venueGrouping['city_name_display']; ?></a> | 
<a href="browse.php?external_locale_id=<?php echo $row_venueGrouping['external_locale_id']; ?>" class="linkageStuff"><?php echo $row_venueGrouping['locale_name_display']; ?></a> | 
<a href="browse.php?external_country_id=<?php echo $row_venueGrouping['external_country_id']; ?>" class="linkageStuff"><?php echo $row_venueGrouping['country_name_display']; ?></a>
Browse by: <a href="index.php?browse=showDate" class="darkerLinkage">date</a><span class="darkerLinkage"> | <a href="index.php?browse=showVenue" class="darkerLinkage">venue</a>  | <a href="index.php?browse=songTitle" class="darkerLinkage">song title</a> </span>
<?php } // Show if recordset not empty ?>
<?php if ($totalRows_cityGrouping > 0) { 
	$internalCountryID = $row_cityGrouping['external_country_id'];
	$internalCityName = $row_cityGrouping['city_name_display'];
	$internalLocalityName = $row_cityGrouping['locale_name_display'];
// Show if recordset not empty ?>
        <a href="browse.php?external_locale_id=<?php echo $row_cityGrouping['external_locale_id']; ?>" class="linkageStuff"><?php echo $row_cityGrouping['locale_name_display']; ?></a> | 
        <a href="browse.php?external_country_id=<?php echo $row_cityGrouping['external_country_id']; ?>" class="linkageStuff"><?php echo $row_cityGrouping['country_name_display']; ?></a>Browse by: <a href="index.php?browse=showDate" class="darkerLinkage">date</a> | <a href="index.php?browse=showVenue" class="darkerLinkage">venue</a> | <a href="index.php?browse=songTitle" class="darkerLinkage">song title</a> <?php } // Show if recordset not empty ?>
<?php if ($totalRows_localityGrouping > 0) { // Show if recordset not empty ?>
        <a href="browse.php?external_country_id=<?php echo $row_localityGrouping['external_country_id']; ?>" class="linkageStuff"><?php echo $row_localityGrouping['country_name_display']; ?></a>Browse by: <a href="index.php?browse=showDate" class="darkerLinkage">date</a></span>
        <span class="darkerLinkage"> | <a href="index.php?browse=showVenue" class="darkerLinkage">venue</a>  | <a href="index.php?browse=songTitle" class="darkerLinkage">song title</a> </span>
    
    <?php } // Show if recordset not empty ?>
<?php if ($totalRows_countryGrouping > 0) { // Show if recordset not empty ?>
      <a href="browse.php?viewAll=countries" class="darkerLinkage">Worldwide</a><span class="darkerLinkage">Browse by: <a href="index.php?browse=showDate" class="darkerLinkage">date</a></span>
      <span class="darkerLinkage"> | <a href="index.php?browse=showVenue" class="darkerLinkage">venue</a>  | <a href="index.php?browse=songTitle" class="darkerLinkage">song title</a> </span>
    <?php } // Show if recordset not empty ?>
<?php if ($totalRows_availableCountries > 0) { // Show if recordset not empty ?>
	    <script type="text/javascript">
AC_FL_RunContent( 'codebase','http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0','width','800','height','30','src','flash_elements/nameclip_full','quality','high','pluginspage','http://www.macromedia.com/go/getflashplayer','flashvars','name=<?php echo urlencode('Worldwide'); ?>','bgcolor','#000000','movie','flash_elements/nameclip_full' ); //end AC code
</script><noscript><object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0" width="800" height="30">
          <param name="movie" value="flash_elements/nameclip_full.swf" />
          <param name="quality" value="high" />
		  <param name="flashVars" value="name=<?php echo urlencode('Worldwide'); ?>" /><param name="BGCOLOR" value="#000000" />
          <embed src="flash_elements/nameclip_full.swf" width="800" height="30" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" flashVars="name=<?php echo urlencode('Worldwide'); ?>" bgcolor="#000000"></embed></object></noscript>
        <br>
        <?php do { ?>
        <span class="linkageStuff"><a href="browse.php?external_country_id=<?php echo $row_availableCountries['external_country_id']; ?>" class="linkageStuff"><?php echo $row_availableCountries['country_name_display']; ?></a> | </span> 
        <?php } while ($row_availableCountries = mysql_fetch_assoc($availableCountries)); ?>
        <?php } // Show if recordset not empty ?>
    	<?php if ($totalRows_localityGrouping > 0) { // Show if recordset not empty ?>
        <script type="text/javascript">
AC_FL_RunContent( 'codebase','http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0','width','450','height','30','src','trackName','quality','high','pluginspage','http://www.macromedia.com/go/getflashplayer','flashvars','name=<?php echo urlencode($row_localityGrouping['locale_name_display']); ?>','bgcolor','#000000','movie','trackName' ); //end AC code
</script><noscript><object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0" width="450" height="30">
          <param name="movie" value="trackName.swf" />
          <param name="quality" value="high" />
		  <param name="flashVars" value="name=<?php echo urlencode($row_localityGrouping['locale_name_display']); ?>" /><param name="BGCOLOR" value="#000000" />
          <embed src="trackName.swf" width="450" height="30" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" flashVars="name=<?php echo urlencode($row_localityGrouping['locale_name_display']); ?>" bgcolor="#000000"></embed></object></noscript>
        <br>
        <?php do { ?>
        <span class="linkageStuff"><a href="browse.php?external_city_id=<?php echo $row_availableCities['external_city_id']; ?>" class="linkageStuff"><?php echo $row_availableCities['city_name_display']; ?></a> | </span> 
        <?php } while ($row_availableCities = mysql_fetch_assoc($availableCities)); ?> 
        <?php } // Show if recordset not empty ?>
  <?php if ($totalRows_cityGrouping > 0) { // Show if recordset not empty ?>
        <script type="text/javascript">
AC_FL_RunContent( 'codebase','http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0','width','450','height','30','src','trackName','quality','high','pluginspage','http://www.macromedia.com/go/getflashplayer','flashvars','name=<?php echo $row_cityGrouping['city_name_display']; ?>','bgcolor','#000000','movie','trackName' ); //end AC code
</script><noscript><object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0" width="450" height="30">
          <param name="movie" value="trackName.swf" />
          <param name="quality" value="high" />
		  <param name="flashVars" value="name=<?php echo $row_cityGrouping['city_name_display']; ?>" /><param name="BGCOLOR" value="#000000" />
          <embed src="trackName.swf" width="450" height="30" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" flashVars="name=<?php echo $row_cityGrouping['city_name_display']; ?>" bgcolor="#000000"></embed></object></noscript>
        <br>
        <span class="linkageStuff">
        <?php do { ?>
        <a href="browse.php?external_venue_id=<?php echo $row_availableVenues['external_venue_id']; ?>" class="linkageStuff"><?php echo $row_availableVenues['venue_name_display']; ?></a> | 
  <?php } while ($row_availableVenues = mysql_fetch_assoc($availableVenues)); ?>
        </span> 
        <?php } // Show if recordset not empty ?>
  <?php if ($totalRows_countryGrouping > 0) { // Show if recordset not empty ?>
        <script type="text/javascript">
AC_FL_RunContent( 'codebase','http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0','width','450','height','30','src','trackName','quality','high','pluginspage','http://www.macromedia.com/go/getflashplayer','flashvars','name=<?php echo $row_countryGrouping['country_name_display']; ?>','bgcolor','#000000','movie','trackName' ); //end AC code
</script><noscript><object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0" width="450" height="30">
          <param name="movie" value="trackName.swf" />
          <param name="quality" value="high" />
		  <param name="flashVars" value="name=<?php echo $row_countryGrouping['country_name_display']; ?>" /><param name="BGCOLOR" value="#000000" />
          <embed src="trackName.swf" width="450" height="30" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" flashVars="name=<?php echo $row_countryGrouping['country_name_display']; ?>" bgcolor="#000000"></embed></object></noscript>
        <br>
        <span class="linkageStuff"> 
        <?php do { ?>
        <a href="browse.php?external_locale_id=<?php echo $row_availableLocalities['external_locale_id']; ?>" class="linkageStuff"><?php echo $row_availableLocalities['locale_name_display']; ?></a> | 
        <?php } while ($row_availableLocalities = mysql_fetch_assoc($availableLocalities)); ?>
        </span>
        <?php } // Show if recordset not empty ?>
  <?php if ($totalRows_venueGrouping > 0) { // Show if recordset not empty ?>
        <script type="text/javascript">
AC_FL_RunContent( 'codebase','http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0','width','450','height','30','src','trackName','quality','high','pluginspage','http://www.macromedia.com/go/getflashplayer','flashvars','name=<?php echo $row_venueGrouping['venue_name_display']; ?>','bgcolor','#000000','movie','trackName' ); //end AC code
</script><noscript><object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0" width="450" height="30">
                <param name="movie" value="trackName.swf" />
                <param name="quality" value="high" />
				<param name="flashVars" value="name=<?php echo $row_venueGrouping['venue_name_display']; ?>" /><param name="BGCOLOR" value="#000000" />
                <embed src="trackName.swf" width="450" height="30" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" flashVars="name=<?php echo $row_venueGrouping['venue_name_display']; ?>" bgcolor="#000000"></embed></object></noscript> 
              <br />
              <?php echo $row_venueGrouping['venue_address']; ?><br /><? 
			  if($totalRows_altNamesGrouping>0)
	  {
	  
	  
	  	echo "<br />";
	  	echo "Venue also formerly known as:<br>";
	  	do
		{
			echo $row_altNamesGrouping['venue_name_display'];
			echo "<br />";
		} while($row_altNamesGrouping = mysql_fetch_assoc($altNamesGrouping));
	  }
	  echo "<br />";
	  
	  ?> 
		    <img src="images/58_foundSubset.gif" />
					  <?php $recordCounter = 0; ?>
  <?php do { ?>
          
	<a href="showdetails.php?external_show_id=<?php echo $row_venueGrouping['external_show_id']; ?>" class="linkageStuff"><?php 
    date_default_timezone_set ("America/New_York");
    echo date('m/d/Y (D.)',strtotime($row_venueGrouping['showDate'])); ?></a>
    <a href="browse.php?external_venue_id=<?php echo $row_venueGrouping['external_venue_id']; ?>" class="linkageStuff"></a>
    <a href="browse.php?external_city_id=<?php echo $row_venueGrouping['external_city_id']; ?>" class="linkageStuff"></a>
    <a href="browse.php?external_locale_id=<?php echo $row_venueGrouping['external_locale_id']; ?>" class="linkageStuff"></a>
    <?php } while ($row_venueGrouping = mysql_fetch_assoc($venueGrouping)); ?>
              <br />
            
        <?php } // Show if recordset not empty ?>
        <br />
	  <?php if ($totalRows_cityGrouping > 0) { // Show if recordset not empty ?>
	  <?php $yearHead=0 ?>
	  <img src="images/58_foundSubset.gif" /><br />
	  <?php $recordCounter = 0; ?>
  <?php do { 
		  date_default_timezone_set ("America/New_York");

		if ($yearHeader!=date("Y",strtotime($row_cityGrouping['showDate'])))
		{
			$yearHeader=date("Y",strtotime($row_cityGrouping['showDate']));
			echo "["; 
			echo $yearHeader;
			echo "]";
		}
		else
		{
			echo "";
		}//this is the city specific area
		?>
        <a href="browse.php?external_venue_id=<?php echo $row_cityGrouping['external_venue_id']; ?>" class="linkageStuff"><?php echo $row_cityGrouping['venue_name_display']; ?></a>
		<a href="showdetails.php?external_show_id=<?php echo $row_cityGrouping['external_show_id']; ?>" class="linkageStuff"><?php 
			  date_default_timezone_set ("America/New_York");

			  echo date('D, m/d/Y',strtotime($row_cityGrouping['showDate'])); ?></a>
          
          <?php } while ($row_cityGrouping = mysql_fetch_assoc($cityGrouping)); ?>
        <?php } // Show if recordset not empty ?>
  <?php if ($totalRows_localityGrouping > 0) { // Show if recordset not empty ?>
       <?php $yearHead=0 ?>
	  <img src="images/58_foundSubset.gif" /><br />
        <?php $recordCounter = 0; ?>
  <?php do { 
  date_default_timezone_set ("America/New_York");

		if ($yearHeader!=date("Y",strtotime($row_localityGrouping['showDate'])))
		{
			$yearHeader=date("Y",strtotime($row_localityGrouping['showDate']));
			echo "<span class=\"linkageStuff\">["; 
			echo $yearHeader;
			echo "]</span>";
		}
		else
		{
			echo "";
		}
		?>
            <?php 
            date_default_timezone_set ("America/New_York");

            echo date('m/d/Y (D.)',strtotime($row_localityGrouping['showDate'])); ?>
            - <a href="browse.php?external_venue_id=<?php echo $row_localityGrouping['external_venue_id']; ?>" class="linkageStuff"><?php echo $row_localityGrouping['venue_name_display']; ?></a>
            <a href="browse.php?external_city_id=<?php echo $row_localityGrouping['external_city_id']; ?>" class="linkageStuff"><?php echo $row_localityGrouping['city_name_display']; ?></a>
            <a href="browse.php?external_locale_id=<?php echo $row_localityGrouping['external_locale_id']; ?>" class="linkageStuff"><?php echo $row_localityGrouping['locale_name_display']; ?></a>
<a href="showdetails.php?external_show_id=<?php echo $row_localityGrouping['external_show_id']; ?>" class="linkageStuff">[view show details]</a>
          <?php } while ($row_localityGrouping = mysql_fetch_assoc($localityGrouping)); ?>
        <?php } // Show if recordset not empty ?><br />
        <?php if ($totalRows_countryGrouping > 0) { // Show if recordset not empty ?>
        <?php $recordCounter = 0; ?>
  <?php do { ?>
           
           <a href="showdetails.php?external_show_id=<?php echo $row_countryGrouping['external_show_id']; ?>" class="linkageStuff"><?php 
            date_default_timezone_set ("America/New_York");

            echo date('m/d/Y',strtotime($row_countryGrouping['showDate'])); ?> [view]</a>
            - <a href="browse.php?external_venue_id=<?php echo $row_countryGrouping['external_venue_id']; ?>" class="linkageStuff"><?php echo $row_countryGrouping['venue_name_display']; ?></a>
          <?php } while ($row_countryGrouping = mysql_fetch_assoc($countryGrouping)); ?>
        <?php } // Show if recordset not empty ?>
		<?php 
		if ($totalRows_cityGrouping > 0)
		{
			mysql_data_seek($cityGrouping,0);
			
		} ?>
		<br />
        <br />
        <?php require_once('58ss_includes/58disclaimer.php'); ?>
  <? if(isset($_GET['external_city_id']) && (strlen($_GET['external_city_id'])>0)&&($internalCountryID=="1"))
{ ?>
<script language="javascript" src="https://tm.perfb.com/eventengine/eventunitjs.php?HANDLE=58hours&LAYOUTID=3&&STATE=<? echo $internalLocalityName; ?>&CITY=<? echo $internalCityName; ?>&FROMDATE=2008-06-01&POSTURL=&LID=&TARGET=new&DISPLAYMAX=5"></script>
<? } else
{
?>
  <script type="text/javascript"><!--
google_ad_client = "pub-4681937497066114";
/* 160x600 - browse */
google_ad_slot = "1973658521";
google_ad_width = 160;
google_ad_height = 600;
//-->
</script>
<script type="text/javascript"
src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>
<? }
?>
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
