<?php

class Test{
    private $connection;
    
     public function __construct(){
            global $database;
            $this->connection = $database->getConnection();
            
        }
    
    public function insert($data, $table){
        
        $keys = array_keys($data);
        
        for($i=0;$i<count($keys);$i++){
            $data[$keys[$i]] = mysqli_real_escape_string($this->connection,$data[$keys[$i]]);
        }
        $columnString = implode(", ", array_keys($data));
        $valueString = "'".implode("', '", array_values($data))."'";
        $sql = "INSERT INTO {$table} ({$columnString}) VALUES ({$valueString})";
        global $database;
        $res=$database->query($sql);
        return mysqli_insert_id($this->connection);
    }
    
    public function showTest($test_id){
        $sql = "SELECT * FROM test inner join test_question on test.test_id= test_question.test_id inner join question on test_question.question_id = question.questions_id WHERE test.test_id=$test_id";
        global $database;
        $res=$database->query($sql);
         //var_dump($res);
        return $res;
    }
    
    public function userTypes(){
        $sql = "SELECT * FROM user_type";
        global $database;
        $res=$database->query($sql);
        return $res;
    }
    
    public function readAllSubjects(){
        $sql = "SELECT * FROM subject";
        global $database;
        $res=$database->query($sql);
        return $res;
    }
    
    public function showRandomTest(){
        $sql = "SELECT * FROM question_temp WHERE question_chapter_id = 0";
        global $database;
        $res=$database->query($sql);
        return $res;
    }
    
    public function checkAnswer($questions_id, $answer){
        $sql = "SELECT question_correct_answer FROM question WHERE questions_id = {$questions_id}";
        global $database;
        $res=$database->query($sql);
        $row = $res->fetch_assoc();
        //echo $row['question_correct_answer'];
        if($row['question_correct_answer'] == strtoupper($answer)){
            return 1;
        }
        else{
            return 0;
        }
        
    }
    
	public function isTestGiven($student_id,$test_id){
		$sql="select test_student_id from test_student WHERE test_id=$test_id and student_id=$student_id";
		global $database;
        return mysqli_num_rows($res=$database->query($sql));
	}
	
	public function getPhoneOfAllTestStudents($sql){
		global $database;
		return $database->query($sql);
	}
    public function lastTestID(){
        $sql = "SELECT MAX(test_id) as lastTestID FROM test";
        global $database;
        $res=$database->query($sql);
        $row = $res->fetch_assoc();
        return $row['lastTestID'];
        
    }
    
    public function lastInsertQuestionID($id){
        $sql = "SELECT MAX(questions_id) as lastQuestionID FROM question WHERE created_by = {$id} and is_deleted = 0";
        global $database;
        $res=$database->query($sql);
        $row = $res->fetch_assoc();
        return $row['lastQuestionID'];
        
    }
    
   
    
    public function countQuestionsForTest(){
        $sql = "SELECT COUNT(questions_id) as total from question";
        global $database;
        $res=$database->query($sql);
        $row = $res->fetch_assoc();
        return $row['total'];
    }
    
    public function deleteQuestions($id){
        $sql = "UPDATE question set is_deleted = 1 WHERE created_by = {$id}";
        global $database;
        $res=$database->query($sql);
        return $res;
    }
    
    public function getQuestionWithRandomNumber($id){
        $sql = "SELECT * FROM question WHERE questions_id = {$id}";
        global $database;
        $res=$database->query($sql);
        return $res;
    }
    
	
	public function getAllTestForStudent($student_class_id,$opt){
			global $database;
			$res=$database->query("select * from test where test_class_id=$student_class_id and test_date $opt CURDATE() order by test_date");
			return $res; 
		}
	
//	public function getAllFutureTest($student_class_id){
//			global $database;
//			$res=$database->query("select * from test where test_class_id=$student_class_id and test_date>CURDATE() order by test_date");
//			return $res; 
//		}
	
	public function getAllTestForTeacher($teacher_id,$opt){
		global $database;
			$res=$database->query("select * from test where created_by=$teacher_id and test_date $opt CURDATE() order by test_date desc");
			return $res;
	}
    
    public function getChapterBySubject($subject_id){
        $sql = "SELECT * FROM chapter WHERE chapter_subject_id = {$subject_id}";
        global $database;
        $res=$database->query($sql);
        return $res;
    }
	$test_name has been scheduled for you by Professor $faculty_name on $date
	public function sendScheduledTestMail($email,$user_name,$faculty_name,$test_name,$date){
	    
        $mailer = new Mailer();

        $subject = "A Test has beeen scheduled for You!";

        $body = "<div><table border='0' cellpadding='0' cellspacing='0' height='100%' style='font-family:&quot;Arial&quot;' width='100%'><tbody><tr><td align='center' valign='top'><table border='0' cellpadding='0' cellspacing='0' style='font-family:&quot;Arial&quot;;border:1px solid #b2b2b2' width='600'><tbody><tr><td align='center' valign='top'><table border='0' cellpadding='0' cellspacing='0' style='font-family:&quot;Arial&quot;;background-color:#fff;font-size:14px;color:#46535e;border-radius:3px;' width='100%'><tbody><tr><td align='left' valign='top'><div style='color:#fff;background:white;padding:0px 20px 0px 20px;text-align:center;'><img align='center' height='auto' src='cid:logo' style='height:auto'></div><hr><div style='margin:0 30px 36px 30px'><span style='display:block;margin:0 0 18px 0;font-size:14px;line-height:2;color:black'><h3>Hi $email,</h3><br>A test $test_name has been scheduled for you by Professor $faculty_name on $date </span></div><div style='line-height:2;margin:30px 0 18px 30px;color:black'>Thank you for registering<br><div>Sincerely,</div><div>Team Aptifier</div></div></td></tr></tbody></table></td></tr><tr><td align='center' valign='top'><table border='0' cellpadding='0' cellspacing='0' style='font-family:&quot;Arial&quot;;font-size:12px;color:#666;padding-top:30px' width='100%'><tbody><tr><td align='left' style='padding:0 20px;font-size:12px;color:#90979e' valign='top'></td></tr><tr><td style='background-color: lightgray;border-top:1px solid #b2b2b2 '><p  style='margin-left: 85px;padding-bottom: 20px;padding-top: 20px;color:gray;'>This email was sent to <span style='color:#08476E'>$email</span> to confirm your Firebase registration.</p></td></tr></tbody></table></td></tr></tbody></table></td></tr></tbody></table></div>";

       return( $mailer->send_mail($email, $body, $subject));
		}
	
	public function getTestAndScoreCount($student_id){
		global $database;
		$sql="select count(test_id) as testCount, sum(score)as final_score,max(score) as max_score from test_student where student_id=$student_id";
		return($database->query($sql));
	}
	public function getLastScoreAndTest($student_id){
		global $database;
		$sql="select score as last_score,test.test_name as last_test_name,test_student.created_at as last_test_date  from test_student inner join test on test_student.test_id=test.test_id WHERE student_id=$student_id ORDER by test_student.created_at desc LIMIT 1";
		return($database->query($sql));
	}
	
	public function getPrevHighScore($student_id){
		global $database;
		$sql="select score as prevscore from test_student WHERE student_id=$student_id ORDER by score desc LIMIT 1,1";
		return($database->query($sql));
	}
	
	public function getAllGivenTest($student_id){
		$sql="select score,test.test_name,test.test_date from test_student inner join test on test_student.test_id=test.test_id where student_id=$student_id order by test_date desc";
		global $database;
return($database->query($sql));

	}
	
	public function getTotalQuestions($teacher_id){
		$sql="SELECT count(questions_id) as total_ques from question WHERE created_by=$teacher_id";
		global $database;
		return($database->query($sql));

	}
	
	public function getTotalTests($teacher_id){
		$sql="SELECT count(test_id) as testCount from test where created_by=$teacher_id";
		global $database;
		return($database->query($sql));
	}
	
	public function getTotalStudentsWhoGaveTest($teacher_id){
		$sql="SELECT count(DISTINCT test_student.student_id) as studCount from test_student inner join test on test_student.test_id=test.test_id where test.created_by=$teacher_id";
		global $database;
		return($database->query($sql));
	}
	public function selectNewQuestions($user_id){
        $sql = "SELECT questions_id,question_chapter_id FROM question WHERE created_by={$user_id} and is_deleted=0";
        global $database;
        $res=$database->query($sql);
        return $res;
        
    }
    
     public function selectOldQuestions($user_id,$question_chapter_id){
        $sql = "SELECT questions_id FROM question WHERE created_by={$user_id} and question_chapter_id = {$question_chapter_id} and is_deleted=1";
        global $database;
        $res=$database->query($sql);
        return $res;
        
    }
    
    public function countnewInsertedQuestions($user_id){
        $sql = "SELECT COUNT(questions_id) as total from question WHERE created_by = {$user_id} and is_deleted=0";
        global $database;
        $res=$database->query($sql);
        $row = $res->fetch_assoc();
        return $row['total'];
    }
    
    
    
    public function countQuestions($question_chapter_id){
        $sql = "SELECT COUNT(questions_id) as total from question WHERE question_chapter_id = {$question_chapter_id} and is_deleted=1";
        global $database;
        $res=$database->query($sql);
        $row = $res->fetch_assoc();
        return $row['total'];
    }
    
    public function countoldInsertedQuestions($user_id){
        $sql = "SELECT COUNT(questions_id) as total,question_chapter_id from question WHERE created_by = {$user_id} and is_deleted = 1 GROUP BY(question_chapter_id)";
        global $database;
        $res=$database->query($sql);
        return $res;
    }
    
    public function getChapterName($chapter_id){
        $sql = "SELECT chapter_name from chapter WHERE chapter_id = {$chapter_id}";
        global $database;
        $res=$database->query($sql);
        $row = $res->fetch_assoc();
        return $row['chapter_name'];
    }
	
	public function getResultsForTeacher($user_id){
		global $database;
		$sql="SELECT max(score) as score,test_name,test_class_id,test_division,test_date,test_level ,user_first_name,user_last_name from test_student INNER join test on test_student.test_id=test.test_id inner join users on test_student.student_id=users.user_id where test.created_by=$user_id group by test.test_id";
		return($database->query($sql));
	}
	public function getResultsForStudent($user_id){
		global $database;
		$sql="select score,test_name,test_date,test_level,test_student.created_at from test_student inner join test on test_student.test_id=test.test_id where student_id=$user_id";
		return($database->query($sql));
	}
}
?>


