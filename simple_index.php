<?php require_once('Connections/radioRecords.php'); ?>
<?php
if($_SERVER['REMOTE_ADDR']=="69.181.127.193") die;
mysql_select_db($database_radioRecords, $radioRecords);
//$query_mostRecentShow = "SELECT showID, showDate, showVenue, showCity, showLocality, showCountry FROM showlist_db ORDER BY showDate DESC";
$query_mostRecentShow = "SELECT showlist_db.showID as showID, showlist_db.showDate as showDate, venuedetails.venueName as showVenue, cityresolver.cityName as showCity, localityresolver.localityName as showLocality, countryresolver.countryName as showCountry FROM showlist_db, cityresolver, localityresolver, countryresolver, venuedetails WHERE venuedetails.venueID = showlist_db.showVenueID AND venuedetails.venueCity = cityresolver.cityID AND cityresolver.localityID = localityresolver.localityID AND localityresolver.countryID = countryresolver.countryID ORDER BY showDate DESC LIMIT 1";
$mostRecentShow = mysql_query($query_mostRecentShow, $radioRecords) or die(mysql_error());
$row_mostRecentShow = mysql_fetch_assoc($mostRecentShow);
$totalRows_mostRecentShow = mysql_num_rows($mostRecentShow);


$colname_availableTracks = "songTitle";
if (isset($HTTP_GET_VARS['browse'])) {
  $colname_availableTracks = (get_magic_quotes_gpc()) ? $HTTP_GET_VARS['browse'] : addslashes($HTTP_GET_VARS['browse']);
}
mysql_select_db($database_radioRecords, $radioRecords);
$query_availableTracks = sprintf("SELECT trackID, trackTitle FROM titleresolver WHERE '%s' ='songTitle' ORDER BY trackTitle ASC", $colname_availableTracks);
$availableTracks = mysql_query($query_availableTracks, $radioRecords) or die(mysql_error());
$row_availableTracks = mysql_fetch_assoc($availableTracks);
$totalRows_availableTracks = mysql_num_rows($availableTracks);

$colname_availableVenues = "1";
if (isset($HTTP_GET_VARS['browse'])) {
  $colname_availableVenues = (get_magic_quotes_gpc()) ? $HTTP_GET_VARS['browse'] : addslashes($HTTP_GET_VARS['browse']);
}
mysql_select_db($database_radioRecords, $radioRecords);
$query_availableVenues = sprintf("SELECT DISTINCT venuedetails.venueID, venuedetails.venueName, cityresolver.cityName, localityresolver.localityName FROM venuedetails, showlist_db, localityresolver, cityresolver WHERE cityresolver.localityID = localityresolver.localityID AND showlist_db.showVenueID=venuedetails.venueID AND venuedetails.venueCity = cityresolver.cityID AND '%s' = 'showVenue' ORDER BY venuedetails.venueName ASC", $colname_availableVenues);
$availableVenues = mysql_query($query_availableVenues, $radioRecords) or die(mysql_error());
$row_availableVenues = mysql_fetch_assoc($availableVenues);
$totalRows_availableVenues = mysql_num_rows($availableVenues);

$colname_availableDates = "showDate";
if (isset($HTTP_GET_VARS['browse'])) {
  $colname_availableDates = (get_magic_quotes_gpc()) ? $HTTP_GET_VARS['browse'] : addslashes($HTTP_GET_VARS['browse']);
}
mysql_select_db($database_radioRecords, $radioRecords);
$query_availableDates = sprintf("SELECT showID, showVenueID, showDate FROM showlist_db WHERE '%s' = 'showDate' ORDER BY showDate DESC", $colname_availableTracks);
$availableDates = mysql_query($query_availableDates, $radioRecords) or die(mysql_error());
$row_availableDates = mysql_fetch_assoc($availableDates);
$totalRows_availableDates = mysql_num_rows($availableDates);
?>
<?php echo "<?xml version=\"1.0\" encoding=\"iso-8859-1\"?".">"; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>58hours.com: c'mon.. say it with me.. "god, I'm such a Radiohead whore." There. Feel better?</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/styles.css" rel="stylesheet" type="text/css" />

<script language="JavaScript" type="text/javascript">
<!--
function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}

function MM_goToURL() { //v3.0
  var i, args=MM_goToURL.arguments; document.MM_returnValue = false;
  for (i=0; i<(args.length-1); i+=2) eval(args[i]+".location='"+args[i+1]+"'");
}
//-->
</script>
//-->
</script>

<script type="text/javascript"><!--
google_ad_client = "pub-4681937497066114";
google_ad_width = 160;
google_ad_height = 600;
google_ad_format = "160x600_as";
google_ad_type = "text";
google_ad_channel ="6294685603";
google_color_border = "000000";
google_color_link = "FFFFFF";
google_color_bg = "000000";
google_color_text = "CCCCCC";
google_color_url = "999999";
//--></script>
</head>

<body bgcolor="#000000" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<br /><table width="800" border="0" align="center" cellpadding="0" cellspacing="0">
<tr><td>
<div align="center">
  <table width="800" border="0" cellpadding="0" cellspacing="0">
    <tr> 
      <td align="center" bgcolor="#FFFFFF"><img src="images/new58hours_main.jpg" width="800" height="361" usemap="#mainimg_map" border="0" alt="Coming June 2006, 58hourslive.  The power of 58hours, available on your mobile."/><br />
        <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0" width="800" height="20">
          <param name="movie" value="flashStats.swf" />
          <param name="quality" value="high" />
          <embed src="flashStats.swf" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="800" height="20"></embed>
      </object>
	 </td>
    </tr>
    <tr> 
      <td bgcolor="#FFFFFF"><font color="#999999">&nbsp; </font>
        <table width="800" border="0" cellspacing="0" cellpadding="5" valign="top">
          <tr>
            <td><table width="100%"  border="0" cellpadding="1" cellspacing="0" bgcolor="#CCCCCC" valign="top">
              <tr>
                <td width="75%" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
                  <tr>
                    <td><font size="1" face="Arial, Helvetica, sans-serif"><img src="images/58_mainMostRecent.gif" width="200" height="22" />
                    <p><?php echo date('l, m/d/Y',strtotime($row_mostRecentShow['showDate'])); ?><br />
                      <?php echo $row_mostRecentShow['showVenue']; ?><br />
                      <?php echo $row_mostRecentShow['showCity']; ?>, <?php echo $row_mostRecentShow['showLocality']; ?> - <?php echo $row_mostRecentShow['showCountry']; ?>
                        <br /><a href="58_displayshow.php?showID=<?php echo $row_mostRecentShow['showID']; ?>"><span class="darkerLinkage">[VIEW SHOW DETAILS]</span></a>
                    </p>
                    </font>
                    </td>
                  </tr>
                </table></td>
                <td width="25%" rowspan="2" valign="top"><table width="204"  border="0" cellspacing="0" cellpadding="2">
                  <tr>
                    <td valign="top" bgcolor="#FFFFFF"><font size="1" face="Arial, Helvetica, sans-serif"><img src="images/hd-memberLogin.gif" width="200" height="22" /></font><font size="1" face="Arial, Helvetica, sans-serif" class="mainBodyText"><br />
                      <div align="left"><font color="#999999"><?php require_once('loginModule.php'); ?></font></div>
                      </font></font>
                    <p><font size="1" face="Arial, Helvetica, sans-serif" class="mainBodyText">Why
                        register?</font></p>
                    <p><font size="1" face="Arial, Helvetica, sans-serif" class="mainBodyText">Currently
                        members can track which shows they've been to. </font></p>
                    <p><font size="1" face="Arial, Helvetica, sans-serif" class="mainBodyText">Additionally
                        (eventually) all members will soon be able to upload
                        their pictures from shows, post show reviews, track their
                        own Radiohead tour/song stats, and see a significant
                        increase of their overall swankness factor.</font></p>
                    <p><font face="Arial, Helvetica, sans-serif" class="mainBodyText">enjoy
                          the info,<br />
                    </font><font size="1" face="Arial, Helvetica, sans-serif" class="mainBodyText">-brian</font>
	                      </p>
                    </td>
                  </tr>
                </table></td>
              </tr>
              <tr>
                <td valign="top"><table width="500" border="0" cellspacing="0" cellpadding="2" valign="top">
                  <tr>
                    <td width="500" align="left" valign="top" bgcolor="#FFFFFF"> <img src="/images/pixelshim.gif" width="585" height="1" /><font size="1" face="Arial, Helvetica, sans-serif"><img src="images/58_mainBrowse.gif" width="200" height="22" /><br />
                      </font>
                        <form name="browseType" id="browseType" method="get" action="song_details.php">
                          <font size="1" face="Arial, Helvetica, sans-serif"> <span class="mainBodyText">
                          <input name="selectGroup" type="radio" class="mainBodyText" onClick="MM_goToURL('parent','simple_index.php?browse=songTitle');return document.MM_returnValue" value="songTitle" <?php if (!(strcmp($HTTP_GET_VARS['browse'],"songTitle"))) {
						  echo "CHECKED";
						  }
						  elseif(empty($HTTP_GET_VARS['browse'])){echo "CHECKED";} ?> />
                          song title&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                          <input name="selectGroup" type="radio" class="mainBodyText" onClick="MM_goToURL('parent','simple_index.php?browse=showDate');return document.MM_returnValue" value="showDate" <?php if (!(strcmp($HTTP_GET_VARS['browse'],"showDate"))) {echo "CHECKED";} ?> />
                          show date&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                          <input name="selectGroup" type="radio" class="mainBodyText" onClick="MM_goToURL('parent','simple_index.php?browse=showVenue');return document.MM_returnValue" value="showVenue" <?php if (!(strcmp($HTTP_GET_VARS['browse'],"showVenue"))) {echo "CHECKED";} ?> />
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
                          <input type="submit" class="mainBodyText" value="Look up date!" />
                          </span>
                        </form>
                        <?php } // Show if recordset not empty ?>
                        <?php if ($totalRows_availableVenues > 0) { // Show if recordset not empty ?>
                        <form name="browseByVenue" id="browseByVenue" method="get" action="browse.php?venueID=<?php echo $row_availableVenues['venueID']; ?>">
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
                          <input type="submit" class="mainBodyText" value="Look up venue!" />
                          </span>
                        </form>
                        <?php } // Show if recordset not empty ?>                        <span class="mainBodyText">
                        <?php if ($totalRows_availableTracks > 0) { // Show if recordset not empty ?>
                        <form name="browseByTrack" id="browseByTrack" method="get" action="song_details.php">
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
                          <input type="submit" class="mainBodyText" value="look it up!" />
						</form>
                        <br />
                        <br />
                        <?php } // Show if recordset not empty ?>
                        <br />
                        <a href="./tour_details.php?tour=8">[CURRENT TOUR NUMBERS]</a><br />
                        <a href="./58_yearstats.php">[TOTAL OVERALL PERFORMANCE NUMBERS IN A NUTSHELL]</a><br />
                        
                        <br />
Welcome to 58hours:<br />
      <br />
      <br />
      &nbsp; It's a Radiohead gig database. A gigography of sorts... (whatever
      you want to label it) but in essence - a Radiohead Setlist Database.<br />
&nbsp;&nbsp; Seen a show? Look it up... check the info, and look through the
setlist... hell... write a review. It's currently in an early beta state, so
please be gentle... and if there are any problems, just <a href="#" onClick="MM_openBrWindow('post_comments.php?commentCat=site','siteComments','status=yes,width=450,height=300')">drop
me a line...</a>  </span></td>
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
  <br />
  </td><td>

<script type="text/javascript"
  src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>
</td></tr></table>


</div>
<map name="mainimg_map" id="mainimg_map">
<area shape="rect" coords="1,331,422,360" href="http://www.adobe.com/products/flashlite/" target="_blank" alt="Get the Adobe Flash Lite 2 player" />
</map>
</body>
</html>
<?php
mysql_free_result($mostRecentShow);

mysql_free_result($availableTracks);

mysql_free_result($availableVenues);

mysql_free_result($availableDates);
?>

