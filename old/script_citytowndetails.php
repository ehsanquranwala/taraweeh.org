<?php
	// You can do anything with the data. Just think of the possibilities!
	include("data_mysql.php");
	$ds=new data_mysql();
	$SelectedCityTown = $_GET['CityTown'];
	$query = "SELECT pr.Year, pr.HijriYear, count(pr.ProgramId) as YearTotal FROM program pr join place pl WHERE pl.CityTown = '".$SelectedCityTown."' and pr.PlaceId=pl.PlaceId GROUP BY pr.HijriYear";
	$res = $ds->get_values($query);
	echo "<table width=\"30%\" border=\"1\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" bgcolor=\"#CCEEAA\">
	<tr>
	<th scope=\"col\" align=\"center\"><h3>Year</h3></th>
	<th scope=\"col\" align=\"center\"><h3>Total Programs</h3></th>
	</tr>";
	foreach($res as $row)
	{
	   echo "<tr>
	   <td align=\"center\">
	   <a href=\"yeardetails.php?yr=".$row['HijriYear']."\">".$row['HijriYear']." (".$row['Year'].")</a>
	   </td>
		<td align=\"center\">".
	   $row['YearTotal']."
	   </td>
	   </tr>";
	}
	echo "</table>";
?>