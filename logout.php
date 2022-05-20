<?php
require_once 'bootstrap.php';

logout();
if (login()) {
    $num_notifiche = $dbh->get_notifiche($_SESSION["id_utente"]);
    if (count($numero_notif)!=0) {
        $templateParams["notifica"] = $num_notifiche;
    }
}

$templateParams["titolo"] = "Homepage";
$templateParams["nome"] = "Home.php";
$templateParams["css"] = "css/homepage.css";


require 'template/base.php';
?>