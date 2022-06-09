<style>
body {
    font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
}
caption {
    text-align: center;
    font-weight: bold;
    font-size: 1.2em;
}
td.data-notifica, td.titolo-notifica {
    width: 22%;
}

div.container a.admin button.btn {
    background-color: white;
    color: black;
    border-color: white;
}
tr.notifica-non-visto {
    background-color:#43DFB0;
}
tr.notifica-visto {
    background-color: white;
}

  </style>
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

