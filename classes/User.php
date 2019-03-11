<?php 
    include_once("Database.php");
    include_once("Session.php");
    include_once("Functions.php");
   	include_once("Detection.php");
	include_once("Mailer.php");
	//include_once("Cipher.php");
    class User{
        
    private $table = "users";
   
        
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
        
//       public function insertStudent($user_id,$student_class_id,$student_division,$student_branch){
//           $sql = "INSERT INTO student (user_id,student_class_id,student_division,student_branch) VALUES ($user_id,$student_class_id,$student_division,$student_branch)";
//           global $database;
//           $res=$database->query($sql);
//           return $res;
//           
//       }
        
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
        
        public function processLogin($email, $password,$signed_in){
			global $database;

				$_SESSION['user_email']=$email;
				$res=$database->query("select * from users where user_email='$email'");
			if($row=mysqli_fetch_assoc($res)){	
					extract($row);
			
					if(password_verify($password,$user_password)){
						$this->setCookies($user_id,$signed_in);
						if($is_first_login==1){
							$_SESSION['user_id']=$user_id;
							Functions::redirect('registerUser.php');
						}
						else{
							
				$user_name=$user_first_name." ".$user_last_name;
//					// Setting the session variables here for further use 
				$this->setSession($user_id,$user_name,$user_role_id,$user_email);
							
								return true;
						}
				
			
                } else{
                    return false;
                }
            }
		}
		
		public function loginUserWithFaceID($email,$image,$realpath){
			global $database;
			$obj=new Detection();
				$res=$database->query("select * from users where user_email='$email'");
			if($row=mysqli_fetch_assoc($res)){	
					extract($row);
				if($obj->countFaces($realpath)){
				$res=$obj->performDetection($image,$user_profile_pic);
				if($res['confidence']>0.4){
				$user_name=$user_first_name." ".$user_last_name;
				$this->setSession($user_id,$user_name,$user_role_id);
				return true;
				}
				else{

				return false; //FACE DETECTION FAILED ERROR HERE!!!!
				}
				}else{
					return false; //multple faces detectd error here!!
				}
		}else{
                    return false;// LOGIN CREDENTAILS I.E USER_EMAIL DOES NOT EXOSTS ERR HERE!
                }
	}
				
        
        public function user_logout() {
			$this->deleteCookies();
            $_SESSION['login'] = false;
            $_SESSION['user_id'] = null;
            $_SESSION['user_name'] = null;
            $_SESSION['user_role'] = null;
			$_SESSION['student_id'] = null;
			$_SESSION['teacher_id'] = null;
            session_destroy();
        }

		private function setSession($user_id,$user_name,$user_role,$email){
			 		$_SESSION['login'] = true;
                    $_SESSION['user_id'] = $user_id;
                    $_SESSION['user_name'] = $user_name;
                    $_SESSION['user_role'] = $user_role;
			$_SESSION['user_email']=$email;
		}

		private function setCookies($user_id,$signed_in){
				//	$cip=new Cipher();
			if($signed_in){
                    $cookie_name = "Quiz_Handler_User";
                   // $user_id_to_login = $cip->encrypt($user_id);
//                    $encrypt_id =encrypt($user_id_to_login);
                    $cookie_content = $user_id;
                    $cookie_time = time() + 86400 * 30;
                    $path = "/";
                    setcookie($cookie_name, $cookie_content, $cookie_time, $path);
                } else{
                    $cookie_name = "Quiz_Handler_User";
//                    $user_id_to_login = $cip->encrypt($user_id);;
                  
                    $cookie_content = $user_id;
                    $cookie_time = time() + 3600;
                    $path = "/";
                    setcookie($cookie_name, $cookie_content, $cookie_time, $path);
                }
		}
		
		public function deleteCookies(){
					
		   $cookie_name = "Quiz_Handler_User";
        $user_id_to_logout = $_SESSION['user_id'];  
        $cookie_content = $user_id_to_logout;
        $cookie_time = time() - 86400 * 30;
        $path = "/";
        setcookie($cookie_name, $cookie_content, $cookie_time, $path);
		}

		public function isCookieSet(){
			//$cip=new Cipher();
			global $database;
			if(isset($_COOKIE["Quiz_Handler_User"])){
            $user_id = $_COOKIE["Quiz_Handler_User"];
		
				$res=$database->query("select * from users where user_id='$user_id'");
			if($row=mysqli_fetch_assoc($res)){	
					extract($row);
				$user_name=$user_first_name." ".$user_last_name;

                $this->setSession($user_id,$user_name,$user_role);
					
         		return true;
			}else{
				?>
				<script>console.log("User data not found using user_id from cookie ");</script>
				<?php
			}
		}else
				return false;
		}
		
		public function sendEmailToRecipient($email){
	
       
        $mailer = new Mailer();

        $subject = "Aptifier Account Confirmation";

        $base_url_link ="http://localhost/aptifier/includes/register.php?XSRS=$email";
        $body = "<div><table border='0' cellpadding='0' cellspacing='0' height='100%' style='font-family:&quot;Arial&quot;' width='100%'><tbody><tr><td align='center' valign='top'><table border='0' cellpadding='0' cellspacing='0' style='font-family:&quot;Arial&quot;;border:1px solid #b2b2b2' width='600'><tbody><tr><td align='center' valign='top'><table border='0' cellpadding='0' cellspacing='0' style='font-family:&quot;Arial&quot;;background-color:#fff;font-size:14px;color:#46535e;border-radius:3px;' width='100%'><tbody><tr><td align='left' valign='top'><div style='color:#fff;background:white;padding:0px 20px 0px 20px;text-align:center;'><img align='center' height='auto' src='cid:logo' style='height:auto'></div><hr><div style='margin:0 30px 36px 30px'><span style='display:block;margin:0 0 18px 0;font-size:14px;line-height:2;color:black'><h3>Hi $email,</h3><br> Welcome to The Aptifier! Some Generic Statement.Get started NOW!</span><div style='margin:0 auto;display:table'><a style='font-size:14px;border-radius:3px;display:inline-block;text-decoration:none;color:#fff;text-align:center;padding:15px 20px;width:180px;background-color:#08476E' href='$base_url_link'><img src='cid:favicon' alt='' style='width: 30px;height: 40px;'></a></div></div><div style='line-height:2;margin:30px 0 18px 30px;color:black'>Thank you for registering<br><div>Sincerely,</div><div>Team Aptifier</div></div></td></tr></tbody></table></td></tr><tr><td align='center' valign='top'><table border='0' cellpadding='0' cellspacing='0' style='font-family:&quot;Arial&quot;;font-size:12px;color:#666;padding-top:30px' width='100%'><tbody><tr><td align='left' style='padding:0 20px;font-size:12px;color:#90979e' valign='top'></td></tr><tr><td style='background-color: lightgray;border-top:1px solid #b2b2b2 '><p  style='margin-left: 85px;padding-bottom: 20px;padding-top: 20px;color:gray;'>This email was sent to <span style='color:#08476E'>$email</span> to confirm your Firebase registration.</p></td></tr></tbody></table></td></tr></tbody></table></td></tr></tbody></table></div>";

       return( $mailer->send_mail($email, $body, $subject));
    }
		public function sendForgotPassEmailToRecipient($email){
	    
        $mailer = new Mailer();

        $subject = "Aptifier Forgot Password Confirmation";

        $base_url_link ="http://localhost/aptifier/includes/resetPassword.php?XSRS=$email";
        $body = "http://localhost/aptifier/includes/register.php?XSRS=$email";
        $body = "<div><table border='0' cellpadding='0' cellspacing='0' height='100%' style='font-family:&quot;Arial&quot;' width='100%'><tbody><tr><td align='center' valign='top'><table border='0' cellpadding='0' cellspacing='0' style='font-family:&quot;Arial&quot;;border:1px solid #b2b2b2' width='600'><tbody><tr><td align='center' valign='top'><table border='0' cellpadding='0' cellspacing='0' style='font-family:&quot;Arial&quot;;background-color:#fff;font-size:14px;color:#46535e;border-radius:3px;' width='100%'><tbody><tr><td align='left' valign='top'><div style='color:#fff;background:white;padding:0px 20px 0px 20px;text-align:center;'><img align='center' height='auto' src='cid:logo' style='height:auto'></div><hr><div style='margin:0 30px 36px 30px'><span style='display:block;margin:0 0 18px 0;font-size:14px;line-height:2;color:black'><h3>Hi $email,</h3><br> Reset your Aptifier Password here,click the link below</span><div style='margin:0 auto;display:table'><a style='font-size:14px;border-radius:3px;display:inline-block;text-decoration:none;color:#fff;text-align:center;padding:15px 20px;width:180px;background-color:#08476E' href='$base_url_link'><img src='cid:favicon' alt='' style='width: 30px;height: 40px;'></a></div></div><div style='line-height:2;margin:30px 0 18px 30px;color:black'>Thank you for registering<br><div>Sincerely,</div><div>Team Aptifier</div></div></td></tr></tbody></table></td></tr><tr><td align='center' valign='top'><table border='0' cellpadding='0' cellspacing='0' style='font-family:&quot;Arial&quot;;font-size:12px;color:#666;padding-top:30px' width='100%'><tbody><tr><td align='left' style='padding:0 20px;font-size:12px;color:#90979e' valign='top'></td></tr><tr><td style='background-color: lightgray;border-top:1px solid #b2b2b2 '><p  style='margin-left: 85px;padding-bottom: 20px;padding-top: 20px;color:gray;'>This email was sent to <span style='color:#08476E'>$email</span> to confirm your Firebase registration.</p></td></tr></tbody></table></td></tr></tbody></table></td></tr></tbody></table></div>";

       return( $mailer->send_mail($email, $body, $subject));
		}
		
		public function sendChangePassEmailToRecipient($email){
	    
        $mailer = new Mailer();

        $subject = "Aptifer Change Password Confirmation";

        $base_url_link ="http://localhost/quiz-handlers/includes/resetPassword.php?XSRS=$email&action=reset";
       $body = "http://localhost/aptifier/includes/register.php?XSRS=$email";
        $body = "<div><table border='0' cellpadding='0' cellspacing='0' height='100%' style='font-family:&quot;Arial&quot;' width='100%'><tbody><tr><td align='center' valign='top'><table border='0' cellpadding='0' cellspacing='0' style='font-family:&quot;Arial&quot;;border:1px solid #b2b2b2' width='600'><tbody><tr><td align='center' valign='top'><table border='0' cellpadding='0' cellspacing='0' style='font-family:&quot;Arial&quot;;background-color:#fff;font-size:14px;color:#46535e;border-radius:3px;' width='100%'><tbody><tr><td align='left' valign='top'><div style='color:#fff;background:white;padding:0px 20px 0px 20px;text-align:center;'><img align='center' height='auto' src='cid:logo' style='height:auto'></div><hr><div style='margin:0 30px 36px 30px'><span style='display:block;margin:0 0 18px 0;font-size:14px;line-height:2;color:black'><h3>Hi $email,</h3><br>Change your Aptifier Password here,click the link below </span><div style='margin:0 auto;display:table'><a style='font-size:14px;border-radius:3px;display:inline-block;text-decoration:none;color:#fff;text-align:center;padding:15px 20px;width:180px;background-color:#08476E' href='$base_url_link'><img src='cid:favicon' alt='' style='width: 30px;height: 40px;'></a></div></div><div style='line-height:2;margin:30px 0 18px 30px;color:black'>Thank you for registering<br><div>Sincerely,</div><div>Team Aptifier</div></div></td></tr></tbody></table></td></tr><tr><td align='center' valign='top'><table border='0' cellpadding='0' cellspacing='0' style='font-family:&quot;Arial&quot;;font-size:12px;color:#666;padding-top:30px' width='100%'><tbody><tr><td align='left' style='padding:0 20px;font-size:12px;color:#90979e' valign='top'></td></tr><tr><td style='background-color: lightgray;border-top:1px solid #b2b2b2 '><p  style='margin-left: 85px;padding-bottom: 20px;padding-top: 20px;color:gray;'>This email was sent to <span style='color:#08476E'>$email</span> to confirm your Firebase registration.</p></td></tr></tbody></table></td></tr></tbody></table></td></tr></tbody></table></div>";

       return( $mailer->send_mail($email, $body, $subject));
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
		
		
		
		public function insertUserEmail($email,$password){
			 global $database;
			$hashedpass =  password_hash("$password", PASSWORD_BCRYPT); 
			$res=$database->query("INSERT INTO $this->table (user_email,user_password,is_email_verified,is_first_login,is_deleted) VALUES ('$email','$hashedpass',0,1,0)");
		}
        
        


        public function insertUserDetails($user_first_name, $user_last_name, $user_flat, $user_building, $user_street, $user_city, $user_state, $user_nationality,$user_role_id){

			
			global $database;
			
			

			
			$created_by = $_SESSION['user_id'];
        	$current_date = date("Y-m-d h:i:sa");
        	$is_email_verified = 1;


			$sql = "UPDATE $this->table set user_first_name='$user_first_name', user_last_name='$user_last_name', user_flat='$user_flat', user_building='$user_building', user_street='$user_street', user_city='$user_city', user_state='$user_state', user_nationality='$user_nationality', user_role_id= $user_role_id,is_email_verified=1,is_first_login=0, created_by=$created_by, updated_by=$created_by,is_deleted=0 where user_id=$created_by";


			
			
			$res=$database->query($sql);
			
		
			$user_name=$user_first_name." ".$user_last_name;
			$this->setSession($created_by,$user_name,$user_role_id,$_SESSION['user_email']);
			
			//unlink("images/$img_name");
            
			
			
		}
        
        public function selectUserByEmailId($user_email){
            global $database;
            $sql = "SELECT user_id as id FROM users WHERE user_email = '{$user_email}'";
            $res=$database->query($sql);
            $row = $res->fetch_assoc();
            return $row['id'];
        }
		
		public function updateUser($user_first_name,$user_last_name,$user_pincode){
			global $database;
			$user_id=$_SESSION['user_id'];
        	$current_date = date("Y-m-d h:i:sa");
			$sql="UPDATE $this->table set user_first_name='$user_first_name', user_last_name='$user_last_name', updated_by=$user_id,updated_at=now(),user_pincode='$user_pincode' where user_id=$user_id";
			$res=$database->query($sql);
			
			Functions::redirect("showUser.php");
		}
	}

?>