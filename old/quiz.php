<?php require_once('Connections/connDoraTarjumaQuran.php'); ?>
<?php
if (!isset($_SESSION)) session_start();
///$_SESSION['UserId'] = 2;

if(isset($_GET['qid']))$qid=$_GET['qid'];else $qid=1;

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
$startqno=($qid-1)*10;
$uid=$_SESSION['UserId'];
$ans=array('NULL','NULL','NULL','NULL','NULL','NULL','NULL','NULL','NULL','NULL');
if(isset($_POST['a1']))$ans[0]="'".$_POST['a1']."'";
if(isset($_POST['a2']))$ans[1]="'".$_POST['a2']."'";
if(isset($_POST['a3']))$ans[2]="'".$_POST['a3']."'";
if(isset($_POST['a4']))$ans[3]="'".$_POST['a4']."'";
if(isset($_POST['a5']))$ans[4]="'".$_POST['a5']."'";
if(isset($_POST['a6']))$ans[5]="'".$_POST['a6']."'";
if(isset($_POST['a7']))$ans[6]="'".$_POST['a7']."'";
if(isset($_POST['a8']))$ans[7]="'".$_POST['a8']."'";
if(isset($_POST['a9']))$ans[8]="'".$_POST['a9']."'";
if(isset($_POST['a10']))$ans[9]="'".$_POST['a10']."'";

$insertSQL = sprintf("INSERT INTO user_answers(UserId, QuestionId, GivenAnswer) VALUES (%s, %s, %s),(%s, %s, %s),(%s, %s, %s),(%s, %s, %s),(%s, %s, %s),(%s, %s, %s),(%s, %s, %s),(%s, %s, %s),(%s, %s, %s),(%s, %s, %s) on duplicate key UPDATE GivenAnswer= values(GivenAnswer)",
                       $uid,$startqno+1,$ans[0],
					   $uid,$startqno+2,$ans[1],
					   $uid,$startqno+3,$ans[2],
					   $uid,$startqno+4,$ans[3],
					   $uid,$startqno+5,$ans[4],
					   $uid,$startqno+6,$ans[5],
					   $uid,$startqno+7,$ans[6],
					   $uid,$startqno+8,$ans[7],
					   $uid,$startqno+9,$ans[8],
					   $uid,$startqno+10,$ans[9]);

  mysqli_select_db($connDoraTarjumaQuran, $database_connDoraTarjumaQuran);
  $Result1 = mysqli_query($insertSQL) or die(mysqli_error());

$insertSQL = sprintf("INSERT INTO user_quiz(UserId, QuizId, CorrectAnswers, WrongAnswers) VALUES (%s, %s, (SELECT count(ua.QuestionId) as cac FROM questions q join user_answers ua join quiz_questions qq WHERE q.QuestionId=qq.QuestionId and ua.QuestionId=q.QuestionId and ua.GivenAnswer=q.CorrectAnswer and ua.UserId=%s and qq.QuizId=%s),(SELECT count(ua.QuestionId) as wac FROM questions q join user_answers ua join quiz_questions qq WHERE q.QuestionId=qq.QuestionId and ua.QuestionId=q.QuestionId and (!(ua.GivenAnswer<=>q.CorrectAnswer)) and ua.UserId=%s and qq.QuizId=%s)) on duplicate key update CorrectAnswers=values(CorrectAnswers), WrongAnswers=values(WrongAnswers)",$uid, $qid, $uid, $qid, $uid, $qid);

  mysqli_select_db($connDoraTarjumaQuran, $database_connDoraTarjumaQuran);
  $Result1 = mysqli_query($insertSQL) or die(mysqli_error());

  $insertGoTo = "result1.php?qid=".$qid;
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

mysqli_select_db($connDoraTarjumaQuran, $database_connDoraTarjumaQuran);
$query_rs_QuizQuestions = "SELECT questions.QuestionId, questions.Question, questions.A, questions.B, questions.C FROM questions join quiz_questions WHERE questions.QuestionId = quiz_questions.QuestionId and quiz_questions.QuizId=".$qid;
$rs_QuizQuestions = mysqli_query($connDoraTarjumaQuran, $query_rs_QuizQuestions) or die(mysqli_error());
$row_rs_QuizQuestions = mysqli_fetch_assoc($rs_QuizQuestions);
$totalRows_rs_QuizQuestions = mysqli_num_rows($rs_QuizQuestions);

mysqli_select_db($connDoraTarjumaQuran, $database_connDoraTarjumaQuran);
$query_rs_Topics = "SELECT quiz.Topic, quiz.Links FROM quiz where quiz.QuizId=".$qid;
$rs_Topics = mysqli_query($connDoraTarjumaQuran, $query_rs_Topics) or die(mysqli_error());
$row_rs_Topics = mysqli_fetch_assoc($rs_Topics);
$totalRows_rs_Topics = mysqli_num_rows($rs_Topics);
?>
<br />
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="ontent-Type" content="text/html; charset=iso-8859-1" />
<title>Daily Quiz</title>
<style type="text/css">
<!--
.style2 {font-size: x-large}
.style3 {
	font-size: large;
	color: #FF0000;
}
-->
</style>
<?php include("header.php"); ?>

</head><body bgcolor="#669933">
<table width="800" align="center" border="1" cellspacing="0" cellpadding="0" bgcolor="#CCEEAA" >
<tr><td align="center"><h1 align="center"><?php echo $row_rs_Topics['Topic'];?></h1>You can download the audio files for this quiz from the links below.<br  /><?php echo $row_rs_Topics['Links'];?></td></tr>
<tr><th scope="col" bgcolor="#99CC66"><table width="800" align="center"><tr><td width="33%" valign="middle" align="left"><?php
$today = getdate();
echo $today['weekday'].','.$today['mday'].' '.$today['month'].' '.$today['year'];?></td><td width="33%" valign="bottom" align="center"><h2>Quiz No <?php echo $qid;?></h2></td>
<td width="33%" valign="middle" align="right"><?php echo $qid;?> Ramadhan-ul-Mubarak 1428</td></tr></table></th></tr>
<tr>
  <th scope="col"><a name="ans" id="ans"></a>Choose the correct answer for the questions given below.(<a href="#eng">English</a> <a href="#urdu">Urdu</a>)
    <form id="form1" name="form1" method="post" action="<?php echo $editFormAction; ?>">
<table align="center" width="12%" border="1" cellspacing="0" cellpadding="0" bgcolor="#CCEEAA" >
<tr>
<th width="26%" scope="col">QNo</th>
<th width="26%" scope="col">A</th>
<th width="24%" scope="col">B</th>
<th width="24%" scope="col">C</th>
</tr>
<tr>
<td>1</td>
<td>
<input type="radio" name="a1" value="A" />
</td>
<td>  
<input type="radio" name="a1" value="B" />
</td>
<td>  
<input type="radio" name="a1" value="C" />
</td>
</tr>
<tr>
<td>2</td>
<td>  
<input type="radio" name="a2" value="A" />
</td>
<td>  
<input type="radio" name="a2" value="B" />
</td>
<td>  
<input type="radio" name="a2" value="C" />
</td>
</tr>
<tr>
<td>3</td>
<td>  
<input type="radio" name="a3" value="A" />
</td>
<td>  
<input type="radio" name="a3" value="B" />
</td>
<td>  
<input type="radio" name="a3" value="C" />
</td>
</tr>
<tr>
<td>4</td>
<td>  
<input type="radio" name="a4" value="A" />
</td>
<td>  
<input type="radio" name="a4" value="B" />
</td>
<td>  
<input type="radio" name="a4" value="C" />
</td>
</tr>
<tr>
<td>5</td>
<td>  
<input type="radio" name="a5" value="A" />
</td>
<td>  
<input type="radio" name="a5" value="B" />
</td>
<td>  

<input type="radio" name="a5" value="C" />
</td>
</tr>
<tr>
<td>6</td>
<td>  
<input type="radio" name="a6" value="A" />
</td>
<td>  

<input type="radio" name="a6" value="B" />
</td>
<td>  
<input type="radio" name="a6" value="C" />
</td>
</tr>
<tr>
<td>7</td>
<td>  
<input type="radio" name="a7" value="A" />
</td>
<td>  

<input type="radio" name="a7" value="B" />
</td>
<td>  
<input type="radio" name="a7" value="C" />
</td>
</tr>
<tr>
<td>8</td>
<td>  
<input type="radio" name="a8" value="A" />
</td>
<td>  
<input type="radio" name="a8" value="B" />
</td>
<td>  

<input type="radio" name="a8" value="C" />
</td>
</tr>
<tr>
<td>9</td>
<td>  
<input type="radio" name="a9" value="A" />
</td>
<td>  
<input type="radio" name="a9" value="B" />
</td>
<td>  
<input type="radio" name="a9" value="C" />
</td>
</tr>
<tr>
<td>10</td>
<td>  
<input type="radio" name="a10" value="A" />
</td>
<td>  
<input type="radio" name="a10" value="B" />
</td>
<td>  
<input type="radio" name="a10" value="C" />
</td>
</tr>
</table>
<table align="center">
<tr>
<td align="center">
<input <?php if(!isset($_SESSION['UserId'])or($_SESSION['UserId']==0)) echo 'disabled="disabled"';?> align="absmiddle" type="submit" value="Done"><br  />
<span class="style3">
<?php if(!isset($_SESSION['UserId']) or ($_SESSION['UserId']==0)) echo 'You need to be <a href="signin.php?u=qi">signed in</a> for taking a quiz';?></span>
</td>
</tr>
</table>
<input type="hidden" name="MM_insert" value="form1">
</form>
</th></tr></table>
<table width="800" align="center" border="1" cellspacing="0" cellpadding="0" bgcolor="#CCEEAA" >
<tr><td ></td><td align="center"><a name="eng" id="eng"></a><a href="#ans">Top</a> <a href="#urdu">Urdu</a></td></tr>
 <?php $qno=1; do {  
echo '<tr>
<td><strong>Q.'.$qno.')</strong></td>
<td><strong>'.$row_rs_QuizQuestions['Question'].'</strong><br />(a) '.$row_rs_QuizQuestions['A'].'<br />(b) '.$row_rs_QuizQuestions['B'].'<br />(c) '.$row_rs_QuizQuestions['C'].'</td></tr>';
$qno++;
	} while ($row_rs_QuizQuestions = mysqli_fetch_assoc($rs_QuizQuestions));
  $rows = mysqli_num_rows($rs_QuizQuestions);
  if($rows > 0) {
      mysqli_data_seek($rs_QuizQuestions, 0);
	  $row_rs_QuizQuestions = mysqli_fetch_assoc($rs_QuizQuestions);}
  ?>
</table>
<table align="center" width="800" cellspacing="0" cellpadding="0" bgcolor="#CCEEAA"  border="1"><tr><td align="center">
<a name="urdu" id="urdu"></a><a href="#ans">Top</a> <a href="#eng">English</a></td></tr>
<tr><td align="center"><img align="absbottom" src="Quiz/quiz<?php echo $qid;?>.gif"/></td></tr><tr><td align="center"><a href="#ans">Top</a> <a href="#eng">English</a></td></tr></table>
</body>
<?php include("footer.php"); ?>
</html>
<?php
mysqli_free_result($rs_Topics);
mysqli_free_result($rs_QuizQuestions);
?>