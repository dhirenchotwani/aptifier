<?php
include_once("bootstrap.php");
Session::startSession();
$page="Dashboard";
$test_set=0;
$obj=new User();
$test=new Test();
$user_id=$_SESSION['user_id'];
$res=$obj->getUserWithCondition("user_id",$user_id);
if($row=mysqli_fetch_assoc($res))
	extract($row);

if($user_role_id==5){
	$res=$obj->getUserWithJoinCondition("INNER JOIN student on users.user_id = student.user_id INNER JOIN student_class on student.student_class_id=student_class.student_class_id INNER JOIN branch on student.student_branch=branch.branch_id","users.user_id",$_SESSION['user_id']);
$row=mysqli_fetch_assoc($res);
extract($row);
	$res=$test->getAllLiveTest($student_class_id);		
	}


else if($user_role_id==3){
	$res=$test->getAllLiveTestForTeacher($user_id);
	if($row=mysqli_fetch_assoc($res)){
		extract($row);
	$_SESSION['test_id']=$test_id;
		$test_set=1;
	}
}
//Functions::redirect('includes/login.php');

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
  <link type="text/css" href="../assets/css/argon.min.css" rel="stylesheet">
</head>

<body>
   <!-- Sidenav -->
  <?php include_once("templates/sidebar.php"); ?>
  <!-- Sidenav Ends here-->
  
  <!-- Main content -->
  <div class="main-content">
    <!-- Top navbar -->
     <?php include_once("templates/topbar.php"); ?>
      <!-- Top navbar here -->
    <!-- Header -->
    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
      <div class="container-fluid">
        <div class="header-body">
          <!-- Card stats -->
          <div class="row">
            <div class="col-xl-3 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Total Score</h5>
                      <span class="h2 font-weight-bold mb-0">3508</span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
                        <i class="fas fa-chart-pie"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-muted text-sm">
                    <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span>
                    <span class="text-nowrap">Since last month</span>
                  </p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Total Tests</h5>
                      <span class="h2 font-weight-bold mb-0">10</span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-warning text-white rounded-circle shadow">
                        <i class="fas fa-file-alt"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-muted text-sm">
                    <span class="text-danger mr-2"><i class="fas fa-arrow-down"></i> 3.48%</span>
                    <span class="text-nowrap">Since last week</span>
                  </p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Total Score</h5>
                      <span class="h2 font-weight-bold mb-0">924</span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-yellow text-white rounded-circle shadow">
                        <i class="fas fa-calendar"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-muted text-sm">
                    <span class="text-warning mr-2"><i class="fas fa-arrow-down"></i> 1.10%</span>
                    <span class="text-nowrap">Since yesterday</span>
                  </p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Performance</h5>
                      <span class="h2 font-weight-bold mb-0">49,65%</span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-info text-white rounded-circle shadow">
                        <i class="fas fa-percent"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-muted text-sm">
                    <span class="text-success mr-2"><i class="fas fa-arrow-up"></i> 12%</span>
                    <span class="text-nowrap">Since last month</span>
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <hr style="border-color:white">
    </div>
<!--hEADER ENDS HERE-->
   
<!--   Page Content-->
   <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
     <h3 style="color:white; padding-left:40px;">LIVE TEST</h3>
      <div class="container-fluid">
        <div class="header-body">
          <!-- Card stats -->
  
          <div class="row">
            <?php
			  if(mysqli_num_rows($res) > 0 ){
			foreach($res as $tst){
						extract($tst);
			
           if($user_role_id==3){
			   ?>	
            <div class="col-xl-3 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body" >
                 <?php
							echo "<a href='showTestStatistics.php'>$test_name</a>";
						echo "<p>Test Class:D$test_class_id$test_division</p>";
					
						echo "<p>Test Date:$test_date</p>";
				echo "<p>Test Starts at:$start_time</p>";
			
					?>
                </div>
              </div>
            </div>
         
            <?php
			      }else if($user_role_id==5){
			   if(!$test->isTestGiven($_SESSION['user_id'],$test_id)){
			   ?>
			   <div class="col-xl-3 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                 <?php
							echo "<a href='startTest.php?q=$test_id'>$test_name</a>";
						echo "<p>Test Date:$test_date</p>";
				echo "<p>Test Starts at:$start_time</p>";
			
					?>
                </div>
              </div>
            </div>
			<?php   
		   }
		   }
			}
			  }
            ?>
           
           
           
          </div>
        </div>
      </div>
    </div>
<!--    Page content ends here-->
  </div>
  <!-- Argon Scripts -->
  <!-- Core -->
  <script src="../assets/vendor/jquery/dist/jquery.min.js"></script>
  <script src="../assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <!-- Optional JS -->
  <script src="../assets/vendor/chart.js/dist/Chart.min.js"></script>
  <script src="../assets/vendor/chart.js/dist/Chart.extension.js"></script>
  <!-- Argon JS -->
  <script src="../assets/js/argon.js?v=1.0.0"></script>
</body>

</html>