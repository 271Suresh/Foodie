<?php
include('includes/navbar.php'); 
?>

<form action="single_order.php" method="post">
<table class="table table-hover table-dark">
  <thead>
    <tr>
      <th scope="col">OrderId</th>
      <th scope="col">Date</th>
      <th scope="col">Restaurant</th>
      <th scope="col">status</th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
     <?php
     $email = $_SESSION['login_user'];                
     $query ="SELECT * FROM 
                orders as o,
                customer as c,
                deliveryboy as d,
                restaurant as r,
                orderdetails as od
                where o.did=d.did
                and r.restid= o.restid
                and c.custid=o.custid
                and od.oid = o.oid
                and od.status != 'delivered'
                and d.demail='$email'";
    $query_run=mysqli_query($connection,$query);
    if(mysqli_num_rows($query_run) > 0)
    {
    
    ?>
    <?php 
    if(mysqli_num_rows($query_run) > 0)
    {
      while($row = mysqli_fetch_assoc($query_run))
      {
      ?>   
    <tr>
      <th scope="row"><?php echo $row['oid'];?></th>
      <th scope="row"><?php echo $row['odate'];?></th>
      <td><?php echo $row['restname'];?></td>
      <td><?php echo $row['status'];?></td>
      <td> 
         
        <button class="btn btn-primary font-weight-bold" type="submit" value="<?php echo $row['oid'];?>" name="xwvxa"><span class="font-weight-bold">View Order</span></button>          
          </a>    
      </td>
    </tr>
      <?php
        }
      }
      else{
          echo "No record found";
        }
    ?>
  </tbody>
</table>
</form>
<?php
      }
      else
      {
        echo "No Record Found";
      }
?>
<!-- test --

<?php
include('includes/footer.php'); 
?>
