<?php

require_once __DIR__ . '/config_session.inc.php';

if($_SERVER["REQUEST_METHOD"] === "POST"){
    $username = $_POST["username"];
    $psw = $_POST["psw"];

    try {
        require_once __DIR__ . '/dbh.inc.php';
        require_once __DIR__ . '/login_model.inc.php';
        require_once __DIR__ . '/login_contr.inc.php';

        //error handlers

        $errors = [];

        if(empty_input_check($username, $psw)){
            $errors["empty_input"]="Fill out required fields!";
        }

        $result = get_user($pdo, $username);

        if(is_username_wrong($result)){
            $errors["incorrect_login"]="Incorrect login information!";
        }

        if(!is_username_wrong($result) && is_password_wrong($psw, $result["psw"])){
            $errors["incorrect_login"]="Incorrect login information!";
        }

        if($errors){
            $_SESSION["errors_login"] = $errors;
            header("Location: ../login.php");
            die();
        }
    
        $_SESSION["user_id"] = $result["id"];
        $_SESSION["user_name"] = htmlspecialchars($result["username"]);
        $_SESSION["last_regeneration"] = time();
        
        session_regenerate_id(true);
        header("Location: ../profile.php");

        $pdo=null;
        $stmt=null;
        die();

    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }
}
else{
    header("Location: ../login.php");
    die();
}