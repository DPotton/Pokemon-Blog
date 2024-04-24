<nav class="navigationSection"> 
    <h2><a id="title" href="index.php">Dan's Pokemon Blog</a></h2>
    <ul class="container">
        <li><a href="index.php">Home</a></li>
        <li><a href="post.php" class="button-primary-outline">New Post!</a></li>
    </ul>
</nav>
<?php

require('connect.php');

try {
    // Step 2: Retrieve data from the "pokemon" table
    $sql = "SELECT * FROM pokemon";
    $stmt = $db->query($sql);

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
