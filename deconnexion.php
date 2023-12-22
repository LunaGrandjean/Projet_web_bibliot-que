<?php
// Détruisez la session et redirigez vers la page d'accueil
session_start();
session_destroy();
header('Location: http://localhost/Projet_web_bibliotheque/page_acceuil/index.php');
exit();
?>
