<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8">

  <link rel="stylesheet" href="styles.css" media="screen" type="text/css" />
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

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
          <a class="nav-link" href="http://localhost/Projet_web_bibliotheque/gestion_auteur/page_auteur.php">Auteur</a>
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
  <div class="row">
    <div class="col-md-4 mx-auto">
      <h3>Répartition des nationalités des auteurs</h3>
      <canvas id="nationaliteChart" width="450" height="200"></canvas>
    </div>
    <div class="col-md-4 mx-auto">
      <h3>Répartition des livres par domaine</h3>
      <canvas id="livresParDomaineChart" width="450" height="200"></canvas>
    </div>
  </div>
  
  <div class="row mt-4">
    <div class="col-md-12 text-center">
      <h3>Classement des auteurs ayant écrit le plus de livres</h3>
      <canvas id="classementAuteursChart" width="500" height="200"></canvas>
    </div>
  </div>
</div>


<script>
fetch('graphs_auteurs.php')
  .then(response => response.json())
  .then(data => {
    // Créer le graphique avec Chart.js
    var ctx = document.getElementById('nationaliteChart').getContext('2d');
    var nationaliteChart = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: Object.keys(data), // nationalités
        datasets: [{
          label: 'Nombre d\'auteurs',
          data: Object.values(data), // nombre d'auteurs
          backgroundColor: 'rgba(75, 192, 192, 0.2)',
          borderColor: 'rgba(75, 192, 192, 1)',
          borderWidth: 1
        }]
      },
      options: {
        scales: {
          y: {
            beginAtZero: true
          }
        }
      }
    });
  });
</script>

<script>
fetch('graphs_domaines.php')
  .then(response => response.json())
  .then(data => {
    // Créer le graphique avec Chart.js
    var ctx = document.getElementById('livresParDomaineChart').getContext('2d');
    var livresParDomaineChart = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: Object.keys(data), // domaines
        datasets: [{
          label: 'Nombre de livres',
          data: Object.values(data), // nombre de livres
          backgroundColor: 'rgba(255, 99, 132, 0.2)',
          borderColor: 'rgba(255, 99, 132, 1)',
          borderWidth: 1
        }]
      },
      options: {
        scales: {
          y: {
            beginAtZero: true
          }
        }
      }
    });
  });
</script>

<script>
// Code JavaScript pour récupérer les données et afficher le graphique
fetch('classement_auteurs.php')
  .then(response => response.json())
  .then(data => {
    const auteurs = Object.keys(data);
    const livres = Object.values(data);

    const ctx = document.getElementById('classementAuteursChart').getContext('2d');
    const myChart = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: auteurs,
        datasets: [{
          label: 'Nombre de livres',
          data: livres,
          backgroundColor: ['rgba(153, 102, 255, 0.2)'],
          borderColor: ['rgba(153, 102, 255, 1)'],
          borderWidth: 1
        }]
      },
      options: {
        scales: {
          y: {
            beginAtZero: true
          }
        }
      }
    });
  })
  .catch(error => console.error('Erreur lors de la récupération des données :', error));
</script>


</body>
</html>