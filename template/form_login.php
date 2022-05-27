<div class="container mt-3">
  <form class="form-signin" action="login.php <?php if (isset($templateParams["action"]) && $templateParams["action"]=="checkout") { echo "?action=1";}?>"  method="POST">
        <?php if(isset($templateParams["errorelogin"])): ?>
        <p class="error"><?php echo $templateParams["errorelogin"]; ?></p>
        <?php endif; ?>
    <h1 class="h3 mb-3 fw-normal">Accedi</h1>
    <div class="form-floating mb-3 mt-3">
      <input type="text"  name="nome" class="form-control" id="nome" placeholder="Mario">
      <label for="floatingInput">Nome</label>
    </div>
    <div class="form-floating mb-3 ">
      <input type="password"  name="password" class="form-control" id="password" placeholder="Password">
      <label for="floatingPassword">Password</label>
      <input type="checkbox" onclick="myFunction()">Show Password
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
    <button class="w-100 btn btn-lg btn-primary " type="submit">Login</button>
    <div>
      <h5>Non hai un account?</h5>
        <a class="h4 " href="registrazione.php  <?php if (isset($templateParams["action"]) && $templateParams["action"]=="checkout") { echo "?action=1";}?>">Registrati</a> 
    </div>
 </div>
</form> 