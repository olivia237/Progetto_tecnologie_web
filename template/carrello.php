<table class="table caption-top">
  <caption class="h5 text-center">Carrello</caption>
  <tbody>
<?php 
$totale = 0;
foreach ($templateParams["prod"] as $prods) : 
?>
    <tr>
      <th scope="row">x<?php echo $prods["quantità_prod_car"];?></th>
      <td><img src="<?php echo UPLOAD_DIR.$prods["img_prod"]; ?>" class="card-img-top" width="70" height="70"/></td>
      <td>
        <?php echo $prods["nome_prod"];?>
        <br>
        <?php echo $prods["desc_prod"];?>
      </td>
      <td><?php echo $prods["prezzo_unitario"]." €";
      $totale = $totale + $prods["prezzo_unitario"]*$prods["quantità_prod_car"]; ?> </td>
      <td class="cancella">
        <a href="carrello.php?id=<?php echo $prods["cod_prod"]?>">
            <button type="button" class="btn btn-primary position-relative">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
              <path fill-rule="evenodd" d="M6.5 1a.5.5 0 0 0-.5.5v1h4v-1a.5.5 0 0 0-.5-.5h-3ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1H3.042l.846 10.58a1 1 0 0 0 .997.92h6.23a1 1 0 0 0 .997-.92l.846-10.58Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z"/>
              </svg>
            </button>
        </a>
      </td>
    </tr>
<?php endforeach; ?> 
  </tbody>
</table>

<div class="container-cart">
  <p class="total">
    Totale: <?php echo $totale." €"; ?>
  </p>
  <a class="order" href="login.php?action=1">
    <button type="button" class="btn btn-primary">
      Esegui l'ordine
    </button>
  </a>
</div>