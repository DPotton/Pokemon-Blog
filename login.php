<?php
// Check if the login form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Include your database connection file (connect.php)
    require('connect.php');
    
    // Include your authentication file (authenticate.php)
    require('authenticate.php');

    // Get username and password from the form
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Validate the username and password (you can add more validation logic here)
    if (!empty($username) && !empty($password)) {
        // Check if the provided username and password match the admin credentials
        if ($username === ADMIN_LOGIN && password_verify($password, password_hash(ADMIN_PASSWORD, PASSWORD_DEFAULT))) {
            // Username and password are correct, set session variables
            $_SESSION['user_id'] = 1; // Set a dummy user_id for admin
            $_SESSION['username'] = $username;

            // Redirect to the home page
            header("Location: index.php");
            exit();
        } else {
            $error = "Invalid username or password.";
        }
    } else {
        $error = "Please enter both username and password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h1>Login</h1>
    <?php if (isset($error)): ?>
        <p><?php echo $error; ?></p>
    <?php endif; ?>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br><br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br>
        <button type="submit">Login</button>
    </form>
</body>
</html>
