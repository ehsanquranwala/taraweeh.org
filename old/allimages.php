<?php require_once('Connections/connDoraTarjumaQuran.php'); ?>
<?php require_once('Connections/connDoraTarjumaQuran.php'); 
if (!isset($_SESSION))session_start();

include("data_mysql.php");
$ds = new data_mysql();
$query="select concat('gallery/',image) as i from gallery where order by rand() limit 40";
$res=$ds->get_array($query);
$total=count($res);

function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  $theValue = (!get_magic_quotes_gpc()) ? addslashes($theValue) : $theValue;

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? "'" . doubleval($theValue) . "'" : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}

if (!isset($_SESSION)) {session_start();}
if (!isset($_SESSION['UserId'])) {$_SESSION['UserId'] = 0;}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}


if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
	
	if (isset($_SESSION['UserId']))$uid=$_SESSION['UserId'];else $uid=0;
  	$insertSQL = sprintf("INSERT INTO gallery (ImageId, UserId, Tags, Approved) VALUES (default, %s, %s, 0)",
                       $uid,
					   GetSQLValueString($_POST['tags'], "text"));
  	
	mysqli_select_db($connDoraTarjumaQuran, $database_connDoraTarjumaQuran);
  	$Result1 = mysqli_query($insertSQL) or die(mysqli_error());
	$imid=mysql_insert_id($connDoraTarjumaQuran);
	
	if((isset($_FILES['image']))and($_FILES['image']['tmp_name']!==""))
	{
		$insertGoTo = "gallery.php";
		$img='www.doratarjumaquran.pk'.$imid;
	
		if(($_FILES['image']['type']=='image/gif')or($_FILES['image']['type']=='image/jpeg')or($_FILES['image']['type']=='image/pjpeg'))
		{
			if($_FILES['image']['type']=='image/gif')$img.=".gif";
			else if ($_FILES['image']['type']=='image/jpeg')$img.=".jpg";
			else if ($_FILES['image']['type']=='image/pjpeg')$img.=".jpg";
			$uploadfile = "D:\\FtpData\\doratarjumaquran.pk\\wwwroot\\gallery\\".$img;
			if(move_uploaded_file($_FILES['image']['tmp_name'], $uploadfile))
			{
				$insertSQL="update gallery set image='".$img."' where ImageId=".$imid;
				mysqli_select_db($connDoraTarjumaQuran, $database_connDoraTarjumaQuran);
				$Result1 = mysqli_query($insertSQL) or die(mysqli_error());
				$insertGoTo .= "?m=s";//message = upload success
			}
			else $insertGoTo .= "?m=f";//message = upload failed
			header(sprintf("Location: %s", $insertGoTo));
		}	
		else 
		{
			$insertGoTo .= "?m=u&f=".$_FILES['image']['type'];//message = Unknown Format
			header(sprintf("Location: %s", $insertGoTo));
		}
	}
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta name="keywords" content="quran qur'an koran tafseer tafsir exegesis explanation dars arabic downloads books articles quiz questions answers taraveeh taravih prayer ramzan ramadhan roza fasting islam jihad dr israr pakistan khilafat caliphate muslims tanzeem e islami nifaz e shariat islami nizam">
<meta name="description" content="quran qur'an koran tafseer tafsir exegesis explanation dars arabic downloads books articles quiz questions answers taraveeh taravih prayer ramzan ramadhan roza fasting islam jihad dr israr pakistan khilafat caliphate muslims tanzeem e islami nifaz e shariat islami nizam">
<title>Dora Tarjuma Quran Gallery, Images of Quran and Dora Tarjuma Quran</title>
<style type="text/css">
<!--
.style2 {
	color: #FF0000;
	font-weight: bold;
}
-->
</style>
<?php include("header.php"); ?>
</head><body bgcolor="#669933">
<table align="center" width="800" border="1" cellpadding="0" bgcolor="#CCEEAA"  cellspacing="0"><tr><th><h1 align="center">Dora Tarjuma Quran Gallery</h1></th></tr>
</table>
<table width="800" border="1" align="center" cellpadding="0" bgcolor="#CCEEAA"  cellspacing="0">
  <?php $i=0; while ($i<$total)
	{  
		echo '<tr>';
    	for($c=0;$c<4;$c++)
		{if($i<$total){echo '<td scope="col"><img src="'.$res[$i].'" width="198" height="198" /></td>';}$i++;}
		echo '</tr>';
	}?>
</table>
<form id="form1" name="form1" enctype="multipart/form-data" method="post" action="<?php echo $editFormAction; ?>">
<table width="800" border="1" align="center" cellpadding="0" bgcolor="#CCEEAA"  cellspacing="0">
<tr><th>
<h2 align="center">Upload Images from Dora Tarjuma Quran</h2><span class="style2"><?php if(!isset($_SESSION['UserId'])or(isset($_SESSION['UserId'])and $_SESSION['UserId']==0)) echo 'You need to be signed in to upload a picture.<br />Please <a href="signin.php?u=g">Sign In</a> or <a href="signup.php">Create an account.</a><br  />';?></span>
<input type="hidden" name="MAX_FILE_SIZE" value="1000000" />
Image<input type="file" name="image" size="40"/><br />
Only Jpeg and Gif files with size not more than 1mb<br  />
Tags<input name="tags" type="text" size="54" /><br />
<input type="submit" name="Submit" value="Upload" <?php if(!isset($_SESSION['UserId'])or(isset($_SESSION['UserId'])and $_SESSION['UserId']==0)) echo 'disabled="disabled"';?>/>
<br  /><?php if(isset($_GET['m']))
{
	if ($_GET['m']=='s')echo 'An image was uploaded successfully, you will see it here once it is approved.';
	else if ($_GET['m']=='f')echo 'Image upload failed.';
	else if ($_GET['m']=='u')echo 'Unknown Format: '.$_GET['f'];
}?></th></tr></table>
<input type="hidden" name="MM_insert" value="form1">
</form>
</body>
<?php include("footer.php"); ?>
</html>