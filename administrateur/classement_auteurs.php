<?php
session_start();
include("db.php");

// Indiquer que le contenu est du type JSON
header('Content-Type: application/json');

// Fonction pour récupérer le classement des auteurs par nombre de livres
function getClassementAuteurs() {
    global $pdo;

    try {
        $requete = "SELECT Auteur.Nom, Auteur.Prenom, COUNT(Ecrit.Livre_ISSN) AS NombreLivres
                    FROM Auteur
                    LEFT JOIN Ecrit ON Auteur.Num = Ecrit.Auteur_Num
                    GROUP BY Auteur.Num
                    ORDER BY NombreLivres DESC";

        $resultat = $pdo->query($requete);

        $classementAuteurs = array();

        while ($row = $resultat->fetch(PDO::FETCH_ASSOC)) {
            $nomComplet = $row['Nom'] . ' ' . $row['Prenom'];
            $classementAuteurs[$nomComplet] = $row['NombreLivres'];
        }

        return $classementAuteurs;
    } catch (PDOException $e) {
        die("Erreur lors de l'exécution de la requête : " . $e->getMessage());
    }
}

// Appeler la fonction et renvoyer les données au format JSON
$data = getClassementAuteurs();
echo json_encode($data);
exit;

// Fermer la connexion à la base de données
$connexion->close();
?>
