<?php
 include_once("classes/Session.php");
Session::startSession();
echo $_SESSION['user_id'];
?>