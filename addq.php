<?php
session_start();
include 'db_access.php';
$query=mysqli_query($con, "SELECT MAX(qid)FROM ques") or die("Failed to connect to MySQL: " . mysqli_error($con));
$row=mysqli_fetch_array($query);
if(!$row){
	$qid=1;
}
else {
	$qid=$row[0]+1;
}

if(empty($_REQUEST['title'])||(empty($_REQUEST['n']))||(empty($_REQUEST['p']))||(empty($_REQUEST['o']))||(empty($_REQUEST['o1']))||(empty($_REQUEST['o2']))||(empty($_REQUEST['o3']))||(empty($_REQUEST['o4']))){
echo "One or more fields empty";
}
else{	
$title=$_REQUEST['title'];
$n=$_REQUEST['n'];
$points=$_REQUEST['p'];
$answer=$_REQUEST['o'];
$o1=$_REQUEST['o1'];
$o2=$_REQUEST['o2'];
$o3=$_REQUEST['o3'];
$o4=$_REQUEST['o4'];
//$answer=$_POST['mcq'];
//$points=$_POST['points'];
$query=mysqli_query($con, "insert into ques (qid,title,q,o1,o2,o3,o4,answer,points) values ($qid,'$title','$n','$o1','$o2','$o3','$o4',$answer,$points)") or die("Failed to connect to MySQL: " . mysqli_error($con));
echo "Question has been added!";
}
?>