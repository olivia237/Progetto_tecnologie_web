<?php
require_once 'bootstrap.php';

if (isset($_SESSION["carrello"])) {
    $ris_prod = $dbh->get_prod_nel_carello($_SESSION["carrello"]);
    if (count($ris_prod)!=0) {
        $templateParams["prod"] = $ris_prod;
    }
}

if (login()) {
     $_GET["id_utente"]=$_SESSION["id_utente"];
    $num_notifiche = $dbh->get_notifiche($_SESSION["id_utente"]);
    if (count($num_notifiche)!=0) {
        $templateParams["notifiche"] = $num_notifiche;
    }
}

$ris_admin = $dbh->admin($_SESSION["nome"]);
if(count($ris_admin)==0){
    $templateParams["titolo"] = "ordine cliente";
    $templateParams["nome"] = "template/miei_ordini_form_cliente.php";
    $templateParams["css"] = "css/account.css";
    $result_orders = $dbh->get_ordine_by_utente($_SESSION["id_utente"]);
    $result_status = $dbh->get_stato_ordine_by_utente($_SESSION["id_utente"]);
    if (count($result_orders)!=0 && count($result_status)!=0) {
        $templateParams["ordini"] = $result_orders;
        $templateParams["stati"] = $result_status;
    }
    $result_us = $dbh->getUser($_SESSION["id_utente"]);
    $templateParams["utente"] = $result_us[0];
}
else{
    $templateParams["titolo"] = "ordine admin";
    $templateParams["css"] = "css/account.css";
    $templateParams["tipo"] = "amministratore";
    $templateParams["nome"] = "template/miei_ordini_form_admin.php";
    $result_us = $dbh->getUser($_SESSION["id_utente"]);
    $templateParams["utente"] = $result_us[0];
    $result_orders_admin = $dbh->get_ordine();
    $result_status_admin = $dbh->get_stato_ordine();
    if (count($result_orders_admin)!=0 && count($result_status_admin)!=0) {
        $templateParams["ordini"] = $result_orders_admin;
        $templateParams["stati"] = $result_status_admin;
    }

}

require 'template/base.php';
?>