<?php
require_once 'bootstrap.php';

if(isset($_GET["id"])){
    $ris_delete = $dbh->delete_prod_in_carello($_SESSION["carrello"], $_GET["id"]);
    if ($ris_delete!=false) {
        $templateParams["err_can"] = "Cancellazione completata correttamente!";
    }
    else{
        $templateParams ["succes_can"] = "Errore in cancellazione!";
    }
}

//nel caso del checkout
if (isset($_GET["action"]) && $_GET["action"]==1) {
    if (isset($_SESSION["carrello"])) {
    $ris_prod = $dbh->get_prod_nel_carello($_SESSION["carrello"]);
        if (count($ris_prod)!=0) {
            $templateParams["titolo"] = "Checkout";
            $templateParams["nome"] = "template/checkout-form.php";
            $templateParams["css"] = "css/checkout.css";
            $templateParams["js"] = "js/checkout.css";
            $templateParams["prod"] = $dbh->get_prod_nel_carello($_SESSION["carrello"]);
        }
        else {
            $templateParams["titolo"] = "Carrello";
            $templateParams["nome"] = "template/carrello_vuoto.php";
            $templateParams["css"] = "css/carrello_vuoto.css";
        }
    }
    else {
        $templateParams["titolo"] = "Carrello";
        $templateParams["nome"] = "template/carrello_vuoto.php";
        $templateParams["css"] = "css/carrello_vuoto.css";
    }
}
else{

    if (isset($_SESSION["carrello"])) {
        $ris_prod = $dbh->get_prod_nel_carello($_SESSION["carrello"]);
        if (count($ris_prod)!=0) {
            $templateParams["titolo"] = "Carrello";
            $templateParams["nome"] = "template/carrello.php";
            $templateParams["css"] = "css/carrello.css";
            $templateParams["prod"] = $dbh->get_prod_nel_carello($_SESSION["carrello"]);
        }
        else {
            $templateParams["titolo"] = "Carrello";
            $templateParams["nome"] = "template/carrello_vuoto.php";
            $templateParams["css"] = "css/carrello_vuoto.css";
        }
    }
    else {
        $templateParams["titolo"] = "Carrello";
        $templateParams["nome"] = "template/carrello_vuoto.php";
        $templateParams["css"] = "css/carrello_vuoto.css";
    }
}
require 'template/base.php';
?>