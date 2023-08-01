<?php

try {
    $pdo =  new PDO("mysql:host=localhost;dbname=chats", "bit_academy", "bit_academy");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed " . $e->getMessage();
}

?>

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
    <li><a href="home.php">Home</a></li>
        <li><a href="login.php">Login</a></li>
        <li><a href="register.php">Register</a></li>
    </ul>
</nav>


<div class="form">
<form method="post">
<?php
if (isset($_POST["register"])) {
    if ($_POST["username"] == "") {
        ?>
        <p style="color: red;">Please enter a username</p>
        <?php
    } else if ($_POST["email"] == "") {
        ?>
        <p style="color: red;">Please enter an email</p>
        <?php
    } else if ($_POST["wachtwoord"] == "") {
        ?>
        <p style="color: red;">Please enter a password</p>
        <?php
    } else {
        // everything is filed in and thanks to html we know the email is filled in correctly
        // now we have to check if the two passwords are the same 
        if($_POST["wachtwoord"] == $_POST["wachtwoordCheck"]) {
            // check if username exists...
            $usernameCheckQuery = "SELECT * FROM users WHERE naam=?";
            $usernameCheckStmt = $pdo->prepare($usernameCheckQuery);
            $usernameCheckStmt->execute([$_POST["username"]]);
            $userExists = $usernameCheckStmt->fetch(PDO::FETCH_ASSOC);
            if ($userExists !== false) {
                // we can register the new user to the database
                ?>
        <p style="color: red;">A user with this username already exists, to login press the login button</p>
        <?php
                // if the user already exists we throw this message
            } else {
                $sql = "INSERT users SET email=?, naam=?, wachtwoord=?";
                $stmt = $pdo->prepare($sql); 
                $stmt->execute([$_POST["email"], $_POST["username"], $_POST["wachtwoord"]]);
                
            }
        }
    }
} else if (isset($_POST["submit_login"])) {
    header("location: login.php");
}

?>
        <label for="username">Username</label>
        <input type="text" name="username" id="username">

        <label for="email">Email</label>
        <input type="email" name="email" id="email">
        <?php
        if(isset($_POST["register"])){
            if ($_POST["wachtwoord"] !== $_POST["wachtwoordCheck"]){
                ?>
                <p style="color: red;">Your passwords are not the same</p>
                <?php
                }                
        }
        ?>
        <label for="wachtwoord">Password</label>
        <input type="password" name="wachtwoord" id="wachtwoord">

        <label for="wachtwoordCheck">confirm password</label>
        <input type="password" name="wachtwoordCheck" id="wachtwoordCheck">
<div class="buttonContainer">
<input type="submit" name="submit_login" id="submit_login" value="Login">
<input type="submit" name="register" id="register" value="Register">
</form>


</body>
</html>