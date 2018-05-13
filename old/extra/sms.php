<?php  
//mail("03343380785@ufone.com","subject","message");//???? ??? ????? ?? ki jaga ???????????? aye
//mail("03002684160@mobilinkgsm.com","subject","message");
$to="ehsantemp@gmail.com,ehsantemp@yahoo.com,ehsantemp@hotmail.com";
/*$lines = file('C:\mobilink.txt');
for ($i=315;$i<328;$i++)
{
//str_replace(" ","",$lines[$i]);
	$lines[$i] .= "@mobilink.com";
	$to .= $lines[$i]. ', ';
}*/
echo $to;
$subject = 'Muzahira';
$message = 'Assalam u alaikum, Please attend muzahira of Tanzeem-e-Islami against british govt(rushdi case), 4:00 pm today(25 jun) at press club karachi';
if(mail($to,$subject,$message)) echo "sent"; else echo "failed";
?>