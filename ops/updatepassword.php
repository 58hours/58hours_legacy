<?

require_once('../_includes/rhcommon.php');

if((strlen($_COOKIE['client_id_hash'])<40)||(strlen($_COOKIE['client_pass_hash'])<40))
{
	echo "cookie mismatch";
//header("Location: http://58hours.com");
}
else{

//if(($_SERVER['HTTP_REFERER']!="http://58.randomhours.com/user_shows.php")&&($_SERVER['HTTP_REFERER']!="https://58.randomhours.com/ops/updatepassword.php"))
//{
	//header("location: http://58.randomhours.com");
//}
//else
//{
$cssDEF ="<link href=\"../css/styles.css\" rel=\"stylesheet\" type=\"text/css\" /><script language='javascript'>
function goAwayIFrame(message)
{
	parent.resetUserActionField(message);
}

function checkform()
{
	if(document.updpass.newpass.value==document.updpass.oldpass.value)
	{
		document.updpass.oldpass.value = '';
		document.updpass.newpass.value = '';
		document.updpass.confirmpass.value='';
		alert('Eh?\\nYour new password can\'t match the old one.');
	}
	else if(document.updpass.newpass.value==document.updpass.confirmpass.value)
	{
		document.updpass.submit();
	}
	else
	{
		document.updpass.newpass.value = '';
		document.updpass.confirmpass.value='';
		alert('New passwords do not match.');
	}
}</script>
";
echo $cssDEF."<div class='linkageStuff'>";
$passwordForm ="<form name='updpass' action='updatepassword.php' method='POST' ><table class=\"linkageStuff\"><tr><td>
Old password
</td><td><input type='password' name='oldpass' class=\"58formstyle\" size=10/></td></tr>
<tr><td>
New password
</td><td><input name='newpass' type='password' class=\"58formstyle\" size=10/></td></tr><tr><td>
Confirm new password
</td><td><input name='confirmpass' type='password' class=\"58formstyle\" size=10/></td></tr>
<tr><td colspan='2' align='right'><input type='hidden' name='action' value='updatepass'><a href='javascript:checkform()'>[SUBMIT]</a></td></tr>
</table></form>";
if(empty($_GET)&&empty($_POST)){
	echo $passwordForm;
}
elseif($_POST['action']=="updatepass")
{
	if(!empty($_POST['oldpass']))
	{
		$cleanOldPass = GetSQLValueString($_POST['oldpass'],"text");
		$cryptedOldPass = md5($_POST['oldpass']);
		$cleanNewPass = GetSQLValueString($_POST['newpass'],"text");
		$cryptedNewPass = md5($_POST['newpass']);
		$cleanClientId = GetSQLValueString($_COOKIE['client_id_hash'],"text");
		$cleanClientPass = GetSQLValueString($_COOKIE['client_pass_hash'],"text");
		
		require_once('../Connections/random_connect.php');
		// first we retrieve their secure information
		
		mysql_select_db($database_random_connect, $random_connect);
		$query_oldpass = sprintf("SELECT pn_pass, external_user_id, password_changed_times  
		FROM rhr_users 
		WHERE client_key_userid = %s 
		AND client_key_pass = %s", GetSQLValueString($_COOKIE['client_id_hash'],"text"), GetSQLValueString($_COOKIE['client_pass_hash'],"text"));
		$oldpass = mysql_query($query_oldpass, $random_connect) or die(mysql_error());
		$row_oldpass = mysql_fetch_assoc($oldpass);
		$totalRows_oldpass = mysql_num_rows($oldpass);
		if($totalRows_oldpass==1)
		{
			if($row_oldpass['pn_pass']==$cryptedOldPass)
			{
				if($totalRows_oldpass==1)
				{
					$newsql_rq = sprintf("UPDATE rhr_users SET pn_pass = %s, password_changed_times = %s, password_last_changed = %s WHERE external_user_id = %s AND client_key_userid = %s AND client_key_pass = %s", GetSQLValueString($cryptedNewPass,"text"), GetSQLValueString($row_oldpass['password_changed_times']+1,"int"), GetSQLValueString(date('Y-m-d H:i:s'),"text"),
					GetSQLValueString($row_oldpass['external_user_id'],"text"), GetSQLValueString($_COOKIE['client_id_hash'],"text"), GetSQLValueString($_COOKIE['client_pass_hash'],"text"));
					$passupdate = mysql_query($newsql_rq, $random_connect) or die();
					if($passupdate==1)
					{
						echo "<script language='javascript'> goAwayIFrame('Your password has been successfully updated.');</script>";
					}
					else
					{
						echo "Unable to update database, please try again.  If this error persists, please contact brian.".$passwordForm;
					}
				}
				else echo "A server/database error has occured.  please try again later.  if this persists, contact brian.";
			}
			else echo "Incorrect old password.".$passwordForm;
		}
		else echo "ERROR: your session is not registered with the database.  Please log out, log in & try changing your password again.".$passwordForm;
		
	}
	else echo "Please enter your old password.<br />".$passwordForm;	
	//header()
	
	// now let's double-check that old password versus the one in our db
	
	
	// and since that passed, let's go ahead & update their record
}
//else echo $_SERVER['QUERY_STRING'];
echo "</div>";
}
?>