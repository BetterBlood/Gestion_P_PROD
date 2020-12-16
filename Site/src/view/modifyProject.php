<?php
  include "../model/Database.php";
  include "../controller/functions.php";
  session_start();

  $database = new Database();
  $project = $database->getProjectById($_GET["idProject"]);

  if (isset($_POST["login"])) {
    if(isset($_POST["username"]) && isset($_POST["password"]))
    {
      login("details.php?idProject=" . $project["idProject"], $teachers, $students);
    }
  }
  if (isset($_POST["logout"])) {
      logout("details.php?idProject=" . $project["idProject"]);
  }

  if(isset($_POST["search"]))
  {
    $teachers = $database->getSomeTeachers(addslashes($_POST["searchValue"]));
    $students = $database->getSomeStudents(addslashes($_POST["searchValue"]));
  }
  else
  {
    $teachers = $database->getAllTeachers();
    $students = $database->getAllStudents();
  }
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

      .jumbotron {
        margin-top: 1rem;
        background-color: #b4f8f8;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>
    <!-- Custom styles for this template -->

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
        <a class="nav-link" href="homePage.php">Accueil <span class="sr-only"></span></a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="printersList.php">Ajouter un projet<span class="sr-only"></span></a>
      </li>
    </ul>
    <?php
      displayLoginSection();
    ?>
  </div>
</nav>

<main role="main">

  <!-- Main jumbotron for a primary marketing message or call to action -->
  <div class="jumbotron">
    <div class="container">
      <h1 class="display-3">Modifier le projet</h1>
      <div style="padding: 30px;">
      <form action="" method="post">
      </form>
        <?php
          echo '<form class="form-inline my-2 my-lg-0" action="modifyProject.php?idProject=' . $_GET["idProject"] . '" method="post">
                  <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search" name="searchValue">
                  <button class="btn btn-primary my-2 my-sm-0" name="search" type="submit">Rechercher</button>
                </form>';
          $completeNameInitiator = makeFullName($database->getTeacherById($project["idInitiator"])["teaFirstName"], $database->getTeacherById($project["idInitiator"])["teaLastName"]);
          if(isset($project["idCoordinator"]))
          {
            $completeNameCoordinator = makeFullName($database->getTeacherById($project["idCoordinator"])["teaFirstName"], $database->getTeacherById($project["idCoordinator"])["teaLastName"]);
          }
          echo '<strong>Nom du projet : </strong><p>' . $project["proName"] . '</p>';
          echo '<strong>Description du projet : </strong><p>' . $project["proDescription"] . '</p>';
          echo '<strong>Durée du projet : </strong><p>Du ' . $project["proStartingDate"] . ' au ' . $project["proEndingDate"] . '</p>';
          if(isset($project["idCoordinator"]))
          {
            echo '<strong>Projet coordiné par : </strong><p>' . $completeNameCoordinator . '</p>';
          } else {
            echo '<strong>Projet coordiné par : </strong><p>Pas de coordinateur pour l\'instant</p>';
          }
        ?>
        <div class="form-group">
          <label for="teacherList">Liste des enseignants</label>
          <select name="teacher" id="teacherList">
            <?php
              foreach($teachers as $teacher)
              {
                echo '<option value="' . $teacher["idTeacher"] . '">' . makeFullName($teacher["teaFirstName"], $teacher["teaLastName"]) . '</option>';
              }
            ?>
          </select>
        </div>       
        <?php
          if(isset($project["idCoordinator"]))
          {
            echo '<strong>Eleves participant au projet : </strong><p> Jeremiah Steiner, Camila Djabali, Pyjus</p>';
          } else {
            echo '<strong>Projet attribué à : </strong><p>Pas d\'éleves assigné pour l\'instant</p>';
          }
        ?>
        <div class="form-group">
          <label for="studentList">Liste des éleves</label> 
          <select name="student" id="studentList">
            <?php
              foreach($students as $student)
              {
                echo '<option value="' . $student["idStudent"] . '">' . makeFullName($student["stuFirstName"], $student["stuLastName"]) . '</option>';
              }
            ?>
          </select>
        </div>
        <button class="bt btn-info btn-lg" data-toggle="modal" data-target="#modifyProject">Appliquer les modifications</button>
      </div>
      <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
      </div>
    </div>
  </div>

  <div class="modal fade" id="modifyProject" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Modifier les informations du projet</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="home.php" method="post">
            <div class="form-group">
              <label for="exampleFormControlInputFir">Enseignant coordinateur</label>
              <input type="text" class="form-control" id="exampleFormControlInputFir" name="username">
            </div>
            <div class="form-group">
              <label for="studentList">Liste des éleves</label>
              <select name="student" id="studentList">
                <?php
                  foreach($students as $student)
                  {
                    echo '<option value="' . $student["idStudent"] . '">' . makeFullName($student["stuFirstName"], $student["stuLastName"]) . '</option>';
                  }
                ?>
              </select>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
              <input type="submit" name="applyModification" class="btn btn-primary" value="Appliquer">
            </div>
          </form>
        </div>
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
        </body>

<footer class="container">
  <p>&copy; ETML, 2020</p>
</footer>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</html>