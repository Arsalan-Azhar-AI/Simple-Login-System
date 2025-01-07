<?php
session_start();
$showalert=false;
if($_SERVER["REQUEST_METHOD"]=="POST"){
include 'partials/dbconnect.php';
$username=$_POST['username'];
$password=$_POST['password'];
$cpassword=$_POST['cpassword'];
$existsql="SELECT * FROM `users` WHERE username='$username'";
$result=mysqli_query($conn,$existsql);
$numExitstRows=mysqli_num_rows($result);
$exists=false;
if($numExitstRows>0){
  // $exists=true;
  echo"Username Already Exits";
}
else{
  // $exists=false;
if($password==$cpassword){
  $hash=password_hash($password,PASSWORD_DEFAULT);
  $sql="INSERT INTO `users` (`username`, `password`, `date`) VALUES ('$username', '$hash', current_timestamp())";
   $result=mysqli_query($conn,$sql);
  if($result){
   $showalert=true;
   if($showalert==true){
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Success!</strong> Your account is now created and you are login.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
        }
  }
}
else{
  echo"Your password do not match";
}
}

}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>signup</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
  </head>
  <body>
    <?php
    require "partials/_nav.php";
    ?>
     <div class="container">
    <h1 class="text-center">Signup to our website</h1>
    <form action="/LOGINSYSTEM/signup.php" method="post" >
  <div class="mb-3 col-md-6" >
    <label for="username" class="form-label" >Username</label>
    <input type="text" class="form-control" maxlength="11" id="username"name="username" aria-describedby="emailHelp">
    
  </div>
  <div class="mb-3 col-md-6">
    <label for="password" class="form-label">Password</label>
    <input type="password" maxlength="21" class="form-control" id="password"name="password">
  </div>
  <div class="mb-3 col-md-6">
    <label for="cpassword" class="form-label">Confirm Password</label>
    <input type="password" class="form-control" maxlength="21"id="cpassword" name="cpassword">
  </div>
  <div id="emailHelp" class="form-text">Make sure your password is same.</div>
  <button type="submit" class="btn btn-primary">Signup</button>
</form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
  </body>
</html>