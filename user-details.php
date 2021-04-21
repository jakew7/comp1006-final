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
$title = 'User Details';
include 'header.php'; 
?>

        <!-- this connects the save page with this page -->
        <form method = "post" action = "save-user.php">
                <!-- div for the card name -->
                <br>
                <div class = "row mb-3 justify-content-center">
                    <label for = "users" class = "col-sm-1 col-form-label">User: </label>
                    <div class="col-sm-3">
                        <input name = "users" class="form-control" id = "users" required maxlength = "50"/>
                    </div>
                </div>
                <button class = "offset-4 btn btn-primary p-2">Save</button>
            </form>
    </body>
</html> 