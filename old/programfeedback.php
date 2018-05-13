<?php require_once('Connections/connDoraTarjumaQuran.php'); ?>
<?php
if (!isset($_SESSION))session_start();
if(isset($_GET['prid'])){$FeedbackProgramId=$_GET['prid'];$_SESSION['ProgramId']=$_GET['prid'];}
else if(isset($_SESSION['ProgramId']))$FeedbackProgramId=$_SESSION['ProgramId'];
else $FeedbackProgramId=505;
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
$query_rs_FeedbackProgram = "SELECT * FROM program pr join place pl where pr.PlaceId=pl.PlaceId and pr.ProgramId=".$FeedbackProgramId;
$rs_FeedbackProgram = mysqli_query($connDoraTarjumaQuran, $query_rs_FeedbackProgram) or die(mysqli_error());
$row_rs_FeedbackProgram = mysqli_fetch_assoc($rs_FeedbackProgram);
$totalRows_rs_FeedbackProgram = mysqli_num_rows($rs_FeedbackProgram);

$FeedbackHijriYear = $row_rs_FeedbackProgram['HijriYear'];
$FeedbackCountry = $row_rs_FeedbackProgram['Country'];
$FeedbackRegion = $row_rs_FeedbackProgram['Region'];
$FeedbackCityTown = $row_rs_FeedbackProgram['CityTown'];
$FeedbackPlaceId = $row_rs_FeedbackProgram['PlaceId'];

mysqli_select_db($connDoraTarjumaQuran, $database_connDoraTarjumaQuran);
$query_rs_InformationSource = "SELECT InformationSourceId, InformationSource FROM informationsource order by InformationSourceId";
$rs_InformationSource = mysqli_query($connDoraTarjumaQuran, $query_rs_InformationSource) or die(mysqli_error());
$row_rs_InformationSource = mysqli_fetch_assoc($rs_InformationSource);
$totalRows_rs_InformationSource = mysqli_num_rows($rs_InformationSource);

mysqli_select_db($connDoraTarjumaQuran, $database_connDoraTarjumaQuran);
$query_rs_Country = "SELECT distinct(place.Country) FROM program join place WHERE program.PlaceId=place.PlaceId and program.HijriYear=".$FeedbackHijriYear;
$rs_Country = mysqli_query($connDoraTarjumaQuran, $query_rs_Country) or die(mysqli_error());
$row_rs_Country = mysqli_fetch_assoc($rs_Country);
$totalRows_rs_Country = mysqli_num_rows($rs_Country);

mysqli_select_db($connDoraTarjumaQuran, $database_connDoraTarjumaQuran);
$query_rs_Region = "SELECT distinct(place.Region) FROM place join program WHERE place.PlaceId=program.PlaceId and program.HijriYear=".$FeedbackHijriYear." and place.Country='".$FeedbackCountry."'";
$rs_Region = mysqli_query($connDoraTarjumaQuran, $query_rs_Region) or die(mysqli_error());
$row_rs_Region = mysqli_fetch_assoc($rs_Region);
$totalRows_rs_Region = mysqli_num_rows($rs_Region);

mysqli_select_db($connDoraTarjumaQuran, $database_connDoraTarjumaQuran);
$query_rs_CityTown = "SELECT distinct(place.CityTown) FROM place join program WHERE place.PlaceId=program.PlaceId and program.HijriYear=".$FeedbackHijriYear." and place.Region = '".$FeedbackRegion."'";
$rs_CityTown = mysqli_query($connDoraTarjumaQuran, $query_rs_CityTown) or die(mysqli_error());
$row_rs_CityTown = mysqli_fetch_assoc($rs_CityTown);
$totalRows_rs_CityTown = mysqli_num_rows($rs_CityTown);

mysqli_select_db($connDoraTarjumaQuran, $database_connDoraTarjumaQuran);
$query_rs_Program = "SELECT pr.ProgramId, pl.Address FROM place pl join program pr WHERE pl.CityTown ='".$FeedbackCityTown."' and pl.PlaceId=pr.PlaceId and pr.HijriYear=".$FeedbackHijriYear;
$rs_Program = mysqli_query($connDoraTarjumaQuran, $query_rs_Program) or die(mysqli_error());
$row_rs_Program = mysqli_fetch_assoc($rs_Program);
$totalRows_rs_Program = mysqli_num_rows($rs_Program);

mysqli_select_db($connDoraTarjumaQuran, $database_connDoraTarjumaQuran);
$query_rs_Years = "SELECT distinct(pr.HijriYear), pr.Year FROM program pr order by HijriYear desc";
$rs_Years = mysqli_query($connDoraTarjumaQuran, $query_rs_Years) or die(mysqli_error());
$row_rs_Years = mysqli_fetch_assoc($rs_Years);
$totalRows_rs_Years = mysqli_num_rows($rs_Years);

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO programfeedback (ProgramFeedbackId, SubmitDateTime, ProgramId, UserId, InformationSourceId, Informer, NoOfPrograms, ReligiousImprovement, Regularity, Duration, NextYearIntention, InformAboutOtherPrograms, GiveTime, SomethingMissing, SomethingExtra, SuggestionForSpeaker, SuggestionForHafiz, SuggestionForManagement, ViewHeading, CompleteExperience) VALUES (default, now(), %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['ProgramId'], "int"),
                       GetSQLValueString($_SESSION['UserId'], "int"),
                       GetSQLValueString($_POST['InformationSourceId'], "int"),
                       GetSQLValueString($_POST['Informer'], "int"),
                       GetSQLValueString($_POST['NoOfPrograms'], "int"),
                       GetSQLValueString($_POST['ReligiousImprovement'], "int"),
                       GetSQLValueString($_POST['Regularity'], "int"),
                       GetSQLValueString($_POST['Duration'], "int"),
                       GetSQLValueString($_POST['NextYearIntention'], "int"),
                       GetSQLValueString($_POST['InformAboutOtherPrograms'], "int"),
                       GetSQLValueString($_POST['GiveTime'], "int"),
                       GetSQLValueString($_POST['SomethingMissing'], "text"),
                       GetSQLValueString($_POST['SomethingExtra'], "text"),
                       GetSQLValueString($_POST['SuggestionForSpeaker'], "text"),
                       GetSQLValueString($_POST['SuggestionForHafiz'], "text"),
                       GetSQLValueString($_POST['SuggestionForManagement'], "text"),
                       GetSQLValueString($_POST['ViewHeading'], "text"),
                       GetSQLValueString($_POST['CompleteExperience'], "text"));

  mysqli_select_db($connDoraTarjumaQuran, $database_connDoraTarjumaQuran);
  $Result1 = mysqli_query($insertSQL) or die(mysqli_error());

  $insertGoTo = "thanks.php";
  header(sprintf("Location: %s", $insertGoTo));
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
	function getScriptPage()
	{
		div_id = 'output_div0';
		yr=document.getElementById('Year').value;
		co=document.getElementById('Country').value;
		re=document.getElementById('Region').value;
		ci=document.getElementById('CityTown').value;
		reqstr="script_programfeedback.php?yr="+escape(yr)+"&co="+escape(co)+"&re="+escape(re)+"&ci="+escape(ci);
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
<title>Suggestions, Feedback, Views and Experiences for Dora Tarjuma Quran</title>
<style type="text/css">
<!--
.style4 {
	color: #FF0000;
	font-weight: bold;
}
-->
</style>
<?php include("header.php"); ?>
<style type="text/css">
<!--
.style3 {font-size: medium}
-->
</style>
</head>
<body bgcolor="#669933">
<table border="1" width="800" align="center" cellpadding="0" bgcolor="#CCEEAA"  cellspacing="0">
<tr><th scope="col"><h1 align="center">Dora Tarjuma Quran Feedback</h1><span class="style3">(Your feedback is vital for our improvement)</span></th></tr>
  <tr><td align="center"><span class="style4"><?php if(!isset($_SESSION['UserId'])or(isset($_SESSION['UserId'])and $_SESSION['UserId']==0)) echo 'You need to be signed in to submit your feedback.<br />Please <a href="signin.php?u=pf">Sign In</a> or <a href="signup.php">Create an account.</a>';?></span></td>
  </tr>
<tr><td>
<form method="post" name="form1" action="<?php echo $editFormAction; ?>">
<table align="center" width="800"><tr><th>Select the program you attended</th></tr><tr><td><table bgcolor="#CCEEAA">
<tr valign="baseline"><td align="right" nowrap>ProgramYear</td>
      <td width="41" align="left"  nowrap><select id='Year' name='Year' onchange = getScriptPage() style="width=150">
        <?php do { ?>
        <option value="<?php echo $row_rs_Years['HijriYear']?>"<?php if ($row_rs_Years['HijriYear'] == $FeedbackHijriYear) {echo "selected=\"selected\"";} ?>><?php echo $row_rs_Years['HijriYear']." AH (".$row_rs_Years['Year']." AD)";?></option>
        <?php } while ($row_rs_Years = mysqli_fetch_assoc($rs_Years));
  $rows = mysqli_num_rows($rs_Years);
  if($rows > 0) {
      mysqli_data_seek($rs_Years, 0);
	  $row_rs_Years = mysqli_fetch_assoc($rs_Years);
  }?>
      </select></td></tr></table></td></tr><tr><td>
<div id="output_div0" align="left">
<table align="left">
	<tr valign="baseline"><td nowrap align="right">Country</td><td nowrap align="left"><select id='Country' name='Country' onChange = getScriptPage() style="width=150">
        <?php do {  
		if($row_rs_Country['Country']!="Other"){
        echo "<option value=\"".$row_rs_Country['Country']."\" "; 
		if(!(strcmp($row_rs_Country['Country'], $FeedbackCountry))) {echo "selected=\"selected\"";} 
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
        <option value="<?php echo $row_rs_Region['Region']?>"<?php if (!(strcmp($row_rs_Region['Region'], $FeedbackRegion))) {echo "selected=\"selected\"";} ?>><?php echo $row_rs_Region['Region']?></option>
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
        <option value="<?php echo $row_rs_CityTown['CityTown']?>"<?php if (!(strcmp($row_rs_CityTown['CityTown'], $FeedbackCityTown))) {echo "selected=\"selected\"";} ?>><?php echo $row_rs_CityTown['CityTown']?></option>
        <?php
} while ($row_rs_CityTown = mysqli_fetch_assoc($rs_CityTown));
echo "<option id='Other' name='Other'>Other</option>";
  $rows = mysqli_num_rows($rs_CityTown);
  if($rows > 0) {
      mysqli_data_seek($rs_CityTown, 0);
	  $row_rs_CityTown = mysqli_fetch_assoc($rs_CityTown);
  }?>
      </select></td></tr>
  <tr><th scope=\"col\" align="left">Program Ids</th><th scope=\"col\" align="left">Program(s) in Karachi</th></tr>
    <tr valign="baseline">
<td nowrap align="right">Place(s)</td><td nowrap align="left"><select id='ProgramId' name='ProgramId' style="width:700; max-width:700">
<?php do { ?>
<option value="<?php echo $row_rs_Program['ProgramId']?>"<?php if($FeedbackProgramId==$row_rs_Program['ProgramId']) echo 'selected="selected"';?>><?php echo $row_rs_Program['Address']?></option>
<?php
} while ($row_rs_Program = mysqli_fetch_assoc($rs_Program));
$rows = mysqli_num_rows($rs_Program);
if($rows > 0) {
mysqli_data_seek($rs_Program, 0);
$row_rs_Program = mysqli_fetch_assoc($rs_Program);
}?>
</select></td>
</tr>
	</table>
	</div></td></tr></table><br  />
	<table align="center" width="800" >
    <tr valign="baseline">
      <td nowrap align="right">View Heading</td>
      <td><input type="text" name="ViewHeading" value="" size="100" maxlength="255"><br  />
	  <em>This scrolls on the main page of the website</em></td>
</tr>
    <tr valign="baseline">
      <td nowrap align="right" valign="top">Your Complete<br  />Experience In<br  /> Your Own Words</td>
<td><textarea name="CompleteExperience" cols="80" rows="5"></textarea><br  />
      <em>Share with us an account of the nights you spent with Quran.It can be a source of inspiration for others.</em>
	  </td></tr></table><br  />
  <table align="center" width="796" border="1" cellpadding="0" bgcolor="#CCEEAA"  cellspacing="0">
    <tr valign="baseline">
	<td width="16" align="left" nowrap>1</td>
      <td width="435" align="left" nowrap>How did you come to know about this program?[First Information Source]</td>
      <td width="372"><select name="InformationSourceId">
        <?php
do {  
?>
        <option value="<?php echo $row_rs_InformationSource['InformationSourceId']?>"<?php if (!(strcmp($row_rs_InformationSource['InformationSourceId'], 7))) {echo "selected=\"selected\"";} ?>><?php echo $row_rs_InformationSource['InformationSource']?></option>
        <?php
} while ($row_rs_InformationSource = mysqli_fetch_assoc($rs_InformationSource));
  $rows = mysqli_num_rows($rs_InformationSource);
  if($rows > 0) {
      mysqli_data_seek($rs_InformationSource, 0);
	  $row_rs_InformationSource = mysqli_fetch_assoc($rs_InformationSource);
  }
?>
      </select>      </td>
    </tr>
    <tr valign="baseline">
	<td align="left" nowrap>2</td>
      <td nowrap align="left">If informed by a friend, Is he a rafeeq of Tanzeem e Islami<br />
         or member of Anjuman Khuddam ul Quran? </td>
      <td><select name="Informer">
	  <option value="1">Both</option>
		<option value="2">Rafeeq of Tanzeem-e-Islami</option>
		<option value="3">Member of Anjuman Khuddam ul Quran</option>
		<option value="4">None</option>
		<option value="5">Don't know</option>
		</select>      </td>
	</tr>
		<tr valign="baseline">
		<td align="left" nowrap>3</td>
		<td nowrap align="left">How many times have you attended this program including this year?</td>
		<td><select name="NoOfPrograms">
		<option value="1">1</option>
		<option value="2">2</option>
		<option value="3">3</option>
		<option value="4">4</option>
		<option value="5">5</option>
		<option value="6">6</option>
		<option value="7">7</option>
		<option value="8">8</option>
		<option value="9">9</option>
		<option value="10">10</option>
		<option value="11">11</option>
		<option value="12">12</option>
		<option value="13">13</option>
		<option value="14">14</option>
		<option value="15">15</option>
		<option value="16">16</option>
		<option value="17">17</option>
		<option value="18">18</option>
		<option value="19">19</option>
		<option value="20">20</option>
		<option value="21">21</option>
		<option value="22">22</option>
		<option value="23">23</option>
		<option value="24">24</option>
      </select>      </td>
    </tr>
    <tr valign="baseline">
	<td align="left" nowrap>4</td>
      <td nowrap align="left">Do you feel any improvement in yourself from religious point of view<br/>
      by attending this program?</td>
      <td><select name="ReligiousImprovement">
        <option value="1">yes, a lot</option>
        <option value="2">yes, somewhat</option>
		<option value="3">not so much</option>
        <option value="4">not at all</option>
      </select>      </td>
    </tr>
    <tr valign="baseline">
	<td align="left" nowrap>5</td>
      <td nowrap align="left">How regularly do/did you attend this program?</td>
      <td><select name="Regularity">
        <option value="1">daily</option>
        <option value="2">in holidays</option>
        <option value="3">occasionally</option>
      </select>      </td>
    </tr>
    <tr valign="baseline">
	<td align="left" nowrap>6</td>
      <td nowrap align="left"> What is/was the duration of your attendance?</td>
      <td><select name="Duration">
        <option value="1">complete</option>
        <option value="2">partial</option>
      </select>      </td>
    </tr>
    <tr valign="baseline">
	<td align="left" nowrap>7</td>
      <td nowrap align="left"> Are you willing to attend this program next year?</td>
      <td><select name="NextYearIntention">
        <option value="1">yes, Inshallah</option>
        <option value="3">can't say</option>
		<option value="4">no</option>
      </select>      </td>
    </tr>
    <tr valign="baseline">
	<td align="left" nowrap>8</td>
      <td nowrap align="left">Would you like to be informed about other programs organized by us?</td>
      <td><select name="InformAboutOtherPrograms">
        <option value="1">yes, every program</option>
        <option value="2">yes, very important ones only</option>
		<option value="3">no thanks</option>
      </select>      </td>
    </tr>
    <tr valign="baseline">
	<td align="left" nowrap>9</td>
      <td nowrap align="left">Are you willing to give your time in the cause of Islam?</td>
      <td><select name="GiveTime">
        <option value="1">yes, as you suggest</option>
        <option value="2">yes, on my own</option>
		<option value="3">no</option>
      </select></td>
    </tr>
    <tr valign="baseline">
	<td align="left" nowrap>10</td>
      <td nowrap align="left" valign="bottom">If you felt some thing was missing</td>
      <td><textarea name="SomethingMissing" cols="35" rows="3"></textarea></td>
    </tr>
    <tr valign="baseline">
	<td align="left" nowrap>11</td>
      <td nowrap align="left" valign="bottom">If you felt some thing was extra</td>
      <td><textarea name="SomethingExtra" cols="35" rows="3"></textarea></td>
    </tr>
    <tr valign="baseline">
	<td align="left" nowrap>12</td>
      <td nowrap align="left" valign="bottom"> Suggestion for Speaker(s)(Mutarjim)</td>
      <td><textarea name="SuggestionForSpeaker" cols="35" rows="3"></textarea></td>
    </tr>
    <tr valign="baseline">
	<td align="left" nowrap>13</td>
      <td nowrap align="left" valign="bottom">Suggestion for Huffaz</td>
      <td><textarea name="SuggestionForHafiz" cols="35" rows="3"></textarea></td>
    </tr>
    <tr valign="baseline">
	<td align="left" nowrap>14</td>
      <td nowrap align="left" valign="bottom">Suggestion for Management(Nazimeen+Muawineen)</td>
      <td><textarea name="SuggestionForManagement" cols="35" rows="3"></textarea></td>
    </tr>
    <tr valign="baseline">
	<td align="left" nowrap>&nbsp;</td>
      <td nowrap align="right">&nbsp;</td>
      <td><input type="submit" value="Submit Feedback"<?php if(!isset($_SESSION['UserId'])or(isset($_SESSION['UserId'])and $_SESSION['UserId']==0)) echo 'disabled="disabled"';?>></td>
    </tr>
  </table>
  <input type="hidden" name="MM_insert" value="form1">
</form>
</td></tr></table>
</body>
<?php include("footer.php"); ?>
</html>
<?php
mysqli_free_result($rs_InformationSource);
mysqli_free_result($rs_Years);
mysqli_free_result($rs_Country);
mysqli_free_result($rs_Region);
mysqli_free_result($rs_CityTown);
mysqli_free_result($rs_Program);
?>