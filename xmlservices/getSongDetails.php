<?php require_once('../Connections/radioRecords.php');


$colname_posVariance = "9999";
if (isset($HTTP_GET_VARS['trackID'])) {
  $colname_posVariance = (get_magic_quotes_gpc()) ? $HTTP_GET_VARS['trackID'] : addslashes($HTTP_GET_VARS['trackID']);
}
mysql_select_db($database_radioRecords, $radioRecords);
$query_posVariance = sprintf("SELECT AVG(livetracks_db.songNumber) AS avgPos, MIN(livetracks_db.songNumber) AS earliestPos, MAX(livetracks_db.songNumber) AS latestPos, STD(livetracks_db.songNumber) AS songDerv  FROM titleresolver, livetracks_db WHERE livetracks_db.trackID = %s AND titleresolver.trackID = livetracks_db.trackID", $colname_posVariance);
$posVariance = mysql_query($query_posVariance, $radioRecords) or die(mysql_error());
$row_posVariance = mysql_fetch_assoc($posVariance);
$totalRows_posVariance = mysql_num_rows($posVariance);


////////////////////////////


$colname_encoreLead = "9999";
if (isset($HTTP_GET_VARS['trackID'])) {
  $colname_encoreLead = (get_magic_quotes_gpc()) ? $HTTP_GET_VARS['trackID'] : addslashes($HTTP_GET_VARS['trackID']);
}
//mysql_select_db($database_radioRecords, $radioRecords);
$query_encoreLead = sprintf("SELECT showlist_db.showDate, venuedetails.venueName, cityresolver.cityName, encore1leaders.trackTitle, encore1leaders.trackID, showlist_db.showID FROM cityresolver, venuedetails, showlist_db, encore1leaders, titleresolver WHERE encore1leaders.showID = showlist_db.showID AND encore1leaders.trackTitle = titleresolver.trackTitle AND venuedetails.venueID = showlist_db.showVenueID AND cityresolver.cityID = venuedetails.venueCity AND titleresolver.trackID='%s' ORDER BY showlist_db.showDate DESC", $colname_encoreLead);
$encoreLead = mysql_query($query_encoreLead, $radioRecords) or die(mysql_error());
$row_encoreLead = mysql_fetch_assoc($encoreLead);
$totalRows_encoreLead = mysql_num_rows($encoreLead);

$colname_encore2Lead = "9999";
if (isset($HTTP_GET_VARS['trackID'])) {
  $colname_encore2Lead = (get_magic_quotes_gpc()) ? $HTTP_GET_VARS['trackID'] : addslashes($HTTP_GET_VARS['trackID']);
}
//mysql_select_db($database_radioRecords, $radioRecords);
$query_encore2Lead = sprintf("SELECT showlist_db.showDate, venuedetails.venueName, cityresolver.cityName, encore2leaders.trackTitle,  encore2leaders.trackID, showlist_db.showID FROM cityresolver, venuedetails, showlist_db, encore2leaders, titleresolver WHERE encore2leaders.showID = showlist_db.showID AND encore2leaders.trackTitle = titleresolver.trackTitle AND venuedetails.venueID = showlist_db.showVenueID AND cityresolver.cityID = venuedetails.venueCity AND titleresolver.trackID='%s' ORDER BY showlist_db.showDate DESC", $colname_encore2Lead);
$encore2Lead = mysql_query($query_encore2Lead, $radioRecords) or die(mysql_error());
$row_encore2Lead = mysql_fetch_assoc($encore2Lead);
$totalRows_encore2Lead = mysql_num_rows($encore2Lead);

$colname_openingtracks = "9999";
if (isset($HTTP_GET_VARS['trackID'])) {
  $colname_openingtracks = (get_magic_quotes_gpc()) ? $HTTP_GET_VARS['trackID'] : addslashes($HTTP_GET_VARS['trackID']);
}
//mysql_select_db($database_radioRecords, $radioRecords);
$query_openingtracks = sprintf("SELECT showlist_db.showDate, venuedetails.venueName, cityresolver.cityName, livetracks_db.trackID, livetracks_db.showID, titleresolver.trackTitle, count(livetracks_db.showID) as numOfShows FROM cityresolver, venuedetails, livetracks_db, titleresolver, showlist_db WHERE venuedetails.venueID = showlist_db.showVenueID AND cityresolver.cityID = venuedetails.venueCity AND livetracks_db.trackID = titleresolver.trackID AND songNumber='1' AND livetracks_db.trackID = '%s' AND showlist_db.showID = livetracks_db.showID GROUP BY livetracks_db.showID ORDER BY showlist_db.showDate DESC", $colname_openingtracks);
$openingtracks = mysql_query($query_openingtracks, $radioRecords) or die(mysql_error());
$row_openingtracks = mysql_fetch_assoc($openingtracks);
$totalRows_openingtracks = mysql_num_rows($openingtracks);



$colname_perfs2006 = "1";
if (isset($HTTP_GET_VARS['trackID'])) {
  $colname_perfs2006 = (get_magic_quotes_gpc()) ? $HTTP_GET_VARS['trackID'] : addslashes($HTTP_GET_VARS['trackID']);
}
//mysql_select_db($database_radioRecords, $radioRecords);
$query_perfs2006 = sprintf("SELECT titleresolver.trackID, COUNT(*) FROM livetracks_db, titleresolver, showlist_db WHERE showlist_db.showID = livetracks_db.showID AND titleresolver.trackID = livetracks_db.trackID AND titleresolver.trackID = '%s' AND (showlist_db.showDate >= '2006-01-01' AND showlist_db.showDate <= '2006-12-31') GROUP BY titleresolver.trackID", $colname_perfs2006);
$perfs2006 = mysql_query($query_perfs2006, $radioRecords) or die(mysql_error());
$row_perfs2006 = mysql_fetch_assoc($perfs2006);
$totalRows_perfs2006 = mysql_num_rows($perfs2006);


$colname_perfs2005 = "1";
if (isset($HTTP_GET_VARS['trackID'])) {
  $colname_perfs2005 = (get_magic_quotes_gpc()) ? $HTTP_GET_VARS['trackID'] : addslashes($HTTP_GET_VARS['trackID']);
}
//mysql_select_db($database_radioRecords, $radioRecords);
$query_perfs2005 = sprintf("SELECT titleresolver.trackID, COUNT(*) FROM livetracks_db, titleresolver, showlist_db WHERE showlist_db.showID = livetracks_db.showID AND titleresolver.trackID = livetracks_db.trackID AND titleresolver.trackID = '%s' AND (showlist_db.showDate >= '2005-01-01' AND showlist_db.showDate <= '2005-12-31') GROUP BY titleresolver.trackID", $colname_perfs2005);
$perfs2005 = mysql_query($query_perfs2005, $radioRecords) or die(mysql_error());
$row_perfs2005 = mysql_fetch_assoc($perfs2005);
$totalRows_perfs2005 = mysql_num_rows($perfs2005);


$colname_perfs2004 = "1";
if (isset($HTTP_GET_VARS['trackID'])) {
  $colname_perfs2004 = (get_magic_quotes_gpc()) ? $HTTP_GET_VARS['trackID'] : addslashes($HTTP_GET_VARS['trackID']);
}
//mysql_select_db($database_radioRecords, $radioRecords);
$query_perfs2004 = sprintf("SELECT titleresolver.trackID, COUNT(*) FROM livetracks_db, titleresolver, showlist_db WHERE showlist_db.showID = livetracks_db.showID AND titleresolver.trackID = livetracks_db.trackID AND titleresolver.trackID = '%s' AND (showlist_db.showDate >= '2004-01-01' AND showlist_db.showDate <= '2004-12-31') GROUP BY titleresolver.trackID", $colname_perfs2004);
$perfs2004 = mysql_query($query_perfs2004, $radioRecords) or die(mysql_error());
$row_perfs2004 = mysql_fetch_assoc($perfs2004);
$totalRows_perfs2004 = mysql_num_rows($perfs2004);

$colname_perfs2003 = "1";
if (isset($HTTP_GET_VARS['trackID'])) {
  $colname_perfs2003 = (get_magic_quotes_gpc()) ? $HTTP_GET_VARS['trackID'] : addslashes($HTTP_GET_VARS['trackID']);
}
//mysql_select_db($database_radioRecords, $radioRecords);
$query_perfs2003 = sprintf("SELECT titleresolver.trackID, COUNT(*) FROM livetracks_db, titleresolver, showlist_db WHERE showlist_db.showID = livetracks_db.showID AND titleresolver.trackID = livetracks_db.trackID AND titleresolver.trackID = '%s' AND (showlist_db.showDate >= '2003-01-01' AND showlist_db.showDate <= '2003-12-31') GROUP BY titleresolver.trackID", $colname_perfs2003);
$perfs2003 = mysql_query($query_perfs2003, $radioRecords) or die(mysql_error());
$row_perfs2003 = mysql_fetch_assoc($perfs2003);
$totalRows_perfs2003 = mysql_num_rows($perfs2003);

$colname_perfs2002 = "1";
if (isset($HTTP_GET_VARS['trackID'])) {
  $colname_perfs2002 = (get_magic_quotes_gpc()) ? $HTTP_GET_VARS['trackID'] : addslashes($HTTP_GET_VARS['trackID']);
}
$query_perfs2002 = sprintf("SELECT titleresolver.trackID, COUNT(*) FROM livetracks_db, titleresolver, showlist_db WHERE showlist_db.showID = livetracks_db.showID AND titleresolver.trackID = livetracks_db.trackID AND titleresolver.trackID = '%s' AND (showlist_db.showDate >= '2002-01-01' AND showlist_db.showDate <= '2002-12-31') GROUP BY titleresolver.trackID", $colname_perfs2002);


$perfs2002 = mysql_query($query_perfs2002, $radioRecords) or die(mysql_error());
$row_perfs2002 = mysql_fetch_assoc($perfs2002);
$totalRows_perfs2002 = mysql_num_rows($perfs2002);

$colname_perfs2001 = "1";
if (isset($HTTP_GET_VARS['trackID'])) {
  $colname_perfs2001 = (get_magic_quotes_gpc()) ? $HTTP_GET_VARS['trackID'] : addslashes($HTTP_GET_VARS['trackID']);
}
$query_perfs2001 = sprintf("SELECT titleresolver.trackID, COUNT(*) FROM livetracks_db, titleresolver, showlist_db WHERE showlist_db.showID = livetracks_db.showID AND titleresolver.trackID = livetracks_db.trackID AND titleresolver.trackID = '%s' AND (showlist_db.showDate >= '2001-01-01' AND showlist_db.showDate <= '2001-12-31') GROUP BY titleresolver.trackID", $colname_perfs2001);
$perfs2001 = mysql_query($query_perfs2001, $radioRecords) or die(mysql_error());
$row_perfs2001 = mysql_fetch_assoc($perfs2001);
$totalRows_perfs2001 = mysql_num_rows($perfs2001);

$colname_perfs2000 = "1";
if (isset($HTTP_GET_VARS['trackID'])) {
  $colname_perfs2000 = (get_magic_quotes_gpc()) ? $HTTP_GET_VARS['trackID'] : addslashes($HTTP_GET_VARS['trackID']);
}
$query_perfs2000 = sprintf("SELECT titleresolver.trackID, COUNT(*) FROM livetracks_db, titleresolver, showlist_db WHERE showlist_db.showID = livetracks_db.showID AND titleresolver.trackID = livetracks_db.trackID AND titleresolver.trackID = '%s' AND (showlist_db.showDate >= '2000-01-01' AND showlist_db.showDate <= '2000-12-31') GROUP BY titleresolver.trackID", $colname_perfs2000);
$perfs2000 = mysql_query($query_perfs2000, $radioRecords) or die(mysql_error());
$row_perfs2000 = mysql_fetch_assoc($perfs2000);
$totalRows_perfs2000 = mysql_num_rows($perfs2000);

$colname_perfs1999 = "1";
if (isset($HTTP_GET_VARS['trackID'])) {
  $colname_perfs1999 = (get_magic_quotes_gpc()) ? $HTTP_GET_VARS['trackID'] : addslashes($HTTP_GET_VARS['trackID']);
}
//mysql_select_db($database_radioRecords, $radioRecords);
$query_perfs1999 = sprintf("SELECT titleresolver.trackID, COUNT(*) FROM livetracks_db, titleresolver, showlist_db WHERE showlist_db.showID = livetracks_db.showID AND titleresolver.trackID = livetracks_db.trackID AND titleresolver.trackID = '%s' AND (showlist_db.showDate >= '1999-01-01' AND showlist_db.showDate <= '1999-12-31') GROUP BY titleresolver.trackID", $colname_perfs1999);
$perfs1999 = mysql_query($query_perfs1999, $radioRecords) or die(mysql_error());
$row_perfs1999 = mysql_fetch_assoc($perfs1999);
$totalRows_perfs1999 = mysql_num_rows($perfs1999);

$colname_perfs1998 = "1";
if (isset($HTTP_GET_VARS['trackID'])) {
  $colname_perfs1998 = (get_magic_quotes_gpc()) ? $HTTP_GET_VARS['trackID'] : addslashes($HTTP_GET_VARS['trackID']);
}
//mysql_select_db($database_radioRecords, $radioRecords);
$query_perfs1998 = sprintf("SELECT titleresolver.trackID, COUNT(*) FROM livetracks_db, titleresolver, showlist_db WHERE showlist_db.showID = livetracks_db.showID AND titleresolver.trackID = livetracks_db.trackID AND titleresolver.trackID = '%s' AND (showlist_db.showDate >= '1998-01-01' AND showlist_db.showDate <= '1998-12-31') GROUP BY titleresolver.trackID", $colname_perfs1998);
$perfs1998 = mysql_query($query_perfs1998, $radioRecords) or die(mysql_error());
$row_perfs1998 = mysql_fetch_assoc($perfs1998);
$totalRows_perfs1998 = mysql_num_rows($perfs1998);

$colname_perfs1997 = "1";
if (isset($HTTP_GET_VARS['trackID'])) {
  $colname_perfs1997 = (get_magic_quotes_gpc()) ? $HTTP_GET_VARS['trackID'] : addslashes($HTTP_GET_VARS['trackID']);
}
$query_perfs1997 = sprintf("SELECT titleresolver.trackID, COUNT(*) FROM livetracks_db, titleresolver, showlist_db WHERE showlist_db.showID = livetracks_db.showID AND titleresolver.trackID = livetracks_db.trackID AND titleresolver.trackID = '%s' AND (showlist_db.showDate >= '1997-01-01' AND showlist_db.showDate <= '1997-12-31') GROUP BY titleresolver.trackID", $colname_perfs1997);
$perfs1997 = mysql_query($query_perfs1997, $radioRecords) or die(mysql_error());
$row_perfs1997 = mysql_fetch_assoc($perfs1997);
$totalRows_perfs1997 = mysql_num_rows($perfs1997);

$colname_perfs1996 = "1";
if (isset($HTTP_GET_VARS['trackID'])) {
  $colname_perfs1996 = (get_magic_quotes_gpc()) ? $HTTP_GET_VARS['trackID'] : addslashes($HTTP_GET_VARS['trackID']);
}
//mysql_select_db($database_radioRecords, $radioRecords);
$query_perfs1996 = sprintf("SELECT titleresolver.trackID, COUNT(*) FROM livetracks_db, titleresolver, showlist_db WHERE showlist_db.showID = livetracks_db.showID AND titleresolver.trackID = livetracks_db.trackID AND titleresolver.trackID = '%s' AND (showlist_db.showDate >= '1996-01-01' AND showlist_db.showDate <= '1996-12-31') GROUP BY titleresolver.trackID", $colname_perfs1996);
$perfs1996 = mysql_query($query_perfs1996, $radioRecords) or die(mysql_error());
$row_perfs1996 = mysql_fetch_assoc($perfs1996);
$totalRows_perfs1996 = mysql_num_rows($perfs1996);

$colname_perfs1995 = "1";
if (isset($HTTP_GET_VARS['trackID'])) {
  $colname_perfs1995 = (get_magic_quotes_gpc()) ? $HTTP_GET_VARS['trackID'] : addslashes($HTTP_GET_VARS['trackID']);
}
//mysql_select_db($database_radioRecords, $radioRecords);
$query_perfs1995 = sprintf("SELECT titleresolver.trackID, COUNT(*) FROM livetracks_db, titleresolver, showlist_db WHERE showlist_db.showID = livetracks_db.showID AND titleresolver.trackID = livetracks_db.trackID AND titleresolver.trackID = '%s' AND (showlist_db.showDate >= '1995-01-01' AND showlist_db.showDate <= '1995-12-31') GROUP BY titleresolver.trackID", $colname_perfs1995);
$perfs1995 = mysql_query($query_perfs1995, $radioRecords) or die(mysql_error());
$row_perfs1995 = mysql_fetch_assoc($perfs1995);
$totalRows_perfs1995 = mysql_num_rows($perfs1995);

$colname_perfs1994 = "1";
if (isset($HTTP_GET_VARS['trackID'])) {
  $colname_perfs1994 = (get_magic_quotes_gpc()) ? $HTTP_GET_VARS['trackID'] : addslashes($HTTP_GET_VARS['trackID']);
}
//mysql_select_db($database_radioRecords, $radioRecords);
$query_perfs1994 = sprintf("SELECT titleresolver.trackID, COUNT(*) FROM livetracks_db, titleresolver, showlist_db WHERE showlist_db.showID = livetracks_db.showID AND titleresolver.trackID = livetracks_db.trackID AND titleresolver.trackID = '%s' AND (showlist_db.showDate >= '1994-01-01' AND showlist_db.showDate <= '1994-12-31') GROUP BY titleresolver.trackID", $colname_perfs1994);
$perfs1994 = mysql_query($query_perfs1994, $radioRecords) or die(mysql_error());
$row_perfs1994 = mysql_fetch_assoc($perfs1994);
$totalRows_perfs1994 = mysql_num_rows($perfs1994);


$colname_perfs1993 = "1";
if (isset($HTTP_GET_VARS['trackID'])) {
  $colname_perfs1993 = (get_magic_quotes_gpc()) ? $HTTP_GET_VARS['trackID'] : addslashes($HTTP_GET_VARS['trackID']);
}
//mysql_select_db($database_radioRecords, $radioRecords);
$query_perfs1993 = sprintf("SELECT titleresolver.trackID, COUNT(*) FROM livetracks_db, titleresolver, showlist_db WHERE showlist_db.showID = livetracks_db.showID AND titleresolver.trackID = livetracks_db.trackID AND titleresolver.trackID = '%s' AND (showlist_db.showDate >= '1993-01-01' AND showlist_db.showDate <= '1993-12-31') GROUP BY titleresolver.trackID", $colname_perfs1993);
$perfs1993 = mysql_query($query_perfs1993, $radioRecords) or die(mysql_error());
$row_perfs1993 = mysql_fetch_assoc($perfs1993);
$totalRows_perfs1993 = mysql_num_rows($perfs1993);


$colname_perfs1992 = "1";
if (isset($HTTP_GET_VARS['trackID'])) {
  $colname_perfs1992 = (get_magic_quotes_gpc()) ? $HTTP_GET_VARS['trackID'] : addslashes($HTTP_GET_VARS['trackID']);
}
$query_perfs1992 = sprintf("SELECT titleresolver.trackID, COUNT(*) FROM livetracks_db, titleresolver, showlist_db WHERE showlist_db.showID = livetracks_db.showID AND titleresolver.trackID = livetracks_db.trackID AND titleresolver.trackID = '%s' AND (showlist_db.showDate >= '1992-01-01' AND showlist_db.showDate <= '1992-12-31') GROUP BY titleresolver.trackID", $colname_perfs1992);
$perfs1992 = mysql_query($query_perfs1992, $radioRecords) or die(mysql_error());
$row_perfs1992 = mysql_fetch_assoc($perfs1992);
$totalRows_perfs1992 = mysql_num_rows($perfs1992);

$colname_titleDetails = "1";
if (isset($HTTP_GET_VARS['trackID'])) {
  $colname_titleDetails = (get_magic_quotes_gpc()) ? $HTTP_GET_VARS['trackID'] : addslashes($HTTP_GET_VARS['trackID']);
}
//mysql_select_db($database_radioRecords, $radioRecords);
$query_titleDetails = sprintf("SELECT DISTINCT livetracks_db.showID, titleresolver.trackTitle, titleresolver.trackID FROM livetracks_db, titleresolver WHERE titleresolver.trackID = '%s'", $colname_titleDetails);
$titleDetails = mysql_query($query_titleDetails, $radioRecords) or die(mysql_error());
$row_titleDetails = mysql_fetch_assoc($titleDetails);
$totalRows_titleDetails = mysql_num_rows($titleDetails);

$colname_correspondingTitles = "1";
if (isset($HTTP_GET_VARS['trackID'])) {
  $colname_correspondingTitles = (get_magic_quotes_gpc()) ? $HTTP_GET_VARS['trackID'] : addslashes($HTTP_GET_VARS['trackID']);
}
//mysql_select_db($database_radioRecords, $radioRecords);
$query_correspondingTitles = sprintf("SELECT DISTINCT albumdb.radioID, albumdb.ReleaseTitle, albumdb.ReleaseDate, albumdb.ReleaseArtist,  albumdb.amazonLink, albumdb.country, albumdb.imgUrlSmall FROM albumdb, livetracks_db, studiotrack_db, titleresolver WHERE studiotrack_db.releaseID = albumdb.radioID AND studiotrack_db.trackName=titleresolver.trackTitle AND titleresolver.trackID='%s' ORDER BY albumdb.ReleaseDate ASC", $colname_correspondingTitles);
$correspondingTitles = mysql_query($query_correspondingTitles, $radioRecords) or die(mysql_error());
$row_correspondingTitles = mysql_fetch_assoc($correspondingTitles);
$totalRows_correspondingTitles = mysql_num_rows($correspondingTitles);

$colname_trackDetails = "1";
if (isset($HTTP_GET_VARS['trackID'])) {
  $colname_trackDetails = (get_magic_quotes_gpc()) ? $HTTP_GET_VARS['trackID'] : addslashes($HTTP_GET_VARS['trackID']);
}
//mysql_select_db($database_radioRecords, $radioRecords);
$query_trackDetails = sprintf("SELECT * FROM songdetails, titleresolver WHERE songdetails.trackID = titleresolver.trackID AND titleresolver.trackID= '%s'", $colname_trackDetails);
$trackDetails = mysql_query($query_trackDetails, $radioRecords) or die(mysql_error());
$row_trackDetails = mysql_fetch_assoc($trackDetails);
$totalRows_trackDetails = mysql_num_rows($trackDetails);


$colname_otherTitles = "1";
if (isset($HTTP_GET_VARS['trackID'])) {
  $colname_otherTitles = (get_magic_quotes_gpc()) ? $HTTP_GET_VARS['trackID'] : addslashes($HTTP_GET_VARS['trackID']);
}
//mysql_select_db($database_radioRecords, $radioRecords);
$query_otherTitles = sprintf("SELECT alternateTitle FROM alternatetitles WHERE trackTitleID = '%s' ORDER BY alternateTitle ASC", $colname_otherTitles);
$otherTitles = mysql_query($query_otherTitles, $radioRecords) or die(mysql_error());
$row_otherTitles = mysql_fetch_assoc($otherTitles);
$totalRows_otherTitles = mysql_num_rows($otherTitles);



$colname_hooWoo = "1";
if (isset($HTTP_GET_VARS['trackID'])) {
  $colname_hooWoo = (get_magic_quotes_gpc()) ? $HTTP_GET_VARS['trackID'] : addslashes($HTTP_GET_VARS['trackID']);
}
$query_hooWoo = sprintf("SELECT DISTINCT showlist_db.showID, venuedetails.venueID, countryresolver.countryName, localityresolver.localityName, localityresolver.localityID, cityresolver.cityName, cityresolver.cityID, venuedetails.venueName, showlist_db.showDate FROM showlist_db,livetracks_db, titleresolver, cityresolver, localityresolver, countryresolver, venuedetails WHERE showlist_db.showID = livetracks_db.showID  AND livetracks_db.trackID=titleresolver.trackID AND venuedetails.venueID = showlist_db.showVenueID AND venuedetails.venueCity = cityresolver.cityID AND cityresolver.localityID = localityresolver.localityID AND localityresolver.countryID = countryresolver.countryID AND titleresolver.trackID='%s' ORDER BY showlist_db.showDate DESC LIMIT 1", $colname_hooWoo);
$hooWoo = mysql_query($query_hooWoo, $radioRecords) or die(mysql_error());
$row_hooWoo = mysql_fetch_assoc($hooWoo);
$totalRows_hooWoo = mysql_num_rows($hooWoo);

$colname_wooHoo = "1";
if (isset($HTTP_GET_VARS['trackID'])) {
  $colname_wooHoo = (get_magic_quotes_gpc()) ? $HTTP_GET_VARS['trackID'] : addslashes($HTTP_GET_VARS['trackID']);
}
//mysql_select_db($database_radioRecords, $radioRecords);
$query_wooHoo = sprintf("SELECT DISTINCT showlist_db.showID, venuedetails.venueID, countryresolver.countryName, localityresolver.localityName, localityresolver.localityID, cityresolver.cityName, cityresolver.cityID, venuedetails.venueName, showlist_db.showDate FROM showlist_db,livetracks_db, titleresolver, cityresolver, localityresolver, countryresolver, venuedetails WHERE showlist_db.showID = livetracks_db.showID  AND livetracks_db.trackID=titleresolver.trackID AND venuedetails.venueID = showlist_db.showVenueID AND venuedetails.venueCity = cityresolver.cityID AND cityresolver.localityID = localityresolver.localityID AND localityresolver.countryID = countryresolver.countryID AND titleresolver.trackID='%s' ORDER BY showlist_db.showDate LIMIT 1", $colname_wooHoo);
$wooHoo = mysql_query($query_wooHoo, $radioRecords) or die(mysql_error());
$row_wooHoo = mysql_fetch_assoc($wooHoo);
$totalRows_wooHoo = mysql_num_rows($wooHoo);

$colname_totalTimes = "1";
if (isset($HTTP_GET_VARS['trackID'])) {
  $colname_totalTimes = (get_magic_quotes_gpc()) ? $HTTP_GET_VARS['trackID'] : addslashes($HTTP_GET_VARS['trackID']);
}
//mysql_select_db($database_radioRecords, $radioRecords);
$query_totalTimes = sprintf("SELECT DISTINCT showlist_db.showDate FROM showlist_db,livetracks_db, titleresolver, cityresolver, localityresolver, countryresolver, venuedetails WHERE showlist_db.showID = livetracks_db.showID  AND livetracks_db.trackID=titleresolver.trackID AND venuedetails.venueID = showlist_db.showVenueID AND venuedetails.venueCity = cityresolver.cityID AND cityresolver.localityID = localityresolver.localityID AND localityresolver.countryID = countryresolver.countryID AND titleresolver.trackID='%s' ORDER BY showlist_db.showDate", $colname_totalTimes);
$totalTimes = mysql_query($query_totalTimes, $radioRecords) or die(mysql_error());
$row_totalTimes = mysql_fetch_assoc($totalTimes);
$totalRows_totalTimes = mysql_num_rows($totalTimes);


$colname_versionTitles = "1";
if (isset($HTTP_GET_VARS['trackID'])) {
  $colname_versionTitles = (get_magic_quotes_gpc()) ? $HTTP_GET_VARS['trackID'] : addslashes($HTTP_GET_VARS['trackID']);
}
//mysql_select_db($database_radioRecords, $radioRecords);
$query_versionTitles = sprintf("SELECT DISTINCT studiotrack_db.trackName, albumdb.country, albumdb.releaseTitle, albumdb.imgUrlSmall, albumdb.releaseDate, versionResolver.versionTitle, studiotrack_db.releaseID FROM studiotrack_db, albumdb, versionResolver WHERE studiotrack_db.trackResID = '%s' AND studiotrack_db.releaseID = albumdb.radioID AND studiotrack_db.verResID = versionResolver.versionID ORDER BY albumdb.releaseDate DESC", $colname_versionTitles);
$versionTitles = mysql_query($query_versionTitles, $radioRecords) or die(mysql_error());
$row_versionTitles = mysql_fetch_assoc($versionTitles);
$totalRows_versionTitles = mysql_num_rows($versionTitles);

$query_allTitles = "SELECT * FROM titleresolver ORDER BY trackTitle ASC";
$allTitles = mysql_query($query_allTitles, $radioRecords) or die(mysql_error());
$row_allTitles = mysql_fetch_assoc($allTitles);
$totalRows_allTitles = mysql_num_rows($allTitles);


$colname_perfCollection = "79";
if (isset($HTTP_GET_VARS['trackID'])) {
  $colname_perfCollection = (get_magic_quotes_gpc()) ? $HTTP_GET_VARS['trackID'] : addslashes($HTTP_GET_VARS['trackID']);
}
//mysql_select_db($database_radioRecords, $radioRecords);
$query_perfCollection = sprintf("SELECT showlist_db.showDate, venuedetails.venueName, venuedetails.venueID, cityresolver.cityName, cityresolver.cityID, localityresolver.localityName, localityresolver.localityID, countryresolver.countryName, countryresolver.countryID, livetracks_db.showID, livetracks_db.songNumber, titleresolver.trackTitle FROM livetracks_db, showlist_db, venuedetails, cityresolver, localityresolver, countryresolver, titleresolver 
WHERE titleresolver.trackID = livetracks_db.trackID AND showlist_db.showID = livetracks_db.showID AND  showlist_db.showVenueID = venuedetails.venueID AND cityresolver.cityID = venuedetails.venueCity AND cityresolver.localityID = localityresolver.localityID AND localityresolver.countryID = countryresolver.countryID AND livetracks_db.trackID = %s 
ORDER BY showlist_db.showDate DESC", $colname_perfCollection);
$perfCollection = mysql_query($query_perfCollection, $radioRecords) or die(mysql_error());
$row_perfCollection = mysql_fetch_assoc($perfCollection);
$totalRows_perfCollection = mysql_num_rows($perfCollection);

echo '<?xml version="1.0" encoding="ISO-8859-1"?>';
echo "\n<response method=\"getSongPerformanceHistory\" status=\"success\">";
echo "\n\t<songDetails title=\"".$row_trackDetails['trackTitle']."\" id=\"".$row_trackDetails['trackID']."\" sysID=\"".$row_trackDetails['f8_song_id']."\" >";
echo "\n\t\t<artist id=\"00sah5JHs_\">Radiohead</artist>";
echo "\n\t\t<ocdstats grandtotal=\"".$totalRows_totalTimes."\" open=\"".$totalRows_openingtracks."\" encore1=\"".$totalRows_encoreLead."\" encore2=\"".$totalRows_encore2Lead."\" avgpos=\"".$row_posVariance['avgPos']."\" />";
echo "\n\t\t<yearbreakdown>";
echo "\n\t\t\t<year value=\"2000\" num=\"".$row_perfs2000['COUNT(*)']."\" />";
echo "\n\t\t\t<year value=\"2001\" num=\"".$row_perfs2001['COUNT(*)']."\" />";
echo "\n\t\t\t<year value=\"2002\" num=\"".$row_perfs2002['COUNT(*)']."\" />";
echo "\n\t\t\t<year value=\"2003\" num=\"".$row_perfs2003['COUNT(*)']."\" />";
echo "\n\t\t\t<year value=\"2004\" num=\"".$row_perfs2004['COUNT(*)']."\" />";
echo "\n\t\t</yearbreakdown>";
echo "\n\t\t<lifespan>";
echo "\n\t\t	<performance type=\"0\" id=\"".$row_wooHoo['showID']."\" showdate=\"".date('l, m/d/Y',strtotime($row_wooHoo['showDate']))."\">";
echo "\n\t\t\t\t<geoloc type=\"ve\" id=\"\">".$row_wooHoo['venueName']."</geoloc>";
echo "\n\t\t\t\t<geoloc type=\"ci\" id=\"\">".$row_wooHoo['cityName']."</geoloc>";
echo "\n\t\t\t\t<geoloc type=\"lo\" id=\"\">".$row_wooHoo['localityName']."</geoloc>";
echo "\n\t\t\t\t<geoloc type=\"co\" id=\"\">".$row_wooHoo['countryName']."</geoloc>";
echo "\n\t\t\t</performance>";
echo "\n\t\t\t<performance type=\"1\" id=\"".$row_hooWoo['showID']."\" showdate=\"".date('l, m/d/Y',strtotime($row_hooWoo['showDate']))."\">";
echo "\n\t\t\t\t<geoloc type=\"ve\" id=\"\">".$row_hooWoo['venueName']."</geoloc>";
echo "\n\t\t\t\t<geoloc type=\"ci\" id=\"\">".$row_hooWoo['cityName']."</geoloc>";
echo "\n\t\t\t\t<geoloc type=\"lo\" id=\"\">".$row_hooWoo['localityName']."</geoloc>";
echo "\n\t\t\t\t<geoloc type=\"co\" id=\"\">".$row_hooWoo['countryName']."</geoloc>";
echo "\n\t\t\t</performance>";
echo "\n\t\t</lifespan>";

echo "\n\t\t<history>";
// now it's time to work on having it show all of the listed performances (with setlists)
do
{
	echo "\n\t\t\t<show id=\"".$row_perfCollection['showID']."\" date=\"".date('l, m/d/Y',strtotime($row_perfCollection['showDate']))."\">";
	echo "\n\t\t\t\t".'<geoprop type="ve" id="'.$row_perfCollection['venueID'].'">'.$row_perfCollection['venueName'].'</geoprop>';
	echo "\n\t\t\t\t".'<geoprop type="ci" id="'.$row_perfCollection['cityID'].'">'.$row_perfCollection['cityName'].'</geoprop>';
	echo "\n\t\t\t\t".'<geoprop type="lo" id="'.$row_perfCollection['localityID'].'">'.$row_perfCollection['localityName'].'</geoprop>';
	echo "\n\t\t\t\t".'<geoprop type="co" id="'.$row_perfCollection['countryID'].'">'.$row_perfCollection['countryName'].'</geoprop>';
	echo "\n\t\t\t</show>";
}while ($row_perfCollection = mysql_fetch_assoc($perfCollection));
echo "\n\t\t</history>";
echo "\n\t\t<studioreleases>";
do{
	echo "\n\t\t\t<release title=\"".$row_versionTitles['releaseTitle']."\" releasedate=\"".$row_versionTitles['releaseDate']."\" country=\"".$row_versionTitles['country']."\" versionName=\"".$row_versionTitles['releaseTitle']."\" />";
} while ($row_versionTitles = mysql_fetch_assoc($versionTitles));
echo "\n\t\t</studioreleases>";
echo "\n\t".'</songDetails>';
echo "\n</response>";

mysql_close($radioRecords);
 ?>

