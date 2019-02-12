<?php
include_once("bootstrap.php");
?>

<?php
if(isset($_POST['submit_question'])){
    extract($_POST);
   if($_FILES['question_image']['error'] != 0) {
    
    $question_image="none";
    $is_question_image = 0;
    }
    else{ 
        
    $question_image = addslashes(file_get_contents($_FILES["question_image"]["tmp_name"]));

           $is_question_image = 1;

    }
    $array = array("question_text"=>$question_text, "question_image"=>$question_image, "question_option1"=>$question_option1, "question_option2"=>$question_option2, "question_option3"=>$question_option3, "question_option4"=>$question_option4, "question_correct_answer"=>$question_correct_answer,"question_difficulty_level"=>$question_difficulty_level, "is_question_image"=>$is_question_image,   "created_at" => date("Y-m-d h:i:sa"),"created_by"=> 1,"updated_at" => date("Y-m-d h:i:sa"),"updated_by"=> 1);
    
    $obj = new Test();
    echo $obj->insert($array, "question_temp");
}

if(isset($_POST['finish_inserting_question'])){
    Functions::redirect('showGeneratedTest.php');
}

?>


    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Quiz Handlers</title>
        <!-- Favicon -->
        <link href="../assets/img/brand/favicon.png" rel="icon" type="image/png">
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
        <!-- Icons -->
        <link href="../assets/vendor/nucleo/css/nucleo.css" rel="stylesheet">
        <link href="../assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
        <!-- Argon CSS -->
        <link type="text/css" href="../assets/css/argon.css?v=1.0.0" rel="stylesheet">
    </head>

    <body class="">
        <div class="container-fluid">
            <!-- Brand -->
            <a class="navbar-brand pt-0" href="../index.html">
        <img src="../assets/img/brand/blue.png" alt="..." width="180px">
      </a>
        </div>
        <h2 style="text-align: center; padding-top: 30px;">Add|Questions</h2>
        <div class="container" style="border: 1px solid #ddd; background-color: #fff; margin:0 auto;width: 800px;">

            <form method="post" enctype="multipart/form-data" action="" class="" style=>
                <label for="">Question: <input type="text"  style="width: 350px; margin: 20px;" name="question_text"></label><br>
                <label for="">Option 1: <input type="text"  style="width: 200px; margin: 20px;" name="question_option1"></label><br>
                <label for="">Option 2: <input type="text"  style="width: 200px; margin: 20px;" name="question_option2"></label><br>
                <label for="">Option 3: <input type="text"  style="width: 200px; margin: 20px;" name="question_option3"></label><br>
                <label for="">Option 4: <input type="text"  style="width: 200px; margin: 20px;" name="question_option4"></label><br>
                <label for="">Correct Option:</label>
                <select name="question_correct_answer" style="width: 80px;margin: 20px;">
                <option value="A">A</option>
                <option value="B">B</option>
                <option value="C">C</option>
                <option value="D">D</option>
            </select>

                <select name="question_difficulty_level" style="width: 80px;margin: 20px;">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                
            </select>
                <p>Insert Image (if your question has one!!)</p><input type="file" name="question_image"><br>
                <b>Note:</b>
                <p>skip if your question does not have any image</p>
                <br>
                <button type="submit" class="btn btn-primary" style="margin-left:350px; margin-bottom: 20px;" name="submit_question">ADD</button>
                
                <button type="submit" class="btn btn-primary" style="margin-left:350px; margin-bottom: 20px;" name="finish_inserting_question">Finish</button>

            </form>

        </div>

        <!-- Argon Scripts -->
        <!-- Core -->
        <script src="../assets/vendor/jquery/dist/jquery.min.js"></script>
        <script src="../assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Argon JS -->
        <script src="../assets/js/argon.js?v=1.0.0"></script>
    </body>

    </html>
