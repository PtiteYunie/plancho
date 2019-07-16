<?php
require_once("php/classes/classIncluder.php");
if (!isset($_SESSION) || $_SESSION['isConnected'] != true){
    echo "Vous n'êtes pas connecté.";
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
$p = Planning::getCurrentPlanning();
$g = Planning::getMonthPlanning(7);

var_dump($g);
?>
</body>
</html>
