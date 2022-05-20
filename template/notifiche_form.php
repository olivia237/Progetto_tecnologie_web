<div class="container-notifiche">
  <table class="table caption-top">
  <caption>Notifiche</caption>

  <tbody>
  <th>data e ora della notifica</th>
<th>stato della notifica</th>
<th>descrizione della notifica</th>
<?php 
foreach ($templateParams["notifiche"] as $notifica) : 
?> 
    <tr class="notifica-<?php if ($notifica["visto"]=="no") {
      echo "non-";
    }?>visto">
      <td class="data-notifica">
        <?php echo $notifica["data_not"];?>
      </td>
      <td class="titolo-notifica">
        <?php echo $notifica["titolo_not"];?>
      </td>
      <td class="descrizione-notifica">
        <?php echo $notifica["descrizione_not"];?>
      </td>
    </tr>
<?php endforeach;?> 
  </tbody>
</table>
</div>

