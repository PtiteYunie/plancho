<?php
/* Afficher le planning ici */
require_once("php/classes/classIncluder.php");
if (!isset($_SESSION) || $_SESSION['isConnected'] != true){
    echo "Accès interdit";
}



?>

<!DOCTYPE html>
<html>
<head>
    <title>Planning - Plancho</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/uikit.css" />
    <script src="js/uikit.js"></script>
    <script src="js/uikit-icons.js"></script>
</head>

<body>

<?php
$p = new Planning();
$p->getMonthPlanning();
?>






</body>
<script src="js/planning.js">
</script>
</html>