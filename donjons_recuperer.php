<?php
require_once('functions.php');

if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}

if (!isset($_SESSION['perso'])) {
    header('Location: persos.php');
    exit;
}
require_once('_header.php'); 
$idEquipement = $_SESSION['perso']['id_equipement'];

$bdd = connect();

$sql = "SELECT id_equipement, equipements, picture FROM equipement WHERE id_equipement = :idEquipement";

$sth = $bdd->prepare($sql);
$sth->execute(array(':idEquipement' => $idEquipement));

$results = $sth->fetchAll(PDO::FETCH_ASSOC);

if (!empty($results)) {
    echo '<div style="color: orange; text-align: center; font-size: 20px; font-weight: 900; margin-left: 12%;margin-top: 12%; transform: translateX(-50%);">';
    foreach ($results as $row) {
        echo "ID Equipement: " . $row['id_equipement'] . "<br>";
        echo "Équipement Récuperer: " . $row['equipements'] . "<br>";
        echo '<img width="200px" src="img/' . $row['picture'] . '" /><br>';
    }
    echo '</div>';
} else {
    echo "Aucun résultat trouvé dans la table 'equipement' pour l'équipement avec l'ID : " . $idEquipement;
}
?>  

<style>
    body {
        background-image: url('img/gant.jpg');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        height: 100vh;
        margin: 0;
        padding: 0;
    }

</style>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <br>
<a href="donjons.php" class="btn btn-equipement">Return</a>
</body>
</html>