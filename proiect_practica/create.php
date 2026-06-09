<?php 
require_once 'includes/config_session.inc.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/create.css">
    <link rel="stylesheet" id="theme_state" href="../css/dayColors.css">
    <link rel="stylesheet" href="../css/header.css">
    <title>JournalMe</title>
</head>
<body>

<header>
    <div id="settings">
        <button id="theme_switch"><img id="theme_icon" src="../images/moon.png"></button>
        <button type="button" id="languageToggle">ENG</button>
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

<section class="createDisplay">
    <p id="encouragementText">Share your daily story!</p>
    <section class="createContainer">
        <div class="editButtons">
            <button type="button" id="boldSetting">B</button>
            <button type="button" id="italicSetting">I</button>
            <button type="button" id="underlineSetting">U</button>
            <button type="button" id="privacySetting"><img src="../images/unlock.png"></button>
        </div>
        <div class="textInput" contenteditable="true" tabindex="0">
            <p></p>
        </div>
            </section>
        <button type="button" id="postBtn">Post!</button>
</section>
<script src="../js/navFunctions.js"></script>
<script src="../js/languageSwitch.js"></script>
<script src="../js/themeswitch.js"></script>
<script src="../js/createPost.js"></script>
</body>
</html>