<?php
require('tcpdf/tcpdf.php');
include("php/config.php");

session_start();
$iduser = $_SESSION['iduser'];


$query = "SELECT * FROM users WHERE iduser = ?";
$stmt = $con->prepare($query);
$stmt->bind_param("s", $iduser);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
$pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8');

$pdf->SetCreator('PROLogis');
$pdf->SetAuthor('PROLogis');
$pdf->SetTitle("FICHE D'ESTIMATION IMMOBILIERE");
$pdf->setHeaderData('', 0, 'PROLOGIS', '');
$pdf->AddPage();

$pdf->SetFont('helvetica', '',20);
$pdf->Cell(0, 20, "FICHE D'ESTIMATION IMMOBILIERE", 0, 1, 'C');
$pdf->SetFont('helvetica', '', 12);
$imagePath = 'logo.png';
$pdf->Image($imagePath, 52, 5, 100, 100);
$pdf->SetY(60);
$pdf->Cell(0, 10, 'Prologis', 0, 1, 'C');
$pdf->Ln(8);


$pdf->SetX(50);
$pdf->Cell(0, 10, 'Nom complet: '. $user['nom'] . '                         Email: ' . $user['email'], 0, 1, 'L');
$pdf->Ln(6);
$pdf->Write(8, '*-----------------------------------------------------------------------------------------------------------------------------------*');
$pdf->Ln(6);
$pdf->SetFont('helvetica', '',11);
$pdf->SetX(50);
$pdf->Ln(6);


$pdf->SetFillColor(170, 143, 254);
$pdf->Cell(25, 10, 'Surface', 1, 0, 'L', 1);
$pdf->Cell(40, 10, 'Nombre de chambre', 1, 0, 'L', 1); 
$pdf->Cell(50, 10, 'Nombre de Salle de bains', 1, 0, 'L', 1);
$pdf->Cell(40, 10, 'Emplacement', 1, 0, 'L', 1);
$pdf->Cell(35,10,'Prix',1,0,'L',1);
$pdf->Ln(10);


$pdf->Cell(25, 10, $user['surface'] . ' m²', 1, 0, 'L'); 
$pdf->Cell(40, 10, $user['nbchambre'], 1, 0, 'L'); 
$pdf->Cell(50, 10, $user['nbsalle'], 1, 0, 'L'); 
$pdf->Cell(40, 10, $user['emplacement'], 1, 0, 'L');
$pdf->Cell(35, 10, $user['estimation'].' FCFA', 1, 0, 'L');  
$pdf->Ln(30);



$iduserBinary = decbin($iduser);
$barcodeValue = 'ABC' . $iduserBinary; 
$barcodeOptions = array('position' => 'L', 'align' => 'C', 'stretch' => true, 'fitwidth' => true, 'cellfitalign' => 'C');
$pdf->write1DBarcode($barcodeValue, 'C128', 15, '', 180, 10, 0.2, $barcodeOptions, 'N');

// ...

$pdf->SetY(155);
$pdf->SetX(15);
$pdf->SetFont('helvetica', '', 10);
$pdf->Cell(0,0,''     . $iduserBinary, 0, 1, 'L');
$pdf->Ln(20);

$pdf->SetY(0); 
$pdf->SetFont('helvetica', 'I', 8); 
$pdf->Cell(0, 10, 'Date : ' . date('d-m-Y'), 0, 0, 'R'); 
// Signature de l'intéressé
$pdf->SetY($pdf->getPageHeight() - 50);
$pdf->SetX(20);
$pdf->SetFont('helvetica', '', 12);
$pdf->Cell(40, 10, "Signature de l'intéressé", 0, 0, 'L');

// Signature de l'agence
$pdf->SetX($pdf->getPageWidth() -60);
$pdf->SetFont('helvetica', '', 12);
$pdf->Cell(40, 10, "Signature de l'agence", 0, 0, 'R');
$pdf->SetY($pdf->getPageHeight() - 30);
$pdf->SetFont('helvetica', '', 10);
$pdf->Output("fiche_d'estimation.pdf", 'D');
echo "";
?>
