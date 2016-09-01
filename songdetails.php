<?php 
mb_internal_encoding( 'UTF-8' );
require_once('Connections/random_connect.php');
require_once('_includes/SITEARTIST.php');
require_once('_includes/rhcommon.php');

header( 'Content-Type: text/html; charset=UTF-8' );

if(isset($_GET['trackID']))
{
	// get the corresponding external id
	mysql_select_db($database_random_connect, $random_connect);
	$query_altid = sprintf("SELECT external_song_id FROM rhr_titleresolver WHERE internal_id = %s", GetSQLValueString($_GET['trackID'],"text"));
	$altid = mysql_query($query_altid, $random_connect) or die(mysql_error());
	$row_altid = mysql_fetch_assoc($altid);
	if($row_altid['external_song_id'])
	{
		header("location: /songdetails.php?external_song_id=".$row_altid['external_song_id'], true, 301);
	}
	else header("location: /index.php");
}
else
{
$colname_posVariance = "9999";
if (isset($_GET['external_song_id'])) {
  $colname_posVariance = (get_magic_quotes_gpc()) ? $_GET['external_song_id'] : addslashes($_GET['external_song_id']);
}
mysql_select_db($database_random_connect, $random_connect);
$query_posVariance = sprintf("SELECT AVG(rhr_livetracks.songNumber) AS avgPos, MIN(rhr_livetracks.songNumber) AS earliestPos, MAX(rhr_livetracks.songNumber) AS latestPos, STD(rhr_livetracks.songNumber) AS songDerv 
FROM rhr_titleresolver, rhr_livetracks, rhr_performances 
WHERE rhr_livetracks.external_song_id = %s AND rhr_titleresolver.external_song_id = rhr_livetracks.external_song_id
AND rhr_livetracks.external_show_id = rhr_performances.external_show_id
AND rhr_performances.external_group_id = %s", GetSQLValueString($colname_posVariance,"text"),
GetSQLValueString('681qWLg',"text"));
$posVariance = mysql_query($query_posVariance, $random_connect) or die(mysql_error());
$row_posVariance = mysql_fetch_assoc($posVariance);
$totalRows_posVariance = mysql_num_rows($posVariance);


////////////////////////////

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

$colname_trackDetails = "1";
if (isset($_GET['external_song_id'])) {
  $colname_trackDetails = (get_magic_quotes_gpc()) ? $_GET['external_song_id'] : addslashes($_GET['external_song_id']);
}
mysql_select_db($database_random_connect, $random_connect);
$query_trackDetails = sprintf("SELECT rhr_groupresolver.group_name_display AS songauthor_name_display FROM rhr_titleresolver, rhr_groupresolver WHERE rhr_titleresolver.external_song_id = %s AND rhr_groupresolver.external_group_id = rhr_titleresolver.external_group_id", GetSQLValueString($colname_trackDetails,"text"));
$trackDetails = mysql_query($query_trackDetails, $random_connect) or die(mysql_error());
$row_trackDetails = mysql_fetch_assoc($trackDetails);
$totalRows_trackDetails = mysql_num_rows($trackDetails);



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
AND rhr_titleresolver.external_song_id=%s 
AND rhr_performances.external_group_id = %s 
ORDER BY rhr_performances.showDate DESC LIMIT 1", GetSQLValueString($colname_hooWoo,"text"),
GetSQLValueString('681qWLg',"text"));
$hooWoo = mysql_query($query_hooWoo, $random_connect) or die(mysql_error());
$row_hooWoo = mysql_fetch_assoc($hooWoo);
$totalRows_hooWoo = mysql_num_rows($hooWoo);

$colname_wooHoo = "1";
if (isset($_GET['external_song_id'])) {
  $colname_wooHoo = (get_magic_quotes_gpc()) ? $_GET['external_song_id'] : addslashes($_GET['external_song_id']);
}
mysql_select_db($database_random_connect, $random_connect);
$query_wooHoo = sprintf("SELECT DISTINCT rhr_performances.external_show_id, rhr_venueresolver.external_venue_id, rhr_countryresolver.countryName, rhr_localityresolver.locale_name_display, rhr_localityresolver.external_locale_id, rhr_cityresolver.city_name_display, rhr_cityresolver.external_city_id, rhr_venueresolver.venue_name_display, rhr_performances.showDate FROM rhr_performances,rhr_livetracks, rhr_titleresolver, rhr_cityresolver, rhr_localityresolver, rhr_countryresolver, rhr_venueresolver WHERE rhr_performances.external_show_id = rhr_livetracks.external_show_id  AND rhr_livetracks.external_song_id=rhr_titleresolver.external_song_id AND rhr_performances.external_venue_id = rhr_venueresolver.external_venue_id AND rhr_venueresolver.external_venue_id = rhr_performances.external_venue_id AND rhr_venueresolver.external_city_id = rhr_cityresolver.external_city_id AND rhr_cityresolver.external_locale_id = rhr_localityresolver.external_locale_id AND rhr_localityresolver.external_country_id = rhr_countryresolver.external_country_id 
AND rhr_titleresolver.external_song_id=%s AND rhr_performances.external_group_id = %s ORDER BY rhr_performances.showDate LIMIT 1", GetSQLValueString($colname_wooHoo,"text"),
GetSQLValueString('681qWLg',"text"));
$wooHoo = mysql_query($query_wooHoo, $random_connect) or die(mysql_error());
$row_wooHoo = mysql_fetch_assoc($wooHoo);
$totalRows_wooHoo = mysql_num_rows($wooHoo);

$colname_totalTimes = "1";
if (isset($_GET['external_song_id'])) {
  $colname_totalTimes = (get_magic_quotes_gpc()) ? $_GET['external_song_id'] : addslashes($_GET['external_song_id']);
}
//mysql_select_db($database_random_connect, $random_connect);
$query_totalTimes = sprintf("SELECT DISTINCT rhr_performances.showDate 
FROM rhr_performances,rhr_livetracks, rhr_titleresolver, rhr_cityresolver, rhr_localityresolver, rhr_countryresolver, rhr_venueresolver WHERE rhr_performances.external_show_id = rhr_livetracks.external_show_id  AND rhr_livetracks.external_song_id=rhr_titleresolver.external_song_id AND rhr_venueresolver.external_venue_id = rhr_performances.external_venue_id AND rhr_venueresolver.external_city_id = rhr_cityresolver.external_city_id AND rhr_cityresolver.external_locale_id = rhr_localityresolver.external_locale_id AND rhr_localityresolver.external_country_id = rhr_countryresolver.external_country_id 
AND rhr_titleresolver.external_song_id=%s 
AND rhr_performances.external_group_id = %s 
AND rhr_livetracks.nonstandard_track = '0' 
ORDER BY rhr_performances.showDate", GetSQLValueString($colname_totalTimes,"text"),
GetSQLValueString('681qWLg',"text"));
$totalTimes = mysql_query($query_totalTimes, $random_connect) or die(mysql_error());
$row_totalTimes = mysql_fetch_assoc($totalTimes);
$totalRows_totalTimes = mysql_num_rows($totalTimes);

$query_teaseTimes = sprintf("SELECT DISTINCT rhr_performances.showDate 
FROM rhr_performances,rhr_livetracks, rhr_titleresolver, rhr_cityresolver, rhr_localityresolver, rhr_countryresolver, rhr_venueresolver 
WHERE rhr_performances.external_show_id = rhr_livetracks.external_show_id  
AND rhr_livetracks.external_song_id=rhr_titleresolver.external_song_id 
AND rhr_venueresolver.external_venue_id = rhr_performances.external_venue_id 
AND rhr_venueresolver.external_city_id = rhr_cityresolver.external_city_id 
AND rhr_cityresolver.external_locale_id = rhr_localityresolver.external_locale_id 
AND rhr_localityresolver.external_country_id = rhr_countryresolver.external_country_id 
AND rhr_titleresolver.external_song_id=%s 
AND rhr_performances.external_group_id = %s 
AND rhr_livetracks.nonstandard_track = '1'
ORDER BY rhr_performances.showDate", GetSQLValueString($colname_totalTimes,"text"),
GetSQLValueString('681qWLg',"text"));
$teaseTimes = mysql_query($query_teaseTimes, $random_connect) or die(mysql_error());
$row_teaseTimes = mysql_fetch_assoc($teaseTimes);
$totalRows_teaseTimes = mysql_num_rows($teaseTimes);



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
AND rhr_titleresolver.external_group_id = %s 
GROUP BY track2 
ORDER BY totalNum DESC LIMIT 7", GetSQLValueString($colname_commonFollowers, "text"),
GetSQLValueString('681qWLg',"text"));
$commonFollowers = mysql_query($query_commonFollowers, $random_connect) or die(mysql_error());
$row_commonFollowers = mysql_fetch_assoc($commonFollowers);
$totalRows_commonFollowers = mysql_num_rows($commonFollowers);

$colname_commonPreceeders = "67";
if (isset($_GET['external_song_id'])) {
  $colname_commonPreceeders = (get_magic_quotes_gpc()) ? $_GET['external_song_id'] : addslashes($_GET['external_song_id']);
}
mysql_select_db($database_random_connect, $random_connect);
$query_commonPreceeders = sprintf("SELECT set1.external_song_id, set2.external_song_id AS track2, rhr_titleresolver.song_name_display, count(set2.external_show_id) AS totalNum FROM rhr_livetracks AS set1, rhr_livetracks AS set2, rhr_titleresolver 
WHERE set1.external_song_id = %s AND set1.songNumber = (set2.songNumber + 1) AND set2.external_song_id = rhr_titleresolver.external_song_id AND set1.external_show_id = set2.external_show_id 
AND rhr_titleresolver.external_group_id = %s GROUP BY track2 ORDER BY totalNum DESC LIMIT 7", GetSQLValueString($colname_commonPreceeders, "text"),
GetSQLValueString('681qWLg',"text"));
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
$query_allTitles = sprintf("SELECT * FROM rhr_titleresolver WHERE external_group_id = %s ORDER BY song_name_display ASC",GetSQLValueString($INTERNAL_SITEGROUP,"text"));
$allTitles = mysql_query($query_allTitles, $random_connect) or die(mysql_error());
$row_allTitles = mysql_fetch_assoc($allTitles);
$totalRows_allTitles = mysql_num_rows($allTitles);

$colname_songversion_name_displays = "1";
if (isset($_GET['external_song_id'])) {
  $colname_songversion_name_displays = (get_magic_quotes_gpc()) ? $_GET['external_song_id'] : addslashes($_GET['external_song_id']);
}
mysql_select_db($database_random_connect, $random_connect);
$query_songversion_name_displays = sprintf("SELECT 
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
AND rhr_releaseresolver.external_group_id = %s
GROUP BY rhr_albumresolver.external_album_id 
ORDER BY rhr_releaseresolver.release_date DESC", GetSQLValueString($colname_songversion_name_displays,"text"),
GetSQLValueString('681qWLg',"text"));
$songversion_name_displays = mysql_query($query_songversion_name_displays, $random_connect) or die(mysql_error());
$row_songversion_name_displays = mysql_fetch_assoc($songversion_name_displays);
$totalRows_songversion_name_displays = mysql_num_rows($songversion_name_displays);



?>
<html>
<head>
<title>&quot;<?php echo $row_titleDetails['song_name_display']; ?>&quot; details at randomhours. a gig database</title>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
<link rel="stylesheet" href="css/styles.css" type="text/css">

<script language="JavaScript">
function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}
</script>
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script language="javascript" type="text/javascript" src="js/jquery.jqplot.min.js"></script>
<script type="text/javascript" src="js/plugins/jqplot.highlighter.min.js"></script>
<script type="text/javascript" src="js/plugins/jqplot.cursor.min.js"></script>
<link rel="stylesheet" type="text/css" href="js/jquery.jqplot.css" />

<link href="css/stylebook.css" rel="stylesheet" type="text/css">
<style type="text/css"> 
body 
{ 
background-image: url('images/bgstripes.gif'); 
}

#chartDiv {
	height: 100px;
	width: 800px;
}

.jqplot-highlighter-tooltip {
	color: #fff;
	background-color: #000
}
</style>
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
										<div class="songname_header"><? echo $row_titleDetails['song_name_display']; ?></div>
										
									</td>
								</tr>
								<tr>
									<td colspan="2" valign="top"><?php if ($totalRows_wooHoo > 0) { // Show if recordset not empty ?>
										<br>
										<script type="text/javascript">
//AC_FL_RunContent( 'codebase','http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0','width','800','height','100','src','flash_elements/newSpectrum','quality','high','pluginspage','http://www.macromedia.com/go/getflashplayer','flashvars','<?php 
				$jqChartPlotArr = array();
				$cYear = -1;
				 foreach($yearBreakdown as $key => $value)
				 {
				 	if($cYear==-1) $cYear = $key;
				 	else if($cYear != $key) {
				 		while($cYear != $key) {
				 			
				 			array_push($jqChartPlotArr, array($cYear,0));
							$cYear++;
				 		}
				 	}
				 	array_push($jqChartPlotArr, array($key,$value));
					 echo "y".$key."=".$value."&";
					 $cYear++;
				 }
				 ?>','bgcolor','#000000','movie','flash_elements/newSpectrum' ); //end AC code
</script><noscript><!--<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0" width="800" height="100">
                        <param name="movie" value="flash_elements/newSpectrum.swf">
                        <param name="quality" value="high">
						<param name="flashVars" value="<?php 
				 foreach($yearBreakdown as $key => $value)
				 {
					 echo "y".$key."=".$value."&";
				 }
				 ?>" bgcolor="#000000"></embed>
										</object>--></noscript>
										<div id="chartDiv">
										
										</div>
										<script>
										var chartData = [];
										chartData.push(<? echo json_encode($jqChartPlotArr); ?>);
										$.jqplot('chartDiv',  chartData, { axes:{yaxis:{min:0}},
										grid:{
											background:'#000000',
											gridLineColor:'#333333',
											borderColor: '#000000'
										},
										seriesColors:['#ffcc00'],
										seriesDefaults: {
											showMarker: false
										},
										axesDefaults:{
											showTickMarks: false
										},
									    highlighter: {
											show: true,
											sizeAdjust: 7.5,
											tooltipAxes: 'y',
											useAxesFormatters: false,
											tooltipFormatString: '%.0f'
										},
										cursor: {
											show: false
										}
										});
										</script>
										<br/><br/><br/>
										<?php } // Show if recordset empty ?>
									</td>
								</tr>
								<tr>
                  					<td width="360" valign="top">
				  						<br />
										<img src="images/summary_label.gif" width="250" height="27"><?php if ($totalRows_wooHoo > 0) { // Show if recordset not empty ?>
										<table width="360" id="subtleanchor_light" border="0" cellpadding="0" cellspacing="0" bordercolor="#CCCCCC">
										<tr>
											<td bordercolor="#CCCCCC"><div class="small_title">Originally performed by:&nbsp;<?php echo $row_trackDetails['songauthor_name_display']; ?></div>
											<br>
											<?php if ($totalRows_totalTimes > 0) { // Show if recordset not empty ?>* Played live (in full) <font color="#66CCFF"><?php echo $totalRows_totalTimes ?></font> times. <a href="58_performancehistory.php?external_song_id=<?php echo $row_titleDetails['external_song_id']; ?>" class="linkageStuff">[WHERE/WHEN?]</a><br />
											* Teased live <font color="#66CCFF"><?php echo $totalRows_teaseTimes ?></font> times. <br />
											
											<?php } // Show if recordset not empty ?>
											<?php if($totalRows_openingtracks>0){ ?><br />* Opened the show <?php echo $totalRows_openingtracks; ?> times.
											<?php } 
											 if ($totalRows_posVariance > 0) { // Show if recordset empty ?>
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
                          <td width="50%" valign="top"><div class="small_title">Earliest listed performance:</div>
                          <span class="linkageStuff"><a href="showdetails.php?external_show_id=<?php echo urlencode($row_wooHoo['external_show_id']); ?>" class="linkageStuff"><font color="#999999"><?php echo date('l, m/d/Y',strtotime($row_wooHoo['showDate'])); ?></font></a> </span><font color="#999999"><br>
                                        <a href="browse.php?external_venue_id=<?php echo $row_wooHoo['external_venue_id']; ?>" class="linkageStuff"><?php echo $row_wooHoo['venue_name_display']; ?></a><span class="linkageStuff"><br>
                                        <a href="browse.php?external_city_id=<?php echo $row_wooHoo['external_city_id']; ?>" class="linkageStuff"><?php echo $row_wooHoo['city_name_display']; ?></a></span>,<br>
                                        <span class="linkageStuff"><a href="browse.php?external_locale_id=<?php echo $row_wooHoo['external_locale_id']; ?>" class="linkageStuff"><?php echo $row_wooHoo['locale_name_display']; ?></a></span> - <span class="linkageStuff"><?php echo $row_wooHoo['countryName']; ?></span></font></font></td>
                          <td width=50% valign="top"><span class="small_title">Most recent listed performance:</span>
                          <br /><span class="linkageStuff"><a href="showdetails.php?external_show_id=<?php echo urlencode($row_hooWoo['external_show_id']); ?>" class="linkageStuff"><font color="#999999"><?php 
                                        date_default_timezone_set ("America/New_York");
                    	  				echo date('l, m/d/Y',strtotime($row_hooWoo['showDate'])); ?></font></a> </span><font color="#999999"><br>
                                        <a href="browse.php?external_venue_id=<?php echo $row_hooWoo['external_venue_id']; ?>" class="linkageStuff"><?php echo $row_hooWoo['venue_name_display']; ?></a><span class="linkageStuff"><br>
                                        <a href="browse.php?external_city_id=<?php echo $row_hooWoo['external_city_id']; ?>" class="linkageStuff"><?php echo $row_hooWoo['city_name_display']; ?></a></span>, <br>
                                        <a href="browse.php?external_locale_id=<?php echo $row_hooWoo['external_locale_id']; ?>" class="linkageStuff"><?php echo $row_hooWoo['locale_name_display']; ?></a> - <span class="linkageStuff"><?php echo $row_hooWoo['countryName']; ?></span></font></font></td>
                        </tr>
						
						<tr>
						<td colspan="2"><br><br>
						<div class="small_title">Normal live lead-ups to this song:</div><br>
						<?php do { ?>
						  <a href="songdetails.php?external_song_id=<?php echo $row_commonPreceeders['track2']; ?>">- <?php echo $row_commonPreceeders['song_name_display']; ?></a> (<?php echo round(($row_commonPreceeders['totalNum']/$totalRows_totalTimes)*100); ?>%)<br>
						  <?php } while ($row_commonPreceeders = mysql_fetch_assoc($commonPreceeders)); ?>
						</td>
						</tr>
						
						
						<tr>
						<td colspan="2"><br><br>
						<div class="small_title">Normal follow-ups to this song:</div><br>
						<?php do { ?>
						  <a href="songdetails.php?external_song_id=<?php echo $row_commonFollowers['track2']; ?>">- <?php echo $row_commonFollowers['song_name_display']; ?></a> (<?php echo round(($row_commonFollowers['totalNum']/$totalRows_totalTimes)*100); ?>%)<br>
						  <?php } while ($row_commonFollowers = mysql_fetch_assoc($commonFollowers)); ?>
						</td>
						</tr>
						
                      </table>
                      <?php } // Show if recordset not empty ?>
                      <font size="1" face="Verdana, Arial, Helvetica, sans-serif"><br><br><img src="images/minibar_foundreleases.gif" width="250" height="27"></font>
                      
                      <font face="Arial, Helvetica, sans-serif" size="1"> <em>
                    <?php if ($totalRows_songversion_name_displays == 0) { // Show if recordset empty ?>
                      	<br>Currently unreleased.
              		<?php } // Show if recordset empty
              		else{ 
              		do{?>
              		<table width="200" border="0" cellpadding="5" class="linkageStuff">
              		<tr>
              		<td width ="92">
              		<img src="http://media.randomhours.com/img/<? echo $row_songversion_name_displays['location']; ?>" width="92">
              		</td>
              		<td valign="top">
              		<a href="releasedetails.php?external_release_id=<? echo $row_songversion_name_displays['external_release_id']; ?>"><? echo $row_songversion_name_displays['album_name_display']; ?></a> <? if($row_songversion_name_displays['releaseversion_name_display']!="standard")
              		{
              		echo "(".$row_songversion_name_displays['releaseversion_name_display'].")"; 
              		} ?>
              		</td>
              		</tr>
              		</table><br />
              		<? }while($row_songversion_name_displays = mysql_fetch_assoc($songversion_name_displays));
              		}
              		?>
					</em></font>
					<hr>
                    	<font size="1" face="Arial, Helvetica, sans-serif"><img src="images/minibar_abouttrack.gif" width="250" height="27"><br></font><br><br>
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
                <br />
                </td>
                </tr>
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
</td><td align="center" valign="top" bgcolor="#000000"><IMG border="0" width="1" height="1" src="http://ad.linksynergy.com/fs-bin/show?id=N2nvjdzFAVU&bids=146261.10002602&type=4&subid=0"><br/><br/>
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

mysql_free_result($titleDetails);

mysql_free_result($trackDetails);

mysql_free_result($hooWoo);

mysql_free_result($wooHoo);

mysql_free_result($allTitles);

mysql_free_result($commonFollowers);

mysql_free_result($totalTimes);
}
?>

