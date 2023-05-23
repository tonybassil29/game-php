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

if (!isset($_SESSION['previous_perso'])) {
    $_SESSION['previous_perso'] = null;
}

if ($_SESSION['perso'] != $_SESSION['previous_perso']) {
    $_SESSION['selected_equipment'] = [];
}

$_SESSION['previous_perso'] = $_SESSION['perso'];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $equipment = $_POST["equipment"];

    if (!empty($equipment)) {
        if (in_array($equipment, $_SESSION['selected_equipment'])) {
            $_SESSION['equipement_deja_choisi'] = "Équipement déjà choisi.";
        } else {
            $_SESSION['selected_equipment'][] = $equipment;
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
<?php require_once('_header.php'); ?>
    <body>
    <form action="" method="POST">
    <div class="equipment-container">
      <label for="equipment-select">Sélectionnez votre équipement :</label>
      <select name="equipment" id="equipment-select">
        <option value="">-- Choisissez un équipement --</option>
        <option value="Gants de boxe">Gants de boxe</option>
        <option value="Bandages de boxe">Bandages de boxe</option>
        <option value="Protège-dent">Protège-dent</option>
        <option value="Bouteille d'eau">Bouteille d'eau</option>
        <option value="Corde à sauter">Corde à sauter</option>
        <option value="Protège-tibias">Protège-tibias</option>
      </select>
    </div>
    <input class= "btn btn-game" type="submit" value="Visionner">
  </form>
  <br>
  <a class="btn btn-game" href="donjons.php" class="btn">Retour</a>
  <div style="text-transform: uppercase; color: orange; text-align: left; margin-left: 0%; margin-right: auto; font-size: 30px;font-weight: 900; position: absolute; left: 10px; top: 50%; transform: translateY(-50%);">
    MALHEUREUSEMENT <br>
    VOUS N'AVEZ PAS <br>
    LE DROIT <br>
    DE RÉCUPÉRER SES <br>
    ÉQUIPEMENTS
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
            echo "<p>".$_SESSION['equipement_deja_choisi']."</p>";
            unset($_SESSION['equipement_deja_choisi']);
        }
    }
    ?>
</div>


    </body>
    </html>