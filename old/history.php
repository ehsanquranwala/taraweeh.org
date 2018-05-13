<?php require_once('Connections/connDoraTarjumaQuran.php'); ?>
<?php require_once('Connections/connDoraTarjumaQuran.php'); 

	$DefaultYear = 1428;
	$DefaultCountry = "Pakistan";
	$DefaultRegion = "Sindh";
	$DefaultCityTown = "Karachi";	
	$DefaultPlaceId = 156;
	$DefaultRegion = "Punjab";
	$DefaultCityTown = "Lahore";
	$DefaultPlaceId = 157;
	
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
		reqstr="script_selectprogramfordetails.php?yr="+escape(yr)+"&co="+escape(co)+"&re="+escape(re)+"&ci="+escape(ci)+"&ce="+escape(ce);
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
<title>History of Dora Tarjuma Quran starting 1984</title>
<style type="text/css">
<!--
.style1 {color: #FF0000}
-->
</style>
<?php include("header.php"); ?>
</head>
<body bgcolor="#669933">
<table width="800" border="1" align="center" cellpadding="0" bgcolor="#CCEEAA"  cellspacing="0">
<tr><td scope="col" align="left"><h1 align="center">Dora Tarjuma Quran History</h1>
The very first program of Dora Tarjuma Quran was done by Dr Israr Ahmed in 1984 at Quran Academy Lahore. Since then this program has changed the lives of thousands of people. The number of programs has been increasing steadily in the last 24 years as shown in the graph below. All praise and  gratitude is for Allah with whose help this program has been such a success and thanks to all those people who put in their energies in organizing these programs, specially the ones who have sacrificed their careers and devoted their whole lives in the cause of Allah. No one but Allah can give them the  reward for this.</td>
</tr><tr><td><br  />    
    <span class="style1">This graph has been made from the data we have been able to collect in just one month, hence in some years the no of programs showing are less than the previous year. Actual no of programs is much more than that shown here and they have always increased in every year.</span></td>
</tr>
<tr align="center">
  <td align="left"bgcolor="#99CC66"><h2 align="center">Select an year for Yearly Program Details.</h2></td>
</tr>
<tr><td align="center" valign="top">
<a href="yeardetails.php"></a><img src="images/graph.JPG" alt="Yearly statistics of places of Dora Tarjuma Quran" width="790" height="530" border="1" usemap="#YearMap" />
<map name="YearMap" id="YearMap">

  <area shape="poly" coords="-2,367,28,368,39,399,11,399" href="yeardetails.php?yr=1404" />
  <area shape="poly" coords="31,368,59,370,69,399,43,399" href="yeardetails.php?yr=1405" />
  <area shape="poly" coords="62,364,90,365,100,399,73,399" href="yeardetails.php?yr=1406" />
  <area shape="poly" coords="93,364,123,366,131,398,104,398" href="yeardetails.php?yr=1407" />
  <area shape="poly" coords="127,368,154,369,162,398,137,398" href="yeardetails.php?yr=1408" />
  <area shape="poly" coords="165,398,195,397,194,385,186,360,155,360,158,373" href="yeardetails.php?yr=1409" />
  <area shape="poly" coords="192,372,216,370,225,398,199,399" href="yeardetails.php?yr=1410" />
  <area shape="poly" coords="229,398,257,397,257,375,247,352,220,352,220,369" href="yeardetails.php?yr=1411" />
  <area shape="poly" coords="259,397,288,395,288,371,278,348,249,347,258,370" href="yeardetails.php?yr=1412" />
  <area shape="poly" coords="322,400,292,398,291,371,283,351,282,343,312,343,321,369" href="yeardetails.php?yr=1413" />
  <area shape="poly" coords="350,399,323,399,322,366,313,345,314,326,342,327,353,352" href="yeardetails.php?yr=1414" />
  <area shape="poly" coords="380,398,352,398,353,347,345,327,346,272,372,273,380,289" href="yeardetails.php?yr=1415" />
  <area shape="poly" coords="415,397,387,398,382,387,382,366,395,366,405,367,413,387" href="yeardetails.php?yr=1416" />
  <area shape="poly" coords="445,398,418,398,408,365,409,288,409,259,436,260,443,287" href="yeardetails.php?yr=1417" />
  <area shape="poly" coords="477,398,448,398,448,369,448,346,446,323,469,323,477,347" href="yeardetails.php?yr=1418" />
  <area shape="poly" coords="506,398,478,398,479,346,470,325,472,156,498,156,506,178" href="yeardetails.php?yr=1419" />
  <area shape="poly" coords="537,397,507,398,507,275,506,242,527,242,537,273,536,320" href="yeardetails.php?yr=1420" />
  <area shape="poly" coords="568,398,539,398,538,268,530,246,532,138,561,139,567,166" href="yeardetails.php?yr=1421" />
  <area shape="poly" coords="601,398,569,398,569,345,569,301,580,300,593,300,600,326" href="yeardetails.php?yr=1422" />
  <area shape="poly" coords="632,397,602,397,601,364,603,342,614,342,627,343,632,367" href="yeardetails.php?yr=1423" />
  <area shape="poly" coords="664,397,634,397,633,359,626,339,627,200,653,200,664,227" href="yeardetails.php?yr=1424" />
  <area shape="poly" coords="694,398,664,398,665,225,656,201,657,164,684,164,693,190" href="yeardetails.php?yr=1425" />
  <area shape="poly" coords="725,398,696,398,696,343,695,301,696,229,714,229,725,255" href="yeardetails.php?yr=1426" />
  <area shape="poly" coords="757,398,728,398,727,328,728,268,724,242,748,243,756,266" href="yeardetails.php?yr=1427" />
  <area shape="poly" coords="787,397,758,397,758,267,750,243,752,34,778,34,787,57" href="yeardetails.php?yr=1428" />
</map></td>
</tr>
</table>
<table align="center" width="800" border="1" cellpadding="0" bgcolor="#CCEEAA"  cellspacing="0">
<tr align="center">
  <td align="left"bgcolor="#99CC66"><h2 align="center">Select a Program for Individual Program Details.</h2></td>
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
    <tr valign="baseline"><td nowrap align="right"><?php echo $row_rs_Program['ProgramId'];?></td><td nowrap align="left"><a href="programdetails.php?prid=<?php echo $row_rs_Program['ProgramId']; ?>"><?php echo $row_rs_Program['Address'];?></a></td></tr>
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