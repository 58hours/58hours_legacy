<?php 
require_once('Connections/random_connect.php');
require_once('_includes/SITEARTIST.php');
require_once('_includes/rhcommon.php');

if(isset($_GET['allComments']))
{
	$showAllComments = 1;
}
else $showAllComments = 0;

// this is stuff that forces legacy redirects
if(isset($_GET['showID']))
{
	$query_legacyShow = sprintf("SELECT external_show_id FROM rhr_performances WHERE legacy_show_id = %s", GetSQLValueString($_GET['showID'],"text"));
	$legacyShow = mysql_query($query_legacyShow, $random_connect) or die(mysql_error());
	$row_legacyShow = mysql_fetch_assoc($legacyShow);
	if(strlen($row_legacyShow['external_show_id'])>0)
	{
		header("Location: /showdetails.php?external_show_id=".$row_legacyShow['external_show_id'], true, 301);
	}
	else
	{
		header("Location: /index.php");
	}
}

$colname_memberName = "9999";
if (isset($_COOKIE['client_id_hash'])) {
  $colname_memberName = (get_magic_quotes_gpc()) ? $_COOKIE['client_id_hash'] : addslashes($_COOKIE['client_id_hash']);
}
//mysql_select_db($database_random_connect, $random_connect);


$query_memberName = sprintf("SELECT pn_uname, external_user_id FROM rhr_users WHERE client_key_userid = %s", GetSQLValueString($colname_memberName,"text"));
$memberName = mysql_query($query_memberName, $random_connect) or die(mysql_error());
$row_memberName = mysql_fetch_assoc($memberName);
$totalRows_memberName = mysql_num_rows($memberName);

$local_user_id = $row_memberName['external_user_id'];

// preprocess our external_show_id & make sure that it's valid
$internalexternal_show_id = $_GET['external_show_id'];
//if( number_format($internalexternal_show_id)!=$internalexternal_show_id) header("location: http://58.randomhours.com");
mysql_select_db($database_random_connect, $random_connect);


$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if (((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "claimShow"))&&$totalRows_memberName==1) {




  $insertSQL = sprintf("INSERT INTO rhr_usershows (external_user_id, external_show_id) VALUES (%s, %s)",GetSQLValueString($row_memberName['external_user_id'], "text"), GetSQLValueString($_POST['external_show_id'], "text"));
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
rhr_performances.showDate,
rhr_performances.external_event_id,
rhr_performances.showactive
FROM rhr_performances, rhr_venueresolver, rhr_cityresolver, rhr_localityresolver, rhr_countryresolver  
WHERE rhr_localityresolver.external_country_id = rhr_countryresolver.external_country_id 
AND rhr_cityresolver.external_locale_id = rhr_localityresolver.external_locale_id 
AND rhr_venueresolver.external_city_id = rhr_cityresolver.external_city_id 
AND rhr_venueresolver.external_venue_id = rhr_performances.external_venue_id 
AND rhr_performances.external_show_id = %s", GetSQLValueString($colname_showDetails,"text"));
$showDetails = mysql_query($query_showDetails, $random_connect) or die(mysql_error());
$row_showDetails = mysql_fetch_assoc($showDetails);
$totalRows_showDetails = mysql_num_rows($showDetails);

$venueHasNewName = false;

if($totalRows_showDetails==0)
{
	// then we rerun the query... this time looking for alternate venue names...
	
	$query_showDetails = sprintf("SELECT 
	rhr_countryresolver.country_name_display, 
	rhr_countryresolver.external_country_id, 
	rhr_localityresolver.locale_name_display, 
	rhr_localityresolver.external_locale_id, 
	rhr_cityresolver.city_name_display, 
	rhr_cityresolver.external_city_id, 
	rhr_venueresolver.venue_name_display AS current_venue_name,
	rhr_venueresolver.external_venue_id,
	rhr_performances.external_show_id,  
	rhr_performances.showDate,
	rhr_performances.external_event_id,
	rhr_alternatevenuenames.venue_name_display    
	FROM rhr_performances, rhr_venueresolver, rhr_cityresolver, rhr_localityresolver, rhr_countryresolver, rhr_alternatevenuenames  
	WHERE rhr_localityresolver.external_country_id = rhr_countryresolver.external_country_id 
	AND rhr_cityresolver.external_locale_id = rhr_localityresolver.external_locale_id 
	AND rhr_venueresolver.external_city_id = rhr_cityresolver.external_city_id 
	AND rhr_alternatevenuenames.alt_external_venue_id = rhr_performances.external_venue_id 
	AND rhr_venueresolver.external_venue_id = rhr_alternatevenuenames.primary_external_venue_id
	AND rhr_performances.external_show_id = %s", GetSQLValueString($colname_showDetails,"text"));
	$showDetails = mysql_query($query_showDetails, $random_connect) or die(mysql_error());
	$row_showDetails = mysql_fetch_assoc($showDetails);
	$totalRows_showDetails = mysql_num_rows($showDetails);
	
	$venueHasNewName = true;
	
}



//mysql_select_db($database_random_connect, $random_connect);
$query_eventDetails = sprintf("SELECT  
rhr_eventresolver.event_name_display  
FROM rhr_performances, rhr_eventresolver 
WHERE rhr_eventresolver.external_event_id = rhr_performances.external_event_id
AND rhr_performances.external_show_id = %s", GetSQLValueString($colname_showDetails,"text"));
$eventDetails = mysql_query($query_eventDetails, $random_connect) or die(mysql_error());
$row_eventDetails = mysql_fetch_assoc($eventDetails);
$totalRows_eventDetails = mysql_num_rows($eventDetails);


//////

$colname_tourDetails = "1";
if (isset($_GET['external_show_id'])) {
  $colname_tourDetails = (get_magic_quotes_gpc()) ? $_GET['external_show_id'] : addslashes($_GET['external_show_id']);
}
//mysql_select_db($database_random_connect, $random_connect);
$query_tourDetails = sprintf("SELECT rhr_tourresolver.tour_name_display, rhr_tourresolver.external_tour_id FROM rhr_performances, rhr_tourresolver WHERE rhr_tourresolver.external_tour_id = rhr_performances.external_tour_id AND rhr_performances.external_show_id = %s", GetSQLValueString($colname_tourDetails, 'text'));
$tourDetails = mysql_query($query_tourDetails, $random_connect) or die(mysql_error());
$row_tourDetails = mysql_fetch_assoc($tourDetails);
$totalRows_tourDetails = mysql_num_rows($tourDetails);

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
$query_perfImages = sprintf("SELECT * FROM galleryBin, rhr_users WHERE galleryBin.posterID = rhr_users.external_user_id AND galleryBin.external_show_id = %s", $colname_showDetails);
$perfImages = mysql_query($query_perfImages, $random_connect) or die(mysql_error());
$row_perfImages = mysql_fetch_assoc($perfImages);
$totalRows_perfImages = mysql_num_rows($perfImages);
*/

mysql_select_db($database_random_connect, $random_connect);
$query_setlistDetails = sprintf("SELECT rhr_livetracks.external_show_id, rhr_livetracks.songNumber, rhr_titleresolver.song_name_display, rhr_titleresolver.external_song_id, rhr_livetracks.encore_level, rhr_songversionresolver.songversion_name_display, rhr_livetracks.nonstandard_track, rhr_groupresolver.external_group_id AS songauthor_external_id, rhr_groupresolver.group_name_display AS songauthor_name_display    
								FROM rhr_livetracks, rhr_titleresolver, rhr_songversionresolver, rhr_groupresolver  
								WHERE rhr_titleresolver.external_song_id = rhr_livetracks.external_song_id 
								AND rhr_livetracks.external_songversion_id = rhr_songversionresolver.external_songversion_id 
								AND rhr_livetracks.external_show_id = %s 
								AND rhr_titleresolver.external_group_id = rhr_groupresolver.external_group_id 
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
$query_showComments = sprintf("SELECT external_comment_id, comment_text, comment_author, external_commenttopic_id, UNIX_TIMESTAMP(comment_submit_time) AS date FROM rhr_comments WHERE external_commenttopic_id = %s AND comment_active=1 ORDER BY date DESC", GetSQLValueString($colname_showComments,"text"));
if(($showAllComments==1)&&(isset($showAllComments))) $query_limit_showComments = $query_showComments;
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
$query_next_details = sprintf("SELECT external_show_id,showDate,showactive FROM rhr_performances WHERE showDate > %s AND external_group_id = %s ORDER BY showDate ASC LIMIT 1" ,GetSQLValueString($targetShow,"text"), GetSQLValueString($INTERNAL_SITEGROUP,"text"));
$nextShow = mysql_query($query_next_details, $random_connect) or die(mysql_error());
$row_nextShow = mysql_fetch_assoc($nextShow);
$totalRows_nextShow = mysql_num_rows($nextShow);

$targetPrevShow=$targetShow;
//mysql_select_db($database_random_connect, $random_connect);

$query_prev_details = sprintf("SELECT external_show_id, showDate, showactive FROM rhr_performances WHERE showDate < %s AND external_group_id = %s ORDER BY showDate DESC LIMIT 1",GetSQLValueString($targetPrevShow,"text"), GetSQLValueString($INTERNAL_SITEGROUP,"text"));

$prevShow = mysql_query($query_prev_details, $random_connect) or die(mysql_error());
$row_prevShow = mysql_fetch_assoc($prevShow);
$totalRows_prevShow = mysql_num_rows($prevShow);


$query_oldid = sprintf("SELECT legacy_show_id FROM rhr_performances WHERE external_show_id =  %s" ,GetSQLValueString($_GET['external_show_id'],"text"));
$oldid = mysql_query($query_oldid, $random_connect) or die(mysql_error());
$row_oldid = mysql_fetch_assoc($oldid);


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




$colname2_attendedShow = "0";
if (isset($local_user_id)) {
  $colname2_attendedShow = (get_magic_quotes_gpc()) ? $local_user_id : addslashes($local_user_id);
}
$colname_attendedShow = "1";
if (isset($_GET['external_show_id'])) {
  $colname_attendedShow = (get_magic_quotes_gpc()) ? $_GET['external_show_id'] : addslashes($_GET['external_show_id']);
}
//mysql_select_db($database_random_connect, $random_connect);
$query_attendedShow = sprintf("SELECT external_user_id, external_show_id FROM rhr_usershows WHERE external_show_id = %s AND external_user_id = %s", GetSQLValueString($colname_attendedShow,"text"),GetSQLValueString($colname2_attendedShow,"text"));
$attendedShow = mysql_query($query_attendedShow, $random_connect) or die(mysql_error());
$row_attendedShow = mysql_fetch_assoc($attendedShow);
$totalRows_attendedShow = mysql_num_rows($attendedShow);

$colname_attendingMembers = "0";
if (isset($_GET['external_show_id'])) {
  $colname_attendingMembers = (get_magic_quotes_gpc()) ? $_GET['external_show_id'] : addslashes($_GET['external_show_id']);
}
//mysql_select_db($database_random_connect, $random_connect);
$query_attendingMembers = sprintf("SELECT rhr_usershows.external_user_id, rhr_usershows.external_show_id, rhr_users.pn_uname FROM rhr_usershows, rhr_users WHERE rhr_usershows.external_show_id = %s AND rhr_users.external_user_id = rhr_usershows.external_user_id ORDER BY external_user_id ASC", GetSQLValueString($colname_attendingMembers,"text"));
$attendingMembers = mysql_query($query_attendingMembers, $random_connect) or die(mysql_error());
$row_attendingMembers = mysql_fetch_assoc($attendingMembers);
$totalRows_attendingMembers = mysql_num_rows($attendingMembers);
/*
$query_availableAds0 = "SELECT code FROM adqueue WHERE adqueue.group='1' AND active = '1' AND height = '125' AND width = '125' ORDER BY id";
$availableAds0 = mysql_query($query_availableAds0, $random_connect) or die(mysql_error());
$row_availableAds0 = mysql_fetch_assoc($availableAds0);
$totalRows_availableAds0 = mysql_num_rows($availableAds0);
*/
?>
<!DOCTYPE html>
<html>
<head>
<title>58hours.com | Radiohead setlist for <?php 
date_default_timezone_set ("America/New_York");
echo date('l, F d, Y',strtotime($row_showDetails['showDate'])); ?> (<?php 
	if($row_eventDetails['event_name_display']=="(normal)")
		{
			echo $row_showDetails['venue_name_display'];
		}
		else
		{
			echo $row_eventDetails['event_name_display']." - ".$row_showDetails['venue_name_display'];
		}
		//echo " ".$testvar;
		?>)</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<meta http-equiv="expires" content="0" />
<meta name="robots" content="index, follow" />
<meta name="author" content="Brian Kiel" />
<meta name="publisher" content="Invalid Sequence Labs" />
<meta name="copyright" content="brian kiel" />
<meta name="page-topic" content="Radiohead concert setlist for <? 
date_default_timezone_set ("America/New_York");
echo date('l, F d, Y',strtotime($row_showDetails['showDate'])); ?> (<?php echo $row_showDetails['venue_name_display'];?>)" />
<meta name="description" content="The setlist, photos, images, reviews and comments for Radiohead's show at <?php echo $row_showDetails['venue_name_display'];?> in <? echo $row_showDetails['city_name_display']; ?>, <? echo $row_showDetails['country_name_display']; ?> on <? 
date_default_timezone_set ("America/New_York");
echo date('l, F d, Y',strtotime($row_showDetails['showDate'])); ?> with the ability to crossreference songs & see what songs Radiohead are playing, the history of what they've already played, and what they might play, all searchable on multiple variables." />
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

<body bgcolor="#000000" text="#FFFFFF" link="#0066CC" vlink="#0066CC" alink="#0066CC">
<div id="main_wrapper">
<!--<table width="800" height="850" border="0" align="center" cellpadding="0" cellspacing="0">-->

<script type="text/javascript"><!--
google_ad_client = "pub-4681937497066114";
/* 728x90, created 8/14/08 */
google_ad_slot = "2300195665";
google_ad_width = 728;
google_ad_height = 90;
//-->
</script>
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script type="text/javascript"
src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>
<a href="/"><img src="/i/rainbowheader_v2.jpg" width="800" height="114" border="0"></a>
<div id="main_content">


<div class="showdetails_header">
				<div class="floatleft">
					<div id="breadanchor_light">
						<a href="browse.php?external_country_id=<?php echo $row_showDetails['external_country_id']; ?>" class="linkageStuff">&raquo; <?php 
					echo $row_showDetails['country_name_display']; 
					?></a> <a href="browse.php?external_locale_id=<?php 
					echo $row_showDetails['external_locale_id']; 
					?>" class="linkageStuff">&raquo; <?php 
					echo fixEncoding($row_showDetails['locale_name_display']); 
					?> </a> <a href="browse.php?external_city_id=<?php 
					echo $row_showDetails['external_city_id']; 
					?>" class="linkageStuff">&raquo; <?php 
					echo $row_showDetails['city_name_display']; 
					?> </a> <a href="browse.php?external_venue_id=<?php 
					echo $row_showDetails['external_venue_id']; 
					?>" class="linkageStuff">&raquo; <?php 
					echo $row_showDetails['venue_name_display']; 
					?></a><? 
					if(isset($row_showDetails['showEventName']))
					{
						if(strlen($row_showDetails['showEventName'])>0&&($row_showDetails['showEventName']!='concert'))
						{
							echo ' <span class="linkageStuff">&raquo; '.$row_showDetails['showEventName']."</span>";
						}
					}
					//if(strlen($row_showDetails['showEventName'])>0&&($row_showDetails['showEventName']!='concert'))
					//{
					//	echo ' <span class="linkageStuff">&raquo; '.$row_showDetails['showEventName']."</span>";
					//} 
					?>
					</div>
					<? if($totalRows_tourDetails>0) { ?><div><a href="/tour_details.php?tour=<? echo $row_tourDetails['external_tour_id'].'">'.$row_tourDetails['tour_name_display']; ?></a></div><? } ?>
				</div>
				<div class="floatright">
					<span class="linkageStuff">Browse by: <a href="index.php?browse=showDate" class="linkageStuff">date</a></span><span class="linkageStuff"> | <a href="index.php?browse=showVenue" class="linkageStuff">venue</a>  | <a href="index.php?browse=songTitle" class="linkageStuff">song title</a></span>
				</div>
			</div>
<div id="show_navigator">
<?php 
				  	if ($totalRows_prevShow != 0) 
				  	{ // Show if recordset empty 
				  		?><a href="showdetails.php?external_show_id=<?php 
				  		echo $row_prevShow['external_show_id'];
						?>"><img src="images/bt_previous.gif" alt="Previous Show" width="58" height="13" border="0"></a><?php 
				  	} 
					else echo $targetShow;
				  	/*else if ($totalRows_prevShow == 0) 
					{ // Show if recordset empty 
						?>NO PREVIOUS SHOWS<?php 
					} */
					?>
                  	<?php 
				 	if ($totalRows_nextShow != 0) 
					{ // Show if recordset empty 
				  		?><a href="showdetails.php?external_show_id=<?php 
				  		echo $row_nextShow['external_show_id'];
				  		?>"><img src="images/bt_next.gif" alt="Next Show" width="58" height="13" border="0" /></a><?php
				  	}
				  ?>

</div>
<div id="show_digest">
			<div class="venue_header">
    	<? if($row_eventDetails['event_name_display']=="(normal)")
		{
			echo $row_showDetails['venue_name_display']; 
		}
		else
		{
			echo $row_eventDetails['event_name_display'];
		}
		?></div><? 
      if(isset($venueHasNewName))
      {
      	if($venueHasNewName)
	  	{
	  		echo "<br>Venue currently known as ".$row_showDetails['current_venue_name'];
	  	}
	  } 
              date_default_timezone_set ("America/New_York");
              echo date('l, F d, Y',strtotime($row_showDetails['showDate'])); ?>
			  <?php 
			  		if (($row_nextShow['showactive']=='0')&& $row_showDetails['showactive']=='1') 
					{ // Show if recordset empty 
						?><br />THIS IS THE MOST RECENT SHOW<br><?php 
					} 
					?>
					</div>
              <div id="setlist_area">
              <div class="setlist_divider">Setlist</div>
                      <?php $recordCounter = 0; 
					  		$myPtr = 1;
							$encLevel = "0"; ?>
							<ul class="setlist-list">
                      <?php do { 
                        
                        //else echo $row_setlistDetails['songNumber']."."; 
                         if($totalRows_setlistDetails>0) {
								  if($encLevel!=$row_setlistDetails['encore_level'])
								  {
									  $encLevel = $row_setlistDetails['encore_level'];
									  echo '</ul><div class="setlist_divider">Encore '.$encLevel.'</div><ul class="setlist-list">';
									  //echo '<img src="images/setlistheaderenc'.$encLevel.'a.gif" />';
								  }
								  if($row_setlistDetails['nonstandard_track']>0)
								  {
								  echo "<li class='setlist_item'>+ ";
								  }
								  else
								  {
								  	if($row_setlistDetails['songNumber']==0) 
								  	{
								  		echo "<li class='setlist_item'>intro: ";
								  	}
								  	else
								  	{
									  	echo "<li class='setlist_item'>".$myPtr++.".";
									}
								  }
								  ?>
                              <a href="songdetails.php?external_song_id=<?php echo $row_setlistDetails['external_song_id']; ?>" class="linkageStuff"><?php echo $row_setlistDetails['song_name_display']; ?></a> <? 
                              if($row_setlistDetails['nonstandard_track']=="1")
								{ ?> (snippet)<? 
								}
								else if($row_setlistDetails['nonstandard_track']=="3")
								{
								?> (aborted)<? 
								}
								else if($row_setlistDetails['nonstandard_track']=="10")
								{
								?> (prerecorded)<?
								}
								  if($INTERNAL_SITEGROUP!=$row_setlistDetails['songauthor_external_id'])
								  {
								  	echo "<br>(".$row_setlistDetails['songauthor_name_display']." cover)";
								  }
								  ?>
                              <?php 
                              echo "</li>";
                              }else{?>
                              <a href="#" class="linkageStuff" onClick="MM_openBrWindow('post_comments.php?external_show_id=<?php echo $row_showDetails['external_show_id']; ?>','postit','status=yes,width=450,height=500')">none yet... click here to add.</a>
                              <?php } ?>
                              
                        <?php } while ($row_setlistDetails = mysql_fetch_assoc($setlistDetails)); ?>
                     </ul>
              
              <br>
			  <br>  
			  58HOURS MEMBERS AT THIS SHOW: <? echo $totalRows_attendingMembers; ?><br />
              <?php do { ?>
                      <?php echo $row_attendingMembers['pn_uname']; ?><?php if ($totalRows_attendingMembers > 1) {?>,<?php }?>
                      <?php } while ($row_attendingMembers = mysql_fetch_assoc($attendingMembers)); ?>
                      <br /><br /><?php if ($totalRows_attendedShow > 0) { // Show if recordset not empty ?>
                      You were at this show <a href="user_shows.php">[remove]</a><br /><a href="user_shows.php">View Your Personal Show Details</a><?php } ?>
                      <?php if (($totalRows_memberName > 0)&&($totalRows_attendedShow <= 0)) { // Show if recordset not empty ?>
                      <form action="<?php echo $editFormAction; ?>" method="post" name="claimShow" id="claimShow">
                        <input name="external_show_id" type="hidden" value="<?php echo $_GET['external_show_id']; ?>" />
                        <input name="external_user_id" type="hidden" value="<?php echo $_COOKIE['client_id_hash']; ?>" />
                        <a href="#" class="linkageStuff" onClick="javascript:document.claimShow.submit();"><img src="/i/claimshow.jpg" alt="add me to the list of members at this show" width="127" height="22" border="0" /></a>
                        <input type="hidden" name="MM_insert" value="claimShow" />
                      </form>
                      <?php } // Show if recordset not empty ?>
                <br /><br /><!-- Place this tag where you want the +1 button to render -->
<g:plusone size="medium"></g:plusone>

<!-- Place this render call where appropriate -->
<script type="text/javascript">
  (function() {
    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
    po.src = 'https://apis.google.com/js/plusone.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
  })();
</script><br /><br />
              <br />
              
  <br /></div>
  <div id="show_meta_area">
  <img src="images/showimages-wide.gif" width="450" height="13" />
                            <div align="center">
                              <br />
                            </div>
                    
                    <img src="images/showreviews-wide.gif" width="450" height="13" />
                    <div id="reviews_area">
                    <?php if ($totalRows_showComments == 0) { // Show if recordset empty ?>
                        &nbsp;none currently posted.
                        <?php } // Show if recordset empty ?>
                        <br />
                        <?php if ($totalRows_showComments > 0) { // Show if recordset empty ?>
                        <?php 
      do { ?>
                        <?php echo $row_showComments['comment_text']; ?><br />
                      <br />
                              submitted by: <b> <?php echo $row_showComments['comment_author']; ?> </b> <br />
                              <i><?php echo date('g:i A',$row_showComments['date']); ?> [US Pacific time], <?php echo date('l, F d, Y',$row_showComments['date']); ?> </i><br />
                              <hr />
                              <br />
                              <?php } while ($row_showComments = mysql_fetch_assoc($showComments)); ?>
                        <?php } // Show if recordset empty ?>
                          <!-- <a href="#" class="linkageStuff" onclick="MM_openBrWindow('post_comments.php?external_show_id=<?php echo $row_showDetails['external_show_id']; ?>','postit','status=yes,width=450,height=350')"><em>[click
                        to add a comment for this show]</em> </a><br />
                        <br /> -->
                          <!--<a href="#" class="linkageStuff" onclick="MM_openBrWindow('post_comments.php?external_show_id=<?php echo $row_showDetails['external_show_id']; ?>','postit','status=yes,width=450,height=350')"><em>[click
                        to add a review for this show]</em> </a> <br />
                        <br /> -->
                        
                        <a href="#" class="linkageStuff" onclick="MM_openBrWindow('post_comments.php?external_show_id=<?php echo $row_showDetails['external_show_id']; ?>','postit','status=yes,width=450,height=500')"><img src="images/addcomments.gif" alt="add comment" width="130" height="13" vspace="5" border="0" /></a>
                      <? if($showAllComments!='1') {?><a href="<?=$_SERVER['REQUEST_URI']?>&amp;allComments=1" class="linkageStuff"><img src="images/viewothercomments.gif" alt="View Comments" width="119" height="13" vspace="5" border="0" /></a><? } ?>
                      
            <br>
            </div>
        </div>
</div>
 <?php if($totalRows_setlistDetails>0) { ?>
<div id="righthand_skyscraper">
<script type="text/javascript"><!--
google_ad_client = "pub-4681937497066114";
/* 160x600 legacy */
google_ad_slot = "6064828356";
google_ad_width = 160;
google_ad_height = 600;
//-->
</script>
<script type="text/javascript" src="http://pagead2.googlesyndication.com/pagead/show_ads.js"></script>
</div>
<? } ?>
<div id="disclaimer_footer">
	<?php require_once('58ss_includes/58disclaimer.php'); ?>
</div>



</div>

</body>
</html>
<?php
mysql_free_result($showDetails);
//
// mysql_free_result($tourDetails);
//
mysql_free_result($setlistDetails);

mysql_free_result($showComments);

mysql_free_result($memberName);

mysql_free_result($attendedShow);

mysql_free_result($attendingMembers);

//mysql_free_result($perfImages);

?>
