<?php
// Détruisez la session et redirigez vers la page d'accueil
session_start();
session_destroy();
header('Location: page_acceuil.php');
exit();
?>
