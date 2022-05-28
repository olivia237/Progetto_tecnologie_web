
<?php
require_once("bootstrap.php");
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
    $ris_login = $dbh->admin($_SESSION["nome"]);
    if(count($ris_login)!=0) {
        $templateParams["tipo"] = "amministratore";
    }
}


$templateParams["titolo"] = "HomePage";
$templateParams["nome"] = "template/Home.php";
$templateParams["css"] = "css/Home.css";
require("template/base.php");
?>