<?php
require('tcpdf/tcpdf.php'); // Assurez-vous d'ajuster le chemin d'accès à la bibliothèque TCPDF

// Connexion à la base de données
$con = mysqli_connect("localhost", "root", "", "login");

// Vérifier la connexion
if (mysqli_connect_errno()) {
    echo "Erreur de connexion à la base de données : " . mysqli_connect_error();
} 
else {
    if (isset($_GET['iduser'])) {
        $userId = $_GET['iduser'];
        $query = "SELECT iduser, nom, email, surface, nbchambre, nbsalle, emplacement, estimation FROM users WHERE iduser=$userId";
        $result = mysqli_query($con, $query);

    // Vérifier si des données sont disponibles
    if (mysqli_num_rows($result) > 0) {
        $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8');
        $pdf->setHeaderData('', 0, "FICHE D'ESTIMATION", '');
        $pdf->AddPage();
        $pdf->SetY(0); 
        $pdf->SetFont('helvetica', 'I', 8); 
        $pdf->Cell(0, 10, 'Date : ' . date('d-m-Y'), 0, 0, 'R'); 
        $pdf->SetFont('helvetica', '',10);
        $imagePath = 'logo.png';
        $pdf->Image($imagePath, 52, 5, 100, 100);
        $pdf->SetY(60);
        $pdf->Cell(0, 10, 'Prologis', 0, 1, 'C');
        $pdf->Ln(15);
        $pdf->SetFont('helvetica', '',8);
        $content = '<table>
                        <tr>
                            <th style="width: 8%;">Iduser</th>
                            <th style="width: 14%;">Nom complet</th>
                            <th style="width: 15%;">Email</th>
                            <th style="width: 10%;">Surface</th>
                            <th style="width: 18%;">Nombre de chambre</th>
                            <th style="width: 15%;">Salle de bain</th>
                            <th style="width: 14%;">Emplacement</th>
                            <th style="width: 10%;">Prix</th>
                        </tr>';

        // Ajoutez les données de chaque ligne du tableau au contenu du fichier PDF
        while ($row = mysqli_fetch_assoc($result)) {
            $content .= '<tr>';
            $content .= '<td>' . $row['iduser'] . '</td>';
            $content .= '<td>' . $row['nom'] . '</td>';
            $content .= '<td>' . $row['email'] . '</td>';
            $content .= '<td>' . $row['surface'] . '</td>';
            $content .= '<td>' . $row['nbchambre'] . '</td>';
            $content .= '<td>' . $row['nbsalle'] . '</td>';
            $content .= '<td>' . $row['emplacement'] . '</td>';
            $content .= '<td>' . $row['estimation'] . ' F</td>';
            $content .= '</tr>';
        }

        $content .= '</table>';
        
        $pdf->SetAutoPageBreak(false);
        // Ajoutez le contenu au fichier PDF
        $pdf->writeHTML($content, true, false, true, false, '');
              // Ajoutez la signature de l'intéressé en bas à gauche
        $pdf->SetY(-30);
        $pdf->SetFont('helvetica', '', 10);
        $pdf->Cell(0, 10, "Signature de l'intéressé ", 0, 0, 'L', false, '', 0, false, 'T', 'M');

// Ajoutez la signature de l'agence en bas à droite
        $pdf->SetX(-90);
        $pdf->SetFont('helvetica', '', 10);
        $pdf->Cell(0, 10, "Signature de l'agence ", 0, 0, 'R', false, '', 0, false, 'T', 'M');

        // Définissez le type de contenu du fichier
        header('Content-Type: application/pdf');
        // Spécifiez le nom du fichier PDF en sortie
        header('Content-Disposition: attachment; filename="fiche_estimation.pdf"');

        // Renvoyez le contenu du fichier PDF généré
        echo $pdf->Output('S');
    } else {
        echo "Aucune donnée disponible";
    }
    }

    // Fermer la connexion à la base de données
    mysqli_close($con);
}
?>
