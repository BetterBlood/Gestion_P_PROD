<?php
    session_start();
    include "../model/Database.php";

    $database = new Database();

    
    
    include "../controller/functions.php";
    

    $database = new Database();
    $teachers = $database->getAllTeachers();
    $students = $database->getAllStudents();

    if (isset($_POST["login"])) {
        login("homePage.php", $teachers, $students);
    }
    if (isset($_POST["logout"])) {
        logout("homePage.php");
    }

    if (isset($_GET["id"]) && $database->projectExists($_GET["id"]) && isset($_SESSION["isConnected"]) && $_SESSION["isConnected"] == 2)
    {
        $database->archiveProjectById($_GET["id"]);
    }
    
    $projects = $database->getAllActiveProjects(); //TODO : voir ptetre pour faire une limit et du coup plusieurs pages (virtuelle) //var_dump($projects);


?>

<!doctype html>

<html lang="fr">
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
        <header>
            <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-info">
                <a class="navbar-brand" href="../../index.php"><strong>ETML HyperProject</strong></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarsExampleDefault">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="../../index.php">Accueil <span class="sr-only"></span></a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="../view/addProject.html">Ajouter un projet<span class="sr-only"></span></a>
                        </li>
                    </ul>

                    <?php
                        displayLoginSection();
                    ?>
                </div>
            </nav>
        </header>

        <div class="jumbotron">
            <div class="container">
                <h1 class="display-3 p">Gestion des projets P_PROD</h1>

                <div class="pull-right">
                    <?php
                        if (array_key_exists("isConnected", $_SESSION) && $_SESSION["isConnected"] >= 2)
                        {
                            ?>
                                <a class="btn btn-success mb-2 mr-2" href="..\view\addProject.html">Ajouter un projet</a>
                                <a class="btn btn-danger mb-2 mr-2" href="..\view\archivePage.php">Projets archivés</a>
                            <?php
                        }
                    ?>
                </div>
            
                <table class="table table-hover table-primary table-striped bg-white ">
                    <thead class="table-light" >
                        <tr onclick="location.href='#'">
                            <th class="text-center align-middle" scope="col">#</th>
                            <th class="text-center align-middle" scope="col">Date de début</th>
                            <th class="text-center align-middle" scope="col">Nom</th>
                            <th class="text-center align-middle" scope="col">Description</th>
                            <th class="text-center align-middle" scope="col">Enseignants [Initiateur, Coordinateur]</th>
                            <th class="text-center align-middle" scope="col">Élèves</th>
                            <th class="text-center align-middle" scope="col">Archive</th>
                        </tr>
                    </thead>
                    <tbody >
                        
                        <?php
                            $j = 0;

                            foreach($projects as $project)
                            {
                                $initiatorTeacher = $database->getTeacherById($project["idInitiator"]);
                                $coordinatorTeacherLastName = "aucun prof assigné";
                                $students = $database->getStudentsByProjectId($project["idProject"]);

                                if (isset($project["idCoordinator"]))
                                {
                                    $coordinatorTeacherLastName = $database->getTeacherById($project["idCoordinator"])["teaLastName"];
                                }

                                echo '<tr ';
                                if (array_key_exists("isConnected", $_SESSION) && $_SESSION["isConnected"] >= 1)
                                {
                                     echo 'onclick="location.href=' . '\'details.php?idProject=' . $project["idProject"] .'\'"';
                                }
                                echo '>';
                               
                                echo '<th scope="row">' . $j++ . '</th>';
                                
                                echo '<td>' . $project["proStartingDate"] . '</td>';
                                echo '<td><strong>' . $project["proName"] . '</strong></td>';
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

                                echo '<td><a class="btn btn-warning" href="..\view\homePage.php?id=' . $project["idProject"] . '">archiver</a></td>';
                                echo '</tr>';
                            }
                        ?>

                    </tbody>
                </table>
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