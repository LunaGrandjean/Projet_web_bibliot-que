<?php
session_start();
if(isset($_SESSION['error_message'])){
    $error_message = $_SESSION['error_message'];
    unset($_SESSION['error_message']); // Supprimez la variable de session après l'avoir affichée
}
?>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="styles.css" media="screen" type="text/css" />
</head>
<body>
    <div id="container">

        <form action="verification.php" method="POST">
            <h1>Connexion</h1>

            <?php if(isset($error_message)): ?>
                <p style="color:red"><?php echo $error_message; ?></p>
            <?php endif; ?>

            <label><b>Nom d'utilisateur</b></label>
            <input type="text" placeholder="Entrer le nom d'utilisateur" name="username" required>

            <label><b>Mot de passe</b></label>
            <input type="password" placeholder="Entrer le mot de passe" name="password" required>

            <input type="submit" id='submit' value='LOGIN'>
        </form>

    </div>
</body>
</html>
