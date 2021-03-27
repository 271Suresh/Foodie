<?php
include('connection.php');
session_start();
$email = $_SESSION['login_user'];
$sql2 = "SELECT * FROM customer where custemail = '$email'";
$result2 = mysqli_query($conn, $sql2);
$row2 = mysqli_fetch_assoc($result2);

$user = $row2['custid'];
echo "$user";
$fid = $_GET['fid'];
echo "$fid";
$sql = "DELETE FROM cart WHERE custid ='$user' AND fid ='$fid'";
if($conn->query($sql)===true){
header("location: cart.php");
}
else{
	echo "error";
}
?>