<?php
if ($_POST["honeypot"] == "") {
    $eventName = $_POST["eventName"];
    $eventDescription = $_POST["eventDescription"];
    $eventPresenter = $_POST["eventPresenter"];
    $eventDate = $_POST["eventDate"];
    $eventTime = $_POST["eventTime"];
    $eventDate = date("Y-m-d H:i:s");

    try {
        require "../dbconnect.php";

        $stmt = $conn->prepare("INSERT INTO wdv341_events (events_name, events_description, events_presenter, events_date, events_time, events_date_inserted, events_date_updated)
        VALUES (:eventName, :eventDescription, :eventPresenter, :eventDate, :eventTime, :eventDate, :eventDate)");

        $stmt->bindParam(':eventName', $eventName);
        $stmt->bindParam(':eventDescription', $eventDescription);
        $stmt->bindParam(':eventPresenter', $eventPresenter);
        $stmt->bindParam(':eventDate', $eventDate);
        $stmt->bindParam(':eventTime', $eventTime);

        $stmt->execute();

        $message = "Data successfully saved!";
        echo $message;
    } catch (PDOException $e) {
        $message = "Error: " . $e->getMessage();
        echo $message;
    }
}
else {
    header("Location: eventsForm.php");
    exit();
}
?>