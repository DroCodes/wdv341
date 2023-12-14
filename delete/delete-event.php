<?php

require "../dbconnect.php";
$id = $_GET["id"];

try {
    $sql = "DELETE FROM wdv341_events WHERE events_id = :event_id";

    $stmt = $conn->prepare($sql);

    $stmt->bindParam(":event_id", $id);

    $stmt->execute();

    if($stmt->rowCount() == 1){
    header("Location: eventsList.php");
        echo "Event deleted successfully";
    } else {
        echo "Event not deleted";
        echo $id;
        exit();
    }
} catch (PDOException $e) {
    $message = 'Error ' . $e->getMessage();
    echo $message;
}

//exit();