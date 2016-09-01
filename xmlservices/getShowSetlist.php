<?php require_once('../Connections/radioRecords.php'); 
$incpath = "/home/httpd/vhosts/58hours.com/httpdocs/xmlservices/";

require($incpath."preparexmlresponse.php");
// preprocess our showID & make sure that it's valid
$internalShowID = $_GET['showID'];
if( number_format($internalShowID)!=$internalShowID) header("location: http://58hours.com");


function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  $theValue = (!get_magic_quotes_gpc()) ? addslashes($theValue) : $theValue;

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? "'" . doubleval($theValue) . "'" : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}

$colname_setlistDetails = "9999";
if (isset($HTTP_GET_VARS['showID'])) {
  $colname_setlistDetails = (get_magic_quotes_gpc()) ? $HTTP_GET_VARS['showID'] : addslashes($HTTP_GET_VARS['showID']);
}


mysql_select_db($database_radioRecords, $radioRecords);
$query_setlistDetails = sprintf("SELECT livetracks_db.showID, livetracks_db.songNumber, titleresolver.trackTitle, titleresolver.trackID, livetracks_db.songType FROM livetracks_db, titleresolver WHERE titleresolver.trackID = livetracks_db.trackID AND livetracks_db.showID = %s ORDER BY livetracks_db.songNumber", $colname_setlistDetails);
$setlistDetails = mysql_query($query_setlistDetails, $radioRecords) or die(mysql_error());
$row_setlistDetails = mysql_fetch_assoc($setlistDetails);
$totalRows_setlistDetails = mysql_num_rows($setlistDetails);

// and this is where it creates the xml to send back to the flash... or to the xslt.
echo addOutboundXMLheader();
echo "\n<response method=\"getShowSetlist\" status=\"success\" />";
echo "\n<show>";
echo "\n\t<setlist>";
do { 
	echo "\n\t\t<item num=\"".$row_setlistDetails['songNumber']."\" "; 
   	echo "id=\"".$row_setlistDetails['trackID']."\" ";
	echo "type=\"". $row_setlistDetails['songType']."\" ";
	echo ">".$row_setlistDetails['trackTitle']."</song>";
} while ($row_setlistDetails = mysql_fetch_assoc($setlistDetails));
echo "\n\t</setlist>";
echo "\n</show>";
mysql_close($radioRecords);
 ?>