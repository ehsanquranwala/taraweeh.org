<?php require_once('Connections/connDoraTarjumaQuran.php'); ?>
<?php require_once('Connections/connDoraTarjumaQuran.php'); ?>
<?php
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  $theValue = (!get_magic_quotes_gpc()) ? addslashes($theValue) : $theValue;

  switch ($theType) {   
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? "'" . doubleval($theValue) . "'" : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
// *** Redirect if username exists
$MM_flag="MM_insert";
if (isset($_POST[$MM_flag])) {
if(($_POST['Email']=='')or($_POST['UserName']=='')or($_POST['Password']==''))
{    
	$insertGoTo = "signup.php?s=bl";
 	header(sprintf("Location: %s", $insertGoTo));
    exit;
}
  $MM_dupKeyRedirect = "signup.php?s=na";//status= username(email) not available
  $loginUsername = $_POST['UserName'];
  $LoginRS__query = "SELECT * FROM user WHERE UserName='" . $loginUsername . "'";
  mysqli_select_db($connDoraTarjumaQuran, $database_connDoraTarjumaQuran);
  $LoginRS=mysqli_query($LoginRS__query) or die(mysqli_error());
  $loginFoundUser = mysqli_num_rows($LoginRS);

  //if there is a row in the database, the username was found - can not add the requested username
  if($loginFoundUser){
    $MM_qsChar = "?";
    //append the username to the redirect page
    if (substr_count($MM_dupKeyRedirect,"?") >=1) $MM_qsChar = "&";
    $MM_dupKeyRedirect = $MM_dupKeyRedirect . $MM_qsChar ."requsername=".$loginUsername;
    header ("Location: $MM_dupKeyRedirect");
    exit;
  }
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
$insertSQL = sprintf("INSERT INTO user (UserId, Email, UserName, Password, verified) VALUES (default, %s, lower(%s), %s, 1)",
                       GetSQLValueString($_POST['Email'], "text"),
					   GetSQLValueString($_POST['UserName'], "text"),
                       GetSQLValueString($_POST['Password'], "text"));
	mysqli_select_db($connDoraTarjumaQuran, $database_connDoraTarjumaQuran);
	$Result1 = mysqli_query($insertSQL) or die(mysqli_error());
	$uid = mysql_insert_id($connDoraTarjumaQuran);
	//  $insertGoTo = "verifyemail.php?p=n&uid=".$uid;
	$insertGoTo = "verifyemail.php?p=v&uid=".$uid;
	header(sprintf("Location: %s", $insertGoTo));
}
  
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" /><meta name="keywords" content="quran qur'an koran tafseer tafsir exegesis explanation dars arabic downloads books articles quiz questions answers taraveeh taravih prayer ramzan ramadhan roza fasting islam jihad dr israr pakistan khilafat caliphate muslims tanzeem e islami nifaz e shariat islami nizam">
<meta name="description" content="quran qur'an koran tafseer tafsir exegesis explanation dars arabic downloads books articles quiz questions answers taraveeh taravih prayer ramzan ramadhan roza fasting islam jihad dr israr pakistan khilafat caliphate muslims tanzeem e islami nifaz e shariat islami nizam">
<title>Create a free Account at Dora Tarjuma Quran</title>
<style type="text/css">
<!--
.style1 {
	font-size: large;
	color: #FF0000;
}
-->
</style>
<?php include("header.php"); ?>
</head><body bgcolor="#669933"><table width="800" border="1" align="center" cellpadding="0" bgcolor="#CCEEAA"  cellspacing="0">
<tr><td align="center"><h1 align="center">Create an Account</h1>You just need a valid email address to create an account.(the one you use most frequently)<br  />
  <span class="style1">
  <?php if(isset($_GET['s']))
  {
	  if($_GET['s']=='na')echo '<br  />'.$_GET['requsername'].' is already registered, please try a different one.';
	  else if($_GET['s']=='bl')echo '<br  />You left something blank, Please fill all the following fields.';
  }?></span><br  />
<form method="post" name="form1" action="<?php echo $editFormAction; ?>">
  <table align="center">
   <tr valign="baseline">
      <td nowrap align="right">Email:</td>
      <td><input type="text" name="Email" value="" size="40"></td>
    </tr>
    <tr valign="baseline">
      <td align="right" nowrap>UserName:</td>
      <td><input type="text" name="UserName" value="" size="20">
      </td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Password:</td>
      <td><input type="password" name="Password" value="" size="20"></td>
    </tr>
	<tr valign="baseline"><td>&nbsp;</td>
      <td><input type="submit" value="Done"></td>
    </tr>
 <input type="hidden" name="MM_insert" value="form1">
 </table>
</form>
<br  /><br  />
</td></tr></table>
</body>
<?php include("footer.php"); ?>
</html>