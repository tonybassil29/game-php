<ul>
    <?php if (!isset($_SESSION['user'])) { ?>
        <li><a href="register.php">Créer un compte</a></li>
        <li><a href="login.php">Connexion</a></li>
    <?php } else { ?>
        <li><a href="persos.php"><?php echo $_SESSION['user']['email'] ?></a></li>
        <li><a href="logout.php">Log Out</a></li>
    <?php } ?>
  
</ul>