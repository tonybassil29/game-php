<?php

    require_once('functions.php');

    if (!isset($_SESSION['user'])) {
        header('Location: login.php');
    }

    if (!isset($_SESSION['perso'])) {
        header('Location: persos.php');
    }

    $bdd = connect();

    $sql = "SELECT * FROM donjons";

    $sth = $bdd->prepare($sql);
        
    $sth->execute();

    $donjons = $sth->fetchAll();
?>
<?php require_once('_header.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/donjons.css">
    <title>Document</title>
</head>
<body>

    <div class="container">
        <?php echo  $_SESSION['perso']['name']; ?>
        <br><br> <a href="persos.php">Changer</a>
        <ul>
            <?php foreach($donjons as $donjon) { ?>
                <li><a href="donjons_play.php?id=<?php echo $donjon['id']; ?>">
                    <?php echo $donjon['name']; ?>
                </a></li>
            <?php } ?>
        </ul>
    </div>
</body>
</html>

