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

if (!isset($_SESSION['selected_equipment'])) {
    $_SESSION['selected_equipment'] = array();
}
require_once('_header.php'); 

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $equipment = $_POST["equipment"];

    if (!empty($equipment)) {
        if (in_array($equipment, $_SESSION['selected_equipment'])) {
            $_SESSION['equipement_deja_choisi'] = "Équipement déjà visionné.";
        } else {
            if ($_POST['action'] === "Acheter") {
                // Vérification du prix de l'équipement
                $price = 0;
                switch ($equipment) {
                    case "Gants de boxe":
                        $price = 50;
                        break;
                    case "Bandages de boxe":
                        $price = 20;
                        break;
                    case "Protège-dent":
                        $price = 10;
                        break;
                    case "Bouteille d'eau":
                        $price = 5;
                        break;
                    case "Corde à sauter":
                        $price = 15;
                        break;
                    case "Protège-tibias":
                        $price = 30;
                        break;
                }

                // Vérification du solde d'or de l'utilisateur depuis la base de données
                $bdd = connect();
                $userId = $_SESSION['user']['id'];
                $sql = "SELECT gold FROM persos WHERE user_id = :user_id";
                $sth = $bdd->prepare($sql);
                $sth->execute([
                    'user_id' => $userId
                ]);
                $persos = $sth->fetchAll();

                $gold = $persos[0]['gold'];

                if ($gold >= $price) {
                    // Achat de l'équipement et mise à jour de la base de données
                    $newGold = $gold - $price;
                    $sql = "UPDATE persos SET `gold` = :gold WHERE user_id = :user_id";
                    $sth = $bdd->prepare($sql);
                    $sth->execute([
                        'gold' => $newGold,
                        'user_id' => $userId
                    ]);

                    $_SESSION['selected_equipment'][] = $equipment;
                    echo "Vous avez réussi à acheter l'équipement : " . $equipment . " au prix de " . $price . " gold.";
                } else {
                    echo "Vous n'avez pas assez d'or pour acheter cet équipement.";
                }
            } elseif ($_POST['action'] === "Visionner") {
                if (in_array($equipment, $_SESSION['selected_equipment'])) {
                    echo "Équipement déjà visionné.";
                } else {
                    $_SESSION['selected_equipment'][] = $equipment;
                    echo "Vous visionnez l'équipement : " . $equipment;
                }
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
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


<body>
    <br>
    <form action="" method="POST">
       <div class="equipment-container">
            <label for="equipment-select">Sélectionnez votre équipement :</label>
            <select name="equipment" id="equipment-select">
                <option value="">-- Choisissez un équipement --</option>
                <option value="Gants de boxe">Gants de boxe (50 or)</option>
                <option value="Bandages de boxe">Bandages de boxe (20 or)</option>
                <option value="Protège-dent">Protège-dent (10 or)</option>
                <option value="Bouteille d'eau">Bouteille d'eau (5 or)</option>
                <option value="Corde à sauter">Corde à sauter (15 or)</option>
                <option value="Protège-tibias">Protège-tibias (30 or)</option>
            </select>
            <input class="btn btn-game" type="submit" name="action" value="Acheter">
            <input class="btn btn-game" type="submit" name="action" value="Visionner">
        </div>
    </form>
    <br>
    <a class="btn btn-game" href="donjons.php" class="btn">Retour</a>
    <div style="text-transform: uppercase; color: orange; text-align: left; margin-left: 0%; margin-right: auto; font-size: 30px;font-weight: 900; position: absolute; left: 10px; top: 50%; transform: translateY(-50%);">
        MALHEUREUSEMENT <br>
        VOUS N'AVEZ PAS <br>
        LE DROIT <br>
        DE RÉCUPÉRER SES <br>
        ÉQUIPEMENTS <br>
        A PART SI <br>
        VOUS LES <br>
        ACHETER
    </div>

    <div style="float: right;">
        <?php
        if (!empty($_SESSION['selected_equipment'])) {
            echo "<h3>Équipements à visualiser :</h3>";
            foreach ($_SESSION['selected_equipment'] as $equipement) {
                echo "<p>Vous visualisez l'équipement : $equipement</p>";
                if ($equipement === "Gants de boxe") {
                    echo '<img src="img/gants.png" alt="Gants de boxe" style="max-width: 30%; max-height: 30%;">';
                }
                if ($equipement === "Bandages de boxe") {
                    echo '<img src="img/bandage.png" alt="Bandages de boxe" style="max-width: 30%; max-height: 30%;">';
                }
                if ($equipement === "Protège-dent") {
                    echo '<img src="img/dent.png" alt="Protège-dent" style="max-width: 30%; max-height: 30%;">';
                }
                if ($equipement === "Bouteille d'eau") {
                    echo '<img src="img/bouteille.png" alt="Bouteille d\'eau" style="max-width: 30%; max-height: 30%;">';
                }
                if ($equipement === "Corde à sauter") {
                    echo '<img src="img/corde.png" alt="Corde à sauter" style="max-width: 30%; max-height: 30%;">';
                }
                if ($equipement === "Protège-tibias") {
                    echo '<img src="img/tibias.png" alt="Protège-tibias" style="max-width: 30%; max-height: 30%;">';
                }
            }
            if (isset($_SESSION['equipement_deja_choisi'])) {
                echo "<p>" . $_SESSION['equipement_deja_choisi'] . "</p>";
                unset($_SESSION['equipement_deja_choisi']);
            }
        }
        ?>
    </div>
    <div>
    <?php
    $bdd = connect();
    $userId = $_SESSION['user']['id'];
    $sql = "SELECT gold FROM persos WHERE user_id = :user_id";
    $sth = $bdd->prepare($sql);
    $sth->execute([
        'user_id' => $userId
    ]);
    $persos = $sth->fetchAll();

    $gold = $persos[0]['gold'];
    echo "Nombre de gold : " . $gold;
    ?>
    </div>
</body>

</html>
