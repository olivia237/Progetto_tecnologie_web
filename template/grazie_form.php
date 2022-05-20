<div class="container">
    <h2>Grazie per il tuo ordine!</h2>
    <h5>Il tuo ordine</h5>
    <h6>Articoli:</h6>
    <?php if (isset($templateParams["ordine"])):
        $totale = 0;
        foreach ($templateParams["ordine"] as $prods): ?>
        <div class="row">
            <div class="col-2">
                <img src="<?php echo  UPLOAD_DIR.$prods["img_prod"] ?>" class="rounded" alt="<?php echo  $prods["nome_prod"] ?>" width="200" height="150"> 
            </div>
            <div class="col-7">
                <?php echo  $prods["nome_prod"] ?>
            </div>
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
        <h5>I tuoi dati</h5><?php $var=$templateParams["ordine"][0];?>
        <p><strong>Nome: </strong><?php if (isset($var["recapito_ord"])) {
            echo $var["recapito_ord"];
        }
        else {
            echo $_SESSION["nome"];        
        }?>
        <br>
        <strong>Indirizzo:</strong>
        <?php echo $var["indirizzo_sped"].", ".$var["città_ord"].", ".$var["cap_ord"]; ?>
        <br>
        <strong>Metodo di pagamento:</strong> Carta di credito
        </p>
    </section>
</div>