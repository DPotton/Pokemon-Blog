<?php

require('connect.php');
require('authenticate.php');

if($_POST && !empty($_POST['title']) && !empty($_POST['content']))
{
    // Sanitize user input of all special characters
    $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
    $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $content = filter_input(INPUT_POST, 'content', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    // Build the parameterized SQL query and bind to the sanitized values
    $query = "UPDATE blog SET title='$title',content='$content' WHERE id='$id'";

    // Submit query to the database
    $db->query($query);

    // Execute the update
    // execute() will check for possible SQL injection and remove if necessary
    /*if($statement->execute())
    {
        echo "Success";
    }*/

    header("Location: index.php");
    exit;
}

?>