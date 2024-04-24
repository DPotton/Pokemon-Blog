<?php

/*******w******** 
    
    Name: Dylan Potton
    Date: 4/22/2024
    Description: Project - Final

****************/

require('authenticate.php');
require('connect.php');

// Fetch the highest post_id from the database
$query = "SELECT MAX(post_id) AS max_post_id FROM blog";
$result = $db->query($query);
$row = $result->fetch(PDO::FETCH_ASSOC);
$max_post_id = $row['max_post_id'];

if($_POST && !empty($_POST['title']) && !empty($_POST['content']))
{
    // Sanitize user input of all special characters
    $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $content = filter_input(INPUT_POST, 'content', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    // Increment the max_post_id to get the next available post_id
    $next_post_id = $max_post_id + 1;

    // Build the parameterized SQL query and bind to the sanitized values
    $query = "INSERT INTO blog (post_id, title, content) VALUES (:post_id, :title, :content)";
    $statement = $db->prepare($query);

    // Bind values to the parameters
    $statement->bindValue(':post_id', $next_post_id);
    $statement->bindValue(':title', $title);
    $statement->bindValue(':content', $content);

    // Execute the insert
    // execute() will check for possible SQL injection and remove if necessary
    if($statement->execute())
    {
        echo "Success";
    }

    header("Location: index.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="main.css">
    <title>My Pokemon Post!</title>
</head>
<body>

        <?php include('nav.php'); ?>

    <main class="container_edit" id="create-post">
        <form action="post.php" method="POST">
            <h2>Create a new Post for other fans to see!</h2>
            <div class="form-group">
                <label for="title">Add your Title!</label>
                <input type="text" name="title" id="title" minlength="1" required>
            </div>

            <div class="form-group">
                <label for="content">Pokemon Opinions!</label>
                <textarea name="content" id="content" cols="80" rows="15" minlength="1" required></textarea>
            </div>

            <button type="submit" class="button-primary">Submit!</button>
        </form>    
    </main>

    <?php include('footer.php'); ?>
    
</body>
</html>