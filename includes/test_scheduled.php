<?php
include_once("bootstrap.php");
?>
   

   <?php
	include_once("../classes/Functions.php");
    session_start();
    if(isset($_POST['submit_test'])){
        extract($_POST);
        $obj = new Test();
        $i=1;
         foreach($_SESSION['array'] as $id){
        $res1 = $obj->insertQuestionFromQuestionTemp($id); 
        //echo "hii";
         }
        $test_class_id = 1;
        $array = array("test_name"=>$test_name,"test_date"=>$test_date,"test_class_id"=>$test_class_id,"test_division"=>$test_division,"test_level"=>$test_level,"created_at" => date("Y-m-d h:i:sa"),"created_by"=> 1,"updated_at" => date("Y-m-d h:i:sa"),"updated_by"=> 1);
        $res2 = $obj->insert($array,"test");
        foreach($_SESSION['array'] as $id){
        $array2 = array("test_id"=>1,"question_id"=>$i,"created_at" => date("Y-m-d h:i:sa"),"created_by"=> 1,"updated_at" => date("Y-m-d h:i:sa"),"updated_by"=> 1);
        $res2 = $obj->insert($array2,"test_question");
        $i++;
        }
		Functions::redirect("dashboard.php");
    }
    ?>
    <html>
        <head></head>
        <body>
            <h2>SUCCESSFULLY SCHEDULED</h2>
        </body>
    </html>