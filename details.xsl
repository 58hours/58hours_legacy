<?xml version="1.0" encoding="UTF-8"?><!-- DWXMLSource="http://api.58hours.com/?output=xml&rpc=getSongDetails&songID=118" --><!DOCTYPE xsl:stylesheet  [
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
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
<title>&quot;<xsl:value-of select="response/songDetails/@title"/>&quot; details at 58hours. a radiohead gig database</title>

<link rel="stylesheet" href="css/styles.css" type="text/css"/>
<style type="text/css"> 
body 
{ 
background-image: url('images/bgstripes.gif'); 
} 
</style>
<script language="JavaScript">
function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}
</script>
<script type="text/javascript"><!--
google_ad_client = "pub-4681937497066114";
google_ad_width = 160;
google_ad_height = 600;
google_ad_format = "160x600_as";
google_ad_type = "text";
google_ad_channel ="6294685603";
google_color_border = "000000";
google_color_link = "FFFFFF";
google_color_bg = "000000";
google_color_text = "CCCCCC";
google_color_url = "999999";
//--></script>
<link href="css/stylebook.css" rel="stylesheet" type="text/css"/>
</head>

<body bgcolor="#000000" text="#FFFFFF" link="#0066CC" vlink="#0066CC" alink="#0066CC" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" class="blueishlinks">
<br/>

<table width="800" border="0" align="center" cellpadding="0" cellspacing="0">
<tr><td>
<table width="800" border="0" align="center" cellpadding="1" cellspacing="1" bgcolor="#FFFFFF">
  <tr>
      <td colspan="2" bgcolor="#FFFFFF"><a href="/" border="0"><img src="images/58hours_newbanner.jpg" width="800" height="114" border="0"/></a></td>
    </tr>
    <tr>
    <td>
      <div align="center">
        <table width="800" border="0" cellpadding="10" cellspacing="0" bgcolor="#000000">
          <tr>
            <td align="left" valign="top"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif">LOOKUP SONG: </font>
                <form name="form1" method="get"><xsl:attribute name="action">58_trackDetails.php?trackID=<xsl:value-of select="response/songDetails/@sysID"/></xsl:attribute>
                  <select name="trackID" id="trackID">
                    
                  </select>
                  <input type="submit" value="Submit"/>
              </form></td>
            <td align="right" valign="bottom" nowrap="true">&nbsp;</td>
          </tr>
          <tr>
            <td colspan="2" align="center" valign="top" bgcolor="#000000">
            <table width="100%" border="0" cellpadding="2" bgcolor="#000000">
                <tr>
                  <td width="50%" height="12" colspan="2" valign="top"><p/>
                          <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0" width="450" height="30">
                            <param name="movie" value="trackName.swf"/>
                            <param name="quality" value="high"/>
                            <param name="BGCOLOR" value="#000000"/>
							<param name="flashVars" /><xsl:attribute name="value">name=</xsl:attribute>
                            <embed src="trackName.swf" width="450" height="30" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" bgcolor="#000000" ><xsl:attribute name="flashVars">name=<xsl:value-of select="response/songDetails/@title"/></xsl:attribute></embed>
                    </object>
                          
                  </td>
                </tr>
                <tr>
                  	<td colspan="2" valign="top">
                  	<xsl:if test="response/songDetails/lifespan">
                  	<br/>
                  	<br/>
                    
                  	<br/>
                  	<br/>
                   	</xsl:if>
                  </td>
                </tr>
                <tr>
                  <td width="360" valign="top">
				  <img src="images/summary_label.gif" width="250" height="27"/>
					<?php if ($totalRows_wooHoo > 0) { // Show if recordset not empty ?>
                      <table width="360" id="subtleanchor_light" border="0" cellpadding="0" cellspacing="0" bordercolor="#CCCCCC">
                        <tr>
                          <td bordercolor="#CCCCCC"><font size="1" color="#e3e3e3" face="Arial, Helvetica, sans-serif">Originally performed by:&nbsp;<xsl:value-of select="response/songDetails/artist/@artistName" /><br/>
                          <xsl:if test="response/songDetails/ocdstats/@grandtotal &gt; 0">
								* Played live <font color="#66CCFF"><xsl:value-of select="response/songDetails/ocdstats/@grandtotal" /></font> times. <a class="linkageStuff"><xsl:attribute name="href">58_performancehistory.php?trackID=<xsl:value-of select="response/songDetails/@sysID" /></xsl:attribute>[WHERE/WHEN?]</a>
                    		</xsl:if>
                    		<xsl:if test="response/songDetails/ocdstats/@encore1 &gt; 0">
                    			<br/>* Opened first encore <xsl:value-of select="response/songDetails/ocdstats/@encore1"/> times
                   			</xsl:if>
                    		<xsl:if test="response/songDetails/ocdstats/@encore2 &gt; 0">
                    			<br/>* Opened second encore <xsl:value-of select="response/songDetails/ocdstats/@encore2"/> times
                    		</xsl:if>
                    		<xsl:if test="response/songDetails/ocdstats/@avgpos &gt; 0">
                            <font size="1" face="Arial, Helvetica, sans-serif"><br />* Average position in setlist: #<xsl:value-of select="response/songDetails/ocdstats/@avgpos" /><!--<br/ > <? echo round($row_posVariance['songDerv']); ?>--></font>
							</xsl:if>
                            </font>
                            <xsl:if test="response/songDetails/ocdstats/@grandtotal = 0">
                            <font size="1" face="Arial, Helvetica, sans-serif">* There is no record of this track being played live.</font><br/><br/>
							</xsl:if>
                          </td>
                        </tr>
                      </table>
                      <br/>
						<img src="images/lifespan_label.gif" width="250" height="27" />
                      <table width="360" id="subtleanchor_light" border="0" height="100" bordercolor="#666666">
                        <tr bordercolor="#333333">
                          <td width="50%" valign="top"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif"><b>Earliest listed performance:</b><br/>
                                        <br/>
                                        <span class="linkageStuff"><a class="linkageStuff"><xsl:attribute name="href">58_displayshow.php?showID=</xsl:attribute><font color="#999999">showDate</font></a></span>
                                        <font color="#999999"><br/>
                                        <a class="linkageStuff"><xsl:attribute name="href">58_groupinglist.php?venueID=</xsl:attribute>venueName</a><span class="linkageStuff"><br/>
                                        <a class="linkageStuff"><xsl:attribute name="href">58_groupinglist.php?cityID=</xsl:attribute>cityName</a></span>, <br/>
                                        <a class="linkageStuff"><xsl:attribute name="href">58_groupinglist.php?localityID=</xsl:attribute>localityName</a> - <span class="linkageStuff">countryName</span></font></font></td>
                          <td width="50%" valign="top"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif"><b>Most recent listed performance:</b><br/>
                                        <br/>
                                        <span class="linkageStuff">
                                        <a class="linkageStuff"><xsl:attribute name="href">58_displayshow.php?showID=</xsl:attribute><font color="#999999">showDate</font></a></span>
                                        <font color="#999999"><br/>
                                        <a class="linkageStuff"><xsl:attribute name="href">58_groupinglist.php?venueID=</xsl:attribute>venueName</a><span class="linkageStuff"><br/>
                                        <a class="linkageStuff"><xsl:attribute name="href">58_groupinglist.php?cityID=</xsl:attribute>cityName</a></span>, <br/>
                                        <a class="linkageStuff"><xsl:attribute name="href">58_groupinglist.php?localityID=</xsl:attribute>localityName</a> - <span class="linkageStuff">countryName</span></font></font></td>
                        </tr>
                      </table>
                      <font size="1" face="Verdana, Arial, Helvetica, sans-serif"><br/><br/><img src="images/minibar_foundreleases.gif" width="250" height="27" /></font>

                      <br/>
                      <table width="360" bgcolor="#999999" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td align="center">
                          <xsl:for-each select="response/songDetails/studioReleases/release">
                              <table width="360" border="0" bgcolor="#000000">
                                <tr>
                                  <td width="38" rowspan="2">small image goes here</td>
                                  
                                </tr>
                                <tr>

                                  <td>
                                      <h3><a class="linkageStuff"><xsl:attribute name="href">58_viewrelease.php?releaseID=</xsl:attribute><xsl:value-of select="title" /> (<xsl:value-of select="country" />)</a></h3>
                                      <font color="#999999" size="1" face="Arial, Helvetica, sans-serif">[<xsl:value-of select="versionTitle" />]</font><br/>
                                      <font size="1" color="#e3e3e3" face="Arial, Helvetica, sans-serif"><xsl:value-of select="releaseDate" /></font></td>
                                </tr>
                              </table>
                        	</xsl:for-each></td>
                        </tr>
                      </table>
                      <br/>

</td>
</tr>
</table>
</td>
</tr>
</table>
</div>
</td>
</tr>
</table>
</td>
</tr>
</table>
</body>
</html>

</xsl:template>
</xsl:stylesheet>