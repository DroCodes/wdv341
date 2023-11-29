<?php
if ($_POST["honeypot"] == "") {
    $eventName = $_POST["eventName"];
    $eventDescription = $_POST["eventDescription"];
    $eventPresenter = $_POST["eventPresenter"];
    $eventDate = $_POST["eventDate"];
    $eventTime = $_POST["eventTime"];

    try {
        require "../dbconnect.php";

        $stmt = $conn->prepare("INSERT INTO wdv341_events (events_name, events_description, events_presenter, events_date, events_time)
        VALUES (:eventName, :eventDescription, :eventPresenter, :eventDate, :eventTime)");

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
}  else {
    header("Location: selfPostingForm.html");
    exit();
}
?>