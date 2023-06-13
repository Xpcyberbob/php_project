<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index.css">
    <title>Estimation immobilière</title>
    <style>
       
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }
        
        .container {
           
            min-width: 400px; 
            margin: 0 auto;
            padding: 10px; 
            background-color: rgba(255, 255, 255, 0.863);
            border-radius:10px;
            min-height:70vh;
            margin-bottom:5px;
            margin-left:5%;
        }
        
        h1 {
            text-align: center;
            color: #333;
        }
        
        form {
            margin-top: 20px;
        }
        
        .form-group {
            margin-bottom: 15px;
        }
        
        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }
        
        input[type="text"]{
            width: 95%;
            padding:15px;
            font-size:14px;
            border: 1px solid #ccc;
            border-radius: 4px;
            height:0.7cm;
        }
        
        button[type="submit"] {
            background-color: #191a61;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        
        .result {
            margin-top: 20px;
            padding: 10px;
            background-color: #f9f9f9ab;
            border: 1px solid #ccc;
            border-radius:1px;
        }
    .estime{
        padding-top:1%;
        display:flex;
        justify-content:space-arround;
        background-image:url("img/calcul.jpg");
        background-repeat: no-repeat;
        background-size: cover;
    }
    .txt-estimation{
        margin-left:15%;
        margin-right:2%;
        padding-top:4%;
        font-weight: 300;
        font-style: oblique;
        color:rgba(0, 0, 255, 0.856);
        font-size:1.5em;
        font-weight:500;
    }
        </style>
</head>
<body>
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
                <a href="dashboard.php">Mon estimation</a>
                <a href="php/logout.php">Deconnexion</a>
            </div>
            <div class="cell-phone">
                <a href="#contacts" id="reference-contact"><img src="img/kisspng-telephone-logo-computer-icons-clip-art-phone-icon-5ac539f9da47f1.4822659315228748738941.png" alt="" id="cell"></a>
            </div>
        </div>
    </header>
<?php session_start();
?>
   <div class="estime">
<div class="container">
        <h1>Estimation immobilière</h1>
        <form method="POST">
            <div class="form-group">
                <label for="surface">Surface (m²)</label>
                <input type="text" id="surface" name="surface" placeholder="Entrez la surface" required>
            </div>
            <div class="form-group">
                <label for="bedrooms">Nombre de chambres</label>
                <input type="text" id="bedrooms" name="bedrooms" placeholder="Entrez le nombre de chambres" required>
            </div>
            <div class="form-group">
                <label for="bathrooms">Nombre de salles de bain</label>
                <input type="text" id="bathrooms" name="bathrooms" placeholder="Entrez le nombre de salles de bain" required>
            </div>
            <div class="form-group">
                <label for="location">Emplacement</label>
                <input type="text" id="location" name="location" placeholder="Entrez l'emplacement" required>
            </div>
            <div class="form-group">
                <button type="submit">Estimer</button>
            </div>
        </form>
        <div>
        <?php
include("php/config.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $surface = htmlspecialchars(floatval($_POST["surface"]));
    $bedrooms = htmlspecialchars(intval($_POST["bedrooms"]));
    $bathrooms = htmlspecialchars(intval($_POST["bathrooms"]));
    $location = htmlspecialchars($_POST["location"]);
    if ($surface <= 0 || $bedrooms <= 0 || $bathrooms <= 0){
        echo "Les champs surface, chambre et salle doivent être positifs.";
    }
    else {
        $iduser= $_SESSION['iduser'];

        $estimation = ($surface * 10000 + ($bedrooms*2500*$bathrooms));
        $query = "SELECT * FROM users WHERE iduser = ?";
        $stmt = $con->prepare($query);
        $stmt->bind_param("s", $iduser);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $query = "UPDATE users SET surface = ?, nbchambre = ?, nbsalle = ?, emplacement = ?, estimation = ? WHERE iduser= ?";
            $stmt = $con->prepare($query);
            $stmt->bind_param("diisds", $surface, $bedrooms, $bathrooms, $location, $estimation, $iduser);
            $stmt->execute();
            
            if ($stmt->affected_rows > 0) {
                echo "Estimation reussie ! Prologis vous remercie pour la confiance <a href=dashboard.php>cliquez ici pour voir votre estimation</a>";
                
            } else {
                echo "Une erreur s'est produite !";
            }
        } 
 
        $stmt->close();
    }
}
?>
</div>
       </div>
    <div class="txt-estimation">
            <p>Bonjour, <br>
            Que vous soyez un particulier à la recherche de votre maison de rêve, un investisseur cherchant des opportunités lucratives ou un propriétaire souhaitant mettre en vente ou en location votre bien, Prologis Agence Immobilière est à votre service.
           
         Êtes-vous curieux de connaître la valeur de votre propriété ? <br> Souhaitez-vous prendre des décisions éclairées en matière immobilière ? <br> Alors ne cherchez plus, faites une estimation immobilière dès aujourd'hui !</p>
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
                    <li>Expertise immobilière</li>
                </p>
                
              </div>
             <div class="foot2">
               <p style="font-weight: bold;" id="contacts">Contacts</p>
               <p>
                   <li>Télephone: (+225)01-51-47-99-60</li><br>
                   <li>Faxe: 418643-3210</li><br>
                   <li>Email: Prologis@gmail.com</li><br>
               </p>
             </div>
           </div>
        </div><hr>
        <div class="ftr">
           <div class="condition">
           <a href="">Mentions légales</a>
           <a href="">Protection des données personnelles</a>
           <a href=""">Réglementations</a>
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
