<?php 
//require_once('Connections/radioRecords.php'); 
require_once('Connections/random_connect.php');
require_once('_includes/SITEARTIST.php');
require_once('_includes/rhcommon.php');


if(empty($_GET['tour'])&&empty($_GET['tourgroup'])) header("location: index.php");

$myTour = $_GET['tour'];
$myTourGroup = $_GET['tourgroup'];

if(!empty($myTour))
{
	$colname_justtour_name_display = "1";
	if (isset($_GET['tour'])) {
  		$colname_justtour_name_display = (get_magic_quotes_gpc()) ? $_GET['tour'] : addslashes($_GET['tour']);
	}
	$query_justtour_name_display = sprintf("SELECT rhr_tourresolver.tour_name_display, rhr_tourresolver.external_tour_id, rhr_tourresolver.prior_tour_id 
	FROM rhr_performances, rhr_tourresolver 
	WHERE rhr_performances.external_tour_id = rhr_tourresolver.external_tour_id 
	AND rhr_tourresolver.external_tour_id = %s", GetSQLValueString($colname_justtour_name_display,'text'));
	$justtour_name_display = mysql_query($query_justtour_name_display, $random_connect) or die(mysql_error());
	$row_justtour_name_display = mysql_fetch_assoc($justtour_name_display);
	$totalRows_justtour_name_display = mysql_num_rows($justtour_name_display);



	$colname_tourDetails = "1";
	if (isset($_GET['tour'])) {
  		$colname_tourDetails = (get_magic_quotes_gpc()) ? $_GET['tour'] : addslashes($_GET['tour']);
	}
	$query_tourDetails = sprintf("SELECT rhr_tourresolver.tour_name_display, rhr_tourresolver.prior_tour_id, rhr_countryresolver.country_name_display, rhr_countryresolver.external_country_id, rhr_localityresolver.locale_name_display, rhr_localityresolver.external_locale_id, rhr_cityresolver.city_name_display, rhr_cityresolver.city_name_display, rhr_venueresolver.venue_name_display, rhr_performances.external_show_id, rhr_venueresolver.external_venue_id, rhr_performances.showDate FROM rhr_performances, rhr_tourresolver, rhr_venueresolver, rhr_cityresolver, rhr_localityresolver, rhr_countryresolver WHERE rhr_cityresolver.external_locale_id = rhr_localityresolver.external_locale_id AND rhr_localityresolver.external_country_id = rhr_countryresolver.external_country_id AND rhr_venueresolver.external_city_id = rhr_cityresolver.external_city_id AND rhr_venueresolver.external_venue_id = rhr_performances.external_venue_id AND rhr_performances.external_tour_id = rhr_tourresolver.external_tour_id AND rhr_tourresolver.external_tour_id = %s ORDER BY rhr_performances.showDate DESC", GetSQLValueString($colname_tourDetails,'text'));
	$tourDetails = mysql_query($query_tourDetails, $random_connect) or die(mysql_error());
	//$row_tourDetails = mysql_fetch_assoc($tourDetails);
	$totalRows_tourDetails = mysql_num_rows($tourDetails);


	$colname_tourtuneDetails = "1";
	if (isset($_GET['tour'])) {
  		$colname_tourtuneDetails = (get_magic_quotes_gpc()) ? $_GET['tour'] : addslashes($_GET['tour']);
	}
	
	$query_tourtuneDetails = sprintf("SELECT rhr_titleresolver.external_song_id, COUNT(*) AS perfTimes, rhr_titleresolver.song_name_display 
	FROM rhr_performances, rhr_livetracks, rhr_titleresolver, rhr_tourresolver WHERE rhr_livetracks.external_show_id = rhr_performances.external_show_id 
	AND rhr_titleresolver.external_song_id = rhr_livetracks.external_song_id 
	AND rhr_performances.external_tour_id = rhr_tourresolver.external_tour_id 
	AND rhr_tourresolver.external_tour_id = %s 
	AND (rhr_livetracks.nonstandard_track = '0' OR rhr_livetracks.nonstandard_track = '2')
	GROUP BY rhr_titleresolver.external_song_id 
	ORDER BY perfTimes DESC", GetSQLValueString($colname_tourtuneDetails,'text'));
	$tourtuneDetails = mysql_query($query_tourtuneDetails, $random_connect) or die(mysql_error());
	//$row_tourtuneDetails = mysql_fetch_assoc($tourtuneDetails);
	$totalRows_tourtuneDetails = mysql_num_rows($tourtuneDetails);

	$query_tourteaseDetails = sprintf("SELECT rhr_titleresolver.external_song_id, COUNT(*) AS perfTimes, rhr_titleresolver.song_name_display 
	FROM rhr_performances, rhr_livetracks, rhr_titleresolver, rhr_tourresolver 
	WHERE rhr_livetracks.external_show_id = rhr_performances.external_show_id 
	AND rhr_titleresolver.external_song_id = rhr_livetracks.external_song_id 
	AND rhr_performances.external_tour_id = rhr_tourresolver.external_tour_id 
	AND rhr_tourresolver.external_tour_id = %s
	AND rhr_livetracks.nonstandard_track = '1'
	GROUP BY rhr_titleresolver.external_song_id 
	ORDER BY perfTimes DESC", GetSQLValueString($colname_tourtuneDetails,'text'));
	$tourteaseDetails = mysql_query($query_tourteaseDetails, $random_connect) or die(mysql_error());
	//$row_tourtuneDetails = mysql_fetch_assoc($tourtuneDetails);
	$totalRows_tourteaseDetails = mysql_num_rows($tourteaseDetails);


	$colname_tourmemberDetails = "1";
	if (isset($_GET['tour'])) {
  		$colname_tourmemberDetails = (get_magic_quotes_gpc()) ? $_GET['tour'] : addslashes($_GET['tour']);
	}


	$colname_tourmemberDetails = "1";
	if (isset($_GET['tour'])) {
  		$colname_tourmemberDetails = (get_magic_quotes_gpc()) ? $_GET['tour'] : addslashes($_GET['tour']);
	}
	
	
	
	$query_tourmemberDetails = sprintf("SELECT rhr_tourresolver.tour_name_display, rhr_countryresolver.country_name_display, rhr_countryresolver.external_country_id, rhr_localityresolver.locale_name_display, rhr_localityresolver.external_locale_id, rhr_cityresolver.city_name_display, rhr_cityresolver.city_name_display, rhr_venueresolver.venue_name_display, rhr_performances.external_show_id, rhr_venueresolver.external_venue_id, rhr_performances.showDate FROM rhr_performances, rhr_tourresolver, rhr_venueresolver, rhr_cityresolver, rhr_localityresolver, rhr_countryresolver WHERE rhr_cityresolver.external_locale_id = rhr_localityresolver.external_locale_id AND rhr_localityresolver.external_country_id = rhr_countryresolver.external_country_id AND rhr_venueresolver.external_city_id = rhr_cityresolver.external_city_id AND rhr_venueresolver.external_venue_id = rhr_performances.external_venue_id AND rhr_performances.external_tour_id = rhr_tourresolver.external_tour_id AND rhr_performances.external_tour_id = %s", GetSQLValueString($colname_tourmemberDetails,'text'));
	$tourmemberDetails = mysql_query($query_tourmemberDetails, $random_connect) or die(mysql_error());
	//$row_tourmemberDetails = mysql_fetch_assoc($tourmemberDetails);
	$totalRows_tourmemberDetails = mysql_num_rows($tourmemberDetails);

	$colname_showOpeners = "1";
	if (isset($_GET['tour'])) {
  		$colname_selectedTour = (get_magic_quotes_gpc()) ? $_GET['tour'] : addslashes($_GET['tour']);
	}
	$query_showOpeners = sprintf("SELECT rhr_livetracks.external_song_id, COUNT(rhr_livetracks.external_song_id) AS numTimes, rhr_titleresolver.song_name_display FROM rhr_performances, rhr_tourresolver, rhr_livetracks, rhr_titleresolver 
	WHERE rhr_performances.external_tour_id = rhr_tourresolver.external_tour_id AND rhr_performances.external_show_id = rhr_livetracks.external_show_id AND rhr_livetracks.songNumber = %s AND rhr_performances.external_tour_id = %s AND rhr_livetracks.external_song_id = rhr_titleresolver.external_song_id 
	GROUP BY rhr_livetracks.external_song_id ORDER BY rhr_titleresolver.song_name_display", GetSQLValueString($colname_showOpeners,'text'), GetSQLValueString($colname_selectedTour,'text'));
	$showOpeners = mysql_query($query_showOpeners, $random_connect) or die(mysql_error());
	//$row_tourmemberDetails = mysql_fetch_assoc($tourmemberDetails);
	$totalRows_showOpeners = mysql_num_rows($showOpeners);

/*
THIS WON'T WORK RIGHT NOW...
	$query_showClosers = sprintf("SELECT rhr_livetracks.external_song_id, COUNT(showclosers.song_id) AS numTimes, rhr_titleresolver.song_name_display FROM showclosers, rhr_performances, rhr_livetracks, rhr_titleresolver 
WHERE rhr_performances.external_show_id = showclosers.show_id
AND rhr_performances.external_show_id = rhr_livetracks.external_show_id 
AND rhr_livetracks.external_song_id = showclosers.song_id 
AND rhr_performances.external_tour_id = %s 
AND rhr_livetracks.external_song_id = rhr_titleresolver.external_song_id 
GROUP BY rhr_livetracks.external_song_id 
ORDER BY rhr_titleresolver.song_name_display", $colname_selectedTour);
	$showClosers = mysql_query($query_showClosers, $random_connect) or die(mysql_error());
	//$row_tourmemberDetails = mysql_fetch_assoc($tourmemberDetails);
	$totalRows_showClosers = mysql_num_rows($showClosers);
	*/
	
	/*
	$query_tourAlbums = sprintf("SELECT albumdb.radioID , albumdb.ReleaseTitle, COUNT(rhr_livetracks.external_song_id) AS numTimes 
FROM studiotrack_db, rhr_performances, rhr_livetracks, rhr_titleresolver, albumdb 
WHERE studiotrack_db.trackResID = rhr_livetracks.external_song_id 
AND studiotrack_db.releaseID = albumdb.radioID 
AND rhr_performances.external_show_id = rhr_livetracks.external_show_id 
AND albumdb.primeRelease = '1' 
AND rhr_performances.external_tour_id = '%s'
AND rhr_livetracks.external_song_id = rhr_titleresolver.external_song_id 
GROUP BY albumdb.radioID 
ORDER BY albumdb.ReleaseTitle", $colname_selectedTour);
$tourAlbums = mysql_query($query_tourAlbums, $random_connect) or die(mysql_error());
$row_tourAlbums = mysql_fetch_assoc($tourAlbums);
$totalRows_tourAlbums = mysql_num_rows($tourAlbums);
	*/
}



//showOpeners



?>
<?php echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?".">"; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>58hours.com | Statistics for Radiohead's <?php 
if(!empty($myTour))
{
	echo $row_justtour_name_display['tour_name_display'];
}
elseif(!empty($myTourGroup))
{
	echo " full ".$row_justtour_name_display['groupName'];
} ?> tour.</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
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
.primaryStyle {
	color: #FFFFFF;
	font-family: Arial, Helvetica, sans-serif;
	font-size: 10px;
	text-decoration: none;
	a:link {text-decoration: none};
	a:visited {text-decoration: none};
	a:active {text-decoration: none};
	a:hover {text-decoration: underline; color: white;};
}
.style4 {color: #666666; text-decoration: none; font-family: Arial, Helvetica, sans-serif;}
#cusomizeTourLayer {
	position:absolute;
	width:300px;
	height:200px;
	z-index:1;
	background-color: #333333;
	left: 16px;
	top: 264px;
}
-->
</style>
<script src="Scripts/AC_RunActiveContent.js" type="text/javascript"></script>
<script type="text/javascript">
<!--
function MM_reloadPage(init) {  //reloads the window if Nav4 resized
  if (init==true) with (navigator) {if ((appName=="Netscape")&&(parseInt(appVersion)==4)) {
    document.MM_pgW=innerWidth; document.MM_pgH=innerHeight; onresize=MM_reloadPage; }}
  else if (innerWidth!=document.MM_pgW || innerHeight!=document.MM_pgH) location.reload();
}
MM_reloadPage(true);
//-->
</script>
</head>

<body bgcolor="#000000" text="#FFFFFF" link="#0066CC" vlink="#0066CC" alink="#0066CC" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" class="blueishlinks">
<? 
?>
<div id="maincontent">
<br />
<table width="800" border="0" align="center" cellpadding="1" cellspacing="1" bgcolor="#000000">
  <tr>
    <td>
		<table width="800" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#000000">
    		<tr>
      			<td width="800" colspan="2" bgcolor="#000000" class="darkerLinkage"><a href="/"><img src="/i/rainbowheader_v2.jpg" height="114" width="800" border="0"></a></td>
    		</tr>
    		<tr>
      			<td colspan="2" bgcolor="#000000">
      				<table border="0" cellspacing="0" cellpadding="1">
          				<tr> 
           				  <td height="72" valign="top">
            					
<script type="text/javascript">
AC_FL_RunContent( 'codebase','http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0','width','800','height','30','src','flash_elements/nameclip_full?name=Tour%20Details','quality','high','pluginspage','http://www.macromedia.com/go/getflashplayer','wmode','transparent','movie','flash_elements/nameclip_full?name=Tour%20Details' ); //end AC code
</script><noscript><object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0" width="800" height="30">
			<param name="wmode" value="transparent" />
              <param name="movie" value="flash_elements/nameclip_full.swf?name=Tour%20Details" />
              <param name="quality" value="high" />
              <embed src="flash_elements/nameclip_full.swf?name=Tour%20Details" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="800" height="30" wmode="transparent"></embed>
            </object></noscript>
			<script type="text/javascript">
AC_FL_RunContent( 'codebase','http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0','width','800','height','30','src','flash_elements/nameclip_full?name=<?php echo urlencode($row_justtour_name_display['tour_name_display']); ?>','quality','high','pluginspage','http://www.macromedia.com/go/getflashplayer','wmode','transparent','movie','flash_elements/nameclip_full?name=<?php echo urlencode($row_justtour_name_display['tour_name_display']); ?>' ); //end AC code
</script><noscript><object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0" width="800" height="30">
              <param name="movie" value="flash_elements/nameclip_full.swf?name=<?php echo urlencode($row_justtour_name_display['tour_name_display']); ?>" />
              <param name="quality" value="high" />
			<param name="wmode" value="transparent">
              <embed src="flash_elements/nameclip_full.swf?name=<?php echo urlencode($row_justtour_name_display['tour_name_display']); ?>" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="800" height="30" wmode="transparent"></embed>
            </object></noscript>
<br />
              <br />
              <?
			if($row_justtour_name_display['prior_tour_id']>0)
			{?>
              <br />
              <a href="tour_details.php?tour=<? echo $row_justtour_name_display['prior_tour_id'];?>" border="0"><img src="images/bt_previous.gif" alt="previous tour" width="58" height="13" border="0"/></a>
			  <br><?
			  }  
			  ?>
			  <table width="600" border="0" cellspacing="1" cellpadding="1">
                <tr>
                  <td width="200"></td>
                </tr>
                <tr>
                	<td width="200" valign="top" nowrap="nowrap" class="primaryStyle"><h3>Shows on this
                	    tour:</h3>
                	  <h1> <? echo $totalRows_tourDetails; ?></h1><br />
                		<? 
                		while($tourRow = mysql_fetch_assoc($tourDetails))
                		{
                			echo "<a href='./showdetails.php?external_show_id=".$tourRow['external_show_id']."'>&#187;</a> ".$tourRow['showDate']."<br>";
                			echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$tourRow['venue_name_display']."<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(".$tourRow['city_name_display']." -  ".$tourRow['country_name_display'].")<br><br>";
                		} 
                		?>                	</td>
                	<td width="200" valign="top" nowrap="nowrap" class="primaryStyle">
                	<h3>Full songs on this tour:</h3>
                	  <h1><? echo $totalRows_tourtuneDetails; ?></h1><br />(sorted by frequency)<br /><br />
                		<? 
                		while($tourRow = mysql_fetch_assoc($tourtuneDetails))
                		{
                			echo "<a href='./songdetails.php?external_song_id=".$tourRow['external_song_id']."'>&#187;</a> ".$tourRow['song_name_display']." (".$tourRow['perfTimes']."/".$totalRows_tourDetails.") <span><font color='#666666'>(".round(($tourRow['perfTimes']/$totalRows_tourDetails)*100)."%)</font></span> <br>";
                		} 
                		?><h3>Songs teased on this tour:</h3>
                	  <h1><? echo $totalRows_tourteaseDetails; ?></h1><br />(sorted by frequency)<br /><br />
                		<? 
                		while($tourRow = mysql_fetch_assoc($tourteaseDetails))
                		{
                			echo "<a href='./songdetails.php?external_song_id=".$tourRow['external_song_id']."'>&#187;</a> ".$tourRow['song_name_display']." (".$tourRow['perfTimes']."/".$totalRows_tourDetails.") <span><font color='#666666'>(".round(($tourRow['perfTimes']/$totalRows_tourDetails)*100)."%)</font></span> <br>";
                		} 
                		?>                	</td>
					<td width="200" valign="top" nowrap="nowrap" class="primaryStyle"><h3>Openers:</h3><h1><? echo $totalRows_showOpeners; ?></h1>
                		<? 
                		while($tourRow = mysql_fetch_assoc($showOpeners))
                		{
							if(!empty($myTour))
							{
                				echo "<a href='./songdetails.php?external_song_id=".$tourRow['external_song_id']."'>&#187;</a> ".$tourRow['song_name_display']." (".$tourRow['numTimes'].")<br />";
							}
							elseif(!empty($myTourGroup))
							{
								echo "<a href='./songdetails.php?external_song_id=".$tourRow['external_song_id']."'>&#187;</a> ".$tourRow['song_name_display']." (".$tourRow['numTimes'].")<br />";
							}
                		} 
                		?><br />                	
                		<h3>Closers:</h3>
                		<h1><? echo $totalRows_showClosers; ?></h1>
                        <? 
                		while($tourRow = mysql_fetch_assoc($showClosers))
                		{
                			echo "<a href='./songdetails.php?external_song_id=".$tourRow['external_song_id']."'>&#187;</a> ".$tourRow['song_name_display']." (".$tourRow['numTimes'].")<br />";
                		} 
                		?></td>
                    <td width="100" valign="top" class="primaryStyle"><script type="text/javascript">
AC_FL_RunContent( 'codebase','http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,19,0','width','250','height','400','src','flash_elements/tourPie','quality','high','pluginspage','http://www.macromedia.com/go/getflashplayer','movie','flash_elements/tourPie','flashVars','<? 
	$vals = "releaseVals=";
	$labels = "releaseNames=";
/*
	do
	{
		$labels = $labels.$row_tourAlbums['ReleaseTitle'].",";
		$vals = $vals.$row_tourAlbums['numTimes'].",";
	}while($row_tourAlbums = mysql_fetch_assoc($tourAlbums)); 
echo substr($vals,0,(strlen($vals)-1))."&".substr($labels,0,(strlen($labels)-1));
*/
?>' ); //end AC code
</script><noscript><object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,19,0" width="250" height="400">
                      <param name="movie" value="flash_elements/tourPie.swf" />
                      <param name="quality" value="high" />
                      <embed src="flash_elements/tourPie.swf" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="250" height="400"></embed>
                    </object></noscript></td>
                </tr>
              </table>
              
              <p>&nbsp;</p>
       				  </tr>
            </table></td>
          </tr>
  </table>
  </td>
  </tr>
    <tr bgcolor="#000000"><td colspan="2"><font color="#FFFFFF"><?php require_once('58ss_includes/58disclaimer.php'); ?></font></td></tr>
</table>
	</td>
  </tr>
</table>

</div>
</body>
</html>
<?php
mysql_free_result($justtour_name_display);
mysql_free_result($tourDetails);
mysql_free_result($tourtuneDetails);
mysql_free_result($tourmemberDetails);


?>
