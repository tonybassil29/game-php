<ul id="nav">
    <?php if (!isset($_SESSION['user'])) { ?>
        <li><a href="register.php">Créer un compte</a></li>
        <li><a href="login.php">Connexion</a></li>
        <li><a href="index.php">Jeu</a></li>

    <?php } else { ?>
        <li><a href="moncompte.php">Mon Compte</a></li>
        <li><a href="persos.php"><?php echo $_SESSION['user']['email'] ?></a></li>
        <li><a href="logout.php">Logout</a></li>
    <?php } ?>
</ul>