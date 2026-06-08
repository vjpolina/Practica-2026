<?php

declare(strict_types=1);

function signup_input(){
    if(isset($_SESSION["signup_data"]["username"]) && !isset($_SESSION["errors_signup"]["username_taken"])){
        $usernameValue = htmlspecialchars($_SESSION["signup_data"]["username"]);
        echo '<input type="text" name="username" placeholder="Username" value="' . $usernameValue . '">';
    }
    else{echo '<input type="text" name="username" placeholder="Username">';}

    if(isset($_SESSION["signup_data"]["email"]) && !isset($_SESSION["errors_signup"]["email_registered"])
        && !isset($_SESSION["errors_signup"]["invalid_email"])){
        echo '<input type="text" name="email" placeholder="Youremailhere@example.com" value="'.$_SESSION["signup_data"]["email"].'">';
    }
    else{echo '<input type="text" name="email" placeholder="Youremailhere@example.com">';}

    echo '<input type="text" name="psw" placeholder="Password"></input>';
}

function check_errors(){
    if(isset($_SESSION['errors_signup'])){
        $errors = $_SESSION['errors_signup'];

        foreach($errors as $error){
            echo '<p class="formError">'. $error . '</p>';
        }

        unset($_SESSION['errors_signup']);
    } else if(isset($_GET["signup"]) && $_GET["signup"] === "success"){
        echo '<p class="formSuccess">Signup success!</p>';
    }
}

