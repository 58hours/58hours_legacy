<?php // signup.php

include("common.php");
include("db.php");

if (!isset($_POST['submitok'])):
    // Display the user signup form
    ?>
<!DOCTYPE html PUBLIC "-//W3C/DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <title>58hours member registration</title>
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>
<body bgcolor="#000000">
<font color="#FFFFFF" size="2" face="Arial, Helvetica, sans-serif">New User Registration Form<font color="orangered" size="+1">
</font>
<br />
<table width="300" border="0" cellpadding="1" cellspacing="1" bgcolor="#FFFFFF">
  <tr>
    <td align="center"><form method="post" action="<?=$_SERVER['PHP_SELF']?>">
      <table border="0" cellpadding="0" cellspacing="5" bgcolor="#000033">
        <tr>
          <td align="right" nowrap="nowrap"><p><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif">User ID</font></p></td>
          <td><font size="1" face="Arial, Helvetica, sans-serif">
            <input name="newid" type="text" maxlength="100" size="25" />
            <font color="orangered"><tt><b>*</b></tt></font></font> </td>
        </tr>
        <tr>
          <td align="right" nowrap="nowrap"><p><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif">Full Name</font></p></td>
          <td><font size="1" face="Arial, Helvetica, sans-serif">
            <input name="newname" type="text" maxlength="100" size="25" />
            <font color="orangered"><tt><b>*</b></tt></font></font> </td>
        </tr>
        <tr>
          <td align="right" nowrap="nowrap"><p><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif">E-Mail Address</font></p></td>
          <td><font size="1" face="Arial, Helvetica, sans-serif">
            <input name="newemail" type="text" maxlength="100" size="25" />
            <font color="orangered"><tt><b>*</b></tt></font></font> </td>
        </tr>
        <tr valign="top">
          <td align="right" nowrap="nowrap"><p><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif">Other Notes</font></p></td>
          <td><font size="1" face="Arial, Helvetica, sans-serif">
            <textarea wrap="soft" name="newnotes" rows="5" cols="30"></textarea>
          </font></td>
        </tr>
        <tr>
          <td align="right" colspan="2"><div align="left"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif"> <tt><b>*</b></tt> indicates a required field </font></div>
              <p></p>
              <font size="1" face="Arial, Helvetica, sans-serif">
              <input type="reset" value="Reset Form" />
              <input type="submit" name="submitok" value="   OK   " />
            </font></td>
        </tr>
      </table>
    </form></td>
  </tr>
</table>
</body>
</html>

    <?php
else:
    // Process signup submission
    dbConnect('briankiel_com');

    if ($_POST['newid']=='' or $_POST['newname']==''
      or $_POST['newemail']=='') {
        error('One or more required fields were left blank.\\n'.
              'Please fill them in and try again.');
    }
    
    // Check for existing user with the new id
    $sql = "SELECT COUNT(*) FROM 58_members WHERE pn_uname = '$_POST[newid]'";
    $result = mysql_query($sql);
    if (!$result) {	
        error('A database error occurred in processing your '.
              'submission.\\nIf this error persists, please '.
              'contact registation@58hours.com.');
    }
    if (mysql_result($result,0,0)>0) {
        error('A user already exists with your chosen userid.\\n'.
              'Please try another.');
    }
    
    $newpass = substr(md5(time()),0,6);
    
    $sql = "INSERT INTO 58_members SET
              pn_uname = '$_POST[newid]',
              pn_pass = '".md5($newpass)."',
              pn_name = '$_POST[newname]',
              pn_email = '$_POST[newemail]',
              pn_bio = '$_POST[newnotes]'";
    if (!mysql_query($sql))
        error('A database error occurred in processing your '.
              'submission.\\nIf this error persists, please '.
              'contact registration@58hours.com.\\n' . mysql_error());
              
    // Email the new password to the person.
    $message = "G'Day!

Your personal account for 58hours
has been created! To log in, proceed to the
following address:

    http://www.58hours.com/

Your personal login ID and password are as
follows:

    userid: $_POST[newid]
    password: $newpass

You aren't stuck with this password! Your can
change it at any time after you have logged in.

If you have any problems, feel free to contact me at
<registration@58hours.com>.

-Brian
 Headmaster of 58hours.com
";

    mail($_POST['newemail'],"Your Password for the Project Website",
         $message, "From:58hours staff <registration@58hours.com>");
         
    ?>
    <!DOCTYPE html PUBLIC "-//W3C/DTD XHTML 1.0 Transitional//EN"
      "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml">
    <head>
      <title> Registration Complete </title>
      <meta http-equiv="Content-Type"
        content="text/html; charset=iso-8859-1" />
    </head>
    <body>
    <p><strong>User registration successful!</strong></p>
    <p>Your userid and password have been emailed to
       <strong><?=$_POST['newemail']?></strong>, the email address
       you just provided in your registration form. To log in,
       click <a href="index.php">here</a> to return to the login
       page, and enter your new personal userid and password.</p>
    </body>
    </html>
    <?php
endif;
?>
