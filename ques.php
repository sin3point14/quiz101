<?php
session_start();
if(!(isset($_SESSION['uid']))){
  echo "<script>window.location='/quizlol/index.php'</script>";
}
if(!(isset($_REQUEST['qid']))){
  echo "<script>window.location='/quizlol/question.php'</script>";
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
$query=mysqli_query($con, "Select * from ques where qid='".$_REQUEST['qid']."'") or die("Failed to connect to MySQL: " . mysqli_error($con));
$row=mysqli_fetch_array($query);
$qid=$_REQUEST['qid'];;
$title=$row['title'];
$q=$row['q'];
$points=$row['points'];
$o1=$row['o1'];
$o2=$row['o2'];
$o3=$row['o3'];
$o4=$row['o4'];
?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="style2.css">

	<title>quiz1o1</title>
</head>

<style type="text/css">
#added{
    position: fixed;
    width: 250px;
    top:80vh;
    left: 100vw;
    padding: 10px;
    font-size: 20px;
    font-family: arial;
    background-color: #ddffff;
    border-left: 6px solid #2196F3;
    transition: all 0.5s ease;
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
  .container{
    display: grid;
    height: 100vh;
    grid-template-rows: 1fr 6fr 1fr;
    grid-template-columns: 1fr 6fr 1fr;
  }
  .q{
    grid-column-start: 2;
    grid-column-end: 3;
    grid-row-start: 2;
    grid-row-end: 3;
 }
   .q .title{
    background-color: #ddffff;
    padding: 20px;
    padding-left: 0;
    font-size: 40px;
    display: inline-block;
    margin-left: 20px;
  }
  .q .qno{
    background-color: #2196F3;
    padding: 15px;
    color: white;
    margin-right: 20px;
    font-size: 40px;
    width: 100%;  
    position: relative;
    left: -20px;
  }
  .hline{
    margin-top: 30px;
    height: 1px;
    background-color: #0303033b;
    margin-left: 100px;
    margin-right: 100px;
    margin-bottom: 30px;
  }
 ul{
    list-style: none;
    margin: 0;
    padding: 0;
    overflow: auto;
  }

  ul li{
    color: #AAAAAA;
    display: block;
    position: relative;
    float: left;
    width: 100%;
    height: 100px;
    border-bottom: 1px solid #333;
  }

  ul li input[type=radio]{
    position: absolute;
    visibility: hidden;
  }

  ul li label{
    display: block;
    position: relative;
    font-weight: 300;
    font-size: 1.35em;
    padding: 25px 25px 25px 80px;
    margin: 10px auto;
    height: 30px;
    z-index: 9;
    cursor: pointer;
    -webkit-transition: all 0.25s linear;
  }

  ul li:hover label{
    color: #FFFFFF;
  }

  ul li .check{
    display: block;
    position: absolute;
    border: 5px solid #AAAAAA;
    border-radius: 100%;
    height: 25px;
    width: 25px;
    top: 30px;
    left: 20px;
    z-index: 5;
    transition: border .25s linear;
    -webkit-transition: border .25s linear;
  }

  ul li:hover .check {
    border: 5px solid #FFFFFF;
  }

  ul li .check::before {
    display: block;
    position: absolute;
    content: '';
    border-radius: 100%;
    height: 15px;
    width: 15px;
    top: 5px;
    left: 5px;
    margin: auto;
    transition: background 0.25s linear;
    -webkit-transition: background 0.25s linear;
  }

  input[type=radio]:checked ~ .check {
    border: 5px solid #0DFF92;
  }

  input[type=radio]:checked ~ .check::before{
    background: #0DFF92;
  }

  input[type=radio]:checked ~ label{
    color: #0DFF92;
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
  <a href="question.php" style="text-align:center;" class="w3-bar-item w3-button"><h3>Questions</h3></a>
  <a href="#" style="text-align:center;" class="w3-bar-item w3-button"><h3>Report</h3></a>
</div>
<div id="main">
<button id="openNav" class="w3-button w3-teal w3-xlarge" style="position: absolute;background-color: #2196F3" onclick="w3_open()">&#9776;</button>


<div class="container">
  <div class="q">
    <p class="title"><span id="qid" class="qno"><?php echo "$qid" ?></span><?php echo "$title" ?></p>
  <div id="question"><?php echo "$q" ?></div><div class="hline"></div>
  <ul>
  <li><input type="radio" name="mcq" id="o1" value="1" checked/><label for="o1"><?php echo "$o1" ?></label><div class="check"><div class="inside"></div></div></li>
  <li><input type="radio" name="mcq" id="o2" value="2"/><label for="o2"><?php echo "$o2" ?></label><div class="check"><div class="inside"></div></div></li>
  <li><input type="radio" name="mcq" id="o3" value="3"/><label for="o3"><?php echo "$o3" ?></label><div class="check"><div class="inside"></div></div></li>
  <li><input type="radio" name="mcq" id="o4" value="4"/><label for="o4"><?php echo "$o4" ?></label><div class="check"><div class="inside"></div></div></li>
  </ul>
  <div class="points">Points- <?php echo "$points" ?></div>
  <button onclick="submi()">submit</button>
</div>
<div id="added"></div>
</div>
</div>
<script>
  function added(){
  var x=document.getElementById("added");
  x.style.marginLeft="-280px";
  setTimeout(function(){x.style.marginLeft="0px";},2500)
}
  function submi(){
  var op = String(document.querySelector('input[name = "mcq"]:checked').value);
  var qid= <?php echo "$qid" ?>;
  var xmlhttp= new XMLHttpRequest();
    xmlhttp.onreadystatechange=function(){
        if (this.readyState == 4 && this.status == 200) {
          document.getElementById('added').innerHTML=this.responseText;
          added();
        }
    };
    xmlhttp.open("POST", "check.php?option="+op+"&qid="+qid, true);
    xmlhttp.send();}
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