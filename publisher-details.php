<?php
$title = 'Publisher Details';
include 'header.php'; ?>
<main>
    <form method="post" action="save-publisher.php">
        <fieldset>
            <label for="name">Publisher: </label>
            <input name="name" id="name" required maxlength="100"/>
        </fieldset>
        <button>Save</button>
    </form>
</main>
</body>
</html>
