<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index.css">
    <title>Inscription</title>
</head>
<header>
        <div class="en-tete">
            <div class="ig">
                <h2 id="pro">PROLogis</h2>
            </div>
            <div class="en-tete2">
                <a href="accueill.html">Accueill</a>
                <a href="gespat.html">Gestion de pratrimoine</a>
                <a href="financeprojet.html">Financement de projet</a>
                <a href="devprojet.html">Developpement de projet</a>
                <a href="expertise.html">Expertise Immobilière</a>
                <a href="index.php">Connexion</a>
            </div>
            <div class="cell-phone">
                <a href="#contacts" id="reference-contact"><img src="img/kisspng-telephone-logo-computer-icons-clip-art-phone-icon-5ac539f9da47f1.4822659315228748738941.png" alt="" id="cell"></a>
            </div>
        </div>
    </header>

<style>
  .container {
    max-width: 400px;
    margin: 0 auto;
    padding: 20px;
    background-color: #f2f2f2ea;
    border-radius: 5px;
   
  }
  
  .box {
    padding: 20px;
  }
  
  header {
    text-align: center;
    font-size: 24px;
    margin-bottom: 20px;
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
    border:snow;
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
  }
  
  .links a {
    color: #333;
    text-decoration: none;
  }
  
  .message {
    background-color:rgb(80, 80, 124) ;
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
    height:100vh;
  }
  #i-v{
    color:blue;
  }

</style>
<body>
  <div class="img-login">
  <div class="container">
        <div class="box form-box">

        <?php 
         
         include("php/config.php");
         if (isset($_POST['submit'])) {
          $nom = htmlspecialchars(strip_tags($_POST['nom']));
          $email = htmlspecialchars(strip_tags($_POST['email']));
          $password = $_POST['password'];
          $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
      
          $verify_query = mysqli_query($con, "SELECT email FROM users WHERE email='$email'");
      
          if (mysqli_num_rows($verify_query) != 0) {
              echo "<div class='message'>
                        <p>Cet mail est déjà utilisé</p>
                    </div> <br>";
          } else {
              
              if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $role = "user";
                $stmt = $con->prepare("INSERT INTO users(nom, email, password,role) VALUES(?, ?, ?,'$role')");
                $stmt->bind_param("sss", $nom, $email, $hashedPassword);
                $stmt->execute();
                
                  header("location:index.php");
              } else {
                  echo "<div class='message'>
                            <p>Format d'email invalide</p>
                        </div> <br>";
              }
          }
      }
         
        ?>
            <div class="bak1">
            <header>Inscription</header>
            <form action="" method="POST">
                <div class="field input">
                    <label for="username">Nom complet</label>
                    <input type="text" name="nom" id="nom" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" autocomplete="off" required>
                </div>
                <div class="field input">
                    <label for="password">Mot de passe</label>
                    <input type="password" name="password" id="password" autocomplete="off" required minlength="8">
                </div>

                <div class="field">
                    
                    <input type="submit" class="btn" name="submit" value="S'inscrire" required>
                </div>
                <div class="links">
                    Déjà Inscrit ? <a href="index.php"  id="i-v">Connectez-vous !</a>
                </div>
            </form>
            </div>
           
        </div>
      </div>
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
                       <li>Télephone: (+225)01-51-47-99-60</li><br>
                       <li>Faxe: 418643-3210</li><br>
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