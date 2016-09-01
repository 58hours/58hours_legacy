<?php require_once('../Connections/radioRecords.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

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
}

mysql_select_db($database_radioRecords, $radioRecords);
$query_allTours = "SELECT tourID, tourName FROM tourresolver ORDER BY priorTour DESC";
$allTours = mysql_query($query_allTours, $radioRecords) or die(mysql_error());
$row_allTours = mysql_fetch_assoc($allTours);
$totalRows_allTours = mysql_num_rows($allTours);
?>
<body bgcolor="#000000">
<form action="/tour_details_dev.php" method="get" name="addTour" target="_top"><select name="availableTours">
  <option value="">----</option>
  <?php
do {  
?>
  <option value="<?php echo $row_allTours['tourID']?>"><?php echo $row_allTours['tourName']?></option>
  <?php
} while ($row_allTours = mysql_fetch_assoc($allTours));
  $rows = mysql_num_rows($allTours);
  if($rows > 0) {
      mysql_data_seek($allTours, 0);
	  $row_allTours = mysql_fetch_assoc($allTours);
  }
?>
</select></form>
</body>
<?php
mysql_free_result($allTours);
?>
