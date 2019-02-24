<?php
include_once("bootstrap.php");
session_start();
?>
<?php
$user_id = $_SESSION['user_id'];
$obj = new Test();
$result = $obj->countQuestions($user_id);
echo "you inserted ".$result." Questions";

?>


<html>
    <head>
        
    </head>
    <body>
       <form action="randomTest.php" method="post">
       <p>How many questions should your test contains?</p><input type="text" name="countOfQuestions">
        <button type="submit" name="generateRandom">Generate Random Test</button>
        </form>
    </body>
</html>