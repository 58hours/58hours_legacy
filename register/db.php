<?php // db.php

$dbhost = 'localhost';
$dbuser = 'user58db';
$dbpass = 'a8hren5';

function dbConnect($db='') {
    global $dbhost, $dbuser, $dbpass;
    
    $dbcnx = @mysql_connect($dbhost, $dbuser, $dbpass)
        or die('The site database appears to be down. Please try again later.  If this conditon persists, please notify Brian.');

    if ($db!='' and !@mysql_select_db($db))
        die('The site database is unavailable. Please try again later.  If this conditon persists, please notify Brian.');
    
    return $dbcnx;
}
?>
