<?php session_start(); ?>
<?php

  $_SESSION['user_email']=null;
  $_SESSION['username']=null;

  header("location: login.php");

?>