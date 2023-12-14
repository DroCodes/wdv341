<?php
require '../dbconnect.php';
$blogId = $_GET['id'];

if ($blogId) {
    try {
        $stmt = $conn->prepare("DELETE FROM blog WHERE id = :id");

        $stmt->bindParam(':id', $blogId);

        $stmt->execute();

        $stmt->setFetchMode(PDO::FETCH_ASSOC);

        $row = $stmt->fetch();
    } catch (PDOException $e) {
        $message = "Error: " . $e->getMessage();
        echo $message;
    }
} else {
    echo "<h1>Blog Entry Not Found</h1>";
}

header("Location: userDashboard.php");
exit();
