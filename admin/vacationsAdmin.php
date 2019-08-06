<?php
/**
 * Accueil du panel d'administration
 * Validation des utilisateurs
 * Modification des vacations
 * Ajout d'interdits
 */
$actualDir = __DIR__;
require_once "../php/classes/classIncluder.php";
var_dump( $_POST);
if (!isset($_SESSION['isConnected']) || $_SESSION['isConnected'] != true) {
    echo "Vous n'êtes pas connecté. Veuillez réessayer : <a href='../connection.php'>Connexion</a>";
    exit();
}
if (isset($_SESSION['isAdm']) && $_SESSION['isAdm'] != 1) {
    echo "Vous n'êtes pas autorisé à accéder à ce contenu. <a href='../index.php'>Accueil</a>";
    exit();
}
if (isset($_POST['deleteButton']) && $_POST['deleteButton'] != null) {
    if (Vacation::deleteVacation($_POST['deleteButton'])) {
        echo "<div class=\"uk-alert-success\" uk-alert>
                 <a class=\"uk-alert-close\" uk-close></a>
                 <p>Vacation supprimée!</p>
            </div>";
    } else {
        echo "<div class=\"uk-alert-danger\" uk-alert>
                 <a class=\"uk-alert-close\" uk-close></a>
                 <p>Echec de la suppression.</p>
            </div>";
    }
}

if (isset($_POST['newLabel']) && $_POST['newName'] && $_POST['newLabel'] != null && $_POST['newName'] != null) {
    $newVacation = new Vacation(null, $_POST['newLabel'], $_POST['newName']);
    if ($newVacation->addVacation()) {
        echo "<div class=\"uk-alert-success\" uk-alert>
                 <a class=\"uk-alert-close\" uk-close></a>
                 <p>Vacation ajoutée!</p>
            </div>";
    } else {
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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
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
        <th>Couleur</th>
        <th>Application</th>
        <th class="uk-width-large"></th>
    </tr>
    </thead>


    <tbody id="rewrite">
    <?php
    foreach ($vacationsInfos as $v) {
        echo '<tr id="' . $v['id'] . '"><form id="form' . $v['id'] . '" method="post" name="updateVacation">
                  <td>' . $v['id'] . '<input type="hidden" id="idVac" value="' . $v['label'] . '"></td>
                  <td>' . $v['label'] . '<input type="hidden" id="labelVac" value="' . $v['label'] . '"></td>
                  <td>' . $v['name'] . '<input type="hidden" id="nameVac" value="' . $v['name'] . '"></td>
                  <td>' . $v['color'] . '<input type="hidden" id="colorVac" value="' . $v['color'] . '"></td>
                  <td>' . $v['application'] . '<input type="hidden" id="applicationVac" value="' . $v['application'] . '"></td>
                  
                  <td><input class="uk-button uk-button-secondary" type="hidden" id="updateVac" onclick="validationUpdate(' . $v['id'] . ')" value="Valider">
                    <div class="uk-button uk-button-secondary" id="editVac" onclick="vacationEditForm(' . $v['id'] . ')">Modifier</div>
                    <button class="uk-button uk-button-danger" name="deleteButton" type="submit" value="' . $v['id'] . '" form="deleteVacation">SUPPRIMER</button>
                  </td>
           </form></tr>';
    }
    ?>
    </tbody>
</table>

<form action="" method="post" name="deleteVacation" id="deleteVacation"></form>

<h3 class="uk-h3 uk-text-center">Ajouter une vacation</h3>
<form action="" method="post" class="uk-text-center">
    <div class="uk-margin">
        <div class="uk-inline">
            <input class="uk-input" type="text" name="newLabel" placeholder="Label de Vacation">
        </div>
    </div>

    <div class="uk-margin">
        <div class="uk-inline">
            <input class="uk-input" type="text" name="newName" placeholder="Nom de Vacation">
        </div>
    </div>

    <div class="uk-margin">
        <div class="uk-inline">
            <input class="uk-input" type="text" name="newColor" placeholder="Couleur de Vacation">
        </div>
    </div>

    <label>Jours d'applications</label>

    <div class="uk-margin">
        <div class="uk-flex-inline">
            <div>
                <label for="newApplicationMonday">Lundi</label>
                <input class="uk-input" type="checkbox" name="newApplicationMonday" id="newApplicationMonday"
                       placeholder="Lundi">
            </div>
            <div>
                <label for="newApplicationTuesday">Mardi</label>
                <input class="uk-input" type="checkbox" name="newApplicationTuesday" id="newApplicationTuesday"
                       placeholder="Mardi">
            </div>
            <div>
                <label for="newApplicationWenesday">Mercredi</label>
                <input class="uk-input" type="checkbox" name="newApplicationWenesday" id="newApplicationWenesday"
                       placeholder="Mercredi">
            </div>
            <div>
                <label for="newApplicationThursday">Jeudi</label>
                <input class="uk-input" type="checkbox" name="newApplicationThursday" id="newApplicationThursday"
                       placeholder="Jeudi">
            </div>
            <div>
                <label for="newApplicationFriday">Vendredi</label>
                <input class="uk-input" type="checkbox" name="newApplicationFriday" id="newApplicationFriday"
                       placeholder="Vendredi">
            </div>
            <div>
                <label for="newApplicationSaturday">Samedi</label>
                <input class="uk-input" type="checkbox" name="newApplicationSaturday" id="newApplicationSaturday"
                       placeholder="Samedi">
            </div>
            <div>
                <label for="newApplicationSunday">Dimanche</label>
                <input class="uk-input" type="checkbox" name="newApplicationSunday" id="newApplicationSunday"
                       placeholder="Dimanche">
            </div>
        </div>
    </div>

    <div class="uk-margin">
        <div class="uk-inline">
            <input class="uk-button" type="submit">
        </div>
    </div>

</form>


</body>
<script src="../js/vacationAdmin.js"></script>
<script src="../js/uikit.js"></script>
<script src="../js/users.js"></script>
<script src="../js/uikit-icons.js"></script>
<script src="../js/jquery.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
</html>
