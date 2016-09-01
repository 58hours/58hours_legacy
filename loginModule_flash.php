<?php
if($_COOKIE['client_id_hash'])
{
echo "LOGGED IN<br /><a href=\"user_shows.php\">View Account Info</a><br /><a href=\"logout.php\">LOGOUT</a>";
}
else
{
//echo "<form name=\"userlogin\" id=\"userlogin\" method=\"post\" action=\"loginuser.php\">";
//echo "<strong>Username:</strong>";  
//echo "<input name=\"usernm\" type=\"text\" id=\"usernm\" size=\"10\"/><br />";
//echo "<strong>Password:</strong>";
//echo "<input name=\"passwd\" type=\"password\" id=\"passwd\" size=\"10\"/><br />";
//echo "<input type=\"submit\" name=\"Submit\" value=\"LOGIN\" /><br /> or <a href=\"regMember.php\">register</a>";
//echo "</form>";

echo '<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,0,0" width="210" height="315" id="loginbox" align="middle">
	<param name="allowScriptAccess" value="sameDomain" />
	<param name="allowFullScreen" value="false" />
	<param name="movie" value="/flash_elements/loginbox.swf" /><param name="quality" value="high" /><param name="bgcolor" value="#ffffff" />	<embed src="flash_elements/loginbox.swf" quality="high" bgcolor="#ffffff" width="210" height="315" name="loginbox" align="middle" allowScriptAccess="sameDomain" allowFullScreen="false" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />
	</object>';

}
?>