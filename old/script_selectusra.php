<?php
include("data_mysql.php");
$ds = new data_mysql();
if(isset($_GET['hid']))$SelectedHalqa = $_GET['hid']; else $SelectedHalqa=6;
if(isset($_GET['mtid']))$SelectedMaqamiTanzeem = $_GET['mtid']; else $SelectedMaqamiTanzeem=6;
if(isset($_GET['ce']))$ChangedEntry = $_GET['ce']; else $ChangedEntry='h';

$query = "Select MaqamiTanzeemId, MaqamiTanzeem from maqamitanzeem Where Verified=1 and HalqaId = ".$SelectedHalqa;
$res = $ds->get_values($query);
echo "<table bgcolor=\"#CCEEAA\">
<tr valign=\"baseline\"><td nowrap align=\"right\">Maqami Tanzeem</td>
<td nowrap align=\"left\"><select id='MaqamiTanzeemId' name='MaqamiTanzeemId' onChange=getScriptPage('mt') style=\"width=150\">";
$selected=false;
foreach($res as $row)
{
echo "<option value='".$row['MaqamiTanzeemId']."'";
if(!$selected){
if($ChangedEntry=='h')
{$selected=true;echo "selected=\"selected\"";$SelectedMaqamiTanzeem=$row['MaqamiTanzeemId'];}
else if($row['MaqamiTanzeemId']==$SelectedMaqamiTanzeem)
{$selected=true;echo "selected=\"selected\"";}
}
echo ">".$row['MaqamiTanzeem']."</option>";
}
echo '<option value="-1"';if($SelectedMaqamiTanzeem==-1)echo ' selected="selected"'; echo '>Not Listed</option></select>Enter here<input type="text" name="NewMaqamiTanzeem" />
if not listed.<br />Select "No Maqami Tanzeem" in case of Munfarid Usra or Munfarid Rafeeq</td></tr>';

$query="SELECT usra.UsraId, concat_ws(' ',usra.Usra,'(Naqeeb:', usra.Naqeeb,')') usranaqeeb FROM usra WHERE Verified=1 and usra.MaqamiTanzeemId=".$SelectedMaqamiTanzeem." and usra.HalqaId=".$SelectedHalqa;

$res = $ds->get_values($query);
echo "<tr valign=\"baseline\"><td nowrap align=\"right\">Usra</td>
<td nowrap align=\"left\"><select id='UsraId' name='UsraId' style=\"width:350; max-width:350\">";
foreach($res as $row)
{
echo "<option value='".$row['UsraId']."'>".$row['usranaqeeb']."</option>";
}
echo '<option value="-1">Not Listed</option></select>
</select>Enter here
<input type="text" name="NewUsra" />
if not listed.<br  />Select "No Usra" if you are a Munfarid Rafeeq or Zimmedar with no Usra</td>
</tr></table>';
?>