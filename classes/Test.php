<?php

class Test{
    private $connection;
    
     public function __construct(){
            global $database;
            $this->connection = $database->getConnection();
            
        }
    
    public function insert($data, $table){
        $columnString = implode(", ", array_keys($data));
        $valueString = "'".implode("', '", array_values($data))."'";
        $sql = "INSERT INTO {$table} ({$columnString}) VALUES ({$valueString})";
        global $database;
        $res=$database->query($sql);
        return $res;
    }
    
    public function showTest($test_id){
        $sql = "SELECT * FROM test inner join test_question on test.test_id= test_question.test_id inner join question on test_question.question_id = question.questions_id WHERE test.test_id=$test_id";
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
    
    public function countQuestions(){
        $sql = "SELECT COUNT(questions_temp_id) as total from question_temp";
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
    
    public function getQuestionWithRandomNumber($id){
        $sql = "SELECT * FROM question_temp WHERE questions_temp_id = {$id}";
        global $database;
        $res=$database->query($sql);
        return $res;
    }
    
    public function insertQuestionFromQuestionTemp($id){
        $sql = "INSERT INTO question (question_text,question_image,question_option1,question_option2,question_option3,question_option4,question_correct_answer,question_difficulty_level,is_question_image,created_at,created_by,updated_at,updated_by) SELECT question_text,question_image,question_option1,question_option2,question_option3,question_option4,question_correct_answer,question_difficulty_level,is_question_image,created_at,created_by,updated_at,updated_by FROM question_temp WHERE questions_temp_id = {$id}";
        
        global $database;
        $res=$database->query($sql);
        return $res;
    }
	
	public function getAllLiveTest($student_division_id){
			global $database;
			$res=$database->query("select * from test where test_division='$student_division_id'");
			return $res;
		}
	
	public function getAllLiveTestForTeacher($teacher_id){
		global $database;
			$res=$database->query("select * from test where created_by=$teacher_id");
			return $res;
	}
}
?>


