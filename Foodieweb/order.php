<?php
include('connection.php');
    session_start();
    $email = $_SESSION['login_user'];
    $sql2 = "SELECT * FROM customer where custemail = '$email'";
    $result2 = mysqli_query($conn, $sql2);
    $row2 = mysqli_fetch_assoc($result2);

    $user = $row2['custid'];
    $area = $row2['area'];
    $login =1;

    $sql = "select * from cart where custid='$user'";
    $result = mysqli_query($conn, $sql);
    $det = mysqli_query($conn, $sql);

    $total=0;

 	if($result->num_rows > 0){
        while ($row = $result->fetch_assoc()) {
            	$fid = $row['fid'];
                $sql3 = "SELECT * FROM fooditem where fid = '$fid'";
                $result3 = mysqli_query($conn, $sql3);
                $row3 = mysqli_fetch_assoc($result3);
                $rid = $row3['restid'];
                $total = $total + $row3['fprice'];
        }
    }

    $delboy = "select * from deliveryboy where area='$area' AND avail='1' order by RAND() limit 1";
    $delres = mysqli_query($conn, $delboy);
    $delrow = mysqli_fetch_assoc($delres);
    $did = $delrow['did'];

    $query = "INSERT INTO orders (odate, custid, restid, did) 
              VALUES(CURDATE(),'$user','$rid', '$did')";

    if($conn->query($query)=== true){
        echo "ordered";
        $oid = mysqli_insert_id($conn);

        while ($od = $det->fetch_assoc()) {
        	echo "blah";
            	$fid = $od['fid'];
                $query2 = "INSERT INTO orderdetails (oid,fid,status) 
              VALUES ('$oid','$fid','ordered')";
			    if($conn->query($query2)=== true){
			        echo "details inserted";
			    }
			    else{
			        $login = 0;
			        echo "error:" .$conn->error;
			    }
        }
    }
    else{
        $login = 0;
        echo "error:" .$conn->error;
    }

    $delcart = "delete from cart where custid='$user'";
    if($conn->query($delcart)=== true){
			        header("location: confirm.html");
			    }
			    else{
			        $login = 0;
			        echo "error:" .$conn->error;
			    }
        
    
     




?>