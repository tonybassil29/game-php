<h2 class="mt-6"><?php echo $_SESSION['perso']['name']; ?></h2>
<div class="mt-6">

  <b>Point de vie:</b> <?php echo $_SESSION['perso']['pdv']; ?></h2>
  <?php
     $pourcentage = $_SESSION['perso']['pdv'];
    ?>

    <div class="barre-vie">
        <div class="barre-vie-progress" style="width: <?php echo $pourcentage; ?>%;"></div>
    </div>

</div>
<div class="mt-6">
    <b>Or:</b> <?php echo $_SESSION['perso']['gold']; ?></h2>
</div>
<div class="mt-6">
    <b>Level:</b> <?php echo $_SESSION['perso']['level']; ?></h2>
</div>
<div class="mt-6">
    <b>XP:</b> <?php echo $_SESSION['perso']['xp']; ?></h2>
</div>
<div class="mt-6">
    <b>Force:</b> <?php echo $_SESSION['perso']['for']; ?></h2>
</div>
<div class="mt-6">
    <b>Dextérité:</b> <?php echo $_SESSION['perso']['dex']; ?></h2>
</div>
<div class="mt-6">
    <b>Intélligence:</b> <?php echo $_SESSION['perso']['int']; ?></h2>
</div>
<div class="mt-6">
    <b>Charisme:</b> <?php echo $_SESSION['perso']['char']; ?></h2>
</div>
<div class="mt-6">
    <b>Vitesse:</b> <?php echo $_SESSION['perso']['vit']; ?></h2>
</div>