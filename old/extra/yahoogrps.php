<?php require_once('Connections/connDoraTarjumaQuran.php'); ?>
<?php
$insert = 'insert into groups values ';
set_time_limit(1000);
$groups = array();
$grpid = 0;
$mygroups = 'C:\\Documents and Settings\\Ehsan\Desktop\\mygroups\\mygroups';
$nextpage = $mygroups.'.htm';
$pgnum = 1;
while ($pgnum<8) 
{
	if($pgnum>1){$nextpage = $mygroups.$pgnum.'.htm';}
	$pgnum++;
	$lines = file($nextpage);
	if($lines)
	{
		foreach ($lines as $line)
		{
				$groupprefix = strstr($line, 'group/');
				if($groupprefix)
				{
					$start = 6;
					$end = strpos($groupprefix,'/?');
					if($end){
					$len = $end - $start;
					$yahoogrp = substr($groupprefix,$start,$len);
					$groups[$grpid]=$yahoogrp;
					if($grpid>0)$insert.=',';
					$insert .= '('.$grpid.',\''.$yahoogrp.'\')';
					$grpid++;}
					//$yahooid = str_ireplace('%2E','.',$yahooid);
				}
		}
	}
}
echo $insert;
mysqli_select_db($connDoraTarjumaQuran, $database_connDoraTarjumaQuran);
$Result1 = mysqli_query($insert) or die(mysqli_error());
print_r($groups);
?>