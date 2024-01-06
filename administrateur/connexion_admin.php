<?php
include('../db.php');
session_start();
if (isset($_SESSION['error_message'])) {
    $error_message = $_SESSION['error_message'];
    unset($_SESSION['error_message']);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles.css" media="screen" type="text/css" />
    <title>Connexion</title>
</head>
<body>
    <div class="cont">
        <form class="form sign-in" action="verification.php" method="POST">
            <h1>Connectez-vous</h1>
    
            <?php if (isset($error_message)): ?>
                <p style="color:red"><?php echo $error_message; ?></p>
            <?php endif; ?>

            <label>
                <span>Nom d'utilisateur</span>
                <input type="text" placeholder="Entrer le nom d'utilisateur" name="username" required>
            </label>

            <label>
            <span>Mot de passe</span>
            <div class="password-input-container">
                <input type="password" placeholder="Entrer le mot de passe" name="password" required>
                <div class="eye-icon" id="eye-icon">
                <i class="bi bi-eye-fill"></i>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                    <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0"/>
                    <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7"/>
                </svg>
                </div>
            </div>
            </label>
            <button type="submit" class="submit">Se connecter</button>
        </form>
    </div>
    
    <script>
    document.addEventListener('DOMContentLoaded', function () {
    const passwordInput = document.querySelector('input[type="password"]');
    const eyeIcon = document.getElementById('eye-icon');

    eyeIcon.addEventListener('click', function () {
        // Toggle the password input type between "password" and "text"
        if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        } else {
        passwordInput.type = 'password';
        }
    });
    });
    </script>


<style>
    body {
  font-family: 'Open Sans', Helvetica, Arial, sans-serif;
  background: url('../livre-bibliotheque.jpg') center center/cover no-repeat;
  background-attachment: fixed;
  background-size: cover;
  margin: 0;
  padding: 0;
}

input,
button {
  border: none;
  outline: none;
  background: none;
  font-family: 'Open Sans', Helvetica, Arial, sans-serif;
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
  height: 100%;
  transition: transform 1.2s ease-in-out;
  padding: 50px 30px 0;
  margin: 0 auto; 
  background-color: #ffffff;
  border-radius: 15px; 
}

button {
  display: block;
  margin: 0 auto;
  width: 260px;
  height: 36px;
  border-radius: 30px;
  color: #fff;
  font-size: 15px;
  cursor: pointer;
  background: #d4af7a;
  text-transform: uppercase;
}

.form.sign-in h1 {
  color: #333;
  text-align: center;
  font-size: 32px; 
  margin-bottom: 20px; /
}

.form.sign-in label span {
  font-size: 12px;
  color: #0c0909;
  text-transform: uppercase;
  display: block;
  margin-top: 20px; 
}

.form.sign-in input {
  display: block;
  width: 100%;
  margin-top: 5px;
  padding-bottom: 5px;
  font-size: 16px;
  border: none; 
  border-bottom: 1px solid rgba(206, 199, 199, 0.4);
}

.password-input-container {
  position: relative;
}

.eye-icon {
  position: absolute;
  top: 50%;
  right: 10px;
  transform: translateY(-50%);
  cursor: pointer;
}


.form.sign-in .submit {
  margin-top: 40px;
  margin-bottom: 20px;
}

.sign-in {
  transition-timing-function: ease-out;
}

</style>
</body>
</html>
