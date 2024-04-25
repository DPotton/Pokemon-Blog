<?php

/*******w******** 
    
    Name: Dylan Potton
    Date: 4/22/2024
    Description: Project - Final

****************/

// Define an array of question prompts
$questionPrompts = [
    "What's your favorite Pokémon and why?",
    "What was your first ever starter Pokémon?",
    "What would be the best Pokémon to add to real life?",
    "Which Pokémon game is your all-time favorite?",
    "Do you have a shiny Goomy?"
];

// Randomly select a question prompt
$randomPrompt = $questionPrompts[array_rand($questionPrompts)];

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    require('authenticate.php');
    require('connect.php');

    if (!empty($_POST['title']) && !empty($_POST['content'])) {
        // Sanitize user input of all special characters
        $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $content = filter_input(INPUT_POST, 'content', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        // File upload handling
        if (isset($_FILES["image"]) && $_FILES["image"]["error"] == 0) {
            $client_filename = $_FILES["image"]["name"];
            $tmp_file = $_FILES["image"]["tmp_name"];
            $upload_directory = 'uploads/';

            if (!file_exists($upload_directory)) {
                mkdir($upload_directory, 0777, true);
            }

            $photo_path = $upload_directory . $client_filename; // Full path including directory

            if (move_uploaded_file($tmp_file, $photo_path)) {
                // Build the param SQL query and bind to the sanitized values, including the image path
                $query = "INSERT INTO blog (title, content, images) VALUES (:title, :content, :images)";
                $statement = $db->prepare($query);

                // Bind values to the parameters, including the image path
                $statement->bindValue(':title', $title);
                $statement->bindValue(':content', $content);
                $statement->bindValue(':images', $photo_path); // Bind the full image path

                // Execute the insert
                if ($statement->execute()) {
                    // Redirect after successful submission
                    header("Location: index.php");
                    exit;
                } else {
                    echo "Error executing SQL query.";
                }
            } else {
                echo "Error uploading file.";
            }
        } else {
            echo "Image file not uploaded.";
        }
    } else {
        echo "Title and content are required.";
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
            <h2><?php echo $randomPrompt; ?></h2> <!-- Display random question prompt -->
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
