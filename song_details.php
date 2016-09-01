<?php require_once('Connections/radioRecords.php'); ?>
<?php
mb_internal_encoding( 'UTF-8' );

$colname_encoreLead = "9999";
if (isset($HTTP_GET_VARS['trackID'])) {
  $colname_encoreLead = (get_magic_quotes_gpc()) ? $HTTP_GET_VARS['trackID'] : addslashes($HTTP_GET_VARS['trackID']);
}
mysql_select_db($database_radioRecords, $radioRecords);
$query_encoreLead = sprintf("SELECT showlist_db.showDate, venuedetails.venueName, cityresolver.cityName, encore1leaders.trackTitle, encore1leaders.trackID, showlist_db.showID FROM cityresolver, venuedetails, showlist_db, encore1leaders, titleresolver WHERE encore1leaders.showID = showlist_db.showID AND encore1leaders.trackTitle = titleresolver.trackTitle AND venuedetails.venueID = showlist_db.showVenueID AND cityresolver.cityID = venuedetails.venueCity AND titleresolver.trackID='%s' ORDER BY showlist_db.showDate DESC", $colname_encoreLead);
$encoreLead = mysql_query($query_encoreLead, $radioRecords) or die(mysql_error());
$row_encoreLead = mysql_fetch_assoc($encoreLead);
$totalRows_encoreLead = mysql_num_rows($encoreLead);

$colname_encore2Lead = "9999";
if (isset($HTTP_GET_VARS['trackID'])) {
  $colname_encore2Lead = (get_magic_quotes_gpc()) ? $HTTP_GET_VARS['trackID'] : addslashes($HTTP_GET_VARS['trackID']);
}
mysql_select_db($database_radioRecords, $radioRecords);
$query_encore2Lead = sprintf("SELECT showlist_db.showDate, venuedetails.venueName, cityresolver.cityName, encore2leaders.trackTitle,  encore2leaders.trackID, showlist_db.showID FROM cityresolver, venuedetails, showlist_db, encore2leaders, titleresolver WHERE encore2leaders.showID = showlist_db.showID AND encore2leaders.trackTitle = titleresolver.trackTitle AND venuedetails.venueID = showlist_db.showVenueID AND cityresolver.cityID = venuedetails.venueCity AND titleresolver.trackID='%s' ORDER BY showlist_db.showDate DESC", $colname_encore2Lead);
$encore2Lead = mysql_query($query_encore2Lead, $radioRecords) or die(mysql_error());
$row_encore2Lead = mysql_fetch_assoc($encore2Lead);
$totalRows_encore2Lead = mysql_num_rows($encore2Lead);

$colname_openingtracks = "9999";
if (isset($HTTP_GET_VARS['trackID'])) {
  $colname_openingtracks = (get_magic_quotes_gpc()) ? $HTTP_GET_VARS['trackID'] : addslashes($HTTP_GET_VARS['trackID']);
}
mysql_select_db($database_radioRecords, $radioRecords);
$query_openingtracks = sprintf("SELECT showlist_db.showDate, venuedetails.venueName, cityresolver.cityName, livetracks_db.trackID, livetracks_db.showID, titleresolver.trackTitle, count(livetracks_db.showID) as numOfShows FROM cityresolver, venuedetails, livetracks_db, titleresolver, showlist_db WHERE venuedetails.venueID = showlist_db.showVenueID AND cityresolver.cityID = venuedetails.venueCity AND livetracks_db.trackID = titleresolver.trackID AND songNumber='1' AND livetracks_db.trackID = '%s' AND showlist_db.showID = livetracks_db.showID GROUP BY livetracks_db.showID ORDER BY showlist_db.showDate DESC", $colname_openingtracks);
$openingtracks = mysql_query($query_openingtracks, $radioRecords) or die(mysql_error());
$row_openingtracks = mysql_fetch_assoc($openingtracks);
$totalRows_openingtracks = mysql_num_rows($openingtracks);



$colname_perfs2006 = "1";
if (isset($HTTP_GET_VARS['trackID'])) {
  $colname_perfs2006 = (get_magic_quotes_gpc()) ? $HTTP_GET_VARS['trackID'] : addslashes($HTTP_GET_VARS['trackID']);
}
mysql_select_db($database_radioRecords, $radioRecords);
$query_perfs2006 = sprintf("SELECT titleresolver.trackID, COUNT(*) FROM livetracks_db, titleresolver, showlist_db WHERE showlist_db.showID = livetracks_db.showID AND titleresolver.trackID = livetracks_db.trackID AND titleresolver.trackID = '%s' AND (showlist_db.showDate >= '2006-01-01' AND showlist_db.showDate <= '2006-12-31') GROUP BY titleresolver.trackID", $colname_perfs2006);
$perfs2006 = mysql_query($query_perfs2006, $radioRecords) or die(mysql_error());
$row_perfs2006 = mysql_fetch_assoc($perfs2006);
$totalRows_perfs2006 = mysql_num_rows($perfs2006);


$colname_perfs2005 = "1";
if (isset($HTTP_GET_VARS['trackID'])) {
  $colname_perfs2005 = (get_magic_quotes_gpc()) ? $HTTP_GET_VARS['trackID'] : addslashes($HTTP_GET_VARS['trackID']);
}
mysql_select_db($database_radioRecords, $radioRecords);
$query_perfs2005 = sprintf("SELECT titleresolver.trackID, COUNT(*) FROM livetracks_db, titleresolver, showlist_db WHERE showlist_db.showID = livetracks_db.showID AND titleresolver.trackID = livetracks_db.trackID AND titleresolver.trackID = '%s' AND (showlist_db.showDate >= '2005-01-01' AND showlist_db.showDate <= '2005-12-31') GROUP BY titleresolver.trackID", $colname_perfs2005);
$perfs2005 = mysql_query($query_perfs2005, $radioRecords) or die(mysql_error());
$row_perfs2005 = mysql_fetch_assoc($perfs2005);
$totalRows_perfs2005 = mysql_num_rows($perfs2005);


$colname_perfs2004 = "1";
if (isset($HTTP_GET_VARS['trackID'])) {
  $colname_perfs2004 = (get_magic_quotes_gpc()) ? $HTTP_GET_VARS['trackID'] : addslashes($HTTP_GET_VARS['trackID']);
}
mysql_select_db($database_radioRecords, $radioRecords);
$query_perfs2004 = sprintf("SELECT titleresolver.trackID, COUNT(*) FROM livetracks_db, titleresolver, showlist_db WHERE showlist_db.showID = livetracks_db.showID AND titleresolver.trackID = livetracks_db.trackID AND titleresolver.trackID = '%s' AND (showlist_db.showDate >= '2004-01-01' AND showlist_db.showDate <= '2004-12-31') GROUP BY titleresolver.trackID", $colname_perfs2004);
$perfs2004 = mysql_query($query_perfs2004, $radioRecords) or die(mysql_error());
$row_perfs2004 = mysql_fetch_assoc($perfs2004);
$totalRows_perfs2004 = mysql_num_rows($perfs2004);

$colname_perfs2003 = "1";
if (isset($HTTP_GET_VARS['trackID'])) {
  $colname_perfs2003 = (get_magic_quotes_gpc()) ? $HTTP_GET_VARS['trackID'] : addslashes($HTTP_GET_VARS['trackID']);
}
mysql_select_db($database_radioRecords, $radioRecords);
$query_perfs2003 = sprintf("SELECT titleresolver.trackID, COUNT(*) FROM livetracks_db, titleresolver, showlist_db WHERE showlist_db.showID = livetracks_db.showID AND titleresolver.trackID = livetracks_db.trackID AND titleresolver.trackID = '%s' AND (showlist_db.showDate >= '2003-01-01' AND showlist_db.showDate <= '2003-12-31') GROUP BY titleresolver.trackID", $colname_perfs2003);
$perfs2003 = mysql_query($query_perfs2003, $radioRecords) or die(mysql_error());
$row_perfs2003 = mysql_fetch_assoc($perfs2003);
$totalRows_perfs2003 = mysql_num_rows($perfs2003);

$colname_perfs2002 = "1";
if (isset($HTTP_GET_VARS['trackID'])) {
  $colname_perfs2002 = (get_magic_quotes_gpc()) ? $HTTP_GET_VARS['trackID'] : addslashes($HTTP_GET_VARS['trackID']);
}
mysql_select_db($database_radioRecords, $radioRecords);
$query_perfs2002 = sprintf("SELECT titleresolver.trackID, COUNT(*) FROM livetracks_db, titleresolver, showlist_db WHERE showlist_db.showID = livetracks_db.showID AND titleresolver.trackID = livetracks_db.trackID AND titleresolver.trackID = '%s' AND (showlist_db.showDate >= '2002-01-01' AND showlist_db.showDate <= '2002-12-31') GROUP BY titleresolver.trackID", $colname_perfs2002);
$perfs2002 = mysql_query($query_perfs2002, $radioRecords) or die(mysql_error());
$row_perfs2002 = mysql_fetch_assoc($perfs2002);
$totalRows_perfs2002 = mysql_num_rows($perfs2002);

$colname_perfs2001 = "1";
if (isset($HTTP_GET_VARS['trackID'])) {
  $colname_perfs2001 = (get_magic_quotes_gpc()) ? $HTTP_GET_VARS['trackID'] : addslashes($HTTP_GET_VARS['trackID']);
}
mysql_select_db($database_radioRecords, $radioRecords);
$query_perfs2001 = sprintf("SELECT titleresolver.trackID, COUNT(*) FROM livetracks_db, titleresolver, showlist_db WHERE showlist_db.showID = livetracks_db.showID AND titleresolver.trackID = livetracks_db.trackID AND titleresolver.trackID = '%s' AND (showlist_db.showDate >= '2001-01-01' AND showlist_db.showDate <= '2001-12-31') GROUP BY titleresolver.trackID", $colname_perfs2001);
$perfs2001 = mysql_query($query_perfs2001, $radioRecords) or die(mysql_error());
$row_perfs2001 = mysql_fetch_assoc($perfs2001);
$totalRows_perfs2001 = mysql_num_rows($perfs2001);

$colname_perfs2000 = "1";
if (isset($HTTP_GET_VARS['trackID'])) {
  $colname_perfs2000 = (get_magic_quotes_gpc()) ? $HTTP_GET_VARS['trackID'] : addslashes($HTTP_GET_VARS['trackID']);
}
mysql_select_db($database_radioRecords, $radioRecords);
$query_perfs2000 = sprintf("SELECT titleresolver.trackID, COUNT(*) FROM livetracks_db, titleresolver, showlist_db WHERE showlist_db.showID = livetracks_db.showID AND titleresolver.trackID = livetracks_db.trackID AND titleresolver.trackID = '%s' AND (showlist_db.showDate >= '2000-01-01' AND showlist_db.showDate <= '2000-12-31') GROUP BY titleresolver.trackID", $colname_perfs2000);
$perfs2000 = mysql_query($query_perfs2000, $radioRecords) or die(mysql_error());
$row_perfs2000 = mysql_fetch_assoc($perfs2000);
$totalRows_perfs2000 = mysql_num_rows($perfs2000);

$colname_perfs1999 = "1";
if (isset($HTTP_GET_VARS['trackID'])) {
  $colname_perfs1999 = (get_magic_quotes_gpc()) ? $HTTP_GET_VARS['trackID'] : addslashes($HTTP_GET_VARS['trackID']);
}
mysql_select_db($database_radioRecords, $radioRecords);
$query_perfs1999 = sprintf("SELECT titleresolver.trackID, COUNT(*) FROM livetracks_db, titleresolver, showlist_db WHERE showlist_db.showID = livetracks_db.showID AND titleresolver.trackID = livetracks_db.trackID AND titleresolver.trackID = '%s' AND (showlist_db.showDate >= '1999-01-01' AND showlist_db.showDate <= '1999-12-31') GROUP BY titleresolver.trackID", $colname_perfs1999);
$perfs1999 = mysql_query($query_perfs1999, $radioRecords) or die(mysql_error());
$row_perfs1999 = mysql_fetch_assoc($perfs1999);
$totalRows_perfs1999 = mysql_num_rows($perfs1999);

$colname_perfs1998 = "1";
if (isset($HTTP_GET_VARS['trackID'])) {
  $colname_perfs1998 = (get_magic_quotes_gpc()) ? $HTTP_GET_VARS['trackID'] : addslashes($HTTP_GET_VARS['trackID']);
}
mysql_select_db($database_radioRecords, $radioRecords);
$query_perfs1998 = sprintf("SELECT titleresolver.trackID, COUNT(*) FROM livetracks_db, titleresolver, showlist_db WHERE showlist_db.showID = livetracks_db.showID AND titleresolver.trackID = livetracks_db.trackID AND titleresolver.trackID = '%s' AND (showlist_db.showDate >= '1998-01-01' AND showlist_db.showDate <= '1998-12-31') GROUP BY titleresolver.trackID", $colname_perfs1998);
$perfs1998 = mysql_query($query_perfs1998, $radioRecords) or die(mysql_error());
$row_perfs1998 = mysql_fetch_assoc($perfs1998);
$totalRows_perfs1998 = mysql_num_rows($perfs1998);

$colname_perfs1997 = "1";
if (isset($HTTP_GET_VARS['trackID'])) {
  $colname_perfs1997 = (get_magic_quotes_gpc()) ? $HTTP_GET_VARS['trackID'] : addslashes($HTTP_GET_VARS['trackID']);
}
mysql_select_db($database_radioRecords, $radioRecords);
$query_perfs1997 = sprintf("SELECT titleresolver.trackID, COUNT(*) FROM livetracks_db, titleresolver, showlist_db WHERE showlist_db.showID = livetracks_db.showID AND titleresolver.trackID = livetracks_db.trackID AND titleresolver.trackID = '%s' AND (showlist_db.showDate >= '1997-01-01' AND showlist_db.showDate <= '1997-12-31') GROUP BY titleresolver.trackID", $colname_perfs1997);
$perfs1997 = mysql_query($query_perfs1997, $radioRecords) or die(mysql_error());
$row_perfs1997 = mysql_fetch_assoc($perfs1997);
$totalRows_perfs1997 = mysql_num_rows($perfs1997);

$colname_perfs1996 = "1";
if (isset($HTTP_GET_VARS['trackID'])) {
  $colname_perfs1996 = (get_magic_quotes_gpc()) ? $HTTP_GET_VARS['trackID'] : addslashes($HTTP_GET_VARS['trackID']);
}
mysql_select_db($database_radioRecords, $radioRecords);
$query_perfs1996 = sprintf("SELECT titleresolver.trackID, COUNT(*) FROM livetracks_db, titleresolver, showlist_db WHERE showlist_db.showID = livetracks_db.showID AND titleresolver.trackID = livetracks_db.trackID AND titleresolver.trackID = '%s' AND (showlist_db.showDate >= '1996-01-01' AND showlist_db.showDate <= '1996-12-31') GROUP BY titleresolver.trackID", $colname_perfs1996);
$perfs1996 = mysql_query($query_perfs1996, $radioRecords) or die(mysql_error());
$row_perfs1996 = mysql_fetch_assoc($perfs1996);
$totalRows_perfs1996 = mysql_num_rows($perfs1996);

$colname_perfs1995 = "1";
if (isset($HTTP_GET_VARS['trackID'])) {
  $colname_perfs1995 = (get_magic_quotes_gpc()) ? $HTTP_GET_VARS['trackID'] : addslashes($HTTP_GET_VARS['trackID']);
}
mysql_select_db($database_radioRecords, $radioRecords);
$query_perfs1995 = sprintf("SELECT titleresolver.trackID, COUNT(*) FROM livetracks_db, titleresolver, showlist_db WHERE showlist_db.showID = livetracks_db.showID AND titleresolver.trackID = livetracks_db.trackID AND titleresolver.trackID = '%s' AND (showlist_db.showDate >= '1995-01-01' AND showlist_db.showDate <= '1995-12-31') GROUP BY titleresolver.trackID", $colname_perfs1995);
$perfs1995 = mysql_query($query_perfs1995, $radioRecords) or die(mysql_error());
$row_perfs1995 = mysql_fetch_assoc($perfs1995);
$totalRows_perfs1995 = mysql_num_rows($perfs1995);

$colname_perfs1994 = "1";
if (isset($HTTP_GET_VARS['trackID'])) {
  $colname_perfs1994 = (get_magic_quotes_gpc()) ? $HTTP_GET_VARS['trackID'] : addslashes($HTTP_GET_VARS['trackID']);
}
mysql_select_db($database_radioRecords, $radioRecords);
$query_perfs1994 = sprintf("SELECT titleresolver.trackID, COUNT(*) FROM livetracks_db, titleresolver, showlist_db WHERE showlist_db.showID = livetracks_db.showID AND titleresolver.trackID = livetracks_db.trackID AND titleresolver.trackID = '%s' AND (showlist_db.showDate >= '1994-01-01' AND showlist_db.showDate <= '1994-12-31') GROUP BY titleresolver.trackID", $colname_perfs1994);
$perfs1994 = mysql_query($query_perfs1994, $radioRecords) or die(mysql_error());
$row_perfs1994 = mysql_fetch_assoc($perfs1994);
$totalRows_perfs1994 = mysql_num_rows($perfs1994);


$colname_perfs1993 = "1";
if (isset($HTTP_GET_VARS['trackID'])) {
  $colname_perfs1993 = (get_magic_quotes_gpc()) ? $HTTP_GET_VARS['trackID'] : addslashes($HTTP_GET_VARS['trackID']);
}
mysql_select_db($database_radioRecords, $radioRecords);
$query_perfs1993 = sprintf("SELECT titleresolver.trackID, COUNT(*) FROM livetracks_db, titleresolver, showlist_db WHERE showlist_db.showID = livetracks_db.showID AND titleresolver.trackID = livetracks_db.trackID AND titleresolver.trackID = '%s' AND (showlist_db.showDate >= '1993-01-01' AND showlist_db.showDate <= '1993-12-31') GROUP BY titleresolver.trackID", $colname_perfs1993);
$perfs1993 = mysql_query($query_perfs1993, $radioRecords) or die(mysql_error());
$row_perfs1993 = mysql_fetch_assoc($perfs1993);
$totalRows_perfs1993 = mysql_num_rows($perfs1993);


$colname_perfs1992 = "1";
if (isset($HTTP_GET_VARS['trackID'])) {
  $colname_perfs1992 = (get_magic_quotes_gpc()) ? $HTTP_GET_VARS['trackID'] : addslashes($HTTP_GET_VARS['trackID']);
}
mysql_select_db($database_radioRecords, $radioRecords);
$query_perfs1992 = sprintf("SELECT titleresolver.trackID, COUNT(*) FROM livetracks_db, titleresolver, showlist_db WHERE showlist_db.showID = livetracks_db.showID AND titleresolver.trackID = livetracks_db.trackID AND titleresolver.trackID = '%s' AND (showlist_db.showDate >= '1992-01-01' AND showlist_db.showDate <= '1992-12-31') GROUP BY titleresolver.trackID", $colname_perfs1992);
$perfs1992 = mysql_query($query_perfs1992, $radioRecords) or die(mysql_error());
$row_perfs1992 = mysql_fetch_assoc($perfs1992);
$totalRows_perfs1992 = mysql_num_rows($perfs1992);

$colname_titleDetails = "1";
if (isset($HTTP_GET_VARS['trackID'])) {
  $colname_titleDetails = (get_magic_quotes_gpc()) ? $HTTP_GET_VARS['trackID'] : addslashes($HTTP_GET_VARS['trackID']);
}
mysql_select_db($database_radioRecords, $radioRecords);
$query_titleDetails = sprintf("SELECT DISTINCT livetracks_db.showID, titleresolver.trackTitle, titleresolver.trackID FROM livetracks_db, titleresolver WHERE titleresolver.trackID = '%s'", $colname_titleDetails);
$titleDetails = mysql_query($query_titleDetails, $radioRecords) or die(mysql_error());
$row_titleDetails = mysql_fetch_assoc($titleDetails);
$totalRows_titleDetails = mysql_num_rows($titleDetails);

$colname_correspondingTitles = "1";
if (isset($HTTP_GET_VARS['trackID'])) {
  $colname_correspondingTitles = (get_magic_quotes_gpc()) ? $HTTP_GET_VARS['trackID'] : addslashes($HTTP_GET_VARS['trackID']);
}
mysql_select_db($database_radioRecords, $radioRecords);
$query_correspondingTitles = sprintf("SELECT DISTINCT albumdb.radioID, albumdb.ReleaseTitle, albumdb.ReleaseDate, albumdb.ReleaseArtist,  albumdb.amazonLink, albumdb.country, albumdb.imgUrlSmall FROM albumdb, livetracks_db, studiotrack_db, titleresolver WHERE studiotrack_db.releaseID = albumdb.radioID AND studiotrack_db.trackName=titleresolver.trackTitle AND titleresolver.trackID='%s' ORDER BY albumdb.ReleaseDate ASC", $colname_correspondingTitles);
$correspondingTitles = mysql_query($query_correspondingTitles, $radioRecords) or die(mysql_error());
$row_correspondingTitles = mysql_fetch_assoc($correspondingTitles);
$totalRows_correspondingTitles = mysql_num_rows($correspondingTitles);

$colname_trackDetails = "1";
if (isset($HTTP_GET_VARS['trackID'])) {
  $colname_trackDetails = (get_magic_quotes_gpc()) ? $HTTP_GET_VARS['trackID'] : addslashes($HTTP_GET_VARS['trackID']);
}
mysql_select_db($database_radioRecords, $radioRecords);
$query_trackDetails = sprintf("SELECT * FROM songdetails, titleresolver WHERE songdetails.trackID = titleresolver.trackID AND titleresolver.trackID= '%s'", $colname_trackDetails);
$trackDetails = mysql_query($query_trackDetails, $radioRecords) or die(mysql_error());
$row_trackDetails = mysql_fetch_assoc($trackDetails);
$totalRows_trackDetails = mysql_num_rows($trackDetails);


$colname_otherTitles = "1";
if (isset($HTTP_GET_VARS['trackID'])) {
  $colname_otherTitles = (get_magic_quotes_gpc()) ? $HTTP_GET_VARS['trackID'] : addslashes($HTTP_GET_VARS['trackID']);
}
mysql_select_db($database_radioRecords, $radioRecords);
$query_otherTitles = sprintf("SELECT alternateTitle FROM alternatetitles WHERE trackTitleID = '%s' ORDER BY alternateTitle ASC", $colname_otherTitles);
$otherTitles = mysql_query($query_otherTitles, $radioRecords) or die(mysql_error());
$row_otherTitles = mysql_fetch_assoc($otherTitles);
$totalRows_otherTitles = mysql_num_rows($otherTitles);



$colname_hooWoo = "1";
if (isset($HTTP_GET_VARS['trackID'])) {
  $colname_hooWoo = (get_magic_quotes_gpc()) ? $HTTP_GET_VARS['trackID'] : addslashes($HTTP_GET_VARS['trackID']);
}
mysql_select_db($database_radioRecords, $radioRecords);
$query_hooWoo = sprintf("SELECT DISTINCT showlist_db.showID, venuedetails.venueID, countryresolver.countryName, localityresolver.localityName, localityresolver.localityID, cityresolver.cityName, cityresolver.cityID, venuedetails.venueName, showlist_db.showDate FROM showlist_db,livetracks_db, titleresolver, cityresolver, localityresolver, countryresolver, venuedetails WHERE showlist_db.showID = livetracks_db.showID  AND livetracks_db.trackID=titleresolver.trackID AND venuedetails.venueID = showlist_db.showVenueID AND venuedetails.venueCity = cityresolver.cityID AND cityresolver.localityID = localityresolver.localityID AND localityresolver.countryID = countryresolver.countryID AND titleresolver.trackID='%s' ORDER BY showlist_db.showDate DESC LIMIT 1", $colname_hooWoo);
$hooWoo = mysql_query($query_hooWoo, $radioRecords) or die(mysql_error());
$row_hooWoo = mysql_fetch_assoc($hooWoo);
$totalRows_hooWoo = mysql_num_rows($hooWoo);

$colname_wooHoo = "1";
if (isset($HTTP_GET_VARS['trackID'])) {
  $colname_wooHoo = (get_magic_quotes_gpc()) ? $HTTP_GET_VARS['trackID'] : addslashes($HTTP_GET_VARS['trackID']);
}
mysql_select_db($database_radioRecords, $radioRecords);
$query_wooHoo = sprintf("SELECT DISTINCT showlist_db.showID, venuedetails.venueID, countryresolver.countryName, localityresolver.localityName, localityresolver.localityID, cityresolver.cityName, cityresolver.cityID, venuedetails.venueName, showlist_db.showDate FROM showlist_db,livetracks_db, titleresolver, cityresolver, localityresolver, countryresolver, venuedetails WHERE showlist_db.showID = livetracks_db.showID  AND livetracks_db.trackID=titleresolver.trackID AND venuedetails.venueID = showlist_db.showVenueID AND venuedetails.venueCity = cityresolver.cityID AND cityresolver.localityID = localityresolver.localityID AND localityresolver.countryID = countryresolver.countryID AND titleresolver.trackID='%s' ORDER BY showlist_db.showDate LIMIT 1", $colname_wooHoo);
$wooHoo = mysql_query($query_wooHoo, $radioRecords) or die(mysql_error());
$row_wooHoo = mysql_fetch_assoc($wooHoo);
$totalRows_wooHoo = mysql_num_rows($wooHoo);

$colname_totalTimes = "1";
if (isset($HTTP_GET_VARS['trackID'])) {
  $colname_totalTimes = (get_magic_quotes_gpc()) ? $HTTP_GET_VARS['trackID'] : addslashes($HTTP_GET_VARS['trackID']);
}
mysql_select_db($database_radioRecords, $radioRecords);
$query_totalTimes = sprintf("SELECT DISTINCT showlist_db.showDate FROM showlist_db,livetracks_db, titleresolver, cityresolver, localityresolver, countryresolver, venuedetails WHERE showlist_db.showID = livetracks_db.showID  AND livetracks_db.trackID=titleresolver.trackID AND venuedetails.venueID = showlist_db.showVenueID AND venuedetails.venueCity = cityresolver.cityID AND cityresolver.localityID = localityresolver.localityID AND localityresolver.countryID = countryresolver.countryID AND titleresolver.trackID='%s' ORDER BY showlist_db.showDate", $colname_totalTimes);
$totalTimes = mysql_query($query_totalTimes, $radioRecords) or die(mysql_error());
$row_totalTimes = mysql_fetch_assoc($totalTimes);
$totalRows_totalTimes = mysql_num_rows($totalTimes);


$colname_versionTitles = "1";
if (isset($HTTP_GET_VARS['trackID'])) {
  $colname_versionTitles = (get_magic_quotes_gpc()) ? $HTTP_GET_VARS['trackID'] : addslashes($HTTP_GET_VARS['trackID']);
}
mysql_select_db($database_radioRecords, $radioRecords);
$query_versionTitles = sprintf("SELECT DISTINCT studiotrack_db.trackName, albumdb.country, albumdb.releaseTitle, albumdb.imgUrlSmall, albumdb.releaseDate, versionResolver.versionTitle, studiotrack_db.releaseID FROM studiotrack_db, albumdb, versionResolver WHERE studiotrack_db.trackResID = '%s' AND studiotrack_db.releaseID = albumdb.radioID AND studiotrack_db.verResID = versionResolver.versionID ORDER BY albumdb.releaseDate DESC", $colname_versionTitles);
$versionTitles = mysql_query($query_versionTitles, $radioRecords) or die(mysql_error());
$row_versionTitles = mysql_fetch_assoc($versionTitles);
$totalRows_versionTitles = mysql_num_rows($versionTitles);

mysql_select_db($database_radioRecords, $radioRecords);
$query_allTitles = "SELECT * FROM titleresolver ORDER BY trackTitle ASC";
$allTitles = mysql_query($query_allTitles, $radioRecords) or die(mysql_error());
$row_allTitles = mysql_fetch_assoc($allTitles);
$totalRows_allTitles = mysql_num_rows($allTitles);
?>
<html>
<head>
<title>&quot;<?php echo $row_titleDetails['trackTitle']; ?>&quot; details at 58hours. a radiohead gig database</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="stylesheet" href="css/styles.css" type="text/css">
<script language="JavaScript">
function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}
</script>
</head>
<body bgcolor="#000000" text="#FFFFFF" link="#0066CC" vlink="#0066CC" alink="#0066CC" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" class="blueishlinks">
<br>
<table width="800" border="0" align="center" cellpadding="1" cellspacing="1" bgcolor="#FFFFFF">
  <tr>
      <td colspan="2" bgcolor="#000033" class="darkerLinkage"><a href="/" border="0"><img src="../images/58hrs_header_taller.jpg" border="0"></a></td>
    </tr>
    <tr>
    <td>
      <div align="center">
        <table width="800" border="0" cellpadding="10" cellspacing="0" bgcolor="#000033">
          <tr>
            <td align="left" valign="top"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif">LOOKUP SONG: </font>
                <form name="form1" method="get" action="song_details.php?trackID=<?php echo $row_allTitles['trackID']; ?>">
                  <select name="trackID" id="trackID">
                    <?php do { ?>
                    <option value="<?php echo $row_allTitles['trackID']?>"><?php echo $row_allTitles['trackTitle']?></option>
                    <?php } while ($row_allTitles = mysql_fetch_assoc($allTitles));
  						$rows = mysql_num_rows($allTitles);
						if($rows > 0) {
							mysql_data_seek($allTitles, 0);
							$row_allTitles = mysql_fetch_assoc($allTitles);
					} ?>
                  </select>
                  <input type="submit" value="Submit">
              </form></td>
            <td align="right" valign="bottom" nowrap>&nbsp;</td>
          </tr>
          <tr>
            <td colspan="2" align="center" valign="top" bgcolor="#000033">
            <table width="100%" border="0" cellpadding="2">
                <tr>
                  <td width="50%" height="12" colspan="2" valign="top"><p>
                          <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0" width="450" height="30">
                            <param name="movie" value="trackName.swf">
                            <param name="quality" value="high">
                            <param name="BGCOLOR" value="#000033">
							<param name="flashVars" value="name=<?php echo urlencode($row_titleDetails['trackTitle']); ?>">
                            <embed src="trackName.swf" width="450" height="30" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" bgcolor="#000033" flashVars="name=<?php echo urlencode($row_titleDetails['trackTitle']); ?>"></embed>
                          </object>
                          <?php if ($totalRows_otherTitles > 0) { // Show if recordset not empty ?>
                          <br />
                          <font face="Arial, Helvetica, sans-serif" size="1" color="#999999"> <strong>ALSO KNOWN AS:</strong><br>
                          	<?php do { ?>
								&quot;<?php echo $row_otherTitles['alternateTitle']; ?>&quot;<br>
							<?php } while ($row_otherTitles = mysql_fetch_assoc($otherTitles)); ?>
                          </font>
                          <?php } // Show if recordset not empty ?>
                  </td>
                </tr>
                <tr>
                  <td colspan="2" valign="top"><?php if ($totalRows_wooHoo > 0) { // Show if recordset not empty ?>
                      <br>
                      <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0" width="800" height="100">
                        <param name="movie" value="flash_elements/spectrum.swf">
                        <param name="quality" value="high">
						<param name="flashVars" value="<?php echo "y1992=".($row_perfs1992['COUNT(*)']*2)."&y1993=".($row_perfs1993['COUNT(*)']*2)."&y1994=".($row_perfs1994['COUNT(*)']*2)."&y1995=".($row_perfs1995['COUNT(*)']*2)."&y1996=".($row_perfs1996['COUNT(*)']*2)."&y1997=".($row_perfs1997['COUNT(*)']*2)."&y1998=".($row_perfs1998['COUNT(*)']*2)."&y1999=".($row_perfs1999['COUNT(*)']*2)."&y2000=".($row_perfs2000['COUNT(*)']*2)."&y2001=".($row_perfs2001['COUNT(*)']*2)."&y2002=".($row_perfs2002['COUNT(*)']*2)."&y2003=".($row_perfs2003['COUNT(*)']*2)."&y2004=".($row_perfs2004['COUNT(*)']*2)."&y2005=".($row_perfs2005['COUNT(*)']*2)."&y2006=".($row_perfs2006['COUNT(*)']*2); ?>">
                        <embed src="flash_elements/spectrum.swf" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="800" height="100" flashVars="<?php echo "y1992=".($row_perfs1992['COUNT(*)']*2)."&y1993=".($row_perfs1993['COUNT(*)']*2)."&y1994=".($row_perfs1994['COUNT(*)']*2)."&y1995=".($row_perfs1995['COUNT(*)']*2)."&y1996=".($row_perfs1996['COUNT(*)']*2)."&y1997=".($row_perfs1997['COUNT(*)']*2)."&y1998=".($row_perfs1998['COUNT(*)']*2)."&y1999=".($row_perfs1999['COUNT(*)']*2)."&y2000=".($row_perfs2000['COUNT(*)']*2)."&y2001=".($row_perfs2001['COUNT(*)']*2)."&y2002=".($row_perfs2002['COUNT(*)']*2)."&y2003=".($row_perfs2003['COUNT(*)']*2)."&y2004=".($row_perfs2004['COUNT(*)']*2)."&y2005=".($row_perfs2005['COUNT(*)']*2)."&y2006=".($row_perfs2006['COUNT(*)']*2); ?>"></embed>
                      </object>
                      <br>
                      <br>
                      <br>
                      <?php } // Show if recordset empty ?>
                  </td>
                </tr>
                <tr>
                  <td width="360" valign="top">
					<?php if ($totalRows_wooHoo > 0) { // Show if recordset not empty ?>
                      <table width="360" border="1" cellpadding="0" cellspacing="0" bordercolor="#CCCCCC">
                        <tr>
                          <td bordercolor="#CCCCCC"><font size="1" face="Arial, Helvetica, sans-serif">originally performed by:&nbsp;<?php echo $row_trackDetails['byWho']; ?><br>
							<?php if ($totalRows_totalTimes > 0) { // Show if recordset not empty ?>
								played live <font color="#66CCFF"><?php echo $totalRows_totalTimes ?></font> times. <a href="58_performancehistory.php?trackID=<?php echo $row_titleDetails['trackID']; ?>" class="linkageStuff">[DETAILS]</a>
                    		<?php } // Show if recordset not empty ?>
                    		<?php if ($totalRows_encoreLead > 0) { // Show if recordset not empty ?>
                    			<br> opened first encore <?php echo $totalRows_encoreLead; ?> times
                   			<?php } ?>
                    		<?php if ($totalRows_encore2Lead > 0) { // Show if recordset not empty ?>
                    			<br> opened second encore <?php echo $totalRows_encore2Lead; ?> times
                    		<?php } ?>
                            </font>
                            <?php if ($totalRows_totalTimes == 0) { // Show if recordset empty ?>
                            <font size="1" face="Arial, Helvetica, sans-serif">There is no record of this track being played live.</font><br><br>
					<?php  } ?>
                          </td>
                        </tr>
                      </table>
                      <br>
                      <table width="360" border="0" height="100" bordercolor="#666666">
                        <tr bordercolor="#333333">
                          <td width="50%" valign="top"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif"><b>Earliest listed performance:</b><br>
                                        <br>
                                        <span class="linkageStuff"><a href="show_details.php?showID=<?php echo urlencode($row_wooHoo['showID']); ?>" class="linkageStuff"><font color="#999999"><?php echo date('l, m/d/Y',strtotime($row_wooHoo['showDate'])); ?></font></a> </span><font color="#999999"><br>
                                        <a href="browse.php?venueID=<?php echo $row_wooHoo['venueID']; ?>" class="linkageStuff"><?php echo $row_wooHoo['venueName']; ?></a><span class="linkageStuff"><br>
                                        <a href="browse.php?cityID=<?php echo $row_wooHoo['cityID']; ?>" class="linkageStuff"><?php echo $row_wooHoo['cityName']; ?></a></span>,<br>
                                        <span class="linkageStuff"><a href="browse.php?localityID=<?php echo $row_wooHoo['localityID']; ?>" class="linkageStuff"><?php echo $row_wooHoo['localityName']; ?></a></span> - <span class="linkageStuff"><?php echo $row_wooHoo['countryName']; ?></span></font></font></td>
                          <td width=50% valign="top"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif"><b>Most recent listed performance:</b><br>
                                        <br>
                                        <span class="linkageStuff"><a href="show_details.php?showID=<?php echo urlencode($row_hooWoo['showID']); ?>" class="linkageStuff"><font color="#999999"><?php echo date('l, m/d/Y',strtotime($row_hooWoo['showDate'])); ?></font></a> </span><font color="#999999"><br>
                                        <a href="browse.php?venueID=<?php echo $row_hooWoo['venueID']; ?>" class="linkageStuff"><?php echo $row_hooWoo['venueName']; ?></a><span class="linkageStuff"><br>
                                        <a href="browse.php?cityID=<?php echo $row_hooWoo['cityID']; ?>" class="linkageStuff"><?php echo $row_hooWoo['cityName']; ?></a></span>, <br>
                                        <a href="browse.php?localityID=<?php echo $row_hooWoo['localityID']; ?>" class="linkageStuff"><?php echo $row_hooWoo['localityName']; ?></a> - <span class="linkageStuff"><?php echo $row_hooWoo['countryName']; ?></span></font></font></td>
                        </tr>
                      </table>
                      <?php } // Show if recordset not empty ?>
                      <font size="1" face="Verdana, Arial, Helvetica, sans-serif"><br><br><img src="images/minibar_foundreleases.gif" width="250" height="27"></font>
                      <?php if ($totalRows_versionTitles > 0) { // Show if recordset not empty ?>
                      <br>
                      <table width="360" bgcolor="#FFFFFF" border="0" cellspacing="0" cellpadding="1">
                        <tr>
                          <td align="center"><?php do { ?>
                              <table width="360" border="0" bgcolor="#000033">
                                <tr>
                                  <td width="38" rowspan="2"><img src="<?php echo $row_versionTitles['imgUrlSmall']; ?>" border="0"></td>
                                  <td width="268" valign="bottom">&nbsp;</td>
                                </tr>
                                <tr>

                                  <td valign="bottom"><br>
                                      <font face="Arial, Helvetica, sans-serif" size="-6" color="#333333"><a href="58_viewrelease.php?releaseID=<?php echo $row_versionTitles['releaseID']; ?>"><?php echo $row_versionTitles['releaseTitle']; ?> (<?php echo $row_versionTitles['country']; ?>)</a><br>
                                      </font><font color="#999999" size="1" face="Arial, Helvetica, sans-serif">[<?php echo $row_versionTitles['versionTitle']; ?>]</font><br>
                                      <font size="1" face="Arial, Helvetica, sans-serif"><?php echo date('F d, Y',strtotime($row_versionTitles['releaseDate'])); ?></font></td>
                                </tr>
                              </table>
                              <?php } while ($row_versionTitles = mysql_fetch_assoc($versionTitles)); ?></td>
                        </tr>
                      </table>
                      <br>
                      <?php } // Show if recordset not empty ?>
                      <font face="Arial, Helvetica, sans-serif" size="1"> <em>
                    <?php if ($totalRows_versionTitles == 0) { // Show if recordset empty ?>
                      	<br>Currenly unreleased.
              		<?php } // Show if recordset empty ?>
					</em><br></font><br>
                    	<font size="1" face="Arial, Helvetica, sans-serif"><img src="images/minibar_abouttrack.gif" width="250" height="27"><br>
                    	<font color="#CCCCCC"><?php echo $row_trackDetails['notes']; ?></font></font><br><br>
                    </td>
                  	<td align="center" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="5">
                      <tr>
                        <td width="400" valign="top">
                        <?php if($totalRows_openingtracks>0) {?>
                            <table width="400" border="0" cellspacing="0" cellpadding="1" align="left">
                         		<tr>
									<td bgcolor="#FFFFFF"><font color="#000033" size="1" face="Arial, Helvetica, sans-serif"><?php echo $row_openingtracks['trackTitle']; ?> has opened the main set <?php echo $totalRows_openingtracks; ?> times.</font></td>
                              	</tr>
                              	<tr>
                                	<td bgcolor="#FFFFFF"><table width="300" border="0" cellspacing="0" cellpadding="0">
                                    	<table width="400" border="0" cellspacing="0" cellpadding="0">
                                      	<?php $recordCounter = 0; ?>
                                      	<?php do { ?><tr<?php $recordCounter=$recordCounter+1;if ($recordCounter % 2 == 1){echo " bgcolor=#333399";} else{echo " bgcolor=#000033";}?>>
												<td height="2" nowrap><font color="#3399CC" size="1" face="Arial, Helvetica, sans-serif"><a href="show_details.php?showID=<?php echo $row_openingtracks['showID']; ?>" class="linkageStuff"><?php echo $row_openingtracks['showDate']; ?> - <?php echo $row_openingtracks['venueName']; ?> - <?php echo $row_openingtracks['cityName']; ?></a></font></td>
                                      		</tr>
                                      	<?php } while ($row_openingtracks = mysql_fetch_assoc($openingtracks)); ?>
                                    	</table></td></tr>
                    </table>
                   </td>

                </tr>
                <tr>
                  <td><?php } ?>
                      <br>
                      <?php if($totalRows_encoreLead>0) {?>
                      <table width="400" border="0" cellspacing="0" cellpadding="1" align="left">
                        <tr>
                          <td bgcolor="#FFFFFF"><font color="#000033" size="1" face="Arial, Helvetica, sans-serif"><?php echo $row_encoreLead['trackTitle']; ?> has opened the first encore <?php echo $totalRows_encoreLead; ?> times.</font></td>
                        </tr>
                        <tr>
                          <td bgcolor="#FFFFFF"><table width="300" border="0" cellspacing="0" cellpadding="0">
                              <table width="400" border="0" cellspacing="0" cellpadding="0">
                                <?php $recordCounter = 0; ?>
                                <?php do { ?>
                                <tr<?php $recordCounter=$recordCounter+1; if ($recordCounter % 2 == 1) {echo " bgcolor=#333399";} else { echo " bgcolor=#000033";} ?>>
                                  <td height="2" nowrap>
                                  <?php if($totalRows_encoreLead>0) {?>
                                  <font color="#3399CC" size="1" face="Arial, Helvetica, sans-serif">
                                    
                                    <a href="show_details.php?showID=<?php echo $row_encoreLead['showID']; ?>" class="linkageStuff"><?php echo $row_encoreLead['showDate']; ?> - <?php echo $row_encoreLead['venueName']; ?> - <?php echo $row_encoreLead['cityName']; ?></a>
                                    </font><?php } ?>&nbsp;
                                  </td>
                                </tr>
                                <?php } while ($row_encoreLead = mysql_fetch_assoc($encoreLead)); ?>
                              </table></td></tr>
              </table>
                <br></td>
          </tr>
          <tr>
            <td><?php } ?>
                <br />
                <?php if($totalRows_encore2Lead>0) {?>
                <table width="400" border="0" cellspacing="0" cellpadding="1" align="left">
                  <tr>
                    <td bgcolor="#FFFFFF"><font color="#000033" size="1" face="Arial, Helvetica, sans-serif"><?php echo $row_encore2Lead['trackTitle']; ?> has opened the second encore <?php echo $totalRows_encore2Lead; ?> times.</font></td>
                  </tr>
                  <tr>
                    <td bgcolor="#FFFFFF"><table width="300" border="0" cellspacing="0" cellpadding="0">
                        <table width="400" border="0" cellspacing="0" cellpadding="0">
                          <?php $recordCounter = 0; ?>
                          <?php do { ?>
                          <tr<?php $recordCounter=$recordCounter+1; if ($recordCounter % 2 == 1) {echo " bgcolor=#333399";} else { echo " bgcolor=#000033";} ?>>
                            <td height="2" nowrap><font color="#3399CC" size="1" face="Arial, Helvetica, sans-serif">
                              <?php if($totalRows_encore2Lead>0) {?>
                              <a href="show_details.php?showID=<?php echo $row_encore2Lead['showID']; ?>" class="linkageStuff"><?php echo $row_encore2Lead['showDate']; ?> - <?php echo $row_encore2Lead['venueName']; ?> - <?php echo $row_encore2Lead['cityName']; ?></a>
                              <?php } ?>

                            </font></td>
                          </tr>
                          <?php } while ($row_encore2Lead = mysql_fetch_assoc($encore2Lead)); ?>
                        </table>
                    </table></td>
                  </tr>

        <?php } ?>
                </table>
        </table>
        <br>
        <br>
        <table width="800" cellpadding="5">
          <tr>
            <td valign="top" bgcolor="#333366"><font color="#FFFFFF">
              <?php require_once('58ss_includes/58disclaimer.php'); ?>
            </td>
          </tr>
        </table>
    </div></td>
  </tr>
</table>
</body>
</html>
<?php
mysql_free_result($perfs1992);

mysql_free_result($perfs1993);

mysql_free_result($perfs1994);


mysql_free_result($perfs1995);

mysql_free_result($perfs1996);

mysql_free_result($perfs1997);

mysql_free_result($perfs1998);

mysql_free_result($perfs1999);

mysql_free_result($perfs2000);

mysql_free_result($perfs2001);

mysql_free_result($perfs2002);

mysql_free_result($perfs2003);

mysql_free_result($perfs2004);

mysql_free_result($perfs2005);

mysql_free_result($perfs2006);

mysql_free_result($openingtracks);

mysql_free_result($encoreLead);

mysql_free_result($encore2Lead);

mysql_free_result($titleDetails);

mysql_free_result($correspondingTitles);

mysql_free_result($trackDetails);

mysql_free_result($hooWoo);

mysql_free_result($wooHoo);

mysql_free_result($versionTitles);

mysql_free_result($allTitles);

mysql_free_result($otherTitles);

mysql_free_result($totalTimes);
?>

