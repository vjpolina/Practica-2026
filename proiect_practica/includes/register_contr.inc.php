<?php

declare(strict_types=1);

function empty_input_check(string $username, string $email, string $password){
    if(empty($username) || empty($email) || empty($password)){
        return true;
    } else return false;
}

function email_valid_check(string $email){
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        return true;
    } else return false;
}

function username_available_check(object $pdo, string $username){
    if(get_username( $pdo, $username)){
        return true;
    } else return false;
}

function email_registered_check(object $pdo, string $email){
    if(get_email( $pdo, $email)){
        return true;
    } else return false;
}

function register_user(object $pdo, string $username, string $psw, string $email){
    set_user( $pdo, $username, $psw, $email);
}