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
            <a class = "nav-link <?=isset($_REQUEST["page"])?"":"active"?>"href="?">Esileht</a>
            <a class ="nav-link <?=($_REQUEST["page"]??"")=="arrivals"?"active":""?>" href="?page=arrivals">Saabuvad lennud</a>
            <a class ="nav-link <?=($_REQUEST["page"]??"")=="departures"?"active":""?>" href="?page=departures">Väljuvad lennud</a>
            <a class ="nav-link <?=($_REQUEST["page"]??"")=="destinations"?"active":""?>" href="?page=destinations">Sihtkohad</a>
            <a class ="nav-link <?=($_REQUEST["page"]??"")=="airlines"?"active":""?>" href="?page=airlines">Lennufirmad</a>

            </div>
        </div>
      </div>
    </nav>