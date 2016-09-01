<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_presentation_connect = "localhost";
$database_presentation_connect = "randomstuff";
$username_presentation_connect = "acomdbuser";
$password_presentation_connect = "acompass";
$presentation_connect = mysql_pconnect($hostname_presentation_connect, $username_presentation_connect, $password_presentation_connect) or trigger_error(mysql_error(),E_USER_ERROR); 
?>