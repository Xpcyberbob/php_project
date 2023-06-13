<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
       
        body{
            background-color:rgba(23, 37, 231, 0.192);
        }

        form {
            max-width: 400px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .form-group {
    
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="email"] {
            width: 95%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button[type="submit"] {
            background-color: #2d2457bb;
            color:white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .image-txt{
            display: flex;
            align-items:center;
            background-color: rgba(30, 37, 66, 0.808);
            margin-bottom: 15px;
        }
        .image img{
            max-height:8vh;
        }
        .txt a{
            margin-left:1rem;
            font-style: italic;
            text-decoration: none;
            color:white;
        }
        #mod{
            text-align:center;
            color:white;
            font-size:20px;
        }
    </style>
</head>
<body>
    <header>
        <nav>
            <div class="image-txt">
                <div class="image">
                    <img src="img/ad.jpg" alt="admin-image">
                </div>
                <div class="txt">
                  <a href="admin-dashboard.php">Admin</a>
                </div>
            </div>
        </nav>
    </header>
    <p id="mod">Modifiez les informations de l'utilisateur </p>
    <form method="POST">
        <div class="form-group">
            <label for="name">Nom</label>
            <input type="text" id="name" name="nom" placeholder="Entrez votre nom" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="Entrez votre adresse email" required>
        </div>
        <div class="form-group">
            <label for="surface">Surface (m²)</label>
            <input type="text" id="surface" name="surface" placeholder="Entrez la surface" required>
        </div>
        <div class="form-group">
            <label for="bedrooms">Nombre de chambres</label>
            <input type="text" id="bedrooms" name="nbchambre" placeholder="Entrez le nombre de chambres" required>
        </div>
        <div class="form-group">
            <label for="bathrooms">Nombre de salles de bain</label>
            <input type="text" id="bathrooms" name="nbsalle" placeholder="Entrez le nombre de salles de bain" required>
        </div>
        <div class="form-group">
            <label for="location">Emplacement</label>
            <input type="text" id="location" name="emplacement" placeholder="Entrez l'emplacement" required>
        </div>
        <div class="form-group">
            <button type="submit">Modifier</button>
        </div>
    </form><hr>
    <?php
// Connexion à la base de données
include("php/config.php");

// Vérification de la connexion
if (mysqli_connect_errno()) {
    echo "Erreur de connexion à la base de données : " . mysqli_connect_error();
} else {
    // Vérification si l'ID de l'utilisateur est passé dans l'URL
    if (isset($_GET['iduser'])) {
        $userId = $_GET['iduser'];

        // Vérification si le formulaire a été soumis
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Récupération des données du formulaire
            $nom= $_POST['nom'];
            $email = $_POST['email'];
            $surface = $_POST['surface'];
            $nbchambre = $_POST['nbchambre'];
            $nbsalle= $_POST['nbsalle'];
            $emplacement= $_POST['emplacement'];
            $estimation = ($surface * ($nbchambre + 0.5 * $nbsalle)) * 650;
            


            // Requête de mise à jour des données de l'utilisateur
            $query = "UPDATE users SET nom = '$nom', email = '$email', surface = '$surface', nbchambre = '$nbchambre', nbsalle = '$nbsalle', emplacement = '$emplacement',estimation= '$estimation' WHERE iduser = $userId";
            $result = mysqli_query($con, $query);

            if ($result) {
                echo "Données de l'utilisateur mises à jour avec succès";
                header("location:admin-dashboard.php");
            } else {
                echo "Erreur lors de la mise à jour des données de l'utilisateur : " . mysqli_error($con);
            }
        } 
    } 

    // Fermer la connexion à la base de données
    mysqli_close($con);
}
?>

</body>
</html>
