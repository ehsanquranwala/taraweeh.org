<?php require_once('Connections/connDoraTarjumaQuran.php'); ?>
<?php
if (!isset($_SESSION)) {session_start();}
$Admin=0;if(isset($_SESSION['Admin']) and ($_SESSION['Admin']==1))$Admin=1;
$maxRows_rs_Speaker = 300;
$pageNum_rs_Speaker = 0;
if (isset($_GET['pageNum_rs_Speaker'])) {
  $pageNum_rs_Speaker = $_GET['pageNum_rs_Speaker'];
}
$startRow_rs_Speaker = $pageNum_rs_Speaker * $maxRows_rs_Speaker;

mysqli_select_db($connDoraTarjumaQuran, $database_connDoraTarjumaQuran);
$query_rs_Speaker = "SELECT distinct(u.UserId), CONCAT_WS(' ', u.Prefix, u.FirstName, u.LastName) Speaker, (YEAR(CURDATE())-YEAR(u.DateOfBirth)) - (RIGHT(CURDATE(),5)<RIGHT(u.DateOfBirth,5)) AS age, u.Education, u.Profession, u.CityTown FROM user u order by Speaker";
$query_limit_rs_Speaker = sprintf("%s LIMIT %d, %d", $query_rs_Speaker, $startRow_rs_Speaker, $maxRows_rs_Speaker);
$rs_Speaker = mysqli_query($connDoraTarjumaQuran, $query_limit_rs_Speaker) or die(mysqli_error());
$row_rs_Speaker = mysqli_fetch_assoc($rs_Speaker);

if (isset($_GET['totalRows_rs_Speaker'])) {
  $totalRows_rs_Speaker = $_GET['totalRows_rs_Speaker'];
} else {
  $all_rs_Speaker = mysqli_query($connDoraTarjumaQuran, $query_rs_Speaker);
  $totalRows_rs_Speaker = mysqli_num_rows($all_rs_Speaker);
}
$totalPages_rs_Speaker = ceil($totalRows_rs_Speaker/$maxRows_rs_Speaker)-1;
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" /><meta name="keywords" content="quran qur'an koran tafseer tafsir exegesis explanation dars arabic downloads books articles quiz questions answers taraveeh taravih prayer ramzan ramadhan roza fasting islam jihad dr israr pakistan khilafat caliphate muslims tanzeem e islami nifaz e shariat islami nizam">
<meta name="description" content="quran qur'an koran tafseer tafsir exegesis explanation dars arabic downloads books articles quiz questions answers taraveeh taravih prayer ramzan ramadhan roza fasting islam jihad dr israr pakistan khilafat caliphate muslims tanzeem e islami nifaz e shariat islami nizam">
<title>Dora Tarjuma Quran's Registered Users</title>
<?php include("header.php"); ?>
<style type="text/css">
<!--
.style1 {
	font-size: x-large;
	color: #006600;
}
-->
</style>
<?php include("adminquicklinks.php");?></head>

<body bgcolor="#669933"><br />
<table width="800" border="1" align="center" cellpadding="0" bgcolor="#CCEEAA"  cellspacing="0">
<tr><td align="center"><h1 align="center">Dora Tarjuma Quran Users</h1>
Following is a list of all user registerd on doratarjumaquran.pk. You can select from them to see their profile and edit them</td>
</tr></table>
<table width="800" border="1" align="center" cellpadding="0" bgcolor="#CCEEAA"  cellspacing="0">
  <tr bgcolor="#99CC66">
  <th scope="col">SNo</th>
    <th scope="col">Name</th>
    <th scope="col">Age</th>
    <th scope="col">Education</th>
    <th scope="col">Profession</th>
    <th scope="col">Location</th>
	<?php if($Admin) echo '<th scope="col">Edit</th>';?>
  </tr>
  <?php $sno=1; do { ?>
    <tr>
	<td align="center"><?php echo $sno++; ?></td>
      <td><a href="profile.php?uid=<?php echo $row_rs_Speaker['UserId']; ?>"><?php echo $row_rs_Speaker['Speaker']; ?></a>&nbsp;</td>
      <td><?php echo $row_rs_Speaker['age']; ?>&nbsp;</td>
      <td><?php echo $row_rs_Speaker['Education']; ?>&nbsp;</td>
      <td><?php echo $row_rs_Speaker['Profession']; ?>&nbsp;</td>
      <td><?php echo $row_rs_Speaker['CityTown']; ?>&nbsp;</td>
	  	<?php if($Admin) echo '<td><a href="editprofile.php?uid='.$row_rs_Speaker['UserId'].'">Edit</a></td>';?>
    </tr>
    <?php } while ($row_rs_Speaker = mysqli_fetch_assoc($rs_Speaker)); ?>
</table>
<table width="800" border="1" align="center" cellpadding="0" bgcolor="#CCEEAA"  cellspacing="0">
<tr><th>If you are one of the speakers, please do <a href="signup.php">signup</a> and create your profile.</th></tr></table>
</body>
<?php include("footer.php"); ?>
</html>
<?php mysqli_free_result($rs_Speaker);?>