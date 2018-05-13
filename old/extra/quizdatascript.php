<?php require_once('../Connections/connDoraTarjumaQuran.php'); ?>
<?php
$sql="insert into questions values ";
$sql1="insert into quiz_questions values ";
set_time_limit(300);
$lines = file('c:\\quizdata.txt');
//print_r($lines);
$l=0;
for($q=0;$q<29;$q++){
for($i=1;$i<11;$i++){
//while(!strcmp(substr($lines[$l],0,2),'Q.')){$l++;}
$question=$lines[$l++];
$a=$lines[$l++];
$b=$lines[$l++];
$c=$lines[$l++];
$l++;
$sql.="(default,'".$question."','".$a."','".$b."','".$c."','a',''),";
$qno=$q*10+$i;
$qz=$q+1;
$sql1.="(".$qz.",".$qno."),";
}
}
$sql=substr($sql,0,strlen($sql)-1);
echo $sql."\n\n";
$sql1=substr($sql1,0,strlen($sql1)-1);
echo $sql1;
mysqli_select_db($connDoraTarjumaQuran, $database_connDoraTarjumaQuran);
$Result1 = mysqli_query($sql) or die(mysqli_error());
mysqli_select_db($connDoraTarjumaQuran, $database_connDoraTarjumaQuran);
$Result1 = mysqli_query($sql1) or die(mysqli_error());
?>