<?php
include_once("bootstrap.php");
include_once("../classes/Message.php");
Session::startSession();
?>
<?php
if(isset($_POST['submit_test'])){
    global $database;
    $msg=new Message();
	$score = 0;
    
    $obj = new Test();
	$user= new User();
	
	
    if(isset($_POST['optradio'])){
	foreach($_POST['optradio'] as $option_num => $option_val){
//    echo $option_num." ".$option_val."<br>";
    $res = $obj->checkAnswer($option_num, $option_val);
    $score +=$res;
    }
	}
	    $test_id = $_SESSION['test_id'];
    $student_id = $_SESSION['user_id'];
    $array = array("test_id"=>$test_id,"student_id"=>$student_id,"score"=>$score, "created_at" => date("Y-m-d H:i:s"),"created_by"=> $student_id,"updated_at" => date("Y-m-d h:i:s"),"updated_by"=> $student_id);
		 $res2 = $obj->insert($array,"test_student");
	
	$res=$user->getUserWithCondition("user_id",$student_id);
	if($row=mysqli_fetch_assoc($res))
		extract($row);
	$res=$database->query("select test_name from test where test_id=$test_id");
	if($row=mysqli_fetch_assoc($res))
		extract($row);
	$msg->sendMessage("$user_phone","You scored $score in test $test_name");
    echo "Your score is:".$score;
	Fucntions::redirect("dashboard.php");

}
?>