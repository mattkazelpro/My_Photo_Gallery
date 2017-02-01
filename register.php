<?php
require('include/header.php');

ob_start();
//session_start();

if (isset($user_name)) {
	header("Location: index.php");
}


 $error = false;

 if ( isset($_POST['Submit']) ) {
  
  // clean user inputs to prevent sql injections
  $name = trim($_POST['name']);
  $name = strip_tags($name);
  $name = htmlspecialchars($name);
  
  $email = trim($_POST['email']);
  $email = strip_tags($email);
  $email = htmlspecialchars($email);
  
  $pass = trim($_POST['pass']);
  $pass = strip_tags($pass);
  $pass = htmlspecialchars($pass);

  // basic name validation
  if (empty($name)) {
   $error = true;
   $nameError = "<p class='wrong'>Please enter your full name.</p>";
  } else if (strlen($name) < 3) {
   $error = true;
   $nameError = "<p class='wrong'>Name must have atleat 3 characters.</p>";
  } else if (!preg_match("/^[a-zA-Z ]+$/",$name)) {
   $error = true;
   $nameError = "<p class='wrong'>Name must contain alphabets and space.</p>";
  }
  
  //basic email validation
  if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
   $error = true;
   $emailError = "<p class='wrong'>Please enter valid email address.</p>";
  } else {
   // check email exist or not
   $query = "SELECT email FROM ".$prefix."users WHERE email='$email'";
   $result = mysql_query($query);
   $count = mysql_num_rows($result);
   if($count!=0){
    $error = true;
    $emailError = "<p class='wrong'>Provided Email is already in use.</p>";
   }
  }
  // password validation
  if (empty($pass)){
   $error = true;
   $passError = "<p class='wrong'>Please enter password.</p>";
  } else if(strlen($pass) < 6) {
   $error = true;
   $passError = "<p class='wrong'>Password must have atleast 6 characters.</p>";
  }
  
  // password encrypt using md5();
  $password = md5($pass);
  
  // if there's no error, continue to signup
  if( !$error ) {
   
   $query = "INSERT INTO ".$prefix."users(username,email,password,ip,user_level) VALUES('$name','$email','$password','$userip','1')";
   $res = mysqli_query($conn, $query);
    
   if ($res) {
    $errTyp = "success";
    $errMSG = "Successfully registered, you may login now";
    unset($name);
    unset($email);
    unset($pass);
   } else {
    $errTyp = "danger";
    $errMSG = "Something went wrong, try again later..."; 
   } 
    
  }
  
  
 }else{
     $nameError="";
     $emailError="";
     $passError="";
 }
?>




<table class="table" width="680">
	<tr class="table_header">
		<td colspan="2">Register</td>
	</tr>
	<tr class="row1">
		<td colspan="2">



<div class="container">

 <div id="login-form">
    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off">
    
     <div class="col-md-12">
            
            <?php
   if ( isset($errMSG) ) {
    
    ?>
    <div class="form-group">
             <div class="alert alert-<?php echo ($errTyp=="success") ? "success" : $errTyp; ?>">
    <span class="glyphicon glyphicon-info-sign"></span> <?php echo $errMSG; ?>
                </div>
             </div>
                <?php
   }
   ?>
</td>
</tr>
<tr class="row1">
<td valign="top">Username:</td><td>            
            <div class="form-group">
             <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
             <input type="text" name="name" class="form-control" placeholder="Enter Name" maxlength="50" value="" />
                </div>
                <span class="text-danger"><?php echo $nameError; ?></span>
            </div>

</td>
</tr>
<tr class="row1">
<td valign="top">E-Mail:</td><td> 

            <div class="form-group">
             <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
             <input type="email" name="email" class="form-control" placeholder="Enter Your Email" maxlength="40" value="" />
                </div>
                <span class="text-danger"><?php echo $emailError; ?></span>
            </div>

</td>
</tr>
<tr class="row1">
<td valign="top">Password:<br><br></td><td> 
 
            <div class="form-group">
             <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
             <input type="password" name="pass" class="form-control" placeholder="Enter Password" maxlength="15" />
                </div>
                <span class="text-danger"><?php echo $passError; ?></span>
            </div>
            
<br></td>
</tr>
<tr class="row3">
<td></td><td> 
            
            <div class="form-group">
		<input type="submit" name="Submit" value="Register"> or..... <a href="login.php">Sign in Here...</a>
            </div>
            

        
        </div>
   
    </form>
    </div> 

</div>

</td>




	</tr>
</table>
<?php
ob_end_flush(); 
require('include/footer.php');
?>