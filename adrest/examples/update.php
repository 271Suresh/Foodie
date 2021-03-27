<?php
include ("connection.php");

$o_id = $_GET['ci'];
$sql = "update orderdetails set status='Ready' where oid ='$o_id'";

$data=mysqli_query($conn,$sql);

if($data){
    header("Location: orders.php");

}else{
	echo '<script language="javascript">';
    echo 'alert("Error Deleting record *data linked to service request table*")';
    echo '</script>';
    echo "<script>location.href='deleteitem.php'</script>";
}
?>
