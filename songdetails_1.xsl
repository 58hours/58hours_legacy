<?xml version="1.0" encoding="UTF-8"?><!DOCTYPE xsl:stylesheet  [
	<!ENTITY nbsp   "&#160;">
	<!ENTITY copy   "&#169;">
	<!ENTITY reg    "&#174;">
	<!ENTITY trade  "&#8482;">
	<!ENTITY mdash  "&#8212;">
	<!ENTITY ldquo  "&#8220;">
	<!ENTITY rdquo  "&#8221;"> 
	<!ENTITY pound  "&#163;">
	<!ENTITY yen    "&#165;">
	<!ENTITY euro   "&#8364;">
]>

<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
<xsl:output method="html" encoding="UTF-8" doctype-public="-//W3C//DTD XHTML 1.0 Transitional//EN" doctype-system="http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"/>
<xsl:template match="/">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>&quot;<xsl:value-of select="songdetails/general/song"/>&quot; by <xsl:value-of select="songdetails/general/band"/>.  Song details at RandomHours.</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" href="css/styles.css" type="text/css" />
<style type="text/css"> 
body 
{ 
background-image: url('images/bgstripes.gif'); 
} 
</style>
<script language="JavaScript" type="text/javascript">
<xsl:text disable-output-escaping="yes">
<![CDATA[
function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}
]]>
</xsl:text>
</script>


<link href="css/stylebook.css" rel="stylesheet" type="text/css" />
<script src="Scripts/AC_RunActiveContent.js" type="text/javascript"></script>
</head>
<body bgcolor="#000000" text="#FFFFFF" link="#0066CC" vlink="#0066CC" alink="#0066CC" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" class="blueishlinks">
<br />
<table width="800" border="0" align="center" cellpadding="0" cellspacing="0">
	<tr>
		<td>
			<table width="800" border="0" align="center" cellpadding="1" cellspacing="1" bgcolor="#000000">
  			<tr>
      			<td colspan="2" bgcolor="#000000"><a href="/" border="0"><img src="/i/rainbowheader_v2.jpg" width="800" height="114" border="0" /></a></td>
    		</tr>
    		<tr>
    			<td>
      				
        			
                <tr>
                	<td>
                	<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0" width="800" height="100">
                        <param name="movie" value="flash_elements/newSpectrum.swf" />
                        <param name="quality" value="high" />
						<param />
						<xsl:attribute name="name">flashVars</xsl:attribute>
						<xsl:attribute name="value">
                        <xsl:for-each select="songdetails/liveinfo/history/lifespan/stat">
                        <xsl:comment><![CDATA[y]]></xsl:comment>
                        <xsl:value-of select="@year"/>
                        <xsl:comment><![CDATA[=]]></xsl:comment>
                        <xsl:value-of select="@numtimes"/>
                        <xsl:comment><![CDATA[&]]></xsl:comment>
                        </xsl:for-each>
                        </xsl:attribute>
                        <param name="BGCOLOR" value="#000000" />
                        <embed src="flash_elements/newSpectrum.swf" width="800" height="100" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" bgcolor="#000000"></embed><xsl:attribute name="flashVars">
                        <xsl:for-each select="songdetails/liveinfo/history/lifespan/stat">
                        <xsl:comment><![CDATA[y]]></xsl:comment>
                        <xsl:value-of select="@year"/>
                        <xsl:comment><![CDATA[=]]></xsl:comment>
                        <xsl:value-of select="@numtimes"/>
                        <xsl:comment><![CDATA[&]]></xsl:comment>
                        </xsl:for-each></xsl:attribute>
										</object>
                		<br />
                		<br />
        				<table width="800" cellpadding="5">
          					<tr>
            					<td valign="top" bgcolor="#333366"><font color="#FFFFFF"><?php require_once('58ss_includes/58disclaimer.php'); ?></font></td>
							</tr>
						</table>
					</td>
				</tr>
				</td>
				</tr>
			</table>
		
          </td>
        </tr>
		<tr>
			<td align="center" valign="top" bgcolor="#000000"><a target='new' href="http://click.linksynergy.com/fs-bin/click?id=N2nvjdzFAVU&amp;offerid=146261.10002602&amp;type=4&amp;subid=0"><img src="http://images.apple.com/itunesaffiliates/US/2008/01/01/Radiohead_125x125.jpg" alt="Apple iTunes" width="125" height="125" border="0" /></a><img border="0" width="1" height="1" src="http://ad.linksynergy.com/fs-bin/show?id=N2nvjdzFAVU&amp;bids=146261.10002602&amp;type=4&amp;subid=0" /><br/><br/>
  <script type="text/javascript">
<xsl:text disable-output-escaping="yes">
<![CDATA[
google_ad_client = "pub-4681937497066114";
/* 160x600 legacy */
google_ad_slot = "6064828356";
google_ad_width = 160;
google_ad_height = 600;
//]]>
</xsl:text>
</script>
<script type="text/javascript"
src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
<xsl:text disable-output-escaping="yes">
<![CDATA[
]]>
</xsl:text>
</script>

		</td>
	</tr>
</table>
</body>
</html>
</xsl:template>
</xsl:stylesheet>
