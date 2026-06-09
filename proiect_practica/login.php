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
    <link rel="stylesheet" href="../css/dayColors.css">
</head>
<body>

<section class="registerForm">
<a id="actionText">Login</a>
<form action="includes/login.inc.php" method="post" class="formInputs" autocomplete="off">
    <input type="text" name="username" placeholder="Username"></input>
    <input type="text" name="psw" placeholder="Password"></input>
    <?php
    check_login_errors();
    ?>
    <button class="actionButton">Log in</button>
    <button class="actionButton" id="toRegister">Sign up</button>
</form>
</section>

<script src="../js/navFunctions.js"></script>

</body>
</html>