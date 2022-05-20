<?php
function login(){
    return !empty($_SESSION['id_utente']);
}

function registrazione($user){
    $_SESSION["id_utente"] = $user["id_utente"];
    $_SESSION["nome"] = $user["nome"];
    $_SESSION["password"] = $user["password"];   
}

function logout(){
    unset($_SESSION["id_utente"]);
    unset($_SESSION["nome"]);
    unset($_SESSION["cognome"]);
    unset($_SESSION["carrello"]);
    session_write_close();
}

function unsetVar($var){
    unset($_SESSION[$var]);
}

function carello_esistente(){
    return !empty($_SESSION['carrello']);
}

function rememberClient($user){
    $_SESSION["id_utente"] = $user["id_utente"];
    $_SESSION["nome"] = $user["nome"];
    $_SESSION["password"] = $user["password"];
}

function save_carello($id_car){
    $_SESSION["carrello"] = $id_car;
}

?>