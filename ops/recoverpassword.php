<?php // signup.php
require_once('../recaptchalib.php');
require_once('../_includes/rhcommon.php');
require_once('../Connections/random_connect.php');
include("../register/common.php");

mysql_select_db($database_random_connect, $random_connect);
//include("register/db.php");

$rPostflight = false;

    ?>
<?php 
if($_COOKIE['client_id_hash']) header("Location: index.php");

else if(isset($_GET['resetChecksum']) && isset($_GET['username'])) {
	$sql = sprintf("SELECT pn_email, pn_uname FROM rhr_users WHERE pn_interim_pass = %s AND pn_uname=%s", GetSQLValueString(md5($_GET['resetChecksum']),'text'), GetSQLValueString($_GET['username'],'text'));
	$result = mysql_query($sql);
	if(mysql_num_rows($result)==1) {
	    // proceed to reset the user's core pass & reset the interim_pass
	    $sql = sprintf("UPDATE rhr_users SET pn_pass = %s, pn_interim_pass = %s WHERE pn_interim_pass = %s AND pn_uname=%s",
	    GetSQLValueString(md5($_GET['newpass']),'text'),
	    NULL,
	    GetSQLValueString(md5($_GET['resetChecksum']),'text'),
	    GetSQLValueString($_GET['username'],'text'));
	    $result = mysql_query($sql);
	    echo "reset complete";
	}
	else
	{
		echo "wrong block";
	}
}
else if(isset($_GET['p'])) {
	echo "finishing postflight for '".$_GET['p']." code.";
	
	$sql = sprintf("SELECT pn_email, pn_uname FROM rhr_users WHERE pn_interim_pass = %s", GetSQLValueString(md5($_GET['p']),'text'));
	$result = mysql_query($sql);
	if(mysql_num_rows($result)==1) {
		$rPostflight = true;
		$r = mysql_fetch_assoc($result);
		$postflightChecksum = getSQLValueString($_GET['p'],'text');
	}
	echo mysql_num_rows($result);
}
if($rPostflight == true) {
	echo "matching reset key found. let's do this.";
/////////////////////////////////////////////////////////////////////
	
	
	
?>
	
<!DOCTYPE html>
<html>
<head>
<title>58hours/randomhours | member registration.</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link href="css/styles.css" rel="stylesheet" type="text/css" />
<script language="JavaScript" type="text/JavaScript">
<!--
function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}
/*
function doesClientPassConfirm() {
	return 
}*/

//-->
</script>
<style type="text/css">
<!--
.style5 {
	color: #FF3300;
	font-weight: bold;
}
body {
	background-image: url(images/bgstripes.gif);
}
.style6 {color: #FFFFFF}
.style7 {
	color: #FFFFFF;
	font-size: 14px;
	font-weight: bold;
}
-->
</style>
<script src="Scripts/AC_RunActiveContent.js" type="text/javascript"></script>
</head>
<body bgcolor="#000000" text="#FFFFFF" link="#0066CC" vlink="#0066CC" alink="#0066CC" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" class="blueishlinks">
<br />
<table width="300" border="0" align="center" cellpadding="1" cellspacing="1" bgcolor="#FFFFFF">
  <tr>
    <td>
	<table width="800" align="center" cellpadding="0" cellspacing="0" cols="1" bgcolor="#FFFFFF" rows="2">
<tr>
  <td bgcolor="#000033"><a href="index.php"><img src="/i/rainbowheader_v2.jpg" alt="58hours.com registration" width="800" height="114" border="0" /></a></td>
  </tr><tr><td bgcolor="#FFFFFF">
  	<script type="text/javascript">
AC_FL_RunContent( 'codebase','http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0','width','800','height','20','src','flashStats','quality','high','pluginspage','http://www.macromedia.com/go/getflashplayer','movie','flashStats' ); //end AC code
</script><noscript><object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0" width="800" height="20">
      <param name="movie" value="flashStats.swf" />
      <param name="quality" value="high" />
      <embed src="flashStats.swf" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="800" height="20"></embed>
    </object></noscript></td>
</tr>
</table>
<div align="center">
  <table width="800" border="0" align="center" cellpadding="5" cellspacing="0" bgcolor="#FFFFFF">
    <tr>
      <td nowrap="nowrap" class="darkerLinkage"><font face="Arial, Helvetica, sans-serif">&nbsp;</font></td>
      <td align="right" valign="bottom" nowrap="nowrap">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="2" bgcolor="#000000"><font color="#999999" size="1" face="Arial, Helvetica, sans-serif">
        <script type="text/javascript">
AC_FL_RunContent( 'codebase','http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0','width','450','height','30','src','trackName?name=58hours+Member+Registration','quality','high','pluginspage','http://www.macromedia.com/go/getflashplayer','bgcolor','#000000','movie','trackName?name=58hours+Member+Registration' ); //end AC code
</script><noscript><object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0" width="450" height="30">
          <param name="movie" value="trackName.swf?name=58hours+Password+Recovery" />
          <param name="quality" value="high" /><param name="BGCOLOR" value="#000000" />
          <embed src="trackName.swf?name=58hours+Member+Registration" width="450" height="30" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" bgcolor="#000000"></embed>
        </object></noscript>
        </font></td>
    </tr>
    <tr>
      <td colspan="2" bgcolor="#000000"><span class="style6">Password reset code accepted. You're just about finished. Just choose a new password.</span><br>
        <br></td>
    </tr>
      <tr>
      <td colspan="2" bgcolor="#000000">
	  <?php if (!isset($_POST['submitok'])):
    // Display the user signup form
    ?>
	  <form method="post" action="<?=$_SERVER['PHP_SELF']?>">
              <table width="300" border="0" cellpadding="0" cellspacing="5" bgcolor="#000000">
                <tr>
                  <td align="right" nowrap="nowrap">Your Username:</td>
                  <td valign="top"><font size="1" face="Arial, Helvetica, sans-serif">
                    <input name="username" type="text" maxlength="100" size="25" />
                  </font> </td>
                </tr>
                <tr>
                  <td align="right" nowrap="nowrap">New Password:</td>
                  <td valign="top"><font size="1" face="Arial, Helvetica, sans-serif">
                    <input name="newpass" type="text" maxlength="100" size="25" />
                  </font> </td>
                </tr>
                <tr valign="top">
                  <td colspan="2" align="left" nowrap="nowrap"><img src="../register/images/reg_human.gif" alt="Are You Human?" width="91" height="20" /><font size="1" face="Arial, Helvetica, sans-serif"> <font color="orangered" class="style5"><tt><b>*</b></tt></font></font><br/>
                  <? 
				  //require_once('recaptchalib.php');
					$publickey = "6LeaLgEAAAAAAI0hRGy1Mbr9r_pU92m5LGdtsTYv"; // you got this from the signup page
					echo recaptcha_get_html($publickey);
				  ?></td>
                </tr>
                <tr>
                  <td align="right" colspan="2"><div align="left"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif"> <tt class="style5"><b>*</b></tt> Required<br />
                    <br />
                    	<input name="resetChecksum" type="hidden" value=<? echo $postflightChecksum; ?> />
                      <font size="1" face="Arial, Helvetica, sans-serif">
                      <input type="submit" name="submitok" value="   OK   " />
                    </font></td>
                </tr>
              </table>
          </form><br/>
          <?php
endif;
    
	
	
	
	
	
//////////////////////////////////////////////////////////////////////	
} else {
?>
<!DOCTYPE html>
<html>
<head>
<title>58hours/randomhours | member password reset.</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link href="css/styles.css" rel="stylesheet" type="text/css" />
<script language="JavaScript" type="text/JavaScript">
<!--
function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}
//-->
</script>
<style type="text/css">
<!--
.style5 {
	color: #FF3300;
	font-weight: bold;
}
body {
	background-image: url(images/bgstripes.gif);
}
.style6 {color: #FFFFFF}
.style7 {
	color: #FFFFFF;
	font-size: 14px;
	font-weight: bold;
}
-->
</style>
<script src="Scripts/AC_RunActiveContent.js" type="text/javascript"></script>
</head>
<body bgcolor="#000000" text="#FFFFFF" link="#0066CC" vlink="#0066CC" alink="#0066CC" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" class="blueishlinks">
<br />
<table width="300" border="0" align="center" cellpadding="1" cellspacing="1" bgcolor="#FFFFFF">
  <tr>
    <td>
	<table width="800" align="center" cellpadding="0" cellspacing="0" cols="1" bgcolor="#FFFFFF" rows="2">
<tr>
  <td bgcolor="#000033"><a href="index.php"><img src="/i/rainbowheader_v2.jpg" alt="58hours.com registration" width="800" height="114" border="0" /></a></td>
  </tr><tr><td bgcolor="#FFFFFF">
  	<script type="text/javascript">
AC_FL_RunContent( 'codebase','http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0','width','800','height','20','src','flashStats','quality','high','pluginspage','http://www.macromedia.com/go/getflashplayer','movie','flashStats' ); //end AC code
</script><noscript><object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0" width="800" height="20">
      <param name="movie" value="flashStats.swf" />
      <param name="quality" value="high" />
      <embed src="flashStats.swf" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="800" height="20"></embed>
    </object></noscript></td>
</tr>
</table>
<div align="center">
  <table width="800" border="0" align="center" cellpadding="5" cellspacing="0" bgcolor="#FFFFFF">
    <tr>
      <td nowrap="nowrap" class="darkerLinkage"><font face="Arial, Helvetica, sans-serif">&nbsp;</font></td>
      <td align="right" valign="bottom" nowrap="nowrap">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="2" bgcolor="#000000"><font color="#999999" size="1" face="Arial, Helvetica, sans-serif">
        <script type="text/javascript">
AC_FL_RunContent( 'codebase','http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0','width','450','height','30','src','trackName?name=58hours+Member+Registration','quality','high','pluginspage','http://www.macromedia.com/go/getflashplayer','bgcolor','#000000','movie','trackName?name=58hours+Member+Registration' ); //end AC code
</script><noscript><object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0" width="450" height="30">
          <param name="movie" value="trackName.swf?name=58hours+Password+Recovery" />
          <param name="quality" value="high" /><param name="BGCOLOR" value="#000000" />
          <embed src="trackName.swf?name=58hours+Member+Registration" width="450" height="30" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" bgcolor="#000000"></embed>
        </object></noscript>
        </font></td>
    </tr>
    <tr>
      <td colspan="2" bgcolor="#000000"><span class="style6">Provide your 58hours username & we'll email a new password to the address you registered with.</span><br>
        <br></td>
    </tr>
      <tr>
      <td colspan="2" bgcolor="#000000">
	  <?php if (!isset($_POST['submitok'])):
    // Display the user signup form
    ?>
	  <form method="post" action="<?=$_SERVER['PHP_SELF']?>">
              <table width="300" border="0" cellpadding="0" cellspacing="5" bgcolor="#000000">
                <tr>
                  <td align="right" nowrap="nowrap">Username</td>
                  <td valign="top"><font size="1" face="Arial, Helvetica, sans-serif">
                    <input name="newname" type="text" maxlength="100" size="25" />
                  <font color="orangered" class="style5"><tt><b>*</b></tt></font></font> </td>
                </tr>
                <tr valign="top">
                  <td colspan="2" align="left" nowrap="nowrap"><img src="../register/images/reg_human.gif" alt="Are You Human?" width="91" height="20" /><font size="1" face="Arial, Helvetica, sans-serif"> <font color="orangered" class="style5"><tt><b>*</b></tt></font></font><br/>
                  <? 
				  //require_once('recaptchalib.php');
					$publickey = "6LeaLgEAAAAAAI0hRGy1Mbr9r_pU92m5LGdtsTYv"; // you got this from the signup page
					echo recaptcha_get_html($publickey);
				  ?></td>
                </tr>
                <tr>
                  <td align="right" colspan="2"><div align="left"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif"> <tt class="style5"><b>*</b></tt> Required<br />
                    <br />
                      <font size="1" face="Arial, Helvetica, sans-serif">
                      <input type="submit" name="submitok" value="   OK   " />
                    </font></td>
                </tr>
              </table>
          </form><br/>
          <?php
else:
    // Process signup submission
    // dbConnect('rh_main');

    if ($_POST['newname']=='') {
        error('Please enter your username');
    }
    
	$privatekey = "6LeaLgEAAAAAAKL4n94aWJPL_2Jh-nAx98BtDWF4";
	$resp = recaptcha_check_answer ($privatekey,
                                $_SERVER["REMOTE_ADDR"],
                                $_POST["recaptcha_challenge_field"],
                                $_POST["recaptcha_response_field"]);

	if (!$resp->is_valid) {
  	error("The reCAPTCHA wasn't entered correctly. Go back and try it again." .
       "(reCAPTCHA said: " . $resp->error . ")");
	}
	
    // Check for existing user with the new id
	$nid = GetSQLValueString($_POST[newname],"text");
    $sql = sprintf("SELECT pn_email, pn_uname FROM rhr_users WHERE pn_uname = %s", $nid);
    $result = mysql_query($sql);
    if (!$result) {	
        error('A database error occurred in processing your '.
              'submission.\\nIf this error persists, please '.
              'contact registation@58hours.com.');
    }
    
    $recovery_email = "";
    $recovery_password = "";
    $recovery_username = "";
    
    if (mysql_num_rows($result)==1) {
    
    	$row = mysql_fetch_assoc($result);
    	$recovery_email = $row['pn_email'];
    	$recovery_password = substr(md5(time()),0,6);
    	$recovery_username = $row['pn_uname'];
    
        echo "found the user... email new pass to: ".$row['pn_email']."?";
        /*error('A user already exists with your chosen userid.\\n'.
              'Please try another.');
          */    
    } else {
    	echo "else";
    }
    
    
    if(sizeof($recovery_email)>0) {
    
    $sql = sprintf("UPDATE rhr_users SET
              pn_interim_pass = %s WHERE pn_uname = %s",
              GetSQLValueString(md5($recovery_password),'text'), GetSQLValueString($recovery_username,"text"));
    if (!mysql_query($sql)) error('A database error occurred in processing your submission.\nIf this error persists, please contact accounts@58hours.com.\n' . mysql_error());
    
    $message = "Hi.

	Someone has requested a password reset for your account ($recovery_username) at 58hours. If this wasn't you, go ahead and disregard this email.

	If this was indeed you, then copy and paste the following link into your browser to login to 58hours & select a new password.
	http://58hours.com/ops/recoverpassword.php?p=$recovery_password


If you have any problems, feel free to contact me at
<headmaster@58hours.com>.

-Brian
 Headmaster of randomhours and 58hours.com
";
	// changed the following. wrapped the $_POST in a getSqlValueString call
    mail($recovery_email,"Your 58hours password",
         $message, "From:58hours accounts<accounts@58hours.com>");
    
    echo "check your email. :)";
    }
    
    
    endif;
    } ?>
