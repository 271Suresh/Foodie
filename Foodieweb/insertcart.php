<?php
include('connection.php');
    session_start();
    $fid = $_GET['fid'];
    $rid = $_GET['rid'];

    $email = $_SESSION['login_user'];

    $sql2 = "SELECT * FROM customer where custemail = '$email'";
    $result2 = mysqli_query($conn, $sql2);
    $row2 = mysqli_fetch_assoc($result2);

    $userid = $row2['custid'];

    $sql = "select * from cart where custid='$userid' limit 1";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $fid2 = $row['fid'];

    $sql3 = "select * from fooditem where fid = '$fid2'";
    $result3 = mysqli_query($conn, $sql3);
    $row3 = mysqli_fetch_assoc($result3);
    $rid2 = $row3['restid'];
    
    if($rid == $rid2 || is_null($rid2)){
    $ins = "INSERT INTO cart (qty, custid, fid) 
              VALUES(1,'$userid','$fid')";
              if($conn->query($ins)=== true){
                echo "added";
                header("location: menu.php?rid=$rid");
            }
            else{
                echo "error";
            }
    }
    else{
        echo "You cant add this item to cart because there are already items from another restaurant";
    }
?>