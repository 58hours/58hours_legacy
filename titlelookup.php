<?php require_once('Connections/radioRecords.php'); ?>
<?
// mobile title lookup

$importedVars = $_GET;

$queriedTitle = $_GET['lookup'];

$colname_trackDetails = $_GET['lookup'];
//if (isset($queriedTitle)) {
 // $colname_trackDetails = (get_magic_quotes_gpc()) ? $queriedTitle : //addslashes($queriedTitle);
//}
mysql_select_db($database_radioRecords, $radioRecords);
$query_trackDetails = sprintf("SELECT * FROM titleresolver WHERE trackTitle LIKE '%s'", ($colname_trackDetails.'%'));
$trackDetails = mysql_query($query_trackDetails, $radioRecords) or die(mysql_error());
$row_trackDetails = mysql_fetch_assoc($trackDetails);
$totalRows_trackDetails = mysql_num_rows($trackDetails);

if(mysql_num_rows($trackDetails)<1) echo "none found";
else
{
	echo "activeresponse|";
	do 
	{ 
    	echo $row_trackDetails['trackID'];
    	echo " / ";
    	echo $row_trackDetails['trackTitle'];
    	echo "<br>";
    }
    while ($row_trackDetails = mysql_fetch_assoc($trackDetails));
}

//echo "activeresponse|hello world!";
//echo "<br> <a href =\"titlelookuptest.html\">back</a>";
?>