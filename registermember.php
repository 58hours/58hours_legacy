<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>User registration</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</head>
<?php echo $HTTP_GET_VARS['errorCode']; ?>
<body>
<form name="form1" id="form1" method="post" action="">
<table width="300" border="0" cellspacing="1" cellpadding="1">
  <tr>
    <td colspan="2" align="right" bgcolor="#FFFFFF"><div align="left"><font size="2" face="Arial, Helvetica, sans-serif"><strong>user registration:</strong>
    <br>note: if you've already registed with 58hours.com earlier, try your former login & pass... we've attempted to preserve the old member structure during th upgrade...<br>
    love y'all,<br>brian<br><br></font></div></td>
    </tr>
  <tr>
    <td width="20" align="right"><strong><font size="1" face="Arial, Helvetica, sans-serif">USERNAME:</font></strong></td>
    <td bgcolor="#CCCCCC"><font size="1" face="Arial, Helvetica, sans-serif">
      <input name="textfield" type="text" size="10" />
    </font></td>
  </tr>
  <tr>
    <td width="20" align="right"><strong><font size="1" face="Arial, Helvetica, sans-serif">PASSWORD:</font></strong></td>
    <td bgcolor="#CCCCCC"><font size="1" face="Arial, Helvetica, sans-serif">
      <input name="textfield2" type="text" size="10" />
    </font></td>
  </tr>
  <tr>
    <td width="20" align="right"><strong><font size="1" face="Arial, Helvetica, sans-serif">RETYPE PASSWORD:</font></strong></td>
    <td bgcolor="#CCCCCC"><font size="1" face="Arial, Helvetica, sans-serif">
      <input name="textfield3" type="text" size="10" />
    </font></td>
  </tr>
  <tr>
    <td width="20" align="right"><strong><font size="1" face="Arial, Helvetica, sans-serif">EMAIL ADDRESS:</font></strong></td>
    <td bgcolor="#CCCCCC"><font size="1" face="Arial, Helvetica, sans-serif">
      <input name="textfield4" type="text" size="10" />
    </font></td>
  </tr>
  <tr>
    <td width="20"><font size="1" face="Arial, Helvetica, sans-serif">&nbsp;</font></td>
    <td><font size="1" face="Arial, Helvetica, sans-serif">&nbsp;</font></td>
  </tr>
  <tr>
    <td width="20"><font size="1" face="Arial, Helvetica, sans-serif">&nbsp;</font></td>
    <td><font size="1" face="Arial, Helvetica, sans-serif">
      <input type="reset" name="Reset" value="Reset" />
      <input type="submit" name="Submit2" value="Submit" />
    </font></td>
  </tr>
</table>
</form>
</body>
</html>
