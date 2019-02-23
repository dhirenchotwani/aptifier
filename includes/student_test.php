<?php
include_once("../classes/Session.php");
Session::startSession();
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
	<link type="text/css" href="../assets/css/argon.css?v=1.0.0" rel="stylesheet">
</head>

<body class="">
	<!-- Sidenav -->
	<nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id="sidenav-main">
		<div class="container-fluid">
		<!-- Brand -->
			<a class="navbar-brand pt-0" href="../index.html">
        <img src="../assets/img/brand/blue.png" class="navbar-brand-img" alt="...">
      </a>
     <!-- Collapse -->
			<div class="collapse navbar-collapse" id="sidenav-collapse-main">
       <!-- Navigation -->
				<ul class="navbar-nav">
					<li class="nav-item">
						<a class="nav-link" href="../index.html">
              <i class="ni ni-tv-2 text-primary"></i> Dashboard
                       </a>
					</li>
               </ul>
           </div>
		</div>
	</nav><!-- Page content -->
<form method="post" action="output.php">
<?php
include_once("bootstrap.php");
?>
<?php
$obj = new Test();
$result_set = $obj->showTest($_SESSION['test_id']);
$i=1;
$array = array();
while($row = mysqli_fetch_assoc($result_set)){
        extract($row);
?>
    <div class="main-content">
		<!-- Header -->
		<div class="header    py-lg-8"></div>
		<!-- Page content -->
		<div class="container mt--8 pb-5">
			<div class="row justify-content-center">
				<div class="col-lg-6 col-md-7">
					<div class="card bg-secondary shadow border-0">
						<div class="card-header bg-transparent pb-5">
							<?php
                if($is_question_image == 1){
                    echo '<img src="data:image/jpeg;base64,'.base64_encode($row['question_image']).'" width="200px" height="200px"/>';
                }
                        ?>
							<div class="">
								<p id="<?php echo $questions_id;?>" ><span><?php echo $i.")";?> </span><?php echo $question_text; ?></p>
							</div>
						</div>
						<div class="card-body">
							<ul style="margin: 0px; list-style: none;">
								<li><input type="radio" name="optradio[<?php echo $questions_id; ?>]" value="a"><span>A. </span><?php echo $question_option1 ?></li>
								<li><input type="radio" name="optradio[<?php echo $questions_id; ?>]" value="b"><span>B. </span><?php echo $question_option2 ?></li>
								<li><input type="radio" name="optradio[<?php echo $questions_id; ?>]" value="c"><span>C. </span><?php echo $question_option3 ?></li>
								<li><input type="radio" name="optradio[<?php echo $questions_id; ?>]" value="d"><span>D. </span><?php echo $question_option4 ?></li>
							</ul>
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>
	
	
		<?php
            $i++;
       }
            ?>
   
        
        <button type="submit" name="submit_answers" class="btn btn-blue">Submit</button>   
	
   
    </form>
		
	<!-- Argon Scripts -->
	<!-- Core -->
	<script src="../assets/vendor/jquery/dist/jquery.min.js"></script>
	<script src="../assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
	<!-- Argon JS -->
	<script src="../assets/js/argon.js?v=1.0.0"></script>
</body>

</html>

