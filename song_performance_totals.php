<?php 
require_once('Connections/random_connect.php');
require_once('_includes/SITEARTIST.php');
require_once('_includes/rhcommon.php');


mysql_select_db($database_random_connect, $random_connect);
$query_yearSongStats = sprintf("SELECT rhr_groupresolver.external_group_id AS songauthor_external_id, rhr_groupresolver.group_name_display AS songauthor_name_display, rhr_livetracks.external_show_id, rhr_livetracks.external_song_id, rhr_titleresolver.song_name_display, COUNT(*) as groupcount 
FROM rhr_livetracks, rhr_titleresolver, rhr_performances, rhr_groupresolver  
WHERE rhr_performances.external_show_id = rhr_livetracks.external_show_id 
AND rhr_titleresolver.external_song_id = rhr_livetracks.external_song_id
AND rhr_performances.external_group_id = %s 
AND rhr_titleresolver.external_group_id = rhr_groupresolver.external_group_id 
GROUP BY rhr_titleresolver.external_song_id ORDER BY groupcount DESC",GetSQLValueString($INTERNAL_SITEGROUP,"text"));
$yearSongStats = mysql_query($query_yearSongStats, $random_connect) or die(mysql_error());
$row_yearSongStats = mysql_fetch_assoc($yearSongStats);
$totalRows_yearSongStats = mysql_num_rows($yearSongStats);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>58.randomhours.com: Cumulative Radiohead live performance numbers</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link href="css/styles.css" rel="stylesheet" type="text/css" />
<style type="text/css"> 
body 
{ 
background-image: url('images/bgstripes.gif'); 
} 
</style>
</head>

<body bgcolor="#000000" text="#FFFFFF" link="#0066CC" vlink="#0066CC" alink="#0066CC" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" class="blueishlinks">
<table width="800" border="0" cellspacing="0" cellpadding="5" align="center">
<tr>
<td><script type="text/javascript"><!--
google_ad_client = "pub-4681937497066114";
/* 728x90, created 8/14/08 */
google_ad_slot = "2300195665";
google_ad_width = 728;
google_ad_height = 90;
//-->
</script>
<script type="text/javascript"
src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script><br />
</td>
</tr>
  <tr>
    <td bgcolor="#000000"><a href="/"><img src="/i/rainbowheader_v2.jpg" width="800" height="114" border="0"></a></td>
  </tr>
  <tr bgcolor="#000000">
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <?php do { ?>
      <tr>
	  <?php if ($row_yearSongStats['groupcount'] == 1) { // Show if recordset has a one count ?>
        <td bgcolor="#FFFFFF"></td>
        <td bgcolor="#FFFFFF"><font color="#000033" size="1" face="Arial, Helvetica, sans-serif"> <a href="/songdetails.php?external_song_id=<? echo $row_yearSongStats['external_song_id']; ?>"><?php echo $row_yearSongStats['song_name_display']; ?></a><? if(GetSQLValueString($row_yearSongStats['songauthor_external_id'],"text")!=GetSQLValueString($INTERNAL_SITEGROUP,"text"))
        {
        	echo " (".$row_yearSongStats['songauthor_name_display']." cover)";
        } ?></font></td>
		<td bgcolor="#FFFFFF" align="left"><img src="graph_shim.gif" height="10" width="<?php echo $row_yearSongStats['groupcount']*2; ?>">&nbsp;<font color="#000033" size="1" face="Arial, Helvetica, sans-serif"> [<?php echo $row_yearSongStats['groupcount']; ?>] </font></td>
		<?php } // Show if recordset empty ?>
		<?php if ($row_yearSongStats['groupcount'] > 1) { // Show if recordset has more than a one count ?>
        <td></td>
        <td><font size="1" face="Arial, Helvetica, sans-serif"> <a href="/songdetails.php?external_song_id=<? echo $row_yearSongStats['external_song_id']; ?>" class="linkageStuff"><?php echo $row_yearSongStats['song_name_display']; ?></a><? if(GetSQLValueString($row_yearSongStats['songauthor_external_id'],"text")!=GetSQLValueString($INTERNAL_SITEGROUP,"text"))
        {
        	echo " (".$row_yearSongStats['songauthor_name_display']." cover)";
        } ?></font></td>
		<td align="left"><img src="graph_shim.gif" height="10" width="<?php echo $row_yearSongStats['groupcount']*1.5; ?>">&nbsp;<font size="1" face="Arial, Helvetica, sans-serif">[<?php echo $row_yearSongStats['groupcount']; ?>] </font></td>
		<?php } // Show if recordset empty ?>
      </tr>
      <?php } while ($row_yearSongStats = mysql_fetch_assoc($yearSongStats)); ?>
    </table></td>
  </tr>
  <tr>
    <td bgcolor="#000000"><font color="#FFFFFF">
        <?php require_once('58ss_includes/58disclaimer.php'); ?>
    </font></td>
  </tr>
</table>
</body>
</html>
<?php
mysql_free_result($yearSongStats);
?>
