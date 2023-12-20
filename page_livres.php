<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="styles.css" media="screen" type="text/css" />

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</head>
<body>

<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="page_admin.php">Dashboard administrateur</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#"></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="page_auteur.php">Auteur</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="page_livres.php">Livre</a>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" href="#" data-bs-toggle="offcanvas" data-bs-target="#profileMenu" aria-controls="profileMenu">
            <!-- Utilisez l'icône SVG ici -->
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
              <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
              <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1"/>
            </svg>
          </a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<!-- Barre latérale (offcanvas) -->
<div class="offcanvas offcanvas-end" tabindex="-1" id="profileMenu" aria-labelledby="profileMenuLabel">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title" id="profileMenuLabel">Menu Profil</h5>
    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body">
    <ul class="list-group">
    <li class="list-group-item">
  <a href="settings.php" class="text-decoration-none">
    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-gear-fill" viewBox="0 0 16 16">
      <path d="M9.405 1.05c-.413-1.4-2.397-1.4-2.81 0l-.1.34a1.464 1.464 0 0 1-2.105.872l-.31-.17c-1.283-.698-2.686.705-1.987 1.987l.169.311c.446.82.023 1.841-.872 2.105l-.34.1c-1.4.413-1.4 2.397 0 2.81l.34.1a1.464 1.464 0 0 1 .872 2.105l-.17.31c-.698 1.283.705 2.686 1.987 1.987l.311-.169a1.464 1.464 0 0 1 2.105.872l.1.34c.413 1.4 2.397 1.4 2.81 0l.1-.34a1.464 1.464 0 0 1 2.105-.872l.31.17c1.283.698 2.686-.705 1.987-1.987l-.169-.311a1.464 1.464 0 0 1 .872-2.105l.34-.1c1.4-.413 1.4-2.397 0-2.81l-.34-.1a1.464 1.464 0 0 1-.872-2.105l.17-.31c.698-1.283-.705-2.686-1.987-1.987l-.311.169a1.464 1.464 0 0 1-2.105-.872l-.1-.34zM8 10.93a2.929 2.929 0 1 1 0-5.86 2.929 2.929 0 0 1 0 5.858z"/>
    </svg>
    Paramètres
  </a>
</li>

<li class="list-group-item">
  <a href="deconnexion.php" class="text-decoration-none">
    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-right" viewBox="0 0 16 16">
      <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0z"/>
      <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z"/>
    </svg>
    Déconnexion
  </a>
</li>

    </ul>
  </div>
</div>
    <div class="container mt-4">
        <h2>Liste des livres</h2>
        
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

            // Afficher la liste des livres
            $sql_select = "SELECT * FROM livre";
            $stmt_select = $dbh->query($sql_select);
            
            echo "<table class='table'>";
            echo "<thead>";
            echo "<tr>";
            echo "<th scope='col'>ISSN</th>";
            echo "<th scope='col'>Titre</th>";
            echo "<th scope='col'>Resume</th>";
            echo "<th scope='col'>Nbpages</th>";
            echo "<th scope='col'>Domaine</th>";
            echo "<th scope='col'>Auteur</th>";
            echo "<th scope='col'> </th>";
            echo "</tr>";
            echo "</thead>";
            echo "<tbody>";
            while ($row = $stmt_select->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>";
                echo "<th scope='row'>{$row['ISSN']}</th>";
                echo "<td>{$row['Titre']}</td>";
                echo "<td>{$row['Resume']}</td>";
                echo "<td>{$row['Nbpages']} pages</td>";
                echo "<td>{$row['Domaine']}</td>";
                echo "<td> </td>";
                echo "<td><a href='supprimer_livre.php?id={$row['ISSN']}'>Supprimer</a></td>";
                echo "</tr>";
            }
            echo "</tbody>";
            echo "</table>";
        ?>

        <h2>Ajouter un livre</h2>
        <form action="page_livres.php" method="post">
            <div class="mb-3">
                <label for="ISSN" class="form-label">ISSN :</label>
                <input type="text" class="form-control" id="ISSN" name="ISSN" required>
            </div>
            <div class="mb-3">
                <label for="Titre" class="form-label">Titre :</label>
                <input type="text" class="form-control" id="Titre" name="Titre" required>
            </div>
            <div class="mb-3">
                <label for="Resume" class="form-label">Résumé :</label>
                <textarea class="form-control" id="Resume" name="Resume" required></textarea>
            </div>
            <div class="mb-3">
                <label for="Nbpages" class="form-label">Nombre de pages :</label>
                <input type="number" class="form-control" id="Nbpages" name="Nbpages" required>
            </div>
            <div class="mb-3">
                <label for="Domaine" class="form-label">Domaine :</label>
                <input type="text" class="form-control" id="Domaine" name="Domaine" required>
            </div>
            <div class="mb-3">
                <label for="Auteur" class="form-label">Auteur :</label>
                <input type="text" class="form-control" id="Auteur" name="Auteur" required>
                <p><strong>Attention l'auteur doit d'abord être ajouter dans la base de données</strong></p>
            </div>
            <button type="submit" class="btn btn-primary">Ajouter le livre</button>
        </form>

    </div>

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
            }
        }

        // Fermeture de la connexion à la base de données
        $dbh = null;
        ?>
</body>
</html>
