<?
mb_internal_encoding("UTF-8");
//echo mb_internal_encoding();


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

if (!function_exists("str_makerand")) {
function str_makerand ($minlength, $maxlength, $useupper, $usespecial, $usenumbers)
{
/* 
Author: Peter Mugane Kionga-Kamau
http://www.pmkmedia.com

Description: string str_makerand(int $minlength, int $maxlength, bool $useupper, bool $usespecial, bool $usenumbers) 
returns a randomly generated string of length between $minlength and $maxlength inclusively.

Notes: 
- If $useupper is true uppercase characters will be used; if false they will be excluded.
- If $usespecial is true special characters will be used; if false they will be excluded.
- If $usenumbers is true numerical characters will be used; if false they will be excluded.
- If $minlength is equal to $maxlength a string of length $maxlength will be returned.
- Not all special characters are included since they could cause parse errors with queries. 

Modify at will.
*/
    $charset = "abcdefghijklmnopqrstuvwxyz";
    if ($useupper)   $charset .= "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    if ($usenumbers) $charset .= "0123456789";
    if ($usespecial) $charset .= "_-";   // Note: using all special characters this reads: "~!@#$%^&*()_+`-={}|\\]?[\":;'><,./";
    if ($minlength > $maxlength) $length = mt_rand ($maxlength, $minlength);
    else                         $length = mt_rand ($minlength, $maxlength);
    for ($i=0; $i<$length; $i++) $key .= $charset[(mt_rand(0,(strlen($charset)-1)))];
    return $key;
}
}

if (!function_exists("get_unused_globalid")) {
	function get_unused_globalid($database_random_connect, $random_connect)
	{
		do
		{
			$new_external_id = str_makerand(16,16,true,true,true);
			mysql_select_db($database_random_connect, $random_connect);
			$query_checkid = sprintf("SELECT * FROM rhr__global_idtracker WHERE external_id = '%s'", $new_external_id);
			$checkid = mysql_query($query_checkid, $random_connect) or die(mysql_error());
			//$row_currentGroup = mysql_fetch_assoc($currentGroup);
			$totalRows_checkid = mysql_num_rows($checkid);

		} while($totalRows_checkid>0);
		return $new_external_id;
	}
}

function fixEncoding($in_str)
{
  $cur_encoding = mb_detect_encoding($in_str) ;
  if($cur_encoding == "UTF-8")
    return $in_str;
  else
    return utf8_encode($in_str);
}

?>