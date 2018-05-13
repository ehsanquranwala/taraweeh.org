<script language="javascript" type="text/javascript" >
	function handleHttpResponse() {
		if (http.readyState == 4) {
			if (div_id != '') {
				document.getElementById(div_id).innerHTML = http.responseText;
			}
		}
	}
	function createRequestObject() {
		var req;
		if(window.XMLHttpRequest){
			// Firefox, Safari, Opera...
			req = new XMLHttpRequest();
		} else if(window.ActiveXObject) {
			// Internet Explorer 5+
			req = new ActiveXObject("Microsoft.XMLHTTP");
		} else {
			// There is an error creating the object,
			// just as an old browser is being used.
			alert('There was a problem creating the XMLHttpRequest object');
		}
		return req;
	}
// Make the XMLHttpRequest object
	var http = createRequestObject();//create request
	function getimage(img)
	{
	div_id = 'output';
	reqstr="script_library.php?i="+escape(img);
	http.open("GET", reqstr, true);
	http.onreadystatechange = handleHttpResponse;
	http.send(null);//send the request
	}
</script>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd" >
<html xmlns="http://www.w3.org/1999/xhtml" >
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta name="keywords" content="quran qur'an koran tafseer tafsir exegesis explanation dars arabic downloads books articles quiz questions answers taraveeh taravih prayer ramzan ramadhan roza fasting islam jihad dr israr pakistan khilafat caliphate muslims tanzeem e islami nifaz e shariat islami nizam">
<meta name="description" content="quran qur'an koran tafseer tafsir exegesis explanation dars arabic downloads books articles quiz questions answers taraveeh taravih prayer ramzan ramadhan roza fasting islam jihad dr israr pakistan khilafat caliphate muslims tanzeem e islami nifaz e shariat islami nizam">
<title>Dora Tarjuma Quran Library having various Articles, Views and Quotes etc related to Quran and Ramadhan</title>
<style type="text/css">
<!--
.style24 {
	color: #FF0000;
	font-weight: bold;
}
.style27 {
	font-size: x-large;
	color: #003300;
}
-->
</style>
<?php include("header.php"); ?>
</head>
<body bgcolor="#669933" >
<table align="center" border="1" cellpadding="0" bgcolor="#CCEEAA" cellspacing="0" width="800" ><tr><th align="left" >
<a name="shelf" id="shelf"></a>
<h1 align="center" >Dora Tarjuma Quran Library</h1>
We have kept here various articles, views and quotes etc related to Quran and Ramadhan. Thanks to the efforts of the writers and the publications department of Tanzeem e Islami for such beautiful contributions.<br  /><center><span class="style24">Choose and entry from the shelf below and wait for it in the <a href="#rp">Reading Room</a> at the end.</span>
</center>
<table align="center" width="800" border="1" cellpadding="0" cellspacing="0">
<tr valign="top"><td><strong><u>Quran</u></strong><br  />
Quran, The Origin of Faith <a onClick="getimage('quran iiman ka sarchashma.GIf')" href="#rp" style="background:#336600; border:double; text-decoration:none; color:#000000">1</a><br />
Quran the Greatest Remembrance<a onClick="getimage('quran the greatest zikr.GIf')" href="#rp" style="background:#336600; border:double; text-decoration:none; color:#000000">1</a><br />
Quran, A Living Miracle <a onClick="getimage('quran-a living miracle 1.GIf')" href="#rp" style="background:#336600; border:double; text-decoration:none; color:#000000">1</a> 
<a onClick="getimage('quran-a living miracle 2.GIf')" href="#rp" style="background:#336600; border:double; text-decoration:none; color:#000000">2</a> 
<a onClick="getimage('quran-a living miracle 3.GIf')" href="#rp" style="background:#336600; border:double; text-decoration:none; color:#000000">3</a><br  />
First and Last Book<a onClick="getimage('first and last book.GIf')" href="#rp" style="background:#336600; border:double; text-decoration:none; color:#000000">3</a><br />Quran and Knowledge<a onClick="getimage('quran and knowledge.GIf')" href="#rp" style="background:#336600; border:double; text-decoration:none; color:#000000">3</a><br />
Quran and Philosophy of Tests <a onClick="getimage('quran and philosophy of tests 1.GIf')" href="#rp" style="background:#336600; border:double; text-decoration:none; color:#000000">1</a> 
<a onClick="getimage('quran and philosophy of tests 2.GIf')" href="#rp" style="background:#336600; border:double; text-decoration:none; color:#000000">2</a> 
<a onClick="getimage('quran and philosophy of tests 3.GIf')" href="#rp" style="background:#336600; border:double; text-decoration:none; color:#000000">3</a> <a onClick="getimage('quran and philosophy of tests 4.GIf')" href="#rp" style="background:#336600; border:double; text-decoration:none; color:#000000">4</a><br  />In how many days one should complete recitation of Quran?<a onClick="getimage('in how many days.GIf')" href="#rp" style="background:#336600; border:double; text-decoration:none; color:#000000">1</a>
<br  />Attachment with Quran?<a onClick="getimage('attachment with quran.GIf')" href="#rp" style="background:#336600; border:double; text-decoration:none; color:#000000">1</a>
</td><td><strong><u>Dora Tarjuma Quran</u> </strong><br  />
Importance of Dora Tarjuma Quran<a onClick="getimage('dora tarjuma quran ki ehmiat 1.gif')" href="#rp" style="background:#336600; border:double; text-decoration:none; color:#000000">1</a> 
<a onClick="getimage('dora tarjuma quran ki ehmiat 2.gif')" href="#rp" style="background:#336600; border:double; text-decoration:none; color:#000000">2</a> 
<a onClick="getimage('dora tarjuma quran ki ehmiat 3.gif')" href="#rp" style="background:#336600; border:double; text-decoration:none; color:#000000">3</a><br />
Group reading of Quran <a onClick="getimage('group reading of quran 1.GIf')" href="#rp" style="background:#336600; border:double; text-decoration:none; color:#000000">1</a> 
<a onClick="getimage('group reading of quran 2.GIf')" href="#rp" style="background:#336600; border:double; text-decoration:none; color:#000000">2</a> 
<a onClick="getimage('group reading of quran 3.GIf')" href="#rp" style="background:#336600; border:double; text-decoration:none; color:#000000">3</a> 
<a onClick="getimage('group reading of quran 4.GIf')" href="#rp" style="background:#336600; border:double; text-decoration:none; color:#000000">4</a><br />
Views on Dora Tarjuma Quran 2004 <a onClick="getimage('views 2004 1.gif')" href="#rp" style="background:#336600; border:double; text-decoration:none; color:#000000">1</a> 
<a onClick="getimage('views 2004 2.gif')" href="#rp" style="background:#336600; border:double; text-decoration:none; color:#000000">2</a><br />
Views on Dora Tarjuma Quran 2005 <a onClick="getimage('views 2005 1.gif')" href="#rp" style="background:#336600; border:double; text-decoration:none; color:#000000">1</a> 
<a onClick="getimage('views 2005 2.gif')" href="#rp" style="background:#336600; border:double; text-decoration:none; color:#000000">2</a><br />
Program for Feedback 2005 <a onClick="getimage('program for feedback 2005 1.gif')" href="#rp" style="background:#336600; border:double; text-decoration:none; color:#000000">1</a> 
<a onClick="getimage('program for feedback 2005 2.gif')" href="#rp" style="background:#336600; border:double; text-decoration:none; color:#000000">2</a><br  />
Interview of Molana Qari Khalid Ameen <a onClick="getimage('interview of molana qari khalid ameen 1.gif')" href="#rp" style="background:#336600; border:double; text-decoration:none; color:#000000">1</a> 
<a onClick="getimage('interview of molana qari khalid ameen 2.gif')" href="#rp" style="background:#336600; border:double; text-decoration:none; color:#000000">2</a> 
<a onClick="getimage('interview of molana qari khalid ameen 3.gif')" href="#rp" style="background:#336600; border:double; text-decoration:none; color:#000000">3</a></td></tr>
<tr><td valign="top"><strong><u>Quran and Muslims</u></strong><br  />
Ignorance of Muslims towards Quran <a onClick="getimage('musalmanon ki quran majeed se doori.GIf')" href="#rp" style="background:#336600; border:double; text-decoration:none; color:#000000">1</a><br />
Reasons of the Ignorance towards Quran<a onClick="getimage('quran se doori ke asbab.gif')" href="#rp" style="background:#336600; border:double; text-decoration:none; color:#000000">1</a><br />
Reading Quran with Understanding <a onClick="getimage('reading quran with understanding 1.gif')" href="#rp" style="background:#336600; border:double; text-decoration:none; color:#000000">1</a> <a onClick="getimage('reading quran with understanding 2.gif')" href="#rp" style="background:#336600; border:double; text-decoration:none; color:#000000">2</a><br  />
Quran and Muslims Unity<a onClick="getimage('quran and muslims unity.GIf')" href="#rp" style="background:#336600; border:double; text-decoration:none; color:#000000">1</a><br />
Two Levels of Understanding Quran<a onClick="getimage('two levels of understanding quran 1.gif')" href="#rp" style="background:#336600; border:double; text-decoration:none; color:#000000">1</a>
<a onClick="getimage('two levels of understanding quran 1.gif')" href="#rp" style="background:#336600; border:double; text-decoration:none; color:#000000">2</a><br />
Ramadhan Quran and Pakistan<a onClick="getimage('Ramadhan quran and pakistan.gif')" href="#rp" style="background:#336600; border:double; text-decoration:none; color:#000000">1</a><br  />
</td><td><strong><u>Quran and Non Muslims</u></strong><br  />
Quran and Western thinkers<a onClick="getimage('quran and western thinkers.GIf')" href="#rp" style="background:#336600; border:double; text-decoration:none; color:#000000">1</a><br />
Quran in the eyes of famous Non Muslims<a onClick="getimage('quran in the eyes of famous non muslims.gif')" href="#rp" style="background:#336600; border:double; text-decoration:none; color:#000000">1</a><br />
Quran in the eyes of Hindu and Sikh thinkers<a onClick="getimage('quran in the eyes of hindu and sikh thinkers.GIf')" href="#rp" style="background:#336600; border:double; text-decoration:none; color:#000000">1</a><br />
Quran in the eyes of Christian Fathers<a onClick="getimage('quran in the eyes of christian fathers.GIf')" href="#rp" style="background:#336600; border:double; text-decoration:none; color:#000000">1</a><br />
All my questions, answered by Quran <a onClick="getimage('all questions answered from quran 1.gif')" href="#rp" style="background:#336600; border:double; text-decoration:none; color:#000000">1</a> 
<a onClick="getimage('all questions answered from quran 2.gif')" href="#rp" style="background:#336600; border:double; text-decoration:none; color:#000000">2</a> 
<a onClick="getimage('all questions answered from quran 3.gif')" href="#rp" style="background:#336600; border:double; text-decoration:none; color:#000000">3</a><br />
<br  />
</td></tr>
<tr><td valign="top"><strong><u>Ramadhan</u></strong><br  />
Shaban an Introduction of Ramadhan<a onClick="getimage('shaban an introduction of Ramadhan 1.GIf')" href="#rp" style="background:#336600; border:double; text-decoration:none; color:#000000">1</a> <a onClick="getimage('shaban an introduction of Ramadhan 2.GIf')" href="#rp" style="background:#336600; border:double; text-decoration:none; color:#000000">2</a><br />
Issue of Moon Sighting<a onClick="getimage('chand ka masla 1.gif')" href="#rp" style="background:#336600; border:double; text-decoration:none; color:#000000">1</a> 
<a onClick="getimage('chand ka masla 2.gif')" href="#rp" style="background:#336600; border:double; text-decoration:none; color:#000000">2</a><br />
Prophet's Hhutba at the start of Ramadhan<a onClick="getimage('prophet's khutba at the start of Ramadhan.GIf')" href="#rp" style="background:#336600; border:double; text-decoration:none; color:#000000">1</a><br />
Welcoming Ramadhan<a onClick="getimage('welcome Ramadhan.gif')" href="#rp" style="background:#336600; border:double; text-decoration:none; color:#000000">1</a><br />
Ramadhan, the month of Virtues <a onClick="getimage('Ramadhan 1.gif')" href="#rp" style="background:#336600; border:double; text-decoration:none; color:#000000">1</a> 
<a onClick="getimage('Ramadhan 2.gif')" href="#rp" style="background:#336600; border:double; text-decoration:none; color:#000000">2</a><br />
Real gain from Ramadhan <a onClick="getimage('real gain from Ramadhan 1.gif')" href="#rp" style="background:#336600; border:double; text-decoration:none; color:#000000">1</a> 
<a onClick="getimage('real gain from Ramadhan 2.gif')" href="#rp" style="background:#336600; border:double; text-decoration:none; color:#000000">2</a><br />
Greatness of Ramadhan (Ramadhan ki Fazeelat) <a onClick="getimage('Ramadhan ki fazeelat.GIf')" href="#rp" style="background:#336600; border:double; text-decoration:none; color:#000000">1</a><br />
Ramadhan and Ladies (Ramadhan aur Khawateen)<a onClick="getimage('Ramadhan aur khawateen 1.GIf')" href="#rp" style="background:#336600; border:double; text-decoration:none; color:#000000">1</a><br  />
Last 10 days of Ramadhan <a onClick="getimage('last 10 days of Ramadhan.GIf')" href="#rp" style="background:#336600; border:double; text-decoration:none; color:#000000">1</a><br  />Aetikaf ke Fazail aur Adaab<a onClick="getimage('aetikaf ke fazail aur adaab 1.GIf')" href="#rp" style="background:#336600; border:double; text-decoration:none; color:#000000">1</a> <a onClick="getimage('aetikaf ke fazail aur adaab 2.GIf')" href="#rp" style="background:#336600; border:double; text-decoration:none; color:#000000">2</a>
</td><td valign="top"><strong><u>Fasting</u></strong><br  />
Few Important Guidelines for Fasting<a onClick="getimage('roze ke chand zaroori masail.GIf')" href="#rp" style="background:#336600; border:double; text-decoration:none; color:#000000">1</a><br />
How to do Sehr and Iftar (Sehr o Iftar kese karein)<a onClick="getimage('sehr o iftar kese karein.gif')" href="#rp" style="background:#336600; border:double; text-decoration:none; color:#000000">1</a><br />
Fasting is a Defence (Roza Dhal hai)<a onClick="getimage('roza dhal hai.GIf')" href="#rp" style="background:#336600; border:double; text-decoration:none; color:#000000">1</a><br />
Spirit of Fasting (Roze ki Rooh)<a onClick="getimage('roze ki rooh.gif')" href="#rp" style="background:#336600; border:double; text-decoration:none; color:#000000">1</a><br />
Real Gain of Fasting (Rozon ka Asal Hasil)<a onClick="getimage('rozon ka asal hasil.gif')" href="#rp" style="background:#336600; border:double; text-decoration:none; color:#000000">1</a><br />
Spiritual Gains of Fasting<a onClick="getimage('roze ke roohani fawaid.GIf')" href="#rp" style="background:#336600; border:double; text-decoration:none; color:#000000">1</a><br />
Gain of Fasting and Ramadhan <a onClick="getimage('roze aur Ramadhan ka hasil 1.GIf')" href="#rp" style="background:#336600; border:double; text-decoration:none; color:#000000">1</a></td></tr>
<tr><td valign="top"><strong><u>Miscellaneous</u></strong><br />
Fasting in the day and Prayers during Night <a onClick="getimage('din ka roza rat ka qiyam.gif')" href="#rp" style="background:#336600; border:double; text-decoration:none; color:#000000">1</a><br />
Aims of Fasting and Prayers <a onClick="getimage('hikmat of roza and taravih.gif')" href="#rp" style="background:#336600; border:double; text-decoration:none; color:#000000">1</a><br  />2 Fasts (2 Rozae)<a onClick="getimage('do roze.gif')" href="#rp" style="background:#336600; border:double; text-decoration:none; color:#000000">1</a><br />
Fasting Ramadhan and Quran <a onClick="getimage('roza Ramadhan aur quran 1.gif')" href="#rp" style="background:#336600; border:double; text-decoration:none; color:#000000">1</a> <a onClick="getimage('roza Ramadhan aur quran 2.gif')" href="#rp" style="background:#336600; border:double; text-decoration:none; color:#000000">2</a> <a onClick="getimage('roza Ramadhan aur quran 3.gif')" href="#rp" style="background:#336600; border:double; text-decoration:none; color:#000000">3</a><br />
</td>
<td valign="top"><strong><u>Ahadees</u></strong><br  />
  Ahadees about Quran, Fasting, Taravih and Ramadhan<br  />
  <br  />
  <a onClick="getimage('hadees 1.gif')" href="#rp" style="background:#336600; border:double; text-decoration:none; color:#000000">1</a> <a onClick="getimage('hadees 2.gif')" href="#rp" style="background:#336600; border:double; text-decoration:none; color:#000000">2</a> <a onClick="getimage('hadees 3.gif')" href="#rp" style="background:#336600; border:double; text-decoration:none; color:#000000">3</a> <a onClick="getimage('hadees 4.gif')" href="#rp" style="background:#336600; border:double; text-decoration:none; color:#000000">4</a> <a onClick="getimage('hadees 5.gif')" href="#rp" style="background:#336600; border:double; text-decoration:none; color:#000000">5</a> <a onClick="getimage('hadees 6.gif')" href="#rp" style="background:#336600; border:double; text-decoration:none; color:#000000">6</a> <a onClick="getimage('hadees 7.GIf')" href="#rp" style="background:#336600; border:double; text-decoration:none; color:#000000">7</a> <a onClick="getimage('hadees 8.GIf')" href="#rp" style="background:#336600; border:double; text-decoration:none; color:#000000">8</a></td>
</tr></table>
<tr><td><table align="center"><tr><th valign="top" height="1500"><a name="rp" id="rp"></a>
          <span class="style27">Reading Room</span> <a href="#shelf">(Back to Shelf)</a><br  />
          Your chosen entry takes some time in loading, Please wait.<br  />
          <img src="images/bismillah.jpg" width="271" height="66" />        
<div id="output" align="center" ><img style="background:#FFFFFF" src="articles/hadees 3.gif"/></div><a href="#shelf">Back to Shelf</a></th></tr></table></td></tr></table>
</body>
<?php include("footer.php"); ?>
</html>