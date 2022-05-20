<?php
require_once 'bootstrap.php';

if (login()) {
    $num_notifiche = $dbh->get_notifiche($_SESSION["id_utente"]);
    if (count($num_notifiche)!=0) {
        $templateParams["notifiche"] = $num_notifiche;
    }
    $ris_admin = $dbh->admin($_SESSION["nome"]);
    if(count($ris_admin)!=0) {
        $templateParams["tipo"] = "amministratore";
    }
}

foreach ($templateParams["notifiche"] as $notifica):
    $result_update = $dbh->aggiorna_not("si", $notifica["cod_notifica"]);
endforeach;

$templateParams["titolo"] = "Notifiche";
$templateParams["nome"] = "template/notifiche_form.php";
$templateParams["css"] = "css/notifiche.css";

require 'template/base.php';
?>