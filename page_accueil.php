<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8"/>
        <title>
            Test
        </title>
        <link rel="stylesheet" href="style.css"/>
    </head>
    <body>
        <div id="recherche_livre">
            <form action="page_accueil.php" method="post">
            <?php
                if (array_key_exists("livre_cherche", $_POST)) {
                    echo '<div class="recherche"><input type="text" name="livre_cherche" placeholder="Chercher un livre..." value="' . $_POST["livre_cherche"] . '"/><button type="submit">Chercher</button></div>';
                    $chercher_par_titre = $chercher_par_resume = $chercher_par_domaine = $chercher_par_auteur = false;
                }
                else {
                    echo '<div class="recherche"><input type="text" name="livre_cherche" placeholder="Chercher un livre..."/><button type="submit">Chercher</button></div>';
                    $chercher_par_titre = $chercher_par_resume = $chercher_par_domaine = $chercher_par_auteur = true;
                }
                $titre_checked = $resume_checked = $domaine_checked = $auteur_checked = "";
                if (array_key_exists("chercher_par_titre", $_POST)) {
                    $chercher_par_titre = true;
                }
                if (array_key_exists("chercher_par_resume", $_POST)) {
                    $chercher_par_resume = true;
                }
                if (array_key_exists("chercher_par_domaine", $_POST)) {
                    $chercher_par_domaine = true;
                }
                if (array_key_exists("chercher_par_auteur", $_POST)) {
                    $chercher_par_auteur = true;
                }
                if ($chercher_par_titre) {
                    $titre_checked = 'checked="checked"';
                }
                if ($chercher_par_resume) {
                    $resume_checked = 'checked="checked"';
                }
                if ($chercher_par_domaine) {
                    $domaine_checked = 'checked="checked"';
                }
                if ($chercher_par_auteur) {
                    $auteur_checked = 'checked="checked"';
                }
                echo '<br><br>
                Chercher par :
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <label class="switch">
                <input type="checkbox" name="chercher_par_titre"' . $titre_checked .'>
                <span class="slider"></span>
                </label>
                <label for="chercher_par_titre">Titre</label> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <label class="switch">
                <input type="checkbox" name="chercher_par_resume"' . $resume_checked . '>
                <span class="slider"></span>
                </label>
                <label for="chercher_par_resume">Résumé</label> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <label class="switch">
                <input type="checkbox"  name="chercher_par_domaine"' . $domaine_checked . '>
                <span class="slider"></span>
                </label>
                <label for="chercher_par_domaine">Domaine</label> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <label class="switch">
                <input type="checkbox" name="chercher_par_auteur"' . $auteur_checked . '>
                <span class="slider"></span>
                </label>
                <label for="chercher_par_auteur">Auteur</label>'
            ?>
            <br>
            <br>
            <div id="resultats_livres">
                <?php
                if (array_key_exists("livre_cherche", $_POST)) {
                    $livre_cherche = $_POST["livre_cherche"];
                    $conn = mysqli_connect("localhost", "root", "", "projetweb");
                    $requete = 'SELECT DISTINCT livre.* FROM livre
                    INNER JOIN ecrit ON ecrit.Livre_ISSN = livre.ISSN
                    INNER JOIN auteur ON auteur.Num = ecrit.Auteur_Num
                    WHERE ';
                    $chercher_par = '';
                    if ($chercher_par_titre) {
                        $chercher_par = $chercher_par . 'Titre, " ",';
                    }
                    if ($chercher_par_resume) {
                        $chercher_par = $chercher_par . 'Resume, " ",';
                    }
                    if ($chercher_par_domaine) {
                        $chercher_par = $chercher_par . 'Domaine, " ",';
                    }
                    if ($chercher_par_auteur) {
                        $chercher_par = $chercher_par . 'auteur.Nom, " ", auteur.Prenom,';
                    }
                    if ($chercher_par=="") {
                        echo '<div class="alert">
                        <span class="closebtn" onclick="this.parentElement.style.display=' . "'none'" . ';">&times;</span>
                        Il faut chercher au moins par titre, résumé, domaine ou auteur.
                        </div>';
                    }
                    else {
                        //Il devrait y avoir une virgule à la fin de $chercher_par, donc on la retire
                        $chercher_par = substr($chercher_par, 0, -1);
                        foreach (explode(" ", $livre_cherche) as $terme) {
                            $requete = $requete . ' CONCAT('. $chercher_par .')
                            LIKE "%' . substr($terme, 0, 5) . '%" OR ';
                        };
                        $requete = substr($requete, 0, -4);
                        $res = mysqli_query($conn, $requete);
                        $books = [];
                        while ($row = mysqli_fetch_assoc($res)) {
                            $books[] = $row;
                        };
                        echo "<table>
                        <tr>
                        <td>ISSN</td>
                        <td>Titre</td>
                        <td>Résumé</td>
                        <td>Nombre de pages</td>
                        <td>Domaine</td>
                        </tr>";
                        foreach ($books as $book) {
                            echo "<tr>";
                            foreach ($book as $value) {
                                echo "<td>$value</td>";
                            }
                            echo "</tr>";
                        }
                        echo "</table>";
                    }
                }
                ?>
            </div>
            </form>
        </div>
        <div id="graphiques">
        </div>
    </body>
</html>