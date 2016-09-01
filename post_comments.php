<?php 
// 58hours
require_once('recaptchalib.php');
require_once('Connections/random_connect.php');
require_once('_includes/SITEARTIST.php');
require_once('_includes/rhcommon.php');
?>
<?php
// create a unique global id


$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . $_SERVER['QUERY_STRING'];
}



$recaptchaError = false;

$request_errata = (GetSQLValueString($_SERVER['REQUEST_METHOD'], "text").", ".GetSQLValueString($_SERVER['QUERY_STRING'], "text").", ".GetSQLValueString($_SERVER['HTTP_ACCEPT_LANGUAGE'], "text").", ".GetSQLValueString($_SERVER['HTTP_REFERER'], "text").", ".GetSQLValueString($_SERVER['HTTP_USER_AGENT'], "text"));
	


if (((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) && ($_SERVER["REMOTE_ADDR"]!=null) ) 
{

	$privatekey = "6LeaLgEAAAAAAKL4n94aWJPL_2Jh-nAx98BtDWF4";
	$resp = recaptcha_check_answer ($privatekey,
                                $_SERVER["REMOTE_ADDR"],
                                $_POST["recaptcha_challenge_field"],
                                $_POST["recaptcha_response_field"]);
	
	if (!$resp->is_valid || ($_SERVER['HTTP_ACCEPT_LANGUAGE']==NULL)) 
	{
		$recaptchaError = true;
		
		$enteredInErrorTrap = true;
		
		$request_errata = (GetSQLValueString($_SERVER['REQUEST_METHOD'], "text").", ".GetSQLValueString($_SERVER['QUERY_STRING'], "text").", ".GetSQLValueString($_SERVER['HTTP_ACCEPT_LANGUAGE'], "text").", ".GetSQLValueString($_SERVER['HTTP_REFERER'], "text").", ".GetSQLValueString($_SERVER['HTTP_USER_AGENT'], "text"));
		//echo $request_errata;
		$new_globalid = get_unused_globalid($database_random_connect, $random_connect);
		$insertSQL = sprintf("INSERT INTO rhr_hackErrorTrap (comment_text, comment_author, external_commenttopic_id, comment_active, comment_author_email, comment_submit_time, external_comment_id, comment_author_ip, trap_errata, recaptcha_fail) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString(htmlentities($_POST['posterComments']), "text"),
                       GetSQLValueString(htmlentities($_POST['posterName']), "text"),
                       GetSQLValueString($_POST['theShow'], "text"),
                       GetSQLValueString("0", "int"),
                       GetSQLValueString($_POST['posterEmail'], "text"),
                       GetSQLValueString(date('Y-m-d H:i:s'), "text"),
                       GetSQLValueString($new_globalid, "text"),
					   GetSQLValueString($_SERVER['REMOTE_ADDR'], "text"),
					   GetSQLValueString($request_errata, "text"),
					   "1");

  		mysql_select_db($database_random_connect, $random_connect);
  		$Result1 = mysql_query($insertSQL, $random_connect) or die(mysql_error());
	
	
		
  		//error("The reCAPTCHA wasn't entered correctly. Go back and try it again." ."(reCAPTCHA said: " . $resp->error . ")");
	}
	else
	{
		$new_globalid = get_unused_globalid($database_random_connect, $random_connect);
  		$insertSQL = sprintf("INSERT INTO rhr_comments (comment_text, comment_author, external_commenttopic_id, comment_active, comment_author_email, comment_submit_time, external_comment_id, comment_author_ip, comment_errata) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString(htmlentities($_POST['posterComments']), "text"),
                       GetSQLValueString(htmlentities($_POST['posterName']), "text"),
                       GetSQLValueString($_POST['theShow'], "text"),
                       GetSQLValueString("0", "int"),
                       GetSQLValueString($_POST['posterEmail'], "text"),
                       GetSQLValueString(date('Y-m-d H:i:s'), "text"),
                       GetSQLValueString($new_globalid, "text"),
					   GetSQLValueString($_SERVER['REMOTE_ADDR'], "text"),
					   GetSQLValueString($request_errata,"text"));

  		mysql_select_db($database_random_connect, $random_connect);
  		$Result1 = mysql_query($insertSQL, $random_connect) or die(mysql_error());
  
  		// and then add the new commentid to the globalid tracker
  
  		$insertSQL = sprintf("INSERT INTO rhr__global_idtracker (external_id) VALUES (%s)", GetSQLValueString($new_globalid, "text"));

  		mysql_select_db($database_random_connect, $random_connect);
  		$Result2 = mysql_query($insertSQL, $random_connect) or die(mysql_error());
  
  
  
  
  

		//$sendableShow=$_POST['external_show_id'];
		$sendableShow= GetSQLValueString($_POST['theShow'], "text");
  		$insertGoTo = "send58mail.php?external_show_id='$sendableShow'";
  		if (isset($_SERVER['QUERY_STRING'])) {
    		$insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    		$insertGoTo .= $_SERVER['QUERY_STRING'];
  		}
  		header(sprintf("Location: %s", $insertGoTo));
  	}
}
else if($_SERVER["REMOTE_ADDR"]==null)
{
	
		
		$new_globalid = get_unused_globalid($database_random_connect, $random_connect);
		$insertSQL = sprintf("INSERT INTO rhr_hackErrorTrap (comment_text, comment_author, external_commenttopic_id, comment_active, comment_author_email, comment_submit_time, external_comment_id, comment_author_ip, trap_errata, recaptcha_fail) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString(htmlentities($_POST['posterComments']), "text"),
                       GetSQLValueString(htmlentities($_POST['posterName']), "text"),
                       GetSQLValueString($_POST['theShow'], "text"),
                       GetSQLValueString("0", "int"),
                       GetSQLValueString($_POST['posterEmail'], "text"),
                       GetSQLValueString(date('Y-m-d H:i:s'), "text"),
                       GetSQLValueString($new_globalid, "text"),
					   GetSQLValueString($_SERVER['REMOTE_ADDR'], "text"),
					   GetSQLValueString($request_errata, "text"),
					   "0");

  		mysql_select_db($database_random_connect, $random_connect);
  		$Result1 = mysql_query($insertSQL, $random_connect) or die(mysql_error());
	
	
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>58.randomhours - Posting a comment.</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<script language="JavaScript" type="text/JavaScript">
<!--
function MM_callJS(jsStr) { //v2.0
  return eval(jsStr)
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_validateForm() { //v4.0
  var i,p,q,nm,test,num,min,max,errors='',args=MM_validateForm.arguments;
  for (i=0; i<(args.length-2); i+=3) { test=args[i+2]; val=MM_findObj(args[i]);
    if (val) { nm=val.name; if ((val=val.value)!="") {
      if (test.indexOf('isEmail')!=-1) { p=val.indexOf('@');
        if (p<1 || p==(val.length-1)) errors+='- '+nm+' must contain an e-mail address.\n';
      } else if (test!='R') { num = parseFloat(val);
        if (isNaN(val)) errors+='- '+nm+' must contain a number.\n';
        if (test.indexOf('inRange') != -1) { p=test.indexOf(':');
          min=test.substring(8,p); max=test.substring(p+1);
          if (num<min || max<num) errors+='- '+nm+' must contain a number between '+min+' and '+max+'.\n';
    } } } else if (test.charAt(0) == 'R') errors += '- '+nm+' is required.\n'; }

  } if (errors) alert('The following error(s) occurred:\n'+errors);
  document.MM_returnValue = (errors == '');
}
//-->
</script>
</head>

<body bgcolor="#000033" text="#FFFFFF" link="#FFFFFF" vlink="#FFFFFF" alink="#FFFFFF">
<p><font size="1" face="Arial, Helvetica, sans-serif"><?php 
if ($_GET['commentCat']=="site") 
{
	echo "Site comments/questions";
} 
else 
{
	echo "Post Show review/comments ";
} ?></font></p>
<?php 
if ( ( ( strlen($_GET['external_show_id'])>=8) && (!$_GET['state'])) || ($_GET['commentCat']=="site")) 
{ // Show if valid external_show_id supplied ?>
<form name="form1" id="form1" method="POST" action="<?php echo $editFormAction; ?>">
<table width="400" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><font size="1" face="Arial, Helvetica, sans-serif">Comments:</font></td>
  </tr>
  <tr>
    <td><font size="1" face="Arial, Helvetica, sans-serif">
      <textarea name="posterComments" cols="50" rows="5" id="posterComments"></textarea>
    </font></td>
  </tr>
  <tr>
    <td><font size="1" face="Arial, Helvetica, sans-serif">&nbsp;</font></td>
  </tr>
  <tr>
    <td><font size="1" face="Arial, Helvetica, sans-serif"><br />
      Name:</font></td>
  </tr>
  <tr>
    <td><font size="1" face="Arial, Helvetica, sans-serif">
      <input name="posterName" type="text" id="posterName" />
    </font></td>
  </tr>
  <tr>
    <td><font size="1" face="Arial, Helvetica, sans-serif"><br />
      e-mail: <?php if (!$_GET['commentCat']) {echo "(yeah, I may verify this before activating your post!)";} ?></font></td>
  </tr>
  <tr>
    <td><font size="1" face="Arial, Helvetica, sans-serif">
    
    
      <input name="posterEmail" type="text" id="posterEmail" />
    </font></td>
  </tr>
  <tr valign="top">
                  <td colspan="2" align="left" nowrap="nowrap"><img src="register/images/reg_human.gif" alt="Are You Human?" width="91" height="20" /><font size="1" face="Arial, Helvetica, sans-serif"> <font color="orangered" class="style5"><tt><b>*</b></tt></font></font><br/>
				  <?
				  
				  if($recaptchaError)
				  {
				  	echo "Recaptcha error, please try again.<br>";
				  }
				   
				  //require_once('recaptchalib.php');
					$publickey = "6LeaLgEAAAAAAI0hRGy1Mbr9r_pU92m5LGdtsTYv"; // you got this from the signup page
					echo recaptcha_get_html($publickey);
				  
				  
				  ?></td>
                </tr>
  <tr>
    <td>
	<input type="reset" name="Submit2" value="Reset" />
    <input name="Submit" type="submit" onclick="MM_validateForm('posterName','','R','posterEmail','','RisEmail','posterComments','','R');return document.MM_returnValue" value="Send it off!"/>
      <br />
      </td>
  </tr>
</table>
<input name="theShow" type="hidden" id="theShow" value="<?php if($_GET['commentCat']=="site") {echo "G0SjQOCDaJkEyhOf";} else echo $_GET['external_show_id']; ?>">
<input type="hidden" name="MM_insert" value="form1">
<input name="prestat" type="hidden" id="prestat" value="0" />
</form>
<?php 
} ?>
<p><?php if ($_GET['state']=="posted") 
{ 
	if(!$enteredInErrorTrap)
	{
	// Show if recordset not empty 
	?>
  <font size="1" face="Arial, Helvetica, sans-serif">Thanks!<br />
  <br />
  Your comments have been received and will be displayed as soon as the small army of rhesus monkeys here on the 58hours staff get a chance to look it over.</font>  </p>
<p>&nbsp;</p>
<form name="form2" id="form2" method="post" action="">
  <input name="closeWindow" type="button" id="closeWindow" onclick="MM_callJS('window.close();')" value="close window" />
</form>
  <?php 
  } 
  else
  { ?>
  	<font size="1" face="Arial, Helvetica, sans-serif">Sorry, no dice!<br />
  <br />
  Your comment was flagged as spam.<br /><br />Your comments, IP address and browser information have been recorded in our spam comment trap, where they will never see the light of day.<br />
  I suggest you find other sites on which to peddle your wares.<br /><br />
  If you feel you didn't deserve to receive this warning, try again later and/or contact Brian.</font>  </p>
<p>&nbsp;</p>
<form name="form2" id="form2" method="post" action="">
  <input name="closeWindow" type="button" id="closeWindow" onclick="MM_callJS('window.close();')" value="close window" />
</form>
  <? 
  	}
  }
  ?> 
  <script src="http://www.google-analytics.com/urchin.js" type="text/javascript">
</script>
<script type="text/javascript">
_uacct = "UA-584621-1";
urchinTracker();
</script>
</body>
</html>
