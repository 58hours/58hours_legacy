<?php 
if($_POST['passwd']==null || $_POST['usernm']==null) header("location: /index.php");

require_once('Connections/random_connect.php');
require_once('_includes/SITEARTIST.php');
require_once('_includes/rhcommon.php');

// should put some sort of login attempt throttle in here

$passcheck = "";

mysql_select_db($database_random_connect, $random_connect);
$query = sprintf("SELECT * FROM rhr_users 
WHERE pn_uname = %s", GetSQLValueString($_POST['usernm'],"text"));
$result = mysql_query ($query) or die ("Query failed");
$row_result = mysql_fetch_assoc($result);


if($row_result['salted']=='1')
{
	
	$passcheck = GetSQLValueString($_POST['passwds'],"text");
}
else
{
	$passcheck = GetSQLValueString($_POST['passwd'],"text");
}

mysql_select_db($database_random_connect, $random_connect);
$query = sprintf("SELECT * FROM rhr_users 
WHERE pn_pass = %s 
AND pn_uname = %s", $passcheck, GetSQLValueString($_POST['usernm'],"text"));
$q2 = mysql_query ($query) or die ("Query failed");

// printing HTML result
if(mysql_num_rows($q2)==1)
{
	$row_q2 = mysql_fetch_assoc($q2);
	$internal_numTimesLogged = intval($row_q2['login_times']);
	$internal_numTimesLogged += 1;
	//$resState="success";
	session_set_cookie_params(2000);
	session_start();
	
	// create a new client id for the cookie
	$c_id_key = str_makerand(40,40,true,true,true);
	
	// create a new client pass for the cookie
	$c_pass_key = str_makerand(40,40,true,true,true);
	
	// and store the new values:
	mysql_select_db($database_random_connect, $random_connect);
	$query = sprintf("UPDATE rhr_users SET client_key_userid = %s, client_key_pass = %s, client_key_ip = %s, login_times = %s, client_key_issued = %s WHERE pn_uname = %s", GetSQLValueString($c_id_key,"text"), GetSQLValueString($c_pass_key,"text"), GetSQLValueString($_SERVER['REMOTE_ADDR'],"text"), GetSQLValueString($internal_numTimesLogged,"int"), GetSQLValueString(date('Y-m-d H:i:s'),"text"), GetSQLValueString($_POST['usernm'],"text"));
	$qstore = mysql_query ($query) or die ("Query failed");
	
	setCookie("client_id_hash",$c_id_key,time()+60*60*2);
	setCookie("client_pass_hash",$c_pass_key,time()+60*60*2);
}
else
{
//echo "invalid credentials supplied";
setCookie("failure",session_id());
$resState="failure";
}
mysql_close($link);
header("Location: /");
exit();
?>
