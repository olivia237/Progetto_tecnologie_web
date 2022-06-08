<div class="container pt-5">
    <div class="row mt-3">   
      <h3 class="mt-3 text-center" >I miei dati personali</h3>
      <form class="mt-3 text-center">
        <label for="nome" class ="h6">Nome: </label><?php echo $_SESSION["nome"];?><br>
        <label for="Password" class ="h6">Password:</label> <?php echo $_SESSION["password"];?><br></label>
      </form>
    </div>
    <li class= "m-3">
    <a class=" text-primary " href ="miei_ordini.php">I Miei Ordine <!--da creare-->
    </a>
</div>