<?php
require_once 'bootstrap.php';

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



$ris_product_by_id=$dbh->prodotto_by_id($_GET["id"]);
if (count($ris_product_by_id)!=0) {
    $templateParams["prodotto"] = $ris_product_by_id[0];
    $_SESSION["cod_prod"] = $ris_product_by_id[0]["cod_prod"];
    $templateParams["titolo"] = "pizza scelta";
    $templateParams["nome"] = "template/descrizione_prod.php";
    $templateParams["css"] = "css/descrizione_prod.css";
}

   
require("template/base.php");
?>

