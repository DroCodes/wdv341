<?php
require '../dbconnect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && empty($_POST['honeypot'])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    try {
        $stmt = $conn->prepare("SELECT username, password FROM blog_users WHERE username = :username AND password = :password");

        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);

        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            session_start();
            $_SESSION["username"] = $row["username"];
            header("Location: index.php");
            exit;
        } else {
            header("Location: logon.html?error=1");
            exit;
        }
    } catch (PDOException $e) {
        $message = "Error: " . $e->getMessage();
        echo $message;
    }
}
?>
