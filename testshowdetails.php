<?php
//XMLXSL Transformation class
require_once('includes/MM_XSLTransform/MM_XSLTransform.class.php'); 

if(strlen($_GET['showID'])>0)
{
$mm_xsl = new MM_XSLTransform();
//$mm_xsl->setXML("../xml_pageElements/shows/showDetails_".$_GET['showID'].".xml");
$mm_xsl->setXML("xml_pageElements/shows/showDetails_".$_GET['showID'].".xml");
$mm_xsl->setXSL("xsl_pages/showDetails.xsl");
echo $mm_xsl->Transform();
} ?>