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
          <a class="nav-link" href="index.php">Esileht</a>
            <a class="nav-link" href="arrivals.php">Saabuvad lennud</a>
            <a class="nav-link active" aria-current="page" href="departures.php">Lahkuvad lennud</a>
            <a class="nav-link" href="destinations.php">Sihtkohad</a>
            <a class="nav-link" href="airlines.php">Lennufirmad</a>
          </div>
        </div>
      </div>
    </nav>


     <section class="text-white py-5 flex-grow-1">
        <div class="container-fluid py-4">
            <div class="row">
            <div class="col-lg-6 px-5">
                    <h1 class="display-4">Väljuvad lennud</h1>
                    <p class="fst-italic text-muted">Staatuse muutmiseks kliki Muuda</p><hr>
                    <table class="flights text-muted">
                        <thead>
                            <tr class="date text-white">
                                <th colspan="6">17. oktoober 2023</th>
                            </tr>
                            <tr>
                                <th>Aeg</th>
                                <th>Lennunumber</th>
                                <th>Sihtkoht</th>
                                <th>Lennufirma</th>
                                <th>Lennustaatus</th>
                                <th></th>
                            </tr>
                        </thead>
                            <tbody>
                            <tr>
                                <td>21:30</td>
                                <td>FR 2224</td>
                                <td>London</td>
                                <td>Ryanair</td>
                                <td>Väljus 21:30</td>
                                <td><a class="flex-sm-fill text-sm-center nav-link" href="#">Muuda</a></td>
                            </tr>
                            <tr>
                                <td>23:40</td>
                                <td>BT 880	</td>
                                <td>Málaga </td>
                                <td>AirBaltic</td>
                                <td>Hilineb</td>
                                <td><a class="flex-sm-fill text-sm-center nav-link" href="#">Muuda</a></td>
                            </tr>
                            </tbody>
                            <tr class="date text-white">
                                <th colspan="6">18. oktoober 2023</th>
                            </tr>
                            <tr>
                                <td>00:30</td>
                                <td>FFF 100</td>
                                <td>New York</td>
                                <td>Lufthansa</td>
                                <td>Pealeminek</td>
                                <td><a class="flex-sm-fill text-sm-center nav-link" href="#">Muuda</a></td>
                            </tr>
                    </table>
                </div> 
                <div class="col-lg-6 px-5">
                    <h1 class="display-5">Väljuvate lendude haldus</h1>
                    <nav class="nav nav-pills flex-column flex-sm-row m-0">
                        <!-- <a class="flex-sm-fill text-sm-center nav-link" href="#">Lisa uus lend</a> -->
                        <a class="flex-sm-fill text-sm-center nav-link" href="#">Määra kõigile 'Tühistatud'</a>
                        <a class="flex-sm-fill text-sm-center nav-link" href="#">Määra kõigile 'Hilineb'</a>
                    </nav>
                    <hr>   
                    <h4 class="text-muted">Uue lennu lisamine</h4>

                    <form action="?">
                    <div class="mb-3">
                        <label for="time" class="form-label">Aeg</label>
                        <input type="datetime" class="form-control" id="aeg" required>
                    </div>
                   
                    <div class="mb-3">
                        <label for="airline" class="form-label">Lennufirma</label>
                        <input type="text" class="form-control" id="airline" required>
                    </div>
                    <div class="mb-3">
                        <label for="destination" class="form-label">Sihtkoht</label>
                        <input type="text" class="form-control" id="destination" required>
                    </div>
                    <div class="mb-3">
                        <label for="flightnumber" class="form-label">Lennunumber</label>
                        <input type="text" class="form-control" id="flightnumber" required>
                    </div>
                   
                                     
                    <button type="submit" class="btn btn-light">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </section>


 
    <footer class="w-100 py-4 flex-shrink-0">
        <div class="container py-4">
            <div class="row gy-4 gx-5">
                <div class="col-lg-5 col-md-6">
                    <h5 class="h1 text-white">LENNUJAAM.</h5>
                    <p class="small text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt.</p>
                    <p class="small text-muted mb-0">&copy; Copyrights. All rights reserved.</p>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h5 class="text-white mt-4">Leia kiirelt:</h5>
                    <ul class="list-unstyled text-muted">
                        <li><a href="arricals.php">Saabuvad lennud</a></li>
                        <li><a href="#">Lahkuvad lennud</a></li>
                        
                    </ul>
                </div>

                <div class="col-lg-3 col-md-6">
                    <h5 class="text-white mt-4">Leia kiirelt:</h5>
                    <ul class="list-unstyled text-muted">
                        <li><a href="destinations.php">Sihtkohad</a></li>
                        <li><a href="airlines.php">Lennufirmad</a></li>
                    </ul>
                </div>
                
        
            </div>
        </div>
    </footer>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>