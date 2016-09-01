<?php 
require_once('Connections/random_connect.php');
require_once('_includes/SITEARTIST.php');
require_once('_includes/rhcommon.php');


// preprocess our external_show_id & make sure that it's valid
$internalexternal_show_id = $_GET['external_show_id'];
//if( number_format($internalexternal_show_id)!=$internalexternal_show_id) header("location: http://58.randomhours.com");
mysql_select_db($database_random_connect, $random_connect);


$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "claimShow")) {
  $insertSQL = sprintf("INSERT INTO 58_memberShows (memberID, external_show_id) VALUES (%s, %s)",GetSQLValueString($_POST['memberID'], "int"), GetSQLValueString($_POST['showID'], "int"));
  mysql_select_db($database_random_connect, $random_connect);
  $Result1 = mysql_query($insertSQL, $random_connect) or die(mysql_error());
}

$colname_liveLink = "999";
if (isset($_GET['external_show_id'])) {
  $colname_liveLink = (get_magic_quotes_gpc()) ? $_GET['external_show_id'] : addslashes($_GET['external_show_id']);
}
////////////////////
/*
mysql_select_db($database_random_connect, $random_connect);
$query_liveLink = sprintf("SELECT linkID, linknum, operator, linkshow, linkstatus, UNIX_TIMESTAMP(linktime) AS date FROM liveUpdate WHERE linkshow = %s ORDER BY linknum ASC", $colname_liveLink);
$liveLink = mysql_query($query_liveLink, $random_connect) or die(mysql_error());
$row_liveLink = mysql_fetch_assoc($liveLink);
$totalRows_liveLink = mysql_num_rows($liveLink);
*/
$colname_showDetails = "1";
if (isset($_GET['external_show_id'])) {
  $colname_showDetails = (get_magic_quotes_gpc()) ? $_GET['external_show_id'] : addslashes($_GET['external_show_id']);
}
//mysql_select_db($database_random_connect, $random_connect);
$query_showDetails = sprintf("SELECT 
rhr_countryresolver.country_name_display, 
rhr_countryresolver.external_country_id, 
rhr_localityresolver.locale_name_display, 
rhr_localityresolver.external_locale_id, 
rhr_cityresolver.city_name_display, 
rhr_cityresolver.external_city_id, 
rhr_venueresolver.venue_name_display,
rhr_venueresolver.external_venue_id,
rhr_performances.external_show_id,  
rhr_performances.showDate 
FROM rhr_performances, rhr_venueresolver, rhr_cityresolver, rhr_localityresolver, rhr_countryresolver 
WHERE rhr_localityresolver.external_country_id = rhr_countryresolver.external_country_id 
AND rhr_cityresolver.external_locale_id = rhr_localityresolver.external_locale_id 
AND rhr_venueresolver.external_city_id = rhr_cityresolver.external_city_id 
AND rhr_venueresolver.external_venue_id = rhr_performances.external_venue_id 
AND rhr_performances.external_show_id = %s", GetSQLValueString($colname_showDetails,"text"));
$showDetails = mysql_query($query_showDetails, $random_connect) or die(mysql_error());
$row_showDetails = mysql_fetch_assoc($showDetails);
$totalRows_showDetails = mysql_num_rows($showDetails);
//////
/*
$colname_tourDetails = "1";
if (isset($_GET['external_show_id'])) {
  $colname_tourDetails = (get_magic_quotes_gpc()) ? $_GET['external_show_id'] : addslashes($_GET['external_show_id']);
}
//mysql_select_db($database_random_connect, $random_connect);
$query_tourDetails = sprintf("SELECT rhr_tourresolver.tourName, rhr_tourresolver.external_tour_id FROM rhr_performances, rhr_tourresolver WHERE rhr_tourresolver.external_tour_id = rhr_performances.show_tour AND rhr_performances.external_show_id = %s", $colname_tourDetails);
$tourDetails = mysql_query($query_tourDetails, $random_connect) or die(mysql_error());
$row_tourDetails = mysql_fetch_assoc($tourDetails);
$totalRows_tourDetails = mysql_num_rows($tourDetails);
*/
//////

//////
/*
$colname_alternatevenue_name_displays = "1";
if (isset($_GET['external_show_id'])) {
  $colname_alternatevenue_name_displays = (get_magic_quotes_gpc()) ? $_GET['external_show_id'] : addslashes($_GET['external_show_id']);
}
//mysql_select_db($database_random_connect, $random_connect);
$query_alternatevenue_name_displays = sprintf("SELECT alternatevenue_name_displays.venue_name_display 
FROM rhr_performances, alternatevenue_name_displays 
WHERE rhr_performances.showexternal_venue_id = alternatevenue_name_displays.external_venue_id AND rhr_performances.external_show_id = %s", $colname_alternatevenue_name_displays);
$alternatevenue_name_displays = mysql_query($query_alternatevenue_name_displays, $random_connect) or die(mysql_error());
$row_alternatevenue_name_displays = mysql_fetch_assoc($alternatevenue_name_displays);
$totalRows_alternatevenue_name_displays = mysql_num_rows($alternatevenue_name_displays);
*/
//////




$colname_Details = "9999";
if (isset($_GET['external_show_id'])) {
  $colname_setlistDetails = (get_magic_quotes_gpc()) ? $_GET['external_show_id'] : addslashes($_GET['external_show_id']);
}
//echo $colname_setlistDetails;
/*
//mysql_select_db($database_random_connect, $random_connect);
$query_perfImages = sprintf("SELECT * FROM galleryBin, 58_members WHERE galleryBin.posterID = 58_members.pn_uid AND galleryBin.external_show_id = %s", $colname_showDetails);
$perfImages = mysql_query($query_perfImages, $random_connect) or die(mysql_error());
$row_perfImages = mysql_fetch_assoc($perfImages);
$totalRows_perfImages = mysql_num_rows($perfImages);
*/

mysql_select_db($database_random_connect, $random_connect);
$query_setlistDetails = sprintf("SELECT rhr_livetracks.external_show_id, rhr_livetracks.songNumber, rhr_titleresolver.song_name_display, rhr_titleresolver.external_song_id, rhr_livetracks.encore_level, rhr_songversionresolver.songversion_name_display, rhr_livetracks.nonstandard_track   
								FROM rhr_livetracks, rhr_titleresolver, rhr_songversionresolver  
								WHERE rhr_titleresolver.external_song_id = rhr_livetracks.external_song_id 
								AND rhr_livetracks.external_songversion_id = rhr_songversionresolver.external_songversion_id 
								AND rhr_livetracks.external_show_id = %s 
								ORDER BY rhr_livetracks.songNumber", GetSQLValueString($colname_setlistDetails,"text"));
$setlistDetails = mysql_query($query_setlistDetails, $random_connect) or die(mysql_error());
$row_setlistDetails = mysql_fetch_assoc($setlistDetails);
$totalRows_setlistDetails = mysql_num_rows($setlistDetails);
//echo $totalRows_setlistDetails;


$maxRows_showComments = 10;
$pageNum_showComments = 0;
if (isset($_GET['pageNum_showComments'])) {
  $pageNum_showComments = $_GET['pageNum_showComments'];
}
$startRow_showComments = $pageNum_showComments * $maxRows_showComments;

$colname_showComments = "1";
if (isset($_GET['external_show_id'])) {
  $colname_showComments = (get_magic_quotes_gpc()) ? $_GET['external_show_id'] : addslashes($_GET['external_show_id']);
}
//mysql_select_db($database_random_connect, $random_connect);
$query_showComments = sprintf("SELECT external_comment_id, comment_text, comment_author, external_commenttopic_id, UNIX_TIMESTAMP(comment_submit_time) AS date FROM rhr_comments WHERE external_commenttopic_id = '%s' AND comment_active=1 ORDER BY date DESC", $colname_showComments);
if(($_GET['allComments']==1)&&(isset($_GET['allComments']))) $query_limit_showComments = $query_showComments;
else $query_limit_showComments = sprintf("%s LIMIT %d, %d", $query_showComments, $startRow_showComments, $maxRows_showComments);
$showComments = mysql_query($query_limit_showComments, $random_connect) or die(mysql_error());
$row_showComments = mysql_fetch_assoc($showComments);

if (isset($_GET['totalRows_showComments'])) {
  $totalRows_showComments = $_GET['totalRows_showComments'];
} else {
  $all_showComments = mysql_query($query_showComments);
  $totalRows_showComments = mysql_num_rows($all_showComments);
}
$totalPages_showComments = ceil($totalRows_showComments/$maxRows_showComments)-1;

$targetShow=$row_showDetails['showDate'];
//mysql_select_db($database_random_connect, $random_connect);
$query_next_details = sprintf("SELECT external_show_id,showDate,showactive FROM rhr_performances WHERE showDate > '%s' ORDER BY showDate ASC LIMIT 1" ,$targetShow);
$nextShow = mysql_query($query_next_details, $random_connect) or die(mysql_error());
$row_nextShow = mysql_fetch_assoc($nextShow);
$totalRows_nextShow = mysql_num_rows($nextShow);

$targetPrevShow=$targetShow;
//mysql_select_db($database_random_connect, $random_connect);

$query_prev_details = sprintf("SELECT external_show_id, showDate FROM rhr_performances WHERE showDate < '%s' ORDER BY showDate DESC LIMIT 1",$targetPrevShow);

$prevShow = mysql_query($query_prev_details, $random_connect) or die(mysql_error());
$row_prevShow = mysql_fetch_assoc($prevShow);
$totalRows_prevShow = mysql_num_rows($prevShow);

/*
$colname_supportDetails = "9999";
if (isset($_GET['external_show_id'])) {
  $colname_supportDetails = (get_magic_quotes_gpc()) ? $_GET['external_show_id'] : addslashes($_GET['external_show_id']);
}
//mysql_select_db($database_random_connect, $random_connect);
$query_supportDetails = sprintf("SELECT supportResolver.supportName, supportResolver.supportID FROM supportReference, supportResolver WHERE supportResolver.supportID = supportReference.supportID AND supportReference.external_show_id = '%s' ORDER BY supportResolver.supportID", $colname_supportDetails);
$supportDetails = mysql_query($query_supportDetails, $random_connect) or die(mysql_error());
$row_supportDetails = mysql_fetch_assoc($supportDetails);
$totalRows_supportDetails = mysql_num_rows($supportDetails);
*/

/*
$colname_memberName = "9999";
if (isset($_COOKIE['memberID'])) {
  $colname_memberName = (get_magic_quotes_gpc()) ? $_COOKIE['memberID'] : addslashes($_COOKIE['memberID']);
}
//mysql_select_db($database_random_connect, $random_connect);


$query_memberName = sprintf("SELECT pn_uname FROM `58_members` WHERE pn_uid = %s", $colname_memberName);
$memberName = mysql_query($query_memberName, $random_connect) or die(mysql_error());
$row_memberName = mysql_fetch_assoc($memberName);
$totalRows_memberName = mysql_num_rows($memberName);

$colname2_attendedShow = "0";
if (isset($_COOKIE['memberID'])) {
  $colname2_attendedShow = (get_magic_quotes_gpc()) ? $_COOKIE['memberID'] : addslashes($_COOKIE['memberID']);
}
$colname_attendedShow = "1";
if (isset($_GET['external_show_id'])) {
  $colname_attendedShow = (get_magic_quotes_gpc()) ? $_GET['external_show_id'] : addslashes($_GET['external_show_id']);
}
//mysql_select_db($database_random_connect, $random_connect);
$query_attendedShow = sprintf("SELECT keyID, memberID, external_show_id FROM 58_memberShows WHERE external_show_id = '%s' AND memberID = '%s'", $colname_attendedShow,$colname2_attendedShow);
$attendedShow = mysql_query($query_attendedShow, $random_connect) or die(mysql_error());
$row_attendedShow = mysql_fetch_assoc($attendedShow);
$totalRows_attendedShow = mysql_num_rows($attendedShow);

$colname_attendingMembers = "0";
if (isset($_GET['external_show_id'])) {
  $colname_attendingMembers = (get_magic_quotes_gpc()) ? $_GET['external_show_id'] : addslashes($_GET['external_show_id']);
}
//mysql_select_db($database_random_connect, $random_connect);
$query_attendingMembers = sprintf("SELECT 58_memberShows.keyID, 58_memberShows.memberID, 58_memberShows.external_show_id, 58_members.pn_uname FROM 58_memberShows, 58_members WHERE 58_memberShows.external_show_id = '%s' AND 58_members.pn_uid = 58_memberShows.memberID ORDER BY memberID ASC", $colname_attendingMembers);
$attendingMembers = mysql_query($query_attendingMembers, $random_connect) or die(mysql_error());
$row_attendingMembers = mysql_fetch_assoc($attendingMembers);
$totalRows_attendingMembers = mysql_num_rows($attendingMembers);

$query_availableAds0 = "SELECT code FROM adqueue WHERE adqueue.group='1' AND active = '1' AND height = '125' AND width = '125' ORDER BY id";
$availableAds0 = mysql_query($query_availableAds0, $random_connect) or die(mysql_error());
$row_availableAds0 = mysql_fetch_assoc($availableAds0);
$totalRows_availableAds0 = mysql_num_rows($availableAds0);
*/
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>randomhours.com |  <? echo $row_showDetails['group_name_display']; ?> Radiohead setlist for <?php echo date('l, F d, Y',strtotime($row_showDetails['showDate'])); ?> (<?php echo $row_showDetails['venue_name_display']; ?>)</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<meta http-equiv="expires" content="0" />
<meta name="robots" content="index, follow" />
<meta name="author" content="Brian Kiel" />
<meta name="publisher" content="Invalid Sequence Labs" />
<meta name="copyright" content="brian kiel" />
<meta name="page-topic" content="Radiohead concert setlist for <? echo date('l, F d, Y',strtotime($row_showDetails['showDate'])); ?> (<?php echo $row_showDetails['venue_name_display'];?>)" />
<meta name="description" content="The setlist, photos, images, reviews and comments for Radiohead's show at <?php echo $row_showDetails['venue_name_display'];?> in <? echo $row_showDetails['city_name_display']; ?>, <? echo $row_showDetails['country_name_display']; ?> on <? echo date('l, F d, Y',strtotime($row_showDetails['showDate'])); ?> with the ability to crossreference songs & see what songs Radiohead are playing, the history of what they've already played, and what they might play, all searchable on multiple variables." />
<meta name="keywords" content="radiohead, setlists, radiohead setlists, <? echo $row_showDetails['venue_name_display'];?>, <? echo $row_showDetails['city_name_display'];?>" />


<link href="css/styles.css" rel="stylesheet" type="text/css" />
<style type="text/css"> 
body 
{ 
background-image: url('images/bgstripes.gif'); 
} 
</style>
<script language="JavaScript" type="text/JavaScript">
<!--
function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}
//-->
</script>



<style type="text/css">
<!--
.style3 {
	color: #FFFFFF;
	font-style: italic;
	font-family: Arial, Helvetica, sans-serif;
	font-size: 10px;
}
.style4 {color: #666666; text-decoration: none; font-family: Arial, Helvetica, sans-serif;}
-->
</style>
<link href="css/stylebook.css" rel="stylesheet" type="text/css" />
<script src="Scripts/AC_RunActiveContent.js" type="text/javascript"></script>
</head>

<body bgcolor="#000000" text="#FFFFFF" link="#0066CC" vlink="#0066CC" alink="#0066CC" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" class="blueishlinks">
<br />

<table width="800" height="850" border="0" align="center" cellpadding="0" cellspacing="0">
<tr>
<td valign="top">

<table width="980" height="750" border="0" align="center" cellpadding="1" cellspacing="1">
  <tr>
    <td colspan="2" height="90"><img src="images/pixelshim.gif" width="6" />
      <script type="text/javascript"><!--
google_ad_client = "pub-4681937497066114";
/* 728x90, created 8/14/08 */
google_ad_slot = "2300195665";
google_ad_width = 728;
google_ad_height = 90;
//-->
</script>
<script type="text/javascript"
src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script></td>
  </tr><tr>
    <td width="1004" valign="top">
<table width="800" height="750" border="0" align="center" cellpadding="5" cellspacing="0" bgcolor="#000000">
    <tr>
      <td colspan="2" bgcolor="#000000" class="darkerLinkage" valign="top" height="114"><a href="/"><img src="/i/rainbowheader_v2.jpg" width="800" height="114" border="0"></a>	  </td>
    </tr>
	<tr>
		<td align="right" valign="top" bgcolor="#000000" height="5">
			<table width="100%">
				<tr>
					<td align="left" valign="top" height="5"><div id="breadanchor_light"><font color="#e3e3e3" size="1" face="Arial, Helvetica, sans-serif"><font face="Arial, Helvetica, sans-serif" color="#000033" size="2"><a href="58_groupinglist.php?external_country_id=<?php 
					echo $row_showDetails['external_country_id']; 
					?>" class="linkageStuff">&raquo; <?php 
					echo $row_showDetails['country_name_display']; 
					?></a> <a href="58_groupinglist.php?external_locale_id=<?php 
					echo $row_showDetails['external_locale_id']; 
					?>" class="linkageStuff">&raquo; <?php 
					echo $row_showDetails['locale_name_display']; 
					?> </a> <a href="58_groupinglist.php?external_city_id=<?php 
					echo $row_showDetails['external_city_id']; 
					?>" class="linkageStuff">&raquo; <?php 
					echo $row_showDetails['city_name_display']; 
					?> </a> <a href="58_groupinglist.php?external_venue_id=<?php 
					echo $row_showDetails['external_venue_id']; 
					?>" class="linkageStuff">&raquo; <?php 
					echo $row_showDetails['venue_name_display']; 
					?></a><? 
					
					if(strlen($row_showDetails['showEventName'])>0&&($row_showDetails['showEventName']!='concert'))
					{
						echo ' <span class="linkageStuff">&raquo; '.$row_showDetails['showEventName']."</span>";
					} 
					?></font></font></div>
					</td>
					<td valign="top" align="right"><font size="1"><span class="linkageStuff"><font color="#FFFFFF" face="Arial, Helvetica, sans-serif">Browse by: <a href="index.php?browse=showDate" class="linkageStuff">date</a></font></span><font color="#FFFFFF" face="Arial, Helvetica, sans-serif"><span class="linkageStuff"> | <a href="index.php?browse=showVenue" class="linkageStuff">venue</a>  | <a href="index.php?browse=songTitle" class="linkageStuff">song title</a></span></font></font></td>
	</tr>
    </table>
            <table>
    <tr>
    <td valign="top"><script type="text/javascript">
AC_FL_RunContent( 'codebase','http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0','width','800','height','30','src','flash_elements/nameclip_full','quality','high','pluginspage','http://www.macromedia.com/go/getflashplayer','flashvars','name=<?php echo urlencode($row_showDetails['venue_name_display']); ?>','bgcolor','#000000','movie','flash_elements/nameclip_full' ); //end AC code
            </script>
      <noscript>
      <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0" width="800" height="30">
        <param name="movie" value="flash_elements/nameclip_full.swf" />
        <param name="quality" value="high" />
        <param name="flashVars" value="name=<?php echo urlencode($row_showDetails['venue_name_display']); ?>" />
        <param name="BGCOLOR" value="#000000" />
        <embed src="flash_elements/nameclip_full.swf" width="800" height="30" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" flashvars="name=<?php echo urlencode($row_showDetails['venue_name_display']); ?>" bgcolor="#000000"></embed>
      </object>
      </noscript><? if($totalRows_alternatevenue_name_displays>0)
	  {
	  	echo "Venue also formerly known as:<br>";
	  	do
		{
			echo $row_alternatevenue_name_displays['venue_name_display'];
			echo "<br>";
		} while($row_alternatevenue_name_displays = mysql_fetch_assoc($alternatevenue_name_displays));
	  }?></td>
    </tr>
    <tr>
      <td colspan="2" bgcolor="#000000" valign="top">
	  <table width="100%" border="0" cellspacing="0" cellpadding="1">
          <tr> 
            <td width="300" height="72" valign="top">
              &nbsp;&nbsp;<font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif">-<? echo date('l, F d, Y',strtotime($row_showDetails['showDate'])); ?></font>
			  <?
			  if($totalRows_tourDetails>0)
			  {
					echo "<br />&nbsp;&nbsp;&nbsp;<a href=\"./tour_details.php?tour=".$row_tourDetails['external_tour_id']."\" class=\"linkageStuff\">".$row_tourDetails['tourName']." Tour</a>";
				}	
				?><table width="250" border="0" cellspacing="0" cellpadding="1" height="5">
                <tr>
                  <td align="left" nowrap="nowrap" height="5"><?php 
				  	if ($totalRows_prevShow != 0) 
				  	{ // Show if recordset empty 
				  		?><a href="58_displayshow.php?external_show_id=<?php 
				  		echo $row_prevShow['external_show_id'];
						?>"><img src="images/bt_previous.gif" alt="Previous Show" width="58" height="13" border="0"></a><?php 
				  	} 
					else echo $targetShow;
				  	/*else if ($totalRows_prevShow == 0) 
					{ // Show if recordset empty 
						?><font size="1" face="Arial, Helvetica, sans-serif">NO PREVIOUS SHOWS</font><?php 
					} */
					?>
                  	<font size="1" face="Arial, Helvetica, sans-serif"><?php 
				 	if ($totalRows_nextShow != 0) 
					{ // Show if recordset empty 
				  		?><a href="58_displayshow.php?external_show_id=<?php 
				  		echo $row_nextShow['external_show_id'];
				  		?>"><img src="images/bt_next.gif" alt="Next Show" width="58" height="13" border="0" /></a><?php
				  	}
				  ?></font></td>
              </table>
			  <br /><br />
              <font color="#CCCCCC" size="1" face="Arial, Helvetica, sans-serif"><?php 
			  		if ($totalRows_supportDetails > 0) 
					{ // Show if recordset empty 
						?>show support: <?php 
						echo $row_supportDetails['supportName']; 
						?> <br><?php 
					} 
					if (($totalRows_nextShow == 0)&&($row_nextShow['showactive']=='0')) 
					{ // Show if recordset empty 
						?>THIS IS THE MOST RECENT SHOW<br><?php 
					} 
					?>
              <br></font>
              
              <div id="subtleanchor_light">
                <table width="250" border="0" cellspacing="0" cellpadding="1">
                  <tr>
                    <td align="center" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td valign="top">Setlist:<br /><img src="images/setlistheadermain.gif" /></td>
                          </tr>
                      <?php $recordCounter = 0; 
					  		$myPtr = 1;
							$encLevel = "0"; ?>
                      <?php do { ?>
                        <tr<?php
		$recordCounter=$recordCounter+1;
		if ($recordCounter % 2 == 1)
		{
		echo " bgcolor=#000000";
		}
		else
		{
		echo " bgcolor=#000000";
		}
		?>>
                          <td height="2" nowrap>
                            <font color="#CCCCCC" size="1" face="Arial, Helvetica, sans-serif">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php
                        if($row_setlistDetails['songNumber']==0) echo "intro";
                        //else echo $row_setlistDetails['songNumber']."."; 
                        ?>&nbsp;&nbsp;
                              <?php if($totalRows_setlistDetails>0) {
								  if($encLevel!=$row_setlistDetails['encore_level'])
								  {
									  $encLevel = $row_setlistDetails['encore_level'];
									  echo '</td></tr><tr><td><img src="images/setlistheaderenc'.$encLevel.'a.gif" /></td></tr><tr><td height="2" nowrap><font color="#CCCCCC" size="1" face="Arial, Helvetica, sans-serif">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
								  }
								  if($row_setlistDetails['nonstandard_track']=="1")
								  {
								  echo "+ ";
								  }
								  else
								  {
									  echo $myPtr++.".";
								  }
								  ?>
                              <a href="58_trackDetails.php?external_song_id=<?php echo $row_setlistDetails['external_song_id']; ?>" class="linkageStuff"><?php echo $row_setlistDetails['song_name_display']; ?></a>
                              <?php }else{?>
                              <a href="#" class="linkageStuff" onClick="MM_openBrWindow('post_comments.php?external_show_id=<?php echo $row_showDetails['external_show_id']; ?>','postit','status=yes,width=450,height=350')">none yet... click here to add.</a>
                              <?php } ?>
                              </font></td>
                          </tr>
                        <?php } while ($row_setlistDetails = mysql_fetch_assoc($setlistDetails)); ?>
                     
                </table>
              </div>
              <br>
			  <? if($row_showDetails['showactive']=="1"){?>
			  <script type="text/javascript">
			digg_bgcolor = '#000000';
			digg_skin = 'compact';
			digg_window = 'new';
			</script>
			  <script src="http://digg.com/tools/diggthis.js" type="text/javascript"></script><? } ?>
			  <br>  
			  <table width="250" border="0" cellspacing="1" cellpadding="1">
                <tr>
                  <td><font size="1" face="Arial, Helvetica, sans-serif">58HOURS MEMBERS AT THIS SHOW: <? echo $totalRows_attendingMembers; ?></font><br />
                    <font size="1" color="#CCCCCC" face="Arial, Helvetica, sans-serif">
				  <?php do { ?>
                      <?php echo $row_attendingMembers['pn_uname']; ?><?php if ($totalRows_attendingMembers > 1) {?>,<?php }?>
                      <?php } while ($row_attendingMembers = mysql_fetch_assoc($attendingMembers)); ?>
                      </font><br /><br /><?php if ($totalRows_attendedShow > 0) { // Show if recordset not empty ?>
                      <font face="Arial, Helvetica, sans-serif" size="1" color="#CCCCCC">You were at this show <a href="memberDetails.php">[remove]</a><br /><a href="user_shows.php">View Your Personal Show Details</a></font><?php } ?>
                      <?php if (($totalRows_memberName > 0)&&($totalRows_attendedShow <= 0)) { // Show if recordset not empty ?>
                      <form action="<?php echo $editFormAction; ?>" method="post" name="claimShow" id="claimShow">
                        <input name="external_show_id" type="hidden" value="<?php echo $_GET['external_show_id']; ?>" />
                        <input name="memberID" type="hidden" value="<?php echo $_COOKIE['memberID']; ?>" />
                        <font face="Arial, Helvetica, sans-serif" size="1" color="#CCCCCC"><a href="#" class="linkageStuff" onClick="javascript:document.claimShow.submit();"><img src="/i/claimshow.jpg" alt="add me to the list of members at this show" width="127" height="22" border="0" /></a> </font>
                        <input type="hidden" name="MM_insert" value="claimShow" />
                      </form>
                      <?php } // Show if recordset not empty ?></td>
                </tr>
              </table>
              <br />
              <?php if ($totalRows_liveLink != 0) { //show if recordset not empty ?><font color="#CCCCCC" size="1" face="Arial, Helvetica, sans-serif">
              <a href="about58.php">UPLINK CHECKS:</a><br>
              <?php do { ?>
              [#<?php echo $row_liveLink['linknum']; ?>] at <?php echo date('g:i A',$row_liveLink['date']); ?> (US Pacific time) by <?php echo $row_liveLink['operator']; ?> - 
              status: <?php echo $row_liveLink['linkstatus']; ?><br><?php } while ($row_liveLink = mysql_fetch_assoc($liveLink)); ?>
              </font><br><?php } //show if recordset not empty ?>
			  <?php if($row_showDetails['showComments']!="") {?>
			  <table width="250" border="0" cellspacing="0" cellpadding="4">
    <tr>
      <td><font size="1" face="Arial, Helvetica, sans-serif">[SHOW NOTES]<br>
			  <font color="#FFFFFF"><?php echo $row_showDetails['showComments']; ?>              </font> </font>	  </td>
    </tr>
  </table><?php } ?>
  <br /><p><br /></p></td>
            <td align="right" valign="top"><br/>
              <table width="450" border="0" cellpadding="1" cellspacing="1">
              <tr>
                <td width="454"><img src="images/showimages-wide.gif" width="450" height="13" /></td>
              </tr>
              <tr>
                <td><table width="450" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td><table width="450" border="0" cellspacing="1" cellpadding="0">
                          <tr>
                            <?php $iRow=0; do { ?>
                            <?php if (($iRow%4==0)&&($iRow!=0)) echo "</tr><tr>" ?>
                            <td width="100" valign="bottom"><div align="center">
                              <? if($totalRows_perfImages>0) { ?>
                              <a href="<?php echo $row_perfImages['photoLoc']; ?>" target="_blank" border="0"><img src="<?php echo $row_perfImages['photoTbLoc']; ?>" /></a>
                              <? } ?>
                              <br />
                            </div>
                                <div align="left"><font class="style3"><?php echo $row_perfImages['photoTitle']; ?><br />
                                      <?php echo $row_perfImages['pn_uname']; ?></font></div></td>
                            <?php $iRow++;} while ($row_perfImages = mysql_fetch_assoc($perfImages)); ?>
                          </tr>
                      </table></td>
                    </tr>
                </table></td>
              </tr>
              <tr>
                <td><img src="images/showreviews-wide.gif" width="450" height="13" /></td>
              </tr>
              <tr>
                <td><table cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
                    <tr>
                      <td colspan="2"><font size="1" face="Arial, Helvetica, sans-serif">
                        <?php if ($totalRows_showComments == 0) { // Show if recordset empty ?>
                        &nbsp;none currently posted.
                        <?php } // Show if recordset empty ?>
                        <br />
                        <?php if ($totalRows_showComments > 0) { // Show if recordset empty ?>
                        <?php 
      do { ?>
                        <table>
                          <tr>
                            <td><font color="#000000" face="Arial, Helvetica, sans-serif" size="1"> <?php echo $row_showComments['comment_text']; ?><br />
                      <br />
                              submitted by: <b> <?php echo $row_showComments['comment_author']; ?> </b> <br />
                              </font><font face="Arial, Helvetica, sans-serif" size="1" color="#3366CC"><i><?php echo date('g:i A',$row_showComments['date']); ?> [US Pacific time], <?php echo date('l, F d, Y',$row_showComments['date']); ?> </i></font> <br />
                              <hr />
                              <br />                            </td>
                          </tr>
                        </table>
                        <?php } while ($row_showComments = mysql_fetch_assoc($showComments)); ?>
                        </font>
                          <?php } // Show if recordset empty ?>
                          <!-- <a href="#" class="linkageStuff" onclick="MM_openBrWindow('post_comments.php?external_show_id=<?php echo $row_showDetails['external_show_id']; ?>','postit','status=yes,width=450,height=350')"><em>[click
                        to add a comment for this show]</em> </a><br />
                        <br /> -->
                          <!--<a href="#" class="linkageStuff" onclick="MM_openBrWindow('post_comments.php?external_show_id=<?php echo $row_showDetails['external_show_id']; ?>','postit','status=yes,width=450,height=350')"><em>[click
                        to add a review for this show]</em> </a> <br />
                        <br /> -->                      </td>
                    </tr>
                    <tr>
                      <td align="left" width="250"><a href="#" class="linkageStuff" onclick="MM_openBrWindow('post_comments.php?external_show_id=<?php echo $row_showDetails['external_show_id']; ?>','postit','status=yes,width=450,height=350')"><img src="images/cornering_r3_c1.gif" width="30" height="30" border="0"/><img src="images/addcomments.gif" alt="add comment" width="130" height="13" vspace="5" border="0" /></a></td>
                      <td align="right" width="250"><? if($_GET['allComments']!='1') {?><a href="<?=$_SERVER['REQUEST_URI']?>&amp;allComments=1" class="linkageStuff"><img src="images/viewothercomments.gif" alt="View Comments" width="119" height="13" vspace="5" border="0" /></a><? } ?>
                        <img src="images/cornering_r3_c3.gif" width="30" height="30" border="0"/></td>
                    </tr>
                </table></td>
              </tr>
            </table></td></tr><tr><td>
			<br></td>
            </tr>
  </table>  </td>
    </tr>
	
    <tr bgcolor="#333366">

      <td colspan="2"><font color="#FFFFFF">
        <?php require_once('58ss_includes/58disclaimer.php'); ?>
      </font></td>
    </tr>
  </table>
	</td>
  </tr>
</table>

</td><td width="180" align="center" valign="top" bgcolor="#000000"><br/><? 
  	if($totalRows_availableAds0>0) 
  	{
		
		$rand = rand(0,($totalRows_availableAds0-1));
		//echo $rand;
		mysql_data_seek($availableAds0,$rand);
		$row_availableAds0 = mysql_fetch_assoc($availableAds0);
  		echo $row_availableAds0['code'];
	} 
	else 
	{ ?>...<a href="http://click.linksynergy.com/fs-bin/click?id=N2nvjdzFAVU&offerid=146261.10003125&type=4&subid=0"><IMG src="http://images.apple.com/itunesaffiliates/US/2008/06/02/Supergrass1_125x125.jpg" alt="Apple iTunes" width="125" height="125" border="0"></a><IMG border="0" width="1" height="1" src="http://ad.linksynergy.com/fs-bin/show?id=N2nvjdzFAVU&bids=146261.10003125&type=4&subid=0"><? } ?><br/><br />
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
</td></tr></table>

</body>
</html>
<?php
mysql_free_result($showDetails);

mysql_free_result($tourDetails);

mysql_free_result($setlistDetails);

mysql_free_result($showComments);

mysql_free_result($memberName);

mysql_free_result($attendedShow);

mysql_free_result($attendingMembers);

mysql_free_result($perfImages);

?>
