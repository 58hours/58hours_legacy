<?php 
require_once($_SERVER['DOCUMENT_ROOT'].'/Connections/random_connect.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/_includes/SITEARTIST.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/_includes/rhcommon.php');


$query_mostRecentShow = sprintf("SELECT rhr_performances.external_show_id as external_show_id, rhr_performances.showDate as showDate, rhr_venueresolver.venue_name_display as showVenue, rhr_cityresolver.city_name_display as showCity, rhr_localityresolver.locale_name_display as showLocality, rhr_countryresolver.country_name_display as showCountry 
FROM rhr_performances, rhr_cityresolver, rhr_localityresolver, rhr_countryresolver, rhr_venueresolver WHERE rhr_performances.showactive = '1' 
AND rhr_venueresolver.external_venue_id = rhr_performances.external_venue_id 
AND rhr_venueresolver.external_city_id = rhr_cityresolver.external_city_id 
AND rhr_cityresolver.external_locale_id = rhr_localityresolver.external_locale_id 
AND rhr_localityresolver.external_country_id = rhr_countryresolver.external_country_id 
AND rhr_performances.external_group_id = %s 
ORDER BY showDate DESC LIMIT 1", GetSQLValueString($INTERNAL_SITEGROUP,"text"));
$mostRecentShow = mysql_query($query_mostRecentShow, $random_connect) or die(mysql_error());
$row_mostRecentShow = mysql_fetch_assoc($mostRecentShow);
$totalRows_mostRecentShow = mysql_num_rows($mostRecentShow);

if(($_GET['browse']=='songTitle')||(strlen($_GET['browse'])<1))
{
$colname_availableTracks = "songTitle";
if (isset($_GET['browse'])) {
  $colname_availableTracks = (get_magic_quotes_gpc()) ? $_GET['browse'] : addslashes($_GET['browse']);
}
mysql_select_db($database_random_connect, $random_connect);
$query_availableTracks = sprintf("SELECT external_song_id, song_name_display FROM rhr_titleresolver WHERE rhr_titleresolver.external_group_id = %s AND %s ='songTitle' ORDER BY song_name_display ASC", GetSQLValueString($INTERNAL_SITEGROUP,"text"), GetSQLValueString($colname_availableTracks,"text"));
$availableTracks = mysql_query($query_availableTracks, $random_connect) or die(mysql_error());
$row_availableTracks = mysql_fetch_assoc($availableTracks);
$totalRows_availableTracks = mysql_num_rows($availableTracks);
}

if($_GET['browse']=='showVenue')
{
$colname_availableVenues = "1";
if (isset($_GET['browse'])) {
  $colname_availableVenues = (get_magic_quotes_gpc()) ? $_GET['browse'] : addslashes($_GET['browse']);
}
mysql_select_db($database_random_connect, $random_connect);

$query_availableVenues = sprintf("(SELECT DISTINCT rhr_venueresolver.external_venue_id AS external_venue_id, rhr_venueresolver.venue_name_display AS venue_name_display, rhr_cityresolver.city_name_display 
FROM rhr_venueresolver, rhr_performances, rhr_cityresolver, rhr_localityresolver 
WHERE rhr_cityresolver.external_locale_id = rhr_localityresolver.external_locale_id 
AND rhr_venueresolver.external_city_id = rhr_cityresolver.external_city_id 
AND rhr_performances.external_venue_id = rhr_venueresolver.external_venue_id 
AND rhr_performances.external_group_id = %s 
AND %s = 'showVenue')
UNION
(SELECT DISTINCT rhr_alternatevenuenames.alt_external_venue_id AS external_venue_id, rhr_alternatevenuenames.venue_name_display AS venue_name_display, rhr_cityresolver.city_name_display 
FROM rhr_performances, rhr_alternatevenuenames, rhr_cityresolver, rhr_localityresolver, rhr_venueresolver  
WHERE rhr_cityresolver.external_locale_id = rhr_localityresolver.external_locale_id 
AND rhr_venueresolver.external_city_id = rhr_cityresolver.external_city_id 
AND rhr_performances.external_venue_id = rhr_alternatevenuenames.primary_external_venue_id 
AND rhr_alternatevenuenames.primary_external_venue_id = rhr_venueresolver.external_venue_id 
AND rhr_performances.external_group_id = %s 
AND %s = 'showVenue') 
ORDER BY venue_name_display", GetSQLValueString($INTERNAL_SITEGROUP,"text"), GetSQLValueString($colname_availableVenues,"text"),
GetSQLValueString($INTERNAL_SITEGROUP,"text"), GetSQLValueString($colname_availableVenues,"text"));
$availableVenues = mysql_query($query_availableVenues, $random_connect) or die(mysql_error());
$row_availableVenues = mysql_fetch_assoc($availableVenues);
$totalRows_availableVenues = mysql_num_rows($availableVenues);
}


if($_GET['browse']=='showDate')
{
$colname_availableDates = "showDate";
if (isset($_GET['browse'])) {
  $colname_availableDates = (get_magic_quotes_gpc()) ? $_GET['browse'] : addslashes($_GET['browse']);
}
mysql_select_db($database_random_connect, $random_connect);
$query_availableDates = sprintf("SELECT rhr_performances.external_show_id, rhr_performances.external_venue_id, rhr_performances.showDate, rhr_groupresolver.group_name_display 
FROM rhr_performances, rhr_groupresolver 
WHERE rhr_performances.external_group_id = %s 
AND %s = 'showDate' 
AND rhr_groupresolver.external_group_id = rhr_performances.external_group_id 
ORDER BY rhr_performances.showDate DESC", GetSQLValueString($INTERNAL_SITEGROUP,"text"), GetSQLValueString($colname_availableDates,"text"));
$availableDates = mysql_query($query_availableDates, $random_connect) or die(mysql_error());
$row_availableDates = mysql_fetch_assoc($availableDates);
$totalRows_availableDates = mysql_num_rows($availableDates);
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>58hours.com: c'mon.. say it with me.. "god, I'm such a Radiohead whore." There. Feel better?</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta http-equiv="expires" content="0" />
<meta name="robots" content="index, follow" />
<meta name="author" content="Brian Kiel" />
<meta name="publisher" content="Invalid Sequence Labs" />
<meta name="copyright" content="brian kiel" />
<meta name="page-topic" content="<? echo $INTERNAL_SITEGROUPNAME; ?> setlists" />
<meta name="description" content="The <? echo $INTERNAL_SITEGROUPNAME; ?>-devoted section of randomhours.com, an organized database of band setlists" />
<meta name="keywords" content="<? echo $INTERNAL_SITEGROUPNAME; ?>, setlists, <? echo $INTERNAL_SITEGROUPNAME; ?> setlists" />
<meta name = "viewport" content = "width = 400">
<link href="css/styles.css" rel="stylesheet" type="text/css" />
<style type="text/css"> 
body 
{ 
background-image: url('images/bgstripes.gif'); 
} 
</style>

<script language="JavaScript" type="text/javascript">
<!--

function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}
//-->
</script>
<script type="text/javascript">
<!--
function MM_goToURL() { //v3.0
  var i, args=MM_goToURL.arguments; document.MM_returnValue = false;
  for (i=0; i<(args.length-1); i+=2) eval(args[i]+".location='"+args[i+1]+"'");
}
//-->
</script>
<script type="text/javascript" src="js/swfobject.js"></script>
</head>
<body bgcolor="#000000" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<div id="index_wrapper">
<div id="index_content" align="center">
  <img src="/i/promoheader_081102.jpg" alt="58hours - a Radiohead gig database" name="nextShow" width="800" height="280" border="0" id="nextShow"><br />
        <div id="currentFlashStats">Chock Full of Radiohead Setlist Goodness</div>
		<script type="text/javascript">
		var so = new SWFObject("flashStats.swf", "flashstats", "800", "20", "7");
		so.addParam("quality", "high");
		so.write("currentFlashStats");
	</script>
	<div id="browse_selector_area">
	<img src="images/58_mainBrowse.gif" alt="Browse Database" width="200" height="22" />
	
                        <form name="browseType" id="browseType" method="get" action="songdetails.php">
                          <input name="selectGroup" type="radio" class="mainBodyText" onclick="MM_goToURL('parent','index.php?browse=songTitle');return document.MM_returnValue" value="songTitle" <?php if (!(strcmp($_GET['browse'],"songTitle"))) {
						  echo "CHECKED";
						  }
						  elseif(empty($_GET['browse'])){echo "CHECKED";} ?> />
                            song title&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <input name="selectGroup" type="radio" class="mainBodyText" onclick="MM_goToURL('parent','index.php?browse=showDate');return document.MM_returnValue" value="showDate" <?php if (!(strcmp($_GET['browse'],"showDate"))) {echo "CHECKED";} ?> />
                            show date&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <input name="selectGroup"
                            type="radio" class="mainBodyText" onclick="MM_goToURL('parent','index.php?browse=showVenue');return document.MM_returnValue" value="showVenue" <?php if (!(strcmp($_GET['browse'],"showVenue"))) {echo "CHECKED";} ?> />
                            show venue
                        </form>
                      <?php if ($totalRows_availableDates > 0) { // Show if recordset not empty ?>
                        <form name="browseByVenue" id="browseByVenue" method="get" action="showdetails.php?external_show_id=<?php echo $row_availableDates['external_show_id']; ?>">
                          <select name="external_show_id" class="mainBodyText" id="external_show_id">
                            <?php do {  ?>
                            <option value="<?php echo $row_availableDates['external_show_id']?>"><?php 
                            date_default_timezone_set ("America/New_York");
                            echo date('m/d/Y',strtotime($row_availableDates['showDate']));
                            ?></option>
                            <?php } while ($row_availableDates = mysql_fetch_assoc($availableDates));

  $rows = mysql_num_rows($availableDates);
  if($rows > 0) {
      mysql_data_seek($availableDates, 0);
	  $row_availableDates = mysql_fetch_assoc($availableDates);
  } ?>
                          </select>
                          <input type="submit" class="mainBodyText" value="Lookup date!" />
                        </form>
                      <?php } // Show if recordset not empty ?>
                        <?php if ($totalRows_availableVenues > 0) { // Show if recordset not empty ?>
                        <form name="browseByVenue" id="browseByVenue" method="get" action="browse.php?external_venue_id=<?php echo $row_availableVenues['external_venue_id']; ?>">
                          <select name="external_venue_id" class="mainBodyText" id="external_venue_id">
                            <?php do {  ?>
                            <option value="<?php echo $row_availableVenues['external_venue_id']?>"><?php echo $row_availableVenues['venue_name_display']?> (<?php echo $row_availableVenues['city_name_display']?>)</option>
                            <?php
} while ($row_availableVenues = mysql_fetch_assoc($availableVenues));
  $rows = mysql_num_rows($availableVenues);
  if($rows > 0) {
      mysql_data_seek($availableVenues, 0);
	  $row_availableVenues = mysql_fetch_assoc($availableVenues);
  } ?>
                          </select>
                          <input type="submit" class="mainBodyText" value="Lookup venue!" />
                        </form>
                      <?php } // Show if recordset not empty ?>
                        <?php if ($totalRows_availableTracks > 0) { // Show if recordset not empty ?>
                        <form name="browseByTrack" id="browseByTrack" method="get" action="songdetails.php">
                          <select name="external_song_id" class="mainBodyText" id="external_song_id">
                            <?php do {  ?>
                            <option value="<?php echo $row_availableTracks['external_song_id']?>"><?php echo $row_availableTracks['song_name_display']?></option>
                            <?php } while ($row_availableTracks = mysql_fetch_assoc($availableTracks));
  $rows = mysql_num_rows($availableTracks);
  if($rows > 0) {
      mysql_data_seek($availableTracks, 0);
	  $row_availableTracks = mysql_fetch_assoc($availableTracks);

  }
?>
                          </select>
                          <input type="submit" class="mainBodyText" value="Lookup song!" />
                        </form>
                          <br />
                        <br />
                        <?php } // Show if recordset not empty ?>
                        
               </div><div id="tour_details_link_area"><a href="http://58hours.com/tour_details.php?tour=EU4P6b4iwqdCTuTH">Details for the current tour</a> (King of Limbs - North America, Leg 1)</div>
                      <hr>
                      <div id="radioheadtweet" class="index_left_column"></div>
		<script type="text/javascript">
		var so = new SWFObject("livefeed_cs3.swf", "livefeed", "570", "240", "7");
		so.addParam("quality", "high");
		so.write("radioheadtweet");
	</script>
	<div class="index_right_column">
	<img src="images/58_mainMostRecent.gif" alt="Most Recent Show" width="200" height="22" />
                          <p><?php 
                          date_default_timezone_set ("America/New_York");
                          echo date('l, m/d/Y',strtotime($row_mostRecentShow['showDate'])); ?><br />
                              <?php echo $row_mostRecentShow['showVenue']; ?><br />
                              <?php echo $row_mostRecentShow['showCity']; ?>, <?php echo $row_mostRecentShow['showLocality']; ?> - <?php echo $row_mostRecentShow['showCountry']; ?> <br />
                            <a href="showdetails.php?external_show_id=<?php echo $row_mostRecentShow['external_show_id']; ?>">[VIEW SHOW DETAILS]</a> <br />
                          </p>
                    <?php require_once('loginModule_flash.php'); ?>
                        </p>
         </div>             
        <?php require_once('58ss_includes/58disclaimer.php'); ?>
        
  <script type="text/javascript"><!--
google_ad_client = "pub-4681937497066114";
/* 160x600 - homepage */
google_ad_slot = "1134531226";
google_ad_width = 160;
google_ad_height = 600;
//-->
</script>
<script type="text/javascript"
src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>
<br />
<a href="http://www4.clustrmaps.com/counter/maps.php?url=http://58hours.com" id="clustrMapsLink"><img src="http://www4.clustrmaps.com/counter/index2.php?url=http://58hours.com" style="border:0px;" alt="Locations of visitors to this page" title="Locations of visitors to this page" id="clustrMapsImg" />
</a>
<script type="text/javascript">
function cantload() {
img = document.getElementById("clustrMapsImg");
img.onerror = null;
img.src = "http://www2.clustrmaps.com/images/clustrmaps-back-soon.jpg";
document.getElementById("clustrMapsLink").href = "http://www2.clustrmaps.com";
}
img = document.getElementById("clustrMapsImg");
img.onerror = cantload;
</script>
<? //echo $totalRows_availableAds0; ?>
  
</div>
<map name="mainimg_map" id="mainimg_map">
<area shape="rect" coords="1,331,422,360" href="http://www.adobe.com/products/flashlite/" target="_blank" alt="Get the Adobe Flash Lite 2 player" />
</map>
</div>
</body>
</html>
<?php
mysql_free_result($mostRecentShow);

mysql_free_result($availableTracks);

mysql_free_result($availableVenues);

mysql_free_result($availableDates);
?>

