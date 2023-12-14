<?php
require '../dbconnect.php';

$blogId = $_GET['id'];

if ($blogId) {
    try {
        $stmt = $conn->prepare("SELECT id, blog_title, blog_author, blog_date, blog_text FROM blog WHERE id = :id");

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

$blogTitle = $row['blog_title'];
$blogAuthor = $row['blog_author'];
$blogDate = $row['blog_date'];
$blogText = $row['blog_text'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Blog Entry</title>
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
                <a class="nav-link" href="index.php">Home</a>
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
    <?php
    ?>

    <h1 class="mb-4"><?php echo $blogTitle; ?></h1>

    <p class="text-muted">By <?php echo $blogAuthor; ?> | Published on <?php echo $blogDate; ?></p>

    <div class="mb-4">
        <?php echo nl2br($blogText); ?>
    </div>

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
