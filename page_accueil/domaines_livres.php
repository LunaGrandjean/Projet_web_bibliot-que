<?php
    $host = 'localhost';
    $db_name = 'projetweb';
    $username = 'root';
    $password = '';

    try {
        $dbh = new PDO("mysql:host=$host;dbname=$db_name;charset=utf8", $username, $password);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
    }
    $stmt_select = $dbh->prepare("SELECT DISTINCT Domaine FROM livre");
    $stmt_select->execute();
    while ($row = $stmt_select->fetch(PDO::FETCH_ASSOC)) {
        echo "{$row['Domaine']};";
        }
?>