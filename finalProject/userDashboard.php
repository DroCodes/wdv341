<?php

session_start();


if (!isset($_SESSION['username'])) {
    header("Location: logon.html");
    exit();
}

$conn = null;
require '../dbconnect.php';

try {
    $username = $_SESSION['username'];
    $stmt = $conn->prepare("SELECT id, blog_title, blog_author, blog_date, blog_text FROM blog WHERE blog_author = :username ORDER BY blog_date DESC");

    $stmt->bindParam(':username', $username, PDO::PARAM_STR);

    $stmt->execute();

    $stmt->setFetchMode(PDO::FETCH_ASSOC);

    $rows = $stmt->fetchAll();

    $blogEntries = "";
} catch (PDOException $e) {
    $message = "Error: " . $e->getMessage();
    echo $message;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Blog Dashboard</title>
</head>

<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">Blog HQ</a>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
                <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="userDashboard.php">User Dashboard</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="logout.php">Logout</a>
            </li>
        </ul>
    </div>
</nav>

<div class="container mt-5">
    <div class="d-flex justify-content-between">
        <div>
            <h1>Blog Dashboard</h1>
        </div>
        <div>
            <a href="createBlog.html" class="btn btn-primary">New Blog</a>
        </div>
    </div>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">Title</th>
            <th scope="col">Author</th>
            <th scope="col">Date</th>
            <th scope="col">Preview</th>
            <th scope="col"></th>
            <th scope="col"></th>

        </tr>
        </thead>
        <tbody>
        <?php
        foreach ($rows as $row) {
            echo "<tr>";
            echo "<td>" . $row["blog_title"] . "</td>";
            echo "<td>" . $row["blog_author"] . "</td>";
            echo "<td>" . $row["blog_date"] . "</td>";
            echo "<td><a class='btn btn-primary' href='blogEntry.php?id=" . $row["id"] . "'>View</a> <a class='btn btn-success' href='editBlog.php?id=" . $row["id"] . "'>Edit</a> <a class='btn btn-danger' href='deleteBlog.php?id=" . $row["id"] . "'>Delete</a></td>";
//            echo "<td><a class='btn btn-success' href='editBlog.php?id=" . $row["id"] . "'>Edit</a></td>";
//            echo "<td><a class='btn btn-danger' href='deleteBlog.php?id=" . $row["id"] . "'>Delete</a></td>";
            echo "</tr>";
        }
        ?>
        </tbody>
    </table>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UJ/Apk6r8nO1z91F8KA9QtiP8eWao8/J8cZf5fw3JqbBRWpNOhx2w9sYpH2bQvJ7"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
</body>

</html>
