<?php

require "../dbconnect.php";

$username = $_POST["username"];
$password = $_POST["password"];

try {
    $stmt = $conn->prepare("SELECT event_user_name, event_user_password FROM event_user WHERE event_user_name = :username AND event_user_password = :password");

    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $password);

    $stmt->execute();

    $stmt->setFetchMode(PDO::FETCH_ASSOC);

    $row = $stmt->fetch();

    if ($row && $row["event_user_name"] == $username && $row["event_user_password"] == $password) {
        session_start();
        $_SESSION["validUser"] = $username;
        header("Location: eventsForm.php");
        exit; // Add exit to ensure no further code is executed after redirection
    }
    else {
        header("Location: logon.php");
        exit; // Add exit to ensure no further code is executed after redirection
    }
} catch (PDOException $e) {
    $message = "Error: " . $e->getMessage();
    echo $message;
}

