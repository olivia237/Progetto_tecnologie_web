<?php
class DatabaseHelper{
    private $db;

    public function __construct($servername, $username, $password, $dbname){
        $this->db = new mysqli($servername, $username, $password, $dbname);
        if ($this->db->connect_error) {
            die("Connection failed: " . $db->connect_error);
        }        
    }
     //qua definiamo tutti i metodi per interogare il db


     public function salva_utente( $nome, $cognome, $email,$password,$tipo){
        $query = "INSERT INTO utente (nome, cognome, email, password,tipo) VALUES (?, ?, ?, ?,?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("sssss",$nome, $cognome, $email,$password,$tipo);
        $stmt->execute();
        return $stmt->insert_id;
    }

    public function verifica_login($nome, $password){
        $stmt = $this->db->prepare("SELECT id_utente, nome, password FROM utente WHERE nome = ? AND password = ?");
        $stmt->bind_param('ss',$nome, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function admin($nome){
        $stmt = $this->db->prepare("SELECT * FROM utente WHERE nome = ? AND tipo = 'amministratore'");
        $stmt->bind_param('s',$nome);
        $stmt->execute();

        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getUser($user){
        $stmt = $this->db->prepare("SELECT * FROM utente WHERE id_utente=?");
        $stmt->bind_param('i',$user);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }
    public function get_prodotto(){
        $stmt = $this->db->prepare("SELECT * FROM prodotto");
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function get_prod_nel_carello($id_carrel){
        $stmt = $this->db->prepare("SELECT * FROM ordine_nel_carrello ,prodotto WHERE cod_car_con_prod=? AND cod_prod_car=cod_prod");
        $stmt->bind_param('i',$id_carrel);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function delete_prod_in_carello($id_carrel, $cod_prodot){
        $query = "DELETE FROM ordine_nel_carrello WHERE cod_car_con_prod = ? AND cod_prod_car = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ii',$id_carrel, $cod_prodot);
        $stmt->execute();
        return true;
    }
    public function delete_carrello($id_carrel){
        $query = "DELETE FROM carrello WHERE cod_carrello = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i',$id_carrel);
        $stmt->execute();
        return true;
    }

    public function update_carello($id_carrel, $id_user){
        $query = "UPDATE utente SET cod_car_U = ? WHERE id_utente = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ii', $id_carrel, $id_user);
        
        return $stmt->execute();
    }
    
    public function create_carrello($id_carrel){
        $query = "INSERT INTO carrello (cod_carrello) VALUES (?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $id_carrel);
        $stmt->execute();
        
        return $stmt->insert_id;
    }
    public function get_carrello(){
        $stmt = $this->db->prepare("SELECT * FROM carrello");
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function get_carello_utente($user){
        $stmt = $this->db->prepare("SELECT * FROM ordine_nel_carrello, utente WHERE cod_car_U=cod_car_con_prod AND id_utente=?");
        $stmt->bind_param('i',$user);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function insert_prod_nel_carrello($id_carrel, $cod_prodot, $qta){
        $query = "INSERT INTO ordine_nel_carrello (cod_car_con_prod, cod_prod_car, quantità_prod_car) VALUES (?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("iii", $id_carrel, $cod_prodot, $qta);
        $stmt->execute();
        
        return $stmt->insert_id;
    }
    public function lastCartCode(){
        $stmt = $this->db->prepare("SELECT MAX(cod_carrello) as massimo FROM carrello");
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }
    public function prod_nel_carrello($id_carrel, $cod_prodot){
        $stmt = $this->db->prepare("SELECT * FROM ordine_nel_carrello WHERE cod_car_con_prod=? AND cod_prod_car=?");
        $stmt->bind_param('ii',$id_carrel, $cod_prodot);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function aggiorna_quantità_nel_carrello($qta, $id_carrel, $cod_prodot){
        $query = "UPDATE ordine_nel_carrello SET quantità_prod_car = ? WHERE cod_car_con_prod=? AND cod_prod_car=?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('iii', $qta, $id_carrel, $cod_prodot);
        
        return $stmt->execute();
    }
    public function prodotto_by_id($id){
        $stmt = $this->db->prepare("SELECT * FROM prodotto WHERE cod_prod = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }
    public function get_notifiche($id_user){
        $stmt = $this->db->prepare("SELECT * FROM notifiche WHERE id_utente_N=? ORDER BY cod_notifica DESC");
        $stmt->bind_param('i',$id_user);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function crea_ordine( $data, $recapito,$indirizzo, $città, $cap,$id_carrel, $id_utente){
        $query = "INSERT INTO ordine (data_ord ,recapito_ord,indirizzo_sped, città_ord, cap_ord, cod_carrello_O, id_utente_O) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("sssssii",$data, $recapito,$indirizzo, $città, $cap,$id_carrel, $id_utente);
        $stmt->execute();
        
        return $stmt->insert_id;
    }
    public function get_ordine(){
        $stmt = $this->db->prepare("SELECT * FROM ordine ORDER BY cod_ordine DESC");
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }
    public function get_stato_ordine(){
        $stmt = $this->db->prepare("SELECT num_ordine, data_stato, stato FROM ordine, stato_ordine WHERE num_ordine=cod_ordine ORDER BY cod_ordine, data_stato DESC");
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }
    public function get_prodotto_in_ordine($id_carrel){
        $stmt = $this->db->prepare("SELECT * FROM ordine_nel_carrello, prodotto, ordine WHERE cod_car_con_prod=? AND cod_prod=cod_prod_car AND cod_carrello_O=cod_car_con_prod");
        $stmt->bind_param('i',$id_carrel);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }
    public function crea_notifiche($titolo, $descrizione, $data, $visto, $id_utente){
        $query = "INSERT INTO notifiche (titolo_not, descrizione_not, data_not, visto, id_utente_N) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ssssi",$titolo, $descrizione, $data, $visto, $id_utente);
        $stmt->execute();
        
        return $stmt->insert_id;
    } 
    public function aggiorna_not($visto, $idNotifica){ 
        $query = "UPDATE notifiche SET visto = ? WHERE cod_notifica=?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('si', $visto, $idNotifica);
        
        return $stmt->execute();
    }

    public function aggiorna_stato($stato,$idOrdine, $data){ 
        $query = "INSERT INTO stato_ordine (stato, num_ordine, data_stato) VALUES (?,?,?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("sis", $stato,$idOrdine, $data);
        $stmt->execute();
        
        return $stmt->insert_id;
    }

    public function get_ordine_by_carrello($id_carrel){
        $stmt = $this->db->prepare("SELECT * FROM ordine WHERE cod_carrello_O=?");
        $stmt->bind_param('i',$id_carrel);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function get_ordine_by_utente($id_cliente){ 
        $stmt = $this->db->prepare("SELECT * FROM ordine WHERE id_utente_O=? ORDER BY cod_ordine DESC");
        $stmt->bind_param('i',$id_cliente);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }
    public function getUserByOrder($idOrder){
        $stmt = $this->db->prepare("SELECT * FROM ordine, utente WHERE id_utente_O=id_utente AND cod_ordine=?");
        $stmt->bind_param('i',$idOrder);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function get_stato_ordine_by_utente($id_cliente){
        $stmt = $this->db->prepare("SELECT num_ordine, data_stato, stato FROM ordine, stato_ordine WHERE id_utente_O=? AND num_ordine=cod_ordine ORDER BY cod_ordine, data_stato DESC");
        $stmt->bind_param('i',$id_cliente);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getShoesInOrderByOrder($id_ordine){ 
        $stmt = $this->db->prepare("SELECT * FROM ordine_nel_carrello,prodotto, ordine WHERE cod_ordine=? AND cod_prod=cod_prod_car AND cod_carrello_O=cod_car_con_prod");
        $stmt->bind_param('i',$id_ordine);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }
}

?>