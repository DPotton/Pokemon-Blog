<?php

/*******w******** 
    
    Name: Dylan Potton
    Date: 4/22/2024
    Description: Project - Final

****************/


require('connect.php');

// Determine the sorting order based on the 'sort' parameter in the URL
$sort = isset($_GET['sort']) ? $_GET['sort'] : 'desc'; // Default to descending order

// Validate the sorting order
$validSorts = array('asc', 'desc');
if (!in_array($sort, $validSorts)) {
    // If an invalid sorting order is provided, fallback to descending order
    $sort = 'desc';
}

// SQL query modified to include sorting order
$query = "SELECT * FROM blog ORDER BY date_posted $sort";
$searchTerm = isset($_GET['search']) ? $_GET['search'] : '';
if (!empty($searchTerm)) {
    $query = "SELECT * FROM blog WHERE title LIKE :search OR content LIKE :search OR content LIKE :search ORDER BY date_posted $sort";
}
$query .= " LIMIT 10";

$statement = $db->prepare($query);
if (!empty($searchTerm)) {
    $searchTerm = "%$searchTerm%";
    $statement->bindParam(':search', $searchTerm, PDO::PARAM_STR);
}
$statement->execute();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="main.css">
    <title>PokéHub! - Home Page</title>
</head>
<body>

    <?php include('nav.php'); ?>

    <main class="containerBlog">
        <h2>Gotta Read 'Em All!</h2>
        <div class="sort-links">
            Sort by date:
            <a href="?sort=asc">Ascending</a> |
            <a href="?sort=desc">Descending</a>
        </div>
        <form action="" method="GET">
            <label for="search">Search Comments:</label>
            <input type="text" id="search" name="search" value="<?= htmlspecialchars($searchTerm) ?>">
            <button type="submit">Search</button>
        </form>
        <?php if($statement->rowCount() == 0) : ?>
            <div class="center-text py-1">
                <p>No PokéEntries yet!</p>
            </div>
        <?php exit; endif; ?>

        <?php while($row = $statement->fetch()): ?>
    <h3 class="blog-post-title">
        <a href="show.php?id=<?=$row['id']?>"><?=$row['title']?></a>
    </h3>
    <!-- Display the uploaded photo -->
    <?php if (!empty($row['photo'])): ?>
        <img src="<?=$row['photo']?>" alt="Uploaded Photo">
    <?php endif; ?>
    <small><a href="edit.php?id=<?=$row['id']?>" class="blog-post-edit">Edit</a></small>
    <small><a href="delete.php?id=<?=$row['id']?>" class="blog-post-delete">Delete</a></small>
    <small class="blog-post-date">
        Caught on: <time datetime="<?=$row['date_posted']?>"><?=
        date_format(date_create($row['date_posted']), 'F j, Y G:i') ?><time>
        &ensp;
    </small> <br>
    <p class="blog-post-content">
        <?php if(strlen($row['content']) > 200) : ?>
            <?=substr($row['content'], 0, 200)?>
            <a href="show.php?id=<?=$row['id']?>">&nbsp;Show More...</a>
        <?php else: ?>
            <?= $row['content'] ?>
        <?php endif ?>
    </p><br>
<?php endwhile; ?>

    </main>
    </div>

    <?php include('footer.php'); ?>

</body>
</html>
