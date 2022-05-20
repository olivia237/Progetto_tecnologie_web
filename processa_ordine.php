<?php
require_once 'bootstrap.php';

if(isset($_GET["action"])) {
    if (isset($_GET["id"])) {
        $timestamp = strtotime("now");
        $data = (string)date('d/m/Y H:i:s', $timestamp);
        $result_user = $dbh->getUserByOrder($_GET["id"]);
        if (count($result_user)!=0) {
            //conferma ordine e preparazione
            if ($_GET["action"]==1) {
                $message = "Il tuo ordine numero ".$_GET["id"]." è stato confermato ed è in fase di preparazione!";
                $user = $result_user[0];
                $result_notify = $dbh->crea_notifiche("Ordine in preparazione", $message,$data, "no", $user["id_utente"]);
                $result_status = $dbh->aggiorna_stato("In preparazione",$_GET["id"],  $timestamp);
                if ($result_notify!=false && $result_status!=false) {
                    $templateParams["erroreStato"]="Errore nel cambiare lo stato!";
                }
                else{
                    $templateParams["Stato"]="cambiare lo stato!";
                }
            }       
            //consegna
            if ($_GET["action"]==2) {
                $message = "Il tuo ordine numero ".$_GET["id"]." è in consegnato e arrivera entro 20 minuti! Grazie e buon appetito";
                $user = $result_user[0];
                $result_notify = $dbh->crea_notifiche("Ordine in consegna", $message, $data, "no", $user["id_utente"]);
                $result_status = $dbh->aggiorna_stato("in consegna",$_GET["id"], $timestamp);
                if ($result_notify!=false && $result_status!=false) {
                    $templateParams["erroreStato"]="Errore nel cambiare lo stato!";
                }
                else{
                    $templateParams["Stato"]="cambiare lo stato!";
                }
            }       
        }
    }
}

if (login()) {
    $num_notifiche = $dbh->get_notifiche($_SESSION["id_utente"]);
    if (count($num_notifiche)!=0) {
        $templateParams["notifiche"] = $num_notifiche;
    }
}


$templateParams["titolo"] = "Admin";
$templateParams["nome"] = "template/miei_ordini_form_admin.php";
$templateParams["css"] = "css/account.css";
$templateParams["tipo"] = "amministratore";
$result_orders_admin = $dbh->get_ordine();
$result_status_admin = $dbh->get_stato_ordine();
if (count($result_orders_admin)!=0 && count($result_status_admin)!=0) {
    $templateParams["ordini"] = $result_orders_admin;
    $templateParams["stati"] = $result_status_admin;
}


require 'template/base.php';
?>