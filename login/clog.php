
<?php
    include("connection.php");
    session_start();
    $errors = 0;
    $login = 1;
    $fullname="";
    $address="";
    $phone="";
    $email="";
    $password="";
    $city="";
    $area="";
    if (isset($_POST['button2'])) {
  // receive all input values from the form
  $fullname = mysqli_real_escape_string($conn, $_POST['name']);
  $address = mysqli_real_escape_string($conn, $_POST['address']);
  $phone = mysqli_real_escape_string($conn, $_POST['phoneno']);
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $password = mysqli_real_escape_string($conn, $_POST['password']);
  $city = mysqli_real_escape_string($conn, $_POST['city']);
  $area = mysqli_real_escape_string($conn, $_POST['area']);
  

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array

  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM customer WHERE custemail='$email' LIMIT 1";
  $result = mysqli_query($conn, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
    if ($user['email'] === $email) {
    //  array_push($errors, "email already exists");
      $errors = 1;
    }


  // Finally, register user if there are no errors in the form
  if ($errors == 0) {

    $query = "INSERT INTO customer (custemail,custname, password, address, phoneno, city, area) 
              VALUES('$email','$fullname','$password','$address','$phone','$city', '$area')";
//    mysqli_query($conn, $query);
    if($conn->query($query)=== true){
        echo "customer inserted";
    }
    else{
        $login = 0;
        echo "error:" .$conn->error;
    }
 

    if($login == 1){
    $_SESSION['login_user'] = $email;
    header('location: ../Foodieweb');
    }
  }
}

?>




<?php

if(isset($_POST["button1"]))
{
  $username = mysqli_real_escape_string($conn,$_POST['email']);
  $password = mysqli_real_escape_string($conn,$_POST['password']);

  $sql = "SELECT custid FROM customer WHERE custemail = '$username' and password = '$password'";
  $result = mysqli_query($conn,$sql);
  $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
  

  $count = mysqli_num_rows($result);

  if($result->num_rows == 1) {
  
    $_SESSION['login_user'] = $username;
   
   header("location: ../Foodieweb");
  }
  else {
    $error = "your userid or password is invalid";
    echo "$error";
  }
}
?>

<html>
<head>
	<title>SignUp and Login</title>
	<link rel="stylesheet" type="text/css" href="style.css">


</head>
<body>
    <div class="bubbels">
        <div class="bubble"></div>
        <div class="bubble"></div>
        <div class="bubble"></div>
        <div class="bubble"></div>
        <div class="bubble"></div>
        <div class="bubble"></div>
        <div class="bubble"></div>
        <div class="bubble"></div>
        <div class="bubble"></div>
        <div class="bubble"></div>
    </div>

    <div class="container" id="container">
        <div class="form-container sign-up-container">

            <form action="" method="post">
                <h1>Create Account</h1>

             
                <input type="text" name="name" placeholder="Name">
                <input type="email" name="email" placeholder="Email">
                <input type="password" name="password" placeholder="Password">
                <input type="text" name="phoneno" placeholder="phoneno">
                <input type="text" name="address" placeholder="Address">

                <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>

                <select id="city" style="min-width: 40%; min-height: 5%" name="city">
                    <option disabled selected>city</option>
                    <option value="goa">Goa</option>
                    <option value="pune">Pune</option>
                    <option value="mumbai">Mumbai</option>
                </select>


                <script type="text/javascript">
                $(document).ready(function(){
                    $("#city").change(function(){
                        var val = $(this).val();
                        if(val == "goa"){
                        $("#area").html("<option disabled selected>area</option><option value='mapusa'>Mapusa</option><option value='panjim'>Panjim</option><option value='madgaon'>Madgaon</option>");
                        }
                        else if(val == "pune"){
                        $("#area").html("<option disabled selected>area</option><option value='kothrud'>Kothrud</option><option value='nanded'>Nanded</option><option value='sinhagadrd'>Sinhagad Road</option>");
                        }
                        else if(val == "mumbai"){
                        $("#area").html("<option disabled selected>area</option><option value='bandra'>Bandra</option><option value='dadar'>Dadar</option><option value='dombivli'>Dombivli</option>");
                        }
                    });
                });
                </script>


                <br>
                <select id="area" style="min-width: 40%; min-height: 5%" name="area">
                    <option disabled selected>Area</option>
                </select>
                <br>
                <button name="button2">SignUp</button>
            </form>
        </div>
        <div class="form-container sign-in-container">
            <form action="" method="post">
                <h1>Customer Sign In</h1>

                <br>
                <br>
                <input type="email" name="email" placeholder="Email">
                <input type="password" name="password" placeholder="Password">
                <a href="forget.html">Forgot Your Password</a>

                <button name="button1">Sign In</button>
            </form>
        </div>
        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    <h1>Log In</h1>
                    <p>Please Enter Your Details </p>
                    <button class="ghost" id="signIn">Sign In</button>
                </div>
                <div class="overlay-panel overlay-right">
                    <h1>Hi To Create New Account Please</h1>
                    <p>Enter Your Details </p>
                    <button class="ghost" id="signUp">Sign Up</button>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        const signUpButton = document.getElementById('signUp');
        const signInButton = document.getElementById('signIn');
        const container = document.getElementById('container');

        signUpButton.addEventListener('click', () => {
            container.classList.add("right-panel-active");
        });
        signInButton.addEventListener('click', () => {
            container.classList.remove("right-panel-active");
        });
    </script>


</body>
</html>








