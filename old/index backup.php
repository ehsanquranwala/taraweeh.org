<?php require_once('Connections/connDoraTarjumaQuran.php');?>
<?php
if (!isset($_SESSION)) {session_start();}
if (!isset($_SESSION['UserId'])) {$_SESSION['UserId'] = 0;}
if (!isset($_SESSION['Email'])) {$_SESSION['Email'] = "";}
if (!isset($_SESSION['FullName'])) {$_SESSION['FullName'] = "";}
if (!isset($_SESSION['Mobile'])) {$_SESSION['Mobile'] = "";}
if(isset($_GET['cmd'])and($_GET['cmd']=='logout'))
{
	$_SESSION['UserId'] = 0;
	$_SESSION['Email'] = "";
	$_SESSION['UserName'] = "";
	$_SESSION['FullName'] = "";
	$_SESSION['Mobile'] = "";
	$_SESSION['Admin'] = 0;
}
if(!isset($_SESSION['hitadded']))$_SESSION['hitadded']=0;
$bid=15;
if(isset($_GET['bid'])) $bid=$_GET['bid'];
if(!$_SESSION['hitadded'])
{
	mysqli_select_db($connDoraTarjumaQuran, $database_connDoraTarjumaQuran);
	$query_rs_Views = "update bannerhits set HitsCount=HitsCount+1 where BannerId=".$bid;
	$rs_Views = mysqli_query($connDoraTarjumaQuran, $query_rs_Views) or die(mysqli_error());
	$_SESSION['hitadded']=1;
}
mysqli_select_db($connDoraTarjumaQuran, $database_connDoraTarjumaQuran);
$query_rs_Views = "SELECT pf.ProgramFeedbackId, pf.ViewHeading, CONCAT_WS(' ', u.Prefix, u.FirstName, u.LastName, '-', u.CityTown) FullName FROM programfeedback pf, user u WHERE pf.UserId = u.UserId ORDER BY rand() limit 30";
$rs_Views = mysqli_query($connDoraTarjumaQuran, $query_rs_Views) or die(mysqli_error());
$row_rs_Views = mysqli_fetch_assoc($rs_Views);
$totalRows_rs_Views = mysqli_num_rows($rs_Views);

mysqli_select_db($connDoraTarjumaQuran, $database_connDoraTarjumaQuran);
$query_rs_Ramadhan = "SELECT TO_DAYS('2007-9-13')-TO_DAYS(NOW()) as daysleftinRamadhan";
$rs_Ramadhan = mysqli_query($connDoraTarjumaQuran, $query_rs_Ramadhan) or die(mysqli_error());
$row_rs_Ramadhan = mysqli_fetch_assoc($rs_Ramadhan);
$totalRows_rs_Ramadhan = mysqli_num_rows($rs_Ramadhan);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" /><meta name="keywords" content="quran qur'an koran tafseer tafsir exegesis explanation dars arabic downloads books articles quiz questions answers taraveeh taravih prayer ramzan ramadhan roza fasting islam jihad dr israr pakistan khilafat caliphate muslims tanzeem e islami nifaz e shariat islami nizam">
<meta name="description" content="quran qur'an koran tafseer tafsir exegesis explanation dars arabic downloads books articles quiz questions answers taraveeh taravih prayer ramzan ramadhan roza fasting islam jihad dr israr pakistan khilafat caliphate muslims tanzeem e islami nifaz e shariat islami nizam">
<meta name="description" content="Namaz e Taravih with translation of Quran in Ramadhan Prayer Taraveeh Qur'an Tafsir Tafseer"/>
<title>Attend Namaz e Taravih with complete translation and brief explanations of Quranic Ayahs</title>
<style type="text/css">
<!--
.style28 {
	font-size: large;
	font-weight: bold;
}
.style30 {color: #FF0000; font-weight: bold; font-size: 22px;}
.style31 {
	font-size: 16px;
	font-weight: bold;
}
.style33 {
	color: #FF0000;
	font-weight: bold;
	text-decoration: blink;
}
.style34 {
	color: #000000;
	font-weight: bold;
	font-family: Georgia, "Times New Roman", Times, serif;
	font-size: small;
}
.style35 {
	font-family: Georgia, "Times New Roman", Times, serif;
	font-size: small;
}
.style36 {font-family: Georgia, "Times New Roman", Times, serif}
.style38 {font-size: small}
.style40 {font-family: Georgia, "Times New Roman", Times, serif; font-size: smaller; }
.style41 {font-size: larger; font-weight: bold; }
-->
</style>
<SCRIPT>
<!--
function doBlink() {
	var blink = document.all.tags("BLINK")
	for (var i=0; i<blink.length; i++)
		blink[i].style.visibility = blink[i].style.visibility == "" ? "hidden" : "" 
}

function startBlink() {
	if (document.all)
		setInterval("doBlink()",500)
}
window.onload = startBlink;
// -->
</SCRIPT>
<?php include("header1.php"); ?>
</head>
<body bgcolor="#669933">
<table align="center" width="800" border="1" cellspacing="0" cellpadding="2" bgcolor="#CCEEAA">
  <tr>
    <th width="644" valign="top" scope="col"><div align="center"><span class="style30">A spiritual journey with Quran in the precious nights of Ramadhan</span><br  />
    <span class="style31"><strong>Listen complete translation and brief explanations of Quranic Ayahs  with Namaz e Taravih<br  />
	(or during DayTime) at any place near you from around 200 different venues.</strong></span><br  />
    <span class="style33"><blink><?php $str='start';$dcount=$row_rs_Ramadhan['daysleftinRamadhan'];if( $dcount<0){$dcount=$dcount+29;$str='complete';} if($dcount>0)echo 'Just '.$dcount.' day(s) left in Dora Tarjuma Quran to '.$str.' this year';?></blink></span>&nbsp;<a href="currentplaces.php" class="style41">Find a place near me now.</a></div></th>
    <td width="150" align="center" valign="middle" scope="col">
	<?php if($_SESSION['UserId']==0) {echo "<strong>Assalam u Alaikum</strong><br />Please <a href=\"signin.php\">Sign In</a> or<br /><a href=\"signup.php\">Create an account.</a>";} else {echo "Assalam u Alaikum<br />"; echo $_SESSION['FullName']."<br /><a href=\"profile.php\">My Profile</a> <a href=\"index.php?cmd=logout\">Log Out</a>";if((isset($_SESSION['Admin']))and($_SESSION['Admin']==1))echo '<br /><a href="adminpage.php">Admin Page</a>';}?>    </td>
  </tr>
</table>
<table align="center" width="800" border="1"  cellpadding="4" bgcolor="#CCEEAA" cellspacing="0">
<tr>
  <td>
  <span class="style35">You can also listen Dora Tarjuma Quran online at Paltalk and Inspeak live from Quran Academy Defence Karachi. <a href="onlineprogram.php">Details Here</a></span></td>
</tr>
<tr>
  <td><span class="style35">At some places mostly in Lahore Dora Tarjuma Quran can be listened on Cable Television. Details Coming Soon</span></td>
</tr>
</table>
<table align="center" width="800" height="210" border="1"  cellpadding="2" bgcolor="#CCEEAA"  cellspacing="0">
  <tr>
    <td width="30%" height="209" align="justify" valign="top" scope="col">
      <span class="style28">Introduction<br  />
    </span><span class="style40">Started by one person in 1984, Dora Tarjuma Quran has now become a living legacy with hundreds of <a href="speakers.php">speakers</a>, who know Arabic breaking the barriers of Language and revealing the Words of Allah to thousands of listeners every year during Ramadhan. Read <a href="history.php">More</a> how the 24  yrs old theory has now become an established fact changing the lives of thousands of people.</span></td>
    <td width="25%" align="center" scope="col" background="images/doratarjumaquran.jpg" valign="center" >
      <span class="style34">Ramadhan is the (month) in
      which Quran was sent down,
    as a guide to mankind and 
    clear (Signs) for guidance and
    judgment (Between right and 
    wrong)...[2:185]<br  />&nbsp;<br  />&nbsp;<br  />&nbsp;<br  />&nbsp;</span></td>
   <td width="45%" valign="top" scope="col"><span class="style28">Views</span> (<a href="programfeedback.php">Share your views</a>)<br  />
	<marquee align="texttop" onmouseover="this.stop()" onmouseout="this.start()" direction="up" scrolldelay="200" loop="-1" >
	<span class="style35">
            <?php do {  ?>
            <p><a href="views.php?pfid=<?php echo $row_rs_Views['ProgramFeedbackId']; ?>"> <?php echo $row_rs_Views['ViewHeading']; echo '('; echo $row_rs_Views['FullName'];echo ')';?></a></p>
              <?php } while ($row_rs_Views = mysqli_fetch_assoc($rs_Views)); ?>
    </span></marquee></td>
  </tr>
</table>
<table align="center" width="800" border="1"  cellpadding="6" cellspacing="0" bgcolor="#CCEEAA">
  <tr>
    <th bgcolor="#99CC66"><span class="style28">Some Questions </span></th>
  </tr>
  <tr>
    <td align="justify" bgcolor="#CCEEAA"><span class="style35">Alhamdulillah we are Muslims but our overall attitude towards Quran is not good.<br  />Ask these questions from yourself. <br />
      Do you know that Quran is the speech of Allah?<br />
      If yes, Have you ever tried to understand what Allah says in it?<br />
      Or atleast do you know the meanings of what you recite in your prayers daily?<br />
      Do you believe that Quran is a book of guidance?<br />
      If yes, do you try to seek guidance from it?<br />
    How far have you gone in worldly eduction and how much of the Quran have you read with meanings?<br />
These are the questions that majority of us cannot answer but what should we do? Remain as we are!!!</span></td>
  </tr>
  <tr>
    <th bgcolor="#99CC66"><span class="style28">Invitation</span></th>
  </tr>
  <tr>
    <td align="justify" bgcolor="#CCEEAA"> <span class="style35">In Ramadhan there is a great opportunity to attend Namaz e Taravih with complete translation of Quranic Ayahs and their brief explanation at more than 200 different locations. We invite you to avail this unique opportunity at any <a href="currentplaces.php">place</a> near you. Come and discover your Identity from Quran, Purpose of Life, Lessons from History, Guidance for Present, Warnings and Tidings for Future, Keys of Eternal Success,  Right and Wrong Paths, Halal and Haram, Virtues and Vices, Rights and Duties in Our Individual and Collective Lives  dierectly from Our Creator's Manual &quot;Quran&quot;.</span></td>
  </tr>
  <tr>
    <th bgcolor="#99CC66"><span class="style28">Attractions</span></th></th>
  </tr>
<tr>
  <td align="justify" bgcolor="#CCEEAA"> 
  <span class="style35">We muslims are given Ramadhan ul Mubarak as a training period for the 11 months to come.<br  />
      Allah has given us two programs in it.<br  />
      1. Fasting, which helps us in controlling our animal instincts and<br  />
      2. Taravih (in which the divine words are recited to us) to empower our soul, our spiritual being.<br  />
      Dora Tarjuma Quran is the best form of the second program in which we also get to know what is being recited in Taravih.<br  /><br  />
	  Word by word translation of each quranic ayah is presented and explanation is given for<br />
    1. Important Quranic terms.<br />
    2. Basic Islamic beliefs.<br />
    3. Reason for revelation (Shan e Nuzool) of the ayahs.<br />
    4. Background events from prophet's(pbuh) life.<br />
    5. Legends of earlier Prophet's and their nations.<br />
    6. Scientific facts.<br />
    7. Quranic Miracles
    and much more...</span></td>
</tr>
  <tr><th bgcolor="#99CC66"><span class="style28">Program Format</span></th></tr><tr>
    <td bgcolor="#CCEEAA">
      <span class="style35">After Namaz e Isha the speaker(mutarjim) presents the translation and explanation of the portion from Quran which will be recited in the following 4 Rakat Taravih and then Taravih is offered.<br  />After 4 Rakat Taravih every one keeps sitting for translation and explanation again.<br  />
After three sessions of Translation and Taravih i.e total 12 Rakats a break is done for refreshments.<br  />
      After break 20 Rakat Taravih is completed with 2 more sessions, then Salat ul Witr is offered and the program concludes.<br  />
      Approximately one Para is recited every night and Khatm-ul-Quran is done usually on 29th of Ramadhan.      </span>
    <tr><th bgcolor="#99CC66"><span class="style28">Effectiveness</span></th></tr><tr>
    <td bgcolor="#CCEEAA">
      <span class="style36 style38">This is a very effective way because after listening the translation with the Arabic text (which is also displayed on the projector) when you listen to Qirat in Taravih (which is very clearly), the divine music enters your ears and the translation and the events behind the Ayahs run in your mind. And thus apart from knowledge and understanding you also feel (part of) that immense pleasure and spirituality that was there in the prayers of Prophet Muhammad (pbuh) and his companions because they understood what they said in prayers (Arabic being their mother tongue).</span>
  <tr><th bgcolor="#99CC66"><span class="style28">Variations</span></th></tr><tr>
	    <td bgcolor="#CCEEAA"><span class="style35">There are some variations in program format depending on the specific requirements and limitations at different places.<br  />
        At some places  two (4 Rakat sessions) are be combined into one to reduce time.<br />
        At some places only a summary of the ayahs recited in taravih is presented after complete Namaz e Taravih.<br  />
        At some places where speakers are not available Video Recording of Dora Tarjuma Quran is used.<br  />
        At some places programs are organized in day time, most of them are specially for ladies only.</span>
	    <tr><th bgcolor="#99CC66"><span class="style28">Time Factor</span></th></tr><tr>
	      <td bgcolor="#CCEEAA">
	  <span class="style35">Although the schedule is a bit tough but in this way one goes through the complete Holy Quran with translation and explanation in just one month which matters in the end. If we start reading the translation or tafseer it takes years, and most of the time it discontinues due to various reasons. But in the nights of Ramadhan, its a totally different atmosphere. Quran just possesses you, you get greater rewards in this month, you also create a similarity with the Prophet's companions who used to return from Taravih near Sehri. We should also think that how much time we spent on worldly education. Thow still not convinced! Do come over for as much time as you can spare because "something" is always better than "nothing" and decide after reading this.</span><br  />
	  <br  />
      <span class="style35"><em>Surely your Lord knows that you pass in prayer  nearly two-thirds of the night, and (sometimes) half of it, and (sometimes) a third  of it, and (also) a party of those with you; and Allah measures the night and  the day. He knows that you are not able to do it, so He has turned to you  (mercifully), therefore read of the Qur'an as much as may be easy for you. He knows that there  must be among you sick, and others who travel in the land seeking of the bounty  of Allah, and others who fight in Allah's way, therefore read as much of it as  is easy (to you), and establish regular Prayer and give regular Charity and  loan to Allah, a Beautiful Loan and whatever of good you send on before hand for yourselves, you  will find it with Allah; that is best and greatest in reward; and ask  forgiveness of Allah; surely Allah is Forgiving, Merciful.[73:20]</em></span><br  />
      <br  />
      <span class="style35">But don't forget the principle.</span><br  /><div align="center" class="style35">[Maktab e Ishq Ka Dastoor Nirala Dekha<br  />Us Ko Chutti Na Mili Jis Ne Sabaq Yad Kiya]</div></td>
	    </tr></table>
</body>
<?php include("footer.php"); ?>
</html>
<?php
mysqli_free_result($rs_Views);
mysqli_free_result($rs_Ramadhan);
?>