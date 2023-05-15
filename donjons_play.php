<?php

    require_once('functions.php');

    if (!isset($_SESSION['user'])) {
        header('Location: login.php');
    }

    if (!isset($_SESSION['perso'])) {
        header('Location: persos.php');
    }

    if (isset($_SESSION['fight'])){
        unset($_SESSION['fight']);
    }

    $bdd = connect();

    $sql= "SELECT * FROM `rooms` WHERE donjon_id = :donjon_id ORDER BY RAND() LIMIT 1;";

    $sth = $bdd->prepare($sql);

    $sth->execute([
        'donjon_id' => $_GET['id']
    ]);

    $room = $sth->fetch();

    require_once('./classes/Room.php');
    $roomObject = new Room($room);
    $roomObject->makeAction();
?>


<style>
    body {
        background-image: url(img/fondbox.jpg);
        background-size: cover;
        background-position: center center;
        background-repeat: no-repeat;
    }
</style>
<?php require_once('_header.php'); ?>
    <div class="container_fight">
        <div class="row mt-4">
            <div class="px-4">
                <?php require_once('_perso.php'); ?>
            </div>
            <div class="display">
                
                <h1 class=""><?php echo $roomObject->getName(); ?></h1>
                <p class= ""><?php echo $roomObject->getDescription(); ?></p>
                <?php echo $roomObject->getHTML(); ?>
                <br><br><br>
                
            </div>
        </div>
    </div>
   
    <br>
    
    </body>
</html>

