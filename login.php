<?php
session_start();

// Check if the user is already logged in, redirect to the dashboard
if (isset($_SESSION['username'])) {
    header("Location: admin.php");
    exit();
}

// Check if the login form is submitted
if (isset($_POST['login'])) {
    // Validate the login credentials
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check the credentials against a database or any other authentication method
    // For demonstration purposes, let's assume the correct username is "admin" and the password is "password"
    if ($username === '' && $password === '') {
        // Store the username in the session
        $_SESSION['username'] = $username;

        // Redirect to the dashboard
        header("Location: admin.php");
        exit();
    } else {
        // Invalid credentials
        $error = "Invalid username or password";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link href="assets/img/7562-200.png" rel="icon">
    <link href="assets/img/7562-200.png" rel="apple-touch-icon">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-image: url("path-to-your-pattern-image.jpg");
            background-repeat: repeat;
        }

        .container {
            max-width: 400px;
            padding: 20px;
            text-align: center;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #fff;
        }

        .container h1 {
            color: #18d26e;
        }

        .container .alert {
            margin-top: 20px;
        }

        .login-btn {
            font-family: "Montserrat", sans-serif;
            text-transform: uppercase;
            font-weight: 500;
            font-size: 14px;
            letter-spacing: 1px;
            display: inline-block;
            padding: 4px 15px;
            border-radius: 10px;
            transition: 0.5s;
            margin-top: 10px;
            border: 2px solid #18d26e;
            color: #18d26e;
            background: none;
            cursor: pointer;
        }

        .login-btn:hover {
            background: #fff;
            color: #18d26e;
            border: 2px solid #fff;
        }
    </style>
</head>
<body>
<div class="container">
    <!-- <h1>Login</h1> -->
    <?php if (isset($error)): ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
    <?php endif; ?>
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" class="form-control" id="username" name="username" required>
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <button type="submit" class="login-btn" name="login">Login</button>
    </form>
    <br>
    <p>Redirecting to the <a href="index.php" style="color: #18d26e;">home page</a> ...</p>
</div>
<script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script>
    setTimeout(function () {
        window.location.href = "index.php";
    }, 30000); // Redirect to the home page after 30 seconds
</script>
</body>
</html>
