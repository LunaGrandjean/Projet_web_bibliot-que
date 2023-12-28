<?php
    include("../db.php");
    $stmt_select = $pdo->prepare("SELECT DISTINCT Domaine FROM livre");
    $stmt_select->execute();
    while ($row = $stmt_select->fetch(PDO::FETCH_ASSOC)) {
        echo "{$row['Domaine']};";
        }
?>