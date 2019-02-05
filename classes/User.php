<?php 
    include_once("Database.php");
    include_once("Session.php");
    include_once("Functions.php");
   	include_once("Cipher.php");
	include_once("Mailer.php");
    class User{
        private $connection;
        public function __construct(){
            global $database;
            $this->connection = $database->getConnection();
            Session::startSession();
//			$cip=new Cipher();
        }
        
        /*********************************************************
        # The below function is used to login the user
        # It automatically assigns session attributes
        # It is responsibility of CALEE to start the session
        # returns true if credentials were correct otherwise false
        **********************************************************/
        public function processLogin($email, $password,$signed_in){
			global $database;

				
				$res=$database->query("select * from users where user_email='$email'");
			if($row=mysqli_fetch_assoc($res)){	
					extract($row);

					//Setting the cookie content here for further check
				$this->setCookies($user_id,$signed_in);
				$user_name=$user_first_name." ".$user_last_name;
					// Setting the session variables here for further use 
				$this->setSession($user_id,$user_name,$user_role); 
				return true;
                } else{
                    echo 'falsee';
                }
            }
       
        
//		}
        
        public function user_logout() {
			$this->deleteCookies();
            $_SESSION['login'] = false;
            $_SESSION['user_id'] = null;
            $_SESSION['user_name'] = null;
            $_SESSION['user_role'] = null;
            session_destroy();
        }

		private function setSession($user_id,$user_name,$user_role){
			 		$_SESSION['login'] = true;
                    $_SESSION['user_id'] = $user_id;
                    $_SESSION['user_name'] = $user_name;
                    $_SESSION['user_role'] = $user_role;
		}

		private function setCookies($user_id,$signed_in){
					$cip=new Cipher();
			if($signed_in){
                    $cookie_name = "Quiz_Handler_User";
                    $user_id_to_login = $cip->encrypt($user_id);
//                    $encrypt_id =encrypt($user_id_to_login);
                    $cookie_content = $user_id_to_login;
                    $cookie_time = time() + 86400 * 30;
                    $path = "/";
                    setcookie($cookie_name, $cookie_content, $cookie_time, $path);
                } else{
                    $cookie_name = "Quiz_Handler_User";
                    $user_id_to_login = $cip->encrypt($user_id);;
                  
                    $cookie_content = $user_id_to_login;
                    $cookie_time = time() + 3600;
                    $path = "/";
                    setcookie($cookie_name, $cookie_content, $cookie_time, $path);
                }
		}
		
		public function deleteCookies(){
					$cip=new Cipher();
		   $cookie_name = "Quiz_Handler_User";
        $user_id_to_logout = $_SESSION['user_id'];
        $cookie_content = $cip->encrypt($user_id_to_logout);
        $cookie_time = time() - 86400 * 30;
        $path = "/";
        setcookie($cookie_name, $cookie_content, $cookie_time, $path);
		}

		public function isCookieSet(){
			$cip=new Cipher();
			global $database;
			if(isset($_COOKIE["Quiz_Handler_User"])){
            $user_id = $cip->decrypt($_COOKIE["Quiz_Handler_User"]);
		
				$res=$database->query("select * from users where user_id='$user_id'");
			if($row=mysqli_fetch_assoc($res)){	
					extract($row);
				$user_name=$user_first_name." ".$user_last_name;
            //echo $user_id;
//				$query  = "SELECT * FROM users WHERE user_id = '$user_id'";
//                $select_user = mysqli_query($connection, $query);         
//				if($row = mysqli_fetch_assoc($select_user))
//					extract();
//				
//					$user_name=$user_first_name." ".$user_last_name;
//                  
//					setSession($user_id,$user_name,$user_role);
                $this->setSession($user_id,$user_name,$user_role);
					
         		return true;
			}else{
				?>
				<script>console.log("User data ont found using user_id from cookie ");</script>
				<?php
			}
		}else
				return false;
		}
		
		public function sendEmailToRecipient($email){
			$cip=new Cipher();
			
       
		
        require_once("Mailer.php");
        $mailer = new Mailer();

//		 $ciphertext_email= mcrypt_encrypt(MCRYPT_3DES,"123456789012345678901234",$email,"ecb");
			
			
        $subject = "Quiz-Handlers Account Confirmation";

        $base_url_link ="http://localhost/quiz-handlers/includes/register.php?XSRS=$email";
        $body = "<div style='font-family:Roboto; font-size:16px; max-width: 600px; line-height: 21px;'>     <h4>Hello,</h4>
            <h3>Your Quiz Handler Account is Ready.</h3>
            <br>  
            <a style='text-decoration:none; color:#fff; background-color:#348eda;border:solid #348eda; border-width:2px 10px; line-height:2;font-weight:bold; text-align:center; display:inline-block;border-radius:4px' href='$base_url_link'>
            Activate your account </a>
            <br>  
            <h3>Thank you for Registering.</h3>
            <br>
            <br>
            <h4>Sincerely,</h4>
            <h5>The Quiz Handler Team.</h5>
            </div>";

        $mailer->send_mail($email, $body, $subject);
    }
        
        public static function checkActiveSession(){
            if(!Session::isSessionStart())
                Functions::redirect("login.php");
        }
		public function getUserWithCondition($condn,$key){
			global $database;
			$res=$database->query("select * from users where $condn=$key");
			return $res;
		}
		public function getUserWithJoinCondition($sql,$condn,$key){
			global $database;
			$res=$database->query("select * from users $sql where $condn=$key");
			return $res;
		}
		
    }
?>