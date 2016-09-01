<?php // signup.php
require_once('recaptchalib.php');
require_once('_includes/rhcommon.php');
require_once('Connections/random_connect.php');
include("register/common.php");

mysql_select_db($database_random_connect, $random_connect);
//include("register/db.php");
    ?>
<?php if($_COOKIE['client_id_hash']) header("Location: index.php");
else {?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>58hours/randomhours | member registration.</title>
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
          <param name="movie" value="trackName.swf?name=58hours+Member+Registration" />
          <param name="quality" value="high" /><param name="BGCOLOR" value="#000000" />
          <embed src="trackName.swf?name=58hours+Member+Registration" width="450" height="30" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" bgcolor="#000000"></embed>
        </object></noscript>
        </font></td>
    </tr>
    <tr>
      <td colspan="2" bgcolor="#000000"><span class="style6">If you've already registered, and have forgotten your password, email <a href="mailto:headmaster@58hours.com">Brian</a>.</span><br>
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
                  <td align="right" nowrap="nowrap"><img src="/register/images/reg_uid.gif" width="91" height="20" /></td>
                  <td valign="top"><font size="1" face="Arial, Helvetica, sans-serif">
                    <input name="newid" type="text" maxlength="100" size="25" />
                  <span class="style5"><tt>*</tt></span></font> </td>
                </tr>
                <tr>
                  <td align="right" nowrap="nowrap"><img src="/register/images/reg_name.gif" width="91" height="20" /></td>
                  <td valign="top"><font size="1" face="Arial, Helvetica, sans-serif">
                    <input name="newname" type="text" maxlength="100" size="25" />
                  <font color="orangered" class="style5"><tt><b>*</b></tt></font></font> </td>
                </tr>
                <tr>
                  <td align="right" nowrap="nowrap"><img src="/register/images/reg_email.gif" /></td>
                  <td valign="top"><font size="1" face="Arial, Helvetica, sans-serif">
                    <input name="newemail" type="text" maxlength="100" size="25" />
                  <font color="orangered" class="style5"><tt><b>*</b></tt></font></font> </td>
                </tr>
                <tr valign="top">
                  <td colspan="2" align="left" nowrap="nowrap"><img src="register/images/reg_human.gif" alt="Are You Human?" width="91" height="20" /><font size="1" face="Arial, Helvetica, sans-serif"> <font color="orangered" class="style5"><tt><b>*</b></tt></font></font><br/>
                  <? 
				  //require_once('recaptchalib.php');
					$publickey = "6LeaLgEAAAAAAI0hRGy1Mbr9r_pU92m5LGdtsTYv"; // you got this from the signup page
					echo recaptcha_get_html($publickey);
				  
				  
				  ?></td>
                </tr>
                <tr>
                  <td align="right" colspan="2"><div align="left"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif"> <tt class="style5"><b>*</b></tt> Required<br />
                    <br />
                    Your email address will not appear anywhere on the site, will not be shared, and is simply used to complete your registration. Your password &amp; confirmation will be sent to the address you provide.</font></div>
                      <p></p>
                      <font size="1" face="Arial, Helvetica, sans-serif">
                      <input type="reset" value="Reset Form" />
                      <input type="submit" name="submitok" value="   OK   " />
                    </font></td>
                </tr>
              </table>
          </form><br/>
          <span class="style6">NOTE: if you registered with 58hours.com earlier, <a href="index.php">try logging in with your former login &amp; pass...</a> <br />
we've attempted to preserve the old member structure during the upgrade... <br />
          </span>
          <?php
else:
    // Process signup submission
    // dbConnect('rh_main');

    if ($_POST['newid']=='' or $_POST['newname']==''
      or $_POST['newemail']=='') {
        error('One or more required fields were left blank.\\n'.
              'Please fill them in and try again.');
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
	$nid = GetSQLValueString($_POST[newid],"text");
    $sql = sprintf("SELECT COUNT(*) FROM rhr_users WHERE pn_uname = %s", $nid);
    $result = mysql_query($sql);
    if (!$result) {	
        error('A database error occurred in processing your '.
              'submission.\\nIf this error persists, please '.
              'contact registation@58hours.com.');
    }
    if (mysql_result($result,0,0)>0) {
        error('A user already exists with your chosen userid.\\n'.
              'Please try another.');
    }
    
    $newpass = substr(md5(time()),0,6);
    
    
    do
		{
			$new_external_id = str_makerand(16,16,true,true,true);
			$new_ex_id = $new_external_id;
			mysql_select_db($database_random_connect, $random_connect);
			$query_checkid = sprintf("SELECT * FROM rhr__global_idtracker WHERE external_id = '%s'", $new_external_id);
			$checkid = mysql_query($query_checkid, $random_connect) or die(mysql_error());
			//$row_currentGroup = mysql_fetch_assoc($currentGroup);
			$totalRows_checkid = mysql_num_rows($checkid);
			

		} while($totalRows_checkid>0);
    
    
    $sql = sprintf("INSERT INTO rhr_users SET
              external_user_id = %s,
              pn_uname = %s,
              pn_pass = '".md5($newpass)."',
              pn_name = %s,
              pn_email = %s,
              pn_user_regdate = %s,
              user_reg_band = %s",
              GetSQLValueString($new_ex_id,"text"), 
              GetSQLValueString($_POST[newid],"text"), 
              GetSQLValueString($_POST[newname],"text"),
              GetSQLValueString($_POST[newemail],"text"),
              GetSQLValueString(time(),"text"),
              GetSQLValueString('681qWLg',"text"));
    if (!mysql_query($sql))
        error('A database error occurred in processing your '.
              'submission.\\nIf this error persists, please '.
              'contact registration@58hours.com.\\n' . mysql_error());
              
              
    // and then we need to enter the new ID into the global ID tracker
    $insertSQL = sprintf("INSERT INTO rhr__global_idtracker (external_id) VALUES (%s)", GetSQLValueString($new_ex_id, "text"));
	mysql_select_db($database_random_connect, $random_connect);
	$Result2 = mysql_query($insertSQL, $random_connect) or die(mysql_error());
    // Email the new password to the person.
    $message = "Success.

Your personal account for 58hours and randomhours has been created! You now have the ability to \"claim\" shows and see your own personal show statistics.  Your new account may be used anywhere on randomhours (including 58hours).  To log in, proceed to the following address:

    http://58hours.com/

Your personal login ID and password are as
follows:

    userid: $nid
    password: $newpass

You aren't stuck with this password! Your can
change it at any time after you have logged in.

If you have any problems, feel free to contact me at
<registration@58hours.com>.

-Brian
 Headmaster of randomhours and 58hours.com
";
	// changed the following. wrapped the $_POST in a getSqlValueString call
    mail(GetSQLValueString($_POST['newemail'],"text"),"Welcome to 58hours and randomhours!",
         $message, "From:58hours staff <registration@58hours.com>");
         
    ?>
	<p class="style7">Aces! <br />
	  Your registration was successful.</p>
    <p class="style6">Your requested userid and a pregenerated password have been emailed to
       <strong><? 
       // changed the following. wrapped the $_POST in a getSqlValueString call
       echo GetSQLValueString($_POST['newemail'],"text"); ?></strong> (the email address
       you just provided in your registration form). To log in,
       click <a href="index.php">here</a> to return to the login
       page, and enter your userid and the password we've provided. Once you log in,
       you can change your password to something a bit more memorable. </p>
    <?php
endif;
?>	  </td>
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
<script src="http://www.google-analytics.com/urchin.js" type="text/javascript">
</script>
<script type="text/javascript">
_uacct = "UA-584621-1";
urchinTracker();
</script>
</body>
</html>
<?php } ?>
