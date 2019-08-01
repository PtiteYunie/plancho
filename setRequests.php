<?php
require_once "php/classes/classIncluder.php";


if (isset($_POST['vac']) == true && isset($_POST['idUser']) == true && isset($_POST['date'])) {
    $vac = $_POST['vac'];
    $idUser = $_POST['idUser'];
    $date = $_POST['date'];

    if (Request::checkRequestExistance($idUser, $date, $vac)) {
        echo "Request Existante";
    } else {
        $request = new Request(null, $idUser, $date, $vac);
        $request->addRequest();
    }

}
