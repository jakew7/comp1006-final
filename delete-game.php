<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Deleting Game...</title>
</head>
<body>
<?php
include 'auth.php';

// get the selected gameId from the url parameter using the $_GET array
$gameId = $_GET['gameId'];

if (is_numeric($gameId)) {
    try {
        // connect
        include 'db.php';
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // set up & run the SQL DELETE command
        $sql = "DELETE FROM examgames WHERE gameId = :gameId";
        $cmd = $db->prepare($sql);
        $cmd->bindParam(':gameId', $gameId, PDO::PARAM_INT);
        $cmd->execute();

        // disconnect
        $db = null;
    }
    catch (exception $e) {

        // redirect to error page instead of showing the error details
        header('location:error.php');
        exit(); // stop code execution now
    }
}

// redirect to updated games.php
header('location:games.php');
?>
</body>
</html>
