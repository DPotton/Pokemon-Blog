<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kanto Data!</title>
</head>
<body>
    <nav class="navigationSection"> 
        <h2><a id="title" href="index.php">Dan's Pokemon Blog</a></h2>
        <ul class="container">
            <li><a href="index.php">Home</a></li>
            <li><a href="post.php" class="button-primary-outline">New Post!</a></li>
            <li><a href="pokemon.php?sort=name">Sort Alphabetically</a></li>
            <li><a href="pokemon.php?sort=dexNumber">Sort by Pokedex Number</a></li>

        </ul>
    </nav>

    <form action="pokemon.php" method="GET">
        <label for="search">Search Pokemon:</label>
        <input type="text" id="search" name="search">
        <button type="submit">Search</button>
    </form>
    
</body>
</html>

<?php

require('connect.php');

try {
    // Step 1: Handle sorting
    $sortBy = isset($_GET['sort']) ? $_GET['sort'] : 'pokemonID';
    $validSortOptions = ['type', 'name']; // Valid sorting options
    $sortBy = in_array($sortBy, $validSortOptions) ? $sortBy : 'pokemonID';

    // Step 2: Handle search
    $searchTerm = isset($_GET['search']) ? $_GET['search'] : '';

    // Step 3: Retrieve data from the "pokemon" table with sorting and searching
    $sql = "SELECT * FROM pokemon WHERE name LIKE :searchTerm ORDER BY $sortBy";
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':searchTerm', "%$searchTerm%");
    $stmt->execute();
    // Step 3: Display the data on your PHP page
    if ($stmt->rowCount() > 0) {
        echo "<table border='1'>";
        echo "<tr><th>ID</th><th>Name</th><th>Type1</th><th>Type2</th><th>Region</th><th>DexNumber</th></tr>";
        // output data of each row
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr><td>".$row["pokemonID"]."</td><td>".$row["name"]."</td><td>".$row["type1"]."</td><td>".$row["type2"]."</td><td>".$row["region"]."</td><td>".$row["dexNumber"]."</td></tr>";
        }
        echo "</table>";
    } else {
        echo "0 results";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>

