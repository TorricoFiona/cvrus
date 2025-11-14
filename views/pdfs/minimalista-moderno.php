<?php
session_start();
require('../../librarys/fpdf/fpdf.php');
require_once '../../env.php';
require_once '../../models/DBAbstract.php';
require_once '../../models/ProfileModel.php';

// Helpers
function safe($s){ return utf8_decode($s ?? ''); }
function fechaRango2($ini,$fin){ if(!$ini && !$fin) return ''; return ($ini?:'Sin fecha')." - ".($fin?:'Actual'); }

// Datos
$id_usuario = $_SESSION['user_id'] ?? ($_GET['id_usuario'] ?? null);
if(!$id_usuario){ die('No se especificó usuario'); }
$perfilModel = new Perfil();
$data = $perfilModel->obtenerPerfil($id_usuario);

class PDF extends FPDF {
    function Header(){}
    function LineaVertical($x,$y1,$y2){ $this->SetDrawColor(0,0,0); $this->SetLineWidth(0.4); $this->Line($x,$y1,$x,$y2); }
    function LineaHorizontal($x1,$y,$x2){ $this->SetDrawColor(0,0,0); $this->SetLineWidth(0.4); $this->Line($x1,$y,$x2,$y); }
}

$pdf = new PDF();
$pdf->AddPage();
$pdf->SetMargins(15,15,15);

// Línea divisoria
$pdf->LineaVertical(65, 15, 275);

// Foto (sesión > uploads)
$foto = null;
if(isset($_SESSION['profile_photo_path']) && file_exists($_SESSION['profile_photo_path'])){
    $foto = $_SESSION['profile_photo_path'];
} else {
    $base = realpath(__DIR__ . '/../assets/img/uploads');
    if($base){
        foreach(['jpg','jpeg','png'] as $e){
            $c = $base . DIRECTORY_SEPARATOR . 'profile_' . $id_usuario . '.' . $e;
            if(file_exists($c)){ $foto=$c; break; }
        }
    }
}
if($foto){ $pdf->Image($foto,15,15,40); }

// Columna izquierda dinámica
$xLeft = 15; $wLeft = 40; $y = 65; // debajo de la foto

// Contacto
$pdf->SetFont('Arial','B',12); $pdf->SetXY($xLeft,$y); $pdf->Cell(0,6,utf8_decode('Contacto'));
$y += 10; $pdf->SetFont('Arial','',10);
$tel = $data['usuario']['telefono'] ?? '';
$email = $data['usuario']['email'] ?? '';
$addr = trim(($data['usuario']['domicilio'] ?? '') . ' ' . ($data['usuario']['localidad'] ?? ''));
if($tel){ $pdf->SetXY($xLeft,$y); $pdf->Cell(0,6,safe($tel)); $y+=7; }
if($email){ $pdf->SetXY($xLeft,$y); $pdf->Cell(0,6,safe($email)); $y+=7; }
if($addr){ $pdf->SetXY($xLeft,$y); $pdf->MultiCell($wLeft,5,safe($addr)); $y = $pdf->GetY()+3; }

// Idiomas
$pdf->SetFont('Arial','B',12); $pdf->SetXY($xLeft,$y); $pdf->Cell(0,6,utf8_decode('Idiomas'));
$y += 8; $pdf->SetFont('Arial','',10);
$idiomas = array_map(function($i){ return $i['idioma']; }, $data['idiomas']);
if(count($idiomas)>0){
    foreach($idiomas as $idi){ $pdf->SetXY($xLeft,$y); $pdf->Cell(0,6,safe('• '.$idi)); $y+=6; }
} else { $pdf->SetXY($xLeft,$y); $pdf->Cell(0,6,utf8_decode('Sin idiomas')); $y+=6; }
$y += 4;

// Sobre mí
$pdf->SetFont('Arial','B',12); $pdf->SetXY($xLeft,$y); $pdf->Cell(0,6,utf8_decode('Sobre mí'));
$y += 8; $pdf->SetFont('Arial','',10);
$presentacion = $data['formulario']['presentacion'] ?? 'Sin presentación personal.';
$pdf->SetXY($xLeft,$y); $pdf->MultiCell($wLeft,5,safe($presentacion));
$y = $pdf->GetY()+4;

// Columna derecha
$xRight = 70; $yR = 15; $wRight = 125;

// Nombre y título
$nombre = trim(($data['usuario']['nombre'] ?? '').' '.($data['usuario']['apellido'] ?? ''));
if($nombre==='') $nombre='Sin nombre';
$pdf->SetFont('Arial','B',16); $pdf->SetXY($xRight,$yR); $pdf->Cell(0,8,safe(strtoupper($nombre))); $yR += 10;
$titulo = $data['formulario']['area_pretendida'] ?? ($data['formulario']['perfil_egresado'] ?? '');
if($titulo){ $pdf->SetFont('Arial','',12); $pdf->SetXY($xRight,$yR); $pdf->Cell(0,6,safe($titulo)); $yR += 10; }

// Experiencia Profesional
$pdf->SetFont('Arial','B',12); $pdf->SetXY($xRight,$yR); $pdf->Cell(0,6,utf8_decode('Experiencia profesional')); $yR+=8;
$pdf->SetFont('Arial','',10);
if(count($data['experiencias'])==0){ $pdf->SetXY($xRight,$yR); $pdf->Cell(0,6,utf8_decode('Sin experiencias registradas.')); $yR+=8; }
foreach($data['experiencias'] as $exp){
    $periodo = fechaRango2($exp['fecha_inicio'],$exp['fecha_fin']);
    $empresa = $exp['empresa'] ?: '';
    $linea = trim($periodo . ' | ' . $empresa);
    if($linea!==''){ $pdf->SetFont('Arial','B',10); $pdf->SetXY($xRight,$yR); $pdf->Cell(0,6,safe($linea)); $yR+=6; }
    if(!empty($exp['puesto'])){ $pdf->SetFont('Arial','',10); $pdf->SetXY($xRight,$yR); $pdf->Cell(0,6,safe($exp['puesto'])); $yR+=6; }
    if(!empty($exp['descripcion'])){ $pdf->SetXY($xRight,$yR); $pdf->MultiCell($wRight,5,safe($exp['descripcion'])); $yR = $pdf->GetY()+4; }
}

// Educación
$pdf->SetFont('Arial','B',12); $pdf->SetXY($xRight,$yR); $pdf->Cell(0,6,utf8_decode('Educación')); $yR+=8;
$pdf->SetFont('Arial','',10);
if(count($data['educacion_adicional'])==0){ $pdf->SetXY($xRight,$yR); $pdf->Cell(0,6,utf8_decode('Sin educación adicional.')); $yR+=8; }
foreach($data['educacion_adicional'] as $edu){
    $pdf->SetFont('Arial','B',10); $pdf->SetXY($xRight,$yR); $pdf->Cell(0,6,safe($edu['institucion'] ?: 'Institución')); $pdf->SetFont('Arial','',10);
    $pdf->SetXY($xRight,$yR); $pdf->Cell($wRight,6,safe(fechaRango2($edu['fecha_inicio'],$edu['fecha_fin'])),0,0,'R'); $yR+=6;
    if(!empty($edu['curso_realizado'])){ $pdf->SetXY($xRight,$yR); $pdf->Cell(0,6,safe($edu['curso_realizado'])); $yR+=6; }
}

// Habilidades blandas
$pdf->SetFont('Arial','B',12); $pdf->SetXY($xRight,$yR); $pdf->Cell(0,6,utf8_decode('Habilidades personales')); $yR+=8;
$soft = array_map(function($h){ return $h['habilidad']; }, $data['habilidades_personales']);
if(count($soft)>0){ $pdf->SetFont('Arial','',10); $pdf->SetXY($xRight,$yR); $pdf->MultiCell($wRight,5,safe(implode(', ',$soft))); $yR=$pdf->GetY()+6; }

// Competencias técnicas
$pdf->SetFont('Arial','B',12); $pdf->SetXY($xRight,$yR); $pdf->Cell(0,6,utf8_decode('Habilidades técnicas')); $yR+=8;
$tec = array_map(function($h){ return $h['habilidad']; }, $data['habilidades_tecnicas']);
if(count($tec)>0){ $pdf->SetFont('Arial','',10); $pdf->SetXY($xRight,$yR); $pdf->MultiCell($wRight,5,safe(implode(', ',$tec))); $yR=$pdf->GetY()+6; }

// Proyectos (opcional)
if(count($data['proyectos'])>0){
    $pdf->SetFont('Arial','B',12); $pdf->SetXY($xRight,$yR); $pdf->Cell(0,6,utf8_decode('Proyectos')); $yR+=8;
    $pdf->SetFont('Arial','',10);
    $proy = array_map(function($p){ return $p['proyecto']; }, $data['proyectos']);
    $pdf->SetXY($xRight,$yR); $pdf->MultiCell($wRight,5,safe(implode("\n",$proy))); $yR=$pdf->GetY()+6;
}

$pdf->Output('I','cv_minimalista_moderno.pdf');
