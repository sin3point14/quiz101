<?php
session_start();
if(!(isset($_SESSION['uid']))){
  echo "<script>window.location='/quizlol/index.php'</script>";
}
if(!(isset($_REQUEST['qid'])&&(isset($_REQUEST['option'])))){
  echo "<script>window.location='/quizlol/home.php'</script>";
}
define('DB_HOST', 'localhost');
define('DB_NAME', 'quiz');
define('DB_USER', 'root');
define('DB_PASSWORD', '');
$con = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or die("Failed to connect to MySQL: " . mysqli_error());
if (mysqli_connect_errno())
{
echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
$uid=$_SESSION['uid'];
$qid=$_REQUEST['qid'];
$option=$_REQUEST['option'];
$query=mysqli_query($con, "Select * from answered where qid=$qid and uid=$uid") or die("Failed to connect to MySQL: " . mysqli_error($con));
$row=mysqli_fetch_array($query);
if(!$row){
$option=$_REQUEST['option'];
$query=mysqli_query($con, "Select * from ques where qid=$qid") or die("Failed to connect to MySQL: " . mysqli_error($con));
$row=mysqli_fetch_array($query);
if($option==$row['answer']){
$query=mysqli_query($con, "UPDATE users SET points = points + ".$row['points']." WHERE uid=$uid") or die("Failed to connect to MySQL: " . mysqli_error($con));

$query=mysqli_query($con, "INSERT INTO answered (uid,qid,points) values($uid,$qid,".$row['points'].")") or die("Failed to connect to MySQL: " . mysqli_error($con));
	echo "Correct answer!";
}
else{
	echo "Incorrect answer";
}
}
else{
	echo "Question already attempted";
}
?>