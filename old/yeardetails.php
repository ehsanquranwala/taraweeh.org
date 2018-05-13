<?php require_once('Connections/connDoraTarjumaQuran.php'); ?>
<?php
if(isset($_GET['yr']))$hijriyear=$_GET['yr'];
else $hijriyear=1428;
mysqli_select_db($connDoraTarjumaQuran, $database_connDoraTarjumaQuran);
$query_rs_YearDetails = "SELECT pl.CityTown, count(pr.ProgramId) as CityTownTotal FROM program pr join place pl WHERE pr.HijriYear = ".$hijriyear." and pr.PlaceId=pl.PlaceId GROUP BY pl.CityTown";
$rs_YearDetails = mysqli_query($connDoraTarjumaQuran, $query_rs_YearDetails) or die(mysqli_error());
$row_rs_YearDetails = mysqli_fetch_assoc($rs_YearDetails);
$totalRows_rs_YearDetails = mysqli_num_rows($rs_YearDetails);

mysqli_select_db($connDoraTarjumaQuran, $database_connDoraTarjumaQuran);
$query_rs_Years = "SELECT distinct(pr.HijriYear), pr.Year FROM program pr order by HijriYear desc";
$rs_Years = mysqli_query($connDoraTarjumaQuran, $query_rs_Years) or die(mysqli_error());
$row_rs_Years = mysqli_fetch_assoc($rs_Years);
$totalRows_rs_Years = mysqli_num_rows($rs_Years);
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
	function getScriptPage(div_id1,content_id)
	{
		div_id = div_id1;
		content = document.getElementById(content_id).value;
		http.open("GET", "script_yeardetails.php?"+content_id+"="+escape(content), true);//to specify the request to send
		http.onreadystatechange = handleHttpResponse;
		http.send(null);//send the request
	}
</script>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta name="keywords" content="quran qur'an koran tafseer tafsir exegesis explanation dars arabic downloads books articles quiz questions answers taraveeh taravih prayer ramzan ramadhan roza fasting islam jihad dr israr pakistan khilafat caliphate muslims tanzeem e islami nifaz e shariat islami nizam">
<meta name="description" content="quran qur'an koran tafseer tafsir exegesis explanation dars arabic downloads books articles quiz questions answers taraveeh taravih prayer ramzan ramadhan roza fasting islam jihad dr israr pakistan khilafat caliphate muslims tanzeem e islami nifaz e shariat islami nizam">
<title>Details of all Dora Tarjuma Quran Programs in a selected year</title>
<?php include("header.php"); ?>
</head>

<body bgcolor="#669933">
<table width="800" border="1" align="center" cellpadding="0" bgcolor="#CCEEAA"  cellspacing="0">
	  <tr><td><h1 align="center">Geographical Stats of Dora Tarjuma Quran<br  />
for the year <select id='Year' name='Year' onchange = getScriptPage('output_div1','Year') style="width=150">
        <?php do { ?>
        <option value="<?php echo $row_rs_Years['HijriYear']?>"<?php if ($row_rs_Years['HijriYear'] == $hijriyear) {echo "selected=\"selected\"";} ?>><?php echo $row_rs_Years['HijriYear']." AH (".$row_rs_Years['Year']." AD)";?></option>
        <?php
} while ($row_rs_Years = mysqli_fetch_assoc($rs_Years));
  $rows = mysqli_num_rows($rs_Years);
  if($rows > 0) {
      mysqli_data_seek($rs_Years, 0);
	  $row_rs_Years = mysqli_fetch_assoc($rs_Years);
  }
?>
      </select></h1><div id="output_div1"><br  />
<table width="27%" border="1" align="center" cellpadding="0" bgcolor="#CCEEAA"  cellspacing="0">
  <tr>
    <th scope="col" align="center"><h3>City/Town</h3></th>
    <th scope="col" align="center"><h3>Total Programs</h3></th>
  </tr>
  <?php do { ?>
  <tr>
    <td align="center"><a href="citytowndetails.php?ct=<?php echo $row_rs_YearDetails['CityTown']; ?>"><?php echo $row_rs_YearDetails['CityTown']; ?></a></td>
    <td align="center"><?php echo $row_rs_YearDetails['CityTownTotal']; ?></td>
  </tr>
  <?php } while ($row_rs_YearDetails = mysqli_fetch_assoc($rs_YearDetails)); 
  $rows = mysqli_num_rows($rs_YearDetails);
  if($rows > 0) {
      mysqli_data_seek($rs_YearDetails, 0);
	  $row_rs_YearDetails = mysqli_fetch_assoc($rs_YearDetails);
  }?>
</table>
</div></td></tr></table>
</body>
<?php include("footer.php"); ?>
</html>
<?php
mysqli_free_result($rs_YearDetails);
mysqli_free_result($rs_Years);
?>
