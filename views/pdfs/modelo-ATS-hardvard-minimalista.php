<?php
session_start();
require('../../librarys/fpdf/fpdf.php');
require_once '../../env.php';
require_once '../../models/DBAbstract.php';
require_once '../../models/ProfileModel.php';

function safe2($s){ return utf8_decode($s ?? ''); }
function rango($a,$b){ if(!$a && !$b) return ''; return ($a?:'Sin fecha').' - '.($b?:'Actual'); }

$id_usuario = $_SESSION['user_id'] ?? ($_GET['id_usuario'] ?? null);
if(!$id_usuario){ die('No se especificó usuario'); }
$perfil = new Perfil();
$data = $perfil->obtenerPerfil($id_usuario);

class PDF extends FPDF {
    function Header(){}
    function Linea(){ $this->SetDrawColor(0,0,0); $this->SetLineWidth(0.4); $this->Line(10,$this->GetY(),200,$this->GetY()); $this->Ln(4);}    
}

$pdf = new PDF();
$pdf->AddPage();

// Sin foto arriba; mantener un pequeño espacio superior
$pdf->Ln(10);

// Nombre
$nombre = trim(($data['usuario']['nombre'] ?? '').' '.($data['usuario']['apellido'] ?? '')); if($nombre==='') $nombre='Sin nombre';
$pdf->SetFont('Arial','B',16);
$pdf->Cell(0,10,safe2(strtoupper($nombre)),0,1,'C');

// Descripción (presentación)
$pdf->SetFont('Arial','',10);
$presentacion = $data['formulario']['presentacion'] ?? '';
if($presentacion){ $pdf->MultiCell(0,5,safe2($presentacion)); $pdf->Ln(2); }

// Contacto
$pdf->SetFont('Arial','B',12); $pdf->Cell(0,6,utf8_decode('CONTACTO'),0,1); $pdf->Linea();
$pdf->SetFont('Arial','',10);
$tel = $data['usuario']['telefono'] ?? '';
$addr = trim(($data['usuario']['domicilio'] ?? '').' '.($data['usuario']['localidad'] ?? ''));
$email = $data['usuario']['email'] ?? '';
$contactParts = array_filter([$tel,$addr,$email], function($v){return trim($v) !== '';});
if(count($contactParts)>0){ $pdf->MultiCell(0,5,safe2(implode(' - ',$contactParts))); } else { $pdf->MultiCell(0,5,utf8_decode('Sin datos de contacto.')); }
$pdf->Ln(2);

// Experiencia Laboral
$pdf->SetFont('Arial','B',12); $pdf->Cell(0,6,utf8_decode('EXPERIENCIA LABORAL'),0,1); $pdf->Linea();
if(count($data['experiencias'])==0){
    $pdf->SetFont('Arial','',10); $pdf->Cell(0,6,utf8_decode('Sin experiencias registradas.'),0,1);
} else {
    foreach($data['experiencias'] as $exp){
        $pdf->SetFont('Arial','B',10);
        $pdf->Cell(0,5,safe2($exp['puesto'] ?: 'Puesto'),0,0);
        $pdf->SetFont('Arial','',10);
        $pdf->Cell(0,5,safe2(rango($exp['fecha_inicio'],$exp['fecha_fin'])),0,1,'R');
        $texto = '';
        if(!empty($exp['empresa'])) $texto .= 'Empresa: '.$exp['empresa']."\n";
        if(!empty($exp['descripcion'])) $texto .= $exp['descripcion'];
        if($texto==='') $texto='Sin descripción.';
        $pdf->MultiCell(0,5,safe2($texto));
        $pdf->Ln(2);
    }
}

// Educación
$pdf->SetFont('Arial','B',12); $pdf->Cell(0,6,utf8_decode('EDUCACIÓN'),0,1); $pdf->Linea();
if(count($data['educacion_adicional'])==0){ $pdf->SetFont('Arial','',10); $pdf->Cell(0,6,utf8_decode('Sin educación adicional.'),0,1); }
foreach($data['educacion_adicional'] as $edu){
    $pdf->SetFont('Arial','B',10); $pdf->Cell(0,5,safe2($edu['institucion'] ?: 'Institución'),0,0); $pdf->SetFont('Arial','',10);
    $pdf->Cell(0,5,safe2(rango($edu['fecha_inicio'],$edu['fecha_fin'])),0,1,'R');
    if(!empty($edu['curso_realizado'])){ $pdf->Cell(10); $pdf->Cell(0,5,safe2($edu['curso_realizado']),0,1); }
}
$pdf->Ln(2);

// Certificaciones / Títulos
$pdf->SetFont('Arial','B',12); $pdf->Cell(0,6,utf8_decode('CERTIFICACIONES Y TÍTULOS'),0,1); $pdf->Linea();
if(count($data['titulos'])==0){ $pdf->SetFont('Arial','',10); $pdf->MultiCell(0,5,utf8_decode('Sin certificaciones cargadas.')); }
else { $pdf->SetFont('Arial','',10); foreach($data['titulos'] as $t){ $pdf->Cell(0,5,safe2('• '.$t['titulo']),0,1); } }
$pdf->Ln(2);

// Habilidades e Idiomas
$pdf->SetFont('Arial','B',12); $pdf->Cell(0,6,utf8_decode('HABILIDADES E IDIOMAS'),0,1); $pdf->Linea();
$tec = array_map(function($h){ return $h['habilidad']; }, $data['habilidades_tecnicas']);
$soft = array_map(function($h){ return $h['habilidad']; }, $data['habilidades_personales']);
$idi = array_map(function($i){ return $i['idioma']; }, $data['idiomas']);
$pdf->SetFont('Arial','',10);
if(count($tec)>0) $pdf->MultiCell(0,5,safe2('Técnicas: '.implode(', ',$tec)));
if(count($soft)>0) $pdf->MultiCell(0,5,safe2('Personales: '.implode(', ',$soft)));
if(count($idi)>0) $pdf->MultiCell(0,5,safe2('Idiomas: '.implode(', ',$idi)));

// Generar PDF
$pdf->Output('I','cv_harvard_minimalista.pdf');
?>
