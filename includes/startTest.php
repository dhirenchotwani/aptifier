<?php
include_once('../classes/Detection.php');
include_once('../classes/Database.php');
include_once('../classes/Session.php');
Session::startSession();
if(isset($_POST['check-photos'])){
	global $database;
	$user_id=$_SESSION['user_id'];
	$res=$database->query("select user_profile_pic from users where user_id=$user_id");
	if($row=mysqli_fetch_assoc($res))
		extract($row);

   $obj=new Detection();
    $img = $_POST['image'];
    $image_parts = explode(";base64,", $img);
    
	if($obj->performDetection($image_parts[1],$user_profile_pic)){
		?>
		<script>window.alert("face matched answer question!!");</script>
		<?php
	}else{
		?>
		<script>window.alert("face did not match current-1 attempts left!!");</script>
		<?php
	}
//	echo $data->{'confidence'};

		

}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Capture webcam image with php and jquery - ItSolutionStuff.com</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <style type="text/css">
        #results { padding:20px; border:1px solid; background:#ccc; }
    </style>
</head>
<body>
  
<div class="container">
    
   
    <form method="POST" action="">
        <div class="row">
            <div class="col-md-6">
                <div id="my_camera" style="display:none"></div>
                <br/>
                <input type=button value="Take Snapshot" onClick="take_snapshot()">
                <input type="hidden" name="image" class="image-tag">
            </div>
            <div class="col-md-6">
                <div id="results">Your captured image will appear here...</div>
            </div>
            <div class="col-md-12 text-center">
                <br/>
                <button class="btn btn-success" name="check-photos">Submit</button>
            </div>
        </div>
    </form>
</div>
  

<script language="JavaScript" src="../assets/js/web.js">
</script>
 
</body>
</html>