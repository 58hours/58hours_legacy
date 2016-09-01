<?php require_once('Connections/radioRecords.php'); ?>
<?php
$targetShow=$row_showDetails['showDate'];
mysql_select_db($database_radioRecords, $radioRecords);
$nextShow = mysql_query("SELECT `showID`,`showDate` FROM `showlist_db` WHERE showDate > \"'$targetShow'\" ORDER BY `showDate` ASC LIMIT 1", $radioRecords) or die(mysql_error());
$row_nextShow = mysql_fetch_assoc($nextShow);
$totalRows_nextShow = mysql_num_rows($nextShow);

$targetPrevShow=$row_showDetails['showDate'];
mysql_select_db($database_radioRecords, $radioRecords);
$prevShow = mysql_query("SELECT `showID`,`showDate` FROM `showlist_db` WHERE showDate < \"'$targetPrevShow'\" ORDER BY `showDate` DESC LIMIT 1", $radioRecords) or die(mysql_error());
$row_prevShow = mysql_fetch_assoc($prevShow);
$totalRows_prevShow = mysql_num_rows($prevShow);

$colname_memberName = "1";
if (isset($_COOKIE['memberID'])) {
  $colname_memberName = (get_magic_quotes_gpc()) ? $_COOKIE['memberID'] : addslashes($_COOKIE['memberID']);
}
mysql_select_db($database_radioRecords, $radioRecords);
$query_memberName = sprintf("SELECT * FROM `58_members` WHERE pn_uid = %s", $colname_memberName);
$memberName = mysql_query($query_memberName, $radioRecords) or die(mysql_error());
$row_memberName = mysql_fetch_assoc($memberName);
$totalRows_memberName = mysql_num_rows($memberName);

$colname_claimedShows = "0";
if (isset($_COOKIE['memberID'])) {
  $colname_claimedShows = (get_magic_quotes_gpc()) ? $_COOKIE['memberID'] : addslashes($_COOKIE['memberID']);
}
mysql_select_db($database_radioRecords, $radioRecords);
$query_claimedShows = sprintf("SELECT 58_memberShows.keyID, 58_memberShows.memberID, 58_memberShows.showID, showlist_db.showDate, venuedetails.venueName FROM 58_memberShows, showlist_db, venuedetails WHERE showlist_db.showVenueID = venuedetails.venueID AND showlist_db.showID = 58_memberShows.showID AND 58_memberShows.memberID = '%s' ORDER BY showlist_db.showDate ASC", $colname_claimedShows);
$claimedShows = mysql_query($query_claimedShows, $radioRecords) or die(mysql_error());
$row_claimedShows = mysql_fetch_assoc($claimedShows);
$totalRows_claimedShows = mysql_num_rows($claimedShows);
?>
<?php if(!$_COOKIE['memberID']) header("Location: index.php");
else {?>
<?php echo "<?xml version=\"1.0\" encoding=\"iso-8859-1\"?".">"; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>58hours.com |  Member details for: <?php echo $row_memberName['pn_uname']; ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/styles.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
.style1 {color: #FFFFFF}
.style4 {color: #000033}
-->
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
    http.open('get', 'ops/easyupdate.php?action='+action);
    http.onreadystatechange = handleResponse;
    http.send(null);
}

function handleResponse() {
    if(http.readyState == 4){
        var response = http.responseText;
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
</head>

<body bgcolor="#000000">
<table width="300" border="0" align="center" cellpadding="1" cellspacing="1" bgcolor="#FFFFFF">
  <tr>
    <td>
      <table width="800" align="center" cellpadding="0" cellspacing="0" cols="1" bgcolor="#FFFFFF" rows="2">
        <tr>
          <td width="688" background="images/58hrs_header_taller.jpg" bgcolor="#FFFFFF"><img src="images/pixelshim.gif" width="20" height="148" /> </td>
          <td width="108" align="right" bgcolor="#000000"><?php require_once('loginModule.php'); ?>
          </td>
        </tr>
        <tr>
          <td colspan="2" bgcolor="#FFFFFF">
            <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0" width="800" height="20">
              <param name="movie" value="flashStats.swf" />
              <param name="quality" value="high" />
              <embed src="flashStats.swf" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="800" height="20"></embed>
            </object>
          </td>
        </tr>
      </table>
      <div align="center">
        <table width="800" border="0" align="center" cellpadding="5" cellspacing="0" bgcolor="#FFFFFF">
          <tr>
            <td width="518" nowrap="nowrap" class="darkerLinkage"><font face="Arial, Helvetica, sans-serif">&nbsp;</font></td>
            <td width="262" align="right" valign="bottom" nowrap="nowrap">&nbsp;</td>
          </tr>
          <tr>
            <td bgcolor="#000033"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif">
              <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0" width="450" height="30">
                <param name="movie" value="trackName.swf?name=Member+details+for+<?php echo $row_memberName['pn_uname']; ?>" />
                <param name="quality" value="high" />
                <embed src="trackName.swf?name=Member+details+for+<?php echo $row_memberName['pn_uname']; ?>" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="450" height="30"></embed>
              </object>
            </font></td>
            <td rowspan="2" align="right" valign="top" bgcolor="#000033"><table width="200" border="0" cellspacing="1" cellpadding="1">
              <tr>
                <td align="center" bgcolor="#FFFFFF"><img src="images/thomscreen1.jpg" width="200" height="579" /></td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td valign="top" bgcolor="#000033">
            <table width="450" border="0" cellspacing="1" cellpadding="1">
              <tr>
                <td width="85" height="24" align="right"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif"><img src="register/images/reg_uid.gif" width="91" height="20" /></font></td>
                <td width="358"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif"><?php echo $row_memberName['pn_uname']; ?></font></td>
              </tr>
              <tr>
                <td align="right"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif">member since:</font></td>
                <td><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif">&nbsp;<?php echo date('l, F d, Y',$row_memberName['pn_user_regdate']); ?></font></td>
              </tr>
              <tr>
                <td align="right"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif">password&nbsp;</font></td>
                <td><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif"><a href="#" onClick="javascript:sndReq('change_pass')">[change password]</a></font>
                <div id="editarea" class="linkageStuff">
                
					</div>
				</td>
              </tr>
              <tr>
                <td><div align="right"><font color="#FFFFFF"><font size="1"><font size="1"><font face="Arial, Helvetica, sans-serif"><font face="Arial, Helvetica, sans-serif"></font></font></font></font></font></div></td>
                <td><font size="1" face="Arial, Helvetica, sans-serif">&nbsp;</font></td>
              </tr>
            </table>
            </td>
          </tr>
          <tr bgcolor="#333366">
            <td colspan="2"><font color="#FFFFFF">
              <?php require_once('58ss_includes/58disclaimer.php'); ?>
            </font></td>
          </tr>
        </table>
      </div>
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
<?php }?>