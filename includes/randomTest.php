<?php
include_once("bootstrap.php");

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
    
    <form method="post" action="test_scheduled.php">
        <div class="main-content">
            <!-- Header -->
            <div class="header py-lg-8"></div>
            <?php
            $obj = new Test();
            $result = $obj->countQuestions();
            if(isset($_POST['generateRandom'])){

                extract($_POST);
                if($countOfQuestions <= $result){
                    $array = array();
                    for($i=0;count($array)<$countOfQuestions;$i++){
                        $rand = rand(1,$result);
                        if(!in_array($rand,$array)){
                            array_push($array, $rand);
                        }
                    }
                    //print_r($array);
                    session_start();
                    //echo "hii";
                    $_SESSION['array'] = $array;
                
                }
                $obj = new Test();
                $k=1;
                for($j=0;$j<count($array);$j++){
                    $res = $obj->getQuestionWithRandomNumber($array[$j]);
                    $row = mysqli_fetch_assoc($res);
                    extract($row);
            ?>
                <!-- Page content -->
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
								<p id="<?php echo $questions_id;?>" ><span><?php echo $k.")";?> </span><?php echo $question_text; ?></p>
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
            $k++;
}//end of loop
    }//end of if
            ?>
            <p>Name of the Test</p>
           <input type="text" name="test_name"> 
        <p>Date To be conducted on:</p>
        <input type="date" name="test_date">
<!--
				<p>Start Time:</p>
				<input type="time" name="start_time">
				<p>End Time:</p>
				<input type="time" name="end_time">
-->
        <p>Class:</p>
        <select name="test_division" id="test_division">
            <option value="1">D1</option>
            <option value="2">D2</option>
            <option value="3">D3</option>
            <option value="4">D4</option>
            <option value="5">D5</option>
            <option value="6">D6</option>
            <option value="7">D7</option>
            <option value="8">D8</option>
            <option value="9">D9</option>
            <option value="10">D10</option>
            <option value="11">D11</option>
            <option value="12">D12</option>
            <option value="13">D13</option>
            <option value="14">D14</option>
            <option value="15">D15</option>
            <option value="16">D16</option>
            <option value="17">D17</option>
            <option value="18">D18</option>
            <option value="19">D19</option>
            <option value="20">D20</option>
        </select>
        
        <p>Test Level:</p>         
        <select name="test_level" id="">
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
        </select>
                    <button type="submit" name="submit_test" class="btn btn-blue">SET TEST</button>
                    <a href="<?php echo BASEURL."includes/showGeneratedTest.php "?>" class="btn">Generate Again!</a>
        </div>

    </form>

    <!-- Argon Scripts -->
    <!-- Core -->
    <script src="../assets/vendor/jquery/dist/jquery.min.js"></script>
    <script src="../assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Argon JS -->
    <script src="../assets/js/argon.js?v=1.0.0"></script>
</body>
</html>
