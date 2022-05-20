<?php
require_once 'bootstrap.php';

if (isset($_SESSION["carrello"])) {
    $ris_prod = $dbh->get_prod_nel_carello($_SESSION["carrello"]);
    if (count($ris_prod)!=0) {
        $templateParams["prod"] = $ris_prod;
    }
}
if(isset($_POST["nome"]) && isset($_POST["password"]) && $_POST["nome"]!=NULL && $_POST["password"]!=NULL){
    $login_result = $dbh->verifica_login($_POST["nome"], $_POST["password"]);
    if(count($login_result)==0){
        //Login fallito
        $templateParams["errorelogin"] = "Nome o password errato";
    }
    else {
        registrazione($login_result[0]);
        $_GET["id_utente"]=$_SESSION["id_utente"];
        $ris_admin = $dbh->admin($_SESSION["nome"]);
        if (count($ris_admin)==0) {
            //se il carrello non è stato settato nella variabile sessione allora devo rimediare
            if (!carello_esistente()) {
                //se l'utente ha già un carrello associato da sessioni precedenti allora lo conservo
                $result = $dbh->get_carello_utente($_GET["id_utente"]);
                if (count($result)!=0) {
                    $carrelloUtente = $result[0];
                    save_carello($carrelloUtente["cod_car_U"]);
                }
                //se l'utente non ha già un carrello allora lo creo e glielo associo
                else {
                    $result1 = $dbh->get_carrello();
                    //se non esistono carrelli allora questo sarà il primo
                    if (count($result1)==0) {
                        $id_carrel = 1;
                    }
                    //se ne esiste almeno uno allora avrà codice sucessivo all'ultimo creato
                    else {
                        $res = $dbh->lastCartCode();
                        $id_carrel = implode(",",$res[0]);
                        $id_carrel = $id_carrel + 1;
                    }
                    //creo il carrello
                    $result_cart = $dbh->create_carrello($id_carrel);
                    save_carello($id_carrel);
                    //lo associo all'utente appena loggato
                    $result_update = $dbh->update_carello($_SESSION["carrello"], $_GET["id_utente"]);
                    if($result_update!=false){
                        $msg = "Inserimento completato correttamente!";
                    }
                    else{
                        $msg = "Errore in inserimento!";
                    }
                }
            }
            //se un utente aveva già iniziato a fare acquisti ed ha eseguito il login solo successivamente 
            else {
                $result_cart1 = $dbh->get_carello_utente($_GET["id_utente"]);
                //se un utente nel suo account aveva già iniziato a fare acquisti, voglio che gli restino nel carrello
                //per cui unisco al carrello precedente l'attuale carrello
                if (count($result_cart1)!=0) {
                    $carrelloUtente = $result_cart1[0];
                    //se il carrello in session non è vuoto
                    //allora prendo gli elementi nel carrello e li aggiungo al carrello precedente 
                    //ossia quello settato nel campo carrello della tabella utente
                    $ris_prod = $dbh->get_prod_nel_carello($_SESSION["carrello"]);
                    echo count($ris_prod);
                    if (count($ris_prod)!=0) {
                        //per ogni prods nel carrello in session
                        foreach ($ris_prod as $prods):
                            //controllo che non sia già presente nel carrello
                            $ris_prod1 = $dbh->prod_nel_carrello($carrelloUtente["cod_car_U"], $prods["cod_prod_car"]);
                            if (count($ris_prod1)!=0) {
                                $prods = $ris_prod1[0];
                                $qta = $prods["quantità_prod_car"];
                                $qta = $qta + 1;
                                $dbh->aggiorna_quantità_nel_carrello($qta, $carrelloUtente["cod_car_U"], $prods["cod_prod_car"]);
                            }
                            //se non è già presente nel carrello la prods, allora la inserisco ex novo
                            else {
                                $id = $dbh->insert_prod_nel_carrello($carrelloUtente["cod_car_U"], $prods["cod_prod_car"], 1);
                                if($id!=false){
                                    $msg = "Inserimento completato correttamente!";
                                }
                                else{
                                    $msg = "Errore in inserimento!";
                                }
                            }
                            $result_delete = $dbh->delete_prod_in_carello($_SESSION["carrello"], $prods["cod_prod_car"]);
                            if ($result_delete!=false) {
                                $msg = "Cancellazione completata correttamente!";
                            }
                            else{
                                $msg = "Errore in cancellazione!";
                            }
                        endforeach;
                    }
                    //cambio il carrello settato in session mettendo quello precedente
                    $dbh->delete_carrello($_SESSION["carrello"]);
                    unsetVar("carrello");
                    save_carello($carrelloUtente["cod_car_U"]);
                }
                //se un utente non aveva ancora un carrello gli associo il carrello della variabile sessione
                else {
                    $result_update = $dbh->update_carello($_SESSION["carrello"], $_GET["id_utente"]);
                    if($result_update!=false){
                        $msg = "Inserimento completato correttamente!";
                    }
                    else{
                        $msg = "Errore in inserimento!";
                        
                    }
                }
            }
        }
    }
}






if (isset($_GET["action"]) && $_GET["action"]==1) {
    if(login()){
        $num_notifiche = $dbh->get_notifiche($_SESSION["id_utente"]);
        if (count($num_notifiche)!=0) {
            $templateParams["notifiche"] = $num_notifiche;
        }
        require 'checkout.php';
    }
    else{
        $templateParams["titolo"] = "Login";
        $templateParams["nome"] = "template/form_login.php";
        $templateParams["css"] = "css/login.css";
        $templateParams["action"] = "checkout";
        require 'template/base.php';
    }
}
else{
    if(login()){
        $ris_Admin= $dbh->admin($_SESSION["nome"]);

        if (isset($_SESSION["carrello"]) && count($ris_Admin)==0) {
            $ris_prod = $dbh->get_prod_nel_carello($_SESSION["carrello"]);
            if (count($ris_prod)!=0) {
                $templateParams["prod"] = $ris_prod;
            }
            require 'index.php';
        }
          $num_notifiche = $dbh->get_notifiche($_SESSION["id_utente"]);
        if (count($num_notifiche)!=0) {
            $templateParams["notifiche"] = $num_notifiche;
        }
        if(count($ris_Admin)!=0) {
            $templateParams["tipo"] = "amministratore";
            require 'account.php';
        }
       
    }
    else{
        $templateParams["titolo"] = "Login";
        $templateParams["nome"] = "template/form_login.php";
        $templateParams["css"] = "css/login.css";
        require("template/base.php");
    }
}

?>