<?php
/**
Accueil du panel d'administration
 * Validation des utilisateurs
 * Modification des vacations
 * Ajout d'interdits
 */
require_once("../php/classes/classIncluder.php");

if (!isset($_SESSION['isConnected']) || $_SESSION['isConnected'] != true){
    echo "Vous n'êtes pas connecté. Veuillez réessayer : <a href='../connection.php'>Connexion</a>";
    exit();
}
if (isset($_SESSION['isAdm']) && $_SESSION['isAdm'] != 1){
    echo "Vous n'êtes pas autorisé à accéder à ce contenu. <a href='../index.php'>Accueil</a>";
    exit();
}
if (isset($_POST['deleteButton']) && $_POST['deleteButton'] != null){
    if (deleteForbidden($_POST['deleteButton'])){
        echo "<div class=\"uk-alert-success\" uk-alert>
                 <a class=\"uk-alert-close\" uk-close></a>
                 <p>Interdiction supprimée!</p>
            </div>";
    }
    else {
        echo "<div class=\"uk-alert-danger\" uk-alert>
                 <a class=\"uk-alert-close\" uk-close></a>
                 <p>Echec de la suppression.</p>
            </div>";
    }
}
if (isset($_POST['day1']) && $_POST['day2'] && $_POST['day1'] != NULL && $_POST['day2'] != NULL){
    if(addForbidden($_POST['day1'], $_POST['day2'])){
        echo "<div class=\"uk-alert-success\" uk-alert>
                 <a class=\"uk-alert-close\" uk-close></a>
                 <p>Interdiction ajoutée!</p>
            </div>";
    }
    else {
        echo "<div class=\"uk-alert-danger\" uk-alert>
                 <a class=\"uk-alert-close\" uk-close></a>
                 <p>Echec de l'ajout.</p>
            </div>";
    }
}
$forbiddenInfos = getAllForbidden();

function getAllForbidden(){
    $database = Database::getDatabaseConnection();
    $get = $database->prepare("SELECT * FROM forbidden");

    if($get->execute()){
        return $get->fetchAll(PDO::FETCH_ASSOC);
    }
    else {
        return false;
    }
}
function addForbidden($day1, $day2){
    $database = Database::getDatabaseConnection();
    $add = $database->prepare("INSERT INTO forbidden (day1, day2) VALUES (?, ?)");

    if ($add->execute(array($day1, $day2))){
        return true;
    }
    else {
        return false;
    }
}
function deleteForbidden($id){
    $database = Database::getDatabaseConnection();

    $delete = $database->prepare("DELETE FROM forbidden WHERE id = ?");
    if ($delete->execute(array($id))){
        return true;
    }
    else {
        return false;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Administration - Plancho</title>
    <meta charset="utf-8"/>
    <link rel="stylesheet" type="text/css" href="../css/uikit.css">
</head>
<body>
<?php require_once("../php/templates/Navbar.php"); ?>
<h1 style="text-align: center;" class="uk-align-center">Gestion des interdits</h1>

<table class="uk-table uk-table-striped uk-table-hover uk-table-large">
    <thead>
    <tr>
        <th>Id</th>
        <th>Jour 1</th>
        <th>Jour 2</th>
        <th class="uk-width-large"></th>
    </tr>
    </thead>


    <tbody id="rewrite">
    <?php
    foreach($forbiddenInfos as $f){
        echo '<tr onclick="forbiddenEditForm(vac'.$f['id'].')" id="for'.$f['id'].'">
                  <td>' . $f['id'] . '</td>
                  <td>' . Vacation::getVacationById($f['day1'])["label"] . '</td>
                  <td>' . Vacation::getVacationById($f['day2'])["label"] . '</td>
                  <td><button class="uk-button uk-button-danger" name="deleteButton" type="submit" value="'. $f['id'] . '" form="deleteForbidden">SUPPRIMER</button></td>
                  </tr>';
    }
    ?>
    </tbody>
</table>

<form action="" method="post" name="deleteForbidden" id="deleteForbidden"></form>

<h3 class="uk-h3 uk-text-center">Ajouter une interdiction</h3>
<form action="" method="post" class="uk-text-center">
    <div class="uk-margin">
        <div class="uk-inline">
            <select class="uk-select" name="day1" placeholder="Jour 1">
                <?php foreach(Vacation::getAllVacations() as $v){
                    echo "<option value='". $v['id'] . "'>" . $v['label'] . "</option>";
                }
                ?>
            </select>
        </div>
    </div>

    <div class="uk-margin">
        <div class="uk-inline">
            <select class="uk-select" name="day2" placeholder="Jour 2">
                <?php foreach(Vacation::getAllVacations() as $v){
                    echo "<option value='". $v['id'] . "'>" . $v['label'] . "</option>";
                }
                ?>
            </select>
        </div>
    </div>

    <div class="uk-margin">
        <div class="uk-inline">
            <input class="uk-button" type="submit">
        </div>
    </div>

</form>


</body>
<script src="../js/uikit.js"></script>
<script src="../js/users.js"></script>
<script src="../js/uikit-icons.js"></script>
<script src="../js/jquery.js"></script>
</html>
