<?php require_once('Connections/connDoraTarjumaQuran.php'); ?><?php
if (!isset($_SESSION)) session_start();

$loginFormAction = $_SERVER['PHP_SELF'];
if(isset($_GET['u']))$loginFormAction.='?u='.$_GET['u'];
/////////////////////////////////////////////////////////////////////////////////
//////////////////////////User Sign In///////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////

if (isset($_POST['UserName'])) {
	$url="index.php";
	if(isset($_GET['u']))
	{
		if(!strcmp($_GET['u'],'pf'))$url="programfeedback.php";
		else if(!strcmp($_GET['u'],'i'))$url="invite.php";
		else if(!strcmp($_GET['u'],'qi'))$url="quizindex.php";
		else if(!strcmp($_GET['u'],'wf'))$url="websitefeedback.php";
		else if(!strcmp($_GET['u'],'g'))$url="gallery.php";
	}
	$loginUsername=$_POST['UserName'];
	$password=$_POST['Password'];
	$MM_fldUserAuthorization = "";
	$MM_redirectLoginSuccess = $url;
	$MM_redirectLoginFailed = "signin.php?st=f";
	$MM_redirecttoReferrer = true;
	mysqli_select_db($connDoraTarjumaQuran, $database_connDoraTarjumaQuran);
	$LoginRS__query=sprintf("SELECT UserId, Email, UserName, CONCAT_WS(' ', Prefix, FirstName, LastName) FullName, Mobile, CityTown, Region FROM user WHERE UserName=lower('%s') AND Password='%s' AND verified=1",
	get_magic_quotes_gpc() ? $loginUsername : addslashes($loginUsername), get_magic_quotes_gpc() ? $password : addslashes($password)); 
	$LoginRS = mysqli_query($LoginRS__query) or die(mysqli_error());
	$row_User = mysqli_fetch_assoc($LoginRS);
	$loginFoundUser = mysqli_num_rows($LoginRS);
	if ($loginFoundUser) {    
	$_SESSION['UserId'] = $row_User['UserId'];
	$_SESSION['Email'] = $row_User['Email'];	
	$_SESSION['UserName'] = $row_User['UserName'];
	$_SESSION['FullName'] = $row_User['FullName'];
	$_SESSION['Mobile'] = $row_User['Mobile'];
	$_SESSION['Region'] = $row_User['Region'];
	$_SESSION['CityTown'] = $row_User['CityTown'];
	
	mysqli_select_db($connDoraTarjumaQuran, $database_connDoraTarjumaQuran);
	$LoginRS__query="SELECT UserId from Admins where UserId=".$row_User['UserId'];
	$LoginRS = mysqli_query($LoginRS__query) or die(mysqli_error());
	$loginFoundUser = mysqli_num_rows($LoginRS);
	if($loginFoundUser) $_SESSION['Admin']=1;else $_SESSION['Admin']=0;
	echo $_SESSION['Admin'];
	header("Location: " . $MM_redirectLoginSuccess );
}
else header("Location: ". $MM_redirectLoginFailed );
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" /><meta name="keywords" content="quran qur'an koran tafseer tafsir exegesis explanation dars arabic downloads books articles quiz questions answers taraveeh taravih prayer ramzan ramadhan roza fasting islam jihad dr israr pakistan khilafat caliphate muslims tanzeem e islami nifaz e shariat islami nizam">
<meta name="description" content="quran qur'an koran tafseer tafsir exegesis explanation dars arabic downloads books articles quiz questions answers taraveeh taravih prayer ramzan ramadhan roza fasting islam jihad dr israr pakistan khilafat caliphate muslims tanzeem e islami nifaz e shariat islami nizam">
<title>Sign In to Dora Tarjuma Quran</title>
<style type="text/css">
<!--
.style3 {
	font-size: smaller;
	color: #FF0000;
}
-->
</style>
<?php include("header.php"); ?>
<style type="text/css">
<!--
.style2 {
	font-size: medium;
	color: #FF0000;
	font-weight: bold;
}
-->
</style>
</head>

<body bgcolor="#669933">
<table width="800" border="1" align="center" cellpadding="0" bgcolor="#CCEEAA"  cellspacing="0">
<tr><th align="center"><h1 align="center">Please Sign In or Create your free account now</h1>By signing in you can take the Daily Online Quiz, Send Dora Tarjuma Quran Invitations,<br  />Submit Feedbacks for the Program or Website and Upload pictures in the gallery.</td></tr>
<tr ><td><span class="style2">
	  <?php if ((isset($_GET['pending']))and($_GET['pending']=='feedback'))
	{echo "We are extremely thankful for your feedback.<br />Please (Sign In/Create an account) so that we keep your infomation with the feedback.<br />";}
	else if ((isset($_GET['pending']))and($_GET['pending']=='invitation'))
	{echo "Your invitations are currently pending.<br />Please (Sign In/Create an account) to send the invitations.<br />";}?>
    </span>
<form ACTION="<?php echo $loginFormAction; ?>"  id="form1" name="form1" method="POST">
<h2 align="center">Assalam u alaikum</h2>
<table width="300" border="0" align="center" cellpadding="0" bgcolor="#CCEEAA"  cellspacing="0">
  <tr>
    <td width="40%" align="center" scope="col">UserName</td>
    <td width="60%" align="center" scope="col"><input type="text" name="UserName" id="UserName" value="" /></td>
  </tr>
  
  <tr>
    <td align="center">Password</td>
    <td align="center"><input type="password" name="Password" id="Password" value=""/></td>
  </tr>
</table>
<table width="300" border="0" align="center" cellpadding="3" cellspacing="0">
  <tr><td align="center" scope="col"><input type="submit" name="Submit2" value="Wa alaikum assalam" /></td></tr>
  <?php if((isset($_GET['st']))and($_GET['st']=='f')) echo "<tr><td align=\"center\" scope=\"col\">Sign In Failed, Try again</td></tr>";?>
  <tr><td align="center" scope="col">New User? <a href="signup.php">Create an account</a></td></tr>
</table></form></th></tr>
<tr><td align="center" scope="col">Forgot Password,	Send an email at nazim@doratarjumaquran.pk<br  />with subject "Password Recovery" from the email address you registered.</td></tr>
</table> 
</body>
<?php include("footer.php"); ?>
</html>