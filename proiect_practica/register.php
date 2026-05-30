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
</head>
<body>
    
<h3>Sign Up</h3>
<form action="includes/register.inc.php" method="post">
    <input type="text" name="username" placeholder="Username"></input>
    <input type="text" name="email" placeholder="Youremailhere@example.com"></input>
    <input type="text" name="psw" placeholder="Password"></input>
    <button>Sign up</button>
</form>

<?php 
    check_errors();
?>

</body>
</html>