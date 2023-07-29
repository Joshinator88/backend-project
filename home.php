<?php

session_start();
if (!isset($_SESSION["loggedInUser"])){
    header("location: login.php");
    die();
}

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
<nav>
    <div class="logo">
        <img src="logoSmall.png" alt="logo">
    </div>
    <!-- <img src="logo.png" alt="logo van chats"> -->
    <ul>
    <li><a href="home.php">Home</a></li>
        <li><a href="login.php">Login</a></li>
        <li><a href="register.php">Register</a></li>
        <li><a href="logout.php">Logout</a></li>
    </ul>
</nav>

<!-- berichten moeten hier worden laten zien -->

</body>
</html>