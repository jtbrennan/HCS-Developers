<?php
// JSON file path
$jsonFile = 'data.json';

// Function to read data from the JSON file
function readData() {
    global $jsonFile;
    $jsonData = file_get_contents($jsonFile);
    return json_decode($jsonData, true);
}

// Function to write data to the JSON file
function writeData($data) {
    global $jsonFile;
    $jsonData = json_encode($data, JSON_PRETTY_PRINT);
    file_put_contents($jsonFile, $jsonData);
}

// Check if the JSON file exists, otherwise create an empty array
if (!file_exists($jsonFile)) {
    writeData([]);
}

// Read data from the JSON file
$articles = readData();

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the form data
    $title = $_POST['title'];
    $content = $_POST['content'];
    $author = $_POST['author'];
    $datePublished = date('Y-m-d');

    // Generate a unique ID for the article
    $id = uniqid();

    // Create a new article entry
    $article = [
        'id' => $id,
        'title' => $title,
        'content' => $content,
        'published' => 'Pending Approval',
        'author' => $author,
        'date_published' => $datePublished
    ];

    // Add the new article to the articles array
    $articles[] = $article;

    // Write updated data to the JSON file
    writeData($articles);

    // Redirect to the success page
    header('Location: form.php');
    exit();
}
?>



    <html>
  <head>
    <title>HCS Developers</title>
      <!-- Favicons -->
  <link href="assets/img/7562-200.png" rel="icon">
  <link href="assets/img/7562-200.png" rel="apple-touch-icon">
  </head>
  <body>

    <link href="https://fonts.googleapis.com/css?family=DM+Sans:400,500,700&display=swap" rel="stylesheet">

      <div class="header upcoming"></div><h3>Post Article</h3>
      <div class="container">
        <div class="form-container">
          <form method="POST" action="form.php">
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" required>
      
            <label for="content">Content:</label>
            <textarea id="content" name="content" required></textarea>
      
            <label for="author">Author:</label>
            <input type="text" id="author" name="author" required>
      
            <!-- <label for="published">
              <input type="checkbox" id="published" name="published">
              Published
            </label> -->
      
            <input type="hidden" id="date_published" name="date_published" value="<?php echo date('Y-m-d'); ?>">
      
            <button type="submit">Submit</button>
          </form>
        </div>
      </div>


  </body>
          
</html>