<?php 
require_once('Connections/random_connect.php');
require_once('_includes/SITEARTIST.php');
require_once('_includes/rhcommon.php');

$totalRows_internalInfo = 0;

if ($_COOKIE['client_id_hash'] != "")
{
	//get the actual userid which corresponds to the client_id
	$query_internalInfo = sprintf("SELECT * FROM rhr_users WHERE client_key_userid = %s AND client_key_pass = %s", GetSQLValueString($_COOKIE['client_id_hash'],"text"), GetSQLValueString($_COOKIE['client_pass_hash'],"text"));
	$internalInfo = mysql_query($query_internalInfo, $random_connect) or die(mysql_error());
	$row_internalInfo = mysql_fetch_assoc($internalInfo);
	$totalRows_internalInfo = mysql_num_rows($internalInfo);
	$internal_userid = $row_internalInfo['external_user_id'];
}
if($totalRows_internalInfo!=1 || !isset($_GET['external_show_id'])) header("location: /index.php");

$targetShowID = GetSQLValueString($_GET['external_show_id'], "text");

?>