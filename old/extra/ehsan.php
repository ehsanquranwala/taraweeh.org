<?php require_once('Connections/connDoraTarjumaQuran.php'); ?>
<?php
mysqli_select_db($connDoraTarjumaQuran, $database_connDoraTarjumaQuran);
$query_rs_Country = "SELECT distinct(place.Country) FROM place";
$rs_Country = mysqli_query($connDoraTarjumaQuran, $query_rs_Country) or die(mysqli_error());
$row_rs_Country = mysqli_fetch_assoc($rs_Country);
$totalRows_rs_Country = mysqli_num_rows($rs_Country);

mysqli_select_db($connDoraTarjumaQuran, $database_connDoraTarjumaQuran);
$query_rs_CityTown = "SELECT distinct(place.CityTown) FROM place WHERE place.Region = 'Sindh'";
$rs_CityTown = mysqli_query($connDoraTarjumaQuran, $query_rs_CityTown) or die(mysqli_error());
$row_rs_CityTown = mysqli_fetch_assoc($rs_CityTown);
$totalRows_rs_CityTown = mysqli_num_rows($rs_CityTown);

mysqli_select_db($connDoraTarjumaQuran, $database_connDoraTarjumaQuran);
$query_rs_Region = "SELECT distinct(place.Region) FROM place WHERE place.Country='Pakistan'";
$rs_Region = mysqli_query($connDoraTarjumaQuran, $query_rs_Region) or die(mysqli_error());
$row_rs_Region = mysqli_fetch_assoc($rs_Region);
$totalRows_rs_Region = mysqli_num_rows($rs_Region);
?>
<script language="javascript" type="text/javascript">
	var count1 = 0;
	var count2 = 0;
	function handleHttpResponse() {
		if (http.readyState == 4) {
			if (subject_id != '') {
				document.getElementById(subject_id).innerHTML = http.responseText;
			}
		}
	}
	function handleHttpResponse1() {
		if (http1.readyState == 4) {
			if (subject_id1 != '') {
				document.getElementById(subject_id1).innerHTML = http1.responseText;
			}
		}
	}
	function handleHttpResponse2() {
		if (http2.readyState == 4) {
			if (subject_id2 != '') {
				document.getElementById(subject_id2).innerHTML = http2.responseText;
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
		//alert(content_id);
		//alert(div_id1);
		subject_id = div_id1;
		content = document.getElementById(content_id).value;
		http.open("GET", "script_page.php?"+content_id+"="+escape(content), true);//to specify the request to send
		http.onreadystatechange = handleHttpResponse;
		http.send(null);//send the request
	}
	
	var http1 = createRequestObject();
	var http2 = createRequestObject();
	function getScriptPages(div_id1,content_id1,div_id2,content_id2)
	{
		subject_id1 = div_id1;
		content = document.getElementById(content_id1).value;
		http1.open("GET", "script_page.php?"+content_id1+"="+escape(content), true);
		http1.onreadystatechange = handleHttpResponse1;
		http1.send(null);
		subject_id2 = div_id2;
		content = document.getElementById(content_id2).value;
		http2.open("GET", "script_page.php?"+content_id2+"="+escape(content), true);
		http2.onreadystatechange = handleHttpResponse2;
		http2.send(null);		
	}
</script>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
</head>

<body>
<form method="POST">
<?php include("data_mysql.php");
$ds=new data_mysql();
?>
<table>
<tr> 
<td   size="22">  
<label><strong>Country:</strong></label>
</td>
<td> 
<select id='Country' name='Country' onChange =getScriptPages('output_div1','Country','output_div2','Region') style="width=150">
  <?php
do {  
?>
  <option value="<?php echo $row_rs_Country['Country']?>"<?php if (!(strcmp($row_rs_Country['Country'], "Pakistan"))) {echo "selected=\"selected\"";} ?>><?php echo $row_rs_Country['Country']?></option>
  <?php
} while ($row_rs_Country = mysqli_fetch_assoc($rs_Country));
  $rows = mysqli_num_rows($rs_Country);
  if($rows > 0) {
      mysqli_data_seek($rs_Country, 0);
	  $row_rs_Country = mysqli_fetch_assoc($rs_Country);
  }
?> 
</select>	
</td>
</tr>

<tr> 
	<td> 
		<label><strong>Region:</strong></label>
	</td>

	<td> 
		<div class="output-div-container">
			<div id="output_div1"> 
			<select id='Region' name='Region' onChange = getScriptPage('output_div2','Region') style="width=150">
			  <?php
do {  
?>
			  <option value="<?php echo $row_rs_Region['Region']?>"<?php if (!(strcmp($row_rs_Region['Region'], "Sindh"))) {echo "selected=\"selected\"";} ?>><?php echo $row_rs_Region['Region']?></option>
			  <?php
} while ($row_rs_Region = mysqli_fetch_assoc($rs_Region));
  $rows = mysqli_num_rows($rs_Region);
  if($rows > 0) {
      mysqli_data_seek($rs_Region, 0);
	  $row_rs_Region = mysqli_fetch_assoc($rs_Region);
  }
?> 
			</select>
			</div>
		</div>
	</td>
</tr>

<tr> 
	<td> 
	<label><strong>CityTown:</strong></label>
	</td>

	<td> 
		<div class="output-div-container">
			<div id="output_div2"> 
				<select id='CityTown' name='CityTown' onChange =getScriptPage('output_div3','CityTown') style="width=150">
				  <?php
do {  
?>
				  <option value="<?php echo $row_rs_CityTown['CityTown']?>"<?php if (!(strcmp($row_rs_CityTown['CityTown'], "Karachi"))) {echo "selected=\"selected\"";} ?>><?php echo $row_rs_CityTown['CityTown']?></option>
				  <?php
} while ($row_rs_CityTown = mysqli_fetch_assoc($rs_CityTown));
  $rows = mysqli_num_rows($rs_CityTown);
  if($rows > 0) {
      mysqli_data_seek($rs_CityTown, 0);
	  $row_rs_CityTown = mysqli_fetch_assoc($rs_CityTown);
  }
?> 
			  </select>
			</div>
		</div>
	</td>
</tr>
</table>
</form>
</body>
</html>
<?php
mysqli_free_result($rs_Country);

mysqli_free_result($rs_CityTown);

mysqli_free_result($rs_Region);
?>