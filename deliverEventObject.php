<?php
require 'dbconnect.php';
try {
    $sql = "SELECT * FROM wdv341_events WHERE events_id=:recId";
    $stmt = $conn->prepare($sql);

    $recID = 1;
    $stmt->bindParam(':recId', $recID);

    $stmt->execute();

    $stmt->setFetchMode(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo " Failed to get items from db" . $e->getMessage();
}
class Event {
    public $eventsId;
    public $eventsName;
    public $eventsPresenter;
    public $eventsDescription;

    public $eventsDate;
    public $eventsTime;

    function __construct($event_id, $event_name, $events_presenter, $events_description, $events_date, $events_time) {
        $this->eventsId = $event_id;
        $this->eventsName = $event_name;
        $this->eventsPresenter = $events_presenter;
        $this->eventsDescription = $events_description;
        $this->eventsDate = $events_date;
        $this->eventsTime = $events_time;
    }


}
$row = $stmt->fetch();
$outputObj = new Event($row["events_id"], $row["events_name"], $row["events_presenter"], $row["events_description"], $row["events_date"], $row["events_time"] );

// Encode the $outputObj into a JSON object
$jsonOutput = json_encode($outputObj);

echo $jsonOutput;

?>