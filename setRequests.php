<?php
require_once "php/classes/classIncluder.php";


if (isset($_POST['vac']) == true && isset($_POST['idUser']) == true && isset($_POST['date'])) {
    //Récupérer l'id utilisateur

    $idUser = $_POST['idUser'];

    $date=$_POST['date'];

    $request = new Request(null, $idUser, $date, $_POST['vac']);
    var_dump($request->addRequest());
}
