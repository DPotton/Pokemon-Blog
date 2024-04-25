<?php

/*******w******** 
    
    Name: Dylan Potton
    Date: 4/22/2024
    Description: Project - Final

****************/

require('authenticate.php');
require('connect.php');

// Function to resize image
function resizeImage($filename, $newWidth, $targetFile) {
    list($width, $height) = getimagesize($filename);
    $ratio = $width / $height;
    $newHeight = $newWidth / $ratio;
    $src = imagecreatefromstring(file_get_contents($filename));
    $dst = imagecreatetruecolor($newWidth, $newHeight);
    imagecopyresampled($dst, $src, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
    imagedestroy($src);
    imagejpeg($dst, $targetFile); // Change to imagepng or imagegif if needed
    imagedestroy($dst);
}

// Fetch the highest post_id from the database
$query = "SELECT MAX(post_id) AS max_post_id FROM blog";
$result = $db->query($query);
$row = $result->fetch(PDO::FETCH_ASSOC);
$max_post_id = $row['max_post_id'];

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    if (!empty($_POST['title']) && !empty($_POST['content'])) {
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
        if ($statement->execute()) {
            // File upload handling
            if (isset($_FILES["image"]) && $_FILES["image"]["error"] == 0) {
                // File details
                $client_filename = $_FILES["image"]["name"];
                $tmp_file = $_FILES["image"]["tmp_name"];

                // Directory to upload
                $upload_directory = 'uploads/';

                // Create uploads directory if it doesn't exist
                if (!file_exists($upload_directory)) {
                    mkdir($upload_directory, 0777, true);
                }

                // Move uploaded file to uploads directory
                if (move_uploaded_file($tmp_file, $upload_directory . $client_filename)) {
                    // Resize the uploaded image
                    $resized_filename = $upload_directory . 'resized_' . $client_filename;
                    resizeImage($upload_directory . $client_filename, 200, $resized_filename);

                    // Store the file path/name in the database
                    $photo_path = $resized_filename;
                    $query = "UPDATE blog SET photo = :photo WHERE post_id = :post_id";
                    $statement = $db->prepare($query);
                    $statement->bindValue(':photo', $photo_path);
                    $statement->bindValue(':post_id', $next_post_id);
                    $statement->execute();
                    
                    // Remove the original uploaded file
                    unlink($upload_directory . $client_filename);
                } else {
                    // Error while uploading file
                    echo "Error uploading file.";
                }
            }
            echo "Success";
            header("Location: index.php");
            exit;
        }
    }
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
        <form action="post.php" method="POST" enctype="multipart/form-data">
            <h2>Create a new Post for other fans to see!</h2>
            <div class="form-group">
                <label for="title">Add your Title!</label>
                <input type="text" name="title" id="title" minlength="1" required>
            </div>

            <div class="form-group">
                <label for="content">Toss in some words!</label>
                <textarea name="content" id="content" cols="80" rows="15" minlength="1" required></textarea>
            </div>

            <div class="form-group">
                <label for="image">Upload an Image</label>
                <input type="file" name="image" id="image">
            </div>

            <button type="submit" class="button-primary" name="submit">Submit!</button>
        </form>
    </main>

    <?php include('footer.php'); ?>
    
</body>
</html>
