<?php
// connect to db
include '../db.php';

// check for a publisher parameter
$publisher = null;

if (!empty($_GET['publisher'])) { // e.g. /api/games.php?publisher=Nintendo
    $publisher = $_GET['publisher'];
}

// write query to fetch games
$sql = "SELECT examgames.*, exampublishers.name
FROM examgames INNER JOIN exampublishers ON examgames.publisherId = exampublishers.publisherId";

// check if list should be filtered for selected publisher
if (!empty($publisher)) {
    $sql .= " WHERE exampublishers.name = :publisher";
}

// execute query and grab results using FETCH_ASSOC to include column names
$cmd = $db->prepare($sql);

// fill publisher parameter if we have a selected publisher
if (!empty($publisher)) {
    $cmd->bindParam(':publisher', $publisher, PDO::PARAM_STR, 50);
}
$cmd->execute();
$games = $cmd->fetchAll(PDO::FETCH_ASSOC);

// display the game array as a json object
echo json_encode($games);

// disconnect
$db = null;
?>