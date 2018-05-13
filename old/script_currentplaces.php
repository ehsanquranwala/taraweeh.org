<?php
	include("data_mysql.php");
	$ds = new data_mysql();
	if(isset($_GET['yr']))$SelectedYear = $_GET['yr']; else $SelectedYear=1428;
	if(isset($_GET['co']))$SelectedCountry = $_GET['co']; else $SelectedCountry='Pakistan';
	if(isset($_GET['re']))$SelectedRegion = $_GET['re']; else $SelectedRegion='Sindh';
	if(isset($_GET['ci']))$SelectedCityTown = $_GET['ci']; else $SelectedCityTown='Karachi';

	$maxquery="select place.Country,count(program.PlaceId) as noofplaces from place join program where place.PlaceId=program.PlaceId and program.HijriYear=".$SelectedYear." group by Country order by noofplaces desc";
	$res=$ds->get_array($maxquery);
	if(count($res)>0)$CountryWithMostPlaces=$res[0];else $CountryWithMostPlaces='Other';
	
	$query = "Select distinct(Country) from program pr join place pl Where pr.PlaceId = pl.PlaceId and pr.HijriYear=".$SelectedYear;
	$res = $ds->get_array($query);
	if(in_array($SelectedCountry,$res)){$same=1;}else {$same=0;}
	echo "<table bgcolor=\"#CCEEAA\" align=\"center\">
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
	echo "</select></td>";
	
	$maxquery="select place.Region, count(program.PlaceId) as noofplaces from place join program where place.PlaceId=program.PlaceId and program.HijriYear=".$SelectedYear." and place.Country='".$SelectedCountry."' group by Region order by noofplaces desc";
	$res=$ds->get_array($maxquery);
	if(count($res)>0)$RegionWithMostPlaces=$res[0];else $RegionWithMostPlaces='Other';
	
	$query = "Select distinct(Region) from program pr join place pl Where pr.PlaceId = pl.PlaceId and pr.HijriYear=".$SelectedYear." and pl.Country='".$SelectedCountry."'";
	
	$res = $ds->get_array($query);
	if(in_array($SelectedRegion,$res))$same=1;else $same=0;
	echo "<td nowrap align=\"right\">&nbsp;&nbsp;&nbsp;Region</td>
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
	echo "</select></td>";
	
	$maxquery="select place.CityTown, count(program.PlaceId) as noofplaces from place join program where place.PlaceId=program.PlaceId and program.HijriYear=".$SelectedYear." and place.Country='".$SelectedCountry."' and place.Region='".$SelectedRegion."' group by CityTown order by noofplaces desc";
	$res=$ds->get_array($maxquery);
	if(count($res)>0)$CityTownWithMostPlaces=$res[0];else $CityTownWithMostPlaces='Other';
	
	$query = "Select distinct(CityTown) from program pr join place pl Where pr.PlaceId = pl.PlaceId and pr.HijriYear = ".$SelectedYear." and pl.Country='".$SelectedCountry."' and pl.Region='".$SelectedRegion."'";
	$res = $ds->get_array($query);
	if(in_array($SelectedCityTown,$res))$same=1;else $same=0;
	echo "<td nowrap align=\"right\">&nbsp;&nbsp;&nbsp;CityTown</td>
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
	echo "</select></td></tr></table>";
	echo "<table bgcolor=\"#CCEEAA\" align=\"center\"><tr><th scope=\"col\" width=\"50\" align=\"center\">PrgIds</th><th align=\"left\" scope=\"col\" width=\"750\">Venue(s) in ".$SelectedCityTown.'</th></tr>';
	$query = "Select pr.ProgramId, pr.PlaceId, pl.Address from program pr join place pl join programtype pt Where pr.ProgramTypeId=pt.ProgramTypeId and pt.Gender!='Women Only' and pr.PlaceId=pl.PlaceId and pr.HijriYear=".$SelectedYear." and pl.Country='".$SelectedCountry."' and pl.Region='".$SelectedRegion."' and pl.CityTown='".$SelectedCityTown."'";
	$res = $ds->get_values($query);	
	foreach($res as $row)
	{
		echo "<tr>
		<td nowrap align=\"center\">".$row['ProgramId']."</td>
		<td nowrap align=\"left\"><a href=\"placedetails.php?plid=".$row['PlaceId']."\">".$row['Address']."</a>
		</td>
		</tr>";
	}
	
	$query = "Select pr.ProgramId, pr.PlaceId, pl.Address from program pr join place pl join programtype pt Where pr.ProgramTypeId=pt.ProgramTypeId and pt.Gender='Women Only' and pr.PlaceId=pl.PlaceId and pr.HijriYear=".$SelectedYear." and pl.Country='".$SelectedCountry."' and pl.Region='".$SelectedRegion."' and pl.CityTown='".$SelectedCityTown."'";
	$res = $ds->get_values($query);	
	if(count($res))echo '<tr valign="baseline"><td></td><td nowrap align="left"><strong>Special Programs for Ladies</strong></td></tr>';
	foreach($res as $row)
	{
		echo "<tr>
		<td nowrap align=\"center\">".$row['ProgramId']."</td>
		<td nowrap align=\"left\"><a href=\"placedetails.php?plid=".$row['PlaceId']."\">".$row['Address']."</a></td>
		</tr>";
	}
	echo "</table>";
?>