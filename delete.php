<?php 

require('connect.php');
require('authenticate.php');

if(!isAdmin()) {
    // If not an admin, deny access
    header("HTTP/1.1 403 Forbidden");
    exit("Access Denied: Admin privileges required.");
}

if(isset($_GET['id']) && isset($_GET['confirm'])) {
    //Sanitize the id
    $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

    // Build the SQL query with the filtered id
    $query = "DELETE FROM blog WHERE id = '$id'";
    
    $db->query($query);

    header("Location: index.php");
    exit;
}

if(isset($_GET['id'])) {
    $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
    
    echo "<script>
        var confirmDelete = confirm('Delete for realsies?');
        if (confirmDelete) 
        {
            window.location.href = 'delete.php?id=$id&confirm=1'; // If confirmed, proceed with deletion
        } 
        else 
        {
            window.location.href = 'index.php'; // If canceled, go back to index.php
        }
    </script>";
}

function isAdmin() {
    // Check if the user is authenticated and has admin credentials
    return (isset($_SERVER['PHP_AUTH_USER']) && isset($_SERVER['PHP_AUTH_PW'])
            && ($_SERVER['PHP_AUTH_USER'] == ADMIN_LOGIN)
            && ($_SERVER['PHP_AUTH_PW'] == ADMIN_PASSWORD));
}

?>