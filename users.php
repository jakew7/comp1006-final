<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset = "UTF-8">
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
        <link rel="stylesheet" type="text/css" href="css/styles.css" />
        <script type="text/javascript" src="js/scripts.js"></script>
        <script type="text/javascript" src="js/bootstrap.min.js"></script>
    </head>
    <!-- start of the body -->
    <body style="background-color:plum;"> 

<!-- title and nav bar of page -->
<?php
$title = 'Users';
include 'header.php'; ?>

<h1>Current Users</h1>

<!-- authenticates page -->
<?php
// authenticates
include 'auth.php';

// includes the database 
include 'db.php';

// selects all from examusers
$sql = "SELECT * from examusers";

// variable that calls the database
$cmd = $db->prepare($sql);

// executes the table from sql
$cmd->execute();

// fetches the data 
$user = $cmd->fetchAll();

// echos the tablef rom bootstrap
echo '<table class="table table-dark"><thead><th>User Name</th><th></th></thead>';

// foreach loop to grap the data  and adds a edit button
foreach ($user as $u){
    echo '<tr>
    <td>' . $u['username'] . '</td>
    <td><a href="user-details.php? class="btn btn-warning">Edit</a></td></tr>';
}

// echos the table
echo '</table>';

// disconects form the database
$db = null;


?>
    </body>
</html>