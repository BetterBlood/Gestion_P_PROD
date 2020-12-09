<!doctype html>
<html lang="fr-ch">

<head>
  <!--
    Auteurs : Julien Leresche, Jeremiah Steiner et Ricardo Delgado Miranda
    Date : 25.11.2020
    Description : Page d'accueil du site
  -->
  <meta charset="utf-8">
  <title>P_Prod</title>
  <link rel="stylesheet" href="../ressources/css/style.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
  <script src="https://kit.fontawesome.com/a3d242c9b3.js" crossorigin="anonymous"></script>
</head>

<body>

  <header>
    <h1>Gestion des projets P_PROD</h1>

    <a href="..\view\addProject.html">Ajouter un projet</a>
    <a href="..\controller\home.php?archive=true">Projets archivés</a>

    <form id="formLogin" action="login.php" méthode="post">
        <input type="text" id="pseudo" name="pseudo" placeholder="Login">
        <br>
        <input type="password" id="password" name="password" placeholder="Password">
    </form>
    <button type="submit" form="formLogin" value="Submit">Se connecter</button>

  </header>
        <div class="container">
            <table classe="table table-striped">
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
                            $initiatorTeacher = $database->getTeacherById($project["idInitiator"]);
                            $coordinatorTeacherLastName = "aucun prof assigné";
                            $students = $database->getStudentsByProjectId($project["idProject"]);

                            if (isset($project["idCoordinator"]))
                            {
                                $coordinatorTeacherLastName = $database->getTeacherById($project["idCoordinator"])["teaLastName"];
                            }

                            echo '<tr>';
                            
                            echo '<td>' . $project["proStartingDate"] . '</td>';
                            echo '<td onclick="location.href=' . '\'details.php?idProject=' . $project["idProject"] .'\'"><strong>' . $project["proName"] . '</strong></td>';
                            echo '<td>' . $project["proDescription"] . '</td>';

                            // TODO : rechercher dans la table des prof les ids ci-dessous et les affichers, 
                            echo '<td>' . $initiatorTeacher["teaLastName"] . ', ' . $coordinatorTeacherLastName. '</td>';

                            // TODO : vérifier si des élèves sont attribué si oui les afficher sinon afficher :"aucun élèves assignés"
                            echo '<td>';
                                if(count($students) == 0)
                                {
                                    echo "aucun élève assigné.";
                                }
                                else 
                                {
                                    $i = 0;

                                    foreach($students as $student)
                                    {
                                        if ($i < count($students) - 1)
                                        {
                                            echo $student["stuLastName"] . ", ";
                                        }
                                        else
                                        {
                                            echo $student["stuLastName"];
                                        }
                                        $i++;
                                    }
                                }

                                
                            echo '</td>';
                            echo '</tr>';
                        }
                    ?>

                </tbody>
            </table>
        </div>

</body>

<footer>
</footer>

</html>