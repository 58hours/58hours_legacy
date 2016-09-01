<?php require_once('Connections/radioRecords.php'); ?>
<?php
mysql_select_db($database_radioRecords, $radioRecords);
$query_mostRecentShow = "SELECT showID, showDate, showVenue, showCity, showLocality, showCountry FROM showlist_db ORDER BY showDate DESC";
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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>58hours.com: Radiohead setlist database in a can. Vacuum-sealed and guaranteed
to stay minty-fresh for years.</title>
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
</head>

<body bgcolor="#000033" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">


<div id="wrapper" align="center">


<div id="spotlightImage"> 
      <img src="images/58hours_main.jpg" width="800" height="361" /><br />
        <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0" width="800" height="20">
          <param name="movie" value="flashStats.swf" />
          <param name="quality" value="high" />
          <embed src="flashStats.swf" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="800" height="20"></embed>
      </object>
</div>


<div id="mainBody">


<div id="loginBoxVertical">
                <img src="images/hd-memberLogin.gif" width="200" height="22" /><br />
                     <font size="1" face="Arial, Helvetica, sans-serif" class="mainBodyText" color="#999999"><?php include_once('loginModule.php'); ?></font>
                    <font size="1" face="Arial, Helvetica, sans-serif" class="mainBodyText"><p>Why register?</p>
                    <p>Currently members can track which shows they've been to.</p>
                    <p>Additionally (eventually) all members will soon be able to upload their pictures from shows, post show reviews, track their own Radiohead tour/song stats, and see a significant increase of their overall swankness factor.</p>
                    <p>enjoy the info,<br />
                    -brian</p></font>
</div>
                    
                    
                    
<div id="mostRecentShow">
              <font size="1" face="Arial, Helvetica, sans-serif"><img src="images/58_mainMostRecent.gif" width="200" height="22" />
                    <p><?php echo date('l, m/d/Y',strtotime($row_mostRecentShow['showDate'])); ?><br />
                      <?php echo $row_mostRecentShow['showVenue']; ?><br />
                      <?php echo $row_mostRecentShow['showCity']; ?>, <?php echo $row_mostRecentShow['showLocality']; ?> - <?php echo $row_mostRecentShow['showCountry']; ?>
                        <br /><a href="58_displayshow.php?showID=<?php echo $row_mostRecentShow['showID']; ?>"><span class="darkerLinkage">[VIEW SHOW DETAILS]</span></a>
                    </p></font>
</div>
                
                
                
                
<div id="browseDatabase">
                <img src="/images/pixelshim.gif" width="500" height="1" /><font size="1" face="Arial, Helvetica, sans-serif"><img src="images/58_mainBrowse.gif" width="200" height="22" /><br />
                      </font>
                        <form name="browseType" id="browseType" method="get" action="58_trackDetails.php">
                          <font size="1" face="Arial, Helvetica, sans-serif"> <span class="mainBodyText">
                          <input name="selectGroup" type="radio" class="mainBodyText" onClick="MM_goToURL('parent','index.php?browse=songTitle');return document.MM_returnValue" value="songTitle" <?php if (!(strcmp($HTTP_GET_VARS['browse'],"songTitle"))) {echo "CHECKED";} ?> />
                          song title&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                          <input name="selectGroup" type="radio" class="mainBodyText" onClick="MM_goToURL('parent','index.php?browse=showDate');return document.MM_returnValue" value="showDate" <?php if (!(strcmp($HTTP_GET_VARS['browse'],"showDate"))) {echo "CHECKED";} ?> />
                          show date&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                          <input name="selectGroup" type="radio" class="mainBodyText" onClick="MM_goToURL('parent','index.php?browse=showVenue');return document.MM_returnValue" value="showVenue" <?php if (!(strcmp($HTTP_GET_VARS['browse'],"showVenue"))) {echo "CHECKED";} ?> />
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
                          <input name="Submit" type="submit" class="mainBodyText" value="Look up date!" />
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
                          <input name="Submit" type="submit" class="mainBodyText" value="Look up venue!" />
                          </span>
                        </form>
                        <?php } // Show if recordset not empty ?>                        <span class="mainBodyText">
                        <?php if ($totalRows_availableTracks > 0) { // Show if recordset not empty ?>
                        <form name="browseByTrack" id="browseByTrack" method="get" action="58_trackDetails.php">
                          <select name="trackID" class="mainBodyText" id="trackID">
                            <?php do {  ?>
                            <option value="<?php echo $row_availableTracks['trackID']?>"><?php echo htmlspecialchars($row_availableTracks['trackTitle'])?></option>
                            <?php } while ($row_availableTracks = mysql_fetch_assoc($availableTracks));
  $rows = mysql_num_rows($availableTracks);
  if($rows > 0) {
      mysql_data_seek($availableTracks, 0);
	  $row_availableTracks = mysql_fetch_assoc($availableTracks);
  }
?>
                          </select>
                          <input name="Submit" type="submit" class="mainBodyText" value="look it up!" />

                                                </form>
                        <br />
                        <br />
                        <?php } // Show if recordset not empty 
                        ?>
                        <br />
                        NEW STATS PAGE: <a href="58_yearstats.php">[TOTAL OVERALL PERFORMANCE NUMBERS IN A NUTSHELL]</a><br />
                        <br />
Welcome to 58hours:<br />
      <br />
      <br />
      &nbsp; It's a Radiohead gig database. A gigography of sorts... (whatever you want to label it) but in essence - a Radiohead Setlist Database. Or a Radiohead Gig Database... Any way that you slice it though technically it's just a bunch of mySQL tables, each with information pertaining to a certain Radiohead setlist. <br />
&nbsp;&nbsp; Seen a show? Look it up... check the info, and look through the setlist... hell... write a review. It's currently in an early beta state, so please be gentle... and if there are any problems, just <a href="#" onClick="MM_openBrWindow('post_comments.php?commentCat=site','siteComments','status=yes,width=450,height=300')">drop me a line...</a>  </span>
</div>
                    
<div id="footer"><br /><?php include_once('58ss_includes/58disclaimer.php'); ?></div>
</div></div>
</body>
</html>
<?php
mysql_free_result($mostRecentShow);

mysql_free_result($availableTracks);

mysql_free_result($availableVenues);

mysql_free_result($availableDates);
?>

