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
</head>
<body>

<section class="registerForm">
<a id="actionText">Sign Up</a>
<form action="includes/register.inc.php" method="post" class="formInputs" autocomplete="off">
    <input type="text" name="username" placeholder="Username"></input>
    <input type="text" name="email" placeholder="Youremailhere@example.com"></input>
    <input type="text" name="psw" placeholder="Password"></input>
    <?php check_errors();?>
    <button class="actionButton">Sign up</button>
</form>
</section>

<script src="../js/indexFunctions.js"></script>

</body>
</html>