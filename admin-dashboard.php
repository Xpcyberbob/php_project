
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body{
            background-color: rgba(255, 255, 255, 0.342);
        }
        table {
            width: 100%;
            border-collapse: collapse;
            font-family: 'Roboto', sans-serif;

        }

        th, td {
            text-align: left;
            border-bottom: 1px solid #ddd;
            font-family: 'Roboto', sans-serif;
            background-color: #1f1fbe0c; /* Couleur pour toutes les colonnes */
            font-size:15px;
        }

       
        .button {
            display: inline-block;
            padding: 6px 12px;
            margin:2px;
            font-size:10px;
            font-weight: bold;
            text-align: center;
            text-decoration: none;
            cursor: pointer;
            border: none;
            border-radius: 4px;
            transition: background-color 0.3s ease;
        }

        .button-delete {
            background-color: #7b83ca;
            color: white;
        }

        .button-update {
            background-color: #7b83ca;
            color: white;
        }

        .button-print {
            background-color:#7b83ca;
            color: white;
        }
        .admin{
            text-align:center;
            font-size:15px;
            margin-bottom:1rem;
           
        }
        .admin a {
            text-decoration:none;
            padding: 15px;
        }
       
        .action-column {
            display: flex;
            align-items: center;
        }

        .action-column .button {
            margin-right:1px;
        }
       
    </style>
</head>
<body>
    <nav>
        <div class="image-txt">
            <div class="image">
            </div>
            <div class="txt">

            </div>
        </div>
    </nav>
    <div class="admin">
        <h1>ADMIN DASHBOARD</h1>
        <a href="index.php"><img src="img/deconnexion.png" alt="Deconnexion"></a>
        <a href="accueill.html"><img src="img/accueil.png" alt=""></a>
    </div>
    <fieldset>
    <table>
        <tr>
          <th style="width: 14%;">Nom</th>
          <th style="width: 14%;">Email</th>
          <th style="width: 14%;">Surface</th>
          <th style="width: 14%;">Nombre de chambre</th>
          <th style="width: 14%;">Salle de bain</th>
          <th style="width: 14%;">Emplacement</th>
          <th style="width: 20%;">Prix</th>
          <th style="width: 20%; text-align:center;">Actions</th> <!-- Nouvelle colonne pour les boutons -->
        </tr>
      
        <?php
        // Connexion à la base de données
        $con = mysqli_connect("localhost", "root", "", "login");

        // Vérifier la connexion
        if (mysqli_connect_errno()) {
            echo "Erreur de connexion à la base de données : " . mysqli_connect_error();
        } else {
            // Requête pour récupérer les données
            $query = "SELECT * FROM users  WHERE role != 'admin'";
            $result = mysqli_query($con, $query);
            

            // Vérifier si des données sont disponibles
            if (mysqli_num_rows($result) > 0) {
                // Afficher les lignes du tableau avec les données récupérées
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['nom'] . "</td>";
                    echo "<td>" . $row['email'] . "</td>";

                    // Vérifier les valeurs des colonnes avant de les afficher
                    echo "<td>";
                    if ($row['surface'] !== null) {
                        echo $row['surface'] ;
                    } else {
                        echo "Estimation en attente";
                    }
                    echo "</td>";

                    echo "<td>";
                    if ($row['nbchambre'] !== null) {
                        echo $row['nbchambre'];
                    } else {
                        echo "Estimation en attente";
                    }
                    echo "</td>";

                    echo "<td>";
                    if ($row['nbsalle'] !== null) {
                        echo $row['nbsalle'];
                    } else {
                        echo "Estimation en attente";
                    }
                    echo "</td>";

                    echo "<td>";
                    if ($row['emplacement'] !== null) {
                        echo $row['emplacement'];
                    } else {
                        echo "Estimation en attente";
                    }
                    echo "</td>";

                    echo "<td>" . $row['estimation']." F </td>";

                    // Ajouter les boutons Supprimer, Modifier et Imprimer sur la même ligne
                    echo "<td class='action-column'>";
                    echo "<a class='button button-delete' href='php/supprimer.php?iduser=" . $row['iduser'] . "'>Supprimer</a>";
                    echo "<a class='button button-update' href='maj.php?iduser=" . $row['iduser'] . "'>Modifier</a>";
                    echo "<a class='button button-print' href='imprimer.php?iduser=" . $row['iduser'] . "'>Imprimer</a>";
                    echo "</td>";

                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='8'>Aucune donnée disponible</td></tr>";
            }

            // Fermer la connexion à la base de données
            mysqli_close($con);
        }
        ?>
    </table>
    </fieldset>
    


    <hr>
    
</body>
</html>
