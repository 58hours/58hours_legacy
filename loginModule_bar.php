<?php
if($HTTP_COOKIE_VARS['memberID'])
{
echo "LOGGED IN&nbsp;&nbsp;<a href=\"user_shows.php\">View Account Info</a>&nbsp;&nbsp;<a href=\"logout.php\">LOGOUT</a>";
}
else
{
echo "<form name=\"userlogin\" id=\"userlogin\" method=\"post\" action=\"loginuser.php\"><table><tr><td>";
echo "<strong>Username:</strong></td>";  
echo "<td><input name=\"usernm\" type=\"text\" id=\"usernm\" class=\"small\"/></td>";
echo "<td><strong>Password:</strong></td>";
echo "<td><input name=\"passwd\" type=\"password\" id=\"passwd\" class=\"small\" /></td>";
echo "<td><a href=\"#\"><img src=\"images/login_arrowbtn.gif\" alt=\"login\" border=\"0\"/></a><a href=\"regMember.php\"><img src=\"images/register_arrowbtn.gif\" border=\"0\" /></a></td>";
echo "</tr></table></form>";
}
?>