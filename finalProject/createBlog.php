<?php
require "../dbconnect.php";

session_start();

if (!isset($_SESSION["username"])) {
    header("Location: logon.html");
    exit;
}

if ($_POST["honeypot"] == "") {
    try {
        $author = $_SESSION["username"];
        $title = $_POST["blogTitle"];
        $content = $_POST["blogText"];
        $date = date("Y-m-d H:i:s");

        $stmt = $conn->prepare("INSERT INTO blog (blog_title, blog_author, blog_text, blog_date) VALUES (:title, :author, :content, :date)");

        $stmt->bindParam(':title', $title, PDO::PARAM_STR);
        $stmt->bindParam(':content', $content, PDO::PARAM_STR);
        $stmt->bindParam(':author', $author, PDO::PARAM_STR);
        $stmt->bindParam(':date', $date, PDO::PARAM_STR);

        $stmt->execute();

        $message = "Data successfully saved!";
        echo $message;

        header("Location: userDashboard.php");
        exit();
    } catch (PDOException $e) {
        $message = "Error: " . $e->getMessage();
        echo $message;

        header("Location: createBlog.html");
        echo "There was an issue saving your blog post, please try again.";
        exit();
    }
} else {
    header("Location: createBlog.html");
    echo "You are not authorized to view this page.";
    exit();
}