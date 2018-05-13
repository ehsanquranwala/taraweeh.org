<?php
	include("data_mysql.php");
	$ds = new data_mysql();
	if(isset($_GET['co']))$SelectedCountry = $_GET['co']; else $SelectedCountry='Pakistan';
	if(isset($_GET['re']))$SelectedRegion = $_GET['re']; else $SelectedRegion='Sindh';
	if(isset($_GET['ce']))$ChangedEntry = $_GET['ce']; else $ChangedEntry='cn';
	
	$query1="Select distinct(Country) from place where Country!='Other'";
	$res1=$ds->get_array($query1);
	$query2="Select distinct(Region) from place Where Region!='Other' and Country='".$SelectedCountry."'";
	$res2=$ds->get_array($query2);
	if(!strcmp($ChangedEntry,'cn'))$SelectedRegion=$res2[0];
	$query3="Select distinct(CityTown) from place where CityTown!='Other' and Country='".$SelectedCountry."' and Region='".$SelectedRegion."' order by CityTown";
	$res3=$ds->get_array($query3);
	$SelectedCityTown=$res3[0];
	
	echo "<table bgcolor=\"#CCEEAA\">
	<tr valign=\"baseline\"><td nowrap align=\"right\">Country</td>
	<td nowrap align=\"left\"><select id='Country' name='Country' onChange = getScriptPage('cn') style=\"width=150\">";
	foreach($res1 as $row)
	{
		echo "<option value='".$row."'";
		if($row==$SelectedCountry)echo "selected=\"selected\"";
		echo ">".$row."</option>";
	}
	echo "</select></td></tr><tr valign=\"baseline\"><td nowrap align=\"right\">Region</td>
	<td nowrap align=\"left\"><select id='Region' name='Region' onChange = getScriptPage('re') style=\"width=150\">";
	foreach($res2 as $row)
	{
		echo "<option value='".$row."'";
		if($row==$SelectedRegion)echo "selected=\"selected\"";
		echo ">".$row."</option>";
	}
	echo "</select></td></tr><tr valign=\"baseline\"><td nowrap align=\"right\">CityTown</td>
	<td nowrap align=\"left\"><select id='CityTown' name='CityTown' style=\"width=150\">";
	foreach($res3 as $row)
	{       
		echo "<option value='".$row."'";
		if($row==$SelectedCityTown)echo "selected=\"selected\"";
		echo ">".$row."</option>";
	}
	echo "</select></td></tr></table>";
?>