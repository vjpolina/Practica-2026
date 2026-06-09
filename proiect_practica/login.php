<?php 
require_once 'includes/config_session.inc.php';
require_once 'includes/login_view.inc.php';
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JournalMe</title>
    <link rel="stylesheet" href="../css/register.css">
    <link rel="stylesheet" id="theme_state" href="../css/dayColors.css">
</head>
<body class="register-page">

<button type="button" id="languageToggle">ENG</button>
<section class="registerForm">
<a id="actionText">Login</a>
<form action="includes/login.inc.php" method="post" class="formInputs" autocomplete="off">
    <input type="text" name="username" placeholder="Username"></input>
    <input type="text" name="psw" placeholder="Password"></input>
    <?php
    check_login_errors();
    ?>
    <button class="actionButton" id="loginSubmit">Log in</button>
</form>
    <button class="actionButton" id="toRegister">Sign up</button>
</section>

<script src="../js/navFunctions.js"></script>
<script src="../js/languageSwitch.js"></script>
<script src="../js/themeswitch.js"></script>

</body>
</html>