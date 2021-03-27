<?php
$servername="localhost:3308";
$username="root";
$password="";
$dbname="foodie";
//create connection 
$conn = new mysqli($servername, $username, $password, $dbname);
//check connection 
if($conn->connect_error){
	die("connection failed: ".$conn->connect_error);
}
?>