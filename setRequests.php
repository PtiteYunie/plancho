<?php

var_dump($_POST);
var_dump($_SESSION);

if(isset($_POST['type'])==true&&isset($_POST['idUser'])==true&&isset($_POST['date'])){
    //Select id vac et associer nom vac a son id
    //Récupérer l'id utilisateur
    $request = new Request(NULL, $_POST['idUser'],$_POST['date'],$_POST['idVac']);
}
