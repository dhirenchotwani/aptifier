<?php
include_once("bootstrap.php");
session_start();
?>
<?php
$user_id = $_SESSION['user_id'];
$obj = new Test();
$result = $obj->countnewInsertedQuestions($user_id);

    $result2 = $obj->countoldInsertedQuestions($user_id);

    while($row = mysqli_fetch_assoc($result2)){
        extract($row);
        $res = $obj->getChapterName($question_chapter_id);
        echo "you have Old ".$total." questions of chapter ".$res;
        echo "<br>";   
    }

echo "you inserted new ".$result." Questions";
//echo "you have ".$result2." Old Questions";

?>


<html>
    <head>
        
    </head>
    <body>
       <form action="randomTest.php" method="post">
       <p>How many questions should your test contains?</p><input type="text" name="countOfQuestions">
       <label for="">Test on:</label>
               <select name="test_id" style="width: 80px;margin: 20px;" id="test_id">
               <option value="">...</option>
       <?php
           if($result = $obj->countnewInsertedQuestions($user_id) > 0){
               echo "<option value='new'>Generate Random Test on new Questions</option>";
           }
           
           $result2 = $obj->countoldInsertedQuestions($user_id);
           while($row = mysqli_fetch_assoc($result2)){
               extract($row);
               $res = $obj->getChapterName($question_chapter_id);
        echo "<option value = '$question_chapter_id' type='submit' name='generateRandom'>Generate Random Test on {$res}</option>";
           }
           
            ?>
            </select>
            <button type="submit" name="generateRandom">Generate</button>
        </form>
    </body>
</html>