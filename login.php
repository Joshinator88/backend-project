<!DOCTYPE html>
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
        <li><a href="">Home</a></li>
        <li><a href="">Login</a></li>
        <li><a href="">Register</a></li>
    </ul>
</nav>

<div class="form">
<form method="POST">
        <label for="username">Username</label>
        <input type="text" name="username" id="username">
        
        <label for="wachtwoord">Password</label>
        <input type="password" name="wachtwoord" id="wachtwoord">
<div class="buttonContainer">
<input type="submit" name="submit_login" id="submit_login" value="Login">
<input type="submit" name="register" id="register" value="Register">
</div>
</form>

<?php

if (isset($_POST["register"])) {
    header("location: register.php");
}

?>

    
    

</body>
</html>