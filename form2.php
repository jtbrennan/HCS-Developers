<?php
// JSON file path
$jsonFile = 'data2.json';

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
$jobs = readData();

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        // Generate a unique ID for the article
    $id = uniqid();
    // Get the form data
    $title = $_POST['title'];
    $location = $_POST['location'];
    $payPerHour = $_POST['pay_per_hour'];
    $company = $_POST['company'];
    $companyLink = $_POST['company_link'];
    $submittedDate = date('Y-m-d'); // Get the current date

    // Create a new job entry
    $job = [
        'id' => $id,
        'title' => $title,
        'location' => $location,
        'pay_per_hour' => $payPerHour,
        'company' => $company,
        'company_link' => $companyLink,
        'submitted_date' => $submittedDate // Add the submitted date to the job
    ];

    // Add the new job to the jobs array
    $jobs[] = $job;

    // Write updated data to the JSON file
    writeData($jobs);

    // Redirect to the success page
    header('Location: form2.php');
    exit();
}
?>

<html>
<head>
    <title>HCS Developers - Post Job</title>
    <!-- Favicons -->
    <link href="assets/img/7562-200.png" rel="icon">
    <link href="assets/img/7562-200.png" rel="apple-touch-icon">
</head>
<body>
    <link href="https://fonts.googleapis.com/css?family=DM+Sans:400,500,700&display=swap" rel="stylesheet">

    <div class="header upcoming"></div>
    <h3>Post Job</h3>
    <div class="container">
        <div class="form-container">
            <form method="POST" action="form2.php">
                <label for="title">Title:</label>
                <input type="text" id="title" name="title" required>

                <label for="location">Location:</label>
                <input type="text" id="location" name="location" required>

                <label for="pay_per_hour">Pay per Hour:</label>
                <input type="text" id="pay_per_hour" name="pay_per_hour" required>

                <label for="company">Company:</label>
                <input type="text" id="company" name="company" required>

                <label for="company_link">Link to Company Site:</label>
                <input type="text" id="company_link" name="company_link" required>

                <button type="submit">Submit</button>
            </form>
        </div>
    </div>
</body>
</html>
