<?PHP

session_start();
if (!isset($_SESSION["loggedInUser"])){
    header("location: login.php");
    die();
}

require_once "database.php";


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

    
    <div class="requestsRecieved">
        <!-- select all sender ids where reciever is userid and then select their names and put them in the unordered list -->
                <?php

                    $getSenderIDQuery = "SELECT requestorID FROM friendRequests WHERE recieverID=?";
                    $getSenderIDStmt = $pdo->prepare($getSenderIDQuery);
                    $getSenderIDStmt->execute([$_SESSION['loggedInUser']]);
                    $allRequestsRecieved = $getSenderIDStmt->fetchAll(PDO::FETCH_ASSOC);

                    if($allRequestsRecieved == false) {
                        echo "No requests recieved";
                    } else {
                        foreach ($allRequestsRecieved as $request) {
                            $getSenderNameQuery = "SELECT naam FROM users WHERE ID=?";
                            $getSenderNameStmt = $pdo->prepare($getSenderNameQuery);
                            $getSenderNameStmt->execute([$request['requestorID']]);
                            $SenderName =  $getSenderNameStmt->fetch(PDO::FETCH_ASSOC);

                            $naam = $SenderName["naam"];

                            if(isset($_POST[$naam])) {
                                $becameFriendsQuery = "INSERT vrienden SET vriendOneID=?, vriendTwoID=?";
                                $becameFriendsStmt = $pdo->prepare($becameFriendsQuery);
                                $becameFriendsStmt->execute([$request['requestorID'], $_SESSION['loggedInUser']]);
                                $deleteFriendRequestSQL = "DELETE FROM friendRequests WHERE recieverID=? AND requestorID=?";
                                $deleteFriendRequestStmt = $pdo->prepare($deleteFriendRequestSQL);
                                $deleteFriendRequestStmt->execute([$_SESSION['loggedInUser'], $request['requestorID']]);
                            }
                            
                            ?>
                            
                            <form method="post">
                                <label for="acceptBtn"><?php echo "$naam" ?></label>
                                <input type="submit" <?php echo "name='$naam' id='$naam'"; ?> value="accept">
                            </form>
                            
                            <?php

                            
                        }
                    }
                
                ?>
    </div>

    <div class="requestsSend">

    </div>

</body>
</html>