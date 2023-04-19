<?php

require_once('./classes/Gobelin.php');
require_once('./classes/DarkKnight.php');

require_once ('functions.php');

if (!isset($_SESSION['user'])) {
    header('LocationL login.php');
}

if (!isset($_SESSION['perso'])){
    header('Location: persos.php');
}

if (!isset($_SESSION['fight']))
{
    $nb = random_int(0,1);

    if ($nb >= 8){
        $ennemi = new Gobelin();
    } else {
        $ennemi = new DarkKnight();
    }
    $_SESSION['fight']['ennemi'] = $ennemi;
    $_SESSION['fight']['html'][] = "Vous tomber sur un " .$ennemi->name . '.';
}

if ($_SESSION['fight']['ennemi']->speed > $_SESSION['perso']['vit']){
    $_SESSION['fight']['html'][]= $_SESSION['fight']['ennemi']->name . ' tape en premier';

} else {
    $_SESSION['fight']['html'][]= $_SESSION['perso']['name'] . ' tape en premier';

    $touche = random_int(0,20);
    $_SESSION['fight']['html'][] = touche;
    if(touche >= 10) {
        $_SESSION['fight']['html'][]= "Vous touchez votre ennemi.";
        $degat = random_int(0,10) + ($_SESSION['perso']['power']/3);
        $_SESSION['fight']['html'] = $degat;
        $_SESSION['fight']['ennemi']->pol .= $degat;

        

    } else {
        $_SESSION['fight']['html'][] = "Vous ratez votre ennemi.";
    }
}

require_once('_header.php');
?>
 <div class="container">
        <div class="row mt-4">
            <div class="px-4">
                <?php require_once('_perso.php'); ?>
            </div>
            <div class="">
                <h1>Combat</h1>

<?php
foreach ($_SESSION['fight']['html'] as $html) {
    echo '<p>' .$html. '</p>';
}
?>



<a class="btn btn-green" href="donjon_fight.php?id=<?php echo $_GET['id']; ?>"> Attaquer </a>
<a class="btn btn-blue" href="donjon_play.php?id=<?php echo $_GET['id']; ?>"> Fuir </a>

   </div>
   <div class="px-4">
    <?php require_once('_ennemi.php'); ?>

   </div>
      </div>
          </div>
   </body>
</html>