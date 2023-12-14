<?php

require '../dbconnect.php';

$blogId = $_GET['id'];

    try {

        $stmt = $conn->prepare("SELECT id, blog_title, blog_author, blog_date, blog_text FROM blog WHERE id = :id");

        $stmt->bindParam(':id', $blogId);

        $stmt->execute();

        $stmt->setFetchMode(PDO::FETCH_ASSOC);

        $row = $stmt->fetch();

        $blogTitle = $row['blog_title'];
        $blogText = $row['blog_text'];
    } catch (PDOException $e) {
        $message = "Error: " . $e->getMessage();
        echo $message;
    }

function editBlog()
{
    global $conn, $blogId, $blogTitle, $blogText;
    $blogTitle = $_POST['blog_title'];
    $blogText = $_POST['blog_text'];

    if (empty($blogTitle) || empty($blogText)) {
        echo "<h1>Blog Title and Blog Text are required</h1>";
        echo "<a href='editBlog.php?id=$blogId'>Go Back</a>";
        exit();
    }

   if ($_POST['honeypot'] == "") {
       try {
           $stmt = $conn->prepare("UPDATE blog SET blog_title = :blog_title, blog_text = :blog_text WHERE id = :id");

           $stmt->bindParam(':blog_title', $blogTitle);
           $stmt->bindParam(':blog_text', $blogText);
           $stmt->bindParam(':id', $blogId);

           $stmt->execute();

           $stmt->setFetchMode(PDO::FETCH_ASSOC);

           header("Location: userDashboard.php");
           exit();
       } catch (PDOException $e) {
           $message = "Error: " . $e->getMessage();
           echo $message;
       }
   }
}

if (isset($_POST['submitForm'])) {
    editBlog();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Blog Entry</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
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
    <h1>Edit Blog Entry</h1>

    <form method="post">
        <div class="form-group">
            <label for="blog_title">Blog Title</label>
            <input type="text" class="form-control" name="blog_title" id="blog_title" value="<?php echo $blogTitle; ?>">
        </div>

        <div class="form-group">
            <label for="blog_text">Blog Text</label>
            <textarea class="form-control" name="blog_text" id="blog_text" cols="30" rows="10"><?php echo $blogText; ?></textarea>
        </div>

        <input type="hidden" name="honeypot" id="honeypot" value="">

        <button type="submit" name="submitForm" class="btn btn-primary">Submit</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>

</html>
