<?php

if($_SERVER["REQUEST_METHOD"] === "POST"){
    $username = $_POST["username"];
    $email = $_POST["email"];
    $psw = $_POST["psw"];

    try {
        require_once 'dbh.inc.php';
        require_once 'register_model.inc.php';
        require_once 'register_contr.inc.php';

        //error checking
        $errors = [];

        if(empty_input_check($username,$email,$psw)){
            $errors["empty_input"]="Fill out required fields!";
        }

        if(email_valid_check($email)){
            $errors["invalid_email"]="Please use a valid email!";
        }

        if(username_available_check( $pdo, $username)){
            $errors["username_taken"]="Username already in use!";
        }

        if(email_registered_check($pdo, $email)){
            $errors["email_registered"]="Email already in use!";
        }
        
        require_once 'config_session.inc.php';

        if($errors){
            $_SESSION["errors_signup"] = $errors;

            $signupData= [
                "username"=>$username,
                "email"=>$email
            ];

            $_SESSION["signup_data"] = $signupData;

            header("Location: ../register.php");
            die();
        }

        register_user( $pdo, $username, $psw, $email);
        header("Location: ../profile.php");

        $pdo=null;
        $stmt=null;
        session_reset();

        die();

    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }

} else{
    header("Location: ../register.php");
    die();
}