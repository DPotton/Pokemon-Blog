<?php 

require('connect.php');
require('authenticate.php');

if(isset($_GET['id']))
{
    //Sanitize the id
    $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

    // Build the SQL query with the filtered id
    $query = "DELETE FROM blog WHERE id = '$id'";

    $db->query($query);
}

header("Location: index.php");
exit;

?>