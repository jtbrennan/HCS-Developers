<?php

// Function to write data to JSON file
function writeDataToJson($filename, $data)
{
    $jsonData = json_encode($data, JSON_PRETTY_PRINT);
    file_put_contents($filename, $jsonData);
}

// Connect to the articles database
$articleHost = 'sql311.infinityfree.com';
$articleDbname = 'if0_34461762_articles';
$articleUser = 'if0_34461762';
$articlePassword = 'gRXuUkXhV56jpU9';

$articleConnection = new PDO("mysql:host=$articleHost;dbname=$articleDbname", $articleUser, $articlePassword);

// Get the form data for articles
$articleTitle = $_POST['articleTitle'];
$articleContent = $_POST['articleContent'];
$articleAuthor = $_POST['articleAuthor'];
$articleDatePublished = date('Y-m-d');

// Insert data into articles database
$articleQuery = "INSERT INTO articles (title, content, author, datePublished) VALUES (?, ?, ?, ?)";
$articleStatement = $articleConnection->prepare($articleQuery);
$articleStatement->execute([$articleTitle, $articleContent, $articleAuthor, $articleDatePublished]);

// Fetch all articles data
$articleSelectQuery = "SELECT * FROM articles";
$articleSelectStatement = $articleConnection->prepare($articleSelectQuery);
$articleSelectStatement->execute();
$articlesData = $articleSelectStatement->fetchAll(PDO::FETCH_ASSOC);

// Write articles data to JSON file
writeDataToJson('data.json', $articlesData);


// Connect to the jobs database
$jobsHost = 'sql311.infinityfree.com';
$jobsDbname = 'if0_34461762_jobs';
$jobsUser = 'if0_34461762';
$jobsPassword = 'gRXuUkXhV56jpU9';

$jobsConnection = new PDO("mysql:host=$jobsHost;dbname=$jobsDbname", $jobsUser, $jobsPassword);

// Get the form data for jobs
$jobTitle = $_POST['jobTitle'];
$jobLocation = $_POST['jobLocation'];
$jobPayPerHour = $_POST['pay_per_hour'];
$jobCompany = $_POST['company'];
$jobCompanyLink = $_POST['company_link'];
$jobSubmittedDate = date('Y-m-d');

// Insert data into jobs database
$jobQuery = "INSERT INTO jobs (title, location, payPerHour, company, companyLink, submittedDate) VALUES (?, ?, ?, ?, ?, ?)";
$jobStatement = $jobsConnection->prepare($jobQuery);
$jobStatement->execute([$jobTitle, $jobLocation, $jobPayPerHour, $jobCompany, $jobCompanyLink, $jobSubmittedDate]);

// Fetch all jobs data
$jobSelectQuery = "SELECT * FROM jobs";
$jobSelectStatement = $jobsConnection->prepare($jobSelectQuery);
$jobSelectStatement->execute();
$jobsData = $jobSelectStatement->fetchAll(PDO::FETCH_ASSOC);

// Write jobs data to JSON file
writeDataToJson('data2.json', $jobsData);


// Connect to the events database
$eventsHost = 'sql311.infinityfree.com';
$eventsDbname = 'if0_34461762_events';
$eventsUser = 'if0_34461762';
$eventsPassword = 'gRXuUkXhV56jpU9';

$eventsConnection = new PDO("mysql:host=$eventsHost;dbname=$eventsDbname", $eventsUser, $eventsPassword);

// Get the form data for events
$eventId = uniqid();
$eventTitle = $_POST['title'];
$eventDate = $_POST['date'];
$eventHost = $_POST['host'];
$eventDescription = $_POST['description'];
$eventLocation = $_POST['location'];
$eventLink = $_POST['link'];

// Insert data into events database
$eventQuery = "INSERT INTO events (id, title, date, host, description, location, link) VALUES (?, ?, ?, ?, ?, ?, ?)";
$eventStatement = $eventsConnection->prepare($eventQuery);
$eventStatement->execute([$eventId, $eventTitle, $eventDate, $eventHost, $eventDescription, $eventLocation, $eventLink]);

// Fetch all events data
$eventSelectQuery = "SELECT * FROM events";
$eventSelectStatement = $eventsConnection->prepare($eventSelectQuery);
$eventSelectStatement->execute();
$eventsData = $eventSelectStatement->fetchAll(PDO::FETCH_ASSOC);

// Write events data to JSON file
writeDataToJson('data3.json', $eventsData);

?>
