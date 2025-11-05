<?php
require('../../librarys/fpdf/fpdf.php');

class PDF extends FPDF {
    // Cabecera
    function Header() {
        // No se necesita cabecera
    }

    // Línea separadora
    function Linea() {
        $this->SetDrawColor(0,0,0);
        $this->SetLineWidth(0.4);
        $this->Line(10, $this->GetY(), 200, $this->GetY());
        $this->Ln(4);
    }
}

// Crear PDF
$pdf = new PDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);

// Nombre
$pdf->Cell(0,10,utf8_decode('JUAN GUTIERREZ'),0,1);

// Descripción
$pdf->SetFont('Arial','',10);
$pdf->MultiCell(0,5,utf8_decode('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Es war ein wunderschöner Tag, als die Sonne über der kleinen Stadt aufging. Die Vögel zwitscherten fröhlich, und die Menschen begannen, ihren täglichen Aktivitäten nachzugehen.'));
$pdf->Ln(2);

// Contacto
$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,6,utf8_decode('CONTACTO'),0,1);
$pdf->Linea();
$pdf->SetFont('Arial','',10);
$pdf->MultiCell(0,5,utf8_decode('(55) 1234-5678 - Calle Cualquiera 123, Cualquier Lugar - hola@sitioincreible.com'));
$pdf->Ln(2);

// Experiencia Laboral
$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,6,utf8_decode('EXPERIENCIA LABORAL'),0,1);
$pdf->Linea();

// Director Ventas B2B
$pdf->SetFont('Arial','B',10);
$pdf->Cell(0,5,utf8_decode('Director Ventas B2B'),0,0);
$pdf->Cell(0,5,utf8_decode('Oct 2024 - Presente'),0,1,'R');
$pdf->SetFont('Arial','',10);
$pdf->MultiCell(0,5,utf8_decode('Lorem Ipsum ist ein einfacher, aber dennoch faszinierender Platzhaltertext, der seit Jahrhunderten in der Druck- und Satzindustrie verwendet wird. Ursprünglich aus einem Werk von Cicero stammend, hat dieser lateinische Text keine tiefere Bedeutung und dient dazu, die visuelle Gestaltung von Drucksachen zu simulieren.'));
$pdf->Ln(2);

// Director de Growth
$pdf->SetFont('Arial','B',10);
$pdf->Cell(0,5,utf8_decode('Director de Growth'),0,0);
$pdf->Cell(0,5,utf8_decode('Oct 2023 - 2022'),0,1,'R');
$pdf->SetFont('Arial','',10);
$pdf->MultiCell(0,5,utf8_decode('Lorem Ipsum ist ein einfacher, aber dennoch faszinierender Platzhaltertext, der seit Jahrhunderten in der Druck- und Satzindustrie verwendet wird. Ursprünglich aus einem Werk von Cicero stammend, hat dieser lateinische Text keine tiefere Bedeutung und dient dazu, die visuelle Gestaltung von Drucksachen zu simulieren.'));
$pdf->Ln(2);

// Educación
$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,6,utf8_decode('EDUCACIÓN'),0,1);
$pdf->Linea();

// Universidad San Jose
$pdf->SetFont('Arial','B',10);
$pdf->Cell(0,5,utf8_decode('Universidad San Jose'),0,0);
$pdf->Cell(0,5,utf8_decode('2012 - 2014'),0,1,'R');
$pdf->SetFont('Arial','',10);
$pdf->Cell(10);
$pdf->Cell(0,5,utf8_decode('Maestría en Ventas'),0,1);
$pdf->Cell(15);
$pdf->Cell(0,5,utf8_decode('- Promedio: 10'),0,1);

// Universidad Ensigna
$pdf->SetFont('Arial','B',10);
$pdf->Cell(0,5,utf8_decode('Universidad Ensigna'),0,0);
$pdf->Cell(0,5,utf8_decode('2007 - 2011'),0,1,'R');
$pdf->SetFont('Arial','',10);
$pdf->Cell(10);
$pdf->Cell(0,5,utf8_decode('Licenciatura en Administración'),0,1);
$pdf->Cell(15);
$pdf->Cell(0,5,utf8_decode('- Promedio: 9.40'),0,1);
$pdf->Cell(15);
$pdf->Cell(0,5,utf8_decode('- Diploma de honor'),0,1);
$pdf->Ln(2);

// Licencias y Membresías
$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,6,utf8_decode('LICENCIAS Y MEMBRESÍAS'),0,1);
$pdf->Linea();
$pdf->SetFont('Arial','',10);
$pdf->MultiCell(0,5,utf8_decode('Lorem Ipsum ist ein einfacher, aber dennoch faszinierender Platzhaltertext, der seit Jahrhunderten in der Druck- und Satzindustrie verwendet wird. Ursprünglich aus einem Werk von Cicero stammend.'));
$pdf->Ln(2);

// Habilidades Profesionales y Personales
$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,6,utf8_decode('HABILIDADES PROFESIONALES Y PERSONALES'),0,1);
$pdf->Linea();
$pdf->SetFont('Arial','',10);
$pdf->MultiCell(0,5,utf8_decode('Idiomas: Español (nativo), Inglés (C1+).'));

// Generar PDF
$pdf->Output();
?>
