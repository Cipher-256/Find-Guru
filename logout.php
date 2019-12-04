<?php 
session_start();


// unset($_SESSION['password']);
//header('location::login.php')
session_unset();
if(session_destroy())
{
header("Location: login.php");
}


?>