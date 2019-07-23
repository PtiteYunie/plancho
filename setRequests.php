<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 19/07/2019
 * Time: 15:48
 */

require_once("php/classes/classIncluder.php");

if(isset($_POST['type']) && isset($_POST['idUser']) && isset($_POST['date'])){
    // TODO : Rajouter des checks pour vérifier si les informations envoyées sont correctement formatées
    switch ($_POST['type']){
        case "J1":
            $type = 1;
            break;
        case "J2":
            $type = 2;
            break;
        case "N":
            $type = 3;
            break;
        case "Section":
            $type = 4;
            break;
        default:
            echo "Paramètres manquants";
            exit();
    }
    $database = Database::getDatabaseConnection();

    $add = $database->prepare("INSERT INTO planning (idUser, idVacation, date) VALUES (?, ?, ?)");
    if($add->execute(array($_POST['user'], $type, $_POST['date']))){
        return true;
    }
    else {
        return false;
    }
}
else {
    echo "Paramètres manquants";
    exit();
}

