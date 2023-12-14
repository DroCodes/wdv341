<?php

if ($_POST["honeypot"] == "") {
    try {
        require "../dbconnect.php";

        $user = $_POST["username"];
        $pass= $_POST["password"];

        $user = isset($_POST['username']) ? $_POST['username'] : '';
        $pass = isset($_POST['password']) ? $_POST['password'] : '';

        if (empty($user)) {
            $message = "Username cannot be empty!";
            header("Location: register.html");
            echo $message;
            exit();
        }

        $user = $_POST['username'];
        $pass = $_POST['password'];

        // Check if the username already exists
        $stmt = $conn->prepare("SELECT username FROM blog_users WHERE username = :username");
        $stmt->bindParam(':username', $user, PDO::PARAM_STR);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            $message = "Username already exists!";
            echo $message;
            header("Location: register.php");
            exit();
        }

        $stmt = $conn->prepare("INSERT INTO blog_users (username, password) VALUES (:username, :password)");
        $stmt->bindParam(':username', $user, PDO::PARAM_STR);
        $stmt->bindParam(':password', $pass, PDO::PARAM_STR);

        $stmt->execute();

        $message = "Data successfully saved!";
        echo $message;

        header("Location: logon.html");
        exit();
    } catch (PDOException $e) {
        $message = "Error: " . $e->getMessage();
        echo $message;
    }

}
