<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- titolo delle pagine -->
    <title><?php echo $templateParams["titolo"]; ?></title>
    <link rel="icon" type="./resources/x-icon" href="./resources/favicon.ico">
    <!--jquery-->
   <script src="https://code.jquery.com/jquery-3.4.1.min.js"integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="crossorigin="anonymous"></script>
    <?php
    if(isset($templateParams["js"])):
      $script = $templateParams["js"];
    ?>
        <script src="<?php echo $script; ?>"></script>
    <?php
    endif;
    ?>
     <!--  CSS delle pageine  -->

     <?php
    if(isset($templateParams["css"])):
    ?>
    <link href=<?php echo $templateParams["css"]; ?> rel="stylesheet" type="text/css"/>
    <?php
    endif;
    ?>
   
    <link href="./css/base.css" rel="stylesheet" type="text/css"/>
  </head>

  <body>
   <!-- Bootstrap -->
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>


  <!-- header-->
  <header class="p-3 bg-dark text-white">
    <div class="container">
      <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
          <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
            <li><a href="index.php" class="nav-link h5 px-2 text-white">Home</a></li>
            <li><a href="menù.php" class="nav-link h5 px-2 text-white">Menù</a></li>
          </ul>

          <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3">
            <input type="text" id="myInput" onkeyup="myFunction()"class="form-control form-control-dark" placeholder="Search..." aria-label="Search">
          </form>


          <a href="carrello.php" class="btn btn-primary m-2 position-relative">
            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-bag" viewBox="0 0 16 16">
              <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V5z"/>
            </svg>
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-warning">
            <?php 
            if (isset($templateParams["prod"])) {
              $count_car = 0;
              foreach ($templateParams["prod"] as $prod) : 
                $count_car = $count_car + $prod["quantità_prod_car"];
              endforeach;
              echo $count_car;
            }
            else {
              echo "0";
            }
            ?>
            <span class="visually-hidden">Carrello</span>
            </span>
          </a>
          <a href="notifiche.php" class="btn btn-primary m-2 position-relative">
            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-bell" viewBox="0 0 16 16">
              <path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2zM8 1.918l-.797.161A4.002 4.002 0 0 0 4 6c0 .628-.134 2.197-.459 3.742-.16.767-.376 1.566-.663 2.258h10.244c-.287-.692-.502-1.49-.663-2.258C12.134 8.197 12 6.628 12 6a4.002 4.002 0 0 0-3.203-3.92L8 1.917zM14.22 12c.223.447.481.801.78 1H1c.299-.199.557-.553.78-1C2.68 10.2 3 6.88 3 6c0-2.42 1.72-4.44 4.005-4.901a1 1 0 1 1 1.99 0A5.002 5.002 0 0 1 13 6c0 .88.32 4.2 1.22 6z"/>
            </svg>

            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-warning">
            <?php if (isset($templateParams["notifiche"])) {
              $count=0;
              foreach ($templateParams["notifiche"] as $notifica) : 
                if ($notifica["visto"]=="no") {
                  $count = $count + 1;
                }
              endforeach;
              echo $count;
            }
            else {
              echo "0";
            }
             ?>
             <span class="visually-hidden">Notifiche</span>
            </span> 
          </a>
          <div class="dropdown">
              <button class="btn btn-primary mr-5  dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                  <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
                </svg>
              </button>
              <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">

              <li><a class="dropdown-item" href="
              <?php 
              if(!login()) {
                echo 'login.php';
              }
              else {
                echo 'account.php';
              }
              ?> 
              ">
              <?php if(!login()) {
                echo "Login";
              } 
              else {
                echo "Account";
              }?>
              </a></li>

              <li><a class="dropdown-item text-danger" href="
              <?php
                echo 'logout.php';
              ?>
              ">
              <?php
                echo "Logout";
              ?>
                </a></li>
              </ul>
            </div>
          
        
      </div>
    </div>
</header>
<!-- end header-->


    <main>
      <?php
      if(isset($templateParams["nome"])){
          require($templateParams["nome"]);
      }
      ?>

    </main>


<!-- footer-->
<footer class="py-3 my-4 bg-dark ">
    <ul class="nav justify-content-center mb-3 text-muted">
      <li class="nav-item"><a href="index.php" class="nav-link px-2 text-muted">Home</a></li>
      <li class="nav-item"><a href="contact_us.php" class="nav-link px-2 text-muted">contact us</a></li>
      <li class="nav-item"><a href="read_recensioni.php" class="nav-link px-2 text-muted">Recensioni</a></li>
    </ul>
  </footer>

  <!-- end footer-->

  </body>
</html>