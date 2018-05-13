<?php require_once('Connections/connDoraTarjumaQuran.php'); ?>
<?php
/*if($_GET['p']=='v'){
  $updateSQL = "UPDATE user SET verified=1 WHERE UserId=".$_GET['uid'];
  mysqli_select_db($connDoraTarjumaQuran, $database_connDoraTarjumaQuran);
  $Result1 = mysqli_query($updateSQL) or die(mysqli_error());}*/
  
  $LoginRS__query="SELECT UserId, Email, UserName, CONCAT_WS(' ', Prefix, FirstName, LastName) FullName,  Mobile FROM user where UserId=".$_GET['uid']." AND verified=1";
    mysqli_select_db($connDoraTarjumaQuran, $database_connDoraTarjumaQuran);
 	$LoginRS = mysqli_query($LoginRS__query) or die(mysqli_error());
	$row_User = mysqli_fetch_assoc($LoginRS);
	$loginFoundUser = mysqli_num_rows($LoginRS);
  	if ($loginFoundUser) {    
    if (!isset($_SESSION))session_start();
	$_SESSION['UserId'] = $row_User['UserId'];
	$_SESSION['Email'] = $row_User['Email'];	
	$_SESSION['UserName'] = $row_User['UserName'];
	$_SESSION['FullName'] = $row_User['UserName'];
	$_SESSION['Mobile'] = $row_User['Mobile'];
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" /><meta name="keywords" content="quran qur'an koran tafseer tafsir exegesis explanation dars arabic downloads books articles quiz questions answers taraveeh taravih prayer ramzan ramadhan roza fasting islam jihad dr israr pakistan khilafat caliphate muslims tanzeem e islami nifaz e shariat islami nizam">
<meta name="description" content="quran qur'an koran tafseer tafsir exegesis explanation dars arabic downloads books articles quiz questions answers taraveeh taravih prayer ramzan ramadhan roza fasting islam jihad dr israr pakistan khilafat caliphate muslims tanzeem e islami nifaz e shariat islami nizam">
<title>Email Verfication</title>
<?php include("header.php"); ?>
</head><body bgcolor="#669933">
<table align="center" width="800" border="1" cellpadding="0" bgcolor="#CCEEAA"  cellspacing="0">
<tr align="center"><td><?php /*verifying your email*/if($_GET['p']=='v')echo '<h1 align="center">Thank You for Signing Up</h1>
  Your account has been activated and you are signed in now<br />
  Please update your profile <a href="editprofile.php">here</a><br /><br /><br /></td></tr>';
  else if($_GET['p']=='n')echo '<h1 align="center">Thank You for Signing Up</h1>
  An email has been sent at the given email address to verify its validity and that you own it.<br /><br />
  1) Please check your email and click on the link in it to activate your account.<br />
  2) If you don\'t find the email, check in the spam or please wait as it may take some time.<br />
  3) If you don\'t recieve the verification request within 24 hours, send us an email at <br />
  nazim@doratarjumaquran.pk with subject "Email Verification" from the email address you registered.<br /><br />
  In the mean time you can browse rest of the site. Jazakallah</td></tr>';?>
</table>
</body>
<?php include("footer.php"); ?>
</html>