<?php require_once('Connections/radioRecords.php'); ?>
<?php

if(empty($_GET['tour'])&&empty($_GET['tourgroup'])) header("location: index.php");

function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  $theValue = (!get_magic_quotes_gpc()) ? addslashes($theValue) : $theValue;

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? "'" . doubleval($theValue) . "'" : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}

$myTour = $_GET['tour'];
$myTourGroup = $_GET['tourgroup'];

if(!empty($myTour))
{
$colname_justTourName = "1";
if (isset($_GET['tour'])) {
  $colname_justTourName = (get_magic_quotes_gpc()) ? $_GET['tour'] : addslashes($_GET['tour']);
}
mysql_select_db($database_radioRecords, $radioRecords);
$query_justTourName = sprintf("SELECT tourresolver.tourName, tourresolver.tourID, tourresolver.priorTour FROM showlist_db, tourresolver WHERE showlist_db.show_tour = tourresolver.tourID AND tourresolver.tourID = %s", $colname_justTourName);
$justTourName = mysql_query($query_justTourName, $radioRecords) or die(mysql_error());
$row_justTourName = mysql_fetch_assoc($justTourName);
$totalRows_justTourName = mysql_num_rows($justTourName);



$colname_tourDetails = "1";
if (isset($_GET['tour'])) {
  $colname_tourDetails = (get_magic_quotes_gpc()) ? $_GET['tour'] : addslashes($_GET['tour']);
}
mysql_select_db($database_radioRecords, $radioRecords);
$query_tourDetails = sprintf("SELECT tourresolver.tourName, tourresolver.priorTour, countryresolver.countryName, countryresolver.countryID, localityresolver.localityName, localityresolver.localityID, cityresolver.cityName, cityresolver.cityID, venuedetails.venueName, showlist_db.showID, venuedetails.venueID, showlist_db.showDate FROM showlist_db, tourresolver, venuedetails, cityresolver, localityresolver, countryresolver WHERE cityresolver.localityID = localityresolver.localityID AND localityresolver.countryID = countryresolver.countryID AND venuedetails.venueCity = cityresolver.cityID AND venuedetails.venueID = showlist_db.showVenueID AND showlist_db.show_tour = tourresolver.tourID AND tourresolver.tourID = %s ORDER BY showlist_db.showDate DESC", $colname_tourDetails);
$tourDetails = mysql_query($query_tourDetails, $radioRecords) or die(mysql_error());
//$row_tourDetails = mysql_fetch_assoc($tourDetails);
$totalRows_tourDetails = mysql_num_rows($tourDetails);


$colname_tourtuneDetails = "1";
if (isset($_GET['tour'])) {
  $colname_tourtuneDetails = (get_magic_quotes_gpc()) ? $_GET['tour'] : addslashes($_GET['tour']);
}
mysql_select_db($database_radioRecords, $radioRecords);
$query_tourtuneDetails = sprintf("SELECT titleresolver.trackID, COUNT(*) AS perfTimes, titleresolver.trackTitle FROM showlist_db, livetracks_db, titleresolver, tourresolver WHERE livetracks_db.showID = showlist_db.showID AND titleresolver.trackID = livetracks_db.trackID AND showlist_db.show_tour = tourresolver.tourID AND tourresolver.tourID = %s GROUP BY titleresolver.trackID ORDER BY perfTimes DESC", $colname_tourtuneDetails);
$tourtuneDetails = mysql_query($query_tourtuneDetails, $radioRecords) or die(mysql_error());
//$row_tourtuneDetails = mysql_fetch_assoc($tourtuneDetails);
$totalRows_tourtuneDetails = mysql_num_rows($tourtuneDetails);


$colname_tourmemberDetails = "1";
if (isset($_GET['tour'])) {
  $colname_tourmemberDetails = (get_magic_quotes_gpc()) ? $_GET['tour'] : addslashes($_GET['tour']);
}
mysql_select_db($database_radioRecords, $radioRecords);
$query_tourmemberDetails = sprintf("SELECT tourresolver.tourName, countryresolver.countryName, countryresolver.countryID, localityresolver.localityName, localityresolver.localityID, cityresolver.cityName, cityresolver.cityID, venuedetails.venueName, showlist_db.showID, venuedetails.venueID, showlist_db.showDate FROM showlist_db, tourresolver, venuedetails, cityresolver, localityresolver, countryresolver WHERE cityresolver.localityID = localityresolver.localityID AND localityresolver.countryID = countryresolver.countryID AND venuedetails.venueCity = cityresolver.cityID AND venuedetails.venueID = showlist_db.showVenueID AND showlist_db.show_tour = tourresolver.tourID AND showlist_db.show_tour = %s", $colname_tourmemberDetails);
$tourmemberDetails = mysql_query($query_tourmemberDetails, $radioRecords) or die(mysql_error());
//$row_tourmemberDetails = mysql_fetch_assoc($tourmemberDetails);
$totalRows_tourmemberDetails = mysql_num_rows($tourmemberDetails);

$colname_showOpeners = "1";
if (isset($_GET['tour'])) {
  $colname_selectedTour = (get_magic_quotes_gpc()) ? $_GET['tour'] : addslashes($_GET['tour']);
}
mysql_select_db($database_radioRecords, $radioRecords);
$query_showOpeners = sprintf("SELECT livetracks_db.trackID, COUNT(livetracks_db.trackID) AS numTimes, titleresolver.trackTitle FROM showlist_db, tourresolver, livetracks_db, titleresolver WHERE showlist_db.show_tour = tourresolver.tourID AND showlist_db.showID = livetracks_db.showID AND livetracks_db.songNumber = %s AND showlist_db.show_tour = %s AND livetracks_db.trackID = titleresolver.trackID GROUP BY livetracks_db.trackID ORDER BY titleresolver.trackTitle", $colname_showOpeners, $colname_selectedTour);
$showOpeners = mysql_query($query_showOpeners, $radioRecords) or die(mysql_error());
//$row_tourmemberDetails = mysql_fetch_assoc($tourmemberDetails);
$totalRows_showOpeners = mysql_num_rows($showOpeners);


$query_showClosers = sprintf("SELECT livetracks_db.trackID, COUNT(showclosers.song_id) AS numTimes, titleresolver.trackTitle FROM showclosers, showlist_db, livetracks_db, titleresolver 
WHERE showlist_db.showID = showclosers.show_id
AND showlist_db.showID = livetracks_db.showID 
AND livetracks_db.trackID = showclosers.song_id 
AND showlist_db.show_tour = %s 
AND livetracks_db.trackID = titleresolver.trackID 
GROUP BY livetracks_db.trackID 
ORDER BY titleresolver.trackTitle", $colname_selectedTour);
$showClosers = mysql_query($query_showClosers, $radioRecords) or die(mysql_error());
//$row_tourmemberDetails = mysql_fetch_assoc($tourmemberDetails);
$totalRows_showClosers = mysql_num_rows($showClosers);
}
elseif(!empty($myTourGroup))
{
	$colname_justTourName = "1";
	if (!empty($myTourGroup)) {
  		$colname_justTourName = (get_magic_quotes_gpc()) ? $myTourGroup : addslashes($myTourGroup);
	}
	mysql_select_db($database_radioRecords, $radioRecords);
	$query_justTourName = sprintf("SELECT tourgroupingresolver.groupName, tourgroupingresolver.groupID 
	FROM showlist_db, tourgroupingresolver, tourgroupings 
	WHERE showlist_db.show_tour = tourgroupings.tourID 
	AND tourgroupings.groupID = tourgroupingresolver.groupID 
	AND tourgroupingresolver.groupID = '%s'", $colname_justTourName);
	$justTourName = mysql_query($query_justTourName, $radioRecords) or die(mysql_error());
	$row_justTourName = mysql_fetch_assoc($justTourName);
	$totalRows_justTourName = mysql_num_rows($justTourName);



$colname_tourDetails = "1";
if (!empty($myTourGroup)) {
  $colname_tourDetails = (get_magic_quotes_gpc()) ? $myTourGroup : addslashes($myTourGroup);
}
mysql_select_db($database_radioRecords, $radioRecords);
$query_tourDetails = sprintf("SELECT tourgroupingresolver.groupName, countryresolver.countryName, countryresolver.countryID, localityresolver.localityName, localityresolver.localityID, cityresolver.cityName, cityresolver.cityID, venuedetails.venueName, showlist_db.showID, venuedetails.venueID, showlist_db.showDate FROM showlist_db, tourgroupingresolver, tourgroupings, venuedetails, cityresolver, localityresolver, countryresolver WHERE cityresolver.localityID = localityresolver.localityID AND localityresolver.countryID = countryresolver.countryID AND venuedetails.venueCity = cityresolver.cityID AND venuedetails.venueID = showlist_db.showVenueID AND showlist_db.show_tour = tourgroupings.tourID AND tourgroupingresolver.groupID = '%s' ORDER BY showlist_db.showDate DESC", $colname_tourDetails);
$tourDetails = mysql_query($query_tourDetails, $radioRecords) or die(mysql_error());
//$row_tourDetails = mysql_fetch_assoc($tourDetails);
$totalRows_tourDetails = mysql_num_rows($tourDetails);


$colname_tourtuneDetails = "1";
if (!empty($myTourGroup)) {
  $colname_tourtuneDetails = (get_magic_quotes_gpc()) ? $myTourGroup : addslashes($myTourGroup);
}
mysql_select_db($database_radioRecords, $radioRecords);
$query_tourtuneDetails = sprintf("SELECT titleresolver.trackID, COUNT(*) AS perfTimes, titleresolver.trackTitle FROM showlist_db, livetracks_db, titleresolver, tourgroupingresolver, tourgroupings WHERE livetracks_db.showID = showlist_db.showID AND titleresolver.trackID = livetracks_db.trackID AND showlist_db.show_tour = tourgroupings.tourID AND tourgroupingresolver.groupID = '%s' GROUP BY titleresolver.trackID ORDER BY perfTimes DESC", $colname_tourtuneDetails);
$tourtuneDetails = mysql_query($query_tourtuneDetails, $radioRecords) or die(mysql_error());
//$row_tourtuneDetails = mysql_fetch_assoc($tourtuneDetails);
$totalRows_tourtuneDetails = mysql_num_rows($tourtuneDetails);

/*
$colname_tourmemberDetails = "1";
if (!empty($myTourGroup)) {
  $colname_tourmemberDetails = (get_magic_quotes_gpc()) ? $myTourGroup : addslashes($myTourGroup);
}
mysql_select_db($database_radioRecords, $radioRecords);
$query_tourmemberDetails = sprintf("SELECT tourgroupingresolver.groupName, countryresolver.countryName, countryresolver.countryID, localityresolver.localityName, localityresolver.localityID, cityresolver.cityName, cityresolver.cityID, venuedetails.venueName, showlist_db.showID, venuedetails.venueID, showlist_db.showDate FROM showlist_db, tourgroupingresolver, tourgroupings, tourresolver, venuedetails, cityresolver, localityresolver, countryresolver WHERE cityresolver.localityID = localityresolver.localityID AND localityresolver.countryID = countryresolver.countryID AND venuedetails.venueCity = cityresolver.cityID AND venuedetails.venueID = showlist_db.showVenueID AND showlist_db.show_tour = tourgroupings.tourID AND tourgroupings.groupID = %s", $colname_tourmemberDetails);
$tourmemberDetails = mysql_query($query_tourmemberDetails, $radioRecords) or die(mysql_error());
//$row_tourmemberDetails = mysql_fetch_assoc($tourmemberDetails);
$totalRows_tourmemberDetails = mysql_num_rows($tourmemberDetails);
*/
$colname_showOpeners = "1";
if (!empty($myTourGroup)) {
  $colname_selectedTour = (get_magic_quotes_gpc()) ? $myTourGroup : addslashes($myTourGroup);
}
mysql_select_db($database_radioRecords, $radioRecords);
$query_showOpeners = sprintf("SELECT livetracks_db.trackID, COUNT(livetracks_db.trackID) AS numTimes, titleresolver.trackTitle 
FROM showlist_db, tourgroupings, tourresolver, livetracks_db, titleresolver WHERE showlist_db.show_tour = tourresolver.tourID AND showlist_db.showID = livetracks_db.showID AND livetracks_db.songNumber = %s AND showlist_db.show_tour = tourgroupings.tourID AND tourgroupings.groupID = '%s' AND livetracks_db.trackID = titleresolver.trackID GROUP BY livetracks_db.trackID ORDER BY titleresolver.trackTitle", $colname_showOpeners, $colname_selectedTour);
$showOpeners = mysql_query($query_showOpeners, $radioRecords) or die(mysql_error());
//$row_tourmemberDetails = mysql_fetch_assoc($tourmemberDetails);
$totalRows_showOpeners = mysql_num_rows($showOpeners);


$query_showClosers = sprintf("SELECT livetracks_db.trackID, COUNT(showclosers.song_id) AS numTimes, titleresolver.trackTitle FROM showclosers, showlist_db, livetracks_db, titleresolver, tourgroupings 
WHERE showlist_db.showID = showclosers.show_id
AND showlist_db.showID = livetracks_db.showID 
AND livetracks_db.trackID = showclosers.song_id 
AND showlist_db.show_tour = tourgroupings.tourID
AND tourgroupings.groupID = '%s' 
AND livetracks_db.trackID = titleresolver.trackID 
GROUP BY livetracks_db.trackID 
ORDER BY titleresolver.trackTitle", $colname_selectedTour);
$showClosers = mysql_query($query_showClosers, $radioRecords) or die(mysql_error());
//$row_tourmemberDetails = mysql_fetch_assoc($tourmemberDetails);
$totalRows_showClosers = mysql_num_rows($showClosers);


$query_tourAlbums = sprintf("SELECT albumdb.radioID , albumdb.ReleaseTitle
FROM studiotrack_db, showlist_db, livetracks_db, titleresolver
WHERE studiotrack_db.releaseID = albumdb.radioID  
AND studiotrack_db.trackResID = livetracks_db.trackID  
AND showlist_db.showID = livetracks_db.showID 
AND showlist_db.show_tour = '%s'
AND livetracks_db.trackID = titleresolver.trackID", $colname_selectedTour);
$tourAlbums = mysql_query($query_tourAlbums, $radioRecords) or die(mysql_error());
$row_tourAlbums = mysql_fetch_assoc($tourAlbums);
$totalRows_tourAlbums = mysql_num_rows($tourAlbums);

/* "SELECT albumdb.radioID , albumdb.ReleaseTitle, COUNT(livetracks_db.trackID) AS numTimes 
FROM studiotrack_db, showclosers, showlist_db, livetracks_db, titleresolver, tourgroupings 
WHERE studiotrack_db.trackResID = livetracks_db.trackID 
AND studiotrack_db.releaseID = albumdb.radioID 
AND showlist_db.showID = livetracks_db.showID 
AND showlist_db.show_tour = '%s'
AND livetracks_db.trackID = titleresolver.trackID 
GROUP BY albumdb.albumdb.radioID 
ORDER BY albumdb.ReleaseTitle"
*/
}
$query_tourAlbums = sprintf("SELECT albumdb.radioID , albumdb.ReleaseTitle, COUNT(livetracks_db.trackID) AS numTimes 
FROM studiotrack_db, showlist_db, livetracks_db, titleresolver, albumdb 
WHERE studiotrack_db.trackResID = livetracks_db.trackID 
AND studiotrack_db.releaseID = albumdb.radioID 
AND showlist_db.showID = livetracks_db.showID 
AND albumdb.primeRelease = '1' 
AND showlist_db.show_tour = '%s'
AND livetracks_db.trackID = titleresolver.trackID 
GROUP BY albumdb.radioID 
ORDER BY albumdb.ReleaseTitle", $colname_selectedTour);
$tourAlbums = mysql_query($query_tourAlbums, $radioRecords) or die(mysql_error());
$row_tourAlbums = mysql_fetch_assoc($tourAlbums);
$totalRows_tourAlbums = mysql_num_rows($tourAlbums);



//showOpeners



?>
<?php echo "<?xml version=\"1.0\" encoding=\"iso-8859-1\"?".">"; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>58hours.com | Statistics for Radiohead's<?php 
if(!empty($myTour))
{
	echo $row_justTourName['tourName'];
}
elseif(!empty($myTourGroup))
{
	echo " full ".$row_justTourName['groupName'];
} ?> tour.</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
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
	A:link {text-decoration: none};
	A:visited {text-decoration: none};
	A:active {text-decoration: none};
	A:hover {text-decoration: underline; color: white;};
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
AC_FL_RunContent( 'codebase','http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0','width','800','height','30','src','flash_elements/nameclip_full?name=<?php echo urlencode($row_justTourName['tourName']); ?>','quality','high','pluginspage','http://www.macromedia.com/go/getflashplayer','wmode','transparent','movie','flash_elements/nameclip_full?name=<?php echo urlencode($row_justTourName['tourName']); ?>' ); //end AC code
</script><noscript><object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0" width="800" height="30">
              <param name="movie" value="flash_elements/nameclip_full.swf?name=<?php echo urlencode($row_justTourName['tourName']); ?>" />
              <param name="quality" value="high" />
			<param name="wmode" value="transparent">
              <embed src="flash_elements/nameclip_full.swf?name=<?php echo urlencode($row_justTourName['tourName']); ?>" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="800" height="30" wmode="transparent"></embed>
            </object></noscript>
<br />
              <br />
              <?
			if($row_justTourName['priorTour']>0)
			{?>
              <br />
              <a href="tour_details.php?tour=<? echo $row_justTourName['priorTour'];?>" border="0"><img src="images/bt_previous.gif" alt="previous tour" width="58" height="13" border="0"/></a>
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
                			echo "<a href='./58_displayshow.php?showID=".$tourRow['showID']."'>&#187;</a> ".$tourRow['showDate']."<br>";
                			echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$tourRow['venueName']."<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(".$tourRow['cityName']." -  ".$tourRow['countryName'].")<br><br>";
                		} 
                		?>                	</td>
                	<td width="200" valign="top" nowrap="nowrap" class="primaryStyle"><h3>Songs on this
                	    tour:</h3>
                	  <h1><? echo $totalRows_tourtuneDetails; ?></h1><br />(sorted by frequency)<br /><br />
                		<? 
                		while($tourRow = mysql_fetch_assoc($tourtuneDetails))
                		{
                			echo "<a href='./58_trackDetails.php?trackID=".$tourRow['trackID']."'>&#187;</a> ".$tourRow['trackTitle']." (".$tourRow['perfTimes'].") <font color='#666666'>(".number_format (($tourRow['perfTimes']/$totalRows_tourDetails)*100, 2)."%)</font> <br>";
                		} 
                		?>                	</td>
					<td width="200" valign="top" nowrap="nowrap" class="primaryStyle"><h3>Openers:</h3><h1><? echo $totalRows_showOpeners; ?></h1>
                		<? 
                		while($tourRow = mysql_fetch_assoc($showOpeners))
                		{
							if(!empty($myTour))
							{
                				echo "<a href='./58_trackDetails.php?trackID=".$tourRow['trackID']."'>&#187;</a> ".$tourRow['trackTitle']." (".$tourRow['numTimes'].")<br />";
							}
							elseif(!empty($myTourGroup))
							{
								echo "<a href='./58_trackDetails.php?trackID=".$tourRow['trackID']."'>&#187;</a> ".$tourRow['trackTitle']." (".$tourRow['numTimes'].")<br />";
							}
                		} 
                		?><br />                	
                		<h3>Closers:</h3>
                		<h1><? echo $totalRows_showClosers; ?></h1>
                        <? 
                		while($tourRow = mysql_fetch_assoc($showClosers))
                		{
                			echo "<a href='./58_trackDetails.php?trackID=".$tourRow['trackID']."'>&#187;</a> ".$tourRow['trackTitle']." (".$tourRow['numTimes'].")<br />";
                		} 
                		?></td>
                    <td width="100" valign="top" class="primaryStyle"><script type="text/javascript">
AC_FL_RunContent( 'codebase','http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,19,0','width','250','height','400','src','flash_elements/tourPie','quality','high','pluginspage','http://www.macromedia.com/go/getflashplayer','movie','flash_elements/tourPie','flashVars','<? 
	$vals = "releaseVals=";
	$labels = "releaseNames=";

	do
	{
		$labels = $labels.$row_tourAlbums['ReleaseTitle'].",";
		$vals = $vals.$row_tourAlbums['numTimes'].",";
	}while($row_tourAlbums = mysql_fetch_assoc($tourAlbums)); 
echo substr($vals,0,(strlen($vals)-1))."&".substr($labels,0,(strlen($labels)-1));

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
<script src="http://www.google-analytics.com/urchin.js" type="text/javascript">
</script>
<script type="text/javascript">
_uacct = "UA-584621-1";
urchinTracker();
</script>
</div>
</body>
</html>
<?php
mysql_free_result($justTourName);
mysql_free_result($tourDetails);
mysql_free_result($tourtuneDetails);
mysql_free_result($tourmemberDetails);


?>
