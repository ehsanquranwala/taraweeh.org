<?php
	include("data_mysql.php");
	$ds = new data_mysql();
	if(isset($_GET['co']))$SelectedCountry = $_GET['co']; else $SelectedCountry='Pakistan';
	if(isset($_GET['re']))$SelectedRegion = $_GET['re']; else $SelectedRegion='Sindh';
	if(isset($_GET['ci']))$SelectedCityTown = $_GET['ci']; else $SelectedCityTown='Karachi';
	if(isset($_GET['ce']))$ChangedEntry = $_GET['ce']; else $ChangedEntry='cn';
	
	$query1="Select distinct(Country) from place where Country!='Other'";
	$res1=$ds->get_array($query1);
	$query2="Select distinct(Region) from place Where Region!='Other' and Country='".$SelectedCountry."'";
	$res2=$ds->get_array($query2);
	if(!strcmp($ChangedEntry,'cn'))$SelectedRegion=$res2[0];
	$query3="Select distinct(CityTown) from place where CityTown!='Other' and Country='".$SelectedCountry."' and Region='".$SelectedRegion."' order by CityTown";
	$res3=$ds->get_array($query3);
	if((!strcmp($ChangedEntry,'cn'))or(!strcmp($ChangedEntry,'re')))$SelectedCityTown=$res3[0];
	$query4="Select pl.PlaceId, pl.Address from place pl Where pl.Country='".$SelectedCountry."' and pl.Region='".$SelectedRegion."' and pl.CityTown='".$SelectedCityTown."' order by pl.Address";
	$res4=$ds->get_values($query4);	
	
	echo "<table bgcolor=\"#CCEEAA\">
	<tr valign=\"baseline\"><td nowrap align=\"right\">Country</td>
	<td nowrap align=\"left\"><select id='Country' name='Country' onChange = getScriptPage('cn') style=\"width=150\">";
	foreach($res1 as $row)
	{
		echo "<option value='".$row."'";
		if($row==$SelectedCountry)echo "selected=\"selected\"";
		echo ">".$row."</option>";
	}
	echo "<option id='Other' name='Other'";if('Other'==$SelectedCountry)echo "selected=\"selected\"";echo ">Other</option></select></td></tr><tr valign=\"baseline\"><td nowrap align=\"right\">Region</td>
	<td nowrap align=\"left\"><select id='Region' name='Region' onChange = getScriptPage('re') style=\"width=150\">";
	foreach($res2 as $row)
	{
		echo "<option value='".$row."'";
		if($row==$SelectedRegion)echo "selected=\"selected\"";
		echo ">".$row."</option>";
	}
	echo "<option id='Other' name='Other'";if('Other'==$SelectedRegion)echo "selected=\"selected\"";echo ">Other</option></select></td></tr><tr valign=\"baseline\"><td nowrap align=\"right\">City Town</td>
	<td nowrap align=\"left\"><select id='CityTown' name='CityTown' onChange = getScriptPage('ct') style=\"width=150\">";
	foreach($res3 as $row)
	{       
		echo "<option value='".$row."'";
		if($row==$SelectedCityTown)echo "selected=\"selected\"";
		echo ">".$row."</option>";
	}
	echo "<option id='Other' name='Other'";if('Other'==$SelectedCityTown)echo "selected=\"selected\"";echo ">Other</option></select></td></tr><tr valign=\"baseline\"><td nowrap align=\"right\">Place(s)</td>
	<td nowrap align=\"left\"><select id='PlaceId' name='PlaceId' style=\"max-width:700;width:700\">";
	foreach($res4 as $row)
	{
		echo "<option value='".$row['PlaceId']."' >".$row['Address']."</option>";
	}
	echo "</select><br  /><a href=\"newplace.php\">Click here</a>
	  to add a new place if its not listed.</td>
</tr>
</table>";
?>