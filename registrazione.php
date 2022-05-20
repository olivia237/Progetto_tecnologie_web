<?php
 require_once 'bootstrap.php';
 
 if (isset($_SESSION["carrello"])) {
    $result = $dbh->get_prod_nel_carello($_SESSION["carrello"]);
    if (count($result)!=0) {
        $templateParams["prod"] = $result;
    }
}

if (isset($_GET["action"]) && $_GET["action"]==1) {
    if(isset($_POST["nome"]) && isset($_POST["cognome"]) && isset($_POST["email"]) && isset($_POST["password"])
         && $_POST["nome"]!=NULL && $_POST["cognome"]!=NULL && $_POST["email"]!=NULL && $_POST["password"]!=NULL) {
        $id = $dbh->salva_utente($_POST["nome"],$_POST["cognome"],$_POST["email"],$_POST["password"],"cliente");
        $_SESSION["id_utente"]=$id;
        $ris_verifica_login = $dbh->verifica_login($_POST["nome"], $_POST["password"]);
        if(count($ris_verifica_login)==0){
            $msg = "Error!";
           
        }
        else {
            $msg = "succes!";
            rememberClient($ris_verifica_login[0]);
        }
        $_GET["id_utente"]=$_SESSION["id_utente"];
        $num_notifiche = $dbh->get_notifiche($_GET["id_utente"]); //$_POST[id]
        if (count($num_notifiche)!=0) {
            $templateParams["notifiche"] = $num_notifiche;
        }
        require 'checkout.php';
    }
    else {
        $templateParams["titolo"] = "Registrazione";
        $templateParams["nome"] = "template/registrazione.php";
        $templateParams["css"] = "css/registrazione.css";
        $templateParams["action"] = "checkout";
    }

}
else{
    if(isset($_POST["nome"]) && isset($_POST["cognome"]) && isset($_POST["email"]) && isset($_POST["password"])
    && $_POST["nome"]!=NULL && $_POST["cognome"]!=NULL && $_POST["email"]!=NULL && $_POST["password"]!=NULL) {
        $id = $dbh->salva_utente($_POST["nome"],$_POST["cognome"],$_POST["email"],$_POST["password"],"cliente");
        $_SESSION["id_utente"]=$id;
        $ris_verifica_login = $dbh->verifica_login($_POST["nome"], $_POST["password"]);
        if(count($ris_verifica_login)==0){
            $msg = "Error!";
           
        }
        else {
            $msg = "succes!";
            rememberClient($ris_verifica_login[0]);
        }
        $num_notifiche = $dbh->get_notifiche($_SESSION["id_utente"]); //$_POST[id]
        if (count($num_notifiche)!=0) {
            $templateParams["notifiche"] = $num_notifiche;
        }
        $templateParams["titolo"] = "Homepage";
        $templateParams["nome"] = "Home.php";
        $templateParams["css"] = "css/homepage.css";
    }
    else {
        $templateParams["titolo"] = "Registrazione";
        $templateParams["nome"] = "template/registrazione.php";
        $templateParams["css"] = "css/registrazione.css";
    }
}

require 'template/base.php'; 
?>




