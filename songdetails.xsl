<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE xsl:stylesheet  [
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
<title>&quot;<xsl:value-of select="songdetails/general/song"/>&quot; by <xsl:value-of select="songdetails/general/band"/>.  Song details at RandomHours.</title>




</head>
<body bgcolor="#000000" text="#FFFFFF" link="#0066CC" vlink="#0066CC" alink="#0066CC" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" class="blueishlinks">
<br>
<table width="800" border="0" align="center" cellpadding="0" cellspacing="0">
	<tr>
		<td>
			<table width="800" border="0" align="center" cellpadding="1" cellspacing="1" bgcolor="#000000">
  			<tr>
      			<td colspan="2" bgcolor="#000000"><a href="/" border="0"><img src="/i/rainbowheader_v2.jpg" width="800" height="114" border="0"></a></td>
    		</tr>
    		<tr>
    			<td>
      				<div align="center">
        			<table width="800" border="0" cellpadding="10" cellspacing="0" bgcolor="#000000">
          			<tr>
            			<td align="left" valign="top"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif">LOOKUP SONG: </font>
                			<form name="form1" method="get" action="58_trackDetails.php?external_song_id=<?php echo $row_allTitles['external_song_id']; ?>">
                  			<select name="external_song_id" class="darkerLinkage" id="external_song_id"><?php do { ?>
								<option value="<?php echo $row_allTitles['external_song_id']?>"><?php echo $row_allTitles['song_name_display']; ?></option>
								<?php } while ($row_allTitles = mysql_fetch_assoc($allTitles));
  									$rows = mysql_num_rows($allTitles);
									if($rows > 0) {
										mysql_data_seek($allTitles, 0);
										$row_allTitles = mysql_fetch_assoc($allTitles);
									} ?>
                  			</select>
                  			<input type="submit" class="darkerLinkage" value="Submit">
              			</form></td>
            			<td align="right" valign="bottom" nowrap>&nbsp;</td>
          			</tr>
          			<tr>
            			<td colspan="2" align="center" valign="top" bgcolor="#000000">
            				<table width="100%" border="0" cellpadding="2" bgcolor="#000000">
                				<tr>
									<td width="50%" height="12" colspan="2" valign="top"><p>
										<script type="text/javascript">
AC_FL_RunContent( 'codebase','http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0','width','450','height','30','src','trackName','quality','high','pluginspage','http://www.macromedia.com/go/getflashplayer','bgcolor','#000000','flashvars','name=<?php echo urlencode($row_titleDetails['song_name_display']); ?>','movie','trackName' ); //end AC code
</script><noscript><object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0" width="450" height="30">
                            <param name="movie" value="trackName.swf">
                            <param name="quality" value="high">
                            <param name="BGCOLOR" value="#000000">
							<param name="flashVars" value="name=<?php echo urlencode($row_titleDetails['song_name_display']); ?>">
                            <embed src="trackName.swf" width="450" height="30" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" bgcolor="#000000" flashVars="name=<xsl:value-of select="songdetails/general/song"/>"></embed>
                    					</object></noscript>
										<?php if ($totalRows_otherTitles > 0) { // Show if recordset not empty ?>
                          				<br />
                          				<font face="Arial, Helvetica, sans-serif" size="1" color="#999999"> <strong class="linkageStuff">ALSO KNOWN AS:</strong><br>
										<?php do { ?><span class="linkageStuff">&quot;<?php echo $row_otherTitles['alternateTitle']; ?>&quot;</span><br>
										<?php } while ($row_otherTitles = mysql_fetch_assoc($otherTitles)); ?>
										</font>
										<?php } // Show if recordset not empty ?>
									</td>
								</tr>
								<tr>
									<td colspan="2" valign="top"><?php if ($totalRows_wooHoo > 0) { // Show if recordset not empty ?>
										<br>
										<script type="text/javascript">
AC_FL_RunContent( 'codebase','http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0','width','800','height','100','src','flash_elements/newSpectrum','quality','high','pluginspage','http://www.macromedia.com/go/getflashplayer','flashvars','<?php echo "y1992=".($row_perfs1992['COUNT(*)']*2)."&y1993=".($row_perfs1993['COUNT(*)']*2)."&y1994=".($row_perfs1994['COUNT(*)']*2)."&y1995=".($row_perfs1995['COUNT(*)']*2)."&y1996=".($row_perfs1996['COUNT(*)']*2)."&y1997=".($row_perfs1997['COUNT(*)']*2)."&y1998=".($row_perfs1998['COUNT(*)']*2)."&y1999=".($row_perfs1999['COUNT(*)']*2)."&y2000=".($row_perfs2000['COUNT(*)']*2)."&y2001=".($row_perfs2001['COUNT(*)']*2)."&y2002=".($row_perfs2002['COUNT(*)']*2)."&y2003=".($row_perfs2003['COUNT(*)']*2)."&y2004=".($row_perfs2004['COUNT(*)']*2)."&y2005=".($row_perfs2005['COUNT(*)']*2)."&y2006=".($row_perfs2006['COUNT(*)']*2)."&y2007=".($row_perfs2007['COUNT(*)']*2)."&y2008=".($row_perfs2008['COUNT(*)']*2); ?>','bgcolor','#000000','movie','flash_elements/newSpectrum' ); //end AC code
</script><noscript><object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0" width="800" height="100">
                        <param name="movie" value="flash_elements/newSpectrum.swf">
                        <param name="quality" value="high">
						<param name="flashVars" value="<?php echo "y1992=".($row_perfs1992['COUNT(*)']*2)."&y1993=".($row_perfs1993['COUNT(*)']*2)."&y1994=".($row_perfs1994['COUNT(*)']*2)."&y1995=".($row_perfs1995['COUNT(*)']*2)."&y1996=".($row_perfs1996['COUNT(*)']*2)."&y1997=".($row_perfs1997['COUNT(*)']*2)."&y1998=".($row_perfs1998['COUNT(*)']*2)."&y1999=".($row_perfs1999['COUNT(*)']*2)."&y2000=".($row_perfs2000['COUNT(*)']*2)."&y2001=".($row_perfs2001['COUNT(*)']*2)."&y2002=".($row_perfs2002['COUNT(*)']*2)."&y2003=".($row_perfs2003['COUNT(*)']*2)."&y2004=".($row_perfs2004['COUNT(*)']*2)."&y2005=".($row_perfs2005['COUNT(*)']*2)."&y2006=".($row_perfs2006['COUNT(*)']*2)."&y2007=".($row_perfs2007['COUNT(*)']*2)."&y2008=".($row_perfs2008['COUNT(*)']*2); ?>"><param name="BGCOLOR" value="#000000">
                        <embed src="flash_elements/newSpectrum.swf" width="800" height="100" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" flashVars="<?php echo "y1992=".($row_perfs1992['COUNT(*)']*2)."&y1993=".($row_perfs1993['COUNT(*)']*2)."&y1994=".($row_perfs1994['COUNT(*)']*2)."&y1995=".($row_perfs1995['COUNT(*)']*2)."&y1996=".($row_perfs1996['COUNT(*)']*2)."&y1997=".($row_perfs1997['COUNT(*)']*2)."&y1998=".($row_perfs1998['COUNT(*)']*2)."&y1999=".($row_perfs1999['COUNT(*)']*2)."&y2000=".($row_perfs2000['COUNT(*)']*2)."&y2001=".($row_perfs2001['COUNT(*)']*2)."&y2002=".($row_perfs2002['COUNT(*)']*2)."&y2003=".($row_perfs2003['COUNT(*)']*2)."&y2004=".($row_perfs2004['COUNT(*)']*2)."&y2005=".($row_perfs2005['COUNT(*)']*2)."&y2006=".($row_perfs2006['COUNT(*)']*2)."&y2007=".($row_perfs2007['COUNT(*)']*2)."&y2008=".($row_perfs2008['COUNT(*)']*2); ?>" bgcolor="#000000"></embed>
										</object></noscript>
										<br/><br/><br/>
										<?php } // Show if recordset empty ?>
									</td>
								</tr>
								<tr>
                  					<td width="360" valign="top"><?
				  						if($totalRows_availableSamples>0)
				  						{ ?><script type="text/javascript">
AC_FL_RunContent( 'codebase','http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,19,0','width','118','height','20','src','flash_elements/samplePlayer','quality','high','pluginspage','http://www.macromedia.com/go/getflashplayer','movie','flash_elements/samplePlayer', 'flashvars', 'soundToPlay=<? echo $row_availableSamples['filename']; ?>' ); //end AC code
</script><noscript><object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,19,0" width="118" height="20">
                    <param name="movie" value="flash_elements/samplePlayer.swf">
                    <param name="quality" value="high">
                    <embed src="flash_elements/samplePlayer.swf" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="118" height="20"></embed>
				    </object></noscript><? } ?>
				  						<br />
										<img src="images/summary_label.gif" width="250" height="27"><?php if ($totalRows_wooHoo > 0) { // Show if recordset not empty ?>
										<table width="360" id="subtleanchor_light" border="0" cellpadding="0" cellspacing="0" bordercolor="#CCCCCC">
										<tr>
											<td bordercolor="#CCCCCC"><font size="1" color="#e3e3e3" face="Arial, Helvetica, sans-serif">Originally performed by:&nbsp;<?php echo $row_trackDetails['byWho']; ?>
											<br>
											<?php if ($totalRows_totalTimes > 0) { // Show if recordset not empty ?>* Played live <font color="#66CCFF"><?php echo $totalRows_totalTimes ?></font> times. <a href="58_performancehistory.php?external_song_id=<?php echo $row_titleDetails['external_song_id']; ?>" class="linkageStuff">[WHERE/WHEN?]</a>
											<?php } // Show if recordset not empty ?>
											<?php if($totalRows_openingtracks>0){ ?><br />* Opened the show <?php echo $totalRows_openingtracks; ?> times.
											<?php } ?>
											<?php if($totalRows_closingTimes >0)
											{
											?><br />* Closed the show <?php echo $totalRows_closingTimes; ?> times.<? }
							?>
                    		<?php if ($totalRows_encoreLead > 0) { // Show if recordset not empty ?>
                    			<br>* Opened first encore <?php echo $totalRows_encoreLead; ?> times.
                   			<?php } ?>
                    		<?php if ($totalRows_encore2Lead > 0) { // Show if recordset not empty ?>
                    			<br>* Opened second encore <?php echo $totalRows_encore2Lead; ?> times
                    		<?php } ?>
                    		<?php if ($totalRows_posVariance > 0) { // Show if recordset empty ?>
                            <br /><font size="1" face="Arial, Helvetica, sans-serif"><br />* Earliest setlist position: #<? echo $row_posVariance['earliestPos']; ?></font>
							<?php  } ?>
							<?php if ($totalRows_posVariance > 0) { // Show if recordset empty ?>
                            <font size="1" face="Arial, Helvetica, sans-serif"><br />* Latest setlist position: #<? echo $row_posVariance['latestPos']; ?></font>
							<?php  } ?>
                    		<?php if ($totalRows_posVariance> 0) { // Show if recordset empty ?>
                            <font size="1" face="Arial, Helvetica, sans-serif"><br />* Average position in setlist: #<? echo round($row_posVariance['avgPos']); ?><!--<br/ > <? echo round($row_posVariance['songDerv']); ?>--></font>
							<?php  } ?>
                            </font>
                            <?php if ($totalRows_totalTimes == 0) { // Show if recordset empty ?>
                            <font size="1" face="Arial, Helvetica, sans-serif">* There is no record of this track being played live.</font><br><br>
					<?php  } ?>
							
                          </td>
                        </tr>
                      </table>
                      <br>
						<img src="images/lifespan_label.gif" width="250" height="27">
                      <table width="360" id="subtleanchor_light" border="0" height="100" bordercolor="#666666">
                        <tr bordercolor="#333333">
                          <td width="50%" valign="top"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif"><b>Earliest listed performance:</b><br>
                                        <br>
                                        <span class="linkageStuff"><a href="58_displayshow.php?external_show_id=<?php echo urlencode($row_wooHoo['external_show_id']); ?>" class="linkageStuff"><font color="#999999"><?php echo date('l, m/d/Y',strtotime($row_wooHoo['showDate'])); ?></font></a> </span><font color="#999999"><br>
                                        <a href="58_groupinglist.php?external_venue_id=<?php echo $row_wooHoo['external_venue_id']; ?>" class="linkageStuff"><?php echo $row_wooHoo['venue_name_display']; ?></a><span class="linkageStuff"><br>
                                        <a href="58_groupinglist.php?external_city_id=<?php echo $row_wooHoo['external_city_id']; ?>" class="linkageStuff"><?php echo $row_wooHoo['city_name_display']; ?></a></span>,<br>
                                        <span class="linkageStuff"><a href="58_groupinglist.php?external_locale_id=<?php echo $row_wooHoo['external_locale_id']; ?>" class="linkageStuff"><?php echo $row_wooHoo['locale_name_display']; ?></a></span> - <span class="linkageStuff"><?php echo $row_wooHoo['countryName']; ?></span></font></font></td>
                          <td width=50% valign="top"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif"><b>Most recent listed performance:</b><br>
                                        <br>
                                        <span class="linkageStuff"><a href="58_displayshow.php?external_show_id=<?php echo urlencode($row_hooWoo['external_show_id']); ?>" class="linkageStuff"><font color="#999999"><?php echo date('l, m/d/Y',strtotime($row_hooWoo['showDate'])); ?></font></a> </span><font color="#999999"><br>
                                        <a href="58_groupinglist.php?external_venue_id=<?php echo $row_hooWoo['external_venue_id']; ?>" class="linkageStuff"><?php echo $row_hooWoo['venue_name_display']; ?></a><span class="linkageStuff"><br>
                                        <a href="58_groupinglist.php?external_city_id=<?php echo $row_hooWoo['external_city_id']; ?>" class="linkageStuff"><?php echo $row_hooWoo['city_name_display']; ?></a></span>, <br>
                                        <a href="58_groupinglist.php?external_locale_id=<?php echo $row_hooWoo['external_locale_id']; ?>" class="linkageStuff"><?php echo $row_hooWoo['locale_name_display']; ?></a> - <span class="linkageStuff"><?php echo $row_hooWoo['countryName']; ?></span></font></font></td>
                        </tr>
						
						<tr>
						<td colspan="2"><br><br>
						Normal live lead-ups to <?php echo $row_titleDetails['song_name_display']; ?>:<br>
						<?php do { ?>
						  <a href="58_trackDetails.php?external_song_id=<?php echo $row_commonPreceeders['track2']; ?>">- <?php echo $row_commonPreceeders['song_name_display']; ?></a> (<?php echo round(($row_commonPreceeders['totalNum']/$totalRows_totalTimes)*100); ?>%)<br>
						  <?php } while ($row_commonPreceeders = mysql_fetch_assoc($commonPreceeders)); ?>
						</td>
						</tr>
						
						
						<tr>
						<td colspan="2"><br><br>
						Normal follow-ups to <?php echo $row_titleDetails['song_name_display']; ?>:<br>
						<?php do { ?>
						  <a href="58_trackDetails.php?external_song_id=<?php echo $row_commonFollowers['track2']; ?>">- <?php echo $row_commonFollowers['song_name_display']; ?></a> (<?php echo round(($row_commonFollowers['totalNum']/$totalRows_totalTimes)*100); ?>%)<br>
						  <?php } while ($row_commonFollowers = mysql_fetch_assoc($commonFollowers)); ?>
						</td>
						</tr>
						
                      </table>
                      <?php } // Show if recordset not empty ?>
                      <font size="1" face="Verdana, Arial, Helvetica, sans-serif"><br><br><img src="images/minibar_foundreleases.gif" width="250" height="27"></font><? if($row_itunesLink['itunesLink']!=null)
					  {
					  	echo "<br />".$row_itunesLink['itunesLink']."<br />";
						}?>
                      <?php if ($totalRows_versionTitles > 0) { // Show if recordset not empty ?>
                      <br>
                      <table width="360" bgcolor="#999999" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td align="center"><?php do { ?>
                              <table width="360" border="0" bgcolor="#000000">
                                <tr>
                                  <td width="38" rowspan="2"><img src="<?php echo $row_versionTitles['imgUrlSmall']; ?>" border="0"></td>
                                  
                                </tr>
                                <tr>

                                  <td>
                                      <h3><a href="58_viewrelease.php?releaseID=<?php echo $row_versionTitles['releaseID']; ?>" class="linkageStuff"><?php echo $row_versionTitles['releaseTitle']; ?> (<?php echo $row_versionTitles['country']; ?>)</a></h3>
                                      <font color="#999999" size="1" face="Arial, Helvetica, sans-serif">[<?php echo $row_versionTitles['versionTitle']; ?>]</font><br>
                                      <font size="1" color="#e3e3e3" face="Arial, Helvetica, sans-serif"><?php echo date('F d, Y',strtotime($row_versionTitles['releaseDate'])); ?></font></td>
                                </tr>
                              </table>
                              <?php } while ($row_versionTitles = mysql_fetch_assoc($versionTitles)); ?></td>
                        </tr>
                      </table>
                      <br>
                      <?php } // Show if recordset not empty ?>
                      <font face="Arial, Helvetica, sans-serif" size="1"> <em>
                    <?php if ($totalRows_versionTitles == 0) { // Show if recordset empty ?>
                      	<br>Currenly unreleased.
              		<?php } // Show if recordset empty ?>
					</em></font>
					<hr>
                    	<font size="1" face="Arial, Helvetica, sans-serif"><img src="images/minibar_abouttrack.gif" width="250" height="27"><br>
                    	<font color="#CCCCCC"><?php echo $row_trackDetails['notes']; ?></font></font><br><br>
              </td>
                  	<td align="center" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="5">
                      <tr>
                        <td width="400" valign="top">
                        <?php if($totalRows_openingtracks>0) {?>
                            <table width="400" border="0" cellspacing="0" cellpadding="1" align="left">
                         		<tr>
									<td bgcolor="#FFFFFF"><font color="#000000" size="1" face="Arial, Helvetica, sans-serif"><?php echo $row_openingtracks['song_name_display']; ?> has opened the main set <?php echo $totalRows_openingtracks; ?> times.</font></td>
                              	</tr>
                              	<tr>
                                	<td bgcolor="#FFFFFF"><table width="300" border="0" cellspacing="0" cellpadding="0">
                                    	<table width="400" border="0" cellspacing="0" cellpadding="0">
                                      	<?php $recordCounter = 0; ?>
                                      	<?php do { ?><tr<?php $recordCounter=$recordCounter+1;if ($recordCounter % 2 == 1){echo " bgcolor=#333399";} else{echo " bgcolor=#000000";}?>>
												<td height="2" nowrap><font color="#3399CC" size="1" face="Arial, Helvetica, sans-serif"><a href="58_displayshow.php?external_show_id=<?php echo $row_openingtracks['external_show_id']; ?>" class="linkageStuff"><?php echo $row_openingtracks['showDate']; ?> - <?php echo $row_openingtracks['venue_name_display']; ?> - <?php echo $row_openingtracks['city_name_display']; ?></a></font></td>
                                      		</tr>
                                      	<?php } while ($row_openingtracks = mysql_fetch_assoc($openingtracks)); ?>
                                    	</table></td></tr>
                    </table>
                   </td>

                </tr>
                <tr>
                  <td><?php } ?>
                      <br>
                      <?php if($totalRows_encoreLead>0) {?>
                      <table width="400" border="0" cellspacing="0" cellpadding="1" align="left">
                        <tr>
                          <td bgcolor="#FFFFFF"><font color="#000000" size="1" face="Arial, Helvetica, sans-serif"><?php echo $row_encoreLead['song_name_display']; ?> has opened the first encore <?php echo $totalRows_encoreLead; ?> times.</font></td>
                        </tr>
                        <tr>
                          <td bgcolor="#FFFFFF"><table width="300" border="0" cellspacing="0" cellpadding="0">
                              <table width="400" border="0" cellspacing="0" cellpadding="0">
                                <?php $recordCounter = 0; ?>
                                <?php do { ?>
                                <tr<?php $recordCounter=$recordCounter+1; if ($recordCounter % 2 == 1) {echo " bgcolor=#333399";} else { echo " bgcolor=#000000";} ?>>
                                  <td height="2" nowrap>
                                  <?php if($totalRows_encoreLead>0) {?>
                                  <font color="#3399CC" size="1" face="Arial, Helvetica, sans-serif">
                                    
                                    <a href="58_displayshow.php?external_show_id=<?php echo $row_encoreLead['external_show_id']; ?>" class="linkageStuff"><?php echo $row_encoreLead['showDate']; ?> - <?php echo $row_encoreLead['venue_name_display']; ?> - <?php echo $row_encoreLead['city_name_display']; ?></a>
                                    </font><?php } ?>&nbsp;
                                  </td>
                                </tr>
                                <?php } while ($row_encoreLead = mysql_fetch_assoc($encoreLead)); ?>
                              </table></td></tr>
              </table>
                <br></td>
          </tr>
          <tr>
            <td><?php } ?>
                <br />
                <?php if($totalRows_encore2Lead>0) {?>
                <table width="400" border="0" cellspacing="0" cellpadding="1" align="left">
                  <tr>
                    <td bgcolor="#FFFFFF"><font color="#000000" size="1" face="Arial, Helvetica, sans-serif"><?php echo $row_encore2Lead['song_name_display']; ?> has opened the second encore <?php echo $totalRows_encore2Lead; ?> times.</font></td>
                  </tr>
                  <tr>
                    <td bgcolor="#FFFFFF"><table width="300" border="0" cellspacing="0" cellpadding="0">
                        <table width="400" border="0" cellspacing="0" cellpadding="0">
                          <?php $recordCounter = 0; ?>
                          <?php do { ?>
                          <tr<?php $recordCounter=$recordCounter+1; if ($recordCounter % 2 == 1) {echo " bgcolor=#333399";} else { echo " bgcolor=#000000";} ?>>
                            <td height="2" nowrap><font color="#3399CC" size="1" face="Arial, Helvetica, sans-serif">
                              <?php if($totalRows_encore2Lead>0) {?>
                              <a href="58_displayshow.php?external_show_id=<?php echo $row_encore2Lead['external_show_id']; ?>" class="linkageStuff"><?php echo $row_encore2Lead['showDate']; ?> - <?php echo $row_encore2Lead['venue_name_display']; ?> - <?php echo $row_encore2Lead['city_name_display']; ?></a>
                              <?php } ?>

                            </font></td>
                          </tr>
                          <?php } while ($row_encore2Lead = mysql_fetch_assoc($encore2Lead)); ?>
                        </table>
                    </table></td>
                  </tr>

        <?php } ?>
                </table>
        </table>
        <br>
        <br>
        <table width="800" cellpadding="5">
          <tr>
            <td valign="top" bgcolor="#333366"><font color="#FFFFFF">
              <?php require_once('58ss_includes/58disclaimer.php'); ?>
            </td>
          </tr>
        </table>
    </div></td>
  </tr>
</table>
</td></tr></table>


<body>
</body>
</html>

</xsl:template>
</xsl:stylesheet>



