<!doctype html>
<html lang="fr-ch">

<head>
  <!--
    Auteurs : Julien Leresche, Jeremiah Steiner et Ricardo Delgado Miranda
    Date : 02.12.2020
    Description : Page en accès administrateur permettant de créer un projet.
  -->
  <meta charset="utf-8">
  <title>P_Prod</title>
  <link rel="stylesheet" href="../ressources/css/style.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
    integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
  <script src="https://kit.fontawesome.com/a3d242c9b3.js" crossorigin="anonymous"></script>
</head>

<body>

<?php
  session_start();
?>

    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-info">
        <a class="navbar-brand" href="homePage.php"><strong>ETML HyperProject</strong></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
      
        <div class="collapse navbar-collapse" id="navbarsExampleDefault">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <a class="nav-link" href="homePage.php">Accueil <span class="sr-only"></span></a>
            </li>
            <li class="nav-item active">
              <a class="nav-link" href="addProject.html">Ajouter un projet<span class="sr-only"></span></a>
            </li>
          </ul>
          <form class="form-inline my-2 my-lg-0" method="post"  action="#">
            <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search" name="searchValue">
            <button class="btn btn-dark my-2 my-sm-0" name="search" type="submit">Search</button>
          </form>
        </div>
      </nav>

  <div class="mt-4 d-flex justify-content-center pt-5">
    <form class="w-50" action="../controller/insertProject.php  " method="POST">
      <div class="form-group">
        <strong><label for="proName">Titre de projet : </label></strong>
        <input type="text" class="form-control" id="proName" name="proName" placeholder="Titre...">
      </div>
      <div class="form-group">
        <strong><label class="mt-2" for="proDescription">Description du projet : </label></strong>
        <textarea class="form-control" id="proDescription" name="proDescription" placeholder="Description..." rows="7"></textarea>
      </div>
      <div>
        <button type="submit" class="mt-2 mb-5 btn btn-primary">Créer le projet</button>
      </div>
  </div>
  <footer>
      <p class="d-flex justify-content-center">&copy; ETML, 2020</p>
      <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
  </footer>
</body>



</html>