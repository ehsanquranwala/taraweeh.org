<?php require_once('Connections/connDoraTarjumaQuran.php'); ?>
<?php
if (!isset($_SESSION))session_start();
if (!isset($_SESSION['UserId'])) {$_SESSION['UserId'] = 0;}
$uid=$_SESSION['UserId'];
if(isset($_GET['qid']))$qid=$_GET['qid'];else $qid=1;

mysqli_select_db($connDoraTarjumaQuran, $database_connDoraTarjumaQuran);
$query_rs_WrongAnswersCount = "SELECT count(ua.QuestionId) as wac FROM questions q join user_answers ua join quiz_questions qq WHERE q.QuestionId=qq.QuestionId and ua.QuestionId=q.QuestionId and (!(ua.GivenAnswer<=>q.CorrectAnswer)) and qq.QuizId=".$qid." and ua.UserId=".$uid;
$rs_WrongAnswersCount = mysqli_query($connDoraTarjumaQuran, $query_rs_WrongAnswersCount) or die(mysqli_error());
$row_rs_WrongAnswersCount = mysqli_fetch_assoc($rs_WrongAnswersCount);
$totalRows_rs_WrongAnswersCount = mysqli_num_rows($rs_WrongAnswersCount);

mysqli_select_db($connDoraTarjumaQuran, $database_connDoraTarjumaQuran);
$query_rs_CorrectAnswersCount = "SELECT count(ua.QuestionId) as cac FROM questions q join user_answers ua join quiz_questions qq WHERE q.QuestionId=qq.QuestionId and ua.QuestionId=q.QuestionId and ua.GivenAnswer=q.CorrectAnswer and qq.QuizId=".$qid." and ua.UserId=".$uid;
$rs_CorrectAnswersCount = mysqli_query($connDoraTarjumaQuran, $query_rs_CorrectAnswersCount) or die(mysqli_error());
$row_rs_CorrectAnswersCount = mysqli_fetch_assoc($rs_CorrectAnswersCount);
$totalRows_rs_CorrectAnswersCount = mysqli_num_rows($rs_CorrectAnswersCount);

mysqli_select_db($connDoraTarjumaQuran, $database_connDoraTarjumaQuran);
$query_rs_QuizQuestions = "SELECT q.QuestionId, q.Question, q.A, q.B, q.C, q.CorrectAnswer, ua.GivenAnswer FROM questions q join quiz_questions qq join user_answers ua WHERE q.QuestionId=qq.QuestionId and q.QuestionId=ua.QuestionId and qq.QuizId=".$qid." and ua.UserId=".$uid;
$rs_QuizQuestions = mysqli_query($connDoraTarjumaQuran, $query_rs_QuizQuestions) or die(mysqli_error());
$row_rs_QuizQuestions = mysqli_fetch_assoc($rs_QuizQuestions);
$totalRows_rs_QuizQuestions = mysqli_num_rows($rs_QuizQuestions);

mysqli_select_db($connDoraTarjumaQuran, $database_connDoraTarjumaQuran);
$query_rs_Topics = "SELECT quiz.Topic, quiz.Links FROM quiz where quiz.QuizId=".$qid;
$rs_Topics = mysqli_query($connDoraTarjumaQuran, $query_rs_Topics) or die(mysqli_error());
$row_rs_Topics = mysqli_fetch_assoc($rs_Topics);
$totalRows_rs_Topics = mysqli_num_rows($rs_Topics);
?>
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
<table align="center" width="800" border="1" cellspacing="0" cellpadding="0"  bgcolor="#99CC66" >
  <tr>
    <th width="28%" scope="col"><?php
$today = getdate();
echo $today['weekday'].','.$today['mday'].' '.$today['month'].' '.$today['year'];?></th>
	<th width="43%" scope="col"><h2 align="center">Result of Quiz No <?php echo $qid;?></h2></th>
	<th width="29%" scope="col"><?php echo $qid;?> Ramadhan-ul-Mubarak 1428</th>
  </tr>
</table>
<table align="center" width="800" border="1" cellpadding="0" bgcolor="#CCEEAA"  cellspacing="0"><tr><td align="center"><?php echo $row_rs_Topics['Links'];?></td></tr><tr><td align="center">
<span class="style2">
Marks gained: <?php $mg=$row_rs_CorrectAnswersCount['cac']*10;echo $mg;?> out of <?php $tm=($row_rs_CorrectAnswersCount['cac']+$row_rs_WrongAnswersCount['wac'])*10;echo $tm;?></span><br  />
  <span class="style3">Your <a href="resultall.php">Overall Result</a> So Far</span></td></tr></table>
<table width="800" align="center" border="1" cellpadding="0" bgcolor="#CCEEAA"  cellspacing="0">  
<tr><th bgcolor="#99CC66"><?php echo $row_rs_Topics['Topic'];?> </th>
</tr>
<tr>
    <td valign="top" width="50%" scope="col"><table align="center" width="600" border="1" cellspacing="0" cellpadding="0" bgcolor="#CCEEAA" >
      <tr bgcolor="#99CC66">
        <th width="5%" scope="col">QNo</th>
        <th width="85%" scope="col">Question</th>
        <th width="5%" scope="col">Your Answer</th>
        <th width="5%" scope="col">Correct Answer</th>
      </tr>
      <?php $qno=1; do {  
echo '<tr>
<td>'.$qno.'</td>
<td><strong>'.$row_rs_QuizQuestions['Question'].'</strong><br />(a) '.$row_rs_QuizQuestions['A'].'<br />(b) '.$row_rs_QuizQuestions['B'].'<br />(c) '.$row_rs_QuizQuestions['C'].'</td><td>'.$row_rs_QuizQuestions['GivenAnswer'].'</td><td>'.$row_rs_QuizQuestions['CorrectAnswer'].'</td></tr>';
$qno++;
	} while ($row_rs_QuizQuestions = mysqli_fetch_assoc($rs_QuizQuestions));
  $rows = mysqli_num_rows($rs_QuizQuestions);
  if($rows > 0) {
      mysqli_data_seek($rs_QuizQuestions, 0);
	  $row_rs_QuizQuestions = mysqli_fetch_assoc($rs_QuizQuestions);}
  ?>
    </table></td></tr></table>
<table align="center" cellspacing="0" cellpadding="0" bgcolor="#CCEEAA"  border="1" width="800">
      <tr><td align="center"><img src="Quiz/quiz<?php echo $qid;?>.gif"/></td></tr>
    </table>
</body>
<?php include("footer.php"); ?>
</html>
<?php
mysqli_free_result($rs_Topics);
mysqli_free_result($rs_QuizQuestions);
mysqli_free_result($rs_WrongAnswersCount);
mysqli_free_result($rs_CorrectAnswersCount);
?>