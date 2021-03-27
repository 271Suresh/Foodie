<?php
include('includes/navbar.php'); 
?>
<table class="table table-hover table-dark">
  <thead>
    <tr>
      <th scope="col">Customer</th>
      <th scope="col">rating</th>
      <th scope="col">comments</th>
    </tr>
  </thead>
  <tbody>
    <?php
     $email = $_SESSION['login_user'];                
     $query ="SELECT * FROM 
              feedback as f,
              customer as c,
              deliveryboy as d
              where f.did=d.did
              and f.custid= c.custid 
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
      <th scope="row"><?php echo $row['custname']; ?></th>
      <td><?php echo $row['rating']; ?></td>
      <td><?php echo $row['comments']; ?></td>
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
<?php
      }
      else
      {
        echo "No Record Found";
      }
?>
<?php
include('includes/footer.php'); 
?>
