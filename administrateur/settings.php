<!DOCTYPE html>
<html>
<head>
    <title>Paramètres</title>
    <style>
    body {
            font-family: 'Open Sans', Helvetica, Arial, sans-serif;
            background: url('../livre-bibliotheque.jpg') center center/cover no-repeat;
            background-attachment: fixed;
            background-size: cover;
            margin: 0;
            padding: 0;
        }

        .cont {
            overflow: hidden;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .form {
            position: relative;
            width: 640px;
            max-width: 100%;
            height: 100%;
            transition: transform 1.2s ease-in-out;
            padding: 50px 30px 0;
            margin: 0 auto; 
            background-color: #ffffff;
            border-radius: 15px;
            display: flex;
            flex-direction: column;
        }

        button {
            display: block;
            margin-top: 20px;
            width: 100%;
            height: 36px;
            border-radius: 30px;
            color: #fff;
            font-size: 15px;
            cursor: pointer;
            background: #d4af7a;
            text-transform: uppercase;
        }

        .form h1 {
            color: #333;
            text-align: center;
            font-size: 32px; 
            margin-bottom: 20px; 
        }

        .form label span {
            font-size: 12px;
            color: #0c0909;
            text-transform: uppercase;
            display: block;
            margin-top: 20px; 
        }

        .form input {
            width: 100%;
            margin-top: 5px;
            padding-bottom: 5px;
            font-size: 16px;
            border: none; 
            border-bottom: 1px solid rgba(206, 199, 199, 0.4);
        }

        .password-input-container {
            position: relative;
            width: 100%;
        }

        .eye-icon {
            position: absolute;
            top: 50%;
            right: 10px;
            transform: translateY(-50%);
            cursor: pointer;
        }

        .form .submit {
            margin-top: 20px;
            margin-bottom: 20px;
        }

        .back-button {
            position: absolute;
            top: 10px;
            left: 10px;
            cursor: pointer;
        }
        
        .back-button {
        display: inline-block;
        padding: 10px 20px; 
        border: 2px solid #d4af7a; 
        border-radius: 5px; 
        text-decoration: none;
        color: #d4af7a; 
    }
    </style>
</head>
<body>

<div class="cont">
    <form method="post" action="" class="form">
        <h1>Changer le mot de passe</h1>
        <label>
            <span>Nom d'utilisateur</span>
            <input type="text" placeholder="Entrer le nom d'utilisateur" name="username" required>
        </label>
        
        <label>
            <span>Mot de passe</span>
            <div class="password-input-container">
                <input type="password" placeholder="Entrer le mot de passe" name="password" required>
                <div class="eye-icon" id="eye-icon-1">
                    <i class="bi bi-eye-fill"></i>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                        <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0"/>
                        <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7"/>
                    </svg>
                </div>
            </div>
        </label>

        <label>
            <span>Nouveau mot de passe</span>
            <div class="password-input-container">
                <input type="password" placeholder="Entrer le nouveau mot de passe" name="new_password" required>
                <div class="eye-icon" id="eye-icon-2">
                    <i class="bi bi-eye-fill"></i>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                        <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0"/>
                        <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7"/>
                    </svg>
                </div>
            </div>
        </label>

        <a href="page_admin.php" class="back-button">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left-circle" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8m15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-4.5-.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5z"/>
            </svg>
            Retour
        </a>


        <button type="submit" class="submit">Changer le mot de passe</button>
    </form>
</div>
<?php
    include("../db.php");
    if (isset($_POST["username"]) and isset($_POST["password"]) and isset($_POST["new_password"])) {
        $username = $_POST["username"];
        $password = $_POST["password"];
        $new_password = $_POST["new_password"];
        $sql_select = "SELECT * FROM administrateur WHERE Nom = '$username' AND Password = '$password'";
        $stmt_select = $pdo->prepare($sql_select);
        $stmt_select->execute();
        $sql_update = "UPDATE administrateur
        SET Password = '$new_password'
        WHERE Nom = '$username' AND Password = '$password'";
        $stmt_update = $pdo->prepare($sql_update);
        $stmt_update->execute();
        //Si la requête SELECT a renvoyé au moins un enregistrement, alors on considère que
        //le changement de mot de passe a eu lieu avec succès. Sinon, on considère que ce n'est pas le cas
        if ($stmt_select->fetch(PDO::FETCH_ASSOC)) {
            echo "<script>
            alert('Le changement de mot de passe a été effectué avec succès !');
            </script>";
        }
        else {
            echo "<script>
            alert(`Le changement de mot de passe n'a pas pu être effectué car aucun compte ne correspond aux données saisies.`);
            </script>";
        }
        $pdo = null;
    }
?>
</body>
</html>
