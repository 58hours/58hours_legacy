<?php
//XMLXSL Transformation class
require_once('../includes/MM_XSLTransform/MM_XSLTransform.class.php'); 
?>
<?php
$mm_xsl = new MM_XSLTransform();
$mm_xsl->setXML("../xml_pageElements/element_showBatchJob.xml");
$mm_xsl->setXSL("showDetails3.xsl");
echo $mm_xsl->Transform();
?>