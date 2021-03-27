<?php
	$servername="localhost:3308";
	$username="root";
	$password="";
	$dbname="foodie";
	
	$conn = new mysqli($servername, $username, $password, $dbname);
	
	if($conn->connect_error){
		die("connection failed: ".$conn->connect_error);
	} ?>