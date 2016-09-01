<?php require_once('Connections/radioRecords.php'); ?>
<?php 

function randomkeys($length)
{
  $pattern = "1234567890abcdefghijklmnopqrstuvwxyz_-ABCDEFGHIJKLMNOPQRSTUVWXYZ";
  for($i=0;$i<$length;$i++)
  {
   if(isset($key))
     $key .= $pattern{rand(0,63)};
   else
     $key = $pattern{rand(0,63)};
  }
  return $key;
}

// first create a random 12-digit string...

$newKey = randomkeys(12);

echo $newKey;
?>