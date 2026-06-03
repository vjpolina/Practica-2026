<?php
declare(strict_types=1);

function is_username_wrong(bool|array $result){
    if (!$result) {
        return true;
    } else {
        return false;
    }
    
}

function is_password_wrong(string $psw, string $hashedPsw){
    if (!password_verify($psw, $hashedPsw)) {
        return true;
    } else {
        return false;
    }
    
}

function empty_input_check(string $username, string $password){
    if(empty($username) || empty($password)){
        return true;
    } else return false;
}