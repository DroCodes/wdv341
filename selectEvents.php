<?php
    require 'dbconnect.php';

try {
    $sql = "SELECT events_name,events_description, events_presenter, events_time, events_date FROM wdv341_events";

    $stmt = $conn->prepare($sql);

    $stmt->execute();

    $stmt->setFetchMode(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "table does not exist";
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        table {
            border: 2px solid black;
        }
    </style>
</head>
<body>
    <h1>WDV341 Intro PHP</h1>
    <h2>Unit-7 Select data from events table</h2>
    <h3>Events Table</h3>
    <table>
        <tr>
            <th>Event Name</th>
            <th>Event Description</th>
            <th>Event Presenter</th>
            <th>Event Time</th>
            <th>Event Date</th>
        </tr>
    <?php 
        while($row = $stmt->fetch() ){
            echo "<tr>";
                echo "<td>";
                    echo $row["events_name"];
                echo "</td>";
                echo "<td>";
                    echo $row["events_description"];
                echo "</td>";
                echo "<td>";
                    echo $row["events_presenter"];
                echo "</td>";
                echo "<td>";
                    echo $row["events_time"];
                echo "</td>";
                echo "<td>";
                    echo $row["events_date"];
                echo "</td>";
            echo "</tr>";
        }
    ?>
    </table>
</body>
</html>