<?php
// connect to db
include '../db.php';

// check for a publisher parameter
$publisher = null;

if (!empty($_GET['username'])) { 
    $publisher = $_GET['username'];
}

// grabs usernames
$sql = "SELECT examusers *
FROM examusers";

// check if list should be filtered for selected publisher
if (!empty($publisher)) {
    $sql .= " WHERE examusers= :username";
}

// execute query and grab results using FETCH_ASSOC to include column names
$cmd = $db->prepare($sql);

// fill publisher parameter if we have a selected publisher
if (!empty($publisher)) {
    $cmd->bindParam(':username', $username, PDO::PARAM_STR, 50);
}
$cmd->execute();
$games = $cmd->fetchAll(PDO::FETCH_ASSOC);

// display the game array as a json object
echo json_encode($games);

// disconnect
$db = null;
?>