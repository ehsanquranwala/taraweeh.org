<?php require_once('Connections/connDoraTarjumaQuran.php'); ?>
<?php
set_time_limit(1000);
include("data_mysql.php");
$ds=new data_mysql();
$insert="";
$query = "SELECT groups.GroupId, groups.GroupName, groups.Next FROM groups WHERE groups.Done != 1";
$arr = $ds->get_values($query);
$getemails = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $getemails .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["insert"])) && ($_POST["insert"] == "form1")) {
$id = $_POST['group'];
$grpid = $arr[$id]['GroupId'];
$grpname = $arr[$id]['GroupName'];
$next = $arr[$id]['Next'];

$messages = 'http://groups.yahoo.com/group/'.$grpname.'/messages';
$nextpage = $messages;
if($next > 0){
$nextpage .= '/'.$next.'?viscount=-30&l=1';}

$msgnum = -1;
for($pgs=0;$pgs<$_POST['noofpages'];$pgs++) 
{
if($msgnum != 0)
{	echo $nextpage;
	$lines = file($nextpage);//get the html page text in an array(one entry for each line)
	$nextpage = '';
	$insert = 'insert ignore into emails values ('.$grpid.',\'dummy\')';
	if($lines)//lines were successfully taken from the html page
	{
		foreach ($lines as $line)
		{
			if(strlen($nextpage)==0)//make a next page link
			{
				$title = strstr($line,'Messages :');
				if($title)
				{
					$start = strpos($title,':') + 2;
					$len = strpos($title,'-') - $start;
					$msgnum = substr($title,$start,$len)-1;
					$nextpage = $messages.'/'.($msgnum).'?viscount=-30&l=1';
				}
			}
			else //extract emails from the lines
			{
				$fromprofile = strstr($line, 'profiles.yahoo.com/');
				if($fromprofile)
				{
					$start = strpos($fromprofile,'/') + 1;
					$len = strpos($fromprofile,'"') - $start;
					$yahooid = substr($fromprofile,$start,$len);
					$yahooid = str_ireplace('%2E','.',$yahooid);
					$insert .= ',('.$grpid.',\''.$yahooid.'\')';//update the insert query
				}
			}
		}
	}
	else {break;}
}
}
//insert data of 10 pages in database
mysqli_select_db($connDoraTarjumaQuran, $database_connDoraTarjumaQuran);
$emailcount=0;
if(mysqli_query($insert, $connDoraTarjumaQuran)){//if emails get inserted successfully, update the groups table
$emailcount = mysql_affected_rows();

if($msgnum!=-1)
{
	$update = 'update groups set Next='.($msgnum);
	if($msgnum==0) $update .= ',Done=1';
	$update.=' where GroupId='.$grpid;
	$Result1 = mysqli_query($update) or die(mysqli_error());
}
}
$goto="Location: yahooids.php?emcnt=".$emailcount;
  header($goto);
}//form posting completes here
?>
<form id="form1" name="form1" method="post" action="<?php echo $getemails; ?>">
  <label>Group
  <select name="group">
  <?php for($i=0;$i<count($arr);$i++)
  echo '<option value="'.$i.'">'.$arr[$i]['GroupName'].'</option>';
  ?>
    </select>
  No of pages
  <input name="noofpages" type="text" size="5" />
  </label>
  <input type="submit" name="Submit" value="Submit" />
    <input type="hidden" name="insert" value="form1">
</form>