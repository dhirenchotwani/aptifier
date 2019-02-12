<?php
include_once("bootstrap.php");
Session::startSession();
?> <script>window.alert("<?php echo "Statistics of test ". $_SESSION['test_id']." by this user will load here"; ?>")</script>
<?php
///Functions::redirect("dashboard.php");
?>