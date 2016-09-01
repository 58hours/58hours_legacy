<?php 
require_once('Connections/random_connect.php');
require_once('_includes/SITEARTIST.php');
require_once('_includes/rhcommon.php');

$colname_releaseDetails = "1";
if (isset($_GET['external_release_id'])) {
  $colname_releaseDetails = (get_magic_quotes_gpc()) ? $_GET['external_release_id'] : addslashes($_GET['external_release_id']);
}
mysql_select_db($database_random_connect, $random_connect);
$query_releaseDetails = sprintf("SELECT rhr_releaseresolver.external_release_id, 
rhr_albumresolver.album_name_display, 
rhr_releaseresolver.mediaType, 
rhr_countryresolver.country_name_display, 
rhr_releaseresolver.release_date, 
rhr_releaseresolver.ReleaseType, 
rhr_releaseresolver.ReleaseCatNumber, 
rhr_groupresolver.group_name_display, 
rhr_releaseresolver.releaseLabel, 
rhr_images.location, 
rhr_releaseresolver.amazonLink 
FROM rhr_releaseresolver, rhr_albumresolver, rhr_countryresolver, rhr_images, rhr_groupresolver    
WHERE rhr_releaseresolver.external_album_id = rhr_albumresolver.external_album_id 
AND rhr_groupresolver.external_group_id = rhr_releaseresolver.external_group_id 
AND rhr_images.external_subject_id = rhr_releaseresolver.external_release_id 
AND rhr_countryresolver.external_country_id = rhr_releaseresolver.external_country_id 
AND rhr_releaseresolver.external_release_id = %s", GetSQLValueString($colname_releaseDetails,"text"));
$releaseDetails = mysql_query($query_releaseDetails, $random_connect) or die(mysql_error());
$row_releaseDetails = mysql_fetch_assoc($releaseDetails);
$totalRows_releaseDetails = mysql_num_rows($releaseDetails);


$colname_itunesLink = "1";
if (isset($_GET['external_release_id'])) {
  $colname_itunesLink = (get_magic_quotes_gpc()) ? $_GET['external_release_id'] : addslashes($_GET['external_release_id']);
}
$query_itunesLink = sprintf("SELECT itunes_link FROM rhr_releaseresolver WHERE external_release_id = %s", GetSQLValueString($colname_itunesLink,"text"));
$itunesLink = mysql_query($query_itunesLink, $random_connect) or die(mysql_error());
$row_itunesLink = mysql_fetch_assoc($itunesLink);
$totalRows_itunesLink = mysql_num_rows($itunesLink);



$colname_releaseTracks = "1";
if (isset($_GET['external_release_id'])) {
  $colname_releaseTracks = (get_magic_quotes_gpc()) ? $_GET['external_release_id'] : addslashes($_GET['external_release_id']);
}
mysql_select_db($database_random_connect, $random_connect);
$query_releaseTracks = sprintf("SELECT rhr_studiotracks.trackNum, rhr_titleresolver.song_name_display, rhr_titleresolver.external_song_id, rhr_songversionresolver.songversion_name_display  
FROM rhr_studiotracks, rhr_titleresolver, rhr_songversionresolver  
WHERE rhr_studiotracks.external_song_id = rhr_titleresolver.external_song_id 
AND rhr_songversionresolver.external_songversion_id = rhr_studiotracks.external_songversion_id 
AND rhr_studiotracks.external_release_id = %s 
ORDER BY trackNum ASC", GetSQLValueString($colname_releaseTracks,"text"));
$releaseTracks = mysql_query($query_releaseTracks, $random_connect) or die(mysql_error());
$row_releaseTracks = mysql_fetch_assoc($releaseTracks);
$totalRows_releaseTracks = mysql_num_rows($releaseTracks);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Randomhours.com || Details of Radiohead's "<?php echo $row_releaseDetails['album_name_display']; ?>"</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link href="css/warmforms.css" rel="stylesheet" type="text/css" />
<link href="css/styles.css" rel="stylesheet" type="text/css" />
<style type="text/css"> 
body 
{ 
background-image: url('images/bgstripes.gif'); 
} 
</style>
<link href="css/stylebook.css" rel="stylesheet" type="text/css" />
<script type="text/JavaScript">
<!--
function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}
//-->
</script>
<script src="Scripts/AC_RunActiveContent.js" type="text/javascript"></script>
</head>

<body bgcolor="#000000" text="#FFFFFF" link="#0066CC" vlink="#0066CC" alink="#0066CC" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" class="blueishlinks">
<br />
<div align="center">
	<table cellpadding="1" width="810">
		<tr>
			<td bgcolor="#000000">
				<table width="809" border="0" align="center" cellpadding="1">
					<tr>
						<td width="803" colspan="2" bgcolor="#000000" class="darkerLinkage"><a href="/"><img src="/i/rainbowheader_v2.jpg" width="800" height="114" border="0"></a></td>
					</tr>
					<tr>
						<td>
      						<table width="800" border="0" cellspacing="0">
   						  <tr>
   							<td align="left" bgcolor="#000000">
       								  <script type="text/javascript">
AC_FL_RunContent( 'codebase','http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0','width','450','height','30','src','flash_elements/trackName?name=<?php echo urlencode($row_releaseDetails['album_name_display']); ?>','quality','high','pluginspage','http://www.macromedia.com/go/getflashplayer','bgcolor','#000000','movie','flash_elements/trackName?name=<?php echo urlencode($row_releaseDetails['album_name_display']); ?>' ); //end AC code
</script><noscript><object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0" width="450" height="30">
<param name="movie" value="flash_elements/trackName.swf?name=<?php echo urlencode($row_releaseDetails['album_name_display']); ?>" />
              								<param name="quality" value="high" /><param name="BGCOLOR" value="#000000" />
              								<embed src="flash_elements/trackName.swf?name=<?php echo urlencode($row_releaseDetails['album_name_display']); ?>" width="450" height="30" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" bgcolor="#000000"></embed>
           							  </object></noscript>
              							<br />
              							<br />
              							<br />
              							<table width="800" border="0" cellspacing="0" cellpadding="0">
                							<tr>
                 									<td width="300" valign="top">
                  										<table width="300" border="0" cellspacing="0" cellpadding="0">
                     										<tr>
                        										<td align="center" bgcolor="#CCCCCC">
                        											<table width="300" border="0" cellspacing="0">
                       											  <tr>
                              												<td align="left" nowrap="nowrap" bgcolor="#000000">
																		    <div align="left"><span class="linkageStuff">by: <?php echo $row_releaseDetails['group_name_display']; ?><br />Released on: <?php echo $row_releaseDetails['release_date']; ?><br /> 
																			    (<?php echo $row_releaseDetails['country']; ?>)<br />
																				    <?php echo $row_releaseDetails['ReleaseType']; ?><br />
																	      <?php echo $row_releaseDetails['releaseLabel']; 
																		  if($totalRows_itunesLink==1)
																		  {
																		  	echo "<br />".$row_itunesLink['itunes_link'];
																		  }?></span> </div>                          													</td>
                           											  </tr>
                            											<tr>
                              												<td colspan="2" nowrap="nowrap" bgcolor="#000000">&nbsp;</td>
                            											</tr>
                            											<tr bgcolor="#FFFFFF">
                              												<td colspan="2" nowrap="nowrap">
                              													<table width="300" border="0" cellspacing="0" cellpadding="0"><?php do { ?>
                                  													<tr bgcolor="#000033">
                                   													  <td width="15" nowrap="nowrap" bgcolor="#FFFFFF">
                                   														<div align="right"><span class="darkerLinkage"><strong><?php echo $row_releaseTracks['trackNum']; ?></strong></span>&nbsp;</div>
																					  </td>
                                    													<td width="285" nowrap="nowrap" bgcolor="#000000"><span class="linkageStuff">&nbsp;&nbsp;<a href="songdetails.php?external_song_id=<?php echo $row_releaseTracks['external_song_id']; ?>" class="linkageStuff"> <?php echo $row_releaseTracks['song_name_display']; ?></a>
                                       													    <?php if (($row_releaseTracks['songversion_name_display'] != 'studio')&&($row_releaseTracks['songversion_name_display'] != 'studio release')) { // Show if recordset not empty ?>
                                          													(<?php echo $row_releaseTracks['songversion_name_display']; ?>)</span><?php } // Show if recordset not empty ?></td>
                                  													</tr>
                                  													<?php } while ($row_releaseTracks = mysql_fetch_assoc($releaseTracks)); ?>
                              													</table>
                              												</td>
                            											</tr>
																  </table>
                       										  </td>
															</tr>
                  										</table>
                  									</td>
                  									<td width="500" align="right" valign="top"><font color="#6699CC"> &nbsp;<?php if ($row_releaseDetails['location'] != "") { // Show if recordset not empty ?><img src="http://media.randomhours.com/img/<?php echo $row_releaseDetails['location']; ?>" hspace="20" border="0" /><?php } // Show if recordset not empty ?></font></td>
           								  </tr>
       								  </table>
       							        <p>&nbsp;</p></td>
   							  </tr>
        							<tr>
          								<td bgcolor="#000000" class="linkageStuff"><font color="#FFFFFF" class="linkageStuff">
          								  <?php include('58ss_includes/58disclaimer.php'); ?></font></td>
        							</tr>
						  </table>
					  </td>
				  </tr>
			  </table>
		  </td>
			</tr>
		</table>
	</div>
</body>
</html>
<?php
mysql_free_result($releaseDetails);

mysql_free_result($releaseTracks);
?>

