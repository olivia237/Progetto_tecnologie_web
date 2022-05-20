<div class="container pt-5">
<?php
  if (isset($templateParams["ordini"])):
  ?>
  <table class="table caption-top">
    <caption class="text-center h4">Ordini</caption>
    <tbody>
      <th>Nome Cliente</th>
      <th>Numero ordine</th>
      <th>Data ordine</th>
      <th>Stato ordine</th>
  <?php
  foreach ($templateParams["ordini"] as $ordine): 
  ?>
    <tr>
      <td class="numero">
        <?php echo "Ordine #".$ordine["cod_ordine"];?>
      </td>
      <td class="data-ordine">
        <?php echo $ordine["data_ord"];?>
      </td>
      <td class="stato-ordine">
        <?php 
        $statoOrdine="";
        foreach ($templateParams["stati"] as $stati): 
          if ($stati["num_ordine"] == $ordine["cod_ordine"]) {
            if ($statoOrdine=="") {
              echo $stati["stato"];
              $statoOrdine = $stati["stato"];
            } 
          }
        endforeach; 
          ?>
      </td>
      <td class="vedi-ordine">
        <a href="ordine.php?id=<?php echo $ordine["cod_ordine"]?>">
            <button type="button" class="btn btn-primary position-relative">
              Vedi dettagli ordine
            </button>
        </a>
      </td>
    </tr>
<?php endforeach; 
endif; 
if (!isset($templateParams["ordini"])):
?>
<div class="container-vuoto">
    <h2> Non hai ancora fatto nessun'ordine... </h2>
    <a href="Menù.php" class="btn btn-primary btn-lg">Fai subito un oridne!</a>
</div>
<?php
endif;
?>
  </tbody>
</table>
</div>
