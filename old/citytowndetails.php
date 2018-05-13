<?php require_once('Connections/connDoraTarjumaQuran.php'); ?>
<?php
if(isset($_GET['ct']))$citytown=$_GET['ct'];else $citytown='Karachi';

mysqli_select_db($connDoraTarjumaQuran, $database_connDoraTarjumaQuran);
$query_rs_CityTownDetails = "SELECT pr.Year, pr.HijriYear, count(pr.ProgramId) as YearTotal FROM program pr join place pl WHERE pl.CityTown = '".$citytown."' and pr.PlaceId=pl.PlaceId GROUP BY pr.HijriYear order by pr.HijriYear desc";
$rs_CityTownDetails = mysqli_query($connDoraTarjumaQuran, $query_rs_CityTownDetails) or die(mysqli_error());
$row_rs_CityTownDetails = mysqli_fetch_assoc($rs_CityTownDetails);
$totalRows_rs_CityTownDetails = mysqli_num_rows($rs_CityTownDetails);

mysqli_select_db($connDoraTarjumaQuran, $database_connDoraTarjumaQuran);
$query_rs_CityTown = "SELECT distinct(pl.CityTown) FROM place pl";
$rs_CityTown = mysqli_query($connDoraTarjumaQuran, $query_rs_CityTown) or die(mysqli_error());
$row_rs_CityTown = mysqli_fetch_assoc($rs_CityTown);
$totalRows_rs_CityTown = mysqli_num_rows($rs_CityTown);
?>
<script language="javascript" type="text/javascript">
	function handleHttpResponse() {
		if (http.readyState == 4) {
			if (div_id != '') 
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
	function getScriptPage(div_id1,content_id)
	{
		div_id = div_id1;
		content = document.getElementById(content_id).value;
		http.open("GET", "script_citytowndetails.php?"+content_id+"="+escape(content), true);//to specify the request to send
		http.onreadystatechange = handleHttpResponse;
		http.send(null);//send the request
	}
</script>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" /><meta name="keywords" content="quran qur'an koran tafseer tafsir exegesis explanation dars arabic downloads books articles quiz questions answers taraveeh taravih prayer ramzan ramadhan roza fasting islam jihad dr israr pakistan khilafat caliphate muslims tanzeem e islami nifaz e shariat islami nizam">
<meta name="description" content="quran qur'an koran tafseer tafsir exegesis explanation dars arabic downloads books articles quiz questions answers taraveeh taravih prayer ramzan ramadhan roza fasting islam jihad dr israr pakistan khilafat caliphate muslims tanzeem e islami nifaz e shariat islami nizam">
<title>Details of Dora Tarjuma Quran Programs in selected City or Town for all years</title>
<?php include("header.php"); ?>
</head><body bgcolor="#669933">
<table width="800" align="center" border="1" cellpadding="0" bgcolor="#CCEEAA"  cellspacing="0">
<tr><td>
<h1 align="center">Yearly Stats of Dora Tarjuma Quran in 
<select  id='CityTown' name='CityTown'  style="width=150" onChange="getScriptPage('output_div1','CityTown')">
  <?php
do {  
?>
  <option value="<?php echo $row_rs_CityTown['CityTown']?>"<?php if (!(strcmp($row_rs_CityTown['CityTown'], $_GET['ct']))) {echo "selected=\"selected\"";} ?>><?php echo $row_rs_CityTown['CityTown']?></option>
  <?php
} while ($row_rs_CityTown = mysqli_fetch_assoc($rs_CityTown));
  $rows = mysqli_num_rows($rs_CityTown);
  if($rows > 0) {
      mysqli_data_seek($rs_CityTown, 0);
	  $row_rs_CityTown = mysqli_fetch_assoc($rs_CityTown);
  }
?>
        
      </select></h1><div id="output_div1"> 
<table width="30%" border="1" align="center" cellpadding="0" bgcolor="#CCEEAA"  cellspacing="0">
  <tr bgcolor="#99CC66">
    <th scope="col" align="center"><h3>Year</h3></th>
    <th scope="col" align="center"><h3>Total Programs</h3></th>
  </tr>
  <?php do { ?>
  <tr>
    <td align="center"><a href="yeardetails.php?yr=<?php echo $row_rs_CityTownDetails['HijriYear']; ?>"><?php echo $row_rs_CityTownDetails['HijriYear']." (".$row_rs_CityTownDetails['Year'].")"; ?></a></td>
    <td align="center"><?php echo $row_rs_CityTownDetails['YearTotal']; ?></td>
  </tr>
  <?php } while ($row_rs_CityTownDetails = mysqli_fetch_assoc($rs_CityTownDetails)); 
  $rows = mysqli_num_rows($rs_CityTownDetails);
  if($rows > 0) {
      mysqli_data_seek($rs_CityTownDetails, 0);
	  $row_rs_CityTownDetails = mysqli_fetch_assoc($rs_CityTownDetails);
  }?>
</table>
</div>
</td></tr></table>
</body>
<?php include("footer.php"); ?>
</html>
<?php
mysqli_free_result($rs_CityTown);
mysqli_free_result($rs_CityTownDetails);
?>
