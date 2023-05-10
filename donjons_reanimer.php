
<?php
  if (isset($_POST['Réanimer'])) {
    // Réinitialiser les points de vie à 100%
    $_SESSION['perso']['pdv'] = 100;
}
?>

