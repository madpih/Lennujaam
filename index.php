<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LENNUJAAM</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">

</head>
<body>
 
<div class="d-flex flex-column h-100">

<nav class="navbar navbar-expand-lg bg-light">
      <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-center" id="navbarNavAltMarkup">
          <div class="navbar-nav">
            <a class="nav-link active" aria-current="page" href="index.php">Esileht</a>
            <a class="nav-link" href="arrivals.php">Saabuvad lennud</a>
            <a class="nav-link" href="departures.php">Lahkuvad lennud</a>
            <a class="nav-link" href="destinations.php">Sihtkohad</a>
            <a class="nav-link" href="airlines.php">Lennufirmad</a>
          </div>
        </div>
      </div>
    </nav>


     <section class="hero text-white py-5 flex-grow-1">
        <div class="container py-4">
            <div class="row">
                <div class="col-lg-6 align-self-center">
                    <h1 class="display-4">LENNUJAAMAINFO RAKENDUS</h1>
                    <p class="fst-italic text-muted">Lennuinfo management - saabuvad ja lahkuvad lennud, lennufirmad ja nende sihtkohad. Lennuinfo kuvamine.</p><hr>
                    <p class="fst-italic text-muted"> Info kuvamiseks ja sisestamiseks vali ülalt menüüst vajalik valdkond.</p>
                </div>
                <div class="col-lg-6">
                    <img src="pexels-austin-zhang-2441844.jpg" class="img-fluid" alt="airplane">
                </div>
            </div>
        </div>
    </section>


 
    <footer class="w-100 py-4 flex-shrink-0">
        <div class="container py-4">
            <div class="row gy-4 gx-5">
                <div class="col-lg-6 col-md-6">
                    <h5 class="h1 text-white">LENNUJAAM.</h5>
                    <p class="small text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt.</p>
                    <p class="small text-muted mb-0">&copy; Copyrights. All rights reserved.</p>
                </div>
                <div class="col-lg-3 col-md-6 px-5">
                    <h5 class="text-white mt-4">Leia kiirelt:</h5>
                    <ul class="list-unstyled text-muted">
                        <li><a href="#">Saabuvad lennud</a></li>
                        <li><a href="#">Lahkuvad lennud</a></li>
                        
                    </ul>
                </div>

                <div class="col-lg-3 col-md-6 px-5">
                    <h5 class="text-white mt-4">Leia kiirelt:</h5>
                    <ul class="list-unstyled text-muted">
                        <li><a href="#">Sihtkohad</a></li>
                        <li><a href="#">Lennufirmad</a></li>
                    </ul>
                </div>
                
        
            </div>
        </div>
    </footer>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>