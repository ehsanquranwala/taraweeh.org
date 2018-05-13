<?php
	include("data_mysql.php");
	$ds = new data_mysql();
	if(isset($_GET['yr']))$SelectedYear = $_GET['yr']; else $SelectedYear=1428;
	if(isset($_GET['co']))$SelectedCountry = $_GET['co']; else $SelectedCountry='Pakistan';
	if(isset($_GET['re']))$SelectedRegion = $_GET['re']; else $SelectedRegion='Sindh';
	if(isset($_GET['ci']))$SelectedCityTown = $_GET['ci']; else $SelectedCityTown='Karachi';
	if(isset($_REQUEST['plid']))
	{
		$SelectedPlaceId = $_REQUEST['plid'];
		$query = "Select Address, CityTown, Phone from place Where PlaceId = ".$SelectedPlaceId;
		$res = $ds->get_values($query);//$res gets an array
		if(count($res)>0)
		{
			echo "Address:".$res[0]["Address"]." ".$res[0]["CityTown"]."\nPhone:".$res[0]["Phone"];
		}
	}
	else
	{
	$maxquery="select place.Country,count(program.PlaceId) as noofplaces from place join program where place.PlaceId=program.PlaceId and program.HijriYear=".$SelectedYear." group by Country order by noofplaces desc";
	$res=$ds->get_array($maxquery);
	if(count($res)>0)$CountryWithMostPlaces=$res[0];else $CountryWithMostPlaces='Other';
	
	$query = "Select distinct(Country) from program pr join place pl Where pr.PlaceId = pl.PlaceId and pr.HijriYear=".$SelectedYear;
	$res = $ds->get_array($query);
	if(in_array($SelectedCountry,$res)){$same=1;}else {$same=0;}
	echo "<table bgcolor=\"#CCEEAA\"><tr><td><table bgcolor=\"#CCEEAA\">
	<tr valign=\"baseline\"><td nowrap align=\"right\">Country</td>
	<td nowrap align=\"left\"><select id='Country' name='Country' onChange = getScriptPage() style=\"width=150\">";
	foreach($res as $row)
	{
		if($row!="Other"){
		echo "<option value='".$row."'";
		if((!$same)and(!strcmp($row,$CountryWithMostPlaces))){echo "selected=\"selected\""; $SelectedCountry=$row;$same=1;}
		else if($SelectedCountry==$row) echo "selected=\"selected\"";
		echo ">".$row."</option>";}
	}
	echo "<option id='Other' name='Other'";if($SelectedCountry=='Other') echo "selected=\"selected\"";echo ">Other</option>";
	echo "</select></td></tr>";
	
	$maxquery="select place.Region, count(program.PlaceId) as noofplaces from place join program where place.PlaceId=program.PlaceId and program.HijriYear=".$SelectedYear." and place.Country='".$SelectedCountry."' group by Region order by noofplaces desc";
	$res=$ds->get_array($maxquery);
	if(count($res)>0)$RegionWithMostPlaces=$res[0];else $RegionWithMostPlaces='Other';
	
	$query = "Select distinct(Region) from program pr join place pl Where pr.PlaceId = pl.PlaceId and pr.HijriYear=".$SelectedYear." and pl.Country='".$SelectedCountry."'";
	
	$res = $ds->get_array($query);
	if(in_array($SelectedRegion,$res))$same=1;else $same=0;
	echo "<tr valign=\"baseline\"><td nowrap align=\"right\">Region</td>
	<td nowrap align=\"left\"><select id='Region' name='Region' onChange = getScriptPage() style=\"width=150\">";
	foreach($res as $row)
	{
		if($row!="Other"){
		echo "<option value='".$row."'";
		if((!$same)and(!strcmp($row,$RegionWithMostPlaces))){echo "selected=\"selected\""; $SelectedRegion=$row;$same=1;}
		else if($SelectedRegion==$row) echo "selected=\"selected\"";
		echo ">".$row."</option>";}
	}
	echo "<option id='Other' name='Other'";if($SelectedRegion=='Other') echo "selected=\"selected\"";echo ">Other</option>";
	echo "</select></td></tr>";
	
	$maxquery="select place.CityTown, count(program.PlaceId) as noofplaces from place join program where place.PlaceId=program.PlaceId and program.HijriYear=".$SelectedYear." and place.Country='".$SelectedCountry."' and place.Region='".$SelectedRegion."' group by CityTown order by noofplaces desc";
	$res=$ds->get_array($maxquery);
	if(count($res)>0)$CityTownWithMostPlaces=$res[0];else $CityTownWithMostPlaces='Other';
	
	$query = "Select distinct(CityTown) from program pr join place pl Where pr.PlaceId = pl.PlaceId and pr.HijriYear = ".$SelectedYear." and pl.Country='".$SelectedCountry."' and pl.Region='".$SelectedRegion."'";
	$res = $ds->get_array($query);
	if(in_array($SelectedCityTown,$res))$same=1;else $same=0;
	echo "<tr valign=\"baseline\"><td nowrap align=\"right\">CityTown</td>
	<td nowrap align=\"left\">
	<select id='CityTown' name='CityTown' onchange = getScriptPage() style=\"width=150\">";
	foreach($res as $row)
	{       
		if($row!="Other"){
		echo "<option value='".$row."'";
		if((!$same)and(!strcmp($row,$CityTownWithMostPlaces))){echo "selected=\"selected\""; $SelectedCityTown=$row;$same=1;}
		else if($SelectedCityTown==$row) echo "selected=\"selected\"";
		echo ">".$row."</option>";}
	}
	echo "<option id='Other' name='Other'";if($SelectedCityTown=='Other') echo "selected=\"selected\"";echo ">Other</option>";
	echo "</select></td></tr>";

	$query = "Select pr.PlaceId, pl.Address from program pr join place pl Where pr.PlaceId=pl.PlaceId and pr.HijriYear=".$SelectedYear." and pl.Country='".$SelectedCountry."' and pl.Region='".$SelectedRegion."' and pl.CityTown='".$SelectedCityTown."'";
	$res = $ds->get_values($query);	
	echo "<tr valign=\"baseline\"><td nowrap align=\"right\">Place</td>";
	echo "<td nowrap align=\"left\"><select id='PlaceId' name='PlaceId' onChange = getAddress() style=\"width:700; max-width:700\">";
	echo "<option value=-1 selected=\"selected\">Please Select</option>";
	foreach($res as $row)
	{       
		if($row["Address"]!="Other"){
		echo "<option value='".$row["PlaceId"]."'>".$row["Address"]."</option>";}
	}
	echo '</select></table></td><td><table align="center"><tr>
<td>Please spend some time to suggest a place <br  />nearest to the friend you are inviting.<br /><br />
You can select only one place per invitation,<br  />Send a new invitation for every different place.</td>
</tr></table></td><tr></table>';
	}
?>