
<?php
include_once("../classes/Session.php");
Session::startSession();
	if(isset($_GET['go'])){
		echo "hi";

	}
?>
<!doctype html>
<html>
<head>
	
	<meta charset='utf-8'>
	<link rel="stylesheet" href="../assets/css/main.css" type="text/css" media="all">
	
</head>
<body>
<div class="contentarea">

  <div class="camera">
    <video id="video">Video stream not available.</video>
    <button id="startbutton">Take photo</button> 
  </div>
  <canvas id="canvas">
  </canvas>
  
  <div class="output">
    <img id="photo" alt="The screen capture will appear in this box." name="photo"> 
    <button onclick="thisIs()">HAHA</button>
  </div>

<!--
  <div id="checkimage">
  	<button id="save">Save</button>
  </div>
-->
  <canvas id='blank' ></canvas>	
</div>
<script  src="../assets/js/capture.js"></script>
	<script  src="../assets/js/jquery-3.2.1.min.js"></script>
<script>
	
	function thisIs(){
	var fd=new FormData();
	fd.append('photo',document.getElementById('photo').src);
	$.ajax({
		type:'POST',
		url:'startTest.php?go=true',
		data:fd,
		processData:false,
		contentType:false
	}).done(function(data){
			console.log("done");
			});
	}
	</script>


	
</body>
</html>