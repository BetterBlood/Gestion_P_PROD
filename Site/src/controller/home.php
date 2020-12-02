<?php
    include "../model/Database.php";

    $database = new Database();

    $projects = $database->getAllProjects();
    //var_dump($projects);
?>

<h1>Gestion des projets P_PROD</h1>
<a href="">Ajouter un projet</a>
<a href="">Projets archivés</a>

<form id="formLogin" action="login.php" méthode="post">
    <input type="text" id="pseudo" name="pseudo" placeholder="Login">
    <br>
    <input type="password" id="password" name="password" placeholder="Password">
</form>
<button type="submit" form="formLogin" value="Submit">Se connecter</button>

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
                echo '<td>' . $project["proName"] . '</td>';
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