<?php
/**
Accueil du panel d'administration
 * Validation des utilisateurs
 * Modification des vacations
 * Ajout d'interdits
 */
require_once("../php/classes/classIncluder.php");

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
<h1 style="text-align: center;" class="uk-align-center">Administration</h1>
<h2><a href="vacationsAdmin.php">Vacations</a></h2>
<h2><a href="forbiddenAdmin.php">Interdits</a></h2>
<h2><a href="usersAdmin.php">Utilisateurs</a></h2>
<h2><a href="requestsAdmin.php">Requests</a></h2>
</body>
<script src="../js/uikit.js"></script>
<script src="../js/uikit-icons.js"></script>
<script src="../js/jquery.js"></script>
</html>
