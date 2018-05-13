<?php require_once('Connections/connDoraTarjumaQuran.php'); ?>
<?php require_once('Connections/connDoraTarjumaQuran.php'); 
$DefaultHijriYear=1429;
$DefaultCountry = "Pakistan";
$DefaultRegion = "Sindh";
$DefaultCityTown = "Karachi";
$DefaultPlaceId = 102;

mysqli_select_db($connDoraTarjumaQuran, $database_connDoraTarjumaQuran);
$query_rs_CurrentPlaces = "SELECT count(pl.PlaceId) as NoOfPlaces FROM place pl join program pr WHERE pl.PlaceId=pr.PlaceId AND pr.HijriYear=".$DefaultHijriYear;
$rs_CurrentPlaces = mysqli_query($connDoraTarjumaQuran, $query_rs_CurrentPlaces) or die(mysqli_error());
$row_rs_CurrentPlaces = mysqli_fetch_assoc($rs_CurrentPlaces);
$totalRows_rs_CurrentPlaces = mysqli_num_rows($rs_CurrentPlaces);

mysqli_select_db($connDoraTarjumaQuran, $database_connDoraTarjumaQuran);
$query_rs_PreviousPlaces = "SELECT count(pl.PlaceId) as NoOfPlaces FROM place pl join program pr WHERE pl.PlaceId=pr.PlaceId AND pr.HijriYear=".($DefaultHijriYear-1);
$rs_PreviousPlaces = mysqli_query($connDoraTarjumaQuran, $query_rs_PreviousPlaces) or die(mysqli_error());
$row_rs_PreviousPlaces = mysqli_fetch_assoc($rs_PreviousPlaces);
$totalRows_rs_PreviousPlaces = mysqli_num_rows($rs_PreviousPlaces);

mysqli_select_db($connDoraTarjumaQuran, $database_connDoraTarjumaQuran);
$query_rs_Country = "SELECT distinct(place.Country) FROM program join place WHERE program.PlaceId=place.PlaceId and program.HijriYear=".$DefaultHijriYear;
$rs_Country = mysqli_query($connDoraTarjumaQuran, $query_rs_Country) or die(mysqli_error());
$row_rs_Country = mysqli_fetch_assoc($rs_Country);
$totalRows_rs_Country = mysqli_num_rows($rs_Country);

mysqli_select_db($connDoraTarjumaQuran, $database_connDoraTarjumaQuran);
$query_rs_Region = "SELECT distinct(place.Region) FROM place join program WHERE place.PlaceId=program.PlaceId and program.HijriYear=".$DefaultHijriYear." and place.Country='".$DefaultCountry."'";
$rs_Region = mysqli_query($connDoraTarjumaQuran, $query_rs_Region) or die(mysqli_error());
$row_rs_Region = mysqli_fetch_assoc($rs_Region);
$totalRows_rs_Region = mysqli_num_rows($rs_Region);

mysqli_select_db($connDoraTarjumaQuran, $database_connDoraTarjumaQuran);
$query_rs_CityTown = "SELECT distinct(place.CityTown) FROM place join program WHERE place.PlaceId=program.PlaceId and program.HijriYear=".$DefaultHijriYear." and place.Region = '".$DefaultRegion."'";
$rs_CityTown = mysqli_query($connDoraTarjumaQuran, $query_rs_CityTown) or die(mysqli_error());
$row_rs_CityTown = mysqli_fetch_assoc($rs_CityTown);
$totalRows_rs_CityTown = mysqli_num_rows($rs_CityTown);

mysqli_select_db($connDoraTarjumaQuran, $database_connDoraTarjumaQuran);
$query_rs_Place = "SELECT pr.ProgramId, pr.PlaceId, pl.Address FROM place pl join program pr join programtype pt WHERE pr.ProgramTypeId=pt.ProgramTypeId and pt.Gender!='Women Only' and pl.CityTown ='".$DefaultCityTown."' and pl.PlaceId=pr.PlaceId and pr.HijriYear=".$DefaultHijriYear;
$rs_Place = mysqli_query($connDoraTarjumaQuran, $query_rs_Place) or die(mysqli_error());
$row_rs_Place = mysqli_fetch_assoc($rs_Place);
$totalRows_rs_Place = mysqli_num_rows($rs_Place);

mysqli_select_db($connDoraTarjumaQuran, $database_connDoraTarjumaQuran);
$query_rs_Place_Ladies = "SELECT pr.ProgramId, pr.PlaceId, pl.Address FROM place pl join program pr join programtype pt WHERE pr.ProgramTypeId=pt.ProgramTypeId and pt.Gender='Women Only' and pl.CityTown ='".$DefaultCityTown."' and pl.PlaceId=pr.PlaceId and pr.HijriYear=".$DefaultHijriYear;
$rs_Place_Ladies = mysqli_query($connDoraTarjumaQuran, $query_rs_Place_Ladies) or die(mysqli_error());
$row_rs_Place_Ladies = mysqli_fetch_assoc($rs_Place_Ladies);
$totalRows_rs_Place_Ladies = mysqli_num_rows($rs_Place_Ladies);

mysqli_select_db($connDoraTarjumaQuran, $database_connDoraTarjumaQuran);
$query_rs_Years = "SELECT distinct(pr.HijriYear), pr.Year FROM program pr";
$rs_Years = mysqli_query($connDoraTarjumaQuran, $query_rs_Years) or die(mysqli_error());
$row_rs_Years = mysqli_fetch_assoc($rs_Years);
$totalRows_rs_Years = mysqli_num_rows($rs_Years);
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
		reqstr="script_currentplaces.php?yr="+yr+"&co="+co+"&re="+re+"&ci="+ci;
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
<title>All present places where Dora Tarjuma Quran is being held this year</title>
<style type="text/css">
<!--
.style2 {
	font-size: larger;
	color: #FF0000;
	font-weight: bold;
}
-->
</style>
<style type="text/css">
<!--
.style1 {color: #FF0000}
-->
</style>
<?php include("header.php"); ?>
</head><body bgcolor="#669933">
<table align="center" width="800" border="1" cellpadding="0" bgcolor="#CCEEAA" cellspacing="0">
<tr>
    <td scope="col" align="center"><h1 align="center">Venues of Dora Tarjuma  Quran for Current Year</h1>
    Alhamdulillah <span class="style2"><?php echo $row_rs_CurrentPlaces['NoOfPlaces'];?></span> places have been registered so far for Dora Tarjuma Quran for current year. Around 200 places are expected in total so please keep visiting for the updates. </td>
</tr>
	<tr>
	  <th align="center">@Organizers: Please send us the program details at your location a.s.a.p  at nazim@doratarjumaquran.pk</th>
	</tr>
<tr><td>
<div id="output_div0" align="left">
	<table bgcolor="#CCEEAA" align="center">
	<tr valign="baseline"><th nowrap align="right">Country</th><th nowrap align="left">
	<select id='Country' name='Country' onChange = getScriptPage() style="width=150">
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
      </select></th>
      <th nowrap align="right">&nbsp;&nbsp;&nbsp;Region</th>
      <th nowrap align="left"><select id='Region' name='Region' onchange = getScriptPage() style="width=150">
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
      </select></th>
      <th nowrap align="right">&nbsp;&nbsp;&nbsp;CityTown</th>
      <th nowrap align="left"><select id='CityTown' name='CityTown' onchange = getScriptPage() style="width=150">
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
      </select></th></tr>
	  </table>
	  <table bgcolor="#CCEEAA" align="center">
  <tr><th scope="col" align="center" width="50">PrgIds</th>
  <th scope="col" align="left" width="750">Venues(s) in Karachi</th>
  </tr>
    <?php do { ?>
    <tr valign="baseline"><td nowrap align="center"><?php echo $row_rs_Place['ProgramId'];?></td><td nowrap align="left"><a href="placedetails.php?plid=<?php echo $row_rs_Place['PlaceId']; ?>"><?php echo $row_rs_Place['Address']; ?></a></td></tr>
    <?php } while ($row_rs_Place = mysqli_fetch_assoc($rs_Place)); ?>
	    <tr valign="baseline"><td></td><td nowrap align="left"><strong>Special Programs for Ladies</strong></td></tr>
		<?php do { ?>
		<tr valign="baseline"><td nowrap align="center"><?php echo $row_rs_Place_Ladies['ProgramId'];?></td><td nowrap align="left"><a href="placedetails.php?plid=<?php echo $row_rs_Place_Ladies['PlaceId']; ?>"><?php echo $row_rs_Place_Ladies['Address']; ?></a></td></tr>
    <?php } while ($row_rs_Place_Ladies = mysqli_fetch_assoc($rs_Place_Ladies)); ?>
	</table>
</div>
</td></tr>
<tr>
  <td align="center">These are the places for the current year only,
to see all the <span class="style1">past and present places</span> of Dora Tarjuma Quran <a href="allplaces.php">click here</a></td>
</tr>
<tr><td align="center">
We try our level best to reach all geographical locations in deciding the places but for some of you it may still be far from home, in that case you can surely expect greater reward from Allah. There is also a possibility of transport arrangement for which you can contact the management of each program. Do tell us if you want to take the initiative and organize a program at your place.</td>
</tr></table>
</body>
<?php include("footer.php"); ?>
</html>
<?php 
mysqli_free_result($rs_CurrentPlaces);
mysqli_free_result($rs_PreviousPlaces);
mysqli_free_result($rs_Years);
mysqli_free_result($rs_Country);
mysqli_free_result($rs_Region);
mysqli_free_result($rs_CityTown);
mysqli_free_result($rs_Place);
?>