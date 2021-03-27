<?php
include("diliverystaff/includes/config.php");
?>  
<html>
<head>
	<title>delivery staff Login</title>
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
        <div class="form-container sign-in-container">
            <form action="diliverystaff/script.php" method="POST">
                <h1>Delivery Boy's  Sign In</h1>
                <br>
                <br>
                    <?php
                    if(isset($_SESSION["error"])){
                        $error = $_SESSION["error"];
                        echo "<span>$error</span>";
                    }
                ?>  
                <input type="email" name="email" placeholder="Email">
                <input type="password" name="password" placeholder="Password">
                <a href="forget.html">Forgot Your Password</a>
                <button type="submit" name="login">Sign In</button>

            </form>
        </div>
        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    <h1>Log In</h1>
                    <p>Please Enter Your Details </p>
                    <button  class="ghost" id="signIn">Sign In</button>
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