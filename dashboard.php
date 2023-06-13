<?php
session_start();

include("php/config.php");
if (!isset($_SESSION['iduser'])) {
    header("location: index.php");
    exit; 
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="index.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informations de l'utilisateur</title>
    <style>
        /* CSS pour le tableau */
        .table {
            width: 100%;
            font-family: 'Roboto', sans-serif;
            border-collapse: collapse;
        }
        
        .table th, .table td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        
        .table th {
            background-color:rgba(87, 75, 129, 0.977);
            color: white;
        }
        .espace-estimation{
            text-align: center;
            background-color: rgb(228, 228, 241);
        }
        .rdv{
            margin-top:6rem;
            font-size:1.2em;
            display:block;
            margin-left:1rem;
            margin-right:1rem;
            text-align:center;
        }
        .btn_users{
            margin-top:4rem;
            text-align: center;
        }
        .btn_users a{
            border:8px;
            width:8cm;
            border-radius: 10px;
            color: white;
            padding:15px;
        }
       
        fieldset{
            background-color: rgba(137, 43, 226, 0.123);
        }
        
        
        
    </style>
</head>
<body>
    <header>
        <header>
            <div class="en-tete">
                <div class="ig">
                    <h2 id="pro">PROLogis</h2>
                </div>
                <div class="en-tete2">
                    <a href="accueill.html">Accueill</a>
                    <a href="">Gestion de pratrimoine</a>
                    <a href="financeprojet.html">Financement de projet</a>
                    <a href="devprojet.html">Developpement de projet</a>
                    <a href="expertise.html">Expertise Immobilière</a>
                    <a href="php/logout.php">Deconnexion</a>
                </div>
                <div class="cell-phone">
                    <a href="#contacts" id="reference-contact"><img src="img/kisspng-telephone-logo-computer-icons-clip-art-phone-icon-5ac539f9da47f1.4822659315228748738941.png" alt="" id="cell"></a>
                </div>
            </div>
        </header>
    </header>
    <div class="espace-estimation">
        <h2>Verifiez vos informations</h2>
   
    <table class="table">
        <thead>
            <tr>
               
                <th style="width: 14%;">Nom</th>
                <th style="width: 14%;">Email</th>
                <th style="width: 14%;">Surface</th>
                <th style="width: 14%;">Nombre de chambre</th>
                <th style="width: 14%;">Salle de bain</th>
                <th style="width: 14%;">Emplacement</th>
                <th style="width: 14%;">Prix</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include("php/config.php");
            $iduser = $_SESSION['iduser']; // Récupération de l'ID utilisateur depuis la session

            $query = "SELECT * FROM users WHERE iduser = ?";
            $stmt = $con->prepare($query);
            $stmt->bind_param("s", $iduser);
            $stmt->execute();
            $result = $stmt->get_result();
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
               
                echo "<td>{$row['nom']}</td>";
                echo "<td>{$row['email']}</td>";
                echo "<td>{$row['surface']} m²</td>";
                echo "<td>{$row['nbchambre']}</td>";
                echo "<td>{$row['nbsalle']}</td>";
                echo "<td>{$row['emplacement']}</td>";
                echo "<td>{$row['estimation']} FCFA</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
        </div>
   <?php
   
  if (isset($_GET['action']) && $_GET['action'] == 'supprimer') {
    $iduser = $_SESSION['iduser'];
    $query = "UPDATE users SET surface = NULL, nbchambre = NULL, nbsalle = NULL, emplacement = NULL, estimation = NULL WHERE iduser = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("s", $iduser);
    $stmt->execute();
    header("location: dashboard.php");
    echo "Aucune Information !";
}

?>

  
    <div class="btn_users">
    <a href="estimate.php"><img src="img/refresh.png" alt="Modifier"></a>
    <a href="?action=supprimer"><img src="img/trash.png" alt="Supprimer"></a>
    <a href="generepdf.php"><img src="img/printer.png" alt="Imprimer"></a>
    </div>
     <p style="text-align:center;">____________________________________________________________________</p>
    <div class="rdv"><fieldset>
        <h2>Prologis vous remercie pour la confiance !</h2>
        <p>Nos experts immobiliers possèdent une connaissance approfondie du marché local. Leur expérience leur permet d'évaluer votre propriété en prenant en compte tous les facteurs pertinents tels que l'emplacement, les caractéristiques spécifiques, les tendances du marché et les comparables récents. <br>  Nous attachons une grande importance à la confidentialité de vos informations. Soyez assuré(e) que toutes les données concernant votre bien seront traitées avec le plus grand professionnalisme et la plus grande discrétion. <br>Nous nous engageons à offrir un service client de qualité supérieure. Nous mettons un point d'honneur à répondre à vos questions, à vous tenir informé(e) tout au long du processus et à vous offrir une expérience agréable et sans tracas. </p>
    </div>
    </fieldset>

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
