<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="index.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
</head>
<style>
   .container {
  max-width: 400px;
  margin: 0 auto;
  padding:15px;
  background-color: #f2f2f2ee;
  border-radius: 5px;
  min-height:10cm;
}

.box {
  padding:15px;
  padding-top:3%;
}

header {
  text-align: center;
  font-size: 24px;
  margin-bottom:2%;
}

.field {
  margin-bottom: 15px;
}

.field label {
  display: block;
  font-weight: bold;
  margin-bottom: 5px;
}

.field input[type="text"],
.field input[type="password"] {
  width: 100%;
  padding: 10px;
  font-size: 16px;
  border: 1px solid #ccc;
  border-radius: 4px;
  background-color:white;
}

.field input[type="submit"] {
  background-color:rgb(80, 80, 124);
  color: #fff;
  border: none;
  padding: 10px 20px;
  font-size: 16px;
  cursor: pointer;
}

.links {
  margin-top: 10px;
  text-align: center;
  font-size:14px;
}

.links a {
  color: #333;
  text-decoration: none;
}

.message {
  background-color:rgb(80, 80, 124);
  color: #fff;
  padding: 10px;
  margin-bottom: 10px;
  text-align: center;
}

.img-login{
  background-image:url("img/login1.jpg");
  background-size:cover;
  background-repeat:no-repeat;
  padding-top:3%;
  margin-top:-2%;
  margin-bottom:-1%;
  height:80vh;
}

#i-v{
  color:blue;
}
</style>
<body>
<header>
    <div class="en-tete">
        <div class="ig">
            <h2 id="pro">PROLogis</h2>
        </div>
        <div class="en-tete2">
            <a href="accueill.html">Accueil</a>
            <a href="gespat.html">Gestion de patrimoine</a>
            <a href="financeprojet.html">Financement de projet</a>
            <a href="devprojet.html">Développement de projet</a>
            <a href="expertise.html">Expertise Immobilière</a>
            <a href="index.php">Connexion</a>
        </div>
        <div class="cell-phone">
            <a href="#contacts" id="reference-contact"><img src="img/kisspng-telephone-logo-computer-icons-clip-art-phone-icon-5ac539f9da47f1.4822659315228748738941.png" alt="" id="cell"></a>
        </div>
    </div>
</header>

<div class="img-login">
    <div class="container">
        <div class="box form-box">
            <?php
            include("php/config.php");
            if (isset($_POST['submit'])) {
                $email = mysqli_real_escape_string($con, $_POST['email']);
                $password = mysqli_real_escape_string($con, $_POST['password']);
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

                $result = mysqli_query($con, "SELECT * FROM users WHERE email='$email'") or die("Select Error");
                $row = mysqli_fetch_assoc($result);

                if ($row && password_verify($password,$hashedPassword)) {
                    $_SESSION['valid'] = $row['email'];
                    $_SESSION['nom'] = $row['nom'];
                    $_SESSION['iduser'] = $row['iduser'];
                if ($row['role'] === 'admin') {
                      header("Location: admin-dashboard.php");
                  } else {
                      header("Location: estimate.php");
                  }
                    exit();
                } else {
                    echo "<div class='message'>
                              <p>Email ou Mot de Passe Incorrect</p>
                           </div><br>";
                }
            }
            ?>

            <header>Connexion</header>
            <form action="" method="post">
                <div class="field input">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="password">Mot de Passe</label>
                    <input type="password" name="password" id="password" autocomplete="off" required>
                </div>

                <div class="field">
                    <input type="submit" class="btn" name="submit" value="Se connecter">
                </div>
                <div class="links"><br>
                    Vous n'avez pas de compte ? <a href="register.php" id="i-v">Inscrivez-vous !</a>
                </div>

            </form>
        </div>
    </div><br><br>
</div>

<footer><hr>
    <div class="foot">
         <div class="foot1">
           <h4>Newsletter</h4><br>
           <p>Rester informé en vous abonnant à notre Newsletter</p>
           <input type="email" placeholder="Email*">
         </div>
         <div class="foot3">
           <p style="font-weight: bold;">Prologis</p>
           <p>
               <li>Estimer un bien</li><br>
               <li>Vendre un bien</li><br>
               <li>Acheter un bien</li><br>
           </p>
         </div>
         <div class="foot2">
           <p style="font-weight: bold;" id="contacts">Contacts</p>
           <p>
               <ol>
                   <li>Téléphone: (+225)01-51-47-99-60</li><br>
                   <li>Fax: 418643-3210</li><br>
                   <li>Email: Prologis@gmail.com</li><br>
               </ol>
           </p>
         </div>
       </div>
    </div><hr>

    <div class="ftr">
       <div class="condition">
       <a href="">Mentions légales</a>
       <a href="">Protection des données personnelles</a>
       <a href="">Réglementations</a>
       </div>
       <div class="icon">
           <a href="http://www.facebook.fr"><img src="img/facebook.png" alt="" style="max-width: 4vh;"></a>
           <a href="htpp://www.twitter.fr"><img src="img/twitter.png" alt="" style="max-width: 4vh;"> </a>
           <a href="http://www.instagram.fr"><img src="img/instagram.png" alt="" style="max-width: 4vh;"></a>
       </div>
    </div>
</footer>

</body>

</html>
