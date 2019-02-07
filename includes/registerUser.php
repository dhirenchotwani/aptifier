
<?php
include_once("bootstrap.php");
?>


<?php
if(isset($_POST['submit_user_details'])){
    extract($_POST);
    $user = new User();
    $user_name=$user_first_name." ".$user_last_name;
	$info = pathinfo($_FILES['user_profile_pic']['name']);
	$ext = $info['extension']; // get the extension of the file
	$newname = "$user_name.".$ext; 
	$target = 'images/'.$newname;
	move_uploaded_file( $_FILES['user_profile_pic']['tmp_name'], $target);
	
    $result = $user->insertUserDetails($user_first_name, $user_last_name, $user_flat, $user_building, $user_street, $user_city, $user_state, $user_nationality,$user_role_id,$newname);
//	
	Functions::redirect('../dashboard.php');
}

?>
  

  <!DOCTYPE html>
   
   <html>
   
    <head>
        <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="../assets/css/details.css">
    </head>
    <body>
       
        <div class="container">
           <h1>Details</h1>
       <hr style="background: #37abed">
            <form action="#" method="post" name="add_user" enctype="multipart/form-data">
                <label>First Name</label>
                <input type="text" class="form-control" name="user_first_name" id="user_first_name">
                <label>Last Name</label>
                <input type="text" class="form-control" name="user_last_name" id="user_last_name">
             
                <br>
                <H4>Address:</H4>
                <label>Flat</label>
                <input type="text" class="form-control" name="user_flat" id="user_flat">
                <label>Building</label>
                <input type="text" class="form-control" name="user_building" id="user_building">
                <label>Street</label>
                <input type="text" class="form-control" name="user_street" id="user_street">
                <label>City</label>
                <input type="text" class="form-control" name="user_city" id="user_city">
                <label>State</label>
                <input type="text" class="form-control" name="user_state" id="user_state">
                <label>Natioanlity</label>
                <input type="text" class="form-control" name="user_nationality" id="user_nationality">
                <br>
                <label for="">You are a :</label>
                <input type="number" name="user_role_id" class="form-control" id="user_role_id" min="1" max="5">
                <br>
                <div class="inputoutput">
    			<img id="imageSrc" alt="No Image" style="display: block" />
    			<div class="caption"><input type="file" id="fileInput" name="user_profile_pic" /></div>
				</div>
               <br>
                
                <button class="btn btn-primary" name="submit_user_details" id="submit_user_details">Submit</button>
                
            </form>
        </div>
        <script>
			let imgElement = document.getElementById("imageSrc");
			imgElement.height=250;
			imgElement.width=250;
			let inputElement = document.getElementById("fileInput");
			inputElement.addEventListener("change", (e) => {
  			imgElement.src = URL.createObjectURL(e.target.files[0]);
			}, false);	
		</script>
    </body>
</html>

