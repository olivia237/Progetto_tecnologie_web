<div class="container">
    <h2>Grazie per il tuo ordine!
        <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" fill="currentColor" class="bi bi-emoji-heart-eyes" viewBox="0 0 16 16">
        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
        <path d="M11.315 10.014a.5.5 0 0 1 .548.736A4.498 4.498 0 0 1 7.965 13a4.498 4.498 0 0 1-3.898-2.25.5.5 0 0 1 .548-.736h.005l.017.005.067.015.252.055c.215.046.515.108.857.169.693.124 1.522.242 2.152.242.63 0 1.46-.118 2.152-.242a26.58 26.58 0 0 0 1.109-.224l.067-.015.017-.004.005-.002zM4.756 4.566c.763-1.424 4.02-.12.952 3.434-4.496-1.596-2.35-4.298-.952-3.434zm6.488 0c1.398-.864 3.544 1.838-.952 3.434-3.067-3.554.19-4.858.952-3.434z"/>
        </svg>
    </h2>
    <h5>Il tuo ordine</h5>
    <h6>Articoli:</h6>
    <?php if (isset($templateParams["ordine"])):
        $totale = 0;
        foreach ($templateParams["ordine"] as $prods): ?>
        <div class="row mb-2">
            <div class="col-2">
                <img src="<?php echo  UPLOAD_DIR.$prods["img_prod"] ?>" class="rounded" alt="<?php echo  $prods["nome_prod"] ?>" width="200" height="150"> 
            </div>
            <div class="col-7 mx-3">
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
    <a class="recensione text-center" href="write_recensione.php"><button type="button" class="btn btn-secondary">Lascia una Recensione</button>
    </a>
</div>