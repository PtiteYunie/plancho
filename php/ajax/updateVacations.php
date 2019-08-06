<?php

$actualDir = __DIR__;
require_once "../../php/classes/classIncluder.php";

if(isset($_POST['idVac'])&&isset($_POST['labelVac'])&&isset($_POST['nameVac'])&&isset($_POST['colorVac'])&&isset($_POST['application'])){
    $id=htmlspecialchars($_POST['idVac']);
    $label=htmlspecialchars($_POST['labelVac']);
    $name=htmlspecialchars($_POST['nameVac']);
    $color=htmlspecialchars($_POST['colorVac']);
    $application=htmlspecialchars($_POST['applicationVac']);

    Vacation::editLabel($id,$label);
    Vacation::editName($id,$name);
    Vacation::editColor($id,$color);
    Vacation::editApplication($id,$application);
}


