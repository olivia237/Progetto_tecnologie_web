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
    $templateParams["titolo"] = "Account cliente";
    $templateParams["nome"] = "template/account_cliente.php";
    $templateParams["css"] = "css/account.css";

}
else{
    $templateParams["titolo"] = "Account admin";
    $templateParams["nome"] = "template/account_admin.php";
    $templateParams["css"] = "css/account.css";
    $templateParams["tipo"] = "amministratore";
   
   

}

require 'template/base.php';
?>