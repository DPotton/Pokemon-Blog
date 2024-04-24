<?php

/*******w******** 
    
    Name: Dylan Potton
    Date: 4/22/2024
    Description: Project - Final

****************/

require('connect.php');
require('authenticate.php');

// Retrieve the blog to be displayed
if(isset($_GET['id']))
{
    //Sanitize the id
    $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

    // Build the SQL query with the filtered id
    $query = "SELECT * FROM blog WHERE id = :id";
    $statement = $db->prepare($query);
    $statement->bindValue(':id', $id, PDO::PARAM_INT);

    // Execute the select query and fetch the entry returned
    $statement->execute();
    $blog = $statement->fetch();
}
else
{
    // Does not return an entry 
    $id = false;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="main.css">
    <title>Edit this Post! - <?=$blog['title']?></title>
    </head>
<body>

        <?php include('nav.php'); ?>

    <main class="container_edit" id="create-post">
        <?php if($id): ?>
            <form action="update.php?id=<?=$blog['id']?>" method="POST">
                <h2>New Post</h2>
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" name="title" id="title" minlength="1" value="<?=$blog['title']?>" required>
                </div>

                <div class="form-group">
                    <label for="content">Content</label>
                    <textarea name="content" id="content" cols="80" rows="15" minlength="1" required><?=$blog['content']?></textarea>
                </div>

                <button type="submit" class="button primary">Update Comment!</button>
                
            </form> 
            <form method="POST" action="delete.php?id=<?=$blog['id']?>">
                  <button id="form_del" type='submit' class="button secondary">Delete</button>
              </form>
        <?php else: ?>
            <p>No post selected.</p>
        <?php endif ?>   
    </main>

    <?php include('footer.php'); ?>
    
</body>
</html>