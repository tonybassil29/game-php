<?php
require_once("functions.php");
  if (!isset($_SESSION['user'])) {
    header('Location: login.php');
}
$bdd = connect();

$sql="SELECT * FROM persos WHERE  user_id=:user_id;";

$sth = $bdd->prepare($sql);

$sth->execute([
  
    'user_id'   => $_SESSION['user']['id']

]);

$persos = $sth ->fetchAll();



    $levelup = false;

    
    $levelXP = 15;
    
    $xp = $_SESSION['perso']['xp'];
    $level = $_SESSION['perso']['level'];
    
    while ($xp >= $levelXP && $levelXP <= 100) {
        $level++;
        $xp -= $levelXP;
        $levelup = true;
    }
    
    $_SESSION['perso']['level'] = $level;
    $_SESSION['perso']['xp'] = $xp;
    
    if ($levelup) {
        if ($level === 100) {
            echo "Félicitations ! Vous avez atteint le niveau maximum et avez terminé le jeu.";
        } else {
            echo '<span style="font-size: 18px; font-weight: bold;">Level up! Nouveau niveau : ' . $_SESSION['perso']['level'] . '</span>';

        }
    }

    if ($levelup) {
 
        $bdd = connect();
        $sql = "UPDATE persos SET `level` = :level, `xp` = :xp WHERE id = :id AND user_id = :user_id;";    
        $sth = $bdd->prepare($sql);

        $sth->execute([
            'level'      => $_SESSION['perso']['level'],
            'xp'      => $_SESSION['perso']['xp'],
            'id'        => $_SESSION['perso']['id'],
            'user_id'   => $_SESSION['user']['id']
        ]);
    }
 
            
?>