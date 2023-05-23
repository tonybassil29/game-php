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
            $_SESSION['perso']['pdv'] = 25;
            header('Location: persos.php?msg=Réanimation réussie');
            exit;
        } else {
            // Rediriger vers une page appropriée si le personnage a encore de la vie
            header('Location: persos_add.php');
            exit;
        }
    }
    $bdd = connect();
    $sql = "UPDATE persos SET `pdv` = :pdv , `gold` = :gold , `level` = :level  WHERE id = :id AND user_id = :user_id;";    
    $sth = $bdd->prepare($sql);

    $sth->execute([
    
        'pdv'       => 25,
        'gold'          =>($perso['gold']/2),
        'level'          =>0,
        'id'        => $_SESSION['perso']['id'],
        'user_id'   => $_SESSION['user']['id']
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
            <form class="form_reanimer" method="post" action="">
                <button class="btn btn-reanimer" type="submit" name="reanimer">Réanimer</button>
            </form>
        <?php else: ?>
            <p>Votre personnage est déjà en vie.</p>
        <?php endif; ?>
        <br>
        <a href="donjons.php" class="btn btn-reanimer">Return</a>
    </div>
</body>
</html>
