<?php
require_once 'bootstrap.php';
if (isset($_SESSION["carrello"])) {
    $ris_prod = $dbh->get_prod_nel_carello($_SESSION["carrello"]);
    if (count($ris_prod)!=0) {
        $templateParams["prod"] = $ris_prod;
    }
}

if (login()) {
    $num_notifiche = $dbh->get_notifiche($_SESSION["id_utente"]);
    if (count($num_notifiche)!=0) {
        $templateParams["notifiche"] = $num_notifiche;
    }
    $num_notifiche = $dbh->admin($_SESSION["nome"]);
    if(count($num_notifiche)!=0) {
        $templateParams["tipo"] = "amministratore";
    }
}
$templateParams["titolo"] = "Contact";
$templateParams["nome"] = "contact.php";


require 'template/base.php';
?>