<?php

session_start();
if(isset($_SESSION['loggedInUser'])) {
        header("location: login.php");
        die();
}

try {
    $pdo = new PDO("mysql:host=localhost;dbname=chats", "bit_academy", "bit_academy");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "connection failed " . $e->getMessage();
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
    <ul>
    <li><a href="home.php">Home</a></li>
        <li><a href="login.php">Login</a></li>
        <li><a href="register.php">Register</a></li>
        <li><a href="search.php">Search</a></li>
        <li><a href="logout.php">Logout</a></li>
    </ul>
</nav>

<form class="row" method="GET">
    <?php
if (isset($_GET["search"])) {
    $searchQuery = "SELECT * FROM users WHERE naam=? OR email=?";
    $searchStmt = $pdo->prepare($searchQuery);
    $searchStmt->execute([$_GET["search"], $_GET["search"]]);
    $found = $searchStmt->fetch(PDO::FETCH_ASSOC);

    if ($found == false) {
        echo "<p style='color: red;'>de combinatie gebruikersnaam en wachtwoord zijn onjuist, probeer het nog eens</p>";
    }

    ?>
    <input type="text" name="search" id="search" placeholder="username or email">
    <input type="submit" name="zoek" id="zoek" value="search">
</form>

<?php

    if($found !== false) {
        ?>

<div class="foundUserDiv">
    <!-- display user en a possibility to add as a friend -->
</div>

        <?php
    }
}

?>
    
</body>
</html>