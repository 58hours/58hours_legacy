<?php 
require_once('Connections/random_connect.php');
require_once('_includes/SITEARTIST.php');
require_once('_includes/rhcommon.php'); ?>
<?php

$colname_posVariance = "9999";
if (isset($_GET['external_song_id'])) {
  $colname_posVariance = (get_magic_quotes_gpc()) ? $_GET['external_song_id'] : addslashes($_GET['external_song_id']);
}
mysql_select_db($database_random_connect, $random_connect);
$query_posVariance = sprintf("SELECT AVG(rhr_livetracks.songNumber) AS avgPos, MIN(rhr_livetracks.songNumber) AS earliestPos, MAX(rhr_livetracks.songNumber) AS latestPos, STD(rhr_livetracks.songNumber) AS songDerv  FROM rhr_titleresolver, rhr_livetracks WHERE rhr_livetracks.external_song_id = %s AND rhr_titleresolver.external_song_id = rhr_livetracks.external_song_id", GetSQLValueString($colname_posVariance,"text"));
$posVariance = mysql_query($query_posVariance, $random_connect) or die(mysql_error());
$row_posVariance = mysql_fetch_assoc($posVariance);
$totalRows_posVariance = mysql_num_rows($posVariance);


////////////////////////////

/*
$colname_encoreLead = "9999";
if (isset($_GET['external_song_id'])) {
  $colname_encoreLead = (get_magic_quotes_gpc()) ? $_GET['external_song_id'] : addslashes($_GET['external_song_id']);
}
mysql_select_db($database_random_connect, $random_connect);
$query_encoreLead = sprintf("SELECT rhr_performances.showDate, rhr_venueresolver.venue_name_display, rhr_cityresolver.city_name_display, encore1leaders.song_name_display, encore1leaders.external_song_id, rhr_performances.external_show_id FROM rhr_cityresolver, rhr_venueresolver, rhr_performances, encore1leaders, rhr_titleresolver WHERE encore1leaders.external_show_id = rhr_performances.external_show_id AND encore1leaders.song_name_display = rhr_titleresolver.song_name_display AND rhr_venueresolver.external_venue_id = rhr_performances.external_venue_id AND rhr_cityresolver.external_city_id = rhr_venueresolver.external_city_id AND rhr_titleresolver.external_song_id=%s ORDER BY rhr_performances.showDate DESC", GetSQLValueString($colname_encoreLead,"text"));
$encoreLead = mysql_query($query_encoreLead, $random_connect) or die(mysql_error());
$row_encoreLead = mysql_fetch_assoc($encoreLead);
$totalRows_encoreLead = mysql_num_rows($encoreLead);

$colname_encore2Lead = "9999";
if (isset($_GET['external_song_id'])) {
  $colname_encore2Lead = (get_magic_quotes_gpc()) ? $_GET['external_song_id'] : addslashes($_GET['external_song_id']);
}
mysql_select_db($database_random_connect, $random_connect);
$query_encore2Lead = sprintf("SELECT rhr_performances.showDate, rhr_venueresolver.venue_name_display, rhr_cityresolver.city_name_display, encore2leaders.song_name_display,  encore2leaders.external_song_id, rhr_performances.external_show_id FROM rhr_cityresolver, rhr_venueresolver, rhr_performances, encore2leaders, rhr_titleresolver WHERE encore2leaders.external_show_id = rhr_performances.external_show_id AND encore2leaders.song_name_display = rhr_titleresolver.song_name_display AND rhr_venueresolver.external_venue_id = rhr_performances.external_venue_id AND rhr_cityresolver.external_city_id = rhr_venueresolver.external_city_id AND rhr_titleresolver.external_song_id=%s ORDER BY rhr_performances.showDate DESC", GetSQLValueString($colname_encore2Lead,"text"));
$encore2Lead = mysql_query($query_encore2Lead, $random_connect) or die(mysql_error());
$row_encore2Lead = mysql_fetch_assoc($encore2Lead);
$totalRows_encore2Lead = mysql_num_rows($encore2Lead);
*/
$colname_openingtracks = "9999";
if (isset($_GET['external_song_id'])) {
  $colname_openingtracks = (get_magic_quotes_gpc()) ? $_GET['external_song_id'] : addslashes($_GET['external_song_id']);
}
mysql_select_db($database_random_connect, $random_connect);
$query_openingtracks = sprintf("SELECT rhr_performances.showDate, rhr_venueresolver.venue_name_display, rhr_cityresolver.city_name_display, rhr_livetracks.external_song_id, rhr_livetracks.external_show_id, rhr_titleresolver.song_name_display, count(rhr_livetracks.external_show_id) as numOfShows FROM rhr_cityresolver, rhr_venueresolver, rhr_livetracks, rhr_titleresolver, rhr_performances WHERE rhr_venueresolver.external_venue_id = rhr_performances.external_venue_id AND rhr_cityresolver.external_city_id = rhr_venueresolver.external_city_id AND rhr_livetracks.external_song_id = rhr_titleresolver.external_song_id AND songNumber='1' AND rhr_livetracks.external_song_id = %s AND rhr_performances.external_show_id = rhr_livetracks.external_show_id GROUP BY rhr_livetracks.external_show_id ORDER BY rhr_performances.showDate DESC", GetSQLValueString($colname_openingtracks,"text"));
$openingtracks = mysql_query($query_openingtracks, $random_connect) or die(mysql_error());
$row_openingtracks = mysql_fetch_assoc($openingtracks);
$totalRows_openingtracks = mysql_num_rows($openingtracks);
//////////////////////////

$colname_titleDetails = "1";
if (isset($_GET['external_song_id'])) {
  $colname_titleDetails = (get_magic_quotes_gpc()) ? $_GET['external_song_id'] : addslashes($_GET['external_song_id']);
}
mysql_select_db($database_random_connect, $random_connect);
$query_titleDetails = sprintf("SELECT DISTINCT rhr_livetracks.external_show_id, rhr_titleresolver.song_name_display, rhr_titleresolver.external_song_id FROM rhr_livetracks, rhr_titleresolver WHERE rhr_titleresolver.external_song_id = %s", GetSQLValueString($colname_titleDetails,"text"));
$titleDetails = mysql_query($query_titleDetails, $random_connect) or die(mysql_error());
$row_titleDetails = mysql_fetch_assoc($titleDetails);
$totalRows_titleDetails = mysql_num_rows($titleDetails);
/*
$colname_correspondingTitles = "1";
if (isset($_GET['external_song_id'])) {
  $colname_correspondingTitles = (get_magic_quotes_gpc()) ? $_GET['external_song_id'] : addslashes($_GET['external_song_id']);
}
mysql_select_db($database_random_connect, $random_connect);
$query_correspondingTitles = sprintf("SELECT DISTINCT rhr_releaseresolver.external_release_id, rhr_releaseresolver.album_name_display, rhr_releaseresolver.release_date, rhr_releaseresolver.ReleaseArtist,  rhr_releaseresolver.amazonLink, rhr_releaseresolver.country, rhr_releaseresolver.imgUrlSmall FROM rhr_releaseresolver, rhr_livetracks, rhr_studiotracks, rhr_titleresolver WHERE rhr_studiotracks.external_release_id = rhr_releaseresolver.external_release_id AND rhr_studiotracks.song_name_display=rhr_titleresolver.song_name_display AND rhr_titleresolver.external_song_id='%s' ORDER BY rhr_releaseresolver.release_date ASC", $colname_correspondingTitles);
$correspondingTitles = mysql_query($query_correspondingTitles, $random_connect) or die(mysql_error());
$row_correspondingTitles = mysql_fetch_assoc($correspondingTitles);
$totalRows_correspondingTitles = mysql_num_rows($correspondingTitles);
*/
/*
$colname_trackDetails = "1";
if (isset($_GET['external_song_id'])) {
  $colname_trackDetails = (get_magic_quotes_gpc()) ? $_GET['external_song_id'] : addslashes($_GET['external_song_id']);
}
mysql_select_db($database_random_connect, $random_connect);
$query_trackDetails = sprintf("SELECT * FROM songdetails, rhr_titleresolver WHERE songdetails.external_song_id = rhr_titleresolver.external_song_id AND rhr_titleresolver.external_song_id= %s", GetSQLValueString($colname_trackDetails,"text"));
$trackDetails = mysql_query($query_trackDetails, $random_connect) or die(mysql_error());
$row_trackDetails = mysql_fetch_assoc($trackDetails);
$totalRows_trackDetails = mysql_num_rows($trackDetails);
*/
/*
$colname_itunesLink = "1";
if (isset($_GET['external_song_id'])) {
  $colname_itunesLink = (get_magic_quotes_gpc()) ? $_GET['external_song_id'] : addslashes($_GET['external_song_id']);
}
$query_itunesLink = sprintf("SELECT itunesLink FROM songdetails WHERE external_song_id = '%s'",$colname_itunesLink);
$itunesLink = mysql_query($query_itunesLink, $random_connect);
$row_itunesLink = mysql_fetch_assoc($itunesLink);
*/
/*
$colname_closingTimes = "1";
if (isset($_GET['external_song_id'])) {
  $colname_closingTimes = (get_magic_quotes_gpc()) ? $_GET['external_song_id'] : addslashes($_GET['external_song_id']);
}

$query_closingTimes = sprintf("SELECT show_id FROM showclosers WHERE song_id= '%s'", $colname_closingTimes);
$closingTimes = mysql_query($query_closingTimes, $random_connect) or die(mysql_error());
$row_closingTimes = mysql_fetch_assoc($closingTimes);
$totalRows_closingTimes = mysql_num_rows($closingTimes);
*/
/*
$colname_otherTitles = "1";
if (isset($_GET['external_song_id'])) {
  $colname_otherTitles = (get_magic_quotes_gpc()) ? $_GET['external_song_id'] : addslashes($_GET['external_song_id']);
}
mysql_select_db($database_random_connect, $random_connect);
$query_otherTitles = sprintf("SELECT alternateTitle FROM alternatetitles WHERE song_name_displayID = '%s' ORDER BY alternateTitle ASC", $colname_otherTitles);
$otherTitles = mysql_query($query_otherTitles, $random_connect) or die(mysql_error());
$row_otherTitles = mysql_fetch_assoc($otherTitles);
$totalRows_otherTitles = mysql_num_rows($otherTitles);
*/


$colname_hooWoo = "1";
if (isset($_GET['external_song_id'])) {
  $colname_hooWoo = (get_magic_quotes_gpc()) ? $_GET['external_song_id'] : addslashes($_GET['external_song_id']);
}
mysql_select_db($database_random_connect, $random_connect);
$query_hooWoo = sprintf("SELECT DISTINCT rhr_performances.external_show_id, rhr_venueresolver.external_venue_id, rhr_countryresolver.countryName, rhr_localityresolver.locale_name_display, rhr_localityresolver.external_locale_id, rhr_cityresolver.city_name_display, rhr_cityresolver.external_city_id, rhr_venueresolver.venue_name_display, rhr_performances.showDate 
FROM rhr_performances,rhr_livetracks, rhr_titleresolver, rhr_cityresolver, rhr_localityresolver, rhr_countryresolver, rhr_venueresolver 
WHERE rhr_performances.external_show_id = rhr_livetracks.external_show_id 
AND rhr_performances.external_venue_id = rhr_venueresolver.external_venue_id 
AND rhr_livetracks.external_song_id=rhr_titleresolver.external_song_id 
AND rhr_venueresolver.external_venue_id = rhr_performances.external_venue_id 
AND rhr_venueresolver.external_city_id = rhr_cityresolver.external_city_id 
AND rhr_cityresolver.external_locale_id=rhr_localityresolver.external_locale_id 
AND rhr_localityresolver.external_country_id=rhr_countryresolver.external_country_id 
AND rhr_titleresolver.external_song_id=%s ORDER BY rhr_performances.showDate DESC LIMIT 1", GetSQLValueString($colname_hooWoo,"text"));
$hooWoo = mysql_query($query_hooWoo, $random_connect) or die(mysql_error());
$row_hooWoo = mysql_fetch_assoc($hooWoo);
$totalRows_hooWoo = mysql_num_rows($hooWoo);

$colname_wooHoo = "1";
if (isset($_GET['external_song_id'])) {
  $colname_wooHoo = (get_magic_quotes_gpc()) ? $_GET['external_song_id'] : addslashes($_GET['external_song_id']);
}
mysql_select_db($database_random_connect, $random_connect);
$query_wooHoo = sprintf("SELECT DISTINCT rhr_performances.external_show_id, rhr_venueresolver.external_venue_id, rhr_countryresolver.countryName, rhr_localityresolver.locale_name_display, rhr_localityresolver.external_locale_id, rhr_cityresolver.city_name_display, rhr_cityresolver.external_city_id, rhr_venueresolver.venue_name_display, rhr_performances.showDate FROM rhr_performances,rhr_livetracks, rhr_titleresolver, rhr_cityresolver, rhr_localityresolver, rhr_countryresolver, rhr_venueresolver WHERE rhr_performances.external_show_id = rhr_livetracks.external_show_id  AND rhr_livetracks.external_song_id=rhr_titleresolver.external_song_id AND rhr_performances.external_venue_id = rhr_venueresolver.external_venue_id AND rhr_venueresolver.external_venue_id = rhr_performances.external_venue_id AND rhr_venueresolver.external_city_id = rhr_cityresolver.external_city_id AND rhr_cityresolver.external_locale_id = rhr_localityresolver.external_locale_id AND rhr_localityresolver.external_country_id = rhr_countryresolver.external_country_id AND rhr_titleresolver.external_song_id=%s ORDER BY rhr_performances.showDate LIMIT 1", GetSQLValueString($colname_wooHoo,"text"));
$wooHoo = mysql_query($query_wooHoo, $random_connect) or die(mysql_error());
$row_wooHoo = mysql_fetch_assoc($wooHoo);
$totalRows_wooHoo = mysql_num_rows($wooHoo);

$colname_totalTimes = "1";
if (isset($_GET['external_song_id'])) {
  $colname_totalTimes = (get_magic_quotes_gpc()) ? $_GET['external_song_id'] : addslashes($_GET['external_song_id']);
}
mysql_select_db($database_random_connect, $random_connect);
$query_totalTimes = sprintf("SELECT DISTINCT rhr_performances.showDate FROM rhr_performances,rhr_livetracks, rhr_titleresolver, rhr_cityresolver, rhr_localityresolver, rhr_countryresolver, rhr_venueresolver WHERE rhr_performances.external_show_id = rhr_livetracks.external_show_id  AND rhr_livetracks.external_song_id=rhr_titleresolver.external_song_id AND rhr_venueresolver.external_venue_id = rhr_performances.external_venue_id AND rhr_venueresolver.external_city_id = rhr_cityresolver.external_city_id AND rhr_cityresolver.external_locale_id = rhr_localityresolver.external_locale_id AND rhr_localityresolver.external_country_id = rhr_countryresolver.external_country_id AND rhr_titleresolver.external_song_id=%s ORDER BY rhr_performances.showDate", GetSQLValueString($colname_totalTimes,"text"));
$totalTimes = mysql_query($query_totalTimes, $random_connect) or die(mysql_error());
$row_totalTimes = mysql_fetch_assoc($totalTimes);
$totalRows_totalTimes = mysql_num_rows($totalTimes);

$yearBreakdown = array();
$yearPtr = 0;

do{
	$localPtr = substr($row_totalTimes['showDate'],0,4);
	if($yearPtr != $localPtr)
	{
		$yearBreakdown[$localPtr] = 1;
		$yearPtr = $localPtr;
	}
	else
	{
		$yearBreakdown[$localPtr]++;
	}
}while($row_totalTimes = mysql_fetch_assoc($totalTimes));


$colname_songversion_name_displays = "1";
if (isset($_GET['external_song_id'])) {
  $colname_songversion_name_displays = (get_magic_quotes_gpc()) ? $_GET['external_song_id'] : addslashes($_GET['external_song_id']);
}
mysql_select_db($database_random_connect, $random_connect);
$query_songversion_name_displays = sprintf("SELECT DISTINCT 
rhr_studiotracks.external_release_id, 
rhr_releaseversionresolver.releaseversion_name_display, 
rhr_titleresolver.song_name_display, 
rhr_countryresolver.country_name_display, 
rhr_albumresolver.album_name_display,  
rhr_images.location,  
rhr_releaseresolver.release_date, 
rhr_songversionresolver.songversion_name_display
FROM rhr_studiotracks, rhr_albumresolver, rhr_releaseresolver, rhr_titleresolver, rhr_songversionresolver, rhr_countryresolver, rhr_images, rhr_releaseversionresolver    
WHERE rhr_studiotracks.external_song_id = %s 
AND rhr_albumresolver.external_album_id = rhr_releaseresolver.external_album_id 
AND rhr_releaseresolver.external_country_id = rhr_countryresolver.external_country_id 
AND rhr_releaseversionresolver.external_releaseversion_id = rhr_releaseresolver.external_releaseversion_id 
AND rhr_studiotracks.external_release_id = rhr_releaseresolver.external_release_id 
AND rhr_studiotracks.external_songversion_id = rhr_songversionresolver.external_songversion_id 
AND rhr_images.external_subject_id = rhr_releaseresolver.external_release_id 
GROUP BY rhr_albumresolver.external_album_id 
ORDER BY rhr_releaseresolver.release_date DESC", GetSQLValueString($colname_songversion_name_displays,"text"));
$songversion_name_displays = mysql_query($query_songversion_name_displays, $random_connect) or die(mysql_error());
$row_songversion_name_displays = mysql_fetch_assoc($songversion_name_displays);
$totalRows_songversion_name_displays = mysql_num_rows($songversion_name_displays);



$colname_commonFollowers = "67";
if (isset($_GET['external_song_id'])) {
  $colname_commonFollowers = (get_magic_quotes_gpc()) ? $_GET['external_song_id'] : addslashes($_GET['external_song_id']);
}
mysql_select_db($database_random_connect, $random_connect);
$query_commonFollowers = sprintf("SELECT set1.external_song_id, set2.external_song_id AS track2, 
rhr_titleresolver.song_name_display, 
count(set2.external_show_id) AS totalNum 
FROM rhr_livetracks AS set1, rhr_livetracks AS set2, rhr_titleresolver 
WHERE set1.external_song_id = %s 
AND set1.songNumber = (set2.songNumber - 1) 
AND set2.external_song_id = rhr_titleresolver.external_song_id 
AND set1.external_show_id = set2.external_show_id 
GROUP BY track2 
ORDER BY totalNum DESC LIMIT 7", GetSQLValueString($colname_commonFollowers, "text"));
$commonFollowers = mysql_query($query_commonFollowers, $random_connect) or die(mysql_error());
$row_commonFollowers = mysql_fetch_assoc($commonFollowers);
$totalRows_commonFollowers = mysql_num_rows($commonFollowers);

$colname_commonPreceeders = "67";
if (isset($_GET['external_song_id'])) {
  $colname_commonPreceeders = (get_magic_quotes_gpc()) ? $_GET['external_song_id'] : addslashes($_GET['external_song_id']);
}
mysql_select_db($database_random_connect, $random_connect);
$query_commonPreceeders = sprintf("SELECT set1.external_song_id, set2.external_song_id AS track2, rhr_titleresolver.song_name_display, count(set2.external_show_id) AS totalNum FROM rhr_livetracks AS set1, rhr_livetracks AS set2, rhr_titleresolver WHERE set1.external_song_id = %s AND set1.songNumber = (set2.songNumber + 1) AND set2.external_song_id = rhr_titleresolver.external_song_id AND set1.external_show_id = set2.external_show_id GROUP BY track2 ORDER BY totalNum DESC LIMIT 7", GetSQLValueString($colname_commonPreceeders, "text"));
$commonPreceeders = mysql_query($query_commonPreceeders, $random_connect) or die(mysql_error());
$row_commonPreceeders = mysql_fetch_assoc($commonPreceeders);
$totalRows_commonPreceeders = mysql_num_rows($commonPreceeders);
/*
$query_availableSamples = sprintf("SELECT * FROM audiosamples WHERE songID='%s'",$row_trackDetails['external_song_id']);
$availableSamples = mysql_query($query_availableSamples, $random_connect);
$row_availableSamples = mysql_fetch_assoc($availableSamples);
$totalRows_availableSamples = mysql_num_rows($availableSamples);
*/

mysql_select_db($database_random_connect, $random_connect);
$query_allTitles = sprintf("SELECT * FROM rhr_titleresolver WHERE rhr_titleresolver.external_group_id = %s ORDER BY song_name_display ASC",GetSQLValueString($INTERNAL_SITEGROUP,"text"));
$allTitles = mysql_query($query_allTitles, $random_connect) or die(mysql_error());
$row_allTitles = mysql_fetch_assoc($allTitles);
$totalRows_allTitles = mysql_num_rows($allTitles);
?>
<html>
<head>
<title>&quot;<?php echo $row_titleDetails['song_name_display']; ?>&quot; details at 58.randomhours. a Radiohead gig database</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="stylesheet" href="css/styles.css" type="text/css">
<style type="text/css"> 
body 
{ 
background-image: url('images/bgstripes.gif'); 
} 
</style>
<script language="JavaScript">
function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}
</script>


<link href="css/stylebook.css" rel="stylesheet" type="text/css">
<script src="Scripts/AC_RunActiveContent.js" type="text/javascript"></script>
</head>
<body bgcolor="#000000" text="#FFFFFF" link="#0066CC" vlink="#0066CC" alink="#0066CC" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" class="blueishlinks">
<br>
<table width="800" border="0" align="center" cellpadding="0" cellspacing="0">
	<tr>
		<td>
			<table width="800" border="0" align="center" cellpadding="1" cellspacing="1" bgcolor="#000000">
  			<tr>
      			<td colspan="2" bgcolor="#000000"><a href="/" border="0"><img src="/i/rainbowheader_v2.jpg" width="800" height="114" border="0"></a></td>
    		</tr>
    		<tr>
    			<td>
      				<div align="center">
        			<table width="800" border="0" cellpadding="10" cellspacing="0" bgcolor="#000000">
          			<tr>
            			<td align="left" valign="top"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif">LOOKUP SONG: </font>
                			<form name="form1" method="get" action="songdetails.php?external_song_id=<?php echo $row_allTitles['external_song_id']; ?>">
                  			<select name="external_song_id" class="darkerLinkage" id="external_song_id"><?php do { ?>
								<option value="<?php echo $row_allTitles['external_song_id']?>"><?php echo $row_allTitles['song_name_display']?></option>
								<?php } while ($row_allTitles = mysql_fetch_assoc($allTitles));
  									$rows = mysql_num_rows($allTitles);
									if($rows > 0) {
										mysql_data_seek($allTitles, 0);
										$row_allTitles = mysql_fetch_assoc($allTitles);
									} ?>
                  			</select>
                  			<input type="submit" class="darkerLinkage" value="Submit">
              			</form></td>
            			<td align="right" valign="bottom" nowrap>&nbsp;</td>
          			</tr>
          			<tr>
            			<td colspan="2" align="center" valign="top" bgcolor="#000000">
            				<table width="100%" border="0" cellpadding="2" bgcolor="#000000">
                				<tr>
									<td width="50%" height="12" colspan="2" valign="top"><p>
										<script type="text/javascript">
AC_FL_RunContent( 'codebase','http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0','width','450','height','30','src','flash_elements/trackName','quality','high','pluginspage','http://www.macromedia.com/go/getflashplayer','bgcolor','#000000','flashvars','name=<?php echo urlencode($row_titleDetails['song_name_display']); ?>','movie','flash_elements/trackName' ); //end AC code
</script><noscript><object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0" width="450" height="30">
                            <param name="movie" value="flash_elements/trackName.swf">
                            <param name="quality" value="high">
                            <param name="BGCOLOR" value="#000000">
							<param name="flashVars" value="name=<?php echo urlencode($row_titleDetails['song_name_display']); ?>">
                            <embed src="flash_elements/trackName.swf" width="450" height="30" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" bgcolor="#000000" flashVars="name=<?php echo urlencode($row_titleDetails['song_name_display']); ?>"></embed>
                    					</object></noscript>
										<?php if ($totalRows_otherTitles > 0) { // Show if recordset not empty ?>
                          				<br />
                          				<font face="Arial, Helvetica, sans-serif" size="1" color="#999999"> <strong class="linkageStuff">ALSO KNOWN AS:</strong><br>
										<?php do { ?><span class="linkageStuff">&quot;<?php echo $row_otherTitles['alternateTitle']; ?>&quot;</span><br>
										<?php } while ($row_otherTitles = mysql_fetch_assoc($otherTitles)); ?>
										</font>
										<?php } // Show if recordset not empty ?>
									</td>
								</tr>
								<tr>
									<td colspan="2" valign="top"><?php if ($totalRows_wooHoo > 0) { // Show if recordset not empty ?>
										<br>
										<script type="text/javascript">
AC_FL_RunContent( 'codebase','http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0','width','800','height','100','src','flash_elements/newSpectrum','quality','high','pluginspage','http://www.macromedia.com/go/getflashplayer','flashvars','<?php 
				 foreach($yearBreakdown as $key => $value)
				 {
					 echo "y".$key."=".$value."&";
				 }
				 ?>','bgcolor','#000000','movie','flash_elements/newSpectrum' ); //end AC code
</script><noscript><object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0" width="800" height="100">
                        <param name="movie" value="flash_elements/newSpectrum.swf">
                        <param name="quality" value="high">
						<param name="flashVars" value="<?php 
				 foreach($yearBreakdown as $key => $value)
				 {
					 echo "y".$key."=".$value."&";
				 }
				 ?>" bgcolor="#000000"></embed>
										</object></noscript>
										<br/><br/><br/>
										<?php } // Show if recordset empty ?>
									</td>
								</tr>
								<tr>
                  					<td width="360" valign="top"><?
				  						if($totalRows_availableSamples>0)
				  						{ ?><script type="text/javascript">
AC_FL_RunContent( 'codebase','http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,19,0','width','118','height','20','src','flash_elements/samplePlayer','quality','high','pluginspage','http://www.macromedia.com/go/getflashplayer','movie','flash_elements/samplePlayer', 'flashvars', 'soundToPlay=<? echo $row_availableSamples['filename']; ?>' ); //end AC code
</script><noscript><object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,19,0" width="118" height="20">
                    <param name="movie" value="flash_elements/samplePlayer.swf">
                    <param name="quality" value="high">
                    <embed src="flash_elements/samplePlayer.swf" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="118" height="20"></embed>
				    </object></noscript><? } ?>
				  						<br />
										<img src="images/summary_label.gif" width="250" height="27"><?php if ($totalRows_wooHoo > 0) { // Show if recordset not empty ?>
										<table width="360" id="subtleanchor_light" border="0" cellpadding="0" cellspacing="0" bordercolor="#CCCCCC">
										<tr>
											<td bordercolor="#CCCCCC"><font size="1" color="#e3e3e3" face="Arial, Helvetica, sans-serif">Originally performed by:&nbsp;<?php echo $row_trackDetails['byWho']; ?>
											<br>
											<?php if ($totalRows_totalTimes > 0) { // Show if recordset not empty ?>* Played live <font color="#66CCFF"><?php echo $totalRows_totalTimes ?></font> times. <a href="58_performancehistory.php?external_song_id=<?php echo $row_titleDetails['external_song_id']; ?>" class="linkageStuff">[WHERE/WHEN?]</a>
											<?php } // Show if recordset not empty ?>
											<?php if($totalRows_openingtracks>0){ ?><br />* Opened the show <?php echo $totalRows_openingtracks; ?> times.
											<?php } ?>
											<?php if($totalRows_closingTimes >0)
											{
											?><br />* Closed the show <?php echo $totalRows_closingTimes; ?> times.<? }
							?>
                    		<?php if ($totalRows_encoreLead > 0) { // Show if recordset not empty ?>
                    			<br>* Opened first encore <?php echo $totalRows_encoreLead; ?> times.
                   			<?php } ?>
                    		<?php if ($totalRows_encore2Lead > 0) { // Show if recordset not empty ?>
                    			<br>* Opened second encore <?php echo $totalRows_encore2Lead; ?> times
                    		<?php } ?>
                    		<?php if ($totalRows_posVariance > 0) { // Show if recordset empty ?>
                            <br /><font size="1" face="Arial, Helvetica, sans-serif"><br />* Earliest setlist position: #<? echo $row_posVariance['earliestPos']; ?></font>
							<?php  } ?>
							<?php if ($totalRows_posVariance > 0) { // Show if recordset empty ?>
                            <font size="1" face="Arial, Helvetica, sans-serif"><br />* Latest setlist position: #<? echo $row_posVariance['latestPos']; ?></font>
							<?php  } ?>
                    		<?php if ($totalRows_posVariance> 0) { // Show if recordset empty ?>
                            <font size="1" face="Arial, Helvetica, sans-serif"><br />* Average position in setlist: #<? echo round($row_posVariance['avgPos']); ?><!--<br/ > <? echo round($row_posVariance['songDerv']); ?>--></font>
							<?php  } ?>
                            </font>
                            <?php if ($totalRows_totalTimes == 0) { // Show if recordset empty ?>
                            <font size="1" face="Arial, Helvetica, sans-serif">* There is no record of this track being played live.</font><br><br>
					<?php  } ?>
							
                          </td>
                        </tr>
                      </table>
                      <br>
						<img src="images/lifespan_label.gif" width="250" height="27">
                      <table width="360" id="subtleanchor_light" border="0" height="100" bordercolor="#666666">
                        <tr bordercolor="#333333">
                          <td width="50%" valign="top"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif"><b>Earliest listed performance:</b><br>
                                        <br>
                                        <span class="linkageStuff"><a href="showdetails.php?external_show_id=<?php echo urlencode($row_wooHoo['external_show_id']); ?>" class="linkageStuff"><font color="#999999"><?php echo date('l, m/d/Y',strtotime($row_wooHoo['showDate'])); ?></font></a> </span><font color="#999999"><br>
                                        <a href="browse.php?external_venue_id=<?php echo $row_wooHoo['external_venue_id']; ?>" class="linkageStuff"><?php echo $row_wooHoo['venue_name_display']; ?></a><span class="linkageStuff"><br>
                                        <a href="browse.php?external_city_id=<?php echo $row_wooHoo['external_city_id']; ?>" class="linkageStuff"><?php echo $row_wooHoo['city_name_display']; ?></a></span>,<br>
                                        <span class="linkageStuff"><a href="browse.php?external_locale_id=<?php echo $row_wooHoo['external_locale_id']; ?>" class="linkageStuff"><?php echo $row_wooHoo['locale_name_display']; ?></a></span> - <span class="linkageStuff"><?php echo $row_wooHoo['countryName']; ?></span></font></font></td>
                          <td width=50% valign="top"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif"><b>Most recent listed performance:</b><br>
                                        <br>
                                        <span class="linkageStuff"><a href="showdetails.php?external_show_id=<?php echo urlencode($row_hooWoo['external_show_id']); ?>" class="linkageStuff"><font color="#999999"><?php echo date('l, m/d/Y',strtotime($row_hooWoo['showDate'])); ?></font></a> </span><font color="#999999"><br>
                                        <a href="browse.php?external_venue_id=<?php echo $row_hooWoo['external_venue_id']; ?>" class="linkageStuff"><?php echo $row_hooWoo['venue_name_display']; ?></a><span class="linkageStuff"><br>
                                        <a href="browse.php?external_city_id=<?php echo $row_hooWoo['external_city_id']; ?>" class="linkageStuff"><?php echo $row_hooWoo['city_name_display']; ?></a></span>, <br>
                                        <a href="browse.php?external_locale_id=<?php echo $row_hooWoo['external_locale_id']; ?>" class="linkageStuff"><?php echo $row_hooWoo['locale_name_display']; ?></a> - <span class="linkageStuff"><?php echo $row_hooWoo['countryName']; ?></span></font></font></td>
                        </tr>
						
						<tr>
						<td colspan="2"><br><br>
						Normal live lead-ups to <?php echo $row_titleDetails['song_name_display']; ?>:<br>
						<?php do { ?>
						  <a href="songdetails.php?external_song_id=<?php echo $row_commonPreceeders['track2']; ?>">- <?php echo $row_commonPreceeders['song_name_display']; ?></a> (<?php echo round(($row_commonPreceeders['totalNum']/$totalRows_totalTimes)*100); ?>%)<br>
						  <?php } while ($row_commonPreceeders = mysql_fetch_assoc($commonPreceeders)); ?>
						</td>
						</tr>
						
						
						<tr>
						<td colspan="2"><br><br>
						Normal follow-ups to <?php echo $row_titleDetails['song_name_display']; ?>:<br>
						<?php do { ?>
						  <a href="songdetails.php?external_song_id=<?php echo $row_commonFollowers['track2']; ?>">- <?php echo $row_commonFollowers['song_name_display']; ?></a> (<?php echo round(($row_commonFollowers['totalNum']/$totalRows_totalTimes)*100); ?>%)<br>
						  <?php } while ($row_commonFollowers = mysql_fetch_assoc($commonFollowers)); ?>
						</td>
						</tr>
						
                      </table>
                      <?php } // Show if recordset not empty ?>
                      <font size="1" face="Verdana, Arial, Helvetica, sans-serif"><br><br><img src="images/minibar_foundreleases.gif" width="250" height="27"></font><? if($row_itunesLink['itunesLink']!=null)
					  {
					  	echo "<br />".$row_itunesLink['itunesLink']."<br />";
						}?>
                      <?php if ($totalRows_songversion_name_displays > 0) { // Show if recordset not empty ?>
                      <br>
                      <table width="360" bgcolor="#999999" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td align="center"><?php do { ?>
                              <table width="360" border="0" bgcolor="#000000">
                                <tr>
                                  <td width="38" rowspan="2"><img src="http://arc.randomhours.com/userImages/<?php echo $row_songversion_name_displays['location']; ?>" border="0" width="92"></td>
                                  
                                </tr>
                                <tr>

                                  <td>
                                      <h3><a href="58_viewrelease.php?external_release_id=<?php echo $row_songversion_name_displays['external_release_id']; ?>" class="linkageStuff"><?php echo $row_songversion_name_displays['album_name_display']; ?> (<?php echo $row_songversion_name_displays['releaseversion_name_display']; ?>)<br />(<?php echo $row_songversion_name_displays['country_name_display']; ?> release)</a></h3>
                                      <font color="#999999" size="1" face="Arial, Helvetica, sans-serif">[<?php echo $row_songversion_name_displays['songversion_name_display']; ?> version]</font><br>
                                      <font size="1" color="#e3e3e3" face="Arial, Helvetica, sans-serif"><?php echo date('F d, Y',strtotime($row_songversion_name_displays['release_date'])); ?></font></td>
                                </tr>
                              </table>
                              <?php } while ($row_songversion_name_displays = mysql_fetch_assoc($songversion_name_displays)); ?></td>
                        </tr>
                      </table>
                      <br>
                      <?php } // Show if recordset not empty ?>
                      <font face="Arial, Helvetica, sans-serif" size="1"> <em>
                    <?php if ($totalRows_songversion_name_displays == 0) { // Show if recordset empty ?>
                      	<br>Currenly unreleased.
              		<?php } // Show if recordset empty ?>
					</em></font>
					<hr>
                    	<font size="1" face="Arial, Helvetica, sans-serif"><img src="images/minibar_abouttrack.gif" width="250" height="27"><br>
                    	<font color="#CCCCCC"><?php echo $row_trackDetails['notes']; ?></font></font><br><br>
              </td>
                  	<td align="center" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="5">
                      <tr>
                        <td width="400" valign="top">
                        <?php if($totalRows_openingtracks>0) {?>
                            <table width="400" border="0" cellspacing="0" cellpadding="1" align="left">
                         		<tr>
									<td bgcolor="#FFFFFF"><font color="#000000" size="1" face="Arial, Helvetica, sans-serif"><?php echo $row_openingtracks['song_name_display']; ?> has opened the main set <?php echo $totalRows_openingtracks; ?> times.</font></td>
                              	</tr>
                              	<tr>
                                	<td bgcolor="#FFFFFF"><table width="300" border="0" cellspacing="0" cellpadding="0">
                                    	<table width="400" border="0" cellspacing="0" cellpadding="0">
                                      	<?php $recordCounter = 0; ?>
                                      	<?php do { ?><tr<?php $recordCounter=$recordCounter+1;if ($recordCounter % 2 == 1){echo " bgcolor=#333399";} else{echo " bgcolor=#000000";}?>>
												<td height="2" nowrap><font color="#3399CC" size="1" face="Arial, Helvetica, sans-serif"><a href="showdetails.php?external_show_id=<?php echo $row_openingtracks['external_show_id']; ?>" class="linkageStuff"><?php echo $row_openingtracks['showDate']; ?> - <?php echo $row_openingtracks['venue_name_display']; ?> - <?php echo $row_openingtracks['city_name_display']; ?></a></font></td>
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
                          <td bgcolor="#FFFFFF"><font color="#000000" size="1" face="Arial, Helvetica, sans-serif"><?php echo $row_encoreLead['song_name_display']; ?> has opened the first encore <?php echo $totalRows_encoreLead; ?> times.</font></td>
                        </tr>
                        <tr>
                          <td bgcolor="#FFFFFF"><table width="300" border="0" cellspacing="0" cellpadding="0">
                              <table width="400" border="0" cellspacing="0" cellpadding="0">
                                <?php $recordCounter = 0; ?>
                                <?php do { ?>
                                <tr<?php $recordCounter=$recordCounter+1; if ($recordCounter % 2 == 1) {echo " bgcolor=#333399";} else { echo " bgcolor=#000000";} ?>>
                                  <td height="2" nowrap>
                                  <?php if($totalRows_encoreLead>0) {?>
                                  <font color="#3399CC" size="1" face="Arial, Helvetica, sans-serif">
                                    
                                    <a href="showdetails.php?external_show_id=<?php echo $row_encoreLead['external_show_id']; ?>" class="linkageStuff"><?php echo $row_encoreLead['showDate']; ?> - <?php echo $row_encoreLead['venue_name_display']; ?> - <?php echo $row_encoreLead['city_name_display']; ?></a>
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
                    <td bgcolor="#FFFFFF"><font color="#000000" size="1" face="Arial, Helvetica, sans-serif"><?php echo $row_encore2Lead['song_name_display']; ?> has opened the second encore <?php echo $totalRows_encore2Lead; ?> times.</font></td>
                  </tr>
                  <tr>
                    <td bgcolor="#FFFFFF"><table width="300" border="0" cellspacing="0" cellpadding="0">
                        <table width="400" border="0" cellspacing="0" cellpadding="0">
                          <?php $recordCounter = 0; ?>
                          <?php do { ?>
                          <tr<?php $recordCounter=$recordCounter+1; if ($recordCounter % 2 == 1) {echo " bgcolor=#333399";} else { echo " bgcolor=#000000";} ?>>
                            <td height="2" nowrap><font color="#3399CC" size="1" face="Arial, Helvetica, sans-serif">
                              <?php if($totalRows_encore2Lead>0) {?>
                              <a href="showdetails.php?external_show_id=<?php echo $row_encore2Lead['external_show_id']; ?>" class="linkageStuff"><?php echo $row_encore2Lead['showDate']; ?> - <?php echo $row_encore2Lead['venue_name_display']; ?> - <?php echo $row_encore2Lead['city_name_display']; ?></a>
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
</td></tr></table>
</td><td align="center" valign="top" bgcolor="#000000"><a target='new' href="http://click.linksynergy.com/fs-bin/click?id=N2nvjdzFAVU&offerid=146261.10002602&type=4&subid=0"><IMG src="http://images.apple.com/itunesaffiliates/US/2008/01/01/Radiohead_125x125.jpg" alt="Apple iTunes" width="125" height="125" border="0"></a><IMG border="0" width="1" height="1" src="http://ad.linksynergy.com/fs-bin/show?id=N2nvjdzFAVU&bids=146261.10002602&type=4&subid=0"><br/><br/>
  <script type="text/javascript"><!--
google_ad_client = "pub-4681937497066114";
/* 160x600 legacy */
google_ad_slot = "6064828356";
google_ad_width = 160;
google_ad_height = 600;
//-->
</script>
<script type="text/javascript"
src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>

</body>
</html>
<?php

mysql_free_result($openingtracks);

mysql_free_result($encoreLead);

mysql_free_result($encore2Lead);

mysql_free_result($titleDetails);

mysql_free_result($correspondingTitles);

mysql_free_result($trackDetails);

mysql_free_result($hooWoo);

mysql_free_result($wooHoo);

mysql_free_result($songversion_name_displays);

mysql_free_result($allTitles);

mysql_free_result($commonFollowers);

mysql_free_result($otherTitles);

mysql_free_result($totalTimes);
?>

