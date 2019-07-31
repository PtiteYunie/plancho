<?php
require_once('../classes/classIncluder.php');

if (isset($_POST['input']) && strlen($_POST['input']) > 0){
    $getUser = User::getUserByNames($_POST['input'] . "%");
    echo json_encode($getUser);

} else {
    return '0';
}