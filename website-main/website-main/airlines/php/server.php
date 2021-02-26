<?php
session_start();

// initializing variables
$fname = "";
$lname    = "";
$email = "";
$password = "";
$phone = "";
$dob = "";
$errors = array(); 

// connect to the database
$db = mysqli_connect("localhost", "root", "","airlines");
// REGISTER USER
if (isset($_POST['reg_user'])) {
  // receive all input values from the form
  $fname =  $_POST['fname'];
  $lname = $_POST['lname'];
  $email =  $_POST['email'];
  $password =  $_POST['password'];
  $phone =  $_POST['phone'];
  $dob = $_POST['dob'];

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  }

  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM `user` WHERE phone='$phone' AND email='$email' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $usr = mysqli_fetch_assoc($result);
  
  if ($usr) { // if user exists
    if ($usr['phone'] === $phone) {
      array_push($errors, "Phone no. already exists");
    }

    if ($usr['email'] === $email) {
      array_push($errors, "email already exists");
    }
  }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {

  	$query = "INSERT INTO `user` (fname,lname,email,pass,phone,dob) VALUES ('$fname','$lname','$email','$password',$phone,'$dob')";
    mysqli_query($db,$query);
    echo '<script>myfunction()</script>';
    echo "<h1><center> Registration successful </center></h1>";
  	$_SESSION['email'] = $email;
  	$_SESSION['success'] = "You are now logged in";
  	header('location: /../airlines/index.html');
  }
?>
