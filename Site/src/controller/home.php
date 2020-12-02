<?php
    include "../model/Database.php";

    $database = new Database();

    $projects = $database->getAllProjects();
    var_dump($projects);
?>