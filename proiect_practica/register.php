<?php 
require_once 'includes/config_session.inc.php';
require_once 'includes/register_view.inc.php';
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
<a id="actionText">Sign Up</a>
<form action="includes/register.inc.php" method="post" class="formInputs" autocomplete="off">

    <?php
    signup_input();
    check_errors();?>
    <button class="actionButton">Sign up</button>
</form>
    <button class="actionButton" id="toLogin">Log in</button>
</section>

<script src="../js/indexFunctions.js"></script>

</body>
</html>