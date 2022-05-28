<div class="container mt-3">
<form action="registrazione.php <?php if (isset($templateParams["action"]) && $templateParams["action"]=="checkout") {
        echo "?action=1";
        }
        ?>" method="POST">
        <?php if(isset($templateParams["erroreregistrazione"])): ?>
        <p><?php echo $templateParams["erroreregistrazione"]; ?></p>
        <?php endif; ?>
    <p class="login lead text-center h6 ">Benvenuto su Pizza Chef</p>    
    <h5 class="h3 mb-3 fw-normal ">Registrati per fare un ordine!</h5>
    <div class="form-floating mb-3 mt-3">
      <input type="text" name="nome" class="form-control" id="nome" placeholder="nome">
      <label for="nome">Nome</label>
    </div>
    <div class="form-floating mb-3 ">
      <input type="text" name="cognome" class="form-control" id="floatingInput" placeholder="Cognome">
      <label for="cognome">Cognome</label>
      </div>
      <div class="form-floating mb-3 ">
      <input type="email" name="email" class="form-control" id="floatingInput" placeholder="Email">
      <label for="email">Email</label>
      </div>
    <div class="form-floating mb-3 ">
      <input type="password" name="password" class="form-control" id="password" placeholder="Password">
      <label for="Password">Password</label>
      <input type="checkbox" onclick="myFunction()">mostra Password
        <script>
          function myFunction() {
            var x = document.getElementById("password");
            if (x.type === "password") {
             x.type = "text";
             } 
              else {
                x.type = "password";
             }
          }
        </script>
    </div>

     <!-- <div class="checkbox mb-3">
    <label>
        <input type="checkbox" value="remember-me"> Remember me
      </label> 
    </div> -->

    <button class="w-100 btn btn-lg btn-primary " type="submit">Entrare</button>
 </div>
</form>