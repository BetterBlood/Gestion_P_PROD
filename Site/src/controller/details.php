<?php
    include "../model/Database.php";

    $database = new Database();

    $project = $database->getProjectById($_GET["idProject"]);
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>ETML HyperProject</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.5/examples/jumbotron/">

    <!-- Bootstrap core CSS -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      table {
        border: 1px blue;
      }

      .us {
        border: 1px;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>
    <!-- Custom styles for this template -->
    <link href="jumbotron.css" rel="stylesheet">
  </head>
  <body>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-info">
  <a class="navbar-brand" href="#"><strong>ETML HyperProject</strong></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarsExampleDefault">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#">Accueil <span class="sr-only"></span></a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="printersList.php">Ajouter un projet<span class="sr-only"></span></a>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0" method="post"  action="#">
      <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search" name="searchValue">
      <button class="btn btn-dark my-2 my-sm-0" name="search" type="submit">Search</button>
    </form>
  </div>
</nav>

<main role="main">

  <!-- Modal -->
  <div class="modal fade" id="teacher" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Ajouter une imprimante</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="insertTeacher.php" method="post">
            <div class="form-group">
              <label for="exampleFormControlInputFir">Prénom</label>
              <input type="text" class="form-control" id="exampleFormControlInputFir" name="firstName">
            </div>
            <div class="form-group">
              <label for="exampleFormControlInputLast">Nom</label>
              <input type="text" class="form-control" id="exampleFormControlInputLast" name="lastName">
            </div>
            <div class="form-group">
              <label for="exampleFormControlSelect1">Section</label>
              <select class="form-control" id="exampleFormControlSelect1" name="section">
              </select>
            </div>
            <div class="form-group">
              <label for="inlineRadio1">Sexe</label><br>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="gender" id="inlineRadio1" value="m">
                <label class="form-check-label" for="inlineRadio1">Homme</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="gender" id="inlineRadio2" value="w">
                <label class="form-check-label" for="inlineRadio2">Femme</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="gender" id="inlineRadio3" value="o">
                <label class="form-check-label" for="inlineRadio3">Transgenre</label>
              </div>
            </div>
            <div class="form-group">
              <label for="exampleFormControlInput1">Surnom</label>
              <input type="text" class="form-control" id="exampleFormControlInput1" name="nickName">
            </div>
            <div class="form-group">
              <label for="exampleFormControlTextarea1">Origine du surnom</label>
              <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="origin"></textarea>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
              <input type="submit" class="btn btn-primary" value="Ajouter">
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="connection" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Se connecter</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="home.php" method="post">
            <div class="form-group">
              <label for="exampleFormControlInputFir">Username</label>
              <input type="text" class="form-control" id="exampleFormControlInputFir" name="username">
            </div>
            <div class="form-group">
              <label for="exampleFormControlInputLast">Password</label>
              <input type="password" class="form-control" id="exampleFormControlInputLast" name="password">
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
              <input type="submit" name="login" class="btn btn-primary" value="Connexion">
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Main jumbotron for a primary marketing message or call to action -->
  <div class="jumbotron" style="background-color: #b4f8f8;">
    <div class="container">
      <h1 class="display-3">Détails du projet</h1>
      <?php
      $completeName = ($database->getTeacherById($project["idInitiator"])["teaFirstName"]) . ' ' . ($database->getTeacherById($project["idInitiator"])["teaLastName"]);
        echo '<strong>Nom du projet : </strong>' . $project["proName"];
        echo '<strong>Description du projet : </strong>' . $project["proDescription"];
        echo '<strong>Projet initié par : </strong>' . $completeName . '<p></p>';
        echo '<strong>Durée du projet : </strong>du' . $project["proStartingDate"] . ' au ' . $project["proEndingDate"];
      ?>
      <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
      </div>
    </div>
  </div>

  <div class="container">
    <!-- Example row of columns -->
    <div class="row">
      <img src="../Ressources/images/p1.jpg" alt="">       
    </div>
    <hr>

  </div> <!-- /container -->

</main>

<footer class="container">
  <p>&copy; ETML, 2020</p>
</footer>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</html>