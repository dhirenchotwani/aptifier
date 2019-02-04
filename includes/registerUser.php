
<?php
include_once("bootstrap.php");
?>


<?php
if(isset($_POST['submit_user_details'])){
    extract($_POST);
    $user = new User();
    
    $result = $user->insertUserDetails($user_first_name, $user_last_name, $user_email, $user_password, $user_flat, $user_building, $user_street, $user_city, $user_state, $user_nationality);
}

?>
  

  <!DOCTYPE html>
   
   <html>
   
    <head>
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/details.css">
    </head>
    <body>
       
        <div class="container">
           <h1>Details</h1>
       <hr style="background: #37abed">
            <form action="#" method="post" name="add_user">
                <label>First Name</label>
                <input type="text" class="form-control" name="user_first_name" id="user_first_name">
                <label>Last Name</label>
                <input type="text" class="form-control" name="user_last_name" id="user_last_name">
                <label>Email ID</label>
                <input type="text" class="form-control" name="user_email" id="user_email">
                <label>Password</label>
                <input type="hidden" class="form-control" name="user_password" id="user_password">
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
                
                
                <button class="btn btn-primary" name="submit_user_details" id="submit_user_details">Submit</button>
            </form>
        </div>
        
    </body>
</html>

