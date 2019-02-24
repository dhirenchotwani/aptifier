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
    
    public function countQuestions($user_id){
        $sql = "SELECT COUNT(questions_id) as total from question WHERE created_by = {$user_id} and is_deleted=0";
        global $database;
        $res=$database->query($sql);
        $row = $res->fetch_assoc();
        return $row['total'];
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
    
	
	public function getAllLiveTest($student_class_id){
			global $database;
			$res=$database->query("select * from test where test_class_id='$student_class_id'");
			return $res;
		}
	
	public function getAllLiveTestForTeacher($teacher_id){
		global $database;
			$res=$database->query("select * from test where created_by=$teacher_id");
			return $res;
	}
    
    public function getChapterBySubject($subject_id){
        $sql = "SELECT * FROM chapter WHERE chapter_subject_id = {$subject_id}";
        global $database;
        $res=$database->query($sql);
        return $res;
    }
}
?>


