<body class="">
<?php
include ("connection.php");
session_start();

if(isset($_SESSION['login_admin'])){
	echo "<h3 align = right>Welcome <br>" . $_SESSION['login_admin']."</h3>";
}
else
{
	echo "<script>alert('please enter username and password!')</script>";
	echo "<script>location.href='index.php'</script>";
}

$email1 = $_SESSION['login_admin'];
$sql2 = "SELECT * FROM admin WHERE email = '$email1'";
$result2 = mysqli_query($conn, $sql2);
$row2 = mysqli_fetch_assoc($result2);
$ad = $row2['aid'];
//insert
if(isset($_POST["button1"]))
{
	$fdname = $_POST["fdname"];
  $fddesc = $_POST["fddesc"];
  $type = $_POST["type"];
  $image = $_FILES["fdimage"]["name"];
  $price = $_POST["price"];
  $sql = "insert into fooditem(fname,fdesc,fprice,restid,photo,type) values('$fdname','$fddesc','$price','$ad','$image','$type')";

if($conn->query($sql)===TRUE){
	move_uploaded_file($_FILES["fdimage"]["tmp_name"], "foodimage/".$_FILES["fdimage"]["name"]);
	echo '<script language="javascript">';
    echo 'alert("Item Added Successfully")';
    echo '</script>';
}else{
	echo '<script language="javascript">';
    echo 'alert("Error")';
    echo '</script>';
}
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    Foodie
  </title>
  <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
  <!-- CSS Files -->
  <link href="../assets/css/material-dashboard.css?v=2.1.2" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="../assets/demo/demo.css" rel="stylesheet" />
  <style>
          * {
          box-sizing: border-box;
        }

        input[type=text], select, textarea {
          width: 80%;
          padding: 12px;
          border: 1px solid #ccc;
          border-radius: 4px;
          resize: vertical;
        }

        label {
          padding: 12px 12px 12px 0;
          display: inline-block;
        }

        input[type=submit] {
          background-color: #4CAF50;
          color: white;
          padding: 10px 20px;
          border: none;
          border-radius: 4px;
          cursor: pointer;
          float: right;
        }

        input[type=submit]:hover {
          background-color: #45a049;
        }

        .container {
          border-radius: 5px;
          background-color: #f2f2f2;
          padding: 20px;
        }

        .col-25 {
          float: left;
          width: 10%;
          margin-top: 6px;
          margin-left: 40px;
        }

        .col-75 {
          float: left;
          width: 75%;
          margin-top: 6px;
          margin-left: 5px;
        }

        /* Clear floats after the columns */
        .row:after {
          content: "";
          display: table;
          clear: both;
        }

        /* Responsive layout - when the screen is less than 600px wide, make the two columns stack on top of each other instead of next to each other */
        @media screen and (max-width: 600px) {
          .col-25, .col-75, input[type=submit] {
            width: 100%;
            margin-top: 0;
          }
        }
        .button {
            background-color: #4CAF50; /* Green */
            border: none;
            color: white;
            padding: 15px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            border-radius: 8px;
}
</style>
</head>
  <div class="wrapper ">
    <div class="sidebar" data-color="purple" data-background-color="white" data-image="../assets/img/sidebar-1.jpg">
      <div class="logo"><a href="http://www.creative-tim.com" class="simple-text logo-normal">
          Foodie
        </a></div>
      <div class="sidebar-wrapper">
        <ul class="nav">
          <li class="nav-item  ">
            <a class="nav-link" href="dashboard.php">
              <i class="material-icons">dashboard</i>
              <p>Dashboard</p>
            </a>
          </li>
          
          <li class="nav-item active" >
            <a class="nav-link" href="additem.php">
              <i class="material-icons">bubble_chart</i>
              <p>Add Food Item</p>
            </a>
          </li>
          <li class="nav-item ">
            <a class="nav-link" href="deleteitem.php">
            <i class="material-icons">content_paste</i>
              <p>Delete Food Item</p>
            </a>
          </li>
          <li class="nav-item ">
            <a class="nav-link" href="orders.php">
            <i class="material-icons">content_paste</i>
              <p>Orders</p>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="report.php">
            <i class="material-icons">content_paste</i>
              <p>Report</p>
            </a>
          </li>
        </ul>
      </div>
    </div>
    <div class="main-panel">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <a class="navbar-brand" href="javascript:;">Add Food Item</a>
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="sr-only">Toggle navigation</span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-end">
            
            <ul class="navbar-nav">
              
                <a class="nav-link" href="javascript:;" id="navbarDropdownProfile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="material-icons">person</i>
                  <p class="d-lg-none d-md-block">
                    Account
                  </p>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownProfile">
                  <a class="dropdown-item" href="#">Profile</a>
                  <a class="dropdown-item" href="#">Settings</a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="ad_logout.php">Log out</a>
                </div>
              
            </ul>
          </div>
        </div>
      </nav>
      <!-- End Navbar -->
      <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title ">Add Food Items</h4>
                  <p class="card-category"> Here You can add Food Items</p>
                </div>
                <div class="card-body">
                  
                  <form action="additem.php" method="post" enctype="multipart/form-data">
                  
                  <div class="row">
                    <div class="col-25">
                          <label for="fname">Food Item Name</label>
                        </div>
                        <div class="col-75">
                          <input type="text" id="fd" name="fdname" placeholder="Enter Food Item" required>
                        </div>
                      </div>
                      <br>
                      <div class="row">
                        <div class="col-25">
                          <label for="lname">Food Item Description</label>
                        </div>
                        <div class="col-75">
                          <input type="text" id="des" name="fddesc" placeholder="Enter Description" required>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-25">
                          <label for="choice">Veg Or Non-Veg</label>
                        </div>
              
                        <div class="col-75">
                          <select id="dropdown" name="type">
                          <option disabled selected value="sample">veg Or Non-veg</option>
                            <option value="vag">Veg</option>
                            <option value="non_veg">Non-veg</option>
                          </select><br><br>
                        </div>
                        &nbsp; &nbsp; &nbsp; Select image to upload:&nbsp; &nbsp;
				                <input type="file" id="fileToUpload" name="fdimage" required>

                      </div><br>
                      <div class="row">
                        <div class="col-25">
                          <label for="price">Set Price ₹</label>
                        </div>
                        <div class="col-75">
                          <input type="text" id="price" name="price" placeholder="Set Price" style="width: 100px" required>
                        </div>
                      </div>
                      <br>
                      <div class="row">
                      &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp;<button class="button" name="button1" id="proceed">Add</button>
                      </div>
                      </form>
                    </div>
                  </div>
              </div>
            </div>
            
      <footer class="footer">
        <div class="container-fluid">
          <nav class="float-left">
            <ul>
              <li>
                <a href="">
                  About Us
                </a>
              </li>
              <li>
                <a href="">
                  Google
                </a>
              </li>
            </ul>
          </nav>
        </div>

      </footer>
        <!--   Core JS Files   -->
  <script src="../assets/js/core/jquery.min.js"></script>
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap-material-design.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <!-- Plugin for the momentJs  -->
  <script src="../assets/js/plugins/moment.min.js"></script>
  <!--  Plugin for Sweet Alert -->
  <script src="../assets/js/plugins/sweetalert2.js"></script>
  <!-- Forms Validations Plugin -->
  <script src="../assets/js/plugins/jquery.validate.min.js"></script>
  <!-- Plugin for the Wizard, full documentation here: https://github.com/VinceG/twitter-bootstrap-wizard -->
  <script src="../assets/js/plugins/jquery.bootstrap-wizard.js"></script>
  <!--	Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
  <script src="../assets/js/plugins/bootstrap-selectpicker.js"></script>
  <!--  Plugin for the DateTimePicker, full documentation here: https://eonasdan.github.io/bootstrap-datetimepicker/ -->
  <script src="../assets/js/plugins/bootstrap-datetimepicker.min.js"></script>
  <!--  DataTables.net Plugin, full documentation here: https://datatables.net/  -->
  <script src="../assets/js/plugins/jquery.dataTables.min.js"></script>
  <!--	Plugin for Tags, full documentation here: https://github.com/bootstrap-tagsinput/bootstrap-tagsinputs  -->
  <script src="../assets/js/plugins/bootstrap-tagsinput.js"></script>
  <!-- Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->
  <script src="../assets/js/plugins/jasny-bootstrap.min.js"></script>
  <!--  Full Calendar Plugin, full documentation here: https://github.com/fullcalendar/fullcalendar    -->
  <script src="../assets/js/plugins/fullcalendar.min.js"></script>
  <!-- Vector Map plugin, full documentation here: http://jvectormap.com/documentation/ -->
  <script src="../assets/js/plugins/jquery-jvectormap.js"></script>
  <!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
  <script src="../assets/js/plugins/nouislider.min.js"></script>
  <!-- Include a polyfill for ES6 Promises (optional) for IE11, UC Browser and Android browser support SweetAlert -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>
  <!-- Library for adding dinamically elements -->
  <script src="../assets/js/plugins/arrive.min.js"></script>
  <!--  Google Maps Plugin    -->
  <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
  <!-- Chartist JS -->
  <script src="../assets/js/plugins/chartist.min.js"></script>
  <!--  Notifications Plugin    -->
  <script src="../assets/js/plugins/bootstrap-notify.js"></script>
  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../assets/js/material-dashboard.js?v=2.1.2" type="text/javascript"></script>
  <!-- Material Dashboard DEMO methods, don't include it in your project! -->
  <script src="../assets/demo/demo.js"></script>
    </div>
  </div>
</body>

</html>