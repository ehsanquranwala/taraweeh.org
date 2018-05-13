<?php require_once('Connections/connDoraTarjumaQuran.php'); ?>
<?php
if (!isset($_SESSION)) {session_start();}
$speaker=0;$usrid=0;$showedit=0;
if(isset($_GET['sp'])and($_GET['sp']==1))$speaker=1;
if(isset($_GET['uid']))//is viewing some one else's profile
{
	$usrid=$_GET['uid'];//let him view
	if(isset($_SESSION['Admin']) and ($_SESSION['Admin']==1)){$showedit=1;}//is admin show him edit link
	else if(isset($_SESSION['UserId'])and($_SESSION['UserId']==$_GET['uid'])){$showedit=1;}//is viewing his own profile show him edit link
}
else if(isset($_SESSION['UserId']))//user is signed in
{
	$usrid=$_SESSION['UserId'];//is viewing his own profile, let him
	$showedit=1;
}

mysqli_select_db($connDoraTarjumaQuran, $database_connDoraTarjumaQuran);
$query_rs_User = "SELECT (YEAR(CURDATE())-YEAR(u.DateOfBirth)) - (RIGHT(CURDATE(),5)<RIGHT(u.DateOfBirth,5)) AS Age, UserId, Email, UserName, Password, Prefix, FirstName, LastName, Gender, DateOfBirth, Mobile, HomePhone, WorkPhone, TanzeemPhone, HomeAddress, WorkAddress, CityTown, Region, Country, Education, Profession, DetailedNote, JoiningDateAD, JoiningDateHijri, CurrentResponsibilities, HalqaId, MaqamiTanzeemId, UsraId, Mutarjim, Hafiz, Management, verified FROM user u WHERE UserId = ".$usrid;
$rs_User = mysqli_query($connDoraTarjumaQuran, $query_rs_User) or die(mysqli_error());
$row_rs_User = mysqli_fetch_assoc($rs_User);
$totalRows_rs_User = mysqli_num_rows($rs_User);

mysqli_select_db($connDoraTarjumaQuran, $database_connDoraTarjumaQuran);
$query_rs_User_H = "select Halqa from halqa where HalqaId=".$row_rs_User['HalqaId'];
$rs_User_H = mysqli_query($connDoraTarjumaQuran, $query_rs_User_H) or die(mysqli_error());
$row_rs_User_H = mysqli_fetch_assoc($rs_User_H);
$totalRows_rs_User_H = mysqli_num_rows($rs_User_H);

mysqli_select_db($connDoraTarjumaQuran, $database_connDoraTarjumaQuran);
$query_rs_User_MT = "select MaqamiTanzeem from maqamitanzeem where MaqamiTanzeemId=".$row_rs_User['MaqamiTanzeemId'];
$rs_User_MT = mysqli_query($connDoraTarjumaQuran, $query_rs_User_MT) or die(mysqli_error());
$row_rs_User_MT = mysqli_fetch_assoc($rs_User_MT);
$totalRows_rs_User_MT = mysqli_num_rows($rs_User_MT);

mysqli_select_db($connDoraTarjumaQuran, $database_connDoraTarjumaQuran);
$query_rs_User_U = "select Usra from usra where UsraId=".$row_rs_User['UsraId'];
$rs_User_U = mysqli_query($connDoraTarjumaQuran, $query_rs_User_U) or die(mysqli_error());
$row_rs_User_U = mysqli_fetch_assoc($rs_User_U);
$totalRows_rs_User_U = mysqli_num_rows($rs_User_U);

if($speaker){
mysqli_select_db($connDoraTarjumaQuran, $database_connDoraTarjumaQuran);
$query_rs_SpeakersPrograms = "SELECT pl.PlaceId, pr.ProgramId, pr.HijriYear, pr.Year, concat_ws(' ',pt.Translation, pt.Time) Prgtyp, concat_ws(' ', pl.Address, pl.CityTown) Plc FROM program pr, program_speaker ps, programtype pt, place pl WHERE pr.ProgramId = ps.ProgramId and pr.ProgramTypeId = pt.ProgramTypeId and pr.PlaceId=pl.PlaceId and ps.UserId = ".$usrid." ORDER BY pr.Year desc";
$rs_SpeakersPrograms = mysqli_query($connDoraTarjumaQuran, $query_rs_SpeakersPrograms) or die(mysqli_error());
$row_rs_SpeakersPrograms = mysqli_fetch_assoc($rs_SpeakersPrograms);
$totalRows_rs_SpeakersPrograms = mysqli_num_rows($rs_SpeakersPrograms);
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" /><meta name="keywords" content="quran qur'an koran tafseer tafsir exegesis explanation dars arabic downloads books articles quiz questions answers taraveeh taravih prayer ramzan ramadhan roza fasting islam jihad dr israr pakistan khilafat caliphate muslims tanzeem e islami nifaz e shariat islami nizam">
<meta name="description" content="quran qur'an koran tafseer tafsir exegesis explanation dars arabic downloads books articles quiz questions answers taraveeh taravih prayer ramzan ramadhan roza fasting islam jihad dr israr pakistan khilafat caliphate muslims tanzeem e islami nifaz e shariat islami nizam">
<title>Profile</title>
<style type="text/css">
<!--
.style2 {
	font-size: x-large;
	font-weight: bold;
}
-->
</style>
<?php include("header.php"); ?>
</head><body bgcolor="#669933">

<table width="800" border="1" cellpadding="0" bgcolor="#CCEEAA"  cellspacing="0" align="center">
<tr><td><h1 align="center">Profile</h1>
    <?php if($showedit)echo '<div align="right"><a href="editprofile.php?uid='.$usrid.'">Edit Profile</a></div><br  />';?>
        <h2>Personal</h2>
      Full Name: <strong><?php echo $row_rs_User['Prefix'].' '.$row_rs_User['FirstName'].' '.$row_rs_User['LastName']; ?></strong>
	  <?php if(!$speaker) echo 'Age: <strong>'.$row_rs_User['Age'].'</strong>';?><br />
      Education: <strong><?php echo $row_rs_User['Education']; ?></strong><br />
      Profession: <strong><?php echo $row_rs_User['Profession']; ?></strong><br />
	  Location: <strong><?php /* echo $row_rs_User['CityTown'].', '.$row_rs_User['Country'];*/ ?></strong><br /><br />

      Email: <strong><?php echo $row_rs_User['Email']; ?></strong><br />
      Contact: <strong><?php if($speaker)echo $row_rs_User['TanzeemPhone']; else echo $row_rs_User['Mobile']; ?></strong><br />
      <h2>Association With Us</h2>
      Joining Date: <strong><?php /* echo $row_rs_User['JoiningDateAD'].' or '.$row_rs_User['JoiningDateHijri']; */?></strong><br />
      Current Responsibilities: <strong><?php echo $row_rs_User['CurrentResponsibilities']; ?></strong><br />
       <?php echo 'Usra: <br />';/*if($totalRows_rs_User_U)echo '<strong>'.$row_rs_User_U['Usra'].'</strong><br  />';*/
	   	echo 'Maqami Tanzeem: <br />';/*if($totalRows_rs_User_MT)echo '<strong>'.$row_rs_User_MT['MaqamiTanzeem'].'</strong><br  />';*/ 						
		echo 'Halqa: <br />';/*if($totalRows_rs_User_H)echo '<strong>'.$row_rs_User_H['Halqa'].'</strong><br />';*/ ?>
      <br  /><strong>Detailed Note:</strong><br  />
      <textarea cols="90" rows="20" wrap="physical"><?php echo $row_rs_User['DetailedNote']; ?></textarea>
   </td></tr>
   <?php if($speaker){ echo '<tr><td align="center"><h2>Programs</h2>
     <table border="1" cellpadding="0" bgcolor="#CCEEAA"  cellspacing="0">
       <tr>
	     <th scope="col">PrgId</th>
         <th scope="col">Year</th>
         <th scope="col">Place</th>
         <th scope="col">Program Type</th>
       </tr>';
   do { echo '
       <tr>
	   <td><a href="programdetails.php?prid='.$row_rs_SpeakersPrograms['ProgramId'].'">'.$row_rs_SpeakersPrograms['ProgramId'].'</a></td>
         <td><a href="yeardetails.php?yr='.$row_rs_SpeakersPrograms['HijriYear'].'">'.$row_rs_SpeakersPrograms['HijriYear'].' ('.$row_rs_SpeakersPrograms['Year'].')</a></td>
		 <td><a href="placedetails.php?plid='.$row_rs_SpeakersPrograms['PlaceId'].'">'.$row_rs_SpeakersPrograms['Plc'].'</a></td>
         <td>'.$row_rs_SpeakersPrograms['Prgtyp'].'</td>
       </tr>';
       } while ($row_rs_SpeakersPrograms = mysqli_fetch_assoc($rs_SpeakersPrograms));
     echo '</table></td>
   </tr>';}?>
</table>
</body>
<?php include("footer.php"); ?>
</html>
<?php
if($speaker){mysqli_free_result($rs_SpeakersPrograms);}
mysqli_free_result($rs_User);
mysqli_free_result($rs_User_H);
mysqli_free_result($rs_User_MT);
mysqli_free_result($rs_User_U);
?>