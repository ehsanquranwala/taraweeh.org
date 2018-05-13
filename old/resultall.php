<?php require_once('Connections/connDoraTarjumaQuran.php'); ?>
<?php
if (!isset($_SESSION))	session_start();
if (!isset($_SESSION['UserId'])) {$_SESSION['UserId'] = 0;}
$uid=$_SESSION['UserId'];

mysqli_select_db($connDoraTarjumaQuran, $database_connDoraTarjumaQuran);
$query_rs_QuizzesTaken = "SELECT * FROM user_quiz uq join quiz q where uq.QuizId=q.QuizId and uq.UserId=".$uid." ORDER BY uq.QuizId asc";
$rs_QuizzesTaken = mysqli_query($connDoraTarjumaQuran, $query_rs_QuizzesTaken) or die(mysqli_error());
$totalRows_rs_QuizzesTaken = mysqli_num_rows($rs_QuizzesTaken);

mysqli_select_db($connDoraTarjumaQuran, $database_connDoraTarjumaQuran);
$query_rs_TotalQuizzes = "select count(*) as quizzestaken from user_quiz where UserId=".$uid;
$rs_TotalQuizzes = mysqli_query($connDoraTarjumaQuran, $query_rs_TotalQuizzes) or die(mysqli_error());
$row_rs_TotalQuizzes = mysqli_fetch_assoc($rs_TotalQuizzes);
$totalRows_rs_TotalQuizzes = mysqli_num_rows($rs_TotalQuizzes);

mysqli_select_db($connDoraTarjumaQuran, $database_connDoraTarjumaQuran);
$query_rs_TotalCorrect = "select sum(CorrectAnswers) as totalcorrect from user_quiz where UserId=".$uid;
$rs_TotalCorrect = mysqli_query($connDoraTarjumaQuran, $query_rs_TotalCorrect) or die(mysqli_error());
$row_rs_TotalCorrect = mysqli_fetch_assoc($rs_TotalCorrect);
$totalRows_rs_TotalCorrect = mysqli_num_rows($rs_TotalCorrect);

mysqli_select_db($connDoraTarjumaQuran, $database_connDoraTarjumaQuran);
$query_rs_TotalWrong = "select sum(WrongAnswers) as totalwrong from user_quiz where UserId=".$uid;
$rs_TotalWrong = mysqli_query($connDoraTarjumaQuran, $query_rs_TotalWrong) or die(mysqli_error());
$row_rs_TotalWrong = mysqli_fetch_assoc($rs_TotalWrong);
$totalRows_rs_TotalWrong = mysqli_num_rows($rs_TotalWrong);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="ontent-Type" content="text/html; charset=iso-8859-1" />
<title>Quiz Results for the daily online quiz from Dora Tarjuma Quran</title>
<style type="text/css">
<!--
.style2 {font-size: x-large}
-->
</style>
<?php include("header.php"); ?>
</head><body bgcolor="#669933">
<table align="center" width="800" border="1" cellspacing="0" cellpadding="0" bgcolor="#CCEEAA" >
  <tr>
	<th scope="col"><h1 align="center">Result of All Quizzes Taken</h1>You have so far taken <?php echo $row_rs_TotalQuizzes['quizzestaken']; ?> out of 29 Quizzes with <strong>(<?php $total=$row_rs_TotalWrong['totalwrong']+$row_rs_TotalCorrect['totalcorrect']; if($total){$per=$row_rs_TotalCorrect['totalcorrect']/$total*100;}else $per=0; echo $per;?>%)</strong> correct answers.</th></tr><tr><td align="center">Click on one of the quizzes to see its detailed result.<br  />You can also retake a quiz, results will be overwritten by the latest attempt</td></tr>
</table>
<table align="center" width="800" border="1" cellspacing="0" cellpadding="0" bgcolor="#CCEEAA" >
      <tr bgcolor="#99CC66">
        <th width="5%" scope="col">QNo</th>
        <th width="85%" scope="col">Quiz Topic</th>
        <th width="5%" scope="col">Correct Answers</th>
        <th width="5%" scope="col">Wrong Answers</th>
      </tr>
      <?php $qno=1; while ($row_rs_QuizzesTaken = mysqli_fetch_assoc($rs_QuizzesTaken)){
echo '<tr>
<td align="center">'.$qno.'</td>
<td><a href="result1.php?qid='.$row_rs_QuizzesTaken['QuizId'].'">'.$row_rs_QuizzesTaken['Topic'].'</a></td><td align="center"><strong>'.$row_rs_QuizzesTaken['CorrectAnswers'].'</strong></td><td align="center"><strong>'.$row_rs_QuizzesTaken['WrongAnswers'].'</strong></td></tr>';
$qno++;
	}
  $rows = mysqli_num_rows($rs_QuizzesTaken);
  if($rows > 0) {
      mysqli_data_seek($rs_QuizzesTaken, 0);
	  $row_rs_QuizzesTaken = mysqli_fetch_assoc($rs_QuizzesTaken);}
  ?>
    <tr align="center">
        <th width="5%" scope="col">&nbsp;</th>
        <th width="85%" scope="col"><?php if($rows > 0) echo 'Total';else echo 'No Quizzes attempted yet.';?></th>
        <th width="5%" scope="col"><?php echo $row_rs_TotalCorrect['totalcorrect'];?>&nbsp;</th>
        <th width="5%" scope="col"><?php echo $row_rs_TotalWrong['totalwrong'];?>&nbsp;</th>
      </tr>
</table>
</body>
<?php include("footer.php"); ?>
</html>
<?php
mysqli_free_result($rs_QuizzesTaken);
mysqli_free_result($rs_TotalQuizzes);
mysqli_free_result($rs_TotalCorrect);
mysqli_free_result($rs_TotalWrong);
?>