<?php

use app\Models\Users;

function verifySession(){
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
}

function loginById($id)
{
    verifySession();

    return $_SESSION['id'] = $id;
}

function isLoggedIn()
{   
    verifySession();

    return isset($_SESSION['id']);
}

function logout()
{   
    verifySession();
    session_unset();
    session_destroy();
}

function getUserLogged()
{
    verifySession();

    if (isLoggedIn()) {
        $id = intval($_SESSION['id']);
        $user = Users::find($id);
        return $user;
    }

    return 'null';
}
