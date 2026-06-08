<?php 
require_once 'includes/config_session.inc.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JournalMe</title>
    <link rel="stylesheet" href="../css/explore.css">
</head>
<body>
    

<header>
    <div id=settings>
        <button><img id="theme" src="\Practica-2026\images\moon.png"></button>
        <a id="language">ENG</a>
    </div>

    <nav>
        <?php
    if(!isset($_SESSION["user_id"])){?>
        <button id="home">Home</button>
        <button id="explore">Explore</button>
        <button id="createUnlogged">Create</button>
    <?php } else { ?>
        <button id="home">Home</button>
        <button id="explore">Explore</button>
        <button id="create">Create</button>
        <button id="profile">Profile</button>

    <?php
    } ?>

    </nav>
</header>

<section class="exploreContent">
<p id="exploreText"> Our most recent stories </p>
<section class="cardDisplay">
    <p class="card"></p> <br>
    <p class="card"></p> <br>
    <p class="card"></p> <br>
</section>

</section>
<script src="../js/navFunctions.js"></script>
<script src="../js/loadExplorePosts.js"></script>
</body>
</html>