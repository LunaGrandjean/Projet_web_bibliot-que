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
                }
                else {
                    echo '<div class="recherche"><input type="text" name="livre_cherche" placeholder="Chercher un livre..."/><input type="submit">Chercher</input></div>';
                }
            ?>
            <br>
            <br>
            <div id="resultats_livres">
                <?php
                if (array_key_exists("livre_cherche", $_POST)) {
                    $livre_cherche = $_POST["livre_cherche"];
                    $conn = mysqli_connect("localhost", "root", "", "projetweb");
                    $requete = 'SELECT * FROM livre WHERE ';
                    foreach (explode(" ", $livre_cherche) as $terme) {
                        $requete = $requete . ' Titre LIKE "%' . substr($terme, 0, 5) . '%"' . ' OR ';
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
                ?>
            </div>
            </form>
        </div>
        <div id="graphiques">
        </div>
    </body>
</html>