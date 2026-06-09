<?php 
require_once 'includes/config_session.inc.php';
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <title>JournalMe</title>
    <link rel="stylesheet" href="../css/styleProfile.css">
    <link rel="stylesheet" id="theme_state" href="../css/dayColors.css">
    <link rel="stylesheet" href="../css/header.css">
</head>

<body>

    <?php
    if(!isset($_SESSION["user_id"])){
        header("Location:http://localhost/Practica-2026/proiect_practica/");
        die();
    }?>

    <header>
    <div id=settings>
        <button id="theme_switch"><img id="theme_icon" src="\Practica-2026\images\moon.png"></button>
        <button type="button" id="languageToggle">ENG</button>
    </div>
    <nav>
        <button id="home">Home</button>
        <button id="explore">Explore</button>
        <button id="create">Create</button>
        <button id="profile">Profile</button>
    </nav>
    </header>
    <section class="profileView">
        <section class="profileContent">
            <section class="detailsAside">
                <p id="username"><?php
                echo $_SESSION["user_name"]
                ?></p>
                <form action="includes/logout.inc.php" method="post" class="logout"> <button id="logOutProf">Log out</button> </form>
            </section>
        </section>

        <section class="journalContent">
            <div class="topIntro"> 
            <a id="introText">Your Journal</a>
            <button id="addPost" type="button" onclick="window.location.href='create.php'">
                <img src="../images/add.png" alt="Add post">
            </button>
            </div>
            <div class="containedPosts"></div>
        </section>

    </section>

    <script src="../js/navFunctions.js"></script>
    <script src="../js/languageSwitch.js"></script>
    <script src="../js/loadProfilePosts.js"></script>
    <script src="../js/themeswitch.js"></script>
</body>

</html>