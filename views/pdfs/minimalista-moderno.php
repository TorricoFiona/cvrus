<?php
require('../../librarys/fpdf/fpdf.php');

class PDF extends FPDF {
    // Cabecera
    function Header() {
        // Nada en el encabezado
    }

    // Línea separadora vertical
    function LineaVertical($x, $y1, $y2) {
        $this->SetDrawColor(0,0,0);
        $this->SetLineWidth(0.4);
        $this->Line($x, $y1, $x, $y2);
    }

    // Línea separadora horizontal
    function LineaHorizontal($x1, $y, $x2) {
        $this->SetDrawColor(0,0,0);
        $this->SetLineWidth(0.4);
        $this->Line($x1, $y, $x2, $y);
    }
}

$pdf = new PDF();
$pdf->AddPage();
$pdf->SetMargins(15, 15, 15);

// FOTO
$pdf->Image('ej-img.png',15,15,40,0,'PNG');

// LINEA DIVISORIA
$pdf->LineaVertical(65, 15, 275);

// CONTACTO
$pdf->SetFont('Arial','B',12);
$pdf->SetXY(15, 65);
$pdf->Cell(0,6,utf8_decode('Contatti'));

$pdf->SetFont('Arial','',10);
$pdf->SetXY(15,75);
$pdf->Cell(0,6,utf8_decode('+123-456-7890'));

$pdf->SetXY(15,82);
$pdf->Cell(0,6,utf8_decode('hello@reallygreatsite.com'));

$pdf->SetXY(15,89);
$pdf->Cell(0,6,utf8_decode('www.reallygreatsite.com'));

// LENGUAS
$pdf->SetFont('Arial','B',12);
$pdf->SetXY(15,105);
$pdf->Cell(0,6,utf8_decode('Lingue'));

$pdf->SetFont('Arial','',10);
$pdf->SetXY(15,115);
$pdf->Cell(0,6,utf8_decode('Italiano      Madrelingua'));
$pdf->SetXY(15,122);
$pdf->Cell(0,6,utf8_decode('Inglese      C1'));
$pdf->SetXY(15,129);
$pdf->Cell(0,6,utf8_decode('Spagnolo     B2'));
$pdf->SetXY(15,136);
$pdf->Cell(0,6,utf8_decode('Francese     B1'));

// SOBRE MI
$pdf->SetFont('Arial','B',12);
$pdf->SetXY(15,152);
$pdf->Cell(0,6,utf8_decode('Su di me'));

$pdf->SetFont('Arial','',10);
$pdf->SetXY(15,162);
$pdf->MultiCell(40,5,utf8_decode("Creativa e professionale.\nSpecializzata in Visual Design.\nSono proattiva, Imparo in fretta nuove metodologie di lavoro e mi piace tenermi aggiornata sul trend."),0,'L');

// NOMBRE Y TITULO
$pdf->SetFont('Arial','B',16);
$pdf->SetXY(70,15);
$pdf->Cell(0,8,utf8_decode('Greta Mae Evans'));

$pdf->SetFont('Arial','',12);
$pdf->SetXY(70,23);
$pdf->Cell(0,6,utf8_decode('Visual Design Specialist'));

// EXPERIENCIA PROFESIONAL
$pdf->SetFont('Arial','B',12);
$pdf->SetXY(70,35);
$pdf->Cell(0,6,utf8_decode('Esperienza professionale'));

// Primer trabajo
$pdf->SetFont('Arial','B',10);
$pdf->SetXY(70,45);
$pdf->Cell(0,6,utf8_decode('2022 - 2023 | STUDIO SHODWE'));
$pdf->SetFont('Arial','',10);
$pdf->SetXY(70,51);
$pdf->Cell(0,6,utf8_decode('Visual Design Specialist'));
$pdf->SetXY(70,57);
$pdf->MultiCell(0,5,utf8_decode('Lorem Ipsum dolor sit amet, consectetur adipiscing elit. Aliquam scelerisque tempor turpis, sed feugiat nunc ultrices id. Morbi porta dui in nisl venenatis, nec bibendum lacus cursus.'));

// Segundo trabajo
$pdf->SetFont('Arial','B',10);
$pdf->SetXY(70,75);
$pdf->Cell(0,6,utf8_decode('2020 - 2021 | LICERIA & CO.'));
$pdf->SetFont('Arial','',10);
$pdf->SetXY(70,81);
$pdf->Cell(0,6,utf8_decode('Visual Designer'));
$pdf->SetXY(70,87);
$pdf->MultiCell(0,5,utf8_decode('Lorem Ipsum dolor sit amet, consectetur adipiscing elit. Aliquam scelerisque tempor turpis, sed feugiat nunc ultrices id. Morbi porta dui in nisl venenatis, nec bibendum lacus cursus.'));

// Tercer trabajo
$pdf->SetFont('Arial','B',10);
$pdf->SetXY(70,105);
$pdf->Cell(0,6,utf8_decode('2020 - 2021 | THYNK UNLIMITED'));
$pdf->SetFont('Arial','',10);
$pdf->SetXY(70,111);
$pdf->Cell(0,6,utf8_decode('Junior Art Director'));
$pdf->SetXY(70,117);
$pdf->MultiCell(0,5,utf8_decode('Lorem Ipsum dolor sit amet, consectetur adipiscing elit. Aliquam scelerisque tempor turpis, sed feugiat nunc ultrices id. Morbi porta dui in nisl venenatis, nec bibendum lacus cursus.'));

// EDUCACION
$pdf->SetFont('Arial','B',12);
$pdf->SetXY(70,135);
$pdf->Cell(0,6,utf8_decode('Istruzione e formazione'));

// Universidad 1
$pdf->SetFont('Arial','B',10);
$pdf->SetXY(70,145);
$pdf->Cell(0,6,utf8_decode('2013 - 2016 | UNIVERSITÀ DI MILANO'));
$pdf->SetFont('Arial','',10);
$pdf->SetXY(70,151);
$pdf->Cell(0,6,utf8_decode('Laurea Magistrale in Design'));

// Universidad 2
$pdf->SetFont('Arial','B',10);
$pdf->SetXY(70,161);
$pdf->Cell(0,6,utf8_decode('2010 - 2013 | UNIVERSITÀ DI MILANO'));
$pdf->SetFont('Arial','',10);
$pdf->SetXY(70,167);
$pdf->Cell(0,6,utf8_decode('Laurea Triennale in Design'));

// Escuela
$pdf->SetFont('Arial','B',10);
$pdf->SetXY(70,177);
$pdf->Cell(0,6,utf8_decode('2005 - 201 | LICEO LINGUISTICO DI MILANO'));
$pdf->SetFont('Arial','',10);
$pdf->SetXY(70,183);
$pdf->Cell(0,6,utf8_decode('Diploma in Lingue'));

// HABILIDADES
$pdf->SetFont('Arial','B',12);
$pdf->SetXY(70,195);
$pdf->Cell(0,6,utf8_decode('Capacità relazionali e organizzative'));

$pdf->SetFont('Arial','',10);
$pdf->SetXY(70,201);
$pdf->MultiCell(0,5,utf8_decode('Lorem Ipsum dolor sit amet, consectetur adipiscing elit. Aliquam scelerisque tempor turpis, sed feugiat nunc ultrices id. Morbi porta dui in nisl venenatis, nec bibendum lacus cursus.'));

// COMPETENCIAS TECNICAS
$pdf->SetFont('Arial','B',12);
$pdf->SetXY(70,215);
$pdf->Cell(0,6,utf8_decode('Capacità e competenze tecniche'));

$pdf->SetFont('Arial','',10);
$pdf->SetXY(70,221);
$pdf->MultiCell(0,5,utf8_decode('Lorem Ipsum dolor sit amet, consectetur adipiscing elit. Aliquam scelerisque tempor turpis, sed feugiat nunc ultrices id. Morbi porta dui in nisl venenatis, nec bibendum lacus cursus.'));

// Salida
$pdf->Output();
