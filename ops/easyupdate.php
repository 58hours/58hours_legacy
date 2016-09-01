<?
if($_GET['action']=="change_pass")
{
	echo "editarea|<iframe FRAMEBORDER='0' src='http://58hours.com/ops/updatepassword.php'/>";
}
elseif($_GET['action']=="finishpassupdate")
{
	echo "";
} else {
	echo "no response";
}
	


?>