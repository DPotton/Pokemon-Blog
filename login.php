<?php

/*******w******** 
    
    Name: Dylan Potton
    Date: 4/22/2024
    Description: Project - Final

****************/


// Check if the login form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") 
{

    require('connect.php');
    require('authenticate.php');

    $username = $_POST['username'];
    $password = $_POST['password'];

    // Validate the username and password
    if (!empty($username) && !empty($password)) 
    {
        // Check if given username and password match the admin creds
        if ($username === ADMIN_LOGIN && password_verify($password, password_hash(ADMIN_PASSWORD, PASSWORD_DEFAULT))) 
        {
            $_SESSION['user_id'] = 1; 
            $_SESSION['username'] = $username;
            header("Location: index.php");
            exit();
        } 
        else 
        {
            $error = "Invalid username or password.";
        }
    } 
    else 
    {
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
