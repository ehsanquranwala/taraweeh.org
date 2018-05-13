<?php
$to = 'ehsantemp@yahoo.com,ehsantemp@hotmail.com,ehsantemp@gmail.com';
$subject = 'Dora Tarjuma Quran Invitation';
//$headers = 'From: '.$_POST['FromEmail']\r\n";
//$headers = 'From: support@connect.net.pk\r\n';
//$headers = 'From: nazim@doratarjumaquran.pk\r\n';
$headers = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";// To send HTML mail, the Content-type header must be set
$message = '
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<style type="text/css">
<!--
.style14 {
	font-size: 20px;
	font-family: "Courier New", Courier, monospace;
	font-weight: bold;
}
.style22 {
	color: #FF0000;
	font-size: 16px;
	font-weight: bold;
}
.style23 {
	font-family: "Times New Roman", Times, serif;
	font-size: 52px;
	color: #006600;
	font-weight: bold;
	letter-spacing: 0px;
}
.style28 {
	font-size: large;
	font-weight: bold;
}
.style30 {color: #FF0000; font-weight: bold; font-size: 20px;}
.style31 {
	font-size: 15px;
	font-weight: bold;
}
-->
</style>
</head>
<body bgcolor="#669933">
<table align="center" width="800" border="1" cellpadding="0"  cellspacing="0" bgcolor="#99CC66" >
  <tr>
    <th width="800" align="center" valign="middle" scope="col"><span class="style23">Dora Tarjuma Quran</span><br  />
    <span class="style14"> An experience you can\'t afford to miss</span><br  />
	<h1><a href="http://www.doratarjumaquran.pk/index.php?bid=14">www.DoraTarjumaQuran.pk</a></h1></th>
  </tr>
</table>
<table align="center" width="800" height="222" border="1" cellpadding="2" bgcolor="#CCEEAA"  cellspacing="0">
  <tr>
    <td width="25%" align="center" scope="col" background="http://www.doratarjumaquran.pk/images/doratarjumaquran.jpg" valign="top" ><br  />
      Ramadhan is the (month) in<br  />
      which Quran was sent down,<br  />
    as a guide to mankind and <br  />
    clear (Signs) for guidance and
    judgment (Between right and 
    wrong)...[2:185]</td>
 <td width="75%" valign="top" scope="col">
 <center><span class="style30">A spiritual journey with Quran in the precious nights of Ramadhan</span><br  />
  <span class="style31">Attend Namaz e Taravih with complete translation and brief explanations of Quranic Ayahs</span><br  />
  <span class="style33"><a href="http://www.doratarjumaquran.pk/currentplaces.php"><strong>Find a place near me now.</strong></a></center>We muslims are given Ramadhan ul Mubarak as a training period for the 11 months to come.<br  />
      Allah has given us two programs in it.<br  />1 Fasting, which helps us in controlling our animal instincts and<br  />
      2 Taravih (in which the divine words are recited to us) to empower our soul, our spiritual being.<br  />
      * Dora Tarjuma Quran is the best form of the 2nd program in which we also get to know what is being recited in Taravih.<br  />
</p> </td></tr>
</table>
<table align="center" width="800" border="1" cellpadding="2" cellspacing="0" bgcolor="#CCEEAA">
  <tr>
    <th bgcolor="#99CC66"><span class="style28">Some Questions </span></th>
  </tr>
  <tr>
    <td align="justify" bgcolor="#CCEEAA"><p>Alhamdulillah we are Muslims but our overall attitude towards Quran is not good. Ask these questions from yourself. <br />
      Do you know that Quran is the speech of Allah?<br />
      If yes, Have you ever tried to understand what Allah says in it?<br />
      Or atleast do you know the meanings of what you recite in your prayers daily?<br />
      Do you believe that Quran is a book of guidance?<br />
      If yes, do you try to seek guidance from it?<br />
    How far have you gone in worldly eduction and how much of the Quran have you read with meanings?<br />
These are the questions which majority of us cannot answer but what should we do? Remain as we are!!!</td>
  </tr>
  <tr>
    <th bgcolor="#99CC66"><span class="style28">Invitation</span></th>
  </tr>
  <tr>
    <td align="justify" bgcolor="#CCEEAA"> In Ramadhan there is a great opportunity to attend Namaz e Taravih with complete translation of Quranic Ayahs and their brief explanation at more than 200 different locations. We invite you to avail this unique opportunity at any place</a> near you. Come and discover your Identity from Quran, Purpose of Life, Lessons from History, Guidance for Present, Warnings and Tidings for Future, dierectly from Our Creator\'s Manual &quot;Quran&quot;.<br  />
      <br  />
	Word by word translation of each quranic ayah is presented
    and explanation is given for<br />
    1 Important Quranic terms.<br />
    2 Basic Islamic beliefs.<br />
    3 Reason for revelation (Shan e Nuzool) of the ayahs.<br />
    4 Background events from Prophet Muhammad\'s(pbuh) life.<br />
    5 Legends of earlier Prophet\'s and their nations.<br />
    6 Scientific facts.<br />
    7 Quranic Miracles
    and much more...</td></tr>
	<tr><td bgcolor="#CCEEAA">
<em><span class="style22">O thou folded in garments! [73:1]Rise to pray in the night except a little[73:2]: Half of it, or lessen it a little[73:3]<br  />Or a little more; and recite the Quran in slow, measured rhythmic tones. [73:4]<br  /><br  />
Do they not Ponder over Quran or their hearts are locked?[47:24]</span></em></td>
	</tr></table>
</body>
</html>';
//ini_set(smtp,'smtp.doratarjumaquran.pk');
//ini_set(smtp_port,25);
if(mail($to,$subject,$message,$headers)) echo '1'; else echo '0';
?>