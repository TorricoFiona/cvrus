<?php
require('../../librarys/fpdf/fpdf.php');

class PDF extends FPDF {
    // Cabecera
    function Header(){
        // Nada en el encabezado por ahora
    }

    // Línea separadora
    function Linea(){
        $this->SetDrawColor(0,0,0);
        $this->SetLineWidth(0.4);
        $this->Line(20, $this->GetY(), 190, $this->GetY());
        $this->Ln(5);
    }
}

$pdf=new PDF();
$pdf->AddPage();
$pdf->SetMargins(20,20,20);
$pdf->SetAutoPageBreak(true,20);

// Registrar fuentes
$pdf->AddFont('Montserrat','','Montserrat-Regular.php');
$pdf->AddFont('Montserrat','B','Montserrat-Bold.php');

// ---- NOMBRE ----
$pdf->SetFont('Montserrat','B',22);
$pdf->Cell(0,10,utf8_decode('PEDRO FERNÁNDEZ'),0,1,'C');

// ---- CONTACTO ----
$pdf->SetFont('Montserrat','',11);
$pdf->Cell(0,6,utf8_decode('(55) 1234 5678'),0,1,'C');
$pdf->Cell(0,6,utf8_decode('Calle Cualquiera 123, Cualquier Lugar'),0,1,'C');
$pdf->SetTextColor(0,0,255);
$pdf->Cell(0,6,utf8_decode('hola@sitionarialbe.com'),0,1,'C');
$pdf->SetTextColor(0,0,0);
$pdf->Ln(6);

// ---- PERFIL ----
$pdf->SetFont('Montserrat','B',12);
$pdf->Cell(0,7,utf8_decode('PERFIL'),0,1,'C');
$pdf->Linea();

$pdf->SetFont('Montserrat','',10);
$pdf->MultiCell(0,6,utf8_decode('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Es war ein wunderschöner Tag, als die Sonne über der kleinen Stadt aufging. Die Vögel zwitscherten fröhlich, und die Menschen begannen, ihren täglichen Aktivitäten nachzugehen.'));
$pdf->Ln(6);

// ---- EXPERIENCIA LABORAL ----
$pdf->SetFont('Montserrat','B',12);
$pdf->Cell(0,7,utf8_decode('EXPERIENCIA LABORAL'),0,1,'C');
$pdf->Linea();

// Puesto 1
$pdf->SetFont('Montserrat','B',11);
$pdf->Cell(130,7,utf8_decode('Director Ventas B2B'),0,0,'L');
$pdf->SetFont('Montserrat','',10);
$pdf->Cell(0,7,utf8_decode('Oct 2024 - Presente'),0,1,'R');

$pdf->SetFont('Montserrat','',10);
$pdf->SetLeftMargin(25);
$pdf->MultiCell(0,6,utf8_decode('- Lorem ipsum ist ein einfacher, aber dennoch faszinierender Platzhaltertext.
- Ursprünglich aus einem Werk von Cicero stammend, hat dieser lateinische.
- Text keine tiefere Bedeutung und dient dazu, die visuelle Gestaltung von Drucksachen zu simulieren.'));
$pdf->SetLeftMargin(20);
$pdf->Ln(4);

// Puesto 2
$pdf->SetFont('Montserrat','B',11);
$pdf->Cell(130,7,utf8_decode('Director de Growth'),0,0,'L');
$pdf->SetFont('Montserrat','',10);
$pdf->Cell(0,7,utf8_decode('Oct 2023 - 2022'),0,1,'R');

$pdf->SetLeftMargin(25);
$pdf->MultiCell(0,6,utf8_decode('- Lorem ipsum ist ein einfacher, aber dennoch faszinierender Platzhaltertext.
- Ursprünglich aus einem Werk von Cicero stammend, hat dieser lateinische.
- Text keine tiefere Bedeutung und dient dazu, die visuelle Gestaltung von Drucksachen zu simulieren.'));
$pdf->SetLeftMargin(20);
$pdf->Ln(6);

// ---- EDUCACION ----
$pdf->SetFont('Montserrat','B',12);
$pdf->Cell(0,7,utf8_decode('EDUCACIÓN'),0,1,'C');
$pdf->Linea();

$pdf->SetFont('Montserrat','',10);
$pdf->Cell(130,6,utf8_decode('Universidad San José'),0,0,'L');
$pdf->Cell(0,6,utf8_decode('2012 - 2014'),0,1,'R');
$pdf->Cell(0,6,utf8_decode('Maestría en Ventas'),0,1,'L');
$pdf->Ln(2);

$pdf->Cell(130,6,utf8_decode('Universidad Ensigna'),0,0,'L');
$pdf->Cell(0,6,utf8_decode('2007 - 2011'),0,1,'R');
$pdf->Cell(0,6,utf8_decode('Licenciatura en Administración'),0,1,'L');
$pdf->Ln(6);

// ---- CERTIFICACIONES ----
$pdf->SetFont('Montserrat','B',12);
$pdf->Cell(0,7,utf8_decode('CERTIFICACIONES Y COMPETENCIAS'),0,1,'C');
$pdf->Linea();

$pdf->SetFont('Montserrat','',10);
$pdf->SetLeftMargin(25);
for($i=0; $i<4; $i++){
    $pdf->Cell(0,6,utf8_decode('- Certificado: Lorem ipsum ist ein einfacher, aber dennoch faszinierender Platzhaltertext.'),0,1);
}
$pdf->SetLeftMargin(20);
$pdf->Ln(6);

// ---- INFORMACION ADICIONAL ----
$pdf->SetFont('Montserrat','B',12);
$pdf->Cell(0,7,utf8_decode('INFORMACIÓN ADICIONAL'),0,1,'C');
$pdf->Linea();

$pdf->SetFont('Montserrat','',10);
$pdf->Cell(0,6,utf8_decode('- Idiomas: Español (nativo), Inglés (C1)'),0,1);
$pdf->Cell(0,6,utf8_decode('- Premio: Campeón de debate'),0,1);
$pdf->Cell(0,6,utf8_decode('- Congreso: XI Congreso de Ventas como ponente'),0,1);

$pdf->Output('I','cv_recreado.pdf');
?>
