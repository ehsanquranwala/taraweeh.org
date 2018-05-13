<?php require_once('Connections/connDoraTarjumaQuran.php'); ?>
<?php
if(isset($_GET['plid']))$plid=$_GET['plid'];else $plid=1;
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
$query_rs_PlaceToEdit = "SELECT * FROM place  WHERE place.PlaceId=".$plid;
$rs_PlaceToEdit = mysqli_query($connDoraTarjumaQuran, $query_rs_PlaceToEdit) or die(mysqli_error());
$row_rs_PlaceToEdit = mysqli_fetch_assoc($rs_PlaceToEdit);
$totalRows_rs_PlaceToEdit = mysqli_num_rows($rs_PlaceToEdit);

mysqli_select_db($connDoraTarjumaQuran, $database_connDoraTarjumaQuran);
$query_rs_Country = "SELECT distinct(place.Country) FROM place";
$rs_Country = mysqli_query($connDoraTarjumaQuran, $query_rs_Country) or die(mysqli_error());
$row_rs_Country = mysqli_fetch_assoc($rs_Country);
$totalRows_rs_Country = mysqli_num_rows($rs_Country);

mysqli_select_db($connDoraTarjumaQuran, $database_connDoraTarjumaQuran);
$query_rs_Region = "SELECT distinct(place.Region) FROM place WHERE place.Country='".$row_rs_PlaceToEdit['Country']."'";
$rs_Region = mysqli_query($connDoraTarjumaQuran, $query_rs_Region) or die(mysqli_error());
$row_rs_Region = mysqli_fetch_assoc($rs_Region);
$totalRows_rs_Region = mysqli_num_rows($rs_Region);

mysqli_select_db($connDoraTarjumaQuran, $database_connDoraTarjumaQuran);
$query_rs_CityTown = "SELECT distinct(place.CityTown) FROM place WHERE place.Region = '".$row_rs_PlaceToEdit['Region']."'";
$rs_CityTown = mysqli_query($connDoraTarjumaQuran, $query_rs_CityTown) or die(mysqli_error());
$row_rs_CityTown = mysqli_fetch_assoc($rs_CityTown);
$totalRows_rs_CityTown = mysqli_num_rows($rs_CityTown);

mysqli_select_db($connDoraTarjumaQuran, $database_connDoraTarjumaQuran);
$query_rs_PlaceType = "SELECT PlaceTypeId, PlaceType FROM placetype ORDER BY PlaceTypeId";
$rs_PlaceType = mysqli_query($connDoraTarjumaQuran, $query_rs_PlaceType) or die(mysqli_error());
$row_rs_PlaceType = mysqli_fetch_assoc($rs_PlaceType);
$totalRows_rs_PlaceType = mysqli_num_rows($rs_PlaceType);

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {

  $insertSQL = sprintf("update place set Address=%s, Phone=%s, PlaceTypeId=%s, CityTown=%s, Region=%s, Country=%s, NearbyAreas=%s,  Transport=%s, Details=%s, WikimapiaLink=%s where PlaceId=%s",
                       GetSQLValueString($_POST['Address'], "text"),
                       GetSQLValueString($_POST['Phone'], "text"),
                       GetSQLValueString($_POST['PlaceTypeId'], "int"),
                       GetSQLValueString($_POST['CityTown'], "text"),
                       GetSQLValueString($_POST['Region'], "text"),
                       GetSQLValueString($_POST['Country'], "text"),
                       GetSQLValueString($_POST['NearbyAreas'], "text"),
                       GetSQLValueString($_POST['Transport'], "text"),
                       GetSQLValueString($_POST['Details'], "text"),
					   GetSQLValueString($_POST['WikimapiaLink'], "text"),
					   $plid);
					
	mysqli_select_db($connDoraTarjumaQuran, $database_connDoraTarjumaQuran);
	$Result1 = mysqli_query($insertSQL) or die(mysqli_error());
	
	if((isset($_FILES['MapFile']))and($_FILES['MapFile']['tmp_name']!==""))
	{
		$uploadfile = "D:\\FtpData\\doratarjumaquran.pk\\wwwroot\\maps\\".$plid.".gif";
		move_uploaded_file($_FILES['MapFile']['tmp_name'], $uploadfile);
	}
	$insertGoTo = "adminpage.php";
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
	function getScriptPage(ce)
	{
		div_id = 'output_div0';
		co=document.getElementById('Country').value;
		re=document.getElementById('Region').value;
		reqstr="script_editplace.php?co="+escape(co)+"&re="+escape(re)+"&ce="+escape(ce);
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
<title>Edit the information related to the selected place</title>
<?php include("header.php"); ?>
<?php include("adminquicklinks.php");?>
</head><body bgcolor="#669933">
<form method="post" name="form1" enctype="multipart/form-data" action="<?php echo $editFormAction; ?>">
<table align="center" width="800" border="1" cellpadding="0" bgcolor="#CCEEAA"  cellspacing="0"><tr><td><h1 align="center">Edit Place</h1>
<div id="output_div0" align="left">
<table bgcolor="#CCEEAA">
<tr valign="baseline"><td nowrap align="right">Country</td><td nowrap align="left"><select id='Country' name='Country' onChange = getScriptPage('cn') style="width=150">
<?php do {  
if($row_rs_Country['Country']!="Other"){
echo "<option value=\"".$row_rs_Country['Country']."\" "; 
if(!(strcmp($row_rs_Country['Country'], $row_rs_PlaceToEdit['Country']))) {echo "selected=\"selected\"";} 
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
<option value="<?php echo $row_rs_Region['Region']?>"<?php if (!(strcmp($row_rs_Region['Region'], $row_rs_PlaceToEdit['Region']))) {echo "selected=\"selected\"";} ?>><?php echo $row_rs_Region['Region']?></option>
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
<td nowrap align="right">City / Town</td>
<td nowrap align="left"><select id='CityTown' name='CityTown' style="width=150">
<?php do { ?>
<option value="<?php echo $row_rs_CityTown['CityTown']?>"<?php if (!(strcmp($row_rs_CityTown['CityTown'], $row_rs_PlaceToEdit['CityTown']))) {echo "selected=\"selected\"";} ?>><?php echo $row_rs_CityTown['CityTown']?></option>
<?php
} while ($row_rs_CityTown = mysqli_fetch_assoc($rs_CityTown));
echo "<option id='Other' name='Other'>Other</option>";
$rows = mysqli_num_rows($rs_CityTown);
if($rows > 0) {
mysqli_data_seek($rs_CityTown, 0);
$row_rs_CityTown = mysqli_fetch_assoc($rs_CityTown);
}?>
</select></td></tr>
</table>
</div></td></tr><tr><td>
  <table align="left">
    <tr valign="baseline">
      <td align="right" nowrap>Address</td>
      <td >
	  <input name="Address" type="text" value="<?php echo $row_rs_PlaceToEdit['Address']?>" size="100" maxlength="150"/>
	  <br />
	  <em>Select Country, Region and CityTown from above, if you dont find it choose 'Other' and include in this Address</em></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Place Type</td>
      <td><select name="PlaceTypeId">
          <?php
do {  
?><option value="<?php echo $row_rs_PlaceType['PlaceTypeId']?>"<?php if ($row_rs_PlaceType['PlaceTypeId']==$row_rs_PlaceToEdit['PlaceTypeId']) {echo "selected=\"selected\"";} ?>><?php echo $row_rs_PlaceType['PlaceType']?></option>
          <?php
} while ($row_rs_PlaceType = mysqli_fetch_assoc($rs_PlaceType));
  $rows = mysqli_num_rows($rs_PlaceType);
  if($rows > 0) {
      mysqli_data_seek($rs_PlaceType, 0);
	  $row_rs_PlaceType = mysqli_fetch_assoc($rs_PlaceType);
  }
?>
      </select></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Phone No(s)</td>
      <td><input type="text" name="Phone" value="<?php echo $row_rs_PlaceToEdit['Phone']?>" size="50"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Nearby<br  />Areas</td>
      <td><input type="text" name="NearbyAreas" value="<?php echo $row_rs_PlaceToEdit['NearbyAreas']?>" size="70">
      <br />
      Comma separated values e.g Sadar,M A Jinnah Road,Numaish etc</td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">MapFile</td>
      <td><input align="absmiddle" name="imageField" type="image" src="maps/<?php echo $row_rs_PlaceToEdit['MapFile']; ?>" /><br  />
	  <input type="hidden" name="MAX_FILE_SIZE" value="1000000" />
	  <input name="MapFile" type="file" size="50" value="<?php echo $row_rs_PlaceToEdit['Address']?>" />
	  <br />
      <em>Upload the location map in a gif file of resolution 600 * 400<br  />Files more than 1mb in size will not be uploaded.</em></td>
    </tr>
	<tr valign="baseline">
      <td nowrap align="right">Wikimapia Link</td>
      <td><input type="text" name="WikimapiaLink" value="<?php echo $row_rs_PlaceToEdit['WikimapiaLink']?>" size="100">
      <br />
      <em>Locate the area on <a href="http://www.wikimapia.org">www.wikimapia.org</a> add a place in it and copy the link here from the browser's address bar </em></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Transport</td>
      <td><input type="text" name="Transport" value="<?php echo $row_rs_PlaceToEdit['Transport']?>" size="50">
      <br /><em>Public transport(s) available to reach this place</em></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Details</td>
      <td><textarea name="Details" cols="70" rows="5"><?php echo $row_rs_PlaceToEdit['Details']?></textarea></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">&nbsp;</td>
      <td><input type="submit" value="Update Place"><input name="Reset" type="reset" onClick="" value="Reset">
        <a href="adminpage.php">Cancel</a></td>
    </tr>
  </table></td></tr></table>
  <input type="hidden" name="MM_insert" value="form1">
</form>
</body>
<?php include("footer.php"); ?>
</html>
<?php 
mysqli_free_result($rs_PlaceToEdit);
mysqli_free_result($rs_Country);
mysqli_free_result($rs_Region);
mysqli_free_result($rs_CityTown);
mysqli_free_result($rs_PlaceType);
?>