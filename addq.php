<?php
session_start();
//HATA DENA GADHE
$_SESSION['admin']=1;




if(!(isset($_SESSION['admin']))){echo "shoo"; exit(0);}
define('DB_HOST', 'localhost');
define('DB_NAME', 'quiz');
define('DB_USER', 'root');
define('DB_PASSWORD', '');
$con = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or die("Failed to connect to MySQL: " . mysqli_error());
if (mysqli_connect_errno())
{
echo "Failed to connect to MySQL: " . mysqli_connect_error() ;
}

$query=mysqli_query($con, "SELECT MAX(qid)FROM ques") or die("Failed to connect to MySQL: " . mysqli_error($con));
$row=mysqli_fetch_array($query);
if(!$row){
	$row=array(1);
	$row[0]=0;
}
$qid=$row[0]+1;
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
?>