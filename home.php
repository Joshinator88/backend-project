<?php

session_start();
if (!isset($_SESSION["loggedInUser"])){
    header("location: login.php");
    die();
}

require_once "database.php";


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
    <ul>
    <li><a href="home.php">Home</a></li>
        <li><a href="login.php">Login</a></li>
        <li><a href="register.php">Register</a></li>
        <li><a href="search.php">Search</a></li>
        <li><a href="logout.php">Logout</a></li>
        <li><a href="requests.php">Requests</a></li>
    </ul>
</nav>

<!-- berichten moeten hier worden laten zien -->
<div class="row">

<div class="contactContainer">
    <ul>
    <?php
$userID = $_SESSION["loggedInUser"];



$friendsOne = $pdo->query("SELECT * FROM vrienden WHERE vriendOneID=$userID");
$friendsTwo = $pdo->query("SELECT * FROM vrienden WHERE vriendTwoID=$userID");

$contactsRaw = [];
if ($friendsOne !== false) {
    foreach ($friendsOne as $friend) {
        array_push($contactsRaw, $friend["vriendTwoID"]);
    }
}

if ($friendsTwo !== false) {
    foreach ($friendsTwo as $friend) {
        array_push($contactsRaw, $friend["vriendOneID"]);
    }
}


// this array contains all users who had messaging contact with the user
$contactsID = array_unique($contactsRaw);

// we get the contact name by looping over every unique item in the contacts array,
foreach ($contactsID as $contactID) {

    //  create a li for every contact so that it gets shown in te contacts container
    
    $usersql = "SELECT * FROM users WHERE ID=?";
    $userstmt = $pdo->prepare($usersql);
    $userstmt->execute([$contactID]);
    $user =  $userstmt->fetch(PDO::FETCH_ASSOC);
    $username = $user['naam'];
    echo "<li><a class='contactNames' href='home.php?contactDestination=$username'>$username</a></li>";
}


?>
    </ul>
</div>

<!-- new div for chatting simple edition -->

<div class="chatContainer">
    <!-- Show all previous msgs with the selected user -->
<?php

if (isset($_GET["contactDestination"])) {
    $getContactIDQuery = "SELECT ID FROM users WHERE naam =?";
    $getContactIDStmt = $pdo->prepare($getContactIDQuery);
    $getContactIDStmt->execute([$_GET["contactDestination"]]);
    $selectedContact = $getContactIDStmt->fetch(PDO::FETCH_ASSOC);
    $contactID = $selectedContact['ID'];


// adding message to db
if (isset($_POST['submit'])) {

    $insertMsgQuery = "INSERT berichten SET bericht=?, verzenderID=?, ontvangerID=?";
    $insertMsgStmt = $pdo->prepare($insertMsgQuery);
    $insertMsgStmt->execute([$_POST['msg'], $userID, $contactID]);
}

    // get all messages from the selected contact and loggedIn user and store them in an array
    $getGesprekQuery = "SELECT * FROM berichten WHERE verzenderID=? OR ontvangerID=?";
    $getGesprekStmt = $pdo->prepare($getGesprekQuery);
    $getGesprekStmt->execute([$userID, $userID]);
    $gesprekObjects = $getGesprekStmt->fetchAll(PDO::FETCH_ASSOC);

    // var_dump($gesprekObjects);

    if ($gesprekObjects !== false){
        foreach($gesprekObjects as $gesprekObject) {
            // echo $gesprekObject['bericht'];
            if ($gesprekObject["ontvangerID"] == $contactID && $gesprekObject["verzenderID"] == $userID) {
                    $bericht = $gesprekObject['bericht'];
                    echo "<div class='send'>$bericht</div>";
            } else if ($gesprekObject["verzenderID"] == $contactID && $gesprekObject["ontvangerID"] == $userID) {
                $bericht = $gesprekObject['bericht'];
                    echo "<div class='recieved'>$bericht</div>";
            }
        }
    }

    

    
    ?>
    <form class='chatInput' method='POST'>
    <input type='text' name='msg' id='msg' >
    <input type='submit' name='submit' id='submit' value='send'>
    </form>
</div>
<?php
}
?>
</div>




</body>
</html>