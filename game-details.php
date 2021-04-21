<?php
// auth check
include 'auth.php';

$title = 'Game Details';
include 'header.php'; ?>

<?php
// check if adding or editing.  if editing, get values to populate the form
if (!empty($_GET['gameId'])) {
    $gameId = $_GET['gameId'];

    try {
        // look up the selected game in the db
        include 'db.php';
        $sql = "SELECT * FROM examgames WHERE gameId = :gameId";
        $cmd = $db->prepare($sql);
        $cmd->bindParam(':gameId', $gameId, PDO::PARAM_INT);
        $cmd->execute();
        // use fetch not fetchAll as we're only selecting a single record & don't need a loop
        $game = $cmd->fetch();
        $db = null;
    }
    catch (exception $e) {

        // redirect to error page instead of showing the error details
        header('location:error.php');
        exit(); // stop code execution now
    }
}
else {
    // if no id, we are adding, so initialize the $game variable to null
    $game = null;
}
?>

<main class="container">
    <h1>Game Details</h1>
    <form method="post" action="save-game.php" enctype="multipart/form-data">
        <fieldset class="p-2">
            <label for="title" class="col-2">Title: </label>
            <input name="title" id="title" required maxlength="50"
                value="<?php echo $game['title']; ?>" />
        </fieldset>
        <fieldset class="p-2">
            <label for="releaseYear" class="col-2">Release Year:</label>
            <input name="releaseYear" id="releaseYear" required type="number" min="1960"
                value="<?php echo $game['releaseYear']; ?>" />
        </fieldset>
        <fieldset class="p-2">
            <label for="rating" class="col-2">Rating:</label>
            <input name="rating" id="rating" maxlength="10"
                value="<?php echo $game['rating']; ?>" />
        </fieldset>
        <fieldset class="p-2">
            <label for="publisherId" class="col-2">Publisher:</label>
            <select name="publisherId" id="publisherId">
                <?php
                try {
                    // connect
                    include 'db.php';

                    // set up & run query to get all publishers
                    $sql = "SELECT * FROM exampublishers ORDER BY name";
                    $cmd = $db->prepare($sql);
                    $cmd->execute();
                    $publishers = $cmd->fetchAll();

                    // add each publisher to the list
                    foreach ($publishers as $p) {
                        if ($game['publisherId'] == $p['publisherId']) {
                            echo '<option selected value="' . $p['publisherId'] . '">' . $p['name'] . '</option>';
                        }
                        else {
                            echo '<option value="' . $p['publisherId'] . '">' . $p['name'] . '</option>';
                        }
                    }

                    // disconnect
                    $db = null;
                }
                catch (exception $e) {

                    // redirect to error page instead of showing the error details
                    header('location:error.php');
                    exit(); // stop code execution now
                }
                ?>
            </select>
        </fieldset>
        <fieldset class="p-2">
            <label for="photo" class="col-2">Photo:</label>
            <input name="photo" id="photo" type="file" accept=".png,.jpg,jpeg" />
        </fieldset>
        <?php
        // display photo if there is one
        if ($game['photo'] != null) {
            echo '<div>
                <img class="offset-2 thumbnail" src="img/game-uploads/' . $game['photo'] . '" 
                alt="Game Image" />
                </div>';
        }
        ?>
        <input name="gameId" id="gameId" type="hidden" value="<?php echo $game['gameId']; ?>" />
        <input name="currentPhoto" id="currentPhoto" type="hidden" value="<?php echo $game['photo']; ?>" />
        <button class="offset-3 btn btn-primary p-2">Save</button>
    </form>
</main>

</body>
</html>
