<?php
  session_start();
  unset($_SESSION["teacher"]);
  $_SESSION["teacher"]='';
  session_destroy();
  header("LOCATION:login.php");
  
 
  
?>