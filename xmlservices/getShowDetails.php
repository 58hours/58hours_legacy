<?php require_once('../Connections/radioRecords.php'); 

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

$colname_showDetails = "1";
if (isset($HTTP_GET_VARS['showID'])) {
  $colname_showDetails = (get_magic_quotes_gpc()) ? $HTTP_GET_VARS['showID'] : addslashes($HTTP_GET_VARS['showID']);
}
mysql_select_db($database_radioRecords, $radioRecords);
$query_showDetails = sprintf("SELECT showlist_db.showEventName, showlist_db.f8_show_id, showlist_db.show_tour, showlist_db.showSupport1, showlist_db.showComments, countryresolver.countryName, countryresolver.countryID, localityresolver.localityName, localityresolver.localityID, cityresolver.cityName, cityresolver.cityID, venuedetails.venueName, showlist_db.showID, venuedetails.venueID, showlist_db.showDate FROM showlist_db, tourresolver, venuedetails, cityresolver, localityresolver, countryresolver WHERE cityresolver.localityID = localityresolver.localityID AND localityresolver.countryID = countryresolver.countryID AND venuedetails.venueCity = cityresolver.cityID AND venuedetails.venueID = showlist_db.showVenueID AND showlist_db.showID = %s", $colname_showDetails);
$showDetails = mysql_query($query_showDetails, $radioRecords) or die(mysql_error());
$row_showDetails = mysql_fetch_assoc($showDetails);
$totalRows_showDetails = mysql_num_rows($showDetails);

echo '<?xml version="1.0" encoding="ISO-8859-1"?>';
echo "\n<response method=\"getShowDetails\" status=\"success\" />";
echo "\n<showDetails id=\"".$row_showDetails['showID']."\" sysID=\"".$row_showDetails['f8_show_id']."\" date=\"";
echo date('l, F d, Y',strtotime($row_showDetails['showDate']))."\">";
echo "\n\t<lineup>";
echo "\n\t\t<artist type=\"0\" id=\"00sah5JHs_\">Radiohead</artist>";
echo "\n\t</lineup>";
echo "\n\t<geoprops>";
echo "\n\t\t".'<geoprop type="ve" id="'.$row_showDetails['venueID'].'">'.$row_showDetails['venueName'].'</geoprop>';
echo "\n\t\t".'<geoprop type="ci" id="'.$row_showDetails['cityID'].'">'.$row_showDetails['cityName'].'</geoprop>';
echo "\n\t\t".'<geoprop type="lo" id="'.$row_showDetails['localityID'].'">'.$row_showDetails['localityName'].'</geoprop>';
echo "\n\t\t".'<geoprop type="co" id="'.$row_showDetails['countryID'].'">'.$row_showDetails['countryName'].'</geoprop>';
echo "\n\t</geoprops>";
echo "\n".'</showDetails>';
 ?>

