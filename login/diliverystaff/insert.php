 <?php
include('includes/config.php');
if(isset($_POST["send"]))
{
    $id =  $_SESSION['login_user'];
    $name = $_POST['hiddenstatus'];

        $sql = "UPDATE deliveryboy SET avail='$name'  WHERE demail='$id' ";
        if ($connection->query($sql) === TRUE) {
    	echo 'done';
		} else {
    	echo "Error: " . $sql . "<br>" . mysqli_error($connection);
		}
		$connection->close();
}

?>
