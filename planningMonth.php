<?php
require_once("php/classes/classIncluder.php");
if (!isset($_SESSION) || $_SESSION['isConnected'] != true){
    echo "Vous n'êtes pas connecté.";
    exit();
}
if (isset($_GET['m']) && isset($_GET['y'])) {
    $numberDays = cal_days_in_month(CAL_GREGORIAN, $_GET['m'], $_GET['y']);
    $users = User::getAllUsers();
}
else {
    echo "Paramètres manquants. Veuillez indiquer un nombre de mois et d'années valides";
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Plancho - Planning</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/uikit.css" />
    <script src="js/uikit.js"></script>
    <script src="js/uikit-icons.js"></script>
</head>

<body>
<?php
    require_once("php/templates/Navbar.php");
?>

<table class="uk-table uk-table-hover uk-table-divider">
    <thead>
    <tr>
        <th></th>
        <?php
        foreach($users as $u){
            echo '<th>'. $u['username'] . '</th>';
        }
        ?>
    </tr>
    </thead>
    <tbody>
    <?php
        for ($i = 1; $i <= $numberDays; $i++) {
                echo "<tr>
                 <td>" . $i . "-" . $_GET['m'] . "-" . $_GET['y'] . "</td>
                 <td onclick='selectVacation(" . $u['id'] . ")'></td>
                </tr>";
            }
            ?>
    </tbody>
</table>

<script type="text/javascript">
    function selectVacation(idUser){
        // faire une requête ajax pour récupérer les informations concernant l'utilisateur

    }
</script>
</body>
</html>
