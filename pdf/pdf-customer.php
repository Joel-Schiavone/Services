<?php 
require('fpdf/fpdf.php');
require('../inc/conectar.php');
require_once('../modules/classes.php');

class PDF extends FPDF
{
        // Cabecera de página
        function Header()
        {
            // Logo
            $this->Image('pdf-images/logo-epta.png',8,8,20);
            // Arial bold 15
            $this->SetFont('Arial','B',15);
            // Movernos a la derecha
            $this->Cell(80);
            // Título
            $this->Cell(30,15,'Epta - Costan',0,0,'C');
            // Salto de línea
            $this->Ln(20);
        }

        // Pie de página
        function Footer()
        {
            // Posición: a 1,5 cm del final
            $this->SetY(-15);
            // Arial italic 8
            $this->SetFont('Arial','I',8);
            // Número de página
            $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
        }
}

$pdf = new PDF();
$pdf->AddPage();
$pdf->AliasNbPages();


$tabla=$_GET['tabla'];
$ID_cli= round(12*((base64_decode($_GET['id']))/12344));
$clientes = new clientes;
$tiendas  = new tiendas;

$getTiendasByCli = $tiendas->getTiendasByCli($ID_cli);
$num_getTiendasByCli = mysql_num_rows($getTiendasByCli);


$getClienteById = $clientes->getClienteById($ID_cli);
$assoc_getClienteById = mysql_fetch_assoc($getClienteById);

$titulo=$assoc_getClienteById['cli_desc'];

$contenido1="- ".$num_getTiendasByCli." Tiendas Asociadas";


$pdf->SetFont('Times','B',13);
$pdf->Cell(190,10,'Informe de cliente: '.$titulo.'',1,1,'C');
$pdf->Cell(0,10,'',0,1,'C');
$pdf->SetFont('Times','B',12);
$pdf->Cell(190,10,''.$contenido1.'',0,1,'L');

        $pdf->Cell(40,5,"Tienda",1,0,'C');
        $pdf->Cell(40,5,"Ubicacion",1,0,'C');
        $pdf->Cell(20,5,"Abonado",1,0,'C');
        $pdf->Cell(40,5,"Contacto",1,0,'C');
        $pdf->SetFont('Times','',12);    

$pdf->Output();

        for ($i=0; $i < $num_getTiendasByCli; $i++)
         { 
            $pdf->AddPage();
            $assoc_getTiendasByCli = mysql_fetch_assoc($getTiendasByCli);
            $variable              = $assoc_getTiendasByCli['obr_desc'];

            $variable              = $assoc_getTiendasByCli['obr_dir'];
            $variable              = $assoc_getTiendasByCli['obr_dir'];
            $variable              = $assoc_getTiendasByCli['obr_dir'];

            $variable              = $assoc_getTiendasByCli[''];
            $variable              = $assoc_getTiendasByCli[''];

            $pdf->Ln();
            $pdf->Cell(40,5,"linea ",1,0,'C');
            $pdf->Cell(40,5,"linea 2",1,0,'C');
            $pdf->Cell(20,5,"linea 3",1,0,'C');
            $pdf->Cell(40,5,"linea 4",1,0,'C');
            $pdf->Output();
         }  
        




?>
