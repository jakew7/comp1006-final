<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset = "UTF-8">
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
        <link rel="stylesheet" type="text/css" href="css/styles.css" />
        <script type="text/javascript" src="js/scripts.js"></script>
        <script type="text/javascript" src="js/bootstrap.min.js"></script>
    </head>

    <body style="background-color:plum;">

<?php
// authenticatres
include 'auth.php';
// title and header of page
$title = 'Save User';
include 'header.php'; 
?>

<?php
// saves the data that was implemeneted
    $user = $_POST['user'];

    //determine to save the data
    $ok = true

    if ($ok == true) {
        try {
            // connect to the db
            include 'db.php';
    
            // if user, update existing record
            if (!empty($user)) {
                $sql = "UPDATE examusers SET user = :user";
            } else {
                // if no user, add new user
                // set up the SQL INSERT command to add a new game.  : indicates a placeholder or paramter
                $sql = "INSERT INTO examusers (username) VALUES (:user)";
            }
    
          
            // connect the db 
            $cmd = $db->prepare($sql);
            $cmd->bindParam(':user', $user, PDO::PARAM_STR, 50);
        
            // execute the save
            $cmd->execute();
    
            // disconnect
            $db = null;
    
            echo "User Saved";
            header('location:games.php');
        }
        catch (exception $e) {
    
            // redirect to error page instead of showing the error details
            header('location:error.php');
            exit(); // stop code execution now
        }
    }

?>

    </body>
</html>
