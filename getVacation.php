<?php

// var_dump($_POST);
require_once("php/classes/classIncluder.php");
 $return = Planning::getDayPlanning(date("Y",strtotime($_POST['date'])), date("m",strtotime($_POST['date'])), date("d",strtotime($_POST['date'])), $_POST['idUser']);

echo $return;