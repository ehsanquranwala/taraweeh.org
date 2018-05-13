<?php require_once('Connections/connDoraTarjumaQuran.php'); ?>
<?php require_once('Connections/connDoraTarjumaQuran.php'); 
$CurrentYear=1428;
$ProgramToEdit=$_GET['prid'];
$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);}
  
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
/////////////////////////////////////////////////////////////////////////////////
//////////////////////Entries to edit////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////
mysqli_select_db($connDoraTarjumaQuran, $database_connDoraTarjumaQuran);
$query_rs_ProgramToEdit = "SELECT * FROM program pr join place pl join language l where pr.PlaceId=pl.PlaceId and pr.LanguageId=l.LanguageId and pr.ProgramId=".$ProgramToEdit;
$rs_ProgramToEdit = mysqli_query($connDoraTarjumaQuran, $query_rs_ProgramToEdit) or die(mysqli_error());
$row_rs_ProgramToEdit = mysqli_fetch_assoc($rs_ProgramToEdit);
$totalRows_rs_ProgramToEdit = mysqli_num_rows($rs_ProgramToEdit);

$Currenthh1=substr($row_rs_ProgramToEdit['StartTime'],0,2);
$Currentmm1=substr($row_rs_ProgramToEdit['StartTime'],3,2);
$Currentampm1=substr($row_rs_ProgramToEdit['StartTime'],6,2);
$Currenthh2=substr($row_rs_ProgramToEdit['EndTime'],0,2);
$Currentmm2=substr($row_rs_ProgramToEdit['EndTime'],3,2);
$Currentampm2=substr($row_rs_ProgramToEdit['EndTime'],6,2);
$CurrentHijriYear = $row_rs_ProgramToEdit['HijriYear'];
$CurrentCountry = $row_rs_ProgramToEdit['Country'];
$CurrentRegion = $row_rs_ProgramToEdit['Region'];
$CurrentCityTown = $row_rs_ProgramToEdit['CityTown'];
$CurrentPlaceId = $row_rs_ProgramToEdit['PlaceId'];
$CurrentProgramContacts = $row_rs_ProgramToEdit['ProgramContacts'];

mysqli_select_db($connDoraTarjumaQuran, $database_connDoraTarjumaQuran);
$query_rs_ProgramType = "SELECT * FROM programtype pt WHERE pt.ProgramTypeId=(select pr.ProgramTypeId from Program pr where pr.ProgramId=".$ProgramToEdit.")";
$rs_ProgramType = mysqli_query($connDoraTarjumaQuran, $query_rs_ProgramType) or die(mysqli_error());
$row_rs_ProgramType = mysqli_fetch_assoc($rs_ProgramType);
$totalRows_rs_ProgramType = mysqli_num_rows($rs_ProgramType);

mysqli_select_db($connDoraTarjumaQuran, $database_connDoraTarjumaQuran);
$query_rs_CurrentSpeakers = "SELECT u.UserId, CONCAT_WS(' ', u.Prefix, u.FirstName, u.LastName,'(', u.CityTown, ')') as FullName FROM user u join program_speaker ps WHERE u.UserId=ps.UserId and u.Mutarjim=1 and ps.ProgramId=".$ProgramToEdit;
$rs_CurrentSpeakers = mysqli_query($connDoraTarjumaQuran, $query_rs_CurrentSpeakers) or die(mysqli_error());
$totalRows_rs_CurrentSpeakers = mysqli_num_rows($rs_CurrentSpeakers);
$CurrentSpeaker=array();$s=0;
while ($row_rs_CurrentSpeakers = mysqli_fetch_assoc($rs_CurrentSpeakers))
{
	$CurrentSpeaker[$s]=$row_rs_CurrentSpeakers['UserId'];$s++;
} 

mysqli_select_db($connDoraTarjumaQuran, $database_connDoraTarjumaQuran);
$query_rs_CurrentHuffaz = "SELECT u.UserId, CONCAT_WS(' ', u.Prefix, u.FirstName, u.LastName,'(', u.CityTown, ')') as FullName FROM user u join program_hafiz ps WHERE u.UserId=ps.UserId and u.Hafiz=1 and ps.ProgramId=".$ProgramToEdit;
$rs_CurrentHuffaz = mysqli_query($connDoraTarjumaQuran, $query_rs_CurrentHuffaz) or die(mysqli_error());
$totalRows_rs_CurrentHuffaz = mysqli_num_rows($rs_CurrentHuffaz);
$CurrentHafiz=array();$s=0;
while ($row_rs_CurrentHuffaz = mysqli_fetch_assoc($rs_CurrentHuffaz))
{
$CurrentHafiz[$s]=$row_rs_CurrentHuffaz['UserId'];$s++;
} 

mysqli_select_db($connDoraTarjumaQuran, $database_connDoraTarjumaQuran);
$query_rs_CurrentOrganizers = "SELECT u.UserId, CONCAT_WS(' ', u.Prefix, u.FirstName, u.LastName,'(', u.CityTown, ')') as FullName FROM user u join program_organizer ps WHERE u.UserId=ps.UserId and u.Management=1 and ps.ProgramId=".$ProgramToEdit;
$rs_CurrentOrganizers = mysqli_query($connDoraTarjumaQuran, $query_rs_CurrentOrganizers) or die(mysqli_error());
$totalRows_rs_CurrentOrganizers = mysqli_num_rows($rs_CurrentOrganizers);
$CurrentOrganizer=array();$s=0;
while ($row_rs_CurrentOrganizers = mysqli_fetch_assoc($rs_CurrentOrganizers))
{
$CurrentOrganizer[$s]=$row_rs_CurrentOrganizers['UserId'];$s++;
} 
/////////////////////////////////////////////////////////////////////////////////
//////////////////////Entries to choose from/////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////
mysqli_select_db($connDoraTarjumaQuran, $database_connDoraTarjumaQuran);
$query_rs_Speakers = "SELECT u.UserId, CONCAT_WS(' ', u.Prefix, u.FirstName, u.LastName,'(', u.CityTown, ')') as FullName FROM user u WHERE u.Mutarjim=1 order by FullName";
$rs_Speakers = mysqli_query($connDoraTarjumaQuran, $query_rs_Speakers) or die(mysqli_error());
$row_rs_Speakers = mysqli_fetch_assoc($rs_Speakers);
$totalRows_rs_Speakers = mysqli_num_rows($rs_Speakers);

mysqli_select_db($connDoraTarjumaQuran, $database_connDoraTarjumaQuran);
$query_rs_Huffaz = "SELECT u.UserId, CONCAT_WS(' ', u.Prefix, u.FirstName, u.LastName,'(', u.CityTown, ')') as FullName FROM user u WHERE u.Hafiz=1 order by FullName";
$rs_Huffaz = mysqli_query($connDoraTarjumaQuran, $query_rs_Huffaz) or die(mysqli_error());
$row_rs_Huffaz = mysqli_fetch_assoc($rs_Huffaz);
$totalRows_rs_Huffaz = mysqli_num_rows($rs_Huffaz);

mysqli_select_db($connDoraTarjumaQuran, $database_connDoraTarjumaQuran);
$query_rs_Organizers = "SELECT u.UserId, CONCAT_WS(' ', u.Prefix, u.FirstName, u.LastName,'(', u.CityTown, ')') as FullName FROM user u WHERE u.Management=1 order by FullName";
$rs_Organizers = mysqli_query($connDoraTarjumaQuran, $query_rs_Organizers) or die(mysqli_error());
$row_rs_Organizers = mysqli_fetch_assoc($rs_Organizers);
$totalRows_rs_Organizers = mysqli_num_rows($rs_Organizers);

mysqli_select_db($connDoraTarjumaQuran, $database_connDoraTarjumaQuran);
$query_rs_Year = "SELECT distinct(pr.HijriYear), pr.Year FROM program pr order by pr.HijriYear desc";
$rs_Year = mysqli_query($connDoraTarjumaQuran, $query_rs_Year) or die(mysqli_error());
$row_rs_Year = mysqli_fetch_assoc($rs_Year);
$totalRows_rs_Year = mysqli_num_rows($rs_Year);

mysqli_select_db($connDoraTarjumaQuran, $database_connDoraTarjumaQuran);
$query_rs_Country = "SELECT distinct(pl.Country) FROM place pl";
$rs_Country = mysqli_query($connDoraTarjumaQuran, $query_rs_Country) or die(mysqli_error());
$row_rs_Country = mysqli_fetch_assoc($rs_Country);
$totalRows_rs_Country = mysqli_num_rows($rs_Country);

mysqli_select_db($connDoraTarjumaQuran, $database_connDoraTarjumaQuran);
$query_rs_Region = "SELECT distinct(pl.Region) FROM place pl WHERE pl.Country='".$CurrentCountry."'";
$rs_Region = mysqli_query($connDoraTarjumaQuran, $query_rs_Region) or die(mysqli_error());
$row_rs_Region = mysqli_fetch_assoc($rs_Region);
$totalRows_rs_Region = mysqli_num_rows($rs_Region);

mysqli_select_db($connDoraTarjumaQuran, $database_connDoraTarjumaQuran);
$query_rs_CityTown = "SELECT distinct(CityTown) FROM place where Region='".$CurrentRegion."' order by CityTown";
$rs_CityTown = mysqli_query($connDoraTarjumaQuran, $query_rs_CityTown) or die(mysqli_error());
$row_rs_CityTown = mysqli_fetch_assoc($rs_CityTown);
$totalRows_rs_CityTown = mysqli_num_rows($rs_CityTown);

mysqli_select_db($connDoraTarjumaQuran, $database_connDoraTarjumaQuran);
$query_rs_Place = "SELECT distinct(pl.PlaceId), pl.PlaceTypeId, pl.Address FROM place pl join placetype pt WHERE pl.PlaceTypeId=pt.PlaceTypeId and pl.CityTown='".$CurrentCityTown."' order by pl.Address";
$rs_Place = mysqli_query($connDoraTarjumaQuran, $query_rs_Place) or die(mysqli_error());
$row_rs_Place = mysqli_fetch_assoc($rs_Place);
$totalRows_rs_Place = mysqli_num_rows($rs_Place);	

mysqli_select_db($connDoraTarjumaQuran, $database_connDoraTarjumaQuran);
$query_rs_Language = "SELECT l.LanguageId, l.Language FROM language l";
$rs_Language = mysqli_query($connDoraTarjumaQuran, $query_rs_Language) or die(mysqli_error());
$row_rs_Language = mysqli_fetch_assoc($rs_Language);
$totalRows_rs_Language = mysqli_num_rows($rs_Language);

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
$year=$_POST['HijriYear']+579;
if($_POST['HijriYear']<1418)$year++;
  $insertSQL = sprintf("update program set HijriYear=%s, Year=%s, PlaceId=%s, ProgramTypeId=(select ProgramTypeId from programtype where mode=%s and translation=%s and time=%s and gender=%s), LanguageId=%s, StartTime=%s, EndTime=%s, MinimumDuration=%s, MaximumDuration=%s, MinimumGents=%s, MaximumGents=%s, MinimumLadies=%s, MaximumLadies=%s, ProgramDetails=%s, ProgramContacts=%s where ProgramId=%s",
                       GetSQLValueString($_POST['HijriYear'], "int"),
					   $year,
                       GetSQLValueString($_POST['PlaceId'], "int"),
					   GetSQLValueString($_POST['Mode'], "text"),
					   GetSQLValueString($_POST['Translation'], "text"),
					   GetSQLValueString($_POST['Time'], "text"),
					   GetSQLValueString($_POST['Gender'], "text"),
                       GetSQLValueString($_POST['LanguageId'], "int"),
					   GetSQLValueString($_POST['hh1'].":".$_POST['mm1']." ".$_POST['ampm1'], "text"),
					   GetSQLValueString($_POST['hh2'].":".$_POST['mm2']." ".$_POST['ampm2'], "text"),			   					   
                       GetSQLValueString($_POST['MinimumDuration'], "double"),
                       GetSQLValueString($_POST['MaximumDuration'], "double"),
                       GetSQLValueString($_POST['MinimumGents'], "int"),
                       GetSQLValueString($_POST['MaximumGents'], "int"),
                       GetSQLValueString($_POST['MinimumLadies'], "int"),
                       GetSQLValueString($_POST['MaximumLadies'], "int"),
                       GetSQLValueString($_POST['ProgramDetails'], "text"),
					   GetSQLValueString($_POST['ProgramContacts'], "text"),
					   $ProgramToEdit);
  	
	mysqli_select_db($connDoraTarjumaQuran, $database_connDoraTarjumaQuran);
  	$Result1 = mysqli_query($insertSQL) or die(mysqli_error());
	
	$deletequery="delete from program_speaker where ProgramId=".$ProgramToEdit;
	mysqli_select_db($connDoraTarjumaQuran, $database_connDoraTarjumaQuran);
	$Result1 = mysqli_query($deletequery) or die(mysqli_error());
	$deletequery="delete from program_hafiz where ProgramId=".$ProgramToEdit;
	mysqli_select_db($connDoraTarjumaQuran, $database_connDoraTarjumaQuran);
	$Result1 = mysqli_query($deletequery) or die(mysqli_error());
	$deletequery="delete from program_organizer where ProgramId=".$ProgramToEdit;
	mysqli_select_db($connDoraTarjumaQuran, $database_connDoraTarjumaQuran);
	$Result1 = mysqli_query($deletequery) or die(mysqli_error());
	
if($_POST['Mode']!='Video')	{
$prid=$ProgramToEdit;
	$s1=$_POST['Speaker1'];
	$s2=$_POST['Speaker2'];
	$s3=$_POST['Speaker3'];
	$h1=$_POST['Hafiz1'];
	$h2=$_POST['Hafiz2'];
	$h3=$_POST['Hafiz3'];
	$o1=$_POST['Organizer1'];
	$o2=$_POST['Organizer2'];
	$o3=$_POST['Organizer3'];
	
$insertSQL=sprintf("INSERT INTO program_speaker(ProgramId, UserId) VALUES (%s, %s)", $prid, $s1);
if($s1>0)
{
	if(($s2!=$s1)and($s2>0))
	$insertSQL .= sprintf(",(%s, %s)", $prid, $s2);
	if(($s3!=$s1)and($s3!=$s2)and($s3>0))
	$insertSQL .= sprintf(",(%s, %s)", $prid, $s3);
}	
mysqli_select_db($connDoraTarjumaQuran, $database_connDoraTarjumaQuran);
$Result1 = mysqli_query($insertSQL) or die(mysqli_error());
	
$insertSQL=sprintf("INSERT INTO program_hafiz(ProgramId, UserId) VALUES (%s, %s)", $prid, $h1);
if($h1>0)
{
	if(($h2!=$h1)and($h2>0))
	$insertSQL .= sprintf(",(%s, %s)", $prid, $h2);
	if(($h3!=$h1)and($h3!=$h2)and($h3>0))
	$insertSQL .= sprintf(",(%s, %s)", $prid, $h3);
}	
mysqli_select_db($connDoraTarjumaQuran, $database_connDoraTarjumaQuran);
$Result1 = mysqli_query($insertSQL) or die(mysqli_error());

$insertSQL=sprintf("INSERT INTO program_organizer(ProgramId, UserId) VALUES (%s, %s)", $prid, $o1);
if($o1>0)
{
	if(($o2!=$o1)and($o2>0))
	$insertSQL .= sprintf(",(%s, %s)", $prid, $o2);
	if(($o3!=$o1)and($o3!=$o2)and($o3>0))
	$insertSQL .= sprintf(",(%s, %s)", $prid, $o3);
}	
mysqli_select_db($connDoraTarjumaQuran, $database_connDoraTarjumaQuran);
$Result1 = mysqli_query($insertSQL) or die(mysqli_error());
}
	
	$insertGoTo = "selectprogram.php";
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
	function getScriptPage(ce)
	{
		div_id = 'output_div0';
		co=document.getElementById('Country').value;
		re=document.getElementById('Region').value;
		ci=document.getElementById('CityTown').value;
		reqstr="script_newprogram.php?co="+escape(co)+"&re="+escape(re)+"&ci="+escape(ci)+"&ce="+escape(ce);
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
<title>Edit information related to Dora Tarjuma Quran Program</title>
<?php include("header.php"); ?>
<?php include("adminquicklinks.php");?>
</head><body bgcolor="#669933">
<form method="post" name="form1" action="<?php echo $editFormAction; ?>">
  <table align="center" width="800" border="1" cellpadding="0" bgcolor="#CCEEAA"  cellspacing="0">
  <tr><td align="left"><h1 align="center">Edit Program <?php echo $ProgramToEdit ?></h1></td></tr>
    <tr><td><table bgcolor="#CCEEAA"><tr valign="baseline">
      <td nowrap align="right">Year:</td>
      <td><select id='HijriYear' name='HijriYear' style="width=150">
        <?php do { ?>
        <option value="<?php echo $row_rs_Year['HijriYear']?>"<?php if ($row_rs_Year['HijriYear']==$CurrentHijriYear) {echo "selected=\"selected\"";} ?>><?php echo $row_rs_Year['HijriYear']." H (".$row_rs_Year['Year']." AD)";?></option>
        <?php } while ($row_rs_Year = mysqli_fetch_assoc($rs_Year));
  $rows = mysqli_num_rows($rs_Year);
  if($rows > 0) {
      mysqli_data_seek($rs_Year, 0);
	  $row_rs_Year = mysqli_fetch_assoc($rs_Year);
  } ?>
      </select></td>
    </tr></table></td></tr><tr><td>
	<div id="output_div0" align="left">
<table align="left">
<tr valign="baseline"><td nowrap align="right">Country</td><td nowrap align="left"><select id='Country' name='Country' onChange = getScriptPage('cn') style="width=150">
<?php do {  
if($row_rs_Country['Country']!="Other"){
echo "<option value=\"".$row_rs_Country['Country']."\" "; 
if(!(strcmp($row_rs_Country['Country'], $CurrentCountry))) {echo "selected=\"selected\"";} 
echo">".$row_rs_Country['Country']."</option>";}
} while ($row_rs_Country = mysqli_fetch_assoc($rs_Country));
$rows = mysqli_num_rows($rs_Country);
if($rows > 0) {
mysqli_data_seek($rs_Country, 0);
$row_rs_Country = mysqli_fetch_assoc($rs_Country);
}?>
<option id='Other' name='Other'>Other</option></select></td></tr>
<tr valign="baseline">
<td nowrap align="right">Region</td><td nowrap align="left"><select id='Region' name='Region' onchange = getScriptPage('re') style="width=150">
<?php
do {  
?>
<option value="<?php echo $row_rs_Region['Region']?>"<?php if (!(strcmp($row_rs_Region['Region'], $CurrentRegion))) {echo "selected=\"selected\"";} ?>><?php echo $row_rs_Region['Region']?></option>
<?php
} while ($row_rs_Region = mysqli_fetch_assoc($rs_Region));
$rows = mysqli_num_rows($rs_Region);
if($rows > 0) {
mysqli_data_seek($rs_Region, 0);
$row_rs_Region = mysqli_fetch_assoc($rs_Region);
}
?>
<option id='Other' name='Other'>Other</option></select></td></tr>
<tr valign="baseline">
<td nowrap align="right">CityTown</td><td nowrap align="left"><select id='CityTown' name='CityTown' onchange = getScriptPage('ct') style="width=150">
<?php do { ?>
<option value="<?php echo $row_rs_CityTown['CityTown']?>"<?php if (!(strcmp($row_rs_CityTown['CityTown'], $CurrentCityTown))) {echo "selected=\"selected\"";} ?>><?php echo $row_rs_CityTown['CityTown']?></option>
<?php
} while ($row_rs_CityTown = mysqli_fetch_assoc($rs_CityTown));
$rows = mysqli_num_rows($rs_CityTown);
if($rows > 0) {
mysqli_data_seek($rs_CityTown, 0);
$row_rs_CityTown = mysqli_fetch_assoc($rs_CityTown);
}?>
<option id='Other' name='Other'>Other</option></select></td></tr>
<tr valign="baseline">
<td nowrap align="right">Place(s)</td><td nowrap align="left"><select id='PlaceId' name='PlaceId' style="width:700; max-width:700">
<?php do { ?>
<option value="<?php echo $row_rs_Place['PlaceId']?>"<?php if($CurrentPlaceId==$row_rs_Place['PlaceId']) echo 'selected="selected"';?>><?php echo $row_rs_Place['Address']?></option>
<?php
} while ($row_rs_Place = mysqli_fetch_assoc($rs_Place));
$rows = mysqli_num_rows($rs_Place);
if($rows > 0) {
mysqli_data_seek($rs_Place, 0);
$row_rs_Place = mysqli_fetch_assoc($rs_Place);
}?>
</select><br  /><a href="newplace.php">Click here</a>
	  to add a new place not listed here.</td>
</tr>
</table></div></td></tr>
<tr><td>
  <table align="center">
  <tr valign="baseline">
      <td nowrap align="right">Program Contacts:</td>
      <td><input type="text" name="ProgramContacts" size="70" maxlength="70" value="<?php echo $CurrentProgramContacts; ?>" /><br  />
      Please do include country code and/or city code  e.g(+92-21-2239849, +92-334-3380785)</td>
</tr>
	<tr valign="baseline">
      <td nowrap align="right">Start Time:</td>
      <td>
          <select id='hh1' name='hh1'><?php $hour=1;do { ?>
        <option value="<?php if($hour<10)echo "0"; echo $hour;?>"<?php if ($hour==$Currenthh1){echo "selected=\"selected\"";} ?>><?php echo $hour;?></option>
        <?php $hour++;} while ($hour<13);?>
          </select>
      
          <select id='mm1' name='mm1'><?php $minute=0;do { ?>
        <option value="<?php if($minute<10)echo "0";echo $minute;?>"<?php if ($minute==$Currentmm1){echo "selected=\"selected\"";} ?>><?php echo $minute;?></option>
        <?php $minute+=5;} while ($minute<56);?>
		</select>
     
          <select id='ampm1' name="ampm1">
		  <option value="am" <?php if(!strcmp($Currentampm1,"am")) echo "selected=\"selected\"";?>>am</option>
		  <option value="pm" <?php if(!strcmp($Currentampm1,"pm")) echo "selected=\"selected\"";?>>pm</option>
          </select> 
          (this needs to be accurate)</td>
    </tr>
	<tr valign="baseline">
      <td nowrap align="right">End Time:</td>
      <td>
          <select id='hh2' name='hh2'><?php $hour=1;do { ?>
        <option value="<?php if($hour<10)echo "0"; echo $hour;?>"<?php if ($hour==$Currenthh2){echo "selected=\"selected\"";} ?>><?php echo $hour;?></option>
        <?php $hour++;} while ($hour<13);?>
          </select>
      
          <select id='mm2' name='mm2'><?php $minute=0;do { ?>
        <option value="<?php if($minute<10)echo "0";echo $minute;?>"<?php if ($minute==$Currentmm2){echo "selected=\"selected\"";} ?>><?php echo $minute;?></option>
        <?php $minute+=5;} while ($minute<56);?>
		</select>
     
          <select id='ampm2' name="ampm2">
		  <option value="am" <?php if(!strcmp($Currentampm2,"am")) echo "selected=\"selected\"";?>>am</option>
		  <option value="pm" <?php if(!strcmp($Currentampm2,"pm")) echo "selected=\"selected\"";?>>pm</option>
          </select> 
          (estimated time will work)      </td>
    </tr><tr valign="baseline">
      <td nowrap="nowrap" align="right">Duration:</td>
	  <td><label>Minimum<input name="MinimumDuration" type="text" value="<?php echo $row_rs_ProgramToEdit['MinimumDuration'];?>" size="5" />hrs</label> <label>Maximum<input type="text" name="MaximumDuration" value="<?php echo $row_rs_ProgramToEdit['MaximumDuration'];?>" size="5" />hrs</label></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Program Mode:</td>
      <td>
        <label>
          <input <?php if (!(strcmp($row_rs_ProgramType['Mode'],"Live"))) {echo "checked=\"checked\"";} ?> name="Mode" type="radio" value="Live" checked="checked"/>
          Live</label>
        <label>
          <input <?php if (!(strcmp($row_rs_ProgramType['Mode'],"Video"))) {echo "checked=\"checked\"";} ?> type="radio" name="Mode" value="Video"/>
          Video</label>     </td>
    </tr>
	 <tr valign="baseline">
      <td nowrap align="right">Translation:</td>
      <td>
        <label>
          <input <?php if (!(strcmp($row_rs_ProgramType['Translation'],"Complete"))) {echo "checked=\"checked\"";} ?> name="Translation" type="radio" value="Complete" checked="checked" />
          Complete</label>
        <label>
          <input <?php if (!(strcmp($row_rs_ProgramType['Translation'],"Summary"))) {echo "checked=\"checked\"";} ?> type="radio" name="Translation" value="Summary" />
          Summary</label>     </td>
	 </tr>
	 <tr valign="baseline">
      <td nowrap align="right">Program Time:</td>
      <td>
        <label>
          <input <?php if (!(strcmp($row_rs_ProgramType['Time'],"After Isha (With Taravih)"))) {echo "checked=\"checked\"";} ?> name="Time" type="radio" value="After Isha (With Taravih)" checked="checked" />
          After Isha (With Taravih)</label>
        <label>
          <input <?php if (!(strcmp($row_rs_ProgramType['Time'],"After Taravih"))) {echo "checked=\"checked\"";} ?> type="radio" name="Time" value="After Taravih" />
          After Taravih</label>
		  <label>
          <input <?php if (!(strcmp($row_rs_ProgramType['Time'],"Other"))) {echo "checked=\"checked\"";} ?> type="radio" name="Time" value="Other" />
          Other</label>     </td>
	 </tr>
	 <tr valign="baseline">
      <td nowrap align="right">Program For:</td>
      <td>
         <label>
          <input <?php if (!(strcmp($row_rs_ProgramType['Gender'],"Men and Women"))) {echo "checked=\"checked\"";} ?> name="Gender" type="radio" value="Men and Women" checked="checked" />
          Men and Women</label>
		  <label>
          <input <?php if (!(strcmp($row_rs_ProgramType['Gender'],"Men Only"))) {echo "checked=\"checked\"";} ?> type="radio" name="Gender" value="Men Only" />
          Men Only</label>
        <label>
          <input <?php if (!(strcmp($row_rs_ProgramType['Gender'],"Women Only"))) {echo "checked=\"checked\"";} ?> type="radio" name="Gender" value="Women Only" />
          Women Only</label>     </td>
	 </tr>
    <tr valign="baseline">
      <td nowrap align="right">Language:</td>
      <td><select name="LanguageId">
        <?php do { ?>
		<option value="<?php echo $row_rs_Language['LanguageId'];?>"<?php if ($row_rs_Language['LanguageId']==$row_rs_ProgramToEdit['LanguageId']) {echo "selected=\"selected\"";} ?>><?php echo $row_rs_Language['Language'];?></option>
          <?php
} while ($row_rs_Language = mysqli_fetch_assoc($rs_Language));
  $rows = mysqli_num_rows($rs_Language);
  if($rows > 0) {
      mysqli_data_seek($rs_Language, 0);
	  $row_rs_Language = mysqli_fetch_assoc($rs_Language);
  }?>
      </select>      </td>
    </tr>
	 <tr valign="baseline">
      <td nowrap align="right">Speaker(s):</td>
      <td>1<select name="Speaker1"><option value="0"></option>
        <?php do { ?>
        <option value="<?php echo $row_rs_Speakers['UserId'];?>" <?php if((isset($CurrentSpeaker[0]))and($CurrentSpeaker[0]==$row_rs_Speakers['UserId'])) echo "selected=\"selected\"";?>><?php echo $row_rs_Speakers['FullName'];?></option>
        <?php
} while ($row_rs_Speakers = mysqli_fetch_assoc($rs_Speakers));
  $rows = mysqli_num_rows($rs_Speakers);
  if($rows > 0) {
      mysqli_data_seek($rs_Speakers, 0);
	  $row_rs_Speakers = mysqli_fetch_assoc($rs_Speakers);
  }?>
      </select><br  />2<select name="Speaker2"><option value="0"></option>
        <?php do { ?>
        <option value="<?php echo $row_rs_Speakers['UserId'];?>" <?php if((isset($CurrentSpeaker[1]))and($CurrentSpeaker[1]==$row_rs_Speakers['UserId'])) echo "selected=\"selected\"";?>><?php echo $row_rs_Speakers['FullName'];?></option>
        <?php
} while ($row_rs_Speakers = mysqli_fetch_assoc($rs_Speakers));
  $rows = mysqli_num_rows($rs_Speakers);
  if($rows > 0) {
      mysqli_data_seek($rs_Speakers, 0);
	  $row_rs_Speakers = mysqli_fetch_assoc($rs_Speakers);
  }?>
      </select><br  />3<select name="Speaker3">
        <option value="0"></option>
        <?php do { ?>
        <option value="<?php echo $row_rs_Speakers['UserId'];?>" <?php if((isset($CurrentSpeaker[2]))and($CurrentSpeaker[2]==$row_rs_Speakers['UserId'])) echo "selected=\"selected\"";?>><?php echo $row_rs_Speakers['FullName'];?></option>
        <?php
} while ($row_rs_Speakers = mysqli_fetch_assoc($rs_Speakers));
  $rows = mysqli_num_rows($rs_Speakers);
  if($rows > 0) {
      mysqli_data_seek($rs_Speakers, 0);
	  $row_rs_Speakers = mysqli_fetch_assoc($rs_Speakers);
  }?>
      </select>      </td>
	 </tr>
	<tr valign="baseline">
      <td nowrap align="right">Huffaz:</td>
      <td>1<select name="Hafiz1"><option value="0"></option>
        <?php do { ?>
        <option value="<?php echo $row_rs_Huffaz['UserId'];?>" <?php if((isset($CurrentHafiz[0]))and($CurrentHafiz[0]==$row_rs_Huffaz['UserId'])) echo "selected=\"selected\"";?>><?php echo $row_rs_Huffaz['FullName'];?></option>
        <?php
} while ($row_rs_Huffaz = mysqli_fetch_assoc($rs_Huffaz));
  $rows = mysqli_num_rows($rs_Huffaz);
  if($rows > 0) {
      mysqli_data_seek($rs_Huffaz, 0);
	  $row_rs_Huffaz = mysqli_fetch_assoc($rs_Huffaz);
  }?>
      </select><br  />2<select name="Hafiz2">
          <option value="0"></option>
          <?php do { ?>
          <option value="<?php echo $row_rs_Huffaz['UserId'];?>" <?php if((isset($CurrentHafiz[1]))and($CurrentHafiz[1]==$row_rs_Huffaz['UserId'])) echo "selected=\"selected\"";?>><?php echo $row_rs_Huffaz['FullName'];?></option>
          <?php
} while ($row_rs_Huffaz = mysqli_fetch_assoc($rs_Huffaz));
  $rows = mysqli_num_rows($rs_Huffaz);
  if($rows > 0) {
      mysqli_data_seek($rs_Huffaz, 0);
	  $row_rs_Huffaz = mysqli_fetch_assoc($rs_Huffaz);
  }?>
        </select><br  />3<select name="Hafiz3"><option value="0"></option>
        <?php do { ?>
        <option value="<?php echo $row_rs_Huffaz['UserId'];?>" <?php if((isset($CurrentHafiz[2]))and($CurrentHafiz[2]==$row_rs_Huffaz['UserId'])) echo "selected=\"selected\"";?>><?php echo $row_rs_Huffaz['FullName'];?></option>
        <?php
} while ($row_rs_Huffaz = mysqli_fetch_assoc($rs_Huffaz));
  $rows = mysqli_num_rows($rs_Huffaz);
  if($rows > 0) {
      mysqli_data_seek($rs_Huffaz, 0);
	  $row_rs_Huffaz = mysqli_fetch_assoc($rs_Huffaz);
  }?>
      </select></td>
    </tr>
	<tr valign="baseline">
      <td nowrap align="right">Contact Person(s):</td>
      <td>1<select name="Organizer1"><option value="0"></option>
        <?php do { ?>
        <option value="<?php echo $row_rs_Organizers['UserId'];?>" <?php if((isset($CurrentOrganizer[0]))and($CurrentOrganizer[0]==$row_rs_Organizers['UserId'])) echo "selected=\"selected\"";?>><?php echo $row_rs_Organizers['FullName'];?></option>
        <?php
} while ($row_rs_Organizers = mysqli_fetch_assoc($rs_Organizers));
  $rows = mysqli_num_rows($rs_Organizers);
  if($rows > 0) {
      mysqli_data_seek($rs_Organizers, 0);
	  $row_rs_Organizers = mysqli_fetch_assoc($rs_Organizers);
  }?>
      </select><br  />2<select name="Organizer2"><option value="0"></option>
        <?php do { ?>
        <option value="<?php echo $row_rs_Organizers['UserId'];?>" <?php if((isset($CurrentOrganizer[1]))and($CurrentOrganizer[1]==$row_rs_Organizer['UserId'])) echo "selected=\"selected\"";?>><?php echo $row_rs_Organizers['FullName'];?></option>
        <?php
} while ($row_rs_Organizers = mysqli_fetch_assoc($rs_Organizers));
  $rows = mysqli_num_rows($rs_Organizers);
  if($rows > 0) {
      mysqli_data_seek($rs_Organizers, 0);
	  $row_rs_Organizers = mysqli_fetch_assoc($rs_Organizers);
  }?>
      </select><br  />3<select name="Organizer3"><option value="0"></option>
        <?php do { ?>
        <option value="<?php echo $row_rs_Organizers['UserId'];?>" <?php if((isset($CurrentOrganizer[2]))and($CurrentOrganizer[2]==$row_rs_Organizer['UserId'])) echo "selected=\"selected\"";?>><?php echo $row_rs_Organizers['FullName'];?></option>
        <?php
} while ($row_rs_Organizers = mysqli_fetch_assoc($rs_Organizers));
  $rows = mysqli_num_rows($rs_Organizers);
  if($rows > 0) {
      mysqli_data_seek($rs_Organizers, 0);
	  $row_rs_Organizers = mysqli_fetch_assoc($rs_Organizers);
  }?>
      </select></td>
    <tr><td nowrap align="right"><strong>Note</strong></td>
	  <td>If you dont find the concerned persons listed ask them to sign up on this site.</td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right"><strong>Attendance</strong></td>
      <td>Write expected figures if the program is yet to be held or currently in progress.</td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Gents:</td>
      <td>Minimum<input type="text" name="MinimumGents" value="<?php echo $row_rs_ProgramToEdit['MinimumGents'];?>" size="6">Maximum<input type="text" name="MaximumGents" value="<?php echo $row_rs_ProgramToEdit['MaximumGents'];?>" size="6" /></td>
    </tr>
    
    <tr valign="baseline">
      <td nowrap align="right">Ladies:</td>
      <td>Minimum<input type="text" name="MinimumLadies" value="<?php echo $row_rs_ProgramToEdit['MinimumLadies'];?>" size="6">Maximum<input type="text" name="MaximumLadies" value="<?php echo $row_rs_ProgramToEdit['MaximumLadies'];?>" size="6">     </td>
    </tr>
    
    <tr valign="baseline">
      <td nowrap align="right"> Detailed Note:</td>
      <td><textarea name="ProgramDetails" cols="50" rows="5"><?php echo $row_rs_ProgramToEdit['ProgramDetails']; ?></textarea></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">&nbsp;</td>
      <td><input type="submit" value="Update Program">
		<input name="Reset" type="reset" onClick="" value="Reset">
        <a href="index.php">Cancel</a></td>
    </tr>
  </table></td></tr></table>
  <input type="hidden" name="MM_insert" value="form1">
</form>
</body>
<?php include("footer.php"); ?>
</html>
<?php
mysqli_free_result($rs_ProgramToEdit);
mysqli_free_result($rs_Year);
mysqli_free_result($rs_Country);
mysqli_free_result($rs_Region);
mysqli_free_result($rs_CityTown);
mysqli_free_result($rs_Place);
mysqli_free_result($rs_Language);
mysqli_free_result($rs_ProgramType);
mysqli_free_result($rs_Organizers);
mysqli_free_result($rs_Speakers);
mysqli_free_result($rs_Huffaz);
mysqli_free_result($rs_CurrentOrganizers);
mysqli_free_result($rs_CurrentSpeakers);
mysqli_free_result($rs_CurrentHuffaz);
?>