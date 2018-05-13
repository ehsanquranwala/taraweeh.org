<?php require_once('Connections/connDoraTarjumaQuran.php'); ?>
<?php require_once('Connections/connDoraTarjumaQuran.php'); ?>
<?php
if (!isset($_SESSION)) {session_start();}

$editFormAction = $_SERVER['PHP_SELF'];
/*if(!isset($_SESSION['Admin']) or (isset($_SESSION['Admin']) and ($_SESSION['Admin']==0))){echo 'Only Admins are allowed to use this form';die();}*/

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
if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {

$dob="'".$_POST['yy']."-".$_POST['mm']."-".$_POST['dd']."'";
$joindatead='\'0000-00-00\'';
$joindatehijri='\'0000-00-00\'';
if($_POST['JoiningDateCalender']=='Standard')
	$joindatead="'".$_POST['jyys']."-".$_POST['jmms']."-".$_POST['jdds']."'";
else 
 	$joindatehijri="'".$_POST['jyyh']."-".$_POST['jmmh']."-".$_POST['jddh']."'";
if(isset($_POST['Mutarjim']))$s=1; else $s=0;
if(isset($_POST['Hafiz']))$h=1; else $h=0;
if(isset($_POST['Management']))$m=1; else $m=0;

$mt=$_POST['MaqamiTanzeemId'];
if(($_POST['MaqamiTanzeemId']==-1)and(isset($_POST['NewMaqamiTanzeemId'])))
{
	$insertSQL = sprintf("INSERT INTO maqamitanzeem values (default, %s, %s, 0)",
	GetSQLValueString($_POST['HalqaId'], "text"),
	GetSQLValueString($_POST['NewMaqamiTanzeem'], "text"));
	mysqli_select_db($connDoraTarjumaQuran, $database_connDoraTarjumaQuran);
	$Result1 = mysqli_query($insertSQL) or die(mysqli_error());
	mysqli_select_db($connDoraTarjumaQuran, $database_connDoraTarjumaQuran);
	$mt=mysql_insert_id($connDoraTarjumaQuran);
}

$u=$_POST['UsraId'];
if(($_POST['UsraId']==-1)and(isset($_POST['NewUsraId'])))
{
	$insertSQL = sprintf("INSERT INTO usra values (default, %s, %s, %s, %s, 0)",
	GetSQLValueString($_POST['MaqamiTanzeemId'], "text"),
	GetSQLValueString($_POST['HalqaId'], "text"),
	GetSQLValueString($_POST['NewUsra'], "text"),
	GetSQLValueString($_POST['NewUsraNaqeeb'], "text"));
	mysqli_select_db($connDoraTarjumaQuran, $database_connDoraTarjumaQuran);
	$Result1 = mysqli_query($insertSQL) or die(mysqli_error());
	mysqli_select_db($connDoraTarjumaQuran, $database_connDoraTarjumaQuran);
	$u=mysql_insert_id($connDoraTarjumaQuran);
}
  
$insertSQL = sprintf("insert into user(UserId, Email, UserName, Password, Prefix, FirstName, LastName, Gender, DateOfBirth, Mobile, HomePhone, WorkPhone, HomeAddress, WorkAddress, CityTown, Region, Country, Education, Profession, DetailedNote, 
	JoiningDateAD, JoiningDateHijri, CurrentResponsibilities, HalqaId, MaqamiTanzeemId, 
	UsraId, Mutarjim, Hafiz, Management, verified) values(default, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, 1)",
  					   GetSQLValueString($_POST['Email'], "text"),
					   GetSQLValueString($_POST['UserName'], "text"),
                       GetSQLValueString($_POST['Password'], "text"),
                       GetSQLValueString($_POST['Prefix'], "text"),
					   GetSQLValueString($_POST['FirstName'], "text"),
					   GetSQLValueString($_POST['LastName'], "text"),
                       GetSQLValueString($_POST['Gender'], "text"),
                       $dob,
                       GetSQLValueString($_POST['Mobile'], "text"),
					   GetSQLValueString($_POST['HomePhone'], "text"),
					   GetSQLValueString($_POST['WorkPhone'], "text"),
                       GetSQLValueString($_POST['HomeAddress'], "text"),
					   GetSQLValueString($_POST['WorkAddress'], "text"),
					   GetSQLValueString($_POST['CityTown'], "text"),
					   GetSQLValueString($_POST['Region'], "text"),
					   GetSQLValueString($_POST['Country'], "text"),
                       GetSQLValueString($_POST['Education'], "text"),
                       GetSQLValueString($_POST['Profession'], "text"),
                       GetSQLValueString($_POST['DetailedNote'], "text"),
					   $joindatead,
					   $joindatehijri,
					   GetSQLValueString($_POST['CurrentResponsibilities'], "text"),
                       GetSQLValueString($_POST['HalqaId'], "int"),
                       $mt, $u, $s, $h, $m);
	mysqli_select_db($connDoraTarjumaQuran, $database_connDoraTarjumaQuran);
	$Result1 = mysqli_query($insertSQL) or die(mysqli_error());
	$uid=mysql_insert_id($connDoraTarjumaQuran);
	$insertGoTo = "adminpage.php";
	header(sprintf("Location: %s", $insertGoTo));
}
else
{	
	mysqli_select_db($connDoraTarjumaQuran, $database_connDoraTarjumaQuran);
	$query_rs_Prefix = "SELECT Prefix FROM prefix ORDER BY PrefixId";
	$rs_Prefix = mysqli_query($connDoraTarjumaQuran, $query_rs_Prefix) or die(mysqli_error());
	$row_rs_Prefix = mysqli_fetch_assoc($rs_Prefix);
	$totalRows_rs_Prefix = mysqli_num_rows($rs_Prefix);
	
	mysqli_select_db($connDoraTarjumaQuran, $database_connDoraTarjumaQuran);
	$query_rs_Halqa = "SELECT halqa.HalqaId, halqa.Halqa FROM halqa";
	$rs_Halqa = mysqli_query($connDoraTarjumaQuran, $query_rs_Halqa) or die(mysqli_error());
	$row_rs_Halqa = mysqli_fetch_assoc($rs_Halqa);
	$totalRows_rs_Halqa = mysqli_num_rows($rs_Halqa);
	
	mysqli_select_db($connDoraTarjumaQuran, $database_connDoraTarjumaQuran);
	$query_rs_MaqamiTanzeem = "SELECT MaqamiTanzeemId, MaqamiTanzeem FROM maqamitanzeem WHERE Verified=1 and HalqaId=6";
	$rs_MaqamiTanzeem = mysqli_query($connDoraTarjumaQuran, $query_rs_MaqamiTanzeem) or die(mysqli_error());
	$row_rs_MaqamiTanzeem = mysqli_fetch_assoc($rs_MaqamiTanzeem);
	$totalRows_rs_MaqamiTanzeem = mysqli_num_rows($rs_MaqamiTanzeem);
	
	mysqli_select_db($connDoraTarjumaQuran, $database_connDoraTarjumaQuran);
	$query_rs_Usra = "SELECT usra.UsraId, concat_ws(' ',usra.Usra,' (Naqeeb:', usra.Naqeeb,')') usranaqeeb FROM usra WHERE Verified=1 and usra.MaqamiTanzeemId=7";
	$rs_Usra = mysqli_query($connDoraTarjumaQuran, $query_rs_Usra) or die(mysqli_error());
	$row_rs_Usra = mysqli_fetch_assoc($rs_Usra);
	$totalRows_rs_Usra = mysqli_num_rows($rs_Usra);
	
	mysqli_select_db($connDoraTarjumaQuran, $database_connDoraTarjumaQuran);
	$query_rs_Months = "SELECT months.MonthId, months.`Month` FROM months";
	$rs_Months = mysqli_query($connDoraTarjumaQuran, $query_rs_Months) or die(mysqli_error());
	$row_rs_Months = mysqli_fetch_assoc($rs_Months);
	$totalRows_rs_Months = mysqli_num_rows($rs_Months);
	
	mysqli_select_db($connDoraTarjumaQuran, $database_connDoraTarjumaQuran);
	$query_rs_hijrimonths = "SELECT * FROM hijrimonths";
	$rs_hijrimonths = mysqli_query($connDoraTarjumaQuran, $query_rs_hijrimonths) or die(mysqli_error());
	$row_rs_hijrimonths = mysqli_fetch_assoc($rs_hijrimonths);
	$totalRows_rs_hijrimonths = mysqli_num_rows($rs_hijrimonths);

	mysqli_select_db($connDoraTarjumaQuran, $database_connDoraTarjumaQuran);
	$query_rs_Countries = "select * from Country";
	$rs_Countries = mysqli_query($connDoraTarjumaQuran, $query_rs_Countries) or die(mysqli_error());
	$row_rs_Countries = mysqli_fetch_assoc($rs_Countries);
	$totalRows_rs_Countries = mysqli_num_rows($rs_Countries);
}
?>
<script language="javascript" type="text/javascript">
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
	function getScriptPage(ce)
	{
		div_id = 'output_div0';
		hid=document.getElementById('HalqaId').value;
		mtid=document.getElementById('MaqamiTanzeemId').value;
		reqstr="script_selectusra.php?hid="+escape(hid)+"&mtid="+escape(mtid)+"&ce="+escape(ce);
		http.open("GET", reqstr, true);
		http.onreadystatechange = handleHttpResponse;
		http.send(null);//send the request
	}
</script>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" /><meta name="keywords" content="quran qur'an koran tafseer tafsir exegesis explanation dars arabic downloads books articles quiz questions answers taraveeh taravih prayer ramzan ramadhan roza fasting islam jihad dr israr pakistan khilafat caliphate muslims tanzeem e islami nifaz e shariat islami nizam">
<meta name="description" content="quran qur'an koran tafseer tafsir exegesis explanation dars arabic downloads books articles quiz questions answers taraveeh taravih prayer ramzan ramadhan roza fasting islam jihad dr israr pakistan khilafat caliphate muslims tanzeem e islami nifaz e shariat islami nizam">
<title>Add New User on Dora Tarjuma Quran</title>
<style type="text/css">
<!--
.style2 {
	color: #FF0000;
	font-size: large;
}
-->
</style>
<?php include("header.php"); ?>
<?php include("adminquicklinks.php");?>
</head><body bgcolor="#669933">
<form method="post" name="form1" action="<?php echo $editFormAction; ?>">
<table width="800" border="1" align="center" cellpadding="0" bgcolor="#CCEEAA"  cellspacing="0">
<tr><td ><h1 align="center">Add New User</h1>
    <table align="center">
    <tr valign="baseline">
      <td align="right" nowrap>Email:</td>
      <td ><input type="text" name="Email" value="" size="40">
	  </td>
    </tr>
	<tr valign="baseline">
      <td width="142" align="right" nowrap>UserName:</td>
      <td width="538"><input type="text" name="UserName" value="" size="20">
	  </td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Password:</td>
      <td><input type="text" name="Password" value="" size="20"></td>
    </tr>
	<tr valign="baseline">
      <td nowrap align="right">Title:</td>
      <td><select name="Prefix">
        <?php
do {  
?>
        <option value="<?php echo $row_rs_Prefix['Prefix']?>"><?php echo $row_rs_Prefix['Prefix']?></option>
        <?php
} while ($row_rs_Prefix = mysqli_fetch_assoc($rs_Prefix));
  $rows = mysqli_num_rows($rs_Prefix);
  if($rows > 0) {
      mysqli_data_seek($rs_Prefix, 0);
	  $row_rs_Prefix = mysqli_fetch_assoc($rs_Prefix);
  }
?>
      </select></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">FirstName:</td>
      <td><input name="FirstName" type="text" value="" size="30" maxlength="50"> 
      LastName
      <input name="LastName" type="text" value="" size="30" maxlength="50" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Gender:</td>
      <td valign="baseline"><table bgcolor="#CCEEAA">
        <tr>
          <td><input name="Gender" type="radio" value="m" checked="checked">
            male</td><td><input type="radio" name="Gender" value="f">
            female</td>
        </tr>
       </table></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Date Of Birth:</td>
      <td><select name="dd"><?php $date=1;do { ?>
        <option value="<?php echo $date;?>"><?php if($date<10)echo "0"; echo $date;?></option>
        <?php $date++;} while ($date<32);?>
      </select>
        <select name="mm">
          <?php
do {  
?>
          <option value="<?php echo $row_rs_Months['MonthId'];?>"><?php echo $row_rs_Months['Month']?></option>
          <?php
} while ($row_rs_Months = mysqli_fetch_assoc($rs_Months));
  $rows = mysqli_num_rows($rs_Months);
  if($rows > 0) {
      mysqli_data_seek($rs_Months, 0);
	  $row_rs_Months = mysqli_fetch_assoc($rs_Months);
  }
?>
        </select>
        <select name="yy"><?php $year=2007;do { ?>
        <option value="<?php echo $year;?>" ><?php echo $year;?>
		</option>
        <?php $year--;} while ($year>1920);?>
      </select></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Contact (Home):</td>
      <td><input name="HomePhone" type="text" value="" size="14" maxlength="14">
(e.g. +92-21-2239849)</td>
    </tr>
	<tr valign="baseline">
      <td nowrap align="right">Contact(Work):</td>
      <td><input name="WorkPhone" type="text" value="" size="14" maxlength="14">
      (e.g. +92-21-4330038)</td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Mobile:</td>
      <td><input name="Mobile" type="text" value="" size="15" maxlength="15">
      (e.g. +92-334-3380785)</td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Address(Home):</td>
      <td><input name="HomeAddress" type="text" value="" size="50" maxlength="70"></td>
    </tr>
	<tr valign="baseline">
      <td nowrap align="right">Address(Work):</td>
      <td><input name="WorkAddress" type="text" value="" size="50" maxlength="70"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Country:</td>
      <td><select name="Country">
        <?php
do {  
?>
        <option value="<?php echo $row_rs_Countries['CountryId']?>"<?php if (!strcmp($row_rs_Countries['CountryId'], 'PK')){echo "selected=\"selected\"";} ?>><?php echo $row_rs_Countries['Country']?></option>
        <?php
} while ($row_rs_Countries = mysqli_fetch_assoc($rs_Countries));
  $rows = mysqli_num_rows($rs_Countries);
  if($rows > 0) {
      mysqli_data_seek($rs_Countries, 0);
	  $row_rs_Countries = mysqli_fetch_assoc($rs_Countries);
  }
?>
      </select></td>
    </tr>
	    <tr valign="baseline">
      <td nowrap align="right">Region:</td>
      <td><input type="text" name="Region" value="" />
      (state, province etc)</td>
    </tr>
	    <tr valign="baseline">
      <td nowrap align="right">CityTown:</td>
      <td><input type="text" name="CityTown" value=""/></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Education:</td>
      <td><input name="Education" type="text" value="" size="50" maxlength="50">
	  (e.g Bachelor of Science (Computer Science))<br />
      <em>Your highest degree and major subject, students may write the degree in progress.</em></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Profession:</td>
      <td><input name="Profession" type="text" value="" size="50" maxlength="50">
      (e.g Software Engineer in DevNext Solutions)<br  />
	  <em>Your Job Title and Company Name, Business Name etc </em></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Detailed Note:</td>
      <td>
        <textarea  name="DetailedNote" cols="70" rows="12"></textarea><br />
        <em>Please share with us a detailed note of your education, profession, interests, activities, your<br />
        overall perception of life, any important events and if you are a rafeeq of Tanzeem-e-Islami,<br />
        your experience from introduction to joining of Tanzeem and afterwards.</em></td>
    </tr>
		<tr valign="baseline">
      <td nowrap align="right">&nbsp;</td>
      <td><strong>Please provide the additional details below if you are a rafeeq of Tanzeem e Islami.</strong></td>
    </tr>
	<tr valign="baseline">
      <td nowrap align="right">Joining Date</td>
      <td><input name="JoiningDateCalender" type="radio" value="Standard" checked="checked" />Use this<select name="jdds"><?php $date=1;do { ?>
        <option value="<?php echo $date;?>"><?php if($date<10)echo "0"; echo $date;?></option>
        <?php $date++;} while ($date<32);?>
      </select>
        <select name="jmms">
          <?php
do {  
?>
          <option value="<?php echo $row_rs_Months['MonthId'];?>"><?php echo $row_rs_Months['Month']?></option>
          <?php
} while ($row_rs_Months = mysqli_fetch_assoc($rs_Months));
  $rows = mysqli_num_rows($rs_Months);
  if($rows > 0) {
      mysqli_data_seek($rs_Months, 0);
	  $row_rs_Months = mysqli_fetch_assoc($rs_Months);
  }
?>
        </select>
        <select name="jyys"><?php $year=2007;do { ?>
        <option value="<?php echo $year;?>" ><?php echo $year;?>
		</option>
        <?php $year--;} while ($year>1966);?>
      </select><br  />
        <input name="JoiningDateCalender" type="radio" value="Hijri"/>Use this<select name="jddh"><?php $date=1;do { ?>
        <option value="<?php echo $date;?>"><?php if($date<10)echo "0"; echo $date;?></option>
        <?php $date++;} while ($date<31);?>
      </select>
        <select name="jmmh">
          <?php
do {  
?>
          <option value="<?php echo $row_rs_hijrimonths['MonthId'];?>"><?php echo $row_rs_hijrimonths['Month']?></option>
          <?php
} while ($row_rs_hijrimonths = mysqli_fetch_assoc($rs_hijrimonths));
  $rows = mysqli_num_rows($rs_hijrimonths);
  if($rows > 0) {
      mysqli_data_seek($rs_hijrimonths, 0);
	  $row_rs_hijrimonths = mysqli_fetch_assoc($rs_hijrimonths);
  }
?>
        </select>
        <select name="jyyh"><?php $year=1428;do { ?>
        <option value="<?php echo $year;?>" ><?php echo $year;?>
		</option>
        <?php $year--;} while ($year>1386);?>
      </select><br  />Select date=1 and month=January/Muharram in case you dont remember any of them exactly.</td>
    </tr>
	<tr valign="baseline">
      <td nowrap valign="top" align="right">Current Responsibilities<br  />in Tanzeem(if any)</td>
      <td><textarea name="CurrentResponsibilities" cols="70"></textarea></td>
    </tr>
	<tr valign="baseline">
      <td nowrap align="right">All past and present<br />
      responsibilities in<br />Dora Tarjuma Quran </td>
      <td><label>
        <input name="Mutarjim" type="checkbox" value="1" checked="checked" />
      Speaker(Mutarjim)</label><br />
	  <label>
      <input type="checkbox" name="Hafiz" value="1" />
      Hafiz(Qari)</label>
	  <br />
      <label>
      <input type="checkbox" name="Management" value="1" />
      Management(Nazim / Muawin)</label></td>
    </tr><tr valign="baseline">
      <td nowrap align="right">Halqa:</td>
      <td><select id='HalqaId' name='HalqaId' onchange = getScriptPage('h')>
        <?php
do {  
?><option value="<?php echo $row_rs_Halqa['HalqaId']?>"<?php if ($row_rs_Halqa['HalqaId']==6) {echo "selected=\"selected\"";} ?>><?php echo $row_rs_Halqa['Halqa']?></option>
          <?php
} while ($row_rs_Halqa = mysqli_fetch_assoc($rs_Halqa));
  $rows = mysqli_num_rows($rs_Halqa);
  if($rows > 0) {
      mysqli_data_seek($rs_Halqa, 0);
	  $row_rs_Halqa = mysqli_fetch_assoc($rs_Halqa);
  }
?>
      </select></td>
	</tr>
  </table></td></tr>
  <tr><td>
  <div id="output_div0" align="center">
	<table >
	<tr valign="baseline">
      <td align="right" nowrap>Maqami Tanzeem:</td>
      <td><select id='MaqamiTanzeemId' name='MaqamiTanzeemId' onchange = getScriptPage('mt')>
        <?php
do {  
?>
        <option value="<?php echo $row_rs_MaqamiTanzeem['MaqamiTanzeemId']?>"<?php if ($row_rs_MaqamiTanzeem['MaqamiTanzeemId']==7) {echo "selected=\"selected\"";} ?>><?php echo $row_rs_MaqamiTanzeem['MaqamiTanzeem']?></option>
<?php
} while ($row_rs_MaqamiTanzeem = mysqli_fetch_assoc($rs_MaqamiTanzeem));
  $rows = mysqli_num_rows($rs_MaqamiTanzeem);
  if($rows > 0) {
      mysqli_data_seek($rs_MaqamiTanzeem, 0);
	  $row_rs_MaqamiTanzeem = mysqli_fetch_assoc($rs_MaqamiTanzeem);
  }
?>     <option value="1">No Maqami Tanzeem(Munfarid Usra/Rafeeq)</option><option value="-1">Not Listed</option></select>Enter here
      <input type="text" name="NewMaqamiTanzeem" />
      if not listed.</td>
	</tr>
	<tr valign="baseline">
      <td nowrap align="right">Usra:</td>
      <td><select id='UsraId' name='UsraId'>
        <?php
do {  
?>
        <option value="<?php echo $row_rs_Usra['UsraId']?>"<?php if($row_rs_Usra['UsraId']==181) echo 'selected="selected"';?>><?php echo $row_rs_Usra['usranaqeeb']?></option>
        <?php
} while ($row_rs_Usra = mysqli_fetch_assoc($rs_Usra));
  $rows = mysqli_num_rows($rs_Usra);
  if($rows > 0) {
      mysqli_data_seek($rs_Usra, 0);
	  $row_rs_Usra = mysqli_fetch_assoc($rs_Usra);
  }
?><option value="1">No Usra(Munfarid Rafeeq)</option><option value="-1">Not Listed</option></select>
      Enter here
      <input type="text" name="NewUsra" />
      if not listed.</td>
	</tr>
	</table>
  </div>
</td></tr>
<tr><td align="center"><input type="submit" value="Add User">
<a href="profile.php">Cancel</a>
<input type="hidden" name="MM_insert" value="form1">
</td></tr></table></form>
</body>
<?php include("footer.php"); ?>
</html>
<?php
mysqli_free_result($rs_Prefix);
mysqli_free_result($rs_MaqamiTanzeem);
mysqli_free_result($rs_Halqa);
mysqli_free_result($rs_Usra);
mysqli_free_result($rs_Months);
mysqli_free_result($rs_hijrimonths);
mysqli_free_result($rs_Countries);
?>