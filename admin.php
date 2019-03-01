<?php
//OYE ISKO HATANA MAT BOOLNA
session_start();
$_SESSION['admin']=1;



if(!(isset($_SESSION['admin']))){
	echo 'shoo';
	exit(0);
}
?>
<!DOCTYPE html>
<html>
<head>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<title>admin</title>
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
</style>
<body>


<!--<form id="form" action="addq.php">-->
	<h1>Add a question</h1>
	<input type="text" name="q_title"/>
	<input type="text" name="q"/>
	<p class="op"><input type="radio" name="mcq" value="1" checked/><input type="text" name="o1"/></p>
	<p class="op"><input type="radio" name="mcq" value="2"/><input type="text" name="o2"/></p>
	<p class="op"><input type="radio" name="mcq" value="3"/><input type="text" name="o3"/></p>
	<p class="op"><input type="radio" name="mcq" value="4"/><input type="text" name="o4"/></p>
	<input type="number" id="points"/>
	<button onclick="addq()">submit</button>
<!--</form>-->
<div id="added">Question has been added!</div>



<script>
function added(){
	var x=document.getElementById("added");
	x.style.marginLeft="-280px";
	setTimeout(function(){x.style.marginLeft="0px";},2500)
}

function addq(){
	var name= document.getElementsByName('q')[0].value;
	var title= document.getElementsByName('q_title')[0].value;
	var op = String(document.querySelector('input[name = "mcq"]:checked').value);
	var points = String(document.getElementById('points').value);
	var o1=String(document.getElementsByName('o1')[0].value);
	var o2=String(document.getElementsByName('o2')[0].value);
	var o3=String(document.getElementsByName('o3')[0].value);
	var o4=String(document.getElementsByName('o4')[0].value);
	var xmlhttp= new XMLHttpRequest();
    xmlhttp.onreadystatechange=function(){
        if (this.readyState == 4 && this.status == 200) {
        	added();
        }
    };
    xmlhttp.open("POST", "addq.php?n="+name+"&o="+op+"&p="+points+"&o1="+o1+"&o2="+o2+"&o3="+o3+"&o4="+o4+"&title="+title, true);
    xmlhttp.send();}


/*$("#form").submit(function(e) {


    var form = $(this);
    var url = form.attr('action');

    $.ajax({
           type: "POST",
           url: url,
           data: form.serialize(), // serializes the form's elements.
           alert(data);
           success: function(data)
           {
           		alert(data);
               added();
           }
         });

    e.preventDefault(); // avoid to execute the actual submit of the form.
});*/
</script>
</body>
</html>