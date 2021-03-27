<?php
   include('config.php');
   $user_check = $_SESSION['login_user'];
   $ses_sql = mysqli_query($connection,"select demail from diliveryboy where demail = '$user_check' ");
   $row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
   $login_session = $row['demail'];
   if(!isset($_SESSION['login_user'])){
      header("location:signin.php");
      die();
   }
?>