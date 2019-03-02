<?php
error_reporting(-1);
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
  #main{
  	font-family: arial;
     display: grid;
    height: 100vh;
    grid-template-rows: 1fr 6fr 1fr;
    grid-template-columns: 1fr 6fr 1fr;
  }
  .container{
    grid-column-start: 2;
    grid-column-end: 3;
    grid-row-start: 2;
    grid-row-end: 3;
 }
 .leader{
 	font-size: 40px;
 	padding: 30px;
 	background-color:#2196F3;	
 	color: white; 
 }
 .container p{
    background-color: #ddffff;
    padding: 20px;
    padding-left: 0;s
  }
  .container span{
    background-color: #2196F3;
    padding: 20px;
    color: white;
    margin-right: 20px;
  }
  .q_holder{
    cursor: pointer;
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
  <a href="home.php" style="text-align:center;margin-top:60px;" class="w3-bar-item w3-button"><h3>Home</h3></a>
  <a href="#" style="text-align:center;" class="w3-bar-item w3-button"><h3>Questions</h3></a>
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
<div class="leader">Questions</div>
<?php
$query=mysqli_query($con, "SELECT qid,title from ques order by qid");
while($row=mysqli_fetch_array($query)){
  echo "<p id='".$row[0]."'' class='q_holder' onclick='question(this)''><span>".$row[0]."</span>  ".$row[1]." </p>";
}
?>

<script type="text/javascript">function question(e){
  window.location="ques.php?qid="+e.id;
}

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

</script>



</body>
</html>