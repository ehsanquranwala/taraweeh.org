<?php $myfile = fopen("C:\\insertprogramspeaker.txt","w");
for ($i = 1; $i < 1290; $i++) {
fwrite($myfile,$i);fwrite($myfile,"	1\r\n");
}
fclose($myfile);
?>