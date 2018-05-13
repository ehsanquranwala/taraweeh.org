<?php require_once('Connections/connDoraTarjumaQuran.php'); ?>
<?php require_once('Connections/connDoraTarjumaQuran.php'); 

$DefaultHijriYear=1428;
$DefaultCountry = "Pakistan";
$DefaultRegion = "Punjab";
$DefaultCityTown = "Lahore";
$DefaultPlaceId = 37;

mysqli_select_db($connDoraTarjumaQuran, $database_connDoraTarjumaQuran);
$query_rs_Country = "SELECT distinct(place.Country) FROM place";
$rs_Country = mysqli_query($connDoraTarjumaQuran, $query_rs_Country) or die(mysqli_error());
$row_rs_Country = mysqli_fetch_assoc($rs_Country);
$totalRows_rs_Country = mysqli_num_rows($rs_Country);

mysqli_select_db($connDoraTarjumaQuran, $database_connDoraTarjumaQuran);
$query_rs_Region = "SELECT distinct(place.Region) FROM place WHERE place.Country='".$DefaultCountry."'";
$rs_Region = mysqli_query($connDoraTarjumaQuran, $query_rs_Region) or die(mysqli_error());
$row_rs_Region = mysqli_fetch_assoc($rs_Region);
$totalRows_rs_Region = mysqli_num_rows($rs_Region);

mysqli_select_db($connDoraTarjumaQuran, $database_connDoraTarjumaQuran);
$query_rs_CityTown = "SELECT distinct(place.CityTown) FROM place WHERE place.Region = '".$DefaultRegion."'";
$rs_CityTown = mysqli_query($connDoraTarjumaQuran, $query_rs_CityTown) or die(mysqli_error());
$row_rs_CityTown = mysqli_fetch_assoc($rs_CityTown);
$totalRows_rs_CityTown = mysqli_num_rows($rs_CityTown);

mysqli_select_db($connDoraTarjumaQuran, $database_connDoraTarjumaQuran);
$query_rs_Place = "SELECT PlaceId, Address FROM place WHERE CityTown ='".$DefaultCityTown."'";
$rs_Place = mysqli_query($connDoraTarjumaQuran, $query_rs_Place) or die(mysqli_error());
$row_rs_Place = mysqli_fetch_assoc($rs_Place);
$totalRows_rs_Place = mysqli_num_rows($rs_Place);

mysqli_select_db($connDoraTarjumaQuran, $database_connDoraTarjumaQuran);
$query_rs_AllPlaces = "SELECT count(PlaceId) as NoOfPlaces FROM place";
$rs_AllPlaces = mysqli_query($connDoraTarjumaQuran, $query_rs_AllPlaces) or die(mysqli_error());
$row_rs_AllPlaces = mysqli_fetch_assoc($rs_AllPlaces);
$totalRows_rs_AllPlaces = mysqli_num_rows($rs_AllPlaces);
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
		reqstr="script_allplaces.php?co="+escape(co)+"&re="+escape(re)+"&ci="+escape(ci)+"&ce="+escape(ce);
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
<title>All past and present places where Dora Tarjuma Quran has been held since 1984</title>
<style type="text/css">
<!--
.style1 {
	color: #FF0000;
	font-size: larger;
}
-->
</style>
<?php include("header.php"); ?>
</head><body bgcolor="#669933">
<table align="center" width="800" border="1" cellpadding="0" bgcolor="#CCEEAA"  cellspacing="0">
  <tr>
    <td scope="col" align="left">
      <h1 align="center">All Past and Present Places where Dora Tarjuma Quran has been held since 1984</h1>
	  Dora Tarjuma Quran has been held at a total of <span class="style3 style1"><?php echo $row_rs_AllPlaces['NoOfPlaces'];?></span> different places since 1984. Most of these places have become permanent venues for every year while some are temporary places which are changed occasionally.</td>
  </tr>
<tr><td><div id="output_div0" align="left">
	<table bgcolor="#CCEEAA">
	<tr valign="baseline"><td nowrap align="right">Country</td><td nowrap align="left"><select id='Country' name='Country' onChange = getScriptPage('cn') style="width=150">
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
      <td nowrap align="right">CityTown</td><td nowrap align="left"><select id='CityTown' name='CityTown' onchange = getScriptPage('ct') style="width=150">
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
  <tr>
    <th scope=\"col\" align="left">Place Id(s)</th>
    <th scope=\"col\" align="left">Place(s) in Karachi</th>
  </tr>
    <?php do { ?>
    <tr valign="baseline"><td nowrap align="right"><?php echo $row_rs_Place['PlaceId'];?></td><td nowrap align="left"><a href="placedetails.php?plid=<?php echo $row_rs_Place['PlaceId']; ?>"><?php echo $row_rs_Place['Address']; ?></a></td></tr>
    <?php } while ($row_rs_Place = mysqli_fetch_assoc($rs_Place)); ?>
	</table>
</div>
</td></tr>
<tr><td align="center">
This page lists all the <span class="style1">past and present places </span>of Dora Tarjuma Quran.<br />
To see the places for the current year only <a href="currentplaces.php">click here</a></td>
</tr></table>
</body>
<?php include("footer.php"); ?>
</html>
<?php 
mysqli_free_result($rs_Country);
mysqli_free_result($rs_Region);
mysqli_free_result($rs_CityTown);
mysqli_free_result($rs_Place);
mysqli_free_result($rs_AllPlaces);
?>
