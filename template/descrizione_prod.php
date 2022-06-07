<div class="container">
    <div class="card">
    <?php $prodotto = $templateParams["prodotto"] ?>
        <img src="<?php echo UPLOAD_DIR.$prodotto["img_prod"] ?>" class="card-img-top rounded" alt="<?php echo  $prodotto["nome_prod"] ?>"/>
        <?php 
        unsetVar("cod_prod");
        $_SESSION["cod_prod"] = $prodotto["cod_prod"];
        ?>
        <div class="card-body">
            <h2 class="card-title"><?php echo $prodotto["nome_prod"];?></h2>
            <h4 class="card-subtitle mb-3"><?php echo $prodotto["desc_prod"];?></h6>
            <h6 class="card-subtitle mb-3 h5">Prezzo: <?php echo $prodotto["prezzo_unitario"]." €";?></h6>
        
        <form action="aggiungiCarrello.php?id=<?php echo $prodotto["cod_prod"];?>" method="GET">
            <input type="submit" value="Aggiungi nel carrello" class="btn btn-primary">
        </form>
        </div>
        
    </div>
</div>

