<?php
session_start();
if(!(isset($_SESSION['uid']))){
  echo "<script>window.location='index.php'</script>";
}
include 'db_access.php';

?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="style2.css">

	<title>quiz1o1</title>
</head>

<style type="text/css">
.container{
	display: grid;
	grid-template-columns: 40px 1fr 70px 1px 70px 1fr 40px;
  grid-template-rows: 100px 100px auto 50px;
  height: 100vh;
}
.attempts_h{
  grid-column-start: 2;
  grid-column-end: 3;
  grid-row-start: 2;
  grid-row-end: 3;
  text-align: right;
}
.attempts{
  grid-column-start: 2;
  grid-column-end: 3;
  grid-row-start: 3;
  grid-row-end: 4;
  text-align: right;  
  padding-top: 20px;
}
.latest{
  grid-column-start: -2;
  grid-column-end: -3;
  grid-row-start: -2;
  grid-row-end: -3;
}
	.qno{
		height: 50px;
		width: 50px;
		font-size: 16px;
		font-family: arial;
		padding-top: 13px;
		text-align: center;
		display: inline-block;
		box-sizing: border-box;
		margin-left: 20px;
    cursor: pointer;
    margin-bottom: 40px;
	}
  .q_holder{
    cursor: pointer;
  }
  .line{
    background-color: #0303033b;
    grid-column-start: 4;
  grid-column-end: 5;
  grid-row-start: 2;
  grid-row-end: 4;
  margin-top: 100px;
  margin-bottom: 100px;
  }
  .latest p{
    background-color: #ddffff;
    padding-left: 0;
  }
  .latest span{
    background-color: #2196F3;
    padding: 20px;
    color: white;
    margin-right: 20px;
    width: 60px;
    display: inline-block;
    text-align: center;
  }
  .latest_h{
      grid-column-start: -2;
  grid-column-end: -3;
  grid-row-start: 2;
  grid-row-end: 3;
  }
  .not_a{
    background-color:#ddffff;
  }
  .correct{
    background-color:#00ff0099;
    color:white;
  }
  .incorrect{
    background-color:#ff000099;
    color:white;
  }
  .w3-button:hover{
    background-color:#2196f354!important;
  }
  #openNav{
    position: absolute;
    background-color: #2196F3!important;
  }
  #openNav:hover{
    color: #2196F3!important;
    background-color: white!important;
  }
</style>

<body>
<div class="w3-sidebar w3-bar-block w3-card w3-animate-left" style="display:none" id="mySidebar">
  <button class="w3-bar-item w3-button w3-large"
  onclick="w3_close()" style="text-align:center;"><h5>Collapse &times</h5></button>
  <img src="user.jpg" height="200" width="200" style="border-radius:50%;"><br><br><br>
  <?php
  $query = mysqli_query($con,"SELECT * FROM users WHERE uid = '".$_SESSION['uid']."'"  );
    $row = mysqli_fetch_array($query);
  echo "<div style='text-align:center;'>$row[3] <br><i>(@$row[1])</i></div><br><br><div style='text-align:center'>$row[4] Points</div>";
  ?>
  <a href="#" style="text-align:center;margin-top:60px;" class="w3-bar-item w3-button"><h3>Home</h3></a>
  <a href="/quizlol/question.php" style="text-align:center;" class="w3-bar-item w3-button"><h3>Questions</h3></a>
  <a href="/quizlol/leaderboard.php" style="text-align:center;" class="w3-bar-item w3-button"><h3>Leaderboard</h3></a>
  <?php
  if($_SESSION['admin']==1){
    echo '<a href="/quizlol/admin.php" style="text-align:center;" class="w3-bar-item w3-button"><h3>Admin Panel</h3></a>';
  }
  ?>
</div>
<div id="main">
<button id="openNav" class="w3-button w3-teal w3-xlarge" onclick="w3_open()">&#9776;</button>
<div class="container">
<div class="line"></div>
<div class="attempts">
<?php
$query=mysqli_query($con, "SELECT MAX(qid)FROM ques") or die("Failed to connect to MySQL: " . mysqli_error($con));
$row=mysqli_fetch_array($query);
$max=$row[0];
$q=array_fill(1,$max,"not_a");
$query=mysqli_query($con, "SELECT * FROM answered where uid=".$_SESSION['uid']." and status=1");
for($i=1;$row=mysqli_fetch_array($query);$i++){
	$q[$row[1]]="correct";
}
$query=mysqli_query($con, "SELECT * FROM answered where uid=".$_SESSION['uid']." and status=0");
for($i=1;$row=mysqli_fetch_array($query);$i++){
  $q[$row[1]]="incorrect";
}
for($i=1;$i<=$max;$i++){
	echo "<div onclick='question(this)' class='qno ".$q[$i]."' id='$i'>".$i."</div>";
}
?>
</div>
<div class="latest">
<?php
$query=mysqli_query($con, "SELECT qid,title FROM ques order by qid desc");
for($i=1;$i<=4;$i++){
	$row=mysqli_fetch_array($query);
	echo "<p id='".$row[0]."'' class='q_holder' onclick='question(this)''><span>".$row[0]."</span>  ".$row[1]."</p>";
}
?>
</div>
<div class="attempts_h">Total points- <?php
$query=mysqli_query($con, "SELECT points FROM users where uid=".$_SESSION['uid']);
$row=mysqli_fetch_array($query);
echo $row[0];
?></div>
<div class="latest_h">Latest questions</div>
</div>
</div>
<script>
  w3_open();

function w3_open() {
  document.getElementById("main").style.marginLeft = "25%";
  document.getElementById("mySidebar").style.width = "25%";
  document.getElementById("mySidebar").style.display = "block";
  document.getElementById("openNav").style.display = 'none';
}
function w3_close() {
  document.getElementById("main").style.marginLeft = "0%";
  document.getElementById("mySidebar").style.display = "none";
  document.getElementById("openNav").style.display = "inline-block";
}
function question(e){
  window.location="ques.php?qid="+e.id;
}
</script>
</body>
</html>