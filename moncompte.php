
<?php

    require_once('functions.php');

    if (!isset($_SESSION['user'])) {
        header('Location: login.php');
    }

    if (isset($_POST['update_email'])) {
        $bdd = connect();

        $sql = "UPDATE users SET email = :email WHERE id = :id";
        $sth = $bdd->prepare($sql);
        $sth->execute([
            'id'    => $_SESSION['user']['id'],
            'email' => $_POST['email']
        ]);

        $_SESSION['user']['email'] = $_POST['email'];

        $msg = "Email updated successfully";
        header("Location: moncompte.php?msg=$msg");
        exit();
    }

    if (isset($_POST['update_password'])) {
        $bdd = connect();

        $sql = "UPDATE users SET password = :password WHERE id = :id";
        $sth = $bdd->prepare($sql);
        $sth->execute([
            'id'        => $_SESSION['user']['id'],
            'password'  => password_hash($_POST['password'], PASSWORD_DEFAULT)
        ]);

        $msg = "Le Mot de Passe a été modifier avec succés !";
        header("Location: moncompte.php?msg=$msg");
        exit();
    }

?>
<style>
    body {
        background-image: url(img/gant.jpg);
        background-size: cover;
        background-position: center center;
        background-repeat: no-repeat;
    }
</style>

<?php require_once('_header.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/account.css">
    <title>Mon compte</title>
</head>
<body>
    <?php require_once('_nav.php'); ?>
    <div class="container">
        <h1>Mon compte</h1>
        <div>
            <h2>Modifier E-mail</h2>
            <form action="" method="post">
                <div>
                    <label for="email">Nouveau E-mail</label>
                    <input 
                        type="email" 
                        placeholder="Entrer votre nouveau E-mail" 
                        name="email" 
                        id="email" 
                        required 
                    />
                </div>
                <div>
                    <input type="submit" name="update_email" value="Modifier E-mail" />
                </div>
            </form>
        </div>
        <div>
            <h2>Modifier Mot de Passe</h2>
            <form action="" method="post">
                <div>
                    <label for="password">Nouveau Mot de Passe</label>
                    <input 
                        type="password" 
                        placeholder="Entrer votre nouveau mot de passe" 
                        name="password" 
                        id="password" 
                        required 
                    />
                </div>
                <div>
                    <input type="submit" name="update_password" value="Modifier Mot de Passe" />
                </div>
            </form>
        </div>
        <?php 
            if (isset($_GET['msg'])) {
                echo "<div>" . $_GET['msg'] . "</div>";
            }
        ?>
    </div>
</body>
</html>
