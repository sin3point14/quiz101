<?php 

//OYE GADHE SESSION VARIABLES ASSIGNMENT CHECK KAR LENA JAB SIGNUP/SIGNIN FAIL HO

ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();
if(isset($_POST['username'])){
$username=$_POST['username'];
$pass=hash('sha256', $_POST['pass']);
define('DB_HOST', 'localhost');
define('DB_NAME', 'quiz');
define('DB_USER', 'root');
define('DB_PASSWORD', '');
$con = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or die("Failed to connect to MySQL: " . mysqli_error());
if (mysqli_connect_errno())
{
echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
if(isset($_POST['display'])){
$query=mysqli_query($con, "SELECT MAX(uid)FROM users");
$row=mysqli_fetch_array($query);
$display=$_POST['display'];
$uid=$row[0]+1;
$query=mysqli_query($con, "SELECT * from users WHERE username='".$username."'");
$row=mysqli_fetch_array($query);
if($row){
echo "<script>window.alert('Username already taken, Please try again')</script>";
goto a;
}
$query=mysqli_query($con, "SELECT * from users WHERE display='".$display."'");
$row=mysqli_fetch_array($query);
if($row){
echo "<script>window.alert('Display Name already taken, Please try again')</script>";
goto a;
}
$query=mysqli_query($con, "insert into users (uid, username, pass, display, points) values ($uid, '$username', '$pass', '$display', 0)");
$points=0;
}
else{
$query=mysqli_query($con, "SELECT * from users WHERE username='".$username."' AND pass='".$pass."'");
$row=mysqli_fetch_array($query);
if($row){
$uid=$row[0];
$display=$row[3];
$points=$row[4];
if($username=='admin'){
  $_SESSION['admin']=1;
}
else{
  $_SESSION['admin']=0;
}
}
else{
sleep(1);
echo "<script>window.alert('Incorrect username/password, Please try again')</script>";
}
}
if($row){
$_SESSION['username']=$username;
$_SESSION['uid']=$uid;
$_SESSION['display']=$display;
$_SESSION['points']=$points;
if($_SESSION['admin']==1){
echo "<script>window.location='/quizlol/admin.php'</script>";
}
else{
echo "<script>window.location='/quizlol/home.php'</script>";
}
}
a:
}
?>
<html>
  <head>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3/jquery.min.js">
    </script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-2.2.4.min.js" >
    </script>
    <style>
      @charset "UTF-8";
      @import url(https://fonts.googleapis.com/css?family=Oswald|Roboto);
      body {
        margin:0px;
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        font-family: "Roboto", sans-serif;
        background-color: #5356ad;
        overflow: hidden;
      }
      .table {
        display: table;
        width: 100%;
        height: 100%;
      }
      .table-cell {
        display: table-cell;
        vertical-align: middle;
        -moz-transition: all 0.5s;
        -o-transition: all 0.5s;
        -webkit-transition: all 0.5s;
        transition: all 0.5s;
      }
      .container {
        position: relative;
        width: 600px;
        margin: 30px auto 0;
        height: 320px;
        background-color: #999ede;
        top: 50%;
        margin-top: -160px;
        -moz-transition: all 0.5s;
        -o-transition: all 0.5s;
        -webkit-transition: all 0.5s;
        transition: all 0.5s;
      }
      .container .box {
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: hidden;
      }
      .container .box:before, .container .box:after {
        content: " ";
        position: absolute;
        left: 152px;
        top: 50px;
        background-color: #9297e0;
        transform: rotateX(52deg) rotateY(15deg) rotateZ(-38deg);
        width: 300px;
        height: 285px;
        -moz-transition: all 0.5s;
        -o-transition: all 0.5s;
        -webkit-transition: all 0.5s;
        transition: all 0.5s;
      }
      .container .box:after {
        background-color: #a5aae4;
        top: -10px;
        left: 80px;
        width: 320px;
        height: 180px;
      }
      .container .container-forms {
        position: relative;
      }
      .container .btn {
        cursor: pointer;
        text-align: center;
        margin: 0 auto;
        width: 60px;
        color: #fff;
        background-color: #ff73b3;
        opacity: 1;
        -moz-transition: all 0.5s;
        -o-transition: all 0.5s;
        -webkit-transition: all 0.5s;
        transition: all 0.5s;
      }
      .container .btn:hover {
        opacity: 0.7;
      }
      .container .btn, .container input {
        padding: 10px 15px;
      }
      .container input {
        margin: 0 auto 15px;
        display: block;
        width: 220px;
        -moz-transition: all 0.3s;
        -o-transition: all 0.3s;
        -webkit-transition: all 0.3s;
        transition: all 0.3s;
      }
      .container .container-forms .container-info {
        text-align: left;
        font-size: 0;
      }
      .container .container-forms .container-info .info-item {
        text-align: center;
        font-size: 16px;
        width: 300px;
        height: 320px;
        display: inline-block;
        vertical-align: top;
        color: #fff;
        opacity: 1;
        -moz-transition: all 0.3s;
        -o-transition: all 0.3s;
        -webkit-transition: all 0.3s;
        transition: all 0.3s;
      }
      .container .container-forms .container-info .info-item p {
        font-size: 20px;
        margin: 20px;
      }
      .container .container-forms .container-info .info-item .btn {
        background-color: transparent;
        border: 1px solid #fff;
      }
      .container .container-forms .container-info .info-item .table-cell {
        padding-right: 35px;
      }
      .container .container-forms .container-info .info-item:nth-child(2) .table-cell {
        padding-left: 35px;
        padding-right: 0;
      }
      .container .container-form {
        overflow: hidden;
        position: absolute;
        left: 30px;
        top: -30px;
        width: 305px;
        height: 380px;
        background-color: #fff;
        box-shadow: 0 0 15px 0 rgba(0, 0, 0, 0.2);
        -moz-transition: all 0.5s;
        -o-transition: all 0.5s;
        -webkit-transition: all 0.5s;
        transition: all 0.5s;
      }
      .container .container-form:before {
        content: "✔";
        position: absolute;
        left: 160px;
        top: -50px;
        color: #5356ad;
        font-size: 130px;
        opacity: 0;
        -moz-transition: all 0.5s;
        -o-transition: all 0.5s;
        -webkit-transition: all 0.5s;
        transition: all 0.5s;
      }
      .container .container-form .btn {
        position: relative;
        box-shadow: 0 0 10px 1px #ff73b3;
        margin-top: 30px;
      }
      .container .form-item {
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        opacity: 1;
        -moz-transition: all 0.5s;
        -o-transition: all 0.5s;
        -webkit-transition: all 0.5s;
        transition: all 0.5s;
      }
      .container .form-item.sign-up {
        position: absolute;
        left: -100%;
        opacity: 0;
      }
      .container.log-in .box:before {
        position: absolute;
        left: 180px;
        top: 62px;
        height: 265px;
      }
      .container.log-in .box:after {
        top: 22px;
        left: 192px;
        width: 324px;
        height: 220px;
      }
      .container.log-in .container-form {
        left: 265px;
      }
      .container.log-in .container-form .form-item.sign-up {
        left: 0;
        opacity: 1;
      }
      .container.log-in .container-form .form-item.log-in {
        left: -100%;
        opacity: 0;
      }
      .container.active {
        width: 260px;
        height: 140px;
        margin-top: -70px;
      }
      .container.active .container-form {
        left: 30px;
        width: 200px;
        height: 200px;
      }
      .container.active .container-form:before {
        content: "✔";
        position: absolute;
        left: 51px;
        top: 5px;
        color: #5356ad;
        font-size: 130px;
        opacity: 1;
      }
      .container.active input, .container.active .btn, .container.active .info-item {
        display: none;
        opacity: 0;
        padding: 0px;
        margin: 0 auto;
        height: 0;
      }
      .container.active .form-item {
        height: 100%;
      }
      .container.active .container-forms .container-info .info-item {
        height: 0%;
        opacity: 0;
      }
      .footer{
        width:100%;
        position:fixed;
        bottom:0px;
        height:60px;
        background-color: #999ede;
        border-style:solid none none none;
        border-width:4px;
        border-color:#ff73b3;
        opacity:0.6;
        text-align: right;
      }
      a{
        text-decoration: none;
      }
    </style>
  </head>
  <body>
    <div class="container">
      <div class="box">
      </div>
      <div class="container-forms">
        <div class="container-info">
          <div class="info-item">
            <div class="table">
              <div class="table-cell">
                <p>
                  Have an account?
                </p>
                <div class="btn">
                  Log in
                </div>
              </div>
            </div>
          </div>
          <div class="info-item">
            <div class="table">
              <div class="table-cell">
                <p>
                  Don't have an account? 
                </p>
                <div class="btn" id="signbtn">
                  Sign up
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="container-form">
          <div class="form-item log-in">
            <div class="table">
              <div class="table-cell">
                <input name="Username" id="usr" placeholder="Username" type="text" />
                <input name="Password" id="pass" placeholder="Password" type="Password" />
                <div class="btn"  id="logbtn">
                  Log in
                </div>
              </div>
            </div>
          </div>
          <div class="form-item sign-up">
            <div class="table">
              <div class="table-cell">
                <input id="usrs" name="usrs" placeholder="User Name" type="text" />
                <input name="city" placeholder="Display Name" type="text" id="display" />
                <input name="Password" id="passs" placeholder="Password" type="Password" />
                <div class="btn" onclick="signup()">
                  Sign up
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="footer">
      <ul style="list-style-type: none; font-size:10px; margin-right:5px;">
        <li>
          <a href="cool url">
            <b>about
            </b>
          </a>
        </li>
        <li>
          <a href='another cool url'>
            <b>contact us
            </b>
          </a>
        </li>
        <li>
          <a href="cool url returns">
            <b>business
            </b>
          </a>
        </li>
      </ul>
    </div>
    <script>
      $(".info-item .btn").click(function(){
        $(".container").toggleClass("log-in");
      }
                                );
      $(".container-form .btn").click(function(){
        $(".container").addClass("active");
      }
                                     );
      function signup(){
        setTimeout(function() {
          var usr=document.getElementById('usrs').value;
          var passw=document.getElementById('passs').value;
          var dis=document.getElementById('display').value;
          post('/quizlol/index.php/', {
            username: usr, pass:passw, display: dis}
              );
          window.location="logup.php?u="+usr+"&p="+pass+"&mob="+mob+"&c="+res;
        }
                   , 1500);
      }
      function func(){
        var usr=document.getElementById('usr').value;
        var passw=document.getElementById('pass').value;
        post('/quizlol/index.php/', {
          username: usr, pass:passw}
            );
      }
      document.getElementById('logbtn').addEventListener('click',func);
      function post(path, params, method) {
        method = method || "post";
        var form = document.createElement("form");
        form.setAttribute("method", method);
        form.setAttribute("action", path);
        for(var key in params) {
          if(params.hasOwnProperty(key)) {
            var hiddenField = document.createElement("input");
            hiddenField.setAttribute("type", "hidden");
            hiddenField.setAttribute("name", key);
            hiddenField.setAttribute("value", params[key]);
            form.appendChild(hiddenField);
          }
        }
        document.body.appendChild(form);
        form.submit();
      }
    </script> 
  </body> 
</html>
