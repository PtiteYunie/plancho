<?php
require_once "php/classes/classIncluder.php";

var_dump($_POST);
var_dump($_SESSION);

if (isset($_POST['vac']) == true && isset($_POST['idUser']) == true && isset($_POST['date'])) {
    //Récupérer l'id utilisateur
    $idUser = $_POST['idUser'];

    //date
    $_POST['date'];
    $newDate = explode('-', $_POST['date']);
    $date = $newDate[2] . "-" . $newDate[1] . '-' . $newDate[0];
    var_dump($date);
    $request = new Request(null, $idUser, $date, $_POST['vac']);
    var_dump($request->addRequest());
}