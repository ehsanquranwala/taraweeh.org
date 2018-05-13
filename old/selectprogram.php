<?php require_once('Connections/connDoraTarjumaQuran.php'); ?>
<?php require_once('Connections/connDoraTarjumaQuran.php');

$DefaultYear = 1429;
$DefaultCountry = "Pakistan";
$DefaultRegion = "Punjab";
$DefaultCityTown = "Lahore";
if(!isset($_SESSION)) session_start();	
if(isset($_SESSION['Region'])) $DefaultRegion = $_SESSION['Region'];
if(isset($_SESSION['CityTown'])) $DefaultCityTown = $_SESSION['CityTown'];
	
mysqli_select_db($connDoraTarjumaQuran, $database_connDoraTarjumaQuran);
$query_rs_Years = "SELECT distinct(pr.HijriYear), pr.Year FROM program pr order by pr.HijriYear desc";
$rs_Years = mysqli_query($connDoraTarjumaQuran, $query_rs_Years) or die(mysqli_error());
$row_rs_Years = mysqli_fetch_assoc($rs_Years);
$totalRows_rs_Years = mysqli_num_rows($rs_Years);
$hijriyear=$DefaultYear;//$row_rs_Years['HijriYear'];

mysqli_select_db($connDoraTarjumaQuran, $database_connDoraTarjumaQuran);
$query_rs_Country = "SELECT distinct(place.Country) FROM program join place WHERE program.PlaceId=place.PlaceId and program.HijriYear=".$hijriyear;
$rs_Country = mysqli_query($connDoraTarjumaQuran, $query_rs_Country) or die(mysqli_error());
$row_rs_Country = mysqli_fetch_assoc($rs_Country);
$totalRows_rs_Country = mysqli_num_rows($rs_Country);

mysqli_select_db($connDoraTarjumaQuran, $database_connDoraTarjumaQuran);
$query_rs_Region = "SELECT distinct(place.Region) FROM place join program WHERE place.PlaceId=program.PlaceId and program.HijriYear=".$hijriyear." and place.Country='".$DefaultCountry."'";
$rs_Region = mysqli_query($connDoraTarjumaQuran, $query_rs_Region) or die(mysqli_error());
$row_rs_Region = mysqli_fetch_assoc($rs_Region);
$totalRows_rs_Region = mysqli_num_rows($rs_Region);

mysqli_select_db($connDoraTarjumaQuran, $database_connDoraTarjumaQuran);
$query_rs_CityTown = "SELECT distinct(place.CityTown) FROM place join program WHERE place.PlaceId=program.PlaceId and program.HijriYear=".$hijriyear." and place.Region = '".$DefaultRegion."' order by place.CityTown";
$rs_CityTown = mysqli_query($connDoraTarjumaQuran, $query_rs_CityTown) or die(mysqli_error());
$row_rs_CityTown = mysqli_fetch_assoc($rs_CityTown);
$totalRows_rs_CityTown = mysqli_num_rows($rs_CityTown);

mysqli_select_db($connDoraTarjumaQuran, $database_connDoraTarjumaQuran);
$query_rs_Program = "SELECT pr.ProgramId, pl.Address FROM place pl join program pr WHERE pl.PlaceId=pr.PlaceId and pl.CityTown ='".$DefaultCityTown."' and pr.HijriYear=".$hijriyear." order by pl.Address";
$rs_Program = mysqli_query($connDoraTarjumaQuran, $query_rs_Program) or die(mysqli_error());
$totalRows_rs_Program = mysqli_num_rows($rs_Program);
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
		yr=document.getElementById('Year').value;
		co=document.getElementById('Country').value;
		re=document.getElementById('Region').value;
		ci=document.getElementById('CityTown').value;
		reqstr="script_selectprogram.php?yr="+escape(yr)+"&co="+escape(co)+"&re="+escape(re)+"&ci="+escape(ci)+"&ce="+escape(ce);
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
<title>Select a program of Dora Tarjuma Quran</title>

<style type="text/css">
<!--
.style1 {color: #FF0000}
-->
</style>
</head>
<?php include("header.php"); ?>
<?php include("adminquicklinks.php"); ?>
<body bgcolor="#669933">
<table align="center" width="800" border="1" cellpadding="0" bgcolor="#CCEEAA"  cellspacing="0">
<tr align="center">
  <td align="left"><h1 align="center">Select a Program to Edit</h1></td>
</tr>
<tr><td>
<table bgcolor="#CCEEAA">
<tr valign="baseline"><td width="82" align="right" nowrap>ProgramYear</td>
      <td width="41" align="left"  nowrap><select id='Year' name='Year' onchange = getScriptPage('yr') style="width=150">
        <?php do { ?>
        <option value="<?php echo $row_rs_Years['HijriYear']?>"<?php if ($row_rs_Years['HijriYear'] == $hijriyear) {echo "selected=\"selected\"";} ?>><?php echo $row_rs_Years['HijriYear']." H (".$row_rs_Years['Year']." AD)";?></option>
        <?php } while ($row_rs_Years = mysqli_fetch_assoc($rs_Years));
  $rows = mysqli_num_rows($rs_Years);
  if($rows > 0) {
      mysqli_data_seek($rs_Years, 0);
	  $row_rs_Years = mysqli_fetch_assoc($rs_Years);
  }?>
      </select></td></tr></table></td></tr><tr><td>
	<div id="output_div0" align="left">
	<table bgcolor="#CCEEAA">
	<tr valign="baseline"><td nowrap align="right">Country</td><td nowrap align="left"><select id='Country' name='Country' onChange = getScriptPage('co') style="width=150">
        <?php do {  
		if($row_rs_Country['Country']!="Other"){
        echo "<option value=\"".$row_rs_Country['Country']."\" "; 
		if(!(strcmp($row_rs_Country['Country'], $DefaultCountry))) {echo "selected=\"selected\"";} 
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
      <td nowrap align="right">Region</td><td nowrap align="left"><select id='Region' name='Region' onchange = getScriptPage('re') style="width=150">
        <?php
do {  
?>
        <option value="<?php echo $row_rs_Region['Region']?>"<?php if (!(strcmp($row_rs_Region['Region'], $DefaultRegion))) {echo "selected=\"selected\"";} ?>><?php echo $row_rs_Region['Region']?></option>
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
      <td nowrap align="right">CityTown</td><td nowrap align="left"><select id='CityTown' name='CityTown' onchange = getScriptPage('ci') style="width=150">
        <?php do { ?>
        <option value="<?php echo $row_rs_CityTown['CityTown']?>"<?php if (!(strcmp($row_rs_CityTown['CityTown'], $DefaultCityTown))) {echo "selected=\"selected\"";} ?>><?php echo $row_rs_CityTown['CityTown']?></option>
        <?php
} while ($row_rs_CityTown = mysqli_fetch_assoc($rs_CityTown));
echo "<option id='Other' name='Other'>Other</option>";
  $rows = mysqli_num_rows($rs_CityTown);
  if($rows > 0) {
      mysqli_data_seek($rs_CityTown, 0);
	  $row_rs_CityTown = mysqli_fetch_assoc($rs_CityTown);
  }?>
      </select></td></tr>
  <tr><th scope=\"col\" align="left">ProgramId</th><th scope=\"col\" align="left">Program(s) in <?php echo $DefaultCityTown;?></th></tr>
    <?php while ($row_rs_Program = mysqli_fetch_assoc($rs_Program)){ ?>
    <tr valign="baseline"><td nowrap align="right"><?php echo $row_rs_Program['ProgramId'];?></td><td nowrap align="left"><a href="editprogram.php?prid=<?php echo $row_rs_Program['ProgramId']; ?>"><?php echo $row_rs_Program['Address'];?></a></td></tr>
    <?php } ?>
	</table>
	</div>
	</td></tr></table>
</body>
<?php include("footer.php"); ?>
</html>
<?php 
mysqli_free_result($rs_Years);
mysqli_free_result($rs_Country);
mysqli_free_result($rs_Region);
mysqli_free_result($rs_CityTown);
mysqli_free_result($rs_Program);
?>