<?php
$host = 'localhost';
$db_name = 'projetweb';
$username = 'root';
$password = '';

try {
    $dbh = new PDO("mysql:host=$host;dbname=$db_name;charset=utf8", $username, $password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('Échec de la connexion à la base de données : ' . $e->getMessage());
}


// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupération des données du formulaire
    
    $ISSN = $_POST['ISSN'];
    $titre = $_POST['Titre'];
    $resume = $_POST['Resume'];
    $nb_pages = $_POST['Nbpages'];
    $domaine = $_POST['Domaine'];
    $idAuteurs = isset($_POST['Auteurs']) ? $_POST['Auteurs'] : [];

    // Requête d'insertion dans la table "livre" avec PDO
    $sql = "INSERT INTO livre (ISSN, Titre, Resume, Nbpages, Domaine) VALUES (:ISSN, :Titre, :Resume, :Nbpages, :Domaine)";
    $stmt = $dbh->prepare($sql);

    $stmt->bindParam(':ISSN', $ISSN);
    $stmt->bindParam(':Titre', $titre);
    $stmt->bindParam(':Resume', $resume);
    $stmt->bindParam(':Nbpages', $nb_pages);
    $stmt->bindParam(':Domaine', $domaine);

    try {
        $stmt->execute();
        echo "Livre ajouté avec succès.";
    } catch (PDOException $e) {
        echo "Erreur lors de l'ajout du livre : " . $e->getMessage();
        exit; // Arrêter le script en cas d'erreur
    }

    // Requête d'insertion dans la table "écrit" pour associer le livre à l'auteur
    $sqlEcrit = "INSERT INTO ecrit (Livre_ISSN, Auteur_Num) VALUES (:Livre_ISSN, :Auteur_Num)";
    $stmtEcrit = $dbh->prepare($sqlEcrit);

    // Parcourir le tableau des auteurs sélectionnés
    foreach ($idAuteurs as $idAuteur) {
        $stmtEcrit->bindParam(':Livre_ISSN', $ISSN);
        $stmtEcrit->bindParam(':Auteur_Num', $idAuteur);

        try {
            $stmtEcrit->execute();
        } catch (PDOException $e) {
            echo "Erreur lors de l'association entre le livre et l'auteur(s) : " . $e->getMessage();
            exit; // Arrêter le script en cas d'erreur
        }
    }


    echo "Livre et Auteur(s) ajoutés avec succès.";
    header("Location: page_livres.php");
    exit; 
}

// Fermeture de la connexion à la base de données
$dbh = null;
?>
