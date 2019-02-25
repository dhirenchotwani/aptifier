<?php
include_once("../classes/Database.php");
include_once("../classes/Session.php");
Session::startSession();
global $database;


  if (isset($_POST['upload'])) {
//	  echo "hi";
    $ok = true;
    $file = $_FILES['csv_file']['tmp_name'];
    $handle = fopen($file, "r");
    if ($file == NULL) {
      echo 'Please select a file to import';
 }
    else {
      while(($filesop = fgetcsv($handle, 1000, ",")) !== false)
        {
          
          $question_text = $filesop[0];
          $question_option1 = $filesop[1];
          $question_option2 = $filesop[2];
          $question_option3 = $filesop[3];
          $question_option4 = $filesop[4];
          $question_correct_answer = $filesop[5];
          $question_difficulty_level = $filesop[6];
		  $question_chapter_id = $filesop[7];
		 
		  $created_by=$_SESSION['user_id'];
      
        if ($ok) {
          $sql="INSERT INTO question(question_text,question_option1,question_option2,question_option3,question_option4,question_correct_answer,question_difficulty_level,is_question_image,question_chapter_id,created_by,is_deleted) VALUES('$question_text',$question_option1,$question_option2,$question_option3,$question_option4,'$question_correct_answer',$question_difficulty_level,0,$question_chapter_id,$created_by,0)";
      }
      if ($database->query($sql)) {

  
		  echo "You database has imported successfully!";
       
      } else {
        echo 'Sorry! There is some problem in the import file.';
 
        }
    }
  }
	
  }

?>
<html>
<head>
	<title>Upload Excel Sample Here</title>
</head>
<body>
	<h1>Upload your .csv files here</h1>
	<form action="" method="post" enctype="multipart/form-data">
	<input type="file" name="csv_file">
	<input type="submit" name="upload" value="Press here">
	</form>
</body>
</html>