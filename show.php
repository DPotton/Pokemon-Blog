<?php

/*******w******** 
    
    Name: Dylan Potton
    Date: 4/22/2024
    Description: Project - Final

****************/

require('connect.php');

if(isset($_GET['id']))
{
    $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

    $query = "SELECT * FROM blog WHERE id = :id";
    $statement = $db->prepare($query);
    $statement->bindValue(':id', $id, PDO::PARAM_INT);

    $statement->execute();
    $blog = $statement->fetch();
}
else
{
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
    <title>My Pokemon Blog Post! - <?=$blog['title']?></title>
</head>
<body>

    <?php include('nav.php'); ?>

    <main class="container_show">
        <?php if($id): ?>
            <h1 class="blog-post-title"><?=$blog['title']?></h1>
            <small><a href="edit.php?id=<?=$blog['id']?>" class="blog-post-edit">edit</a></small>
            <small class="blog-post-date">
            Posted on <time datetime="<?=$blog['date_posted']?>"><?=date_format(date_create($blog['date_posted']), 'F j, Y G:i') ?><time>&ensp;</small> <br>
        <p class="blog-post-content">
            <?=$blog['content']?>
        </p>
        <?php else: ?>
            <p>No post selected.</p>
        <?php endif ?>
    </main>

    <?php include('footer.php'); ?>

</body>
</html>