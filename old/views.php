<?php require_once('Connections/connDoraTarjumaQuran.php'); ?>
<?php
$currentPage = $_SERVER["PHP_SELF"];

if(isset($_GET['pfid']))$pfid=$_GET['pfid'];else $pfid=7;

mysqli_select_db($connDoraTarjumaQuran, $database_connDoraTarjumaQuran);
$query_rs_SelectedView = "SELECT u.UserId, CONCAT_ws(' ',Prefix, FirstName, LastName) FullName, pf.ViewHeading, pf.CompleteExperience FROM user u, programfeedback pf WHERE u.UserId=pf.UserId and ProgramFeedbackId=".$pfid;
$rs_SelectedView = mysqli_query($connDoraTarjumaQuran, $query_rs_SelectedView) or die(mysqli_error());
$row_rs_SelectedView = mysqli_fetch_assoc($rs_SelectedView);

mysqli_select_db($connDoraTarjumaQuran, $database_connDoraTarjumaQuran);
$query_rs_Views = "SELECT u.UserId, CONCAT_ws(' ',Prefix, FirstName, LastName) FullName, pf.ViewHeading, pf.CompleteExperience FROM user u, programfeedback pf WHERE u.UserId=pf.UserId order by rand() limit 100";
$rs_Views = mysqli_query($connDoraTarjumaQuran, $query_rs_Views) or die(mysqli_error());
$row_rs_Views = mysqli_fetch_assoc($rs_Views);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" /><meta name="keywords" content="quran qur'an koran tafseer tafsir exegesis explanation dars arabic downloads books articles quiz questions answers taraveeh taravih prayer ramzan ramadhan roza fasting islam jihad dr israr pakistan khilafat caliphate muslims tanzeem e islami nifaz e shariat islami nizam">
<meta name="description" content="quran qur'an koran tafseer tafsir exegesis explanation dars arabic downloads books articles quiz questions answers taraveeh taravih prayer ramzan ramadhan roza fasting islam jihad dr israr pakistan khilafat caliphate muslims tanzeem e islami nifaz e shariat islami nizam">
<title>Suggestions, Feedback, Views and Experiences of Dora Tarjuma Quran</title>
<style type="text/css">
<!--
.style23 {
	color: #000000;
	background: #99CC66;
	font-size: large;
}
-->
</style>
<?php include("header.php"); ?>
</head><body bgcolor="#669933">
<table align="center" width="800" border="1" cellpadding="0" cellspacing="0" bgcolor="#CCEEAA">
<tr><th><h1 align="center">Dora Tarjuma Quran Views and Experiences</h1></th></tr>  
<tr><td align="center" ><div align="center" style="width:70%">
  <span class="style23">A group of people DOES NOT<br />
  (1)Gather in a house from the houses of Allah<br />
  (2)Recites the Book of Allah (Quran) and<br />
  (3)Teaches it amongst them<br />
EXCEPT THAT<br />
  (1)Tranquility is bestowed on them<br />
  (2)Our benevolence covers them<br />
  (3)Angels gather around them and<br />
  (4)Allah mentions them in the gathering of His loved ones.</span><br  />
 </div></td></tr>
  <tr><td><br  />
<table border="0" align="center" cellpadding="0" bgcolor="#CCEEAA" cellspacing="0" width="60%">
  <tr>
    <th align="left"bgcolor="#99CC66">Your Selected View <a href="programfeedback.php">Share your views</a></th>
  </tr>
  <tr><td align="left"><?php if($row_rs_SelectedView['UserId'])echo '<a href="profile.php?uid='.$row_rs_SelectedView['UserId'].'">'.$row_rs_SelectedView['FullName'].'</a>';else echo 'Anonymous';?><br  /><?php echo $row_rs_SelectedView['ViewHeading'];?><br />
<?php echo $row_rs_Views['CompleteExperience']; ?><br /><br  /></td></tr>
 <tr>
    <th align="left"bgcolor="#99CC66">Some randomly selected Views <a href="programfeedback.php">Share your views</a><br /></th>
  </tr>
  <?php do { ?>
    <tr>
<td><?php if($row_rs_Views['UserId']!=116)echo '<a href="profile.php?uid='.$row_rs_Views['UserId'].'">'.$row_rs_Views['FullName'].'</a>';
else echo 'Anonymous';?><br  /><?php echo $row_rs_Views['ViewHeading'];?><br />
<?php echo $row_rs_Views['CompleteExperience']; ?><br  /><br  /></td></tr>
    <?php } while ($row_rs_Views = mysqli_fetch_assoc($rs_Views)); ?>
</table>
</td></tr></table></body>
<?php include("footer.php"); ?>
</html>
<?php mysqli_free_result($rs_Views);?>