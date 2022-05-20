
<div class="container">
    <h5><?php if(isset($templateParams["tipo"]) && $templateParams["tipo"]=="amministratore") {
        echo "Contenuto ordine";
    } 
    else {
        echo "Il tuo ordine";
    }?></h5>
    <h6>Articoli:</h6>
    <?php if (isset($templateParams["ordine"])):
        $totale = 0;
        foreach ($templateParams["ordine"] as $prods): ?>
        <div class="row">
            <div class="col-2">
                <img src="<?php echo UPLOAD_DIR.$prods["img_prod"]; ?>" class="card-img-top" width="70" height="70"/>
            </div>
            <?php echo $prods["nome_prod"];?>
            <div class="col-3">
                <p> 
                    <?php echo $prods["quantità_prod_car"]."x".$prods["prezzo_unitario"]." €";
                    $totale = $totale + $prods["prezzo_unitario"]*$prods["quantità_prod_car"]; ?>
                </p>
            </div>
        </div>
        <?php endforeach; 
    endif;?>
    <hr>
    <div class="row">
        <p class="totale">Totale: <?php echo $totale." €"; ?>
        </p>
    </div>
    <section>
        <h5><?php if(isset($templateParams["tipo"]) && $templateParams["tipo"]=="amministratore") {
            echo "Dati spedizione cliente";
        } 
        else {
            echo "I tuoi dati";
        }?></h5><?php $var=$templateParams["ordine"][0];?>
        <p><strong>Nome: </strong><?php if (isset($var["recapito_ord"]) && $var["recapito_ord"]!="NULL") {
            echo $var["recapito_ord"];
        }
        else {
            echo $_SESSION["recapito_ord"];        
        }?>
        <br>
        <strong>Indirizzo:</strong>
        <?php echo $var["indirizzo_sped"].", ".$var["città_ord"].", ".$var["cap_ord"]; ?>
        <br>
        <strong>Metodo di pagamento:</strong> Carta di credito
        </p>
    </section>
</div>