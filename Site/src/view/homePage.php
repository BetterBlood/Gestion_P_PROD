<?php
    include "../model/Database.php";

    $database = new Database();

    $projects = $database->getAllProjects(); //TODO : voir ptetre pour faire une limit et du coup plusieurs pages (virtuelle)
    //var_dump($projects);
?>
<head>

</head>

<body>
    <header>
        <h1>Gestion des projets P_PROD</h1>

        <a href="..\view\addProject.html">Ajouter un projet</a>
        <a href="..\view\homePage.php?archive=true">Projets archivés</a>

        <form id="formLogin" action="login.php" méthode="post">
            <input type="text" id="pseudo" name="pseudo" placeholder="Login">
            <br>
            <input type="password" id="password" name="password" placeholder="Password">
        </form>
        <button type="submit" form="formLogin" value="Submit">Se connecter</button>

    </header>

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

        <div class="container">
            <table>
                <thead>
                    <tr>
                        <th>Date de début</th>
                        <th>Nom</th>
                        <th>Description</th>
                        <th>Enseignants [Initiateur, Coordinateur]</th>
                        <th>Élèves</th>
                    </tr>
                </thead>
                <tbody>
                    
                    <?php
                        foreach($projects as $project)
                        {
                            echo '<tr>';
                            
                            echo '<td>' . $project["proStartingDate"] . '</td>';
                            echo '<td onclick="location.href=' . '\'details.php?idProject=' . $project["idProject"] .'\'"><strong>' . $project["proName"] . '</strong></td>';
                            echo '<td>' . $project["proDescription"] . '</td>';

                            // TODO : rechercher dans la table des prof les ids ci-dessous et les affichers, 
                            echo '<td>' . $project["idInitiator"] . ', ' . $project["idCoordinator"] . '</td>';

                            // TODO : vérifier si des élèves sont attribué si oui les afficher sinon afficher :"aucun élèves assignés"
                            echo '<td>prendre le belong ayant l\'idProjet : ' . $project["idProject"] . '</td>';
                            
                            echo '</tr>';
                        }
                    ?>

                </tbody>
            </table>
        </div>
    
</body>
<footer>

</footer>