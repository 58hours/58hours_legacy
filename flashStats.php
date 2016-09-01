<?php 
require_once('Connections/random_connect.php');
require_once('_includes/SITEARTIST.php');
require_once('_includes/rhcommon.php');

mysql_select_db($database_random_connect, $random_connect);
$query_allTitles = "SELECT song_name_display FROM rhr_titleresolver";
$allTitles = mysql_query($query_allTitles, $random_connect) or die(mysql_error());
$totalRows_allTitles = mysql_num_rows($allTitles);

mysql_select_db($database_random_connect, $random_connect);
$query_allShows = sprintf("SELECT * FROM rhr_performances WHERE external_group_id = %s", GetSQLValueString($INTERNAL_SITEGROUP,"text"));
$allShows = mysql_query($query_allShows, $random_connect) or die(mysql_error());
$totalRows_allShows = mysql_num_rows($allShows);

mysql_select_db($database_random_connect, $random_connect);
$query_allVenues = sprintf("SELECT DISTINCT external_venue_id FROM rhr_performances WHERE external_group_id = %s", GetSQLValueString($INTERNAL_SITEGROUP,"text"));
$allVenues = mysql_query($query_allVenues, $random_connect) or die(mysql_error());
$totalRows_allVenues = mysql_num_rows($allVenues);

mysql_select_db($database_random_connect, $random_connect);
$query_allCities = sprintf("SELECT DISTINCT rhr_cityresolver.external_city_id 
FROM rhr_performances, rhr_cityresolver, rhr_venueresolver 
WHERE rhr_performances.external_venue_id = rhr_venueresolver.external_venue_id 
AND rhr_venueresolver.external_city_id = rhr_cityresolver.external_city_id 
AND rhr_performances.external_group_id = %s", GetSQLValueString($INTERNAL_SITEGROUP,"text"));
$allCities = mysql_query($query_allCities, $random_connect) or die(mysql_error());
$totalRows_allCities = mysql_num_rows($allCities);

mysql_select_db($database_random_connect, $random_connect);
$query_allCountries = sprintf("SELECT DISTINCT rhr_countryresolver.external_country_id FROM rhr_performances, rhr_cityresolver, rhr_venueresolver, rhr_localityresolver, rhr_countryresolver WHERE rhr_performances.external_venue_id = rhr_venueresolver.external_venue_id AND rhr_venueresolver.external_city_id = rhr_cityresolver.external_city_id AND rhr_cityresolver.external_locale_id = rhr_localityresolver.external_locale_id AND rhr_localityresolver.external_country_id = rhr_countryresolver.external_country_id AND rhr_performances.external_group_id = %s", GetSQLValueString($INTERNAL_SITEGROUP,"text"));
$allCountries = mysql_query($query_allCountries, $random_connect) or die(mysql_error());
$totalRows_allCountries = mysql_num_rows($allCountries);
/*
mysql_select_db($database_random_connect, $random_connect);
$query_allReleases = "SELECT DISTINCT releaseID FROM studiotrack_db";
$allReleases = mysql_query($query_allReleases, $random_connect) or die(mysql_error());
//$row_allReleases = mysql_fetch_assoc($allReleases);
$totalRows_allReleases = mysql_num_rows($allReleases);
*/
?>
<?php echo 'showNum='.$totalRows_allShows.'&venueNum='.$totalRows_allVenues.'&cityNum='.$totalRows_allCities.'&countryNum='.$totalRows_allCountries; ?>
<?php
mysql_free_result($allTitles);

mysql_free_result($allShows);

mysql_free_result($allVenues);

mysql_free_result($allCities);

mysql_free_result($allCountries);

mysql_free_result($allReleases);
?>