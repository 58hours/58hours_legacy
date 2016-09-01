<?php 
require_once('Connections/random_connect.php');
require_once('_includes/SITEARTIST.php');
require_once('_includes/rhcommon.php');
?>
<?php
$colname_perfCollection = "79";
if (isset($_GET['external_song_id'])) {
  $colname_perfCollection = (get_magic_quotes_gpc()) ? $_GET['external_song_id'] : addslashes($_GET['external_song_id']);
}
mysql_select_db($database_random_connect, $random_connect);
$query_perfCollection = sprintf("SELECT rhr_performances.showDate, rhr_venueresolver.venue_name_display, rhr_livetracks.external_show_id, rhr_livetracks.songNumber, rhr_titleresolver.song_name_display 
FROM rhr_livetracks, rhr_performances, rhr_venueresolver, rhr_titleresolver 
WHERE rhr_titleresolver.external_song_id = rhr_livetracks.external_song_id 
AND rhr_performances.external_show_id = rhr_livetracks.external_show_id 
AND  rhr_performances.external_venue_id = rhr_venueresolver.external_venue_id 
AND rhr_livetracks.external_song_id = %s 
AND rhr_performances.external_group_id = %s
ORDER BY rhr_performances.showDate DESC", GetSQLValueString($colname_perfCollection,"text"),
GetSQLValueString('681qWLg',"text"));
$perfCollection = mysql_query($query_perfCollection, $random_connect) or die(mysql_error());
$row_perfCollection = mysql_fetch_assoc($perfCollection);
$totalRows_perfCollection = mysql_num_rows($perfCollection);
?>
 
<html>
<head>
<title>View Title Performance Dates</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link href="css/styles.css" rel="stylesheet" type="text/css">
<style type="text/css"> 
body 
{ 
background-image: url('images/bgstripes.gif'); 
} 
</style>
<link href="css/styles_v2.css" rel="stylesheet" type="text/css">
<script src="Scripts/AC_RunActiveContent.js" type="text/javascript"></script>
</head>

<body bgcolor="#000000" text="#FFFFFF" link="#0066CC" vlink="#0066CC" alink="#0066CC" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" class="blueishlinks"><div align="center">
<a href="/"><img src="/i/rainbowheader_v2.jpg" width="800" height="114" border="0"></a>
<table width="800" border="0" cellspacing="0" cellpadding="5">
  <tr> 
    <td colspan="2" bgcolor="#000000"><font size="1" face="Arial, Helvetica, sans-serif" color="#CCCCCC">
                    <script type="text/javascript">
AC_FL_RunContent( 'codebase','http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0','width','450','height','30','src','trackName?name=<?php echo urlencode($row_perfCollection['song_name_display']); ?> ','quality','high','pluginspage','http://www.macromedia.com/go/getflashplayer','bgcolor','#000000','movie','trackName?name=<?php echo urlencode($row_perfCollection['song_name_display']); ?> ' ); //end AC code
</script><noscript><object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0" width="450" height="30">
                  <param name="movie" value="trackName.swf?name=<?php echo urlencode($row_perfCollection['song_name_display']); ?> ">
                  <param name="quality" value="high"><param name="BGCOLOR" value="#000000">
        <embed src="trackName.swf?name=<?php echo urlencode($row_perfCollection['song_name_display']); ?> " width="450" height="30" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" bgcolor="#000000"></embed></object></noscript>
                    <br>
                    <br>
        <br>performance history details.</font>
      <br>
      <table width="400" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td class="linkageStuff">Show Date:</td>
          <td nowrap class="linkageStuff">&nbsp;&nbsp;Setlist Position:</td>
          <td class="linkageStuff">&nbsp;&nbsp;Show Venue:</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <?php do { ?>
        <tr> 
          <td class="linkageStuff"><font size="1" face="Arial, Helvetica, sans-serif"><a href="showdetails.php?external_show_id=<?php echo $row_perfCollection['external_show_id']; ?>" class="linkageStuff"><?php echo date('m/d/Y',strtotime($row_perfCollection['showDate'])); ?></a></font></td>
          <td nowrap class="linkageStuff"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif">&nbsp;&nbsp;<?php 
          if($row_perfCollection['songNumber']!=0) {
          	echo $row_perfCollection['songNumber']; 
          } else {
          	echo "intro music";
          } ?></font></td>
          <td><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif" class="linkageStuff">&nbsp;&nbsp;<?php echo $row_perfCollection['venue_name_display']; ?></font></td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <?php } while ($row_perfCollection = mysql_fetch_assoc($perfCollection)); ?>
      </table></td>
  </tr>
  <tr> 
    <td colspan="2">&nbsp;</td>
  </tr>
</table>
<p><font size="1" face="Verdana, Arial, Helvetica, sans-serif"> </font></p></div>
</body>
</html>
<?php
mysql_free_result($perfCollection);
?>

