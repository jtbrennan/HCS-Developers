<?php
session_start();

// Check if the user is not logged in
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

$articles = [];

// Read the data from the JSON file
$data = file_get_contents('data.json');
if ($data !== false) {
    $articles = json_decode($data, true);
}

// Check if the delete form is submitted
if (isset($_POST['delete'])) {
    // Get the IDs of the articles to delete
    $articleIds = isset($_POST['article']) ? $_POST['article'] : [];

    if (!empty($articleIds)) {
        // Filter the articles array to exclude the selected articles
        $articles = array_filter($articles, function ($article) use ($articleIds) {
            return !in_array($article['id'], $articleIds);
        });

        // Save the updated data back to the JSON file
        $jsonData = json_encode($articles, JSON_PRETTY_PRINT);
        file_put_contents('data.json', $jsonData);

        // Redirect to the same page to avoid resubmission of the form
        header("Location: admin.php");
        exit();
    }
}

// Search query
$search = isset($_GET['search']) ? $_GET['search'] : '';

// Filter the articles based on the search query
if (!empty($search)) {
    $articles = array_filter($articles, function ($article) use ($search) {
        return strpos($article['title'], $search) !== false;
    });
}

// Logout functionality
if (isset($_GET['logout'])) {
    // Destroy the session
    session_destroy();

    // Redirect to the login page
    header('Location: login.php');
    exit();
}
?>

<html>
<head>
    <title>Admin Panel</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <!-- Favicons -->
    <link href="assets/img/7562-200.png" rel="icon">
    <link href="assets/img/7562-200.png" rel="apple-touch-icon">
</head>
<style>
    body {
        padding-top: 80px;
        font-family: 'DM Sans', sans-serif;
    }

    #sidebar {
        position: fixed;
        top: 50px;
        left: 220px;
        width: 220px;
        margin-left: -220px;
        border: none;
        border-radius: 0;
        overflow-y: auto;
        background-color: #222;
        bottom: 0;
        overflow-x: hidden;
        padding-bottom: 40px;
    }

    .side-bar > li > a {
        color: #eee;
        width: 220px;
    }

    .side-bar li a:hover,
    .side-bar li a:focus {
        background-color: #333;
    }

    .tmargin {
        margin-top: 15px;
    }

    .search-bar {
        display: flex;
    }

    .search-input {
        flex: 1;
    }

    .search-button {
        margin-left: 10px;
    }
</style>

<body>
<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="admin.php">
                <img src="assets/img/logo-no-background.svg" alt="Healthcare Tech Logo"
                     style="max-height: 30px; display: inline-block; margin-left: -120px;">
                <span style="vertical-align: middle; margin-left: 5px;"> - Admin Panel</span>
            </a>
        </div>
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="#"><span class="glyphicon glyphicon-user">&nbsp;</span>Hello Admin</a></li>
                <li class="active"><a title="View Website" href="index.php"><span
                            class="glyphicon glyphicon-globe"></span></a></li>
                    <li><a href="admin.php?logout=1">Logout</a></li>
            </ul>
        </div>
    </div>
</nav>
<div class="container-fluid">
    <div class="col-md-3">
        <div id="sidebar">
            <div class="container-fluid tmargin">
                <form action="" method="GET" class="search-bar">
                    <input type="text" class="form-control search-input" name="search" placeholder="Search..."/>
                    <button type="submit" class="btn btn-default search-button"><span
                            class="glyphicon glyphicon-search"></span></button>
                </form>
            </div>
            <ul class="nav navbar-nav side-bar">
                <li class="side-bar tmargin"><a href="admin.php"><span
                            class="glyphicon glyphicon-envelope">&nbsp;</span>News Dashboard</a></li>
                            <li class="side-bar"><a href="admin2.php"><span class="glyphicon glyphicon-briefcase">&nbsp;</span>Jobs Dashboard</a>
                </li>
                <li class="side-bar"><a href="admin3.php"><span class="glyphicon glyphicon-calendar">&nbsp;</span>Events Dashboard</a>
                </li>
                <li class="side-bar"><a href="#"><span class="glyphicon glyphicon-signal">&nbsp;</span>Statistics</a>
                </li>
            </ul>
        </div>
    </div>
    <div class="col-md-9">
        <h1 class="page-header">News Dashboard</h1>
        <ul class="breadcrumb">
            <li><span class="glyphicon glyphicon-home">&nbsp;</span>Home</li>
            <li><a href="#">Dashboard</a></li>
        </ul>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" id="deleteForm">
            <table class="table table-hover">
                <thead>
                <th>&nbsp;</th>
                <th class="text-center"># ID</th>
                <th>Title</th>
                <th class="text-center">Author</th>
                <th class="text-center">Date Published</th>
                <th>Status</th>
                </thead>
                <tbody>
                <?php foreach ($articles as $article): ?>
                    <tr>
                        <td><input type="checkbox" name="article[]" value="<?php echo $article['id']; ?>"/></td>
                        <td class="text-center article-id"><?php echo $article['id']; ?></td>
                        <td width="60%">
                            <a href="#" class="content-link" data-toggle="modal"
                               data-target="#contentModal_<?php echo $article['id']; ?>">
                                <?php echo $article['title']; ?>
                            </a>
                            <!-- Content Modal -->
                            <div class="modal" id="contentModal_<?php echo $article['id']; ?>" tabindex="-1"
                                 role="dialog" aria-labelledby="contentModalLabel_<?php echo $article['id']; ?>">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            <h4 class="modal-title"
                                                id="contentModalLabel_<?php echo $article['id']; ?>"><?php echo $article['title']; ?></h4>
                                        </div>
                                        <div class="modal-body">
                                            <?php echo $article['content']; ?>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="text-center" width="10%"><?php echo $article['author']; ?></td>
                        <td class="text-center" width="15%"><?php echo $article['date_published']; ?></td>
                        <td width="10%"><?php echo $article['published']; ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
            <div class="text-center">
                <button type="submit" class="btn btn-danger" name="delete"><span
                            class="glyphicon glyphicon-trash">&nbsp;</span>Delete Selected
                </button>
            </div>
        </form>
    </div>
</div>
<script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script>
    $(document).ready(function () {
        // Check all checkboxes when the "Select All" checkbox is clicked
        $('#selectAll').click(function () {
            $('input[type="checkbox"]').prop('checked', this.checked);
        });

        // Submit the form when any checkbox is clicked
        $('input[type="checkbox"]').click(function () {
            if ($('input[type="checkbox"]:checked').length > 0) {
                $('#deleteForm').attr('action', '<?php echo $_SERVER['PHP_SELF']; ?>');
            } else {
                $('#deleteForm').attr('action', '');
            }
        });
    });
</script>
</body>
</html>
