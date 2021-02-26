<?php
session_start();
if($_SESSION["username"]) {
 echo $_SESSION["username"];
}else echo "<h1>Please login first .</h1>";
?>