<?php

ini_set('session.use_only_cookies', 1);
ini_set('session.use_strict_mode', 1);
ini_set('session.use_trans_sid', 0);

$sessionName = session_name();
if (isset($_COOKIE[$sessionName])) {
    $incomingId = $_COOKIE[$sessionName];
    if (!preg_match('/^[A-Za-z0-9,-]+$/', $incomingId) || strlen($incomingId) > 128) {
        unset($_COOKIE[$sessionName]);
        setcookie($sessionName, '', time() - 3600, '/', 'localhost', false, true);
    }
}

session_set_cookie_params([
    'lifetime' => 1800,
    'domain' => 'localhost',
    'path' => '/',
    'secure' => false,
    'httponly' => true,
]);

session_start();

if (isset($_SESSION['user_id'])) {
    if (!isset($_SESSION['last_regeneration'])) {
        regen_session_id_loggedin();
    } else {
        $interval = 60 * 30;
        if (time() - $_SESSION['last_regeneration'] >= $interval) {
            regen_session_id_loggedin();
        }
    }
} else {
    if (!isset($_SESSION['last_regeneration'])) {
        regen_session_id();
    } else {
        $interval = 60 * 30;
        if (time() - $_SESSION['last_regeneration'] >= $interval) {
            regen_session_id();
        }
    }
}

function regen_session_id_loggedin()
{
    session_regenerate_id(true);
    $_SESSION['last_regeneration'] = time();
}

function regen_session_id()
{
    session_regenerate_id(true);
    $_SESSION['last_regeneration'] = time();
}
