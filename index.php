<?php

/*******w******** 
    
    Name: Dylan Potton
    Date: 4/22/2024
    Description: Project - Final

****************/


//
require('connect.php');

// SQL is writen as a String.
// Selects the five most recent blogs posted and displays them 
$query = "SELECT * FROM blog ORDER BY date_posted DESC LIMIT 5";

// A PDO::Statement is prepared from the query
$statement = $db->prepare($query);

//Execution on the DB server is delayed until we execute().
$statement->execute();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="main.css">
    <title>My Blog! - Home Page</title>
</head>
<body>

    <?php include('nav.php'); ?>

    <main class="containerBlog">
        <h2>Recently posted blog entries</h2>
            <?php if($statement->rowCount() == 0) : ?>
            <div class="center-text py-1">
                <p>No blog entries yet!</p>
            </div>
        <?php exit; endif; ?>

    <?php while($row = $statement->fetch()): ?>
        <h3 class="blog-post-title">
            <a href="show.php?id=<?=$row['id']?>"><?=$row['title']?></a>
        </h3>
        <small><a href="edit.php?id=<?=$row['id']?>" class="blog-post-edit">edit</a></small>
        <small class="blog-post-date">
            Posted on <time datetime="<?=$row['date_posted']?>"><?=
            date_format(date_create($row['date_posted']), 'F j, Y G:i') ?><time>
            &ensp;
        </small> <br>
        <p class="blog-post-content">
            <?php if(strlen($row['content']) > 200) : ?>
                <?=substr($row['content'], 0, 200)?>
                <a href="show.php?id=<?=$row['id']?>">&nbsp;Read Full Post...</a>
            <?php else: ?>
                <?= $row['content'] ?>
            <?php endif ?>
        </p><br>
    <?php endwhile; ?>
    </main>

    <?php include('footer.php'); ?>

</body>
</html>