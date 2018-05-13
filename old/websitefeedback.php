<?php require_once('Connections/connDoraTarjumaQuran.php'); ?>
<?php
if (!isset($_SESSION)) {session_start();}
if (!isset($_SESSION['UserId'])) {$_SESSION['UserId'] = 0;}
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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
/////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////Create and send Feedback////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////
	/*$to = 'ehsantemp@yahoo.com';
	$subject = 'doratarjumaquran.pk Website Feedback';
	$headers = 'From: support@connect.net.pk\r\n';
	$message = $_POST['WebsiteFeedback'];
	mail($to,$subject,$message,$headers);*/

$insertSQL = sprintf("INSERT INTO websitefeedback (WebsiteFeedbackId, UserId, SubmitDateTime, Feedback) VALUES (default, %s, now(), %s)",				   GetSQLValueString($_SESSION['UserId'], "int"),
   GetSQLValueString($_POST['WebsiteFeedback'], "text"));
	
	mysqli_select_db($connDoraTarjumaQuran, $database_connDoraTarjumaQuran);
	$Result1 = mysqli_query($insertSQL) or die(mysqli_error());
	
	$insertGoTo = "thanks.php";
	header(sprintf("Location: %s", $insertGoTo));
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" /><meta name="keywords" content="quran qur'an koran tafseer tafsir exegesis explanation dars arabic downloads books articles quiz questions answers taraveeh taravih prayer ramzan ramadhan roza fasting islam jihad dr israr pakistan khilafat caliphate muslims tanzeem e islami nifaz e shariat islami nizam">
<meta name="description" content="quran qur'an koran tafseer tafsir exegesis explanation dars arabic downloads books articles quiz questions answers taraveeh taravih prayer ramzan ramadhan roza fasting islam jihad dr israr pakistan khilafat caliphate muslims tanzeem e islami nifaz e shariat islami nizam">
<meta name="keywords" content="quran qur'an koran tafseer tafsir exegesis explanation dars arabic downloads books articles quiz questions answers taraveeh taravih prayer ramzan ramadhan roza fasting islam jihad dr israr pakistan khilafat caliphate muslims tanzeem e islami nifaz e shariat islami nizam">
<meta name="description" content="quran qur'an koran tafseer tafsir exegesis explanation dars arabic downloads books articles quiz questions answers taraveeh taravih prayer ramzan ramadhan roza fasting islam jihad dr israr pakistan khilafat caliphate muslims tanzeem e islami nifaz e shariat islami nizam">
<title>Website Feedback</title>
<?php include("header.php"); ?>
</head><body bgcolor="#669933">
<form method="post" name="form1" action="<?php echo $editFormAction; ?>">
  <table align="center" width="800" border="1" cellpadding="0" bgcolor="#CCEEAA"  cellspacing="0"><tr><td align="center"><h1 align="center">Website Feedback</h1><strong>Your feedback is vital for our improvement</strong><br  />
<span class="style4"><?php if(!isset($_SESSION['UserId'])or(isset($_SESSION['UserId'])and $_SESSION['UserId']==0)) echo 'You need to be signed in to submit your feedback.<br />Please <a href="signin.php?u=wf">Sign In</a> or <a href="signup.php">Create an account.</a>';?></span></td></tr>
    <tr valign="baseline"><th width="327" align="center" nowrap></th></tr>
	<tr><td align="center"></td>
  </tr>
	  <tr><td align="center"><textarea name="WebsiteFeedback" cols="50" rows="5"></textarea><br  /><input type="submit" value="Submit Feedback" <?php if(!isset($_SESSION['UserId'])or(isset($_SESSION['UserId'])and $_SESSION['UserId']==0)) echo 'disabled="disabled"';?>></td>
</tr>
  </table>
  <input type="hidden" name="UserId" value="<?php echo $_SESSION['UserId'];?>">
  <input type="hidden" name="MM_insert" value="form1">
</form>
</body>
<?php include("footer.php"); ?>
</html>