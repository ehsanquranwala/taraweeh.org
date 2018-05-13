<?php require_once('Connections/connDoraTarjumaQuran.php'); ?>
<?php
if (!isset($_SESSION))	session_start();

mysqli_select_db($connDoraTarjumaQuran, $database_connDoraTarjumaQuran);
$query_rs_Topics = "SELECT quiz.QuizId, quiz.Topic FROM quiz";
$rs_Topics = mysqli_query($connDoraTarjumaQuran, $query_rs_Topics) or die(mysqli_error());
$row_rs_Topics = mysqli_fetch_assoc($rs_Topics);
$totalRows_rs_Topics = mysqli_num_rows($rs_Topics);

mysqli_select_db($connDoraTarjumaQuran, $database_connDoraTarjumaQuran);
$query_rs_Ramadhan = "SELECT TO_DAYS(NOW())-TO_DAYS('2007-9-13') as daysleftinRamadhan";
$rs_Ramadhan = mysqli_query($connDoraTarjumaQuran, $query_rs_Ramadhan) or die(mysqli_error());
$row_rs_Ramadhan = mysqli_fetch_assoc($rs_Ramadhan);
$day=$row_rs_Ramadhan['daysleftinRamadhan'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" /><meta name="keywords" content="quran qur'an koran tafseer tafsir exegesis explanation dars arabic downloads books articles quiz questions answers taraveeh taravih prayer ramzan ramadhan roza fasting islam jihad dr israr pakistan khilafat caliphate muslims tanzeem e islami nifaz e shariat islami nizam">
<meta name="description" content="quran qur'an koran tafseer tafsir exegesis explanation dars arabic downloads books articles quiz questions answers taraveeh taravih prayer ramzan ramadhan roza fasting islam jihad dr israr pakistan khilafat caliphate muslims tanzeem e islami nifaz e shariat islami nizam">
<title>Quiz Index, for the daily online quiz from Dora Tarjuma Quran</title>
<style type="text/css">
<!--
.style1 {
	font-size: x-large;
	font-weight: bold;
}
.style2 {
	color: #FF0000;
	font-weight: bold;
}
.style3 {font-size: x-large}
.style5 {
	font-size: x-large;
	color: #FF0000;
	font-weight: bold;
}
-->
</style>
<?php include("header.php"); ?>
</head>
<body bgcolor="#669933">
<table width="800" align="center" border="1" cellpadding="0" bgcolor="#CCEEAA"  cellspacing="0">
<tr><td align="center"><h1 align="center">Daily Online Quiz of Dora Tarjuma Quran</h1>
<span class="style2">Make your participation more benefiting by taking daily online quiz here.</span><br  />The quizzes are designed to cover approximately the part of Quran covered in one night's Taravih.<br  />And they are synchronized exactly with the Dora Tarjuma Quran of Ameer Maqami Tanzeem Old City Karachi<br  />Abu Abdullah Shujauddin Sheikh, which he did in 2004 at Faran Club Karachi.<br  />The links to the audio files of this program are given for reference<br />
<br />
<span class="style5"><?php if(!isset($_SESSION['UserId'])or(isset($_SESSION['UserId'])and $_SESSION['UserId']==0)) echo 'You need to be <a href="signin.php?u=qi">signed in</a> for taking a quiz';
else echo 'Your <a href="resultall.php">Overall Result</a> So Far';?></span></td></tr></table>
<table width="800" align="center" border="1" cellpadding="0" bgcolor="#CCEEAA"  cellspacing="0">
<tr bgcolor="99CC66"><th scope="col">Day</th><th scope="col">Part of Quran</th><th scope="col">Quiz Links</th></tr>
<?php $i=1;
do 
{  
echo "<tr><td>Ramadhan ".$i."</td><td><strong>".$row_rs_Topics['Topic']."</strong></td><td align=\"center\">";
if($i>$day)echo "Coming Soon";else echo "<a href=\"quiz.php?qid=".$row_rs_Topics['QuizId']."\">Take this Quiz</a>";
echo "</td></tr>";$i++;
}
while ($row_rs_Topics = mysqli_fetch_assoc($rs_Topics));
$rows = mysqli_num_rows($rs_Topics);
if($rows > 0) {
      mysqli_data_seek($rs_Topics, 0);
	  $row_rs_Topics = mysqli_fetch_assoc($rs_Topics);
}?>
</table>
<table width="800" border="1" cellpadding="0" bgcolor="#CCEEAA" cellspacing="0" align="center">
  <tr bgcolor="99CC66"><th><span class="style3">Proposed Offline Quiz</span></th>
</tr><tr><td align="left"><ul>
  <li>People in the management of Dora Tarjuma Quran programs are encouraged to conduct these quizzes as (take away quiz) at their respective places like our rafeeq Hafiz Nasir (who prepared these quizzes and conducted a course at Gulistan-e-Johar, Karachi in 2006) in which more than 150 people participated.</li>
  <li>    Most of the people can't participate in the online quiz because they don't have access to internet, so this will be a great oppportunity for them and will make their participation more useful and benefiting Inshallah.<br />
    </li>
  <li>You can call me 92-334-3380785 or send me an email at nazim@doratarjumaquran.pk to get the printable files (properly formatted as question papers) of all  29 quizzes in both Urdu and English and their answers for checking. You may then print them and  get them photocopied as per your requirements.<br  />
  </li>
  <li>Following files will be available<br  />
  29 Quizzes in Urdu (1 Inpage File)<br  />
29 Quizzes in Urdu (29 GIF Files)<br  />
29 Quizzes in English (1 MS Word File)<br  />
  </li>
  </ul></td>
</tr></table>
</body>
<?php include("footer.php"); ?>
</html><?php
mysqli_free_result($rs_Topics);
?>


