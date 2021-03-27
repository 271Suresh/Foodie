<?php
    include('connection.php');
    session_start();

  //  echo $_SESSION['login_user'];
    $email = $_SESSION['login_user'];

    $sql2 = "SELECT * FROM customer where custemail = '$email'";
    $result2 = mysqli_query($conn, $sql2);
    $row2 = mysqli_fetch_assoc($result2);
    $user = $row2['custid'];

    $sql = "select * from customer where custemail = '$email'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    $image = $row['photo'];
    $image_src = "upload/".$image;
?>

<html>
<head>
  <meta name="viewport" content="width=devive-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
  body{
    padding-top: 10%;
  }

.card {
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
  max-width: 300px;
  margin: auto;
  text-align: center;
}

.title {
  color: grey;
  font-size: 18px;
}

button {
  border: none;
  outline: 0;
  display: inline-block;
  padding: 8px;
  color: white;
  background-color: #000;
  text-align: center;
  cursor: pointer;
  width: 100%;
  font-size: 18px;
}

a {
  text-decoration: none;
  font-size: 22px;
  color: black;
}

button:hover, a:hover {
  opacity: 0.7;
}
</style>
</head
<body>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<div class="card">
<!--  <img height="300" width="200" src="img/2.jpg" alt="John" onerror=this.src="img/user.png" style="width:100%"> -->
<img width="300" onerror=this.src="user.png" src="<?php echo $image_src; ?>">

  <h1><?php echo $row['custname']; ?></h1>
  <p class="title"><?php echo $row['area']; ?></p>
  <p><?php echo $row['phoneno']; ?></p>
  <p>&nbsp;</p>
<!--  <a href="#"><i class="fa fa-dribbble"></i></a>
  <a href="#"><i class="fa fa-twitter"></i></a>
  <a href="#"><i class="fa fa-linkedin"></i></a>
  <a href="#"><i class="fa fa-facebook"></i></a>
  <p><button>Contact</button></p>-->
</div>
</body>
</html>