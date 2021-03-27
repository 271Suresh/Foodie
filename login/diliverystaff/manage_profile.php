<!DOCTYPE html>
<html>
 <head>
  <title>Make  Toggles & Use in Form with PHP Ajax</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
  <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
 </head>
 <body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
   <a class="navbar-brand" href="./orders.php">
    <img src="images/logo.png" width="100" height="30" alt="">
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
    <div class="navbar-nav">
      <a class="nav-item nav-link" href="orders.php">Orders</a>
      <a class="nav-item nav-link" href="Review.php">Reviews</a>
      <a class="nav-item nav-link" href="manage_profile.php">Manage Profile</a>
         <?php
        include("script.php");
        
         if($_SESSION['login_user']) {
          //logout button
          ?>
      <a class="nav-item nav-link" href="Signoutscript.php">SignOut</a>
           <?php
              }             //login button
          ?>
    </div>
  </div>
</nav>

<div class="container">
<div class="row flex-lg-nowrap">
  <div class="col-12 col-lg-auto mb-3" style="width: 200px;">
  </div>

  <div class="col">
    <div class="row">
      <div class="col mb-3">
        <div class="card">
          <div class="card-body">
            <div class="e-profile">      
              <div class="tab-content pt-3">
                <div class="tab-pane active">
                  <?php
                        $email = $_SESSION['login_user'];    
                        $query = "SELECT * FROM deliveryboy WHERE  demail='$email'";
                        $query_run = mysqli_query($connection,$query);
                        foreach($query_run as $row)
                        {
                         ?>
                  <form action="script.php" method="POST" class="form" novalidate="">
                    <div class="row">
                      <div class="col">
                        <div class="row">
                          <div class="col">
                            <div class="form-group">
                              <label>Full Name</label>
                              <input class="form-control" type="text" name="name" value="<?php echo  $row['dname']; ?>" name="name"  value="John Smith">
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col">
                            <div class="form-group">
                              <label>Email:</label>
                               <label><b><?php echo  $row['demail'];?></b></label>
                             
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-12 col-sm-6 mb-3">
                        <div class="mb-2"><b>Change Password</b></div>
                        <div class="row">
                          <div class="col">
                            <div class="form-group">
                              <label>Current Password</label>
                              <input class="form-control"   value="<?php echo $row['password'];?>" >
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col">
                            <div class="form-group">
                              <label>New Password</label>
                              <input class="form-control" name="password" type="password" >
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col d-flex justify-content-end">
                        <button class="btn btn-primary" name="profile" type="submit">Save Changes</button>
                      </div>
                    </div>
                  </form>
                   <?php  
                    }
                    ?>

                    <!-- change status -->
<div class="container" style="width:600px;">
   <form method="post" id="insert_data"> 
  
    <?php
                        $email = $_SESSION['login_user'];    
                        $query = "SELECT * FROM deliveryboy WHERE  demail='$email'";
                        $query_run = mysqli_query($connection,$query);
                        foreach($query_run as $row)
                        {
                         ?>
      <div class="form-group">
     <label>User Status</label>
     <div class="checkbox">
      <input type="checkbox" name="status" id="status" <?php $avail=$row['avail']; if($avail==1) echo "checked"  ?> />
     </div>
    </div>
    <input type="hidden" name="hiddenstatus" id="hiddenstatus" value="<?php echo $row['avail'];?>" />
   <?php  
                    }
                    ?>
    <input type="hidden" name="send"  class="btn btn-info"  />
    <input type="submit" name="insert_data" id="action" class="btn btn-info" value="Change Status" />
   </form>
  </div>
    
                    <!-- --------- -->
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-12 col-md-3 mb-3">
      </div>

    </div>
  </div>
</div>
</div>

<script>
$(document).ready(function(){
 
 $('#status').bootstrapToggle({
  on: 'Active',
  off: 'Dactive',
  onstyle: 'success',
  offstyle: 'danger'
 });

 $('#status').change(function(){
  if($(this).prop('checked'))
  {
   $('#hiddenstatus').val('1');
  }
  else
  {
   $('#hiddenstatus').val('0');
  }
 });

 $('#insert_data').on('submit', function(event){
  event.preventDefault();

 if($('#hiddenstatus').val() != '')
  {
var hiddenstatus=$('#hiddenstatus').val();


   $.ajax({
     
    url:"insert.php",
    method:"POST",
    data:$(this).serialize(),
    success:function(data){
    
     if(data == 'done')
     {
      // $('#insert_data')[0].reset();
      // $('#status').bootstrapToggle('on')
     }
    }
   });
}
 });

});
</script>


<?php
include('includes/footer.php'); 
?>
