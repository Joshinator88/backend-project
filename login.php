<?php

session_start();


require_once "database.php";

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
    <ul>
    <li><a href="home.php">Home</a></li>
        <li><a href="login.php">Login</a></li>
        <li><a href="register.php">Register</a></li>
        <li><a href="search.php">Search</a></li>
        <li><a href="logout.php">Logout</a></li>
        <li><a href="requests.php">Requests</a></li>
    </ul>
</nav>

<div class="form">
<form method="POST">

<?php

if(isset($_POST["submit_login"])) {
    $sql = "SELECT * FROM users WHERE naam=? AND wachtwoord=?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$_POST["username"], $_POST["wachtwoord"]]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    
    if ($user !== false) {
        $_SESSION["loggedInUser"] = $user['ID'];
        header("location: home.php");
    } else {
        echo "<p style='color: red;'>de combinatie gebruikersnaam en wachtwoord zijn onjuist, probeer het nog eens</p>";
        die();
    }
}
if (isset($_POST["register"])) {
    header("location: register.php");
}

?>

        <label for="username">Username</label>
        <input type="text" name="username" id="username">
        
        <label for="wachtwoord">Password</label>
        <input type="password" name="wachtwoord" id="wachtwoord">
<div class="buttonContainer">
<input type="submit" name="submit_login" id="submit_login" value="Login">
<input type="submit" name="register" id="register" value="Register">
</div>
</form>



    
    

</body>
</html>