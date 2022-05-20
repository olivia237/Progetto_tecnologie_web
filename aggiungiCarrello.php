<?php
require_once 'bootstrap.php';

if (login()) {
    $num_notifiche = $dbh->get_notifiche($_SESSION["id_utente"]);
    if (count($num_notifiche)!=0) {
        $templateParams["notifiche"] = $num_notifiche;
    }
}

$id_prodot = $_SESSION["cod_prod"];
    //se il carrello è già stato settato allora lo prendo dalla variabile session
    if(carello_esistente()) {
        $id_carrel = $_SESSION["carrello"];
    }
    //se invece non è ancora stato settato devo determinarlo
    else {
        //se non esistono carrelli allora questo sarà il primo
        if (count($dbh->get_carrello())==0) {
            $id_carrel = 1;
        }
        //se ne esiste almeno uno allora avrà codice sucessivo all'ultimo creato
        else {
            $res = $dbh->lastCartCode();
            $id_carrel = implode(",",$res[0]);
            $id_carrel = $id_carrel + 1;
        }
        //creo un carrello e lo registro nella variabile sessione
        $result_cart = $dbh->create_carrello($id_carrel);
        save_carello($id_carrel);
    }
    $result = $dbh->prod_nel_carrello($id_carrel, $id_prodot);
    if (count($result)!=0) {
        $prods = $result[0];
        $qta = $prods["quantità_prod_car"];
        $qta = $qta + 1;
        $dbh->aggiorna_quantità_nel_carrello($qta, $id_carrel, $id_prodot);
    }
    //se non è già presente nel carrello la scarpa, allora la inserisco ex novo
    else {
        $id = $dbh->insert_prod_nel_carrello($id_carrel, $id_prodot, 1);
        if($id!=false){
            $templateParams["ins"] = "Inserimento completato correttamente!";
        }
        else{
            $templateParams["error_ins"] = "Errore in inserimento!";
        }
    }
$ris_product_by_id=$dbh->prodotto_by_id($id_prodot);
$ris_prod = $dbh->get_prod_nel_carello($_SESSION["carrello"]);
if (count($ris_product_by_id)!=0 && count($ris_prod)!=0) {
    $templateParams["prodotto"] = $ris_product_by_id[0];
    $templateParams["prod"] = $ris_prod;
    $templateParams["titolo"] = "pizza scelta";
    $templateParams["nome"] = "template/descrizione_prod.php";
    $templateParams["css"] = "css/descrizione_prod.css";
}
require 'template/base.php';
?>