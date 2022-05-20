<div class="container pt-5">
<div class="error bg-danger" >
<?php 
if(isset($templateParams["erroreStato"])):
    echo $templateParams["erroreStato"];
?>
   <?php endif; ?>
</div>
    <?php 
    if (isset($templateParams["ordini"])):
    ?>
   <table class="table caption-top">
    <caption class="text-center h4">Ordini</caption>
    <tbody>
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
            $statoOrdine=""; //da verdif
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
        <td class="azione">
            <a href="processa_ordine.php?action=<?php if ($statoOrdine=="Ordinato") {
                    echo 1;
                }
                if ($statoOrdine=="In preparazione") {
                    echo 2;
                }?>&&id=<?php echo $ordine["cod_ordine"]; ?>">
                <button type="button" class="btn btn-primary position-relative">
                <?php if ($statoOrdine=="Ordinato") {
                    echo "Conferma ordine";
                }
                if ($statoOrdine=="In preparazione") {
                    echo "Ordine in consegna";
                }
                ?>
                </button>
            </a>
        </td>
        <td class="vedi-ordine">
            <a href="ordine.php?id=<?php echo $ordine["cod_ordine"]?>">
                <button type="button" class="btn btn-primary position-relative">
                Vedi ordine
                </button>
            </a>
        </td>
        </tr>
    <?php endforeach; 
    endif; 
    if (!isset($templateParams["ordini"])):
    ?>
    <div class="container-vuoto">
        <h2> Non hai ricevuto nessun'ordine... </h2>
    </div>
    <?php
    endif;
    ?>
    </tbody>
    </table>
</div>
