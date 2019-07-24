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
    if (User::deleteUser($_POST['deleteButton'])){
        echo "<div class=\"uk-alert-success\" uk-alert>
                 <a class=\"uk-alert-close\" uk-close></a>
                 <p>Requête supprimée!</p>
            </div>";
    }
    else {
        echo "<div class=\"uk-alert-danger\" uk-alert>
                 <a class=\"uk-alert-close\" uk-close></a>
                 <p>Echec de la suppression.</p>
            </div>";
    }
}
$today = date("Y-m-d");
$requestInfo = Request::getAllRequestsByDate()

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
<h1 style="text-align: center;" class="uk-align-center">Gestion des utilisateurs</h1>
<input type="text" name="user" class="uk-search-input" id="searchBox" placeholder="Rechercher">
<div id="typeSearch" style="visibility: hidden;" class="user"></div>

<table class="uk-table uk-table-striped uk-table-hover uk-table-large">
    <thead>
    <tr>
        <th>Prénom</th>
        <th>Nom</th>
        <th>Nom d'utilisateur</th>
        <th>Adresse mail</th>
        <th>N° Téléphone</th>
        <th>Date d'inscription</th>
        <th>Dernière connexion</th>
        <th></th>
    </tr>
    </thead>


    <tbody id="rewrite">
    <?php
    foreach($userInfos as $u){
        $user = new User(NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
        echo '<tr onclick="userEditForm(usr'.$u['id'].')" id="usr'.$u['id'].'">
                  <td>' . $u['firstName'] . '</td>
                  <td>' . $u['lastName'] . '</td>
                  <td>' . $u['username'] . '</td>
                  <td>' . $u['email'] . '</td>
                  <td>' . $u['phone'] . '</td>
                  <td>' . $u['regDate'] . '</td>
                  <td>' . $u['lastConnection'] . '</td>
                  <td><button class="uk-button uk-button-danger" name="deleteButton" type="submit" value="'. $u['id'] . '" form="deleteUser">SUPPRIMER</button></td>
                  </tr>';
    }
    ?>
    </tbody>
</table>

<form action="" method="post" name="deleteUser" id="deleteUser"></form>

</body>
<script src="../js/uikit.js"></script>
<script src="../js/users.js"></script>
<script src="../js/uikit-icons.js"></script>
<script src="../js/jquery.js"></script>
</html>
