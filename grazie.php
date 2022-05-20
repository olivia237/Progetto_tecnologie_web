<?php
require_once 'bootstrap.php';

logout();

if (isset($_SESSION["carrello"])) {
    $result = $dbh->get_prod_nel_carello($_SESSION["carrello"]);
    if (count($result)!=0) {
        $templateParams["prod"] = $result;
    }
}

if (login()) {
    $num_notifiche = $dbh->get_notifiche($_SESSION["id_utente"]);
    if (count($num_notifiche)!=0) {
        $templateParams["notifiche"] = $num_notifiche;
    }
}

$templateParams["titolo"] = "Grazie!";
$templateParams["nome"] = "template/grazie_form.php";
$templateParams["css"] = "css/grazie.css";


require 'template/base.php';
?>