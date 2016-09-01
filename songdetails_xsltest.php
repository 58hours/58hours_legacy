<?php
//XMLXSL Transformation class
require_once('includes/MM_XSLTransform/MM_XSLTransform.class.php'); 
if(strlen($_GET['external_song_id'])>0)
{
	$mm_xsl = new MM_XSLTransform();
	//$mm_xsl->setXML("../xml_pageElements/shows/showDetails_".$_GET['showID'].".xml");
	$mm_xsl->setXML("_renderers/songdetails_".$_GET['external_song_id'].".xml");
	$mm_xsl->setXSL("songdetails_1.xsl");
	echo $mm_xsl->Transform();
}
 ?>