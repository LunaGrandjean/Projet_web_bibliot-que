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

<div class="container mt-4">
  <h2>Liste des auteurs</h2>

  <?php
  // Connexion à la base de données
  $host = 'localhost';
  $db_name = 'projet_web';
  $username = 'root';
  $password = '';

  try {
    $dbh = new PDO("mysql:host=$host;dbname=$db_name;charset=utf8", $username, $password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  } catch (PDOException $e) {
    die('Échec de la connexion à la base de données : ' . $e->getMessage());
  }

  // Afficher la liste des auteurs
  $sql_select = "SELECT * FROM auteur";
  $stmt_select = $dbh->query($sql_select);

  echo "<ul>";
  while ($row = $stmt_select->fetch(PDO::FETCH_ASSOC)) {
    echo "<li>{$row['Nom']} - {$row['Prenom']} - {$row['DateNaissance']} - {$row['Nationalite']} ";
    echo "<a href='supprimer_auteur.php?Num={$row['Num']}' class='btn btn-link btn-sm' onclick='return confirm(\"Êtes-vous sûr de vouloir supprimer cet auteur ?\")'>Supprimer</a></li>";
  }
  echo "</ul>";
  ?>
</div>

<div class="container mt-4">
    <h2>Ajouter un auteur</h2>
    <form action="ajouter_auteur.php" method="post">
        <div class="mb-3">
            <label for="Nom" class="form-label">Nom :</label>
            <input type="text" class="form-control" name="Nom" required>
        </div>
        <div class="mb-3">
            <label for="Prenom" class="form-label">Prénom :</label>
            <input type="text" class="form-control" name="Prenom" required>
        </div>
        <div class="mb-3">
            <label for="DateNaissance" class="form-label">Date de naissance :</label>
            <input type="date" class="form-control" name="DateNaissance" required>
        </div>
        <div class="mb-3">
            <label for="Nationalite" class="form-label">Nationalité :</label>
            <input type="text" class="form-control" name="Nationalite" required>
        </div>
        <button type="submit" class="btn btn-primary">Ajouter l'auteur</button>
    </form>
</div>

</body>
</html>
