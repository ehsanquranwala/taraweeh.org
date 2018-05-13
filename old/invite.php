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

mysqli_select_db($connDoraTarjumaQuran, $database_connDoraTarjumaQuran);
$query_rs_Country = "SELECT distinct(place.Country) FROM program join place WHERE program.PlaceId=place.PlaceId and program.HijriYear=1428";
$rs_Country = mysqli_query($connDoraTarjumaQuran, $query_rs_Country) or die(mysqli_error());
$row_rs_Country = mysqli_fetch_assoc($rs_Country);
$totalRows_rs_Country = mysqli_num_rows($rs_Country);

mysqli_select_db($connDoraTarjumaQuran, $database_connDoraTarjumaQuran);
$query_rs_Region = "SELECT distinct(place.Region) FROM place join program WHERE place.PlaceId=program.PlaceId and program.HijriYear=1428 and place.Country='Pakistan'";
$rs_Region = mysqli_query($connDoraTarjumaQuran, $query_rs_Region) or die(mysqli_error());
$row_rs_Region = mysqli_fetch_assoc($rs_Region);
$totalRows_rs_Region = mysqli_num_rows($rs_Region);

mysqli_select_db($connDoraTarjumaQuran, $database_connDoraTarjumaQuran);
$query_rs_CityTown = "SELECT distinct(place.CityTown) FROM place join program WHERE place.PlaceId=program.PlaceId and program.HijriYear=1428 and place.Region = 'Sindh'";
$rs_CityTown = mysqli_query($connDoraTarjumaQuran, $query_rs_CityTown) or die(mysqli_error());
$row_rs_CityTown = mysqli_fetch_assoc($rs_CityTown);
$totalRows_rs_CityTown = mysqli_num_rows($rs_CityTown);

mysqli_select_db($connDoraTarjumaQuran, $database_connDoraTarjumaQuran);
$query_rs_Place = "SELECT pr.PlaceId, pl.Address FROM place pl join program pr WHERE pl.CityTown ='Karachi' and pl.PlaceId=pr.PlaceId and pr.HijriYear=1428";
$rs_Place = mysqli_query($connDoraTarjumaQuran, $query_rs_Place) or die(mysqli_error());
$row_rs_Place = mysqli_fetch_assoc($rs_Place);
$totalRows_rs_Place = mysqli_num_rows($rs_Place);

//session_start();
if (!isset($_SESSION))session_start();
if (!isset($_SESSION['UserId'])) {$_SESSION['UserId'] = 0;}
if (!isset($_SESSION['FullName']))$_SESSION['FullName'] = '';
if (!isset($_SESSION['Email']))$_SESSION['Email'] = 'nazim@doratarjumaquran.pk';
if (!isset($_SESSION['Mobile']))$_SESSION['Mobile'] = '';

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
if($_SESSION['UserId']>0){
/////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////Create and send Email///////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////
$to = $_POST['ToEmails'];
$subject = 'Dora Tarjuma Quran Invitation';
//$headers = 'From: '.$_POST['FromEmail']\r\n";
//$headers = 'From: support@connect.net.pk\r\n';
//$headers = 'From: nazim@doratarjumaquran.pk\r\n';
$headers .= 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";// To send HTML mail, the Content-type header must be set
$message = '
<html>
<head><title>Dora Tarjuma Quran Invitation</title></head>
<body bgcolor="#669933">
Assalam  u alaikum<br />
This  message is sent to you on request of your friend '.$_SESSION['FullName'].'<br />
who wants you to attend Namaz-e-Taravih with complete translation<br />
and a brief explanation of Quran this year.<br />
This program is being held at more than 200 different locations.<br />';
if($_POST['PlaceId']>0)
{$message .= $_POST['Suggest1'];}
$message .='<br />
For details please visit your own website <a href="http://www.doratarjumaquran.pk/">www.doratarjumaquran.pk</a><br />
We look forward to your participation in this program.<br /><br />';
if($_POST['OptionalMessage']!="")$message.='Your friend wrote<br />'.$_POST['OptionalMessage'];
$message.='</body></html>';
//ini_set(smtp,'smtp.doratarjumaquran.pk');
//ini_set(smtp_port,25);
if(mail($to,$subject,$message,$headers))$emailstatus=1;else 
$emailstatus=0;
/////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////Create and send SMS/////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////
$to = $_POST['ToMobileNos'];
$arr = str_split($to, 12);
$arr=str_ireplace ( ",", "", $arr );
$ind=0;$to='';
foreach ($arr as $row)
{
	$mobcom=substr($row,0,4);
	if(($mobcom=="0332")or($mobcom=="0333")or($mobcom=="0334"))
	$to.=$row."@ufone.com,";
	else if(($mobcom=="0300")or($mobcom=="0301")or($mobcom=="0302")or($mobcom=="0303")or($mobcom=="0306"))
	$to.=$row."@mobilink.com,";
}
$to=substr($to,0,(strlen($to)-1));
$subject = 'Invitation';
$frommobileno=$_POST['FromMobileNo'];
$frommobileno=str_replace('-','',$frommobileno);
$headers = 'From: '.$frommobileno."\r\n";
$message = 'Asalamualaikum You are invited to attend NamazeTaravih with complete translation of Quran.';
if($_POST['PlaceId']>0)$message .= $_POST['Suggest2'];
$message .= 'For details and a list of all places visit our website www.doratarjumaquran.pk We look forward to your participation in this program.';
//if(mail($to,$subject,$message,$headers))$smsstatus=1;else 
$smsstatus=0;
/////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////Insert Email and SMS////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////
$insertSQL = sprintf("INSERT INTO emailinvitation(EmailInvitationId, CreationDateTime, FromUserId, ToEmails, SuggestedPlaceId, 
	OptionalMessage, Sent) VALUES (default, NOW(), %s, %s, %s, %s, %s)",
                       GetSQLValueString($_SESSION['UserId'], "int"),
                       GetSQLValueString($_POST['ToEmails'], "text"),
                       GetSQLValueString($_POST['PlaceId'], "int"),
                       GetSQLValueString($_POST['OptionalMessage'], "text"),
					   $emailstatus);

  mysqli_select_db($connDoraTarjumaQuran, $database_connDoraTarjumaQuran);
  $Result1 = mysqli_query($insertSQL) or die(mysqli_error());

$insertSQL = sprintf("INSERT INTO smsinvitation(SmsInvitationId, CreationDateTime, FromUserId, ToMobileNos, SuggestedPlaceId, 
	Sent) VALUES (default, NOW(), %s, %s, %s, %s)",
                       GetSQLValueString($_SESSION['UserId'], "int"),
                       GetSQLValueString($_POST['ToMobileNos'], "text"),
                       GetSQLValueString($_POST['PlaceId'], "int"),
					   $smsstatus);
  mysqli_select_db($connDoraTarjumaQuran, $database_connDoraTarjumaQuran);
  $Result1 = mysqli_query($insertSQL) or die(mysqli_error());

  $redirect = "invitationstatus.php?est=".$emailstatus."&sst=".$smsstatus;
  header("Location: " . $redirect );
 }
}
?>
<script language="javascript" type="text/javascript">
	var count1 = 0;
	var count2 = 0;
	function handleHttpResponse() {
		if (http.readyState == 4) {
			if (div_id != '') {
				document.getElementById(div_id).innerHTML = http.responseText;
			}
		}
	}
	function handleHttpResponseAddress() {
		if (http.readyState == 4) {
document.getElementById('output_div1').innerHTML = "<textarea name=\"Suggest1\" cols=\"50\" rows=\"5\">The nearest place suggested by your friend is\n"+http.responseText+"</textarea>";
document.getElementById('output_div2').innerHTML = "<textarea name=\"Suggest2\" cols=\"14\" rows=\"13\">Nearest Place suggested\n"+http.responseText+"</textarea>";
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
	function getScriptPage()
	{
		div_id = 'output_div0';
		yr=1428;
		co=document.getElementById('Country').value;
		re=document.getElementById('Region').value;
		ci=document.getElementById('CityTown').value;
		reqstr="script_invite.php?yr="+escape(yr)+"&co="+escape(co)+"&re="+escape(re)+"&ci="+escape(ci);
		http.open("GET", reqstr, true);
		http.onreadystatechange = handleHttpResponse;
		http.send(null);//send the request
	}
	
	function getAddress()
	{
		yr=1428;
		co=document.getElementById('Country').value;
		re=document.getElementById('Region').value;
		ci=document.getElementById('CityTown').value;
		plid=document.getElementById('PlaceId').value;
		reqstr="script_invite.php?yr="+escape(yr)+"&co="+escape(co)+"&re="+escape(re)+"&ci="+escape(ci)+"&plid="+escape(plid);
		http.open("GET", reqstr, true);
		http.onreadystatechange = handleHttpResponseAddress;
		http.send(null);//send the request
	}
	function emptyaddress()
	{
document.getElementById('output_div1').innerHTML = "<textarea name=\"Suggest1\" cols=\"50\" rows=\"5\"></textarea>";
document.getElementById('output_div2').innerHTML = "<textarea name=\"Suggest2\" cols=\"14\" rows=\"13\"></textarea>";
	}
</script>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" /><meta name="keywords" content="quran qur'an koran tafseer tafsir exegesis explanation dars arabic downloads books articles quiz questions answers taraveeh taravih prayer ramzan ramadhan roza fasting islam jihad dr israr pakistan khilafat caliphate muslims tanzeem e islami nifaz e shariat islami nizam">
<meta name="description" content="quran qur'an koran tafseer tafsir exegesis explanation dars arabic downloads books articles quiz questions answers taraveeh taravih prayer ramzan ramadhan roza fasting islam jihad dr israr pakistan khilafat caliphate muslims tanzeem e islami nifaz e shariat islami nizam">
<title>Invite your friends and relatives to Dora Tarjuma Quran</title>
<?php include("header.php"); ?>
<style type="text/css">
<!--
.style1 {
	font-size: 24px;
	font-weight: bold;
}
.style2 {
	color: #FF0000;
	font-weight: bold;
	font-size: 12px;
}
.style3 {
	font-size: larger;
	font-weight: bold;
}
-->
</style>
</head>
<body bgcolor="#669933">
<table width="800" border="1" align="center" cellpadding="0" bgcolor="#CCEEAA" cellspacing="0">
<tr align="center">
<td>
<h1 align="center">Dora Tarjuma Quran Invitation</h1>
<?php /*echo ini_get('SMTP') . "\n" . ini_get(smtp_port). "\n";*/?>
And whose speech is better  than one who invites towards Allah and practices good deeds and says<br  />&quot;Surely I am among those who have submitted&quot;(Ha Mim Sajda:33)</td>
</tr></table>
<form method="post" name="form1" action="<?php echo $editFormAction; ?>">
<div id="output_div0" align="center">
<table width="800" bgcolor="#CCEEAA"><tr><td>Please spend some time to suggest a place nearest to the friend you are inviting.<br />
You can select only one place per invitation, Send a new invitation for every different place.<br  />
<input name="NotSure" type="checkbox" onselect=emptyaddress() value="NotSure"/>Check this if you are not sure about the address and would like to send a general invitation.</td></tr>
<tr><td><table bgcolor="#CCEEAA">
<tr valign="baseline"><td nowrap align="right">Country</td><td nowrap align="left"><select id='Country' name='Country' onChange = getScriptPage() style="width=150">
<?php do {  
if($row_rs_Country['Country']!="Other"){
echo "<option value=\"".$row_rs_Country['Country']."\" "; 
if(!(strcmp($row_rs_Country['Country'], "Pakistan"))) {echo "selected=\"selected\"";} 
echo">".$row_rs_Country['Country']."</option>";}
} while ($row_rs_Country = mysqli_fetch_assoc($rs_Country));
echo "<option id='Other' name='Other'>Other</option>";
$rows = mysqli_num_rows($rs_Country);
if($rows > 0) {
mysqli_data_seek($rs_Country, 0);
$row_rs_Country = mysqli_fetch_assoc($rs_Country);
}?>
</select></td></tr>
<tr valign="baseline">
<td nowrap align="right">Region</td><td nowrap align="left"><select id='Region' name='Region' onchange = getScriptPage() style="width=150">
<?php
do {  
?>
<option value="<?php echo $row_rs_Region['Region']?>"<?php if (!(strcmp($row_rs_Region['Region'], "Sindh"))) {echo "selected=\"selected\"";} ?>><?php echo $row_rs_Region['Region']?></option>
<?php
} while ($row_rs_Region = mysqli_fetch_assoc($rs_Region));
echo "<option id='Other' name='Other'>Other</option>";
$rows = mysqli_num_rows($rs_Region);
if($rows > 0) {
mysqli_data_seek($rs_Region, 0);
$row_rs_Region = mysqli_fetch_assoc($rs_Region);
}
?>
</select></td></tr>
<tr valign="baseline">
<td nowrap align="right">CityTown</td><td nowrap align="left"><select id='CityTown' name='CityTown' onchange = getScriptPage() style="width=150">
<?php do { ?>
<option value="<?php echo $row_rs_CityTown['CityTown']?>"<?php if (!(strcmp($row_rs_CityTown['CityTown'], "Karachi"))) {echo "selected=\"selected\"";} ?>><?php echo $row_rs_CityTown['CityTown']?></option>
<?php
} while ($row_rs_CityTown = mysqli_fetch_assoc($rs_CityTown));
echo "<option id='Other' name='Other'>Other</option>";
$rows = mysqli_num_rows($rs_CityTown);
if($rows > 0) {
mysqli_data_seek($rs_CityTown, 0);
$row_rs_CityTown = mysqli_fetch_assoc($rs_CityTown);
}?>
</select></td></tr>
<tr valign="baseline">
<td nowrap align="right">Place</td><td nowrap align="left"><select id='PlaceId' name='PlaceId' onchange = getAddress() style="width:700; max-width:700">
<?php do { ?>
<option value="<?php echo $row_rs_Place['PlaceId']?>"><?php echo $row_rs_Place['Address']?></option>
<?php
} while ($row_rs_Place = mysqli_fetch_assoc($rs_Place));
$rows = mysqli_num_rows($rs_Place);
if($rows > 0) {
mysqli_data_seek($rs_Place, 0);
$row_rs_Place = mysqli_fetch_assoc($rs_Place);
}?>
</select></td></tr>
</table>
</td></tr></table>
</div>
<table width="800" border="1" align="center" cellpadding="0" bgcolor="#CCEEAA"  cellspacing="0">
<tr>
<td width="65%" align="center" class="style1" scope="col">Email Invitation</td>
<td width="35%" align="center" scope="col"><span class="style1">Sms Invitation</span></td>
</tr>
<tr>
<td align="left" valign="top">
<strong>From:</strong> 
<input name="FromEmail" type="text" value="<?php echo $_SESSION['Email'];?>" size="40" readonly="readonly"/><br /><br />
<strong>Email address(es) to invite:<br />
</strong>(Separate multiple emails with comma.<br />At most 35 emails are supported per invitation)<br />
<textarea name="ToEmails" cols="50" rows="10">ehsantemp@yahoo.com,ehsantemp@gmail.com</textarea><br /><br />	
<strong>Subject: Dora  Tarjuma Quran Invitation </strong><br />
<br />
Assalam  u alaikum<br />
This  message is sent to you on request of your friend 
<?php if(isset($_SESSION['FullName']))echo $_SESSION['FullName'];?>
<br />
who wants you to attend Namaz-e-Taravih with complete translation<br />
and a brief explanation of Quran this year.<br />
This program is being held at more than 200 different locations.<br />
<div class="output-div-container"><div id="output_div1">
<textarea name="Suggest1" cols="50" rows="5">Address: [Your Selected Place Here]
Phone: [Phone No Here]</textarea></div></div>
A list of all the places of Dora Tarjuma Quran is also attached with this email.<br />
For  details please visit our website <a href="http://www.doratarjumaquran.pk/">www.doratarjumaquran.pk</a><br />
We look forward to your participation in this program.<br />
<strong>Optional Message:</strong> <br />
<textarea name="OptionalMessage" cols="50" rows="10"></textarea></td>
<td align="left" valign="top"><p><strong>From:</strong> 
<input name="FromMobileNo" type="text" value="<?php echo $_SESSION['Mobile'];?>" size="15" readonly="readonly"/><br /><br />
<strong>Mobile No(s) to invite:</strong><br />
(Separate multiple nos with comma.<br />At most 35 nos are supported per invitation)<br />

<textarea name="ToMobileNos" cols="40" rows="10">03343380785,03333224240,03002183530</textarea><br />
<span class="style2">Only  mobilink and ufone nos are supported currently.</span>
<table width="39%" border="1" align="center" cellpadding="0" bgcolor="#CCEEAA"  cellspacing="0">
<tr>
<td scope="col">Asalamualaikum<br />
You are invited<br />
to attend<br />
NamazeTaravih<br />
with complete<br />
translation of<br />
Quran.<br />
<div class="output-div-container"><div id="output_div2">
  <textarea name="Suggest2" cols="14" rows="10">Address: [Your Selected Place Here]
Phone: [Phone No Here]
  </textarea>
</div>
</div>
For  details and a<br />
list of all<br />
places visit our<br />
website<br />
www.doratarju<br />
maquran.pk<br />
We look forward<br />
to your<br />
participation in<br />
this program.</td></tr></table>
</td></tr></table>
<table width="800" align="center">
<tr valign="baseline">
<td nowrap align="center">The most effective invitation is a word of mouth, when you go to someone personally.<br  />
This is just an additional facility  for a wider reach. I agree and will try to meet my invitees personally also
<input name="submit" type="submit" value="Send Invitation" <?php if($_SESSION['MM_Username'] = "") echo "disabled=\"disabled\"";?>/>
</td></tr></table>
<input type="hidden" name="EmailInvitationId" value="<?php echo $row_rs_NewEmailInvitationId['newemailinvitationid']; ?>">
<input type="hidden" name="MM_insert" value="form1">
</form>
<p>&nbsp;</p>
</body>
<?php include("footer.php"); ?>
</html>
<?php
mysqli_free_result($rs_Country);
mysqli_free_result($rs_Region);
mysqli_free_result($rs_CityTown);
mysqli_free_result($rs_Place);
?>
