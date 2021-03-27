<?php
include('includes/config.php');

if(isset($_POST['login']))
{
    $email = $_POST['email'];
    $password = $_POST['password'];

      $sql = "SELECT did 
              FROM deliveryboy
              WHERE demail='$email'
              AND password='$password'";
      $result = mysqli_query($connection,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
       
      $count = mysqli_num_rows($result);
      $error = "Your Login Name or Password is invalid";
      // If result matched $myusername and $mypassword, table row must be 1 row
		
      if($count == 1) {
        
         $_SESSION['login_user'] = $email;
         header("location: orders.php");
      }else {
         
        $_SESSION['error'] = $error;
         header("location: ../dlog.php");
      }
   }

//profule
if(isset($_POST["profile"]))
{
    $id =  $_SESSION['login_user'];
    $name = $_POST['name'];
    $password = $_POST['password'];

        $query = "UPDATE deliveryboy
                  SET dname='$name',
                  password='$password'
                  WHERE demail='$id' ";
        $query_run = mysqli_query($connection, $query);
    
        if($query_run)
        {
           
            $_SESSION['success'] =  "changes done";
            header('Location: manage_profile.php');
      
        }
        else 
        {
          
            $_SESSION['status'] =  "changes not done";
            header('Location: manage_profile.php');
        }
}


// ============Update order status====================

if(isset($_POST["unioid"]))
{
    $id =  $_POST['unioid'];
    $name = $_POST['orderstatus'];

        $query = "UPDATE orderdetails
                  SET status='$name'
                  WHERE  oid='$id' ";
        $query_run = mysqli_query($connection, $query);
    
        if($query_run)
        {
           
            $_SESSION['success'] =  "changes done";
            header('Location: orders.php');
      
        }
        else 
        {
          
            $_SESSION['status'] =  "changes not done";
            header('Location: manage_profile.php');
        }
}

?>