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

function MM_goToURL() { //v3.0
  var i, args=MM_goToURL.arguments; document.MM_returnValue = false;
  for (i=0; i<(args.length-1); i+=2) eval(args[i]+".location='"+args[i+1]+"'");
}
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


<link href="css/stylebook.css" rel="stylesheet" type="text/css" />
</head>

<body bgcolor="#000000" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<br /><table width="800" border="0" align="center" cellpadding="0" cellspacing="0">
<tr>
<td bgcolor="#e3e3e3" colspan="2">
<font face="helvetica,arial" size="1" color="#333333">&nbsp;&nbsp;58hours is still looking for mobile setlist texters/correspondents... If you can help out on this tour, <a href="mailto:liveupdates@58hours.com">c'mon!</a></font></td>
</tr>
<tr><td><div align="center">
  <table width="800" border="0" cellpadding="0" cellspacing="0">
    <tr> 
      <td align="left" bgcolor="#FFFFFF"><div id="homeImage"><img src="images/promoheader.jpg" alt="coming Summer 2006, 58hourslive. Access the power of 58hours from your mobile" width="800" height="361"></div>
        <div id="dbstatusbar"><font size="1" face="Arial, Helvetica, sans-serif" class="mainBodyText">
		<span class="small" align="right" valign="bottom"><font color="#999999">
              <?php require_once('loginModule_bar.php'); ?>
          </font></span>
        </font><br />
          <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0" width="800" height="20">
            <param name="movie" value="flashStats.swf" />
            <param name="quality" value="high" />
            <embed src="flashStats.swf" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="800" height="20"></embed>
          </object>
        </div></td>
    </tr>
    <tr> 
      <td bgcolor="#FFFFFF">
        <table width="800" border="0" cellspacing="0" valign="top">
          <tr>
            <td>
            <table width="800"  border="0" cellspacing="0" valign="top">
              <tr>
                <td valign="top" width="270">
				<table width="270" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
                  <tr>
				  <td><div class="mainBodyText" id="home_leftpanel"><font size="1" face="Arial, Helvetica, sans-serif">
                    <img src="images/58_mainMostRecent.gif" width="200" height="22" />
                    <p><?php echo date('l, m/d/Y',strtotime($row_mostRecentShow['showDate'])); ?><br />
                      <?php echo $row_mostRecentShow['showVenue']; ?><br />
                      <?php echo $row_mostRecentShow['showCity']; ?>, <?php echo $row_mostRecentShow['showLocality']; ?> - <?php echo $row_mostRecentShow['showCountry']; ?>
                        <br /><a href="58_displayshow.php?showID=<?php echo $row_mostRecentShow['showID']; ?>"><span class="darkerLinkage">[VIEW SHOW DETAILS]</span></a></p></font></div></td>
	</tr>					
						
						<tr>
				  <td>
				  <div id="home_news"><a href="./tour_details.php?tour=8">[CURRENT TOUR NUMBERS]</a><br />
                              <a href="./58_yearstats.php">[TOTAL OVERALL PERFORMANCE NUMBERS IN A NUTSHELL]</a><br />
                            OTHER NEWS... members can now update their passwords at their leisure... yes, how very '1995' of me.  Anyhoo.<br />
                            <br />
                            Welcome to 58hours:<br />
  &nbsp; It's a Radiohead gig database. A gigography of sorts... (whatever you want to label it) but in essence - a Radiohead Setlist Database. Seen a show? Look it up... check the info, and look through the setlist... hell... write a review. It's currently in an early beta state, so please be gentle... and if there are any problems, just <a href="#" onClick="MM_openBrWindow('post_comments.php?commentCat=site','siteComments','status=yes,width=450,height=300')">drop me a line...</a></div>
  </td>
  </tr>
                </table></td>
              
                <td valign="top">
				<table border="0" cellspacing="0" cellpadding="0" valign="top">
                  <tr>
                    <td align="left" rowspan="2" valign="top" bgcolor="#FFFFFF"><div id="browseui"><img src="images/58_mainBrowse.gif" width="200" height="22" />
                        <form name="browseType" id="browseType" method="get" action="58_trackDetails.php">
                          <font size="1" face="Arial, Helvetica, sans-serif"> <span class="mainBodyText">
                            <input name="selectGroup" type="radio" class="small" onClick="MM_goToURL('parent','index.php?browse=songTitle');return document.MM_returnValue" value="songTitle" <?php if (!(strcmp($HTTP_GET_VARS['browse'],"songTitle"))) {
						  echo "CHECKED";
						  }
						  elseif(empty($HTTP_GET_VARS['browse'])){echo "CHECKED";} ?> />
                            song title&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <input name="selectGroup" type="radio" class="small" onClick="MM_goToURL('parent','index.php?browse=showDate');return document.MM_returnValue" value="showDate" <?php if (!(strcmp($HTTP_GET_VARS['browse'],"showDate"))) {echo "CHECKED";} ?> />
                            show date&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <input name="selectGroup" type="radio" class="small" onClick="MM_goToURL('parent','index.php?browse=showVenue');return document.MM_returnValue" value="showVenue" <?php if (!(strcmp($HTTP_GET_VARS['browse'],"showVenue"))) {echo "CHECKED";} ?> />
                            show venue</span></font>
                        </form>
                        <?php if ($totalRows_availableDates > 0) { // Show if recordset not empty ?>
                          <form name="browseByVenue" id="browseByVenue" method="get" action="58_displayshow.php?showID=<?php echo $row_availableDates['showID']; ?>">
                            <span class="mainBodyText">
                              <select name="showID" size="10" class="small" id="showID">
                                <?php do {  ?>
                                <option value="<?php echo $row_availableDates['showID']?>"><?php echo date('m/d/Y',strtotime($row_availableDates['showDate']));?></option>
                                <?php } while ($row_availableDates = mysql_fetch_assoc($availableDates));

  $rows = mysql_num_rows($availableDates);
  if($rows > 0) {
      mysql_data_seek($availableDates, 0);
	  $row_availableDates = mysql_fetch_assoc($availableDates);
  } ?>
                                </select>
                              <input type="submit" class="small" value="Look up date!" />
                              </span>
                            </form>
                          <?php } // Show if recordset not empty ?>
                        <?php if ($totalRows_availableVenues > 0) { // Show if recordset not empty ?>
                          <form name="browseByVenue" id="browseByVenue" method="get" action="58_groupinglist.php?venueID=<?php echo $row_availableVenues['venueID']; ?>">
                            <span class="mainBodyText">
                              <select name="venueID" size="10" class="small" id="venueID">
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
                              <input type="submit" class="small" value="Look up venue!" />
                              </span>
                            </form>
                          <?php } // Show if recordset not empty ?>                        
                        
                          <?php if ($totalRows_availableTracks > 0) { // Show if recordset not empty ?>
                            <form name="browseByTrack" id="browseByTrack" method="get" action="58_trackDetails.php">
                              <select name="trackID" size="10" class="small" id="trackID">
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
                              <input type="submit" class="small" value="look it up!" />
                              </form>
                          <br />
                            <br />
                            <?php } // Show if recordset not empty ?></div>
                          </td>
                  </tr>
				  
                </table></td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td align="center">
              <div id="basicfooter">
                <?php require_once('58ss_includes/58disclaimer.php'); ?>
              </div>
			  </td>
          </tr>
        </table>
		</td>
    </tr>
  </table>
  </td><td valign="top" bgcolor="#000000"><img src="images/google_spacer.gif" height="70" width="160"><br/>
  <script type="text/javascript"
  src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>
</td></tr></table>
</div>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>
  <map name="mainimg_map" id="mainimg_map">
    <area shape="rect" coords="1,331,422,360" href="http://www.adobe.com/products/flashlite/" target="_blank" alt="Get the Adobe Flash Lite 2 player" />
  </map>
</p>
<div class="bodywrapper">fdsafdsaf
</div>
</body>
</html>
<?php
mysql_free_result($mostRecentShow);

mysql_free_result($availableTracks);

mysql_free_result($availableVenues);

mysql_free_result($availableDates);
?>

