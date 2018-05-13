<?php
	// You can do anything with the data. Just think of the possibilities!
	include("data_mysql.php");
	$ds=new data_mysql();
	if(isset($_REQUEST['Year']))
	{
	 	$SelectedYear = $_REQUEST['Year'];
		$query = "SELECT pl.CityTown, count(pr.ProgramId) as CityTownTotal FROM program pr join place pl
WHERE pr.HijriYear = ".$SelectedYear." and pr.PlaceId=pl.PlaceId GROUP BY pl.CityTown";
		$res = $ds->get_values($query);
	 	echo "<table width=\"30%\" border=\"1\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" bgcolor=\"#CCEEAA\">
		<tr> 
		<th scope=\"col\" width=\"70%\"><strong>City/Town</strong></th> 
		<th scope=\"col\" width=\"30%\"><strong>Total Programs</strong></th>
		</tr>";
		foreach($res as $row)
		{
		   echo "<tr>
		   <td align=\"center\">
		   <a href=\"citytowndetails.php?ct=".$row['CityTown']."\">".$row['CityTown']."</a>
		   </td>
		    <td align=\"center\">".
		   $row['CityTownTotal']."
		   </td>
		   </tr>";
		}
		echo "</table>";
	}
	else
	{
		$SelectedYear = "";
	}
?>