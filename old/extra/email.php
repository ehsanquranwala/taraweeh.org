<?php  
$editFormAction = $_SERVER['PHP_SELF'];
//if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
//mail("03343380785@ufone.com","subject","message");//???? ??? ????? ?? ki jaga ???????????? aye
//mail("03002684160@mobilinkgsm.com","subject","message");
// multiple recipients
$to  = 'ehsantemp@gmail.com' . ', '; // note the comma
$to .= 'ehsantemp@yahoo.com';

// subject
$subject = 'Birthday Reminders for August';

// message
$message = '
<html>
<head>
  <title>Birthday Reminders for August</title>
</head>
<body>
  <p>Here are the birthdays upcoming in August!</p>
  <table>
    <tr>
      <th>Person</th><th>Day</th><th>Month</th><th>Year</th>
    </tr>
    <tr>
      <td>Joe</td><td>3rd</td><td>August</td><td>1970</td>
    </tr>
    <tr>
      <td>Sally</td><td>17th</td><td>August</td><td>1973</td>
    </tr>
  </table>
</body>
</html>
';

// To send HTML mail, the Content-type header must be set
$headers = 'From: ehsantemp@hotmail.com' . "\r\n";
$headers .= 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

//mail($to,$subject,$message,$headers);
mail("ehsantemp@yahoo.com","s","m");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body><form method="post" name="form1" action="<?php echo $editFormAction; ?>">
<input type="submit" value="Add Place">
</form>
</body>
</html>
