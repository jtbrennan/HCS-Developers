<?php
// JSON file path
$jsonFile = 'data3.json';

// Function to read data from the JSON file
function readData()
{
    global $jsonFile;
    $jsonData = file_get_contents($jsonFile);
    return json_decode($jsonData, true);
}

// Function to write data to the JSON file
function writeData($data)
{
    global $jsonFile;
    $jsonData = json_encode($data, JSON_PRETTY_PRINT);
    file_put_contents($jsonFile, $jsonData);
}

// Check if the JSON file exists, otherwise create an empty array
if (!file_exists($jsonFile)) {
    writeData([]);
}

// Read data from the JSON file
$events = readData();

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        // Generate a unique ID for the article
    $id = uniqid();
    // Get the form data
    $title = $_POST['title'];
    $date = $_POST['date'];
    $host = $_POST['host'];
    $description = $_POST['description'];
    $location = $_POST['location'];
    $link = $_POST['link'];

    // Create a new event entry
    $event = [
        'id' => $id,
        'title' => $title,
        'date' => $date,
        'host' => $host,
        'description' => $description,
        'location' => $location,
        'link' => $link
    ];

    // Add the new event to the events array
    $events[] = $event;

    // Write updated data to the JSON file
    writeData($events);

    // Redirect to the success page
    header('Location: form3.php');
    exit();
}
?>

<html>
<head>
    <title>HCS Developers - Post Event</title>
    <!-- Favicons -->
    <link href="assets/img/7562-200.png" rel="icon">
    <link href="assets/img/7562-200.png" rel="apple-touch-icon">
</head>
<body>
    <link href="https://fonts.googleapis.com/css?family=DM+Sans:400,500,700&display=swap" rel="stylesheet">

    <div class="header upcoming"></div>
    <h3>Post Event</h3>
    <div class="container">
        <div class="form-container">
            <form method="POST" action="form3.php">
                <label for="title">Title:</label>
                <input type="text" id="title" name="title" required>

                <label for="date">Date:</label>
                <input type="date" id="date" name="date" required>

                <label for="host">Host:</label>
                <input type="text" id="host" name="host" required>

                <label for="description">Description:</label>
                <textarea id="description" name="description" required></textarea>

                <label for="location">Location:</label>
                <input type="text" id="location" name="location" required>

                <label for="link">Link:</label>
                <input type="text" id="link" name="link" required>

                <button type="submit">Submit</button>
            </form>
        </div>
    </div>
</body>
</html>
