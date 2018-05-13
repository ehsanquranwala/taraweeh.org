<?php require_once('Connections/connDoraTarjumaQuran.php'); ?>
<?php

if (isset($_POST['code'])) {
$to = 'ehsantemp@yahoo.com, ehsantemp@hotmail.com, ehsantemp@gmail.com';
$subject = 'Dora Tarjuma Quran Invitation';
$headers = 'From: '.$_POST['from'].'\r\n';
$headers .= 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";// To send HTML mail, the Content-type header must be set
$message = '
<html>
<head><title>Dora Tarjuma Quran Invitation'.$_POST['code'].'</title></head>
<body bgcolor="#669933">
Assalam  u alaikum<br />
This  message is sent to you on request of your friend<br />
who wants you to attend Namaz-e-Taravih with complete translation<br />
and a brief explanation of Quran this year.<br />
This program is being held at more than 200 different locations.<br />
For details please visit your own website <a href="http://www.doratarjumaquran.pk/">www.doratarjumaquran.pk</a><br />
We look forward to your participation in this program.<br /><br />';
$message.='</body></html>';
ini_set(smtp,$_POST['smtp']);
ini_set(smtp_port, 25);
if(mail($to,$subject,$message,$headers))$emailstatus=1;else 
$emailstatus=0;
echo $emailstatus.'<br />'.$_POST['code'].'<br />'.$_POST['smtp'].'<br />'.$_POST['from']; die();
}
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body bgcolor="#669933">
<form method="post" name="form1">
  <table align="center">
    <tr valign="baseline">
      <td nowrap align="right">&nbsp;</td>
      <td>code<input type="text" name="code" id="code" /><br  />smtp<input type="text" name="smtp" id="smtp" value="smtp.doratarjumaquran.pk"/><br  />from<input type="text" name="from" id="from" value="nazim@doratarjumaquran.pk" /><br  /><input type="submit" value="Send Email"></td>
    </tr>
  </table>
  <input type="hidden" name="MM_insert" value="form1">
</form>
</body>
</html>

