<?php
require_once("bootstrap.php");

if (isset($_POST["indirizzo_sped"]) && isset($_POST["città_ord"]) && isset($_POST["cap_ord"]) 
    && $_POST["indirizzo_sped"]!=NULL && $_POST["città_ord"]!=NULL && $_POST["cap_ord"]!=NULL) {
    if (isset($_POST["recapito_ord"])) {
        $recapito = $_POST["recapito_ord"];
    }
    else {
        $recapito = NULL;
    }
    $timestamp = strtotime("now");
    $data = (string)date('d/m/Y H:i:s', $timestamp);
    $result_order = $dbh->crea_ordine($data, $recapito, $_POST["indirizzo_sped"], $_POST["città_ord"], $_POST["cap_ord"], $_SESSION["carrello"], $_SESSION["id_utente"]);
    $result_notify = $dbh->crea_notifiche("Ordine ricevuto", "Hai ricevuto un nuovo ordine", $data,"no" ,6);
    $result_order_num = $dbh->get_ordine_by_carrello($_SESSION["carrello"]);
    $order = $result_order_num[0];
    $result_status = $dbh->aggiorna_stato("Ordinato",$order["cod_ordine"], $timestamp);
    if ($result_order!=false && $result_notify!=false) {
        $templateParams["titolo"] = "Grazie!";
        $templateParams["nome"] = "template/grazie_form.php";
        $templateParams["css"] = "css/grazie.css";
        $templateParams["ordine"] = $dbh->get_prodotto_in_ordine($_SESSION["carrello"]);
        $res = $dbh->lastCartCode();
        $id_carrel = implode(",",$res[0]);
        $id_carrel = $id_carrel + 1;
        $result_cart = $dbh->create_carrello($id_carrel);
        unsetVar("carrello");
        save_carello($id_carrel);
        $result_update = $dbh->update_carello($_SESSION["carrello"], $_SESSION["id_utente"]);
        $templateParams["prod"] = $dbh->get_prod_nel_carello($_SESSION["carrello"]);
    }
}
else {
    if (!isset($_GET["action"])) {
        $templateParams["errorecheckout"] = "Errore! Tutti i campi devono essere compilati";
    }
    $templateParams["titolo"] = "checkout";
    $templateParams["nome"] = "template/checkout-form.php";
    $templateParams["css"] = "css/checkout.css";
    $templateParams["js"] = "js/checkout.js";
    $templateParams["prod"] = $dbh->get_prod_nel_carello($_SESSION["carrello"]);
}
require("template/base.php");
?>