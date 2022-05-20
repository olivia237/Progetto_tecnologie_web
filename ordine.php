<?php
require_once 'bootstrap.php';
if (isset($_GET["id"])) {
    $templateParams["titolo"] = "Il tuo ordine";
    $templateParams["nome"] = "template/descrizione_ord.php";
    $templateParams["css"] = "css/descrizione_ord.css";
    $templateParams["ordine"] = $dbh->getShoesInOrderByOrder($_GET["id"]);
    $ris_admin = $dbh->admin($_SESSION["nome"]);
    if(count($ris_admin)!=0) {
     $templateParams["tipo"] = "amministratore";
}
}

require 'template/base.php';
?>