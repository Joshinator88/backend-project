<?php

session_start();
if(!isset($_SESSION['loggedInUser'])) {
        header("location: login.php");
        die();
}

require_once "database.php";

if(isset($_GET['add']) && $_GET['add'] !== $_SESSION['loggedInUser']) {
    $askOfFriendshipQuery = "INSERT friendRequests SET requestorID=?, recieverID=?";
    $askOfFriendshipStmt = $pdo->prepare($askOfFriendshipQuery); 
    $askOfFriendshipStmt->execute([$_SESSION["loggedInUser"], $_GET['add']]);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="style.css" media="screen" rel="stylesheet" type="text/css" />
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

<form class="row" method="GET">
    <?php
if (isset($_GET["search"])) {
    $searchQuery = "SELECT * FROM users WHERE naam=? OR email=?";
    $searchStmt = $pdo->prepare($searchQuery);
    $searchStmt->execute([$_GET["search"], $_GET["search"]]);
    $found = $searchStmt->fetch(PDO::FETCH_ASSOC);

    if ($found == false || $found['ID'] == $_SESSION["loggedInUser"]) {
        echo "<p style='color: red;'>er bestaat geen gebruiker met deze gebruikersnaam</p>";
}
}

    ?>
    <input type="text" name="search" id="search" placeholder="username or email">
    <input type="submit" name="zoek" id="zoek" value="search">
</form>

<?php

if (isset($_GET["search"])) {

    if($found !== false) {
        ?>

<div class="foundFriend">
    <!-- display user en a possibility to add as a friend -->
    <?php 
    
    $naam = $found['naam'];
    $id = $found['ID'];

    echo "<p>$naam</p>
    <ul>
    <li><a href='search.php?add=$id'>Add</a></li>
    </ul>";
    
    ?>
</div>

        <?php
    }
}
?>
    
</body>
</html>