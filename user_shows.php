<?php 
require_once('Connections/random_connect.php');
require_once('_includes/SITEARTIST.php');
require_once('_includes/rhcommon.php');

if ($_COOKIE['client_id_hash'] != "")
{
	//get the actual userid which corresponds to the client_id
	$query_internalInfo = sprintf("SELECT * FROM rhr_users WHERE client_key_userid = %s AND client_key_pass = %s", GetSQLValueString($_COOKIE['client_id_hash'],"text"), GetSQLValueString($_COOKIE['client_pass_hash'],"text"));
	$internalInfo = mysql_query($query_internalInfo, $random_connect) or die(mysql_error());
	$row_internalInfo = mysql_fetch_assoc($internalInfo);
	$totalRows_internalInfo = mysql_num_rows($internalInfo);
	$internal_userid = $row_internalInfo['external_user_id'];
}
if($totalRows_internalInfo!=1) header("location: /index.php");

if (($_COOKIE['client_id_hash'] != "") && (isset($_GET['removeShow']))) {
  $deleteSQL = sprintf("DELETE FROM rhr_usershows WHERE external_show_id=".GetSQLValueString($_GET['removeShow'],"text")." AND external_user_id='".$internal_userid."'");
  mysql_select_db($database_random_connect, $random_connect);
  $Result1 = mysql_query($deleteSQL, $random_connect) or die(mysql_error());
}

$colname_memberName = "1";
if (isset($internal_userid)) {
  $colname_memberName = (get_magic_quotes_gpc()) ? $internal_userid : addslashes($internal_userid);
}
mysql_select_db($database_random_connect, $random_connect);
$query_memberName = sprintf("SELECT * FROM rhr_users WHERE external_user_id = %s", GetSQLValueString($colname_memberName,"text"));
$memberName = mysql_query($query_memberName, $random_connect) or die(mysql_error());
$row_memberName = mysql_fetch_assoc($memberName);
$totalRows_memberName = mysql_num_rows($memberName);

$colname_claimedShows = "0";
if (isset($internal_userid)) {
  $colname_claimedShows = (get_magic_quotes_gpc()) ? $internal_userid : addslashes($internal_userid);
}
mysql_select_db($database_random_connect, $random_connect);
// begin new code

$query_claimedShows = sprintf("(SELECT 
	rhr_usershows.internal_id AS internal_id, 
	rhr_usershows.external_user_id AS external_user_id, 
	rhr_usershows.external_show_id AS external_show_id, 
	rhr_performances.showDate AS showDate, 
	rhr_venueresolver.venue_name_display AS venue_name_display
	FROM rhr_usershows, rhr_performances, rhr_venueresolver 
	WHERE rhr_performances.external_venue_id = rhr_venueresolver.external_venue_id 
	AND rhr_performances.external_show_id = rhr_usershows.external_show_id 
	AND rhr_usershows.external_user_id = %s 
	AND rhr_performances.external_group_id = %s)
	UNION
	(SELECT 
	rhr_usershows.internal_id AS internal_id, 
	rhr_usershows.external_user_id AS external_user_id, 
	rhr_usershows.external_show_id AS external_show_id, 
	rhr_performances.showDate AS showDate, 
	rhr_alternatevenuenames.venue_name_display AS venue_name_display
	FROM rhr_usershows, rhr_performances, rhr_venueresolver, rhr_alternatevenuenames  
	WHERE rhr_performances.external_venue_id = rhr_alternatevenuenames.alt_external_venue_id
	AND rhr_alternatevenuenames.primary_external_venue_id = rhr_venueresolver.external_venue_id 
	AND rhr_performances.external_show_id = rhr_usershows.external_show_id 
	AND rhr_usershows.external_user_id = %s 
	AND rhr_performances.external_group_id = %s)

	ORDER BY showDate ASC", GetSQLValueString($colname_claimedShows,"text"), GetSQLValueString($INTERNAL_SITEGROUP,"text"),GetSQLValueString($colname_claimedShows,"text"), GetSQLValueString($INTERNAL_SITEGROUP,"text"));


$claimedShows = mysql_query($query_claimedShows, $random_connect) or die(mysql_error());
$row_claimedShows = mysql_fetch_assoc($claimedShows);
$totalRows_claimedShows = mysql_num_rows($claimedShows);
// something needs to be placed in here to account for shows that are linked to alternate venue IDs

///////// This is where we'll get the data for the user's shows ///////////////
if($_GET['uso']=="1") $listSongsBy = 'numShows DESC';
else $listSongsBy = 'rhr_titleresolver.song_name_display ASC';
$qstring = sprintf("SELECT 
rhr_titleresolver.song_name_display, rhr_titleresolver.external_song_id, rhr_usershows.external_user_id, COUNT(rhr_usershows.external_show_id) AS numShows, rhr_performances.showDate 
FROM rhr_usershows, rhr_performances, rhr_livetracks, rhr_titleresolver 
WHERE rhr_performances.external_group_id = %s 
AND rhr_performances.external_show_id = rhr_usershows.external_show_id 
AND rhr_usershows.external_user_id = %s 
AND rhr_performances.external_show_id = rhr_livetracks.external_show_id 
AND rhr_livetracks.external_song_id = rhr_titleresolver.external_song_id 
GROUP BY rhr_titleresolver.song_name_display ORDER BY %s", GetSQLValueString($INTERNAL_SITEGROUP,"text"), GetSQLValueString($internal_userid,"text"),$listSongsBy);
$showStats = mysql_query($qstring, $random_connect) or die(mysql_error());

$query_userAlbums = sprintf("SELECT rhr_albumresolver.external_album_id , rhr_albumresolver.album_name_display, COUNT(rhr_livetracks.external_song_id) AS numTimes 
FROM rhr_studiotracks, rhr_performances, rhr_livetracks, rhr_titleresolver, rhr_albumresolver, rhr_releaseresolver, rhr_usershows  
WHERE rhr_studiotracks.external_song_id = rhr_livetracks.external_song_id 
AND rhr_studiotracks.external_release_id = rhr_releaseresolver.external_release_id 
AND rhr_performances.external_show_id = rhr_livetracks.external_show_id 
AND rhr_albumresolver.external_album_id = rhr_releaseresolver.external_album_id  
AND rhr_usershows.external_user_id = %s
AND rhr_performances.external_group_id = %s 
AND rhr_performances.external_show_id = rhr_usershows.external_show_id
AND rhr_livetracks.external_song_id = rhr_titleresolver.external_song_id 
GROUP BY rhr_albumresolver.external_album_id 
ORDER BY rhr_albumresolver.album_name_display", GetSQLValueString($colname_claimedShows,"text"),
GetSQLValueString($INTERNAL_SITEGROUP,"text")
);
$userAlbums = mysql_query($query_userAlbums, $random_connect) or die(mysql_error());
$row_userAlbums = mysql_fetch_assoc($userAlbums);
$totalRows_userAlbums = mysql_num_rows($userAlbums);

////////  END NEW CODE  ///////////////////
if(!$_COOKIE['client_id_hash']) header("Location: index.php");
else {?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>58hours.com |  Member details for: <?php echo $row_memberName['pn_uname']; ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link href="../css/styles.css" rel="stylesheet" type="text/css" />
<style type="text/css"> 
body 
{ 
background-image: url('images/bgstripes.gif'); 
} 
</style>


<script language="javascript">

function resetUserActionField(newmessage)
{
	document.getElementById('editarea').innerHTML = newmessage;
}

function createRequestObject() {
    var ro;
    var browser = navigator.appName;
    if(browser == "Microsoft Internet Explorer"){
        ro = new ActiveXObject("Microsoft.XMLHTTP");
    }else{
        ro = new XMLHttpRequest();
    }
    return ro;
}

var http = createRequestObject();
function sndReq(action) {
	
    http.open('GET', 'ops/easyupdate.php?action='+action);
    http.onreadystatechange = handleResponse;
    http.send();
    
}

function handleResponse() {
    if(http.readyState == 4){
        var response = http.responseText;
        console.log(response);
        var update = new Array();

        if(response.indexOf('|' != -1)) {
            update = response.split('|');
            document.getElementById(update[0]).innerHTML = update[1];
        }
    }
}
</script>



<script language="JavaScript" type="text/JavaScript">
<!--
function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}
//-->
</script>
<style type="text/css">
<!--
.style1 {color: #FFFFFF}
.style4 {color: #000033}
-->
</style>
<link href="css/styles_v2.css" rel="stylesheet" type="text/css" />
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
<script src="Scripts/AC_RunActiveContent.js" type="text/javascript"></script>
</head>

<body bgcolor="#000000" text="#FFFFFF" link="#0066CC" vlink="#0066CC" alink="#0066CC" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" class="blueishlinks">
<table width="860" border="0" align="center" cellpadding="1" cellspacing="1" bgcolor="#000000">
  <tr>
    <td>
	<table width="800" align="center" cellpadding="0" cellspacing="0" cols="1" bgcolor="#000000" rows="2"><tr><td bgcolor="#000000"><a href="/"></a>
          <a href="/"><img src="/i/rainbowheader_v2.jpg" width="800" height="114" border="0" /></a></td>
  </tr><tr><td bgcolor="#FFFFFF">
  	<script type="text/javascript">
AC_FL_RunContent( 'codebase','http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0','width','800','height','20','src','../flashStats','quality','high','pluginspage','http://www.macromedia.com/go/getflashplayer','movie','../flashStats' ); //end AC code
</script><noscript><object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0" width="800" height="20">
      <param name="movie" value="../flashStats.swf" />
      <param name="quality" value="high" />
      <embed src="../flashStats.swf" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="800" height="20"></embed>
    </object></noscript></td>
</tr>
</table>
<div align="center">
  <table width="800" border="0" align="center" cellpadding="5" cellspacing="0" bgcolor="#FFFFFF">
    <tr>
      <td nowrap="nowrap" class="darkerLinkage"><font face="Arial, Helvetica, sans-serif">&nbsp;</font></td>
      <td align="right" valign="bottom" nowrap="nowrap">&nbsp;</td>
      <td align="right" valign="bottom" nowrap="nowrap">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="3" bgcolor="#000000"><font color="#999999" size="1" face="Arial, Helvetica, sans-serif">
        <script type="text/javascript">
AC_FL_RunContent( 'codebase','http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0','width','450','height','30','src','../trackName?name=Member+details+for+<?php echo $row_memberName['pn_uname']; ?>','quality','high','pluginspage','http://www.macromedia.com/go/getflashplayer','bgcolor','#000000','movie','../trackName?name=Member+details+for+<?php echo $row_memberName['pn_uname']; ?>' ); //end AC code
</script><noscript><object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0" width="450" height="30">
          <param name="movie" value="../trackName.swf?name=Member+details+for+<?php echo $row_memberName['pn_uname']; ?>" />
          <param name="quality" value="high" /><param name="BGCOLOR" value="#000000" />
          <embed src="../trackName.swf?name=Member+details+for+<?php echo $row_memberName['pn_uname']; ?>" width="450" height="30" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" bgcolor="#000000"></embed>
        </object></noscript>
        </font></td>
    </tr>
    <tr>
      <td colspan="3" bgcolor="#000000"><table width="100%" border="0" cellspacing="0" cellpadding="1">
          <tr> 
            <td width="300" height="72" valign="top"><font color="#CCCCCC" size="1" face="Arial, Helvetica, sans-serif">&nbsp;</font>
              <table width="300" border="0" cellspacing="1" cellpadding="2">
                <tr>
                  <td width="89" align="right" nowrap="nowrap"><span class="style1">email: </span></td>
                  <td width="200" nowrap="nowrap"><span class="style1"><?php echo $row_memberName['pn_email']; ?></span></td>
                </tr>
                <tr>
                  <td nowrap="nowrap">&nbsp;</td>
                  <td nowrap="nowrap">&nbsp;</td>
                </tr>
                <tr>
                  <td align="right" valign="top">My password:</td>
                  <td valign="top"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif"><a href="#" onClick="javascript:sndReq('change_pass')">[change]</a></font>
                <div id="editarea" class="linkageStuff">					</div>				</td>
                  </tr>
                <tr>
                  <td align="right" valign="top">My public visibility:</td>
                  <td valign="top"><label>OFF</label></td>
                </tr>
              </table>
              <p><br />
                </p>            </td>
            <td align="right" valign="top"><table width="100%" border="0" cellspacing="1" cellpadding="1">
                <tr>
                  <th colspan="3" bgcolor="#FFFFFF"><span class="style4">My shows: <?php echo $totalRows_claimedShows ?></span> </th>
                </tr>
                <?php 
				$rowcounter = 0;
				do { ?>
                <tr<? 
				if($rowcounter%2==0) echo " bgcolor=#333399";
				?>>
                    <td width="10%" nowrap="nowrap"><span class="linkageStuff"><?php echo $row_claimedShows['showDate']; ?></td>
                    <td width="42%" nowrap="nowrap"><a href="/showdetails.php?external_show_id=<?php echo $row_claimedShows['external_show_id']; ?>" class="linkageStuff"><?php echo $row_claimedShows['venue_name_display']; ?></a></td>
                    <td width="17%"><a href="user_shows.php?removeShow=<?php echo $row_claimedShows['external_show_id']; ?>" class="linkageStuff">[remove]</a></td>
                </tr>
                <?php 
				$rowcounter++;
				} while ($row_claimedShows = mysql_fetch_assoc($claimedShows)); ?>

              </table>
			  
			  <br>			</td>
			</tr>
			<tr>
			<td align="center" valign="top"><script type="text/javascript">
AC_FL_RunContent( 'codebase','http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,19,0','width','250','height','400','src','flash_elements/userPie','quality','high','pluginspage','http://www.macromedia.com/go/getflashplayer','movie','flash_elements/userPie','flashVars','<? 
	$vals = "releaseVals=";
	$labels = "releaseNames=";

	do
	{
		$labels = $labels.urlencode($row_userAlbums['album_name_display']).",";
		$vals = $vals.$row_userAlbums['numTimes'].",";
	}while($row_userAlbums = mysql_fetch_assoc($userAlbums)); 
echo substr($vals,0,(strlen($vals)-1))."&".substr($labels,0,(strlen($labels)-1));

?>' ); //end AC code
</script><noscript><object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,19,0" width="250" height="400">
                      <param name="movie" value="flash_elements/userPie.swf" />
                      <param name="quality" value="high" />
                      <embed src="flash_elements/userPie.swf" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="250" height="400"></embed>
                    </object></noscript></td>
			<td align="right" valign="top">
			<div id="userSongDetails">
			<table width="100%" border="0" cellspacing="1" cellpadding="1">
                <tr>
                  <th colspan="4" bgcolor="#FFFFFF"><span class="style4">What I've seen & how many times...</span> </th>
                </tr>
                <tr><td class="linkageStuff"><br />Ordered by <a href="?uso=0" class="linkageStuff">[Title]</a>   <a href="?uso=1" class="linkageStuff">[Times]</a><br/><br/></td><td colspan="3">&nbsp;</td></tr>
                
                <tr>
                <?
               $colopp=0;
                while($perfResults=mysql_fetch_array($showStats, MYSQL_ASSOC))
                {
                	//$collopp%2==0?$colshade="":$colshade="#333399"; 
					echo "<td colspan=\"2\" class=\"linkageStuff\"><a href=\"/songdetails.php?external_song_id=".$perfResults['external_song_id']."\" class=\"linkageStuff\">".$perfResults['song_name_display']."</a></td><td colspan=\"2\" class=\"linkageStuff\">".$perfResults['numShows']."</td></tr><tr";
					if($colopp%2==0) echo " bgcolor=#333399";
					echo ">";
					$colopp++;
				}
				
                ?></tr>
              </table>
			  </div>
			  <br>			</td>
    </tr>
  </table>  </td>
    </tr>
    <tr bgcolor="#000033">
      <td colspan="3" bgcolor="#000000"><font color="#FFFFFF">
        <?php require_once('58ss_includes/58disclaimer.php'); ?>
      </font></td>
    </tr>
    <tr bgcolor="#000033">
      <td colspan="3" bgcolor="#000000">&nbsp;</td>
    </tr>
  </table>	</td>
    <td width="160" valign="top" bgcolor="#000000"><img src="images/google_spacer.gif" width="160" height="70" /><br />
    <script type="text/javascript"
  src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>
</td>
  </tr>
</table>
<script src="http://www.google-analytics.com/urchin.js" type="text/javascript">
</script>
<script type="text/javascript">
_uacct = "UA-584621-1";
urchinTracker();
</script>
</body>
</html>
<?php
mysql_free_result($memberName);

mysql_free_result($claimedShows);
?>
<?php } ?>
