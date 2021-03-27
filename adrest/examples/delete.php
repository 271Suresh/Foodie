<?php
include ("connection.php");

$fd_id = $_GET['ci'];
$sql = "DELETE from fooditem where fid = '$fd_id'";

$data=mysqli_query($conn,$sql);

if($data){
    header("Location: deleteitem.php");

}else{
	echo '<script language="javascript">';
    echo 'alert("Error Deleting record *data linked to service request table*")';
    echo '</script>';
    echo "<script>location.href='deleteitem.php'</script>";
}
?>
