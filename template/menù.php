
  <div class="accordion">
        <?php foreach ($templateParams["prodotti"] as $prodotto):?>
          <?php
          $_SESSION["cod_prod"] = $prodotto["cod_prod"]; ?>
          <button><?php echo  $prodotto["nome_prod"] ?></button>
            <div>
              <img src="<?php echo  UPLOAD_DIR.$prodotto["img_prod"] ?>" class="rounded" alt="<?php echo  $prodotto["nome_prod"] ?>" width="200" height="150"> 
              <p class="h6"><?php echo $prodotto["prezzo_unitario"]." €";?><p>
            
              <a href="prodotto_singolo.php?id=<?php echo $prodotto["cod_prod"];?>" method="GET">
              <button>Visualizza</button>
              </a>
            </div>
      <?php endforeach; ?>
    </div>

    