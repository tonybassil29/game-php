<h2><?php echo $_SESSION['fight']['ennemi']->name; ?></h2>
<div>
    <b>Point de vie:</b> <?php echo $_SESSION['fight']['ennemi']->pol; ?>
    <?php
    $pourcentage = $_SESSION['fight']['ennemi']->pol;
    ?>
    <div class="barre-vie">
        <div class="barre-vie-progress" style="width: <?php echo $pourcentage; ?>%;"></div>
    </div>
</div>
<div>
    <b>XP:</b> <?php echo $_SESSION['fight']['ennemi']->xp; ?>
</div>
<div>
    <b>Or:</b> <?php echo $_SESSION['fight']['ennemi']->gold; ?>
</div>
<div>
    <b>Force:</b> <?php echo $_SESSION['fight']['ennemi']->power; ?>
</div>
<div>
    <b>Constitution:</b> <?php echo $_SESSION['fight']['ennemi']->constitution; ?>
</div>
<div>
    <b>Vitesse:</b> <?php echo $_SESSION['fight']['ennemi']->speed; ?>
</div>