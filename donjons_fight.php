<?php

    require_once('./Classes/Boxeur2.php');
    require_once('./Classes/Boxeur3.php');
    require_once('./Classes/Boxeur4.php');
   

    require_once('functions.php');
    
  

    if (!isset($_SESSION['user'])) {
        header('Location: login.php');
    }

    if (!isset($_SESSION['perso'])) {
        header('Location: persos.php');
    }
    


    if (!isset($_SESSION['fight']))  {
       $nb = random_int(0,12); 

        if ($nb <= 4) {
            $ennemi = new Boxeur2();
        } else if ($nb <= 8) {
            $ennemi = new Boxeur4();
        } else {
            $ennemi = new Boxeur3();
        } 
        
       $_SESSION['fight']['ennemi'] = $ennemi;
       $_SESSION['fight']['html'] []= "Vous tombez sur ". $ennemi->name. '.';
       
    }
   
    if ($_SESSION['fight']['ennemi']->speed > $_SESSION['perso']['vit']) {
        $_SESSION['fight']['html'][] = $_SESSION['fight']['ennemi']->name . " tape en premier";
        $touche = random_int(0, 20);
        
        if ($touche >= 10) {
            $_SESSION['fight']['html'][] = "Il vous touche.";
            $degat = random_int(0, $_SESSION['fight']['ennemi']->power) + floor($_SESSION['fight']['ennemi']->power / 3);
            $_SESSION['fight']['html'][] = "Il vous inflige " . ($degat - floor($_SESSION['perso']['for'] / 3)) . " dégâts";
            $_SESSION['perso']['pdv'] -= $degat - floor($_SESSION['perso']['for'] / 3);
    
            if ($_SESSION['perso']['pdv'] <= 0) {
                $_SESSION['fight']['html'][] = "Vous êtes mort.";
            } else {
                $_SESSION['fight']['html'][] = "Vous attaquez";
                $touche = random_int(0, 20);
                
                if ($touche >= 10) {
                    $_SESSION['fight']['html'][] = "Vous touchez votre ennemi";
                    $degat = random_int(0, 10) + floor($_SESSION['perso']['for'] / 3);
                    $_SESSION['fight']['html'][] = "Vous lui infligez " . ($degat - floor($_SESSION['fight']['ennemi']->constitution / 3)) . " dégâts";
                    $_SESSION['fight']['ennemi']->pol -= $degat - floor($_SESSION['fight']['ennemi']->constitution / 3);
        
                    if ($_SESSION['fight']['ennemi']->pol <= 0) {
                        $_SESSION['perso']['gold'] += $_SESSION['fight']['ennemi']->gold;
                        $_SESSION['fight']['html'][] = "Vous gagnez " . $_SESSION['fight']['ennemi']->gold . " Or";
                        $_SESSION['fight']['html'][] = "Vous avez tué votre ennemi";
                        
                    }
                } else {
                    $_SESSION['fight']['html'][] = "Vous ratez votre ennemi";
                }
            }
        } else {
            $_SESSION['fight']['html'][] = "Votre ennemi vous rate.";
        }
    } else {
        $_SESSION['fight']['html'][] = $_SESSION['perso']['name'] . ' tape en premier';
        $touche = random_int(0, 20);
        
        if ($touche >= 10) {
            $_SESSION['fight']['html'][] = "Vous touchez votre ennemi.";
            $degat = random_int(0, 10) + floor($_SESSION['perso']['for'] / 3);
            $_SESSION['fight']['html'][] = "Vous lui infligez " . ($degat - floor($_SESSION['fight']['ennemi']->constitution / 3)) . " dégâts";
            $_SESSION['fight']['ennemi']->pol -= $degat - floor($_SESSION['fight']['ennemi']->constitution / 3);
    
            if ($_SESSION['fight']['ennemi']->pol <= 0) {
                $_SESSION['perso']['gold'] += $_SESSION['fight']['ennemi']->gold;
                $_SESSION['perso']['xp'] += $_SESSION['fight']['ennemi']->xp;
                $_SESSION['fight']['html'][] = "Vous gagnez " . $_SESSION['fight']['ennemi']->gold . " Or et " . $_SESSION['fight']['ennemi']->xp . " Xp.";
                $_SESSION['fight']['html'][] = "Vous avez tué votre ennemi.";
                
            } else {
                $_SESSION['fight']['html'][] = "Votre ennemi vous attaque";
                $touche = random_int(0, 20);
                
                if ($touche >= 10) {
                    $_SESSION['fight']['html'][] = "Il vous touche.";
                    $degat = random_int(0, $_SESSION['fight']['ennemi']->power) + floor($_SESSION['fight']['ennemi']->power / 3);
                    $_SESSION['fight']['html'][] = "Il vous inflige " . ($degat - floor($_SESSION['perso']['for'] / 3)) . " dégâts.";
                    $_SESSION['perso']['pdv'] -= $degat - floor($_SESSION['perso']['for'] / 3);
                } else {
                    $_SESSION['fight']['html'][] = "Votre ennemi vous rate.";
                }
            }
        } else {
            $_SESSION['fight']['html'][] = "Vous ratez votre ennemi.";
            $_SESSION['fight']['html'][] = "Votre ennemi vous attaque";
            $touche = random_int(0, 20);
            
            if ($touche >= 10) {
                $_SESSION['fight']['html'][] = "Il vous touche.";
                $degat = random_int(0, $_SESSION['fight']['ennemi']->power) + floor($_SESSION['fight']['ennemi']->power / 3);
                $_SESSION['fight']['html'][] = "Il vous inflige " . ($degat - floor($_SESSION['perso']['for'] / 3)) . " dégâts";
                $_SESSION['perso']['pdv'] -= $degat - floor($_SESSION['perso']['for'] / 3);
    
                if ($_SESSION['perso']['pdv'] <= 0) {
                    $_SESSION['fight']['html'][] = "Vous êtes mort.";
                }
            } else {
                $_SESSION['fight']['html'][] = "Votre ennemi vous rate.";
            }
        }
    }
   require_once('_header.php'); 
  require_once('level_augmente.php');
    $bdd = connect();
    $sql = "UPDATE persos SET `gold` = :gold, `pdv` = :pdv, `level` = :level, `xp` = :xp WHERE id = :id AND user_id = :user_id;";    
    $sth = $bdd->prepare($sql);

    $sth->execute([
        'gold'      => $_SESSION['perso']['gold'],
        'xp'      => $_SESSION['perso']['xp'],
        'level'      => $_SESSION['perso']['level'],
        'pdv'       => $_SESSION['perso']['pdv'],
        'id'        => $_SESSION['perso']['id'],
        'user_id'   => $_SESSION['user']['id']
    ]);
    
 
    if ($_SESSION['perso']['pdv'] <= 0) {
        
        unset($_SESSION['perso']);
        unset($_SESSION['fight']);
        header('Location: gameover.php');
    }

    ?>

<style>
    body {
        background-image: url(img/gants.jpg);
        background-size: contain;
        background-position: center center;
        background-repeat: no-repeat;
    }
</style>


   
    
    <div class="container_ennemi">
    <img class="image_ennemi" src="<?php echo $_SESSION['fight']['ennemi']->picture; ?>" alt="Image de l'ennemi">
    </div>
    <div class= "container_persos">
    <img class="image_persos" src="img/boxeurpro.png" alt="Image du personnage">
   </div>

        <div class="container_fight">
            <div class="row mt-4">
                    <div class="px-4">
                        <?php require_once('_perso.php'); ?>
                        
                    </div>
                    <div class="">
                        <h1 class="h1_2">Bataille</h1>
                        <?php
                            foreach($_SESSION['fight']['html'] as $html) {
                                echo '<div>'.$html.'</div>';
                            }
    
                        ?>
                        <?php if ($_SESSION['perso']['pdv'] > 0) { ?>
                            <?php if ($_SESSION['fight']['ennemi']->pol > 0) { ?>
                                <a class="btn btn-green" href="donjons_fight.php?id=<?php echo $_GET['id']; ?>">
                                    Attaquer
                                </a>
                                <a class="btn btn-blue" href="donjons_play.php?id=<?php echo $_GET['id']; ?>">
                                   Fuir
                                </a>
                            <?php } else { ?>
                                <a class="btn btn-green" href="donjons_play.php?id=<?php echo $_GET['id']; ?>">
                                    Continuer l'exploration
                                </a>
                            <?php } ?>
                        <?php } else { ?>
    
                           
                        <?php } ?>
                        </div>
                    
                <div class="ennemi_principe">
                    <?php require_once('_ennemi.php'); ?>
                   
                   
                </div>
                
            </div>
        </div>
       
      
        
        </body>
    </html>
