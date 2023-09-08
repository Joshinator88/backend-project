<?php

try {
    $pdo = new PDO("mysql:host=localhost:3307;dbname=chats", "bit_academy", "bit_academy");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "connection failed " . $e->getMessage();
}