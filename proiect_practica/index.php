<?php 
require_once 'includes/config_session.inc.php';
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <title>JournalMe</title>
    <link rel="stylesheet" href="../css/styleIndex.css">
    <link rel="stylesheet" id="theme_state" href="../css/dayColors.css">
    <link rel="stylesheet" href="../css/header.css">
</head>

<body>

<header>
    <div id=settings>
        <button id="theme_switch"><img id="theme_icon" src="\Practica-2026\images\moon.png"></button>
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

<section class="pageContent">

<main>
    <div id=logoSection>
        <a id="pageTitle">JournalMe</a>
        <div id="logoImg"><img src="\Practica-2026\images\book.png"></div>
    </div>

    <?php
    if(!isset($_SESSION["user_id"])){?>
    <a id="motto">Life is made of memories, treasure every one.</a>

    <section class="actionButtons">
        <button id="toRegister">Sign up</button>
        <button id="toLogin">Log in</button>
    </section>
    <?php } else { ?>
    <a id="motto">Hello, <?php 
    echo $_SESSION["user_name"];
    ?>!</a>

    <section class="actionButtons">
    <button id="create">Create</button>
    <form action="includes/logout.inc.php" method="post" class="logout"> <button id="logOut">Log out</button> </form>
    </section>

    <?php
    } ?>

</main>

<section class="cardDisplay">
    <a>Share your story!</a>
    <p class="card"></p> <br>
    <p class="card"></p> <br>
    <p class="card"></p> <br>
</section>

</section>

<footer>
    <a>Contact us:</a>
    <div class="contact">
    <button><img id="Instagram" src="\Practica-2026\images\instagram.png"></button>
    <button><img id="Twitter" src="\Practica-2026\images\twitter.png"></button>
    <button><img id="Tiktok" src="\Practica-2026\images\tiktok.png"></button>
    <button><img id="Email" src="\Practica-2026\images\mail.png"></button>
    <button id="feedbackBtn">Submit feedback</button>
    </div>
</footer>

<script src="../js/navFunctions.js"></script>
<script src="../js/themeswitch.js"></script>
</body>

</html>