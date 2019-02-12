<?php
include_once("bootstrap.php");
?>
<?php
if(isset($_POST['submit_answers'])){
    $score = 0;
    
    $obj = new Test();
    foreach($_POST['optradio'] as $option_num => $option_val){
//    echo $option_num." ".$option_val."<br>";
    $res = $obj->checkAnswer($option_num, $option_val);
    $score +=$res;
    }
    
    echo "Your score is:".$score;

}
?>