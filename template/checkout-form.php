
    
<div class="container">
  <main>
    <div class="py-5 text-center">
      <h2>Checkout</h2>
    </div>

    <div class="row g-5">
      <div class="col-md-5 col-lg-4 order-md-last">
        <h4 class="d-flex justify-content-between align-items-center mb-3">
          <span class="text-primary">il Tuo Carrello</span>
        </h4>
        <?php $totale=0;
         foreach ($templateParams["prod"] as $prods): ?>
        <ul class="list-group mb-3">
          <li class="list-group-item d-flex justify-content-between lh-sm">
            <div>
              <h6 class="my-0"><?php echo  $prods["nome_prod"] ?> </h6>
            </div>
            <span class="text-muted"><?php echo  $prods["quantità_prod_car"]."x".$prods["prezzo_unitario"]." £";
            $totale = $totale + $prods["prezzo_unitario"]*$prods["quantità_prod_car"]; ?> </span>
          </li>
          <?php endforeach ;?>
          <li class="list-group-item d-flex justify-content-between">
            <span>Totale</span>
            <strong><?php echo $totale." £" ;?></strong>
          </li>
        </ul>
      </div>
      <div class="col-md-7 col-lg-8">
        <h4 class="mb-3">Indirizzo di spedizione</h4>
        <form action="checkout.php" method="POST">
          <?php if(isset($templateParams["errorecheckout"])): ?>
          <p class="error bg-danger"><?php echo $templateParams["errorecheckout"]; ?></p>
          <?php endif; ?>
          <div class="row g-3">

          <div class="col-12">
              <label for="name" class="form-label">Recapito del Nome</label>
              <input type="text" class="form-control" name="recapito_ord" id="recapito_ord" placeholder="mario rossi" required>
              <div class="invalid-feedback">
                nome richiesto.
              </div>
            </div>
            <div class="col-12">
              <label for="address" class="form-label">Indirizzo</label>
              <input type="text" class="form-control" name="indirizzo_sped" id="indirizzo" placeholder="via roma 122" required>
              <div class="invalid-feedback">
                indirizzo richiesto.
              </div>
            </div>
            <div class="col-12">
              <label for="town" class="form-label">Città</label>
              <input type="text" class="form-control" name="città_ord" id="città" placeholder="cesena">
              <div class="invalid-feedback">
                città richiesto.
              </div>
            </div>
            <div class="col-12">
              <label for="zip" class="form-label">Cap</label>
              <input type="text" class="form-control" name="cap_ord" id="cap"placeholder="47521" required>
              <div class="invalid-feedback">
                cap richiesto
              </div>
            </div>

          <h4 class="mb-3">Pagamento</h4>

          <div class="my-3">
            <div class="form-check">
              <input id="credit" name="paymentMethod" type="radio" class="form-check-input" checked required>
              <label class="form-check-label" for="credit">Credit card</label>
            </div>
            <div class="form-check">
              <input id="debit" name="paymentMethod" type="radio" class="form-check-input" required>
              <label class="form-check-label" for="debit">Debit card</label>
            </div>
          </div>

          <div class="row gy-3">
            <div class="col-md-6">
              <label for="cc-name" class="form-label">Nome del titolare della carta</label>
              <input type="text" class="form-control" id="cc-name" placeholder="" required>
              <small class="text-muted">Nome completo come visualizzato sulla carta</small>
              <div class="invalid-feedback">
                nome richiesto
              </div>
            </div>

            <div class="col-md-6">
              <label for="cc-number" class="form-label">Numero della carta</label>
              <input type="text" class="form-control" id="cc-number" placeholder="" required>
              <div class="invalid-feedback">
                numero della carta is richiesto
              </div>
            </div>

            <div class="col-md-3">
              <label for="cc-expiration" class="form-label">Scadenza</label>
              <input type="text" class="form-control" id="cc-expiration" placeholder="" required>
              <div class="invalid-feedback">
                data di scadenza richiesto
              </div>
            </div>

            <div class="col-md-3">
              <label for="cc-cvv" class="form-label">CVV</label>
              <input type="text" class="form-control" id="cc-cvv" placeholder="" required>
              <div class="invalid-feedback">
              Codice di sicurezza richiesto
              </div>
            </div>
          </div>

          <hr class="my-4">

          <button class="w-100 btn btn-primary btn-lg" type="submit">finalizza il pagamento</button>
        </form>
      </div>
    </div>
  </main>
  </div>
