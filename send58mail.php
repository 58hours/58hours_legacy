<?php 
$myShowID=$_GET['showID'];
$newtitle="new comments posted for show " . $myShowID;
mail("comments@randomhours.com",$newtitle,"new comment submitted","From: randomhours Comments <comment-forwards@randomhours.com>");
//header("Location: http://58.randomhours.com/post_comments.php?state=posted"); 
header("Location: http://58hours.com/post_comments.php?state=posted"); 
?> 

