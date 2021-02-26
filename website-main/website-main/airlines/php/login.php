<?php
$host = "localhost";  
    $user = "root";  
    $p = '';  
    $db_name = "airlines";  
      
    $con = mysqli_connect($host, $user, $p, $db_name);  
    if(mysqli_connect_errno()) {  
        die("Failed to connect with MySQL: ". mysqli_connect_error());  
    }
  
$username = $_POST['username'];  
$password = $_POST['password'];  
  
    //to prevent from mysqli injection  
    $username = stripcslashes($username);  
    $password = stripcslashes($password);  
    $username = mysqli_real_escape_string($con, $username);  
    $password = mysqli_real_escape_string($con, $password);  
    $sql = "SELECT * FROM `user` where email = '$username' and pass = '$password'";  
    $result = mysqli_query($con, $sql);  
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);  
    $count = mysqli_num_rows($result);  
      
    if($count == 1){  
        echo "<h1><center> Login successful </center></h1>";
        echo "<center>Hi,&nbsp&nbsp".$username."</center>";
        if (mysqli_num_rows($result) == 1) {
          $_SESSION['username'] = $username;
          $_SESSION['success'] = "You are now logged in";
          header('location: ../aircrafts.html');
        }else {
          array_push($errors, "Wrong username/password combination");
        }  
    }  
    else{  
        echo "<h1> Login failed. Invalid username or password.</h1>";  
        echo "<a href='../charters.html'>Try Again</a>";
    }
?>


