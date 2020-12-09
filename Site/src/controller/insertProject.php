<?php
    include '../model/Database.php';

    //controler tous les champs

    var_dump($_POST);
    //$firstName = $_POST['firstName'];
    $idInitiator = 1; // TODO : insérer par la session
    $proName = $_POST['proName'];
    $proDescription = $_POST['proDescription'];

    echo $proName;
    echo $proDescription;

    //insertion en db
    $database = new Database();
    $database->insertProject($proName, $proDescription, $idInitiator);

    header('Location: http://localhost:8080/Gestion_P_PROD/Site/src/view/homePage.php')
?>