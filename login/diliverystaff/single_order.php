<?php
include('includes/navbar.php'); 
?>
 <?php
   $email = $_SESSION['login_user'];  
   $oid = $_POST['xwvxa'];  
   $query = "SELECT r.city as rescity,
                    r.area as resarea,
                    c.address as cusaddres,
                    c.city as custcity,
                    c.area as custarea,
                    c.phoneno as custphone,
                    fname,
                    restname,
                    custname,
                    fprice
                    FROM orders as o,
                    restaurant as r,
                    customer as c,
                    orderdetails as od,
                    fooditem as f
                    where o.restid=r.restid
                    and o.custid=c.custid 
                    and od.oid=o.oid 
                    and od.fid=f.fid 
                    and o.oid=$oid";
   $query_run = mysqli_query($connection,$query);
   foreach($query_run as $row)
   {
    ?>

<div class="container">
  <div class="row p-2 mb-2 bg-dark text-white">
    <div class="col-sm">
       <h5><div class="p-1 mb-2 bg-warning text-dark">Restaurant name</div></h5>
        <div><?php echo  $row['restname']; ?></div>
        <h5><div class="p-1 mb-2 bg-warning text-dark">restaurant address</div></h5>
        <div><?php echo  $row['rescity']; ?> <?php echo  $row['resarea']; ?></div>
    </div>
  
    <div class="col-sm">
      <h5> <div class="p-1 mb-2 bg-warning text-dark">Customer name</div></h5>
      <div><?php echo  $row['custname']; ?></div>
      <h5><div class="p-1 mb-2 bg-warning text-dark">customer address</div></h5>
      <div><?php echo  $row['cusaddres']; ?> <?php echo  $row['custcity']; ?> <?php echo  $row['custarea']; ?></div>
       <h5><div class="p-1 mb-2 bg-warning text-dark">customer phone</div></h5>
      <div><?php echo  $row['custphone']; ?></div>
    </div>
      <div class="col-sm">
        <h5><div class="p-2 mb-2 bg-warning text-dark">Order Details</div></h5>
        <div><?php echo  $row['fname']; ?></div>
        <div>Rs: <?php echo  $row['fprice']; ?> </div>
        <form action="script.php" method="POST">
         <select class="btn btn-info" name="orderstatus">
           <option>picked</option>
           <option>delivered</option>
         </select>
       <button type="submit" class="btn btn-success" name="unioid" value="<?php echo $_POST['xwvxa']; ?>">Update status</button>
       </form>
    </div>
  </div>
</div>


 <?php  
  }
  ?>

<?php
include('includes/footer.php'); 
?>