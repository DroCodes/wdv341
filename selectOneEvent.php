<?php
    require 'dbconnect.php';
try {
    $sql = "SELECT events_name,events_description FROM wdv341_events WHERE events_id=:recId";
    $stmt = $conn->prepare($sql);

    $recID = 2;
    $stmt->bindParam(':recId', $recID);

    $stmt->execute();

    $stmt->setFetchMode(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo " Failed to get items from db" . $e->getMessage();
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .eventBox {
            border:thin solid black;
            margin-bottom:20px;
        }

        .boldEvent {
            font-weight:bold;
        }

    </style>
</head>
<body>
    <h1>WDV341 Intro PHP</h1>
    <h2>UNit-7 Select data from events table</h2>
    <h3>Event Names</h3>
    <?php
        while($row = $stmt->fetch() ){
            echo "<div class='eventBox'>";
                echo "<h3>";
                    echo $row["events_name"];
                echo "</h3>";
                    echo "<p><span class='boldEvent'>Event Description:</span> ";
                    echo $row["events_description"];
                echo "</p>";
            echo "</div>\n";
        }
    ?>
</body>
</html>