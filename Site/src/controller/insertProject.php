<?php
/** 
 * Auteurs : Julien Leresche, Jeremiah Steiner et Ricardo Delgado Miranda
 * Date : 02.12.2020
 * Description : Page permettant d'insérer un projet à la db
*/

    include '../model/Database.php';
    session_start();

    $idInitiator = $_SESSION["idUser"];

    // proName
    if (!empty($_POST["proName"]) && preg_match("#^[A-Za-z-'\p{L}éüèöäà ]*$#", $_POST["proName"])) {
        $proName = htmlspecialchars($_POST['proName']);
    } else {
        $error = "Le prénom doit être renseigné sans nombres ni caractères spéciaux !";
        echo $error;
        die();
    }

    // proDescription
    if (!empty($_POST["proDescription"]) && preg_match("#^[A-Za-z0-9-'\p{L}éüèöäà ]*$#", $_POST["proDescription"])) {
        $proDescription = htmlspecialchars($_POST['proDescription']);
    } else {
        $error = "La description du projet dois être renseignée sans caractères spéciaux !";
        echo $error;
        die();
    }

    echo $proName;
    echo $proDescription;

    //insertion en db
    $database = new Database();
    $database->insertProject($proName, $proDescription, $idInitiator);

    header('Location: ../view/homePage.php')
?>