<?php
// Connexion à la base de données
include("config.php");

// Vérification de la connexion
if (mysqli_connect_errno()) {
    echo "Erreur de connexion à la base de données : " . mysqli_connect_error();
} else {
    // Vérification si l'ID de l'utilisateur est passé dans l'URL
    if (isset($_GET['iduser'])) {
        $userId = $_GET['iduser'];

        // Requête de suppression de l'utilisateur
        $query = "DELETE FROM users WHERE iduser= $userId";
        $result = mysqli_query($con, $query);

        if ($result) {
            echo "Utilisateur supprimé avec succès";
            header("location:../admin-dashboard.php");
        } else {
            echo "Erreur lors de la suppression de l'utilisateur : " . mysqli_error($con);
        }
    } else {
        echo "ID de l'utilisateur non spécifié";
    }

    // Fermer la connexion à la base de données
    mysqli_close($con);
}
?>
