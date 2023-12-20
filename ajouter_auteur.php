<?php
$host = 'localhost';
$db_name = 'projet_web';
$username = 'root';
$password = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données du formulaire
    $nom = $_POST['Nom'];
    $prenom = $_POST['Prenom'];
    $dateNaissance = $_POST['DateNaissance'];
    $nationalite = $_POST['Nationalite'];

    try {
        $dbh = new PDO("mysql:host=$host;dbname=$db_name;charset=utf8", $username, $password);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Préparer la requête d'insertion
        $sql_insert = "INSERT INTO auteur (Nom, Prenom, DateNaissance, Nationalite) VALUES (:nom, :prenom, :dateNaissance, :nationalite)";
        $stmt_insert = $dbh->prepare($sql_insert);

        // Liens entre les paramètres de la requête et les variables
        $stmt_insert->bindParam(':nom', $nom);
        $stmt_insert->bindParam(':prenom', $prenom);
        $stmt_insert->bindParam(':dateNaissance', $dateNaissance);
        $stmt_insert->bindParam(':nationalite', $nationalite);

        // Exécution de la requête
        $stmt_insert->execute();

        echo "Auteur ajouté avec succès.";

        // Rediriger vers la page des auteurs après l'ajout
        header("Location: page_auteur.php");
        exit(); // Ajoutez cette ligne pour arrêter l'exécution du script après la redirection

    } catch (PDOException $e) {
        echo "Erreur lors de l'ajout de l'auteur : " . $e->getMessage();
    }
}
