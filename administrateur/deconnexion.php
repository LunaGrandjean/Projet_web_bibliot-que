<?php
// Détruire la session et redirigez vers la page d'accueil
session_start();
session_destroy();
header('Location: ../page_accueil/index.php');
exit();
?>
