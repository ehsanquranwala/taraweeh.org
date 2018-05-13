<?php $myfile = fopen("C:\\insertprograms.txt","w");
$pl = 0;$yr = 1990;$hyr = 1410;
for( $i = 1; $i < 1290; $i++) {
	 if(($i>20)and($i<30)) {$yr=1991;$hyr=1411;}
else if(($i>30)and($i<40)) {$yr=1992;$hyr=1412;}
else if(($i>40)and($i<50)) {$yr=1993;$hyr=1413;}
else if(($i>50)and($i<70)) {$yr=1994;$hyr=1414;}
else if(($i>70)and($i<110)) {$yr=1995;$hyr=1415;}
else if(($i>110)and($i<150)) {$yr=1996;$hyr=1416;}
else if(($i>150)and($i<190)) {$yr=1997;$hyr=1417;}
else if(($i>190)and($i<240)) {$yr=1997;$hyr=1418;}
else if(($i>240)and($i<310)) {$yr=1998;$hyr=1419;}
else if(($i>310)and($i<390)) {$yr=1999;$hyr=1420;}
else if(($i>390)and($i<480)) {$yr=2000;$hyr=1421;}
else if(($i>480)and($i<580)) {$yr=2001;$hyr=1422;}
else if(($i>580)and($i<690)) {$yr=2002;$hyr=1423;}
else if(($i>690)and($i<810)) {$yr=2003;$hyr=1424;}
else if(($i>810)and($i<940)) {$yr=2004;$hyr=1425;}
else if(($i>940)and($i<1080)) {$yr=2005;$hyr=1426;}
else if(($i>1080)and($i<1130)) {$yr=2006;$hyr=1427;}
else if(($i>1130)and($i<1290)) {$yr=2007;$hyr=1428;}
switch($i):
	case 20: $pl = 1; break;
	case 30: $pl = 1; break;
	case 40: $pl = 1; break;
	case 50: $pl = 1; break;
	case 70: $pl = 1; break;
	case 110: $pl = 1; break;
	case 150: $pl = 1; break;
	case 190: $pl = 1; break;
	case 240: $pl = 1; break;
	case 310: $pl = 1; break;
	case 390: $pl = 1; break;
	case 480: $pl = 1; break;
	case 580: $pl = 1; break;
	case 690: $pl = 1; break;
	case 810: $pl = 1; break;
	case 940: $pl = 1; break;
	case 1080: $pl = 1; break;
	case 1130: $pl = 1; break;
	default: $pl++; break;
	endswitch;
fwrite($myfile,$i);fwrite($myfile,"	");
fwrite($myfile,$hyr);fwrite($myfile,"	");
fwrite($myfile,$yr);fwrite($myfile,"	");
fwrite($myfile,$pl);fwrite($myfile,"	");
fwrite($myfile,"1	1	08:30 pm	12:30 pm	4	6	100	300	50	150	NULL\r\n");}
fclose($myfile);
?>