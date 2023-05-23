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

// Vérifier si le bouton de réanimation a été cliqué
if (isset($_POST['reanimer'])) {
    if ($_SESSION['perso']['pdv'] <= 0) {
        if ($_SESSION['perso']['reanimations'] < 2) {
            $_SESSION['perso']['pdv'] = 25;
            $_SESSION['perso']['reanimations']++;
            header('Location: persos.php?msg=Réanimation réussie');
            exit;
        } else {
            header('Location: persos_add.php?msg=Vous ne pouvez pas vous réanimer plus de deux fois.');
            exit;
        }
    } else {
        // Rediriger vers une page appropriée si le personnage a encore de la vie
        header('Location: persos_add.php');
        exit;
    }
}

$bdd = connect();
$sql = "UPDATE persos SET `pdv` = :pdv, `gold` = :gold, `level` = :level, `reanimations` = :reanimations WHERE id = :id AND user_id = :user_id;";
$sth = $bdd->prepare($sql);

$sth->execute([
    'pdv' => 25,
    'gold' => 100,
    'level' => 0,
    'reanimations' => $_SESSION['perso']['reanimations']+1,
    'id' => $_SESSION['perso']['id'],
    'user_id' => $_SESSION['user']['id']
]);
require_once('./classes/Room.php');
?>

<!DOCTYPE html>
<html>
<head>
    <title>Réanimation du personnage</title>
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
</head>
<body>
<?php require_once('_header.php'); ?>
<div class="container_reanimer">
    <h1 class="h1_reanimer">Réanimation du personnage</h1>
    <p class="p_reanimer">La vie de votre personnage est : <?php echo $_SESSION['perso']['pdv']; ?></p>

    <?php if ($_SESSION['perso']['pdv'] <= 0): ?>
        <?php if ($_SESSION['perso']['reanimations'] < 2): ?>
            <form class="form_reanimer" method="post" action="">
                <button class="btn btn-reanimer" type="submit" name="reanimer">Réanimer</button>
            </form>
        <?php else: ?>
            <p>Vous ne pouvez pas vous réanimer plus de deux fois.</p>
        <?php endif; ?>
    <?php else: ?>
        <p>Votre personnage est déjà en vie.</p>
    <?php endif; ?>
    <br>
    <a href="donjons.php" class="btn btn-reanimer">Retour</a>
</div>
</body>
</html>
