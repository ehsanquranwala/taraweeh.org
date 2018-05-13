<?php require_once('Connections/connDoraTarjumaQuran.php'); ?>
<?php
if (!isset($_SESSION)) {session_start();}
$Admin=0;if(isset($_SESSION['Admin']) and ($_SESSION['Admin']==1))$Admin=1;
if(isset($_GET['plid']))$PlcId = $_GET['plid']; else $PlcId = 104;
$DefaultYear=1428;
mysqli_select_db($connDoraTarjumaQuran, $database_connDoraTarjumaQuran);
$query_rs_ProgramDetails = "SELECT pr.ProgramId, pr.StartTime, pr.EndTime, pr.ProgramDetails, pr.ProgramContacts, CONCAT_WS(', ',pt.Mode, pt.Translation, pt.Time) ProgramType, pt.Gender FROM place pl join program pr join programtype pt WHERE pl.PlaceId = ".$PlcId." and pr.PlaceId = pl.PlaceId and pr.ProgramTypeId = pt.ProgramTypeId and pr.HijriYear = ".$DefaultYear;
$rs_ProgramDetails = mysqli_query($connDoraTarjumaQuran, $query_rs_ProgramDetails) or die(mysqli_error());
$totalRows_rs_ProgramDetails = mysqli_num_rows($rs_ProgramDetails);
$programdetails = '';
$prg=1;
while($row_rs_ProgramDetails = mysqli_fetch_assoc($rs_ProgramDetails)) 
{
$programdetails.="<h2 align=\"center\">Program ".$prg."</h2><div align=\"right\"><a href=\"programfeedback.php?prid=".$row_rs_ProgramDetails['ProgramId']."\">Feedback and Suggestions</a></div>Start Time: <strong>".$row_rs_ProgramDetails['StartTime']."</strong><br />Program Type: <strong>".$row_rs_ProgramDetails['ProgramType']."</strong><br />Arrangements For: <strong>".$row_rs_ProgramDetails['Gender']."</strong><br />Program Contacts: <strong>".$row_rs_ProgramDetails['ProgramContacts']."</strong><br />Speaker(s): <strong>";
	mysqli_select_db($connDoraTarjumaQuran, $database_connDoraTarjumaQuran);
	$query_rs_Speaker = "SELECT u.UserId, CONCAT_WS(' ', Prefix, FirstName, LastName) Speaker from program_speaker ps join user u WHERE ps.UserId = u.UserId and ps.ProgramId = ".$row_rs_ProgramDetails['ProgramId'];
	$rs_Speaker = mysqli_query($connDoraTarjumaQuran, $query_rs_Speaker) or die(mysqli_error());
	$totalRows_rs_Speaker = mysqli_num_rows($rs_Speaker);
	while($row_rs_Speaker = mysqli_fetch_assoc($rs_Speaker))
	{
		if($row_rs_Speaker['UserId'])
		$programdetails.="<a href=\"profile.php?sp=1&uid=".$row_rs_Speaker['UserId']."\">".$row_rs_Speaker['Speaker']."</a> ";
		else $programdetails.=$row_rs_Speaker['Speaker']."  ";
	}
	$programdetails.="</strong><br />Huffaz: <strong>";
	mysqli_select_db($connDoraTarjumaQuran, $database_connDoraTarjumaQuran);
	$query_rs_Hafiz = "SELECT u.UserId, CONCAT_WS(' ', Prefix, FirstName, LastName) Hafiz from program_hafiz ps join user u WHERE ps.UserId = u.UserId and ps.ProgramId = ".$row_rs_ProgramDetails['ProgramId'];
	$rs_Hafiz = mysqli_query($connDoraTarjumaQuran, $query_rs_Hafiz) or die(mysqli_error());
	$totalRows_rs_Hafiz = mysqli_num_rows($rs_Hafiz);
	while($row_rs_Hafiz = mysqli_fetch_assoc($rs_Hafiz))
	{
		if($row_rs_Hafiz['UserId'])
		$programdetails.="<a href=\"profile.php?uid=".$row_rs_Hafiz['UserId']."\">".$row_rs_Hafiz['Hafiz']."</a> ";
		else $programdetails.=$row_rs_Hafiz['Hafiz']."  ";
	}
    $programdetails.="</strong><br />Management: <strong>";
	mysqli_select_db($connDoraTarjumaQuran, $database_connDoraTarjumaQuran);
	$query_rs_Organizer = "SELECT u.UserId, CONCAT_WS(' ', Prefix, FirstName, LastName, Mobile) Organizer from program_organizer ps join user u WHERE ps.UserId = u.UserId and ps.ProgramId = ".$row_rs_ProgramDetails['ProgramId'];
	$rs_Organizer = mysqli_query($connDoraTarjumaQuran, $query_rs_Organizer) or die(mysqli_error());
	$totalRows_rs_Organizer = mysqli_num_rows($rs_Organizer);
	while($row_rs_Organizer = mysqli_fetch_assoc($rs_Organizer))
	{
		if($row_rs_Organizer['UserId'])
		$programdetails.="<a href=\"profile.php?uid=".$row_rs_Organizer['UserId']."\">".$row_rs_Organizer['Organizer']."</a> ";
		else $programdetails.=$row_rs_Organizer['Organizer']."  ";
	}
	$programdetails.="</strong><br />Program Details: <strong>".$row_rs_ProgramDetails['ProgramDetails']."</strong>";
	$prg++;
}
	mysqli_select_db($connDoraTarjumaQuran, $database_connDoraTarjumaQuran);
	$query_rs_PlaceDetails = "SELECT pl.Address, pl.Phone, pl.Transport, pl.Mapfile, pl.WikimapiaLink, pl.Details FROM place pl WHERE pl.PlaceId = ".$PlcId;
	$rs_PlaceDetails = mysqli_query($connDoraTarjumaQuran, $query_rs_PlaceDetails) or die(mysqli_error());
	$row_rs_PlaceDetails = mysqli_fetch_assoc($rs_PlaceDetails);
	
	$programdetails.="<p>Address: <strong>".$row_rs_PlaceDetails['Address']."</strong><br />Phone: <strong>".$row_rs_PlaceDetails['Phone']."</strong><br />Public Transports: <strong>".$row_rs_PlaceDetails['Transport']."</strong></p>";

	mysqli_select_db($connDoraTarjumaQuran, $database_connDoraTarjumaQuran);
	$query_rs_PlaceHistory = "SELECT pr.ProgramId, pr.Year, pr.HijriYear, u.UserId, CONCAT_WS(' ', Prefix, FirstName, LastName) Speaker, pt.Mode, pt.Translation, pt.Time, pt.Gender FROM program pr, program_speaker ps, user u, programtype pt WHERE pr.ProgramId = ps.ProgramId and ps.UserId = u.UserId and pr.ProgramTypeId = pt.ProgramTypeId and pr.PlaceId = ".$PlcId.' order by pr.HijriYear desc';
	$rs_PlaceHistory = mysqli_query($connDoraTarjumaQuran, $query_rs_PlaceHistory) or die(mysqli_error());
	$row_rs_PlaceHistory = mysqli_fetch_assoc($rs_PlaceHistory);
	$totalRows_rs_PlaceHistory = mysqli_num_rows($rs_PlaceHistory);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" /><meta name="keywords" content="quran qur'an koran tafseer tafsir exegesis explanation dars arabic downloads books articles quiz questions answers taraveeh taravih prayer ramzan ramadhan roza fasting islam jihad dr israr pakistan khilafat caliphate muslims tanzeem e islami nifaz e shariat islami nizam">
<meta name="description" content="quran qur'an koran tafseer tafsir exegesis explanation dars arabic downloads books articles quiz questions answers taraveeh taravih prayer ramzan ramadhan roza fasting islam jihad dr israr pakistan khilafat caliphate muslims tanzeem e islami nifaz e shariat islami nizam">
<title>Dora Tarjuma Quran Program Details</title>
<style type="text/css">
<!--
.style1 {
	color: #FF0000;
	font-weight: bold;
}
-->
</style>
<?php include("header.php"); ?>
</head><body bgcolor="#669933">
<table width="800" border="1" align="center" cellpadding="0" bgcolor="#CCEEAA"  cellspacing="0">
<tr><td><h1 align="center">Dora Tarjuma Quran Program Details</h1>
<table width="50%" border="0" align="center" cellpadding="0" bgcolor="#CCEEAA"  cellspacing="0">
  <tr>
    <td scope="col" valign="top">
<?php if($totalRows_rs_ProgramDetails==0) echo "<span class=\"style1\">No program has been added for this place for current year</span>";echo $programdetails; ?></td>
  </tr>
    <tr>
    <th scope="col"><form id="form1" name="form1" method="post" action="">
      <input name="imageField" type="image" src="maps/<?php echo $row_rs_PlaceDetails['Mapfile']; ?>" />
    </form></th></tr>
	
</table>
</td></tr><tr><td align="center">If you don't see the map above get the directions to this location from the wikimapia map below, this is usually very useful.<iframe width="790" height="600" src="<?php echo $row_rs_PlaceDetails['WikimapiaLink']; ?>"></iframe></td></tr>
<tr><td align="center"><h2 align="center">History of this place</h2>
<table width="800" border="1" align="center" cellpadding="0" bgcolor="#CCEEAA"  cellspacing="0">
  <tr bgcolor="#99CC66">
    <th width="140" scope="col">Year</th>
    <th width="250" scope="col">Speaker</th>
    <th width="50" scope="col">Mode</th>
	 <th width="70" scope="col">Translation</th>
    <th width="170" scope="col">Time</th>
    <th width="120" scope="col">Participation</th>
	<?php if($Admin) echo '<th scope="col">Edit</th>';?>
  </tr>
  <?php
   do { ?>
    <tr>
      <td><?php if($totalRows_rs_PlaceHistory>0) { $prgyr=$row_rs_PlaceHistory['HijriYear'].' AH ('.$row_rs_PlaceHistory['Year'].' AD)';
	  echo '<a href="programdetails.php?prid='.$row_rs_PlaceHistory['ProgramId'].'">'.$prgyr.'</a>'; }?></td>
      <td><?php echo '<a href="profile.php?sp=1&uid='.$row_rs_PlaceHistory['UserId'].'">'.$row_rs_PlaceHistory['Speaker'].'</a>'; ?></td>
      <td><?php echo $row_rs_PlaceHistory['Mode']; ?></td>
	  <td><?php echo $row_rs_PlaceHistory['Translation']; ?></td>
      <td><?php echo $row_rs_PlaceHistory['Time']; ?></td>
      <td><?php echo $row_rs_PlaceHistory['Gender']; ?></td>
	  <?php if($Admin) echo '<td><a href="editprogram.php?prid='.$row_rs_PlaceHistory['ProgramId'].'">Edit</a></td>';?>
    </tr>
    <?php } while ($row_rs_PlaceHistory = mysqli_fetch_assoc($rs_PlaceHistory)); ?>
</table>
</td></tr>
</table>
</body>
<?php include("footer.php"); ?>
</html>
<?php
if(isset($rs_PlaceDetails))mysqli_free_result($rs_PlaceDetails);
if(isset($rs_PlaceHistory))mysqli_free_result($rs_PlaceHistory);
if(isset($rs_Speaker))mysqli_free_result($rs_Speaker);
if(isset($rs_Hafiz))mysqli_free_result($rs_Hafiz);
if(isset($rs_Organizer))mysqli_free_result($rs_Organizer);
if(isset($rs_ProgramDetails))mysqli_free_result($rs_ProgramDetails);
?>