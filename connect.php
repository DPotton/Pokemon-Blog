 <?php
     define('DB_DSN','mysql:host=127.0.0.1;dbname=serverside;charset=utf8');
     define('DB_USER','serveruser');
     define('DB_PASS','gorgonzola7!');     
     
    //  PDO is PHP Data Objects
    //  mysqli <-- BAD. P
    //  PDO <-- GOOD.
     try {
         // Try creating new PDO connection to MySQL.
         $db = new PDO(DB_DSN, DB_USER, DB_PASS);
         //,array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
     } catch (PDOException $e) {
         print "Error: " . $e->getMessage();
         die(); // Force execution to stop on errors.
     }
 ?>