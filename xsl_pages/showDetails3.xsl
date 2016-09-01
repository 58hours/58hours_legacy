<?xml version="1.0" encoding="UTF-8"?><!-- DWXMLSource="../xml_pageElements/element_showBatchJob.xml" --><!DOCTYPE xsl:stylesheet  [
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
<title>Show details for: <xsl:value-of select="rdata/showdate"/></title>
</head>

<body>
    <br />
    <table width="800" height="750" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td valign="top">
	  	<table width="800" height="750" border="0" align="center" cellpadding="1" cellspacing="1" bgcolor="#FFFFFF">
          <tr>
            <td valign="top"><table width="800" height="750" border="0" align="center" cellpadding="5" cellspacing="0" bgcolor="#FFFFFF">
                <tr>
                  <td colspan="2" bgcolor="#FFFFFF" class="darkerLinkage" valign="top" height="150"><img src="/i/rainbowbanner.jpg" width="800" height="114" border="0" />
				</td>
                </tr>
                <tr>
                  <td align="right" valign="top" bgcolor="#000000" height="5"><table width="100%">
                      <tr>
                        <td align="left" valign="top" height="5"><xsl:value-of select="rdata/breadcrumb/venue" disable-output-escaping="yes"/> |<xsl:value-of select="rdata/breadcrumb/city" disable-output-escaping="yes"/> | <xsl:value-of select="rdata/breadcrumb/locale" disable-output-escaping="yes"/> | <xsl:value-of select="rdata/breadcrumb/country" disable-output-escaping="yes"/> </td>
                        <td align="right"><font size="1"><span class="linkageStuff"><font color="#FFFFFF" face="Arial, Helvetica, sans-serif">Browse
                                by: <a href="index.php?browse=showDate" class="linkageStuff">date</a></font></span><font color="#FFFFFF" face="Arial, Helvetica, sans-serif"><span class="linkageStuff"> | <a href="index.php?browse=showVenue" class="linkageStuff">venue</a> | <a href="index.php?browse=songTitle" class="linkageStuff">song
                                title</a></span></font></font></td>
                      </tr>
                    </table>
                    <table>
                      <tr>
                        <td><script type="text/javascript">
AC_FL_RunContent( 'codebase','http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0','width','800','height','30','src','flash_elements/nameclip_full','quality','high','pluginspage','http://www.macromedia.com/go/getflashplayer','bgcolor','#000000','movie','flash_elements/nameclip_full' ); //end AC code
            </script>
                          <noscript>
                          <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0" width="800" height="30">
                            <param name="movie" value="/flash_elements/nameclip_full.swf" />
                            <param name="quality" value="high" />
                            <param name="BGCOLOR" value="#000000" />
                            <embed src="/flash_elements/nameclip_full.swf" width="800" height="30" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash"  bgcolor="#000000"></embed>
                          </object>
                          </noscript></td>
                      </tr>
                      <tr>
                        <td colspan="2" bgcolor="#000000"><table width="100%" border="0" cellspacing="0" cellpadding="1">
                            <tr>
                              <td width="300" height="72" valign="top"><br />
                                - <br />
                                <xsl:value-of select="rdata/tour" disable-output-escaping="yes"/>
                                <table width="250" border="0" cellspacing="0" cellpadding="1" height="5">
                                  <tr>
                                    <td align="left" nowrap="nowrap" height="5"><xsl:value-of select="rdata/shownavi/previousshow"/><xsl:value-of select="rdata/shownavi/nextshow"/></font></td>
                                </table>
                                <br />
                                <br />
                                show support: <xsl:value-of select="rdata/support" disable-output-escaping="yes"/> <br />
                                <br />
                                <div id="subtleanchor_light">
                                  <table width="250" border="0" cellspacing="0" cellpadding="1">
                                    <tr>
                                      <td align="center"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                          <tr>
                                            <td><img src="/images/setlistheadermain.gif" alt="Setlist Details" width="250" height="13" /></td>
                                          </tr>
                                          <tr>
                                            <td height="2"><xsl:for-each select="rdata/setlist/main/track">
                                                Track
                                              </xsl:for-each>
                                            </td>
                                          </tr>
                                          <tr>
                                            <td><img src="/images/setlistheaderenc1a.gif" alt="First Encore" width="250" height="13" /></td>
                                          </tr>
                                          <tr>
                                            <td height="2"><xsl:for-each select="rdata/setlist/encore1/track">
                                                <xsl:value-of select="@num"/> <xsl:value-of select="@id"/> track
                                              </xsl:for-each>
                                            </td>
                                          </tr>
                                          <tr>
                                            <td><br />
                                              <img src="/images/setlistheaderenc2a.gif" alt="Second Encore" width="250" height="13" /></td>
                                          </tr>
                                          <tr>
                                            <td height="2"><xsl:for-each select="rdata/setlist/encore2/track">
                                                <xsl:value-of select="@num"/> <xsl:value-of select="@id"/> track
                                              </xsl:for-each>
                                            </td>
                                          </tr>
                                          <tr>
                                            <td>&nbsp;</td>
                                          </tr>
                                          <tr>
                                            <td height="2" nowrap></td>
                                          </tr>
                                        </table></td>
                                    </tr>
                                  </table>
                                </div>
                                <br />
                                <br />
                                <table width="250" border="0" cellspacing="1" cellpadding="1">
                                  <tr>
                                    <td>[58HOURS.COM MEMBERS AT THIS SHOW]<br />
                                      <xsl:for-each select="rdata/memberspresent/member">
                                        Attending member
                                      </xsl:for-each>
                                      <br />
                                    </td>
                                  </tr>
                                </table>
                                <br />
                                <table width="250" border="0" cellspacing="0" cellpadding="4">
                                  <tr>
                                    <td> [SHOW NOTES]<br />
                                      <xsl:value-of select="rdata/shownotes" disable-output-escaping="yes"/> </td>
                                  </tr>
                                </table>
                                <br />
                                <p><br />
                                </p></td>
                              <td align="right" valign="top"><p>&nbsp;</p>
                                <p>&nbsp;</p>
                                <p>&nbsp;</p>
                                <p>&nbsp;</p>
                                <table width="450" border="0" cellpadding="1" cellspacing="1">
                                  <tr>
                                    <td width="454"><img src="/images/showimages-wide.gif" width="450" height="13" /></td>
                                  </tr>
                                  <tr>
                                    <td><table width="450" border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                          <td><table width="450" border="0" cellspacing="1" cellpadding="0">
                                              <tr>
                                                <td width="100" valign="bottom">&nbsp;</td>
                                              </tr>
                                            </table></td>
                                        </tr>
                                      </table></td>
                                  </tr>
                                  <tr>
                                    <td><img src="/images/showreviews-wide.gif" width="450" height="13" /></td>
                                  </tr>
                                  <tr>
                                    <td><table cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
                                        <tr>
                                          <td colspan="2"><br />
                                            <table>
                                              <tr>
                                                <td><xsl:for-each select="rdata/comments/comment">
                                                    <p>Comment:</p>
                                                    <p>submitted by:<xsl:value-of select="@author"/> ( <xsl:value-of select="@timestamp"/> ) </p>
                                                  </xsl:for-each>
                                                </td>
                                              </tr>
                                            </table></td>
                                        </tr>
                                        <tr>
                                          <td align="left" width="250"><img src="/images/cornering_r3_c1.gif" width="30" height="30" border="0"/><img src="/images/addcomments.gif" alt="add comment" width="130" height="13" vspace="5" border="0" /></a> </td>
                                          <td align="right" width="250"><img src="/images/viewothercomments.gif" alt="View Comments" width="119" height="13" vspace="5" border="0" /> <img src="/images/cornering_r3_c3.gif" width="30" height="30" border="0"/></td>
                                        </tr>
                                      </table></td>
                                  </tr>
                                </table></td>
                            </tr>
                            <tr>
                              <td><br /></td>
                            </tr>
                          </table></td>
                      </tr>
                      <tr bgcolor="#000000">
                        <td colspan="2" align="center"><!-- SiteSearch Google -->
                          <form method="get" action="http://www.google.com/custom" target="_top">
                            <table border="0" bgcolor="#000000">
                              <tr>
                                <td nowrap="nowrap" valign="top" align="left" height="32"><a href="http://www.google.com/"> <img src="http://www.google.com/logos/Logo_25blk.gif" border="0" alt="Google" align="middle"></img></a> </td>
                                <td nowrap="nowrap"><input type="hidden" name="domains" value="58hours.com">
                                  </input>
                                  <label for="sbi" style="display: none">Enter
                                  your search terms</label>
                                  <input type="text" name="q" size="31" maxlength="255" value="" id="sbi">
                                  </input>
                                  <label for="sbb" style="display: none">Submit
                                  search form</label>
                                  <input type="submit" name="sa" value="Search" id="sbb">
                                  </input></td>
                              </tr>
                              <tr>
                                <td>&nbsp;</td>
                                <td nowrap="nowrap"><table>
                                    <tr>
                                      <td><input type="radio" name="sitesearch" value="" checked id="ss0">
                                        </input>
                                        <label for="ss0" title="Search the Web"><font size="-1" color="#ffffff">Web</font></label></td>
                                      <td><input type="radio" name="sitesearch" value="58hours.com" id="ss1">
                                        </input>
                                        <label for="ss1" title="Search 58hours.com"><font size="-1" color="#ffffff">58hours.com</font></label></td>
                                    </tr>
                                  </table>
                                  <input type="hidden" name="client" value="pub-4681937497066114">
                                  </input>
                                  <input type="hidden" name="forid" value="1">
                                  </input>
                                  <input type="hidden" name="ie" value="ISO-8859-1">
                                  </input>
                                  <input type="hidden" name="oe" value="ISO-8859-1">
                                  </input>
                                  <input type="hidden" name="cof" value="GALT:#0066CC;GL:1;DIV:#CCCCCC;VLC:66B5FF;AH:center;BGC:000000;LBGC:FFFFFF;ALC:FFFF66;LC:FFFF66;T:FFFFCC;GFNT:99C9FF;GIMP:99C9FF;FORID:1">
                                  </input>
                                  <input type="hidden" name="hl" value="en">
                                  </input></td>
                              </tr>
                            </table>
                          </form>
                          <!-- SiteSearch Google -->
                        </td>
                        </te>
                      <tr bgcolor="#333366">
                        <td colspan="2"><font color="#FFFFFF"> </font></td>
                      </tr>
                    </table></td>
                </tr>
              </table></td>
            <td valign="top" bgcolor="#000000"><img src="/images/google_spacer.gif" height="150" width="160"><br/>
              <script type="text/javascript"
  src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>
            </td>
          </tr>
        </table>
    </body>
</html>
</xsl:template>
</xsl:stylesheet>