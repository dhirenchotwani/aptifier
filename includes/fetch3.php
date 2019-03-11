<?php
include_once('bootstrap.php');
define('UPLOAD_DIR', 'images/');
Session::startSession();
$user_id=$_SESSION['user_id'];
$sql=$database->query("select user_profile_pic,user_first_name from users where user_id=$user_id");
if($row=mysqli_fetch_assoc($sql))
	extract($row);

 $image = $_POST['img'];
$i=$_POST['i'];
   // $image_parts = explode(";base64,", $img);
	$image_parts = explode(";base64,", $image);
    $image_type_aux = explode("image/", $image_parts[0]);
    $image_type = $image_type_aux[1];
    $image_base64 = base64_decode($image_parts[1]);
    $file = UPLOAD_DIR . $user_first_name."$i". '.png';
    file_put_contents($file, $image_base64);
$obj=new Detection();
if($obj->countFaces(realpath($file))){
	$res=$obj->performDetection($image_parts[1],$user_profile_pic);
if($res['confidence']>0.4){

		echo "true";
	}else{
	echo "false";
}
}
else{
	echo "false";
}
?>