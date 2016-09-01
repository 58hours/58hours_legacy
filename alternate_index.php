<?php require_once('Connections/radioRecords.php'); ?>
<?php
if($_SERVER['REMOTE_ADDR']=="69.181.127.193") die;
mysql_select_db($database_radioRecords, $radioRecords);
//$query_mostRecentShow = "SELECT showID, showDate, showVenue, showCity, showLocality, showCountry FROM showlist_db ORDER BY showDate DESC";
$query_mostRecentShow = "SELECT showlist_db.showID as showID, showlist_db.showDate as showDate, venuedetails.venueName as showVenue, cityresolver.cityName as showCity, localityresolver.localityName as showLocality, countryresolver.countryName as showCountry FROM showlist_db, cityresolver, localityresolver, countryresolver, venuedetails WHERE showlist_db.showactive = '1' AND venuedetails.venueID = showlist_db.showVenueID AND venuedetails.venueCity = cityresolver.cityID AND cityresolver.localityID = localityresolver.localityID AND localityresolver.countryID = countryresolver.countryID ORDER BY showDate DESC LIMIT 1";
$mostRecentShow = mysql_query($query_mostRecentShow, $radioRecords) or die(mysql_error());
$row_mostRecentShow = mysql_fetch_assoc($mostRecentShow);
$totalRows_mostRecentShow = mysql_num_rows($mostRecentShow);


$colname_availableTracks = "songTitle";
if (isset($_GET['browse'])) {
  $colname_availableTracks = (get_magic_quotes_gpc()) ? $_GET['browse'] : addslashes($_GET['browse']);
}
mysql_select_db($database_radioRecords, $radioRecords);
$query_availableTracks = sprintf("SELECT trackID, trackTitle FROM titleresolver WHERE '%s' ='songTitle' ORDER BY trackTitle ASC", $colname_availableTracks);
$availableTracks = mysql_query($query_availableTracks, $radioRecords) or die(mysql_error());
$row_availableTracks = mysql_fetch_assoc($availableTracks);
$totalRows_availableTracks = mysql_num_rows($availableTracks);


$query_availableAds0 = "SELECT code FROM adqueue WHERE (adqueue.group='1' OR adqueue.group='9') AND active = '1' AND height = '125' AND width = '125' ORDER BY id";
$availableAds0 = mysql_query($query_availableAds0, $radioRecords) or die(mysql_error());
$row_availableAds0 = mysql_fetch_assoc($availableAds0);
$totalRows_availableAds0 = mysql_num_rows($availableAds0);

$colname_availableVenues = "1";
if (isset($_GET['browse'])) {
  $colname_availableVenues = (get_magic_quotes_gpc()) ? $_GET['browse'] : addslashes($_GET['browse']);
}
mysql_select_db($database_radioRecords, $radioRecords);

$query_availableVenues = "(SELECT DISTINCT venuedetails.venueID AS venueID, venuedetails.venueName AS venueName, cityresolver.cityName 
FROM venuedetails, showlist_db, cityresolver, localityresolver 
WHERE cityresolver.localityID = localityresolver.localityID AND venuedetails.venueCity = cityresolver.cityID AND showlist_db.showVenueID = venuedetails.venueID)
UNION
(SELECT DISTINCT alternatevenuenames.venueID AS venueID, alternatevenuenames.venueName AS venueName, cityresolver.cityName 
FROM showlist_db, alternatevenuenames, cityresolver, localityresolver, venuedetails  
WHERE cityresolver.localityID = localityresolver.localityID AND venuedetails.venueCity = cityresolver.cityID AND showlist_db.showVenueID = alternatevenuenames.venueID AND alternatevenuenames.venueID = venuedetails.venueID)
ORDER BY venueName";
$availableVenues = mysql_query($query_availableVenues, $radioRecords) or die(mysql_error());
$row_availableVenues = mysql_fetch_assoc($availableVenues);
$totalRows_availableVenues = mysql_num_rows($availableVenues);





$colname_availableDates = "showDate";
if (isset($_GET['browse'])) {
  $colname_availableDates = (get_magic_quotes_gpc()) ? $_GET['browse'] : addslashes($_GET['browse']);
}
mysql_select_db($database_radioRecords, $radioRecords);
$query_availableDates = sprintf("SELECT showID, showVenueID, showDate FROM showlist_db WHERE '%s' = 'showDate' ORDER BY showDate DESC", $colname_availableTracks);
$availableDates = mysql_query($query_availableDates, $radioRecords) or die(mysql_error());
$row_availableDates = mysql_fetch_assoc($availableDates);
$totalRows_availableDates = mysql_num_rows($availableDates);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>58hours.com: c'mon.. say it with me.. "god, I'm such a Radiohead whore." There. Feel better?</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta http-equiv="expires" content="0" />
	<meta name="robots" content="index, follow" />
	<meta name="author" content="Brian Kiel" />
	<meta name="publisher" content="Invalid Sequence Labs" />
	<meta name="copyright" content="brian kiel" />
	<meta name="page-topic" content="Radiohead setlists" />
	<meta name="description" content="58hours is an organized database of live radiohead shows and performances with setlist information available" />
	<meta name="keywords" content="radiohead, setlists, radiohead setlists" />


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
<br /><table width="980" border="0" align="center" cellpadding="0" cellspacing="0">
<tr><td valign="top"><div align="center">
  <table width="800" border="0" cellpadding="0" cellspacing="0">
    <tr> 
      <td align="center" bgcolor="#FFFFFF"><img src="/i/promoheader_081001.jpg" alt="Following Radiohead's 2008 North American Tour" name="nextShow" width="800" height="280" border="0" id="nextShow"><br />
        <div id="currentFlashStats">Chock Full of Radiohead Setlist Goodness</div>
		<script type="text/javascript">
		var so = new SWFObject("flashStats.swf", "flashstats", "800", "20", "7");
		so.addParam("quality", "high");
		so.write("currentFlashStats");
	</script>
	  
	 </td>
    </tr>
    <tr> 
      <td bgcolor="#FFFFFF"><font color="#999999">&nbsp; </font>
        <table width="800" border="0" cellspacing="0" cellpadding="5" valign="top">
          <tr>
            <td>
            <table width="100%"  border="0" cellpadding="1" cellspacing="0" valign="top">
              <tr>
                <td width="75%" valign="top"><table width="90%" border="0" cellspacing="0" cellpadding="2" valign="top">
                  <tr valign="top">
                    <td width="500" align="left" valign="top" bgcolor="#FFFFFF"><img src="/images/pixelshim.gif" alt="shim" width="585" height="1" /><font size="1" face="Arial, Helvetica, sans-serif"><img src="images/58_mainBrowse.gif" alt="Browse Database" width="200" height="22" /><br />
                      </font>
                        <form name="browseType" id="browseType" method="get" action="58_trackDetails.php">
                          <font size="1" face="Arial, Helvetica, sans-serif"> <span class="mainBodyText">
                          <input name="selectGroup" type="radio" class="mainBodyText" onclick="MM_goToURL('parent','index.php?browse=songTitle');return document.MM_returnValue" value="songTitle" <?php if (!(strcmp($_GET['browse'],"songTitle"))) {
						  echo "CHECKED";
						  }
						  elseif(empty($_GET['browse'])){echo "CHECKED";} ?> />
                            song title&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <input name="selectGroup" type="radio" class="mainBodyText" onclick="MM_goToURL('parent','index.php?browse=showDate');return document.MM_returnValue" value="showDate" <?php if (!(strcmp($_GET['browse'],"showDate"))) {echo "CHECKED";} ?> />
                            show date&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <input name="selectGroup" type="radio" class="mainBodyText" onclick="MM_goToURL('parent','index.php?browse=showVenue');return document.MM_returnValue" value="showVenue" <?php if (!(strcmp($_GET['browse'],"showVenue"))) {echo "CHECKED";} ?> />
                            show venue</span></font>
                        </form>
                      <?php if ($totalRows_availableDates > 0) { // Show if recordset not empty ?>
                        <form name="browseByVenue" id="browseByVenue" method="get" action="58_displayshow.php?showID=<?php echo $row_availableDates['showID']; ?>">
                          <span class="mainBodyText">
                          <select name="showID" class="mainBodyText" id="showID">
                            <?php do {  ?>
                            <option value="<?php echo $row_availableDates['showID']?>"><?php echo date('m/d/Y',strtotime($row_availableDates['showDate']));?></option>
                            <?php } while ($row_availableDates = mysql_fetch_assoc($availableDates));

  $rows = mysql_num_rows($availableDates);
  if($rows > 0) {
      mysql_data_seek($availableDates, 0);
	  $row_availableDates = mysql_fetch_assoc($availableDates);
  } ?>
                          </select>
                          <input type="submit" class="mainBodyText" value="Lookup date!" />
                          </span>
                        </form>
                      <?php } // Show if recordset not empty ?>
                        <?php if ($totalRows_availableVenues > 0) { // Show if recordset not empty ?>
                        <form name="browseByVenue" id="browseByVenue" method="get" action="58_groupinglist.php?venueID=<?php echo $row_availableVenues['venueID']; ?>">
                          <span class="mainBodyText">
                          <select name="venueID" class="mainBodyText" id="venueID">
                            <?php do {  ?>
                            <option value="<?php echo $row_availableVenues['venueID']?>"><?php echo $row_availableVenues['venueName']?> (<?php echo $row_availableVenues['cityName']?>)</option>
                            <?php
} while ($row_availableVenues = mysql_fetch_assoc($availableVenues));
  $rows = mysql_num_rows($availableVenues);
  if($rows > 0) {
      mysql_data_seek($availableVenues, 0);
	  $row_availableVenues = mysql_fetch_assoc($availableVenues);
  } ?>
                          </select>
                          <input type="submit" class="mainBodyText" value="Lookup venue!" />
                          </span>
                        </form>
                      <?php } // Show if recordset not empty ?>
                        <span class="mainBodyText">
                        <?php if ($totalRows_availableTracks > 0) { // Show if recordset not empty ?>
                        <form name="browseByTrack" id="browseByTrack" method="get" action="58_trackDetails.php">
                          <select name="trackID" class="mainBodyText" id="trackID">
                            <?php do {  ?>
                            <option value="<?php echo $row_availableTracks['trackID']?>"><?php echo $row_availableTracks['trackTitle']?></option>
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
                        <br />
                        <a href="./tour_details.php?tour=13">[MOST-RECENT TOUR
                        NUMBERS]</a> (currently the summer 2008 (North America)
                        In Rainbows tour)<br />
                        <a href="/tour_details_grouping.php?tourgroup=0x00">[STATISTICS
                        FOR COMPLETE IN RAINBOWS TOUR]</a> (by
                        popular demand!) <br />
                              <a href="./58_yearstats.php"> [TOTAL OVERALL PERFORMANCE
                              NUMBERS IN A NUTSHELL]</a> (If you really need
                              to know)<br />
                      </span></td>
                  </tr>
                </table></td>
                <td width="25%" rowspan="2" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
                  <tr>
                    <td align="left"><font size="1" face="Arial, Helvetica, sans-serif" class="mainBodyText"> <img src="images/58_mainMostRecent.gif" alt="Most Recent Show" width="200" height="22" />
                          <p><?php echo date('l, m/d/Y',strtotime($row_mostRecentShow['showDate'])); ?><br />
                              <?php echo $row_mostRecentShow['showVenue']; ?><br />
                              <?php echo $row_mostRecentShow['showCity']; ?>, <?php echo $row_mostRecentShow['showLocality']; ?> - <?php echo $row_mostRecentShow['showCountry']; ?> <br />
                            <a href="58_displayshow.php?showID=<?php echo $row_mostRecentShow['showID']; ?>"><span class="darkerLinkage">[VIEW
                            SHOW DETAILS]</span></a> <br />
                          </p>
                    </font> </td>
                  </tr>
                </table>
                  <table width="204"  border="0" cellspacing="0" cellpadding="2">
                  <tr>
                    <td valign="top" bgcolor="#FFFFFF">
                      <div align="left"><font color="#999999" size="1" face="Arial, Helvetica, sans-serif" class="mainBodyText">
                        <?php require_once('loginModule_flash.php'); ?></font>
                        </p>
                      </div>
                    </td>
                  </tr>
                </table></td>
              </tr>
              <tr>
                <td valign="top"><table width="90%" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
                    <tr>
                      <td align="left"><p><img src="images/hd-news.gif" alt="NEWS" /><br />
                        </p>
                          <p class="mainBodyText">We're constantly on the lookout for setlist texting volunteers... and for those shows at which we don't have live correspondents.. we'll be monitoring several of the Radiohead boards whilst the shows transpire... in hopes of still providing you with (albeit slower) live setlist goodness. </p>
                          <p class="mainBodyText">As always, we're constantly on the lookout for people to help out &amp; text us live setlists, so please contact brian at 58hours if you're interested.<br /><br />
                          best,<br />
                          brian.</p></td>
                    </tr>
                  </table></td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td align="center"><font color="#CCCCCC"><br />
        <?php require_once('58ss_includes/58disclaimer.php'); ?>
        </font></td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
  </td><td width="180" align="center" valign="top" bgcolor="#000000"><br/>
    <a href="http://click.linksynergy.com/fs-bin/click?id=N2nvjdzFAVU&offerid=146261.10003181&type=4&subid=0"><IMG alt="Apple iTunes" border="0" src="http://images.apple.com/itunesaffiliates/US/2008/06/04/Radiohead_125x125.jpg"></a><IMG border="0" width="1" height="1" src="http://ad.linksynergy.com/fs-bin/show?id=N2nvjdzFAVU&bids=146261.10003181&type=4&subid=0"><br/><br/><? 
  	if($totalRows_availableAds0>0) 
  	{
		
		$rand = rand(0,($totalRows_availableAds0-1));
		//echo $rand;
		mysql_data_seek($availableAds0,$rand);
		$row_availableAds0 = mysql_fetch_assoc($availableAds0);
  		echo $row_availableAds0['code'];
	} 
	else 
	{ ?>...<a href="http://click.linksynergy.com/fs-bin/click?id=N2nvjdzFAVU&offerid=146261.10003125&type=4&subid=0"><IMG src="http://images.apple.com/itunesaffiliates/US/2008/06/02/Supergrass1_125x125.jpg" alt="Apple iTunes" width="125" height="125" border="0"></a><IMG border="0" width="1" height="1" src="http://ad.linksynergy.com/fs-bin/show?id=N2nvjdzFAVU&bids=146261.10003125&type=4&subid=0"><? } ?><br/>
  <br/>
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
<? echo $totalRows_availableAds0; ?>
</td></tr>
</table>
  
  
</div>
<map name="mainimg_map" id="mainimg_map">
<area shape="rect" coords="1,331,422,360" href="http://www.adobe.com/products/flashlite/" target="_blank" alt="Get the Adobe Flash Lite 2 player" />
</map>
<script src="http://www.google-analytics.com/urchin.js" type="text/javascript">
</script>
<script type="text/javascript">
_uacct = "UA-584621-1";
urchinTracker();
</script>
</body>
</html>
<?php
mysql_free_result($mostRecentShow);

mysql_free_result($availableTracks);

mysql_free_result($availableVenues);

mysql_free_result($availableDates);
?>

