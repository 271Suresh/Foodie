<?php
session_start();

unset($_SESSION["login_admin"]);
     header("Location: index.php");

?>