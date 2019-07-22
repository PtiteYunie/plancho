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
    if (Vacation::deleteVacation($_POST['deleteButton'])){
        echo "<div class=\"uk-alert-success\" uk-alert>
                 <a class=\"uk-alert-close\" uk-close></a>
                 <p>Vacation supprimée!</p>
            </div>";
    }
    else {
        echo "<div class=\"uk-alert-danger\" uk-alert>
                 <a class=\"uk-alert-close\" uk-close></a>
                 <p>Echec de la suppression.</p>
            </div>";
    }
}

if (isset($_POST['newLabel']) && $_POST['newName'] && $_POST['newLabel'] != NULL && $_POST['newName'] != NULL){
    $newVacation = new Vacation(NULL, $_POST['newLabel'], $_POST['newName']);
    if($newVacation->addVacation()){
        echo "<div class=\"uk-alert-success\" uk-alert>
                 <a class=\"uk-alert-close\" uk-close></a>
                 <p>Vacation ajoutée!</p>
            </div>";
    }
    else {
        echo "<div class=\"uk-alert-danger\" uk-alert>
                 <a class=\"uk-alert-close\" uk-close></a>
                 <p>Echec de l'ajout.</p>
            </div>";
    }
}
$vacationsInfos = Vacation::getAllVacations();

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
<h1 style="text-align: center;" class="uk-align-center">Gestion des vacations</h1>

<table class="uk-table uk-table-striped uk-table-hover uk-table-large">
    <thead>
    <tr>
        <th>Id</th>
        <th>Label</th>
        <th>Nom</th>
        <th class="uk-width-large"></th>
    </tr>
    </thead>


    <tbody id="rewrite">
    <?php
    foreach($vacationsInfos as $v){
        echo '<tr onclick="vacationEditForm(vac'.$v['id'].')" id="usr'.$v['id'].'">
                  <td>' . $v['id'] . '</td>
                  <td>' . $v['label'] . '</td>
                  <td>' . $v['name'] . '</td>
                  <td><button class="uk-button uk-button-danger" name="deleteButton" type="submit" value="'. $v['id'] . '" form="deleteVacation">SUPPRIMER</button></td>
                  </tr>';
    }
    ?>
    </tbody>
</table>

<form action="" method="post" name="deleteVacation" id="deleteVacation"></form>

<h3 class="uk-h3 uk-text-center">Ajouter une vacation</h3>
<form action="" method="post" class="uk-text-center">
    <div class="uk-margin">
        <div class="uk-inline">
            <input class="uk-input" type="text" name="newLabel" placeholder="Label de vacation">
        </div>
    </div>

    <div class="uk-margin">
        <div class="uk-inline">
            <input class="uk-input" type="text" name="newName" placeholder="Nom de Vacation">
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
