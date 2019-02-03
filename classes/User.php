<?php 
    include_once("Database.php");
    include_once("Session.php");
    require_once("Functions.php");
    class User{
        private $connection;
        public function __construct(){
            global $database;
            $this->connection = $database->getConnection();
            Session::startSession();
        }
        
        /*********************************************************
        # The below function is used to login the user
        # It automatically assigns session attributes
        # It is responsibility of CALEE to start the session
        # returns true if credentials were correct otherwise false
        **********************************************************/
        public function processLogin($email, $password){
            /*
                $query  = "SELECT * FROM users WHERE user_email = '$email";
                $select_user = mysqli_query($connection, $query);
                while($row = mysqli_fetch_assoc()){
                    extract();
                    #this function will be extracting every row
                }
                
            */
            $query  = "SELECT user_id,user_first_name,user_last_name,user_email,user_password,user_role_id FROM users WHERE user_email = ?";
            $preparedStatement = $this->connection->prepare($query);
            $preparedStatement->bind_param("s", $email);
            $preparedStatement->execute();
            
            $preparedStatement->store_result(); #PHP 7 method
            
            $count = $preparedStatement->num_rows;
            if($count == 1) {
                $preparedStatement->bind_result($id, $user_first_name,$user_last_name, $user_email, $user_password, $user_role);
                $preparedStatement->fetch();
                if($password === $user_password){
                    $_SESSION['login'] = true;
                    $_SESSION['user_id'] = $id;
                    $_SESSION['user_name'] = $user_name;
                    $_SESSION['user_role'] = $user_role;
                    return true;
                } else{
                    return false;
                }
            }
        }
        
     
        
        public function user_logout() {
            $_SESSION['login'] = false;
            $_SESSION['user_id'] = null;
            $_SESSION['user_name'] = null;
            $_SESSION['user_role'] = null;
            session_destroy();
        }
        
        public static function checkActiveSession(){
            if(!Session::isSessionStart())
                Functions::redirect("login.php");
        }
    }
?>