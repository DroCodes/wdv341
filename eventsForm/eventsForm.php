<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Event Form</title>
</head>
<body>

<form method="post" action="insertEvent.php">
<label for="eventName">Event Name:</label>
<input type="text" id="eventName" name="eventName" required><br>

<label for="eventDescription">Event Description:</label>
<textarea name="eventDescription" id="eventDescription" required></textarea><br>

<label for="eventPresenter">Event Presenter:</label>
<input type="text" id="eventPresenter" name="eventPresenter" required><br>

<label for="eventDate">Event Date:</label>
<input type="date" id="eventDate" name="eventDate" required><br>

<label for="eventTime">Event Time:</label>
<input type="time" id="eventTime" name="eventTime" required><br>

<div style="display: none;">
  <label for="honeypot">Leave this field blank:</label>
  <input type="text" id="honeypot" name="honeypot">
</div>

<input type="submit" value="Submit">
</form>

</body>
</html>
