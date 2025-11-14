<?php
session_start();
require('../../librarys/fpdf/fpdf.php');
require_once '../../env.php';
require_once '../../models/DBAbstract.php';
require_once '../../models/ProfileModel.php';

// Determinar id_usuario (prioridad: sesión -> GET)
$id_usuario = $_SESSION['user_id'] ?? ($_GET['id_usuario'] ?? null);
if(!$id_usuario){
    die('No se especificó usuario');
}

$perfilModel = new Perfil();
$data = $perfilModel->obtenerPerfil($id_usuario);

// Helpers
function safe($str){ return utf8_decode($str ?? ''); }
function fechaRango($ini,$fin){
    if(!$ini && !$fin) return '';
    return ($ini ?: 'Sin fecha')." - ".($fin ?: 'Actual');
}

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
// Nombre completo (sin foto)
$nombreCompleto = trim(($data['usuario']['nombre'] ?? '').' '.($data['usuario']['apellido'] ?? ''));
if($nombreCompleto === '') $nombreCompleto = 'Sin nombre';
$pdf->Cell(0,10,safe(strtoupper($nombreCompleto)),0,1,'C');

// ---- CONTACTO ----
$pdf->SetFont('Montserrat','',11);
// Contacto
$tel = $data['usuario']['telefono'] ?? '';
$dom = $data['usuario']['domicilio'] ?? '';
$loc = $data['usuario']['localidad'] ?? '';
$email = $data['usuario']['email'] ?? '';
$pdf->Cell(0,6,safe($tel ?: 'Sin teléfono'),0,1,'C');
$pdf->Cell(0,6,safe(trim($dom.' '.$loc) ?: 'Sin domicilio'),0,1,'C');
if($email){
    $pdf->SetTextColor(0,0,255);
    $pdf->Cell(0,6,safe($email),0,1,'C');
    $pdf->SetTextColor(0,0,0);
}
$pdf->Ln(6);

// ---- PERFIL ----
$pdf->SetFont('Montserrat','B',12);
$pdf->Cell(0,7,utf8_decode('PERFIL'),0,1,'C');
$pdf->Linea();

$pdf->SetFont('Montserrat','',10);
$presentacion = $data['formulario']['presentacion'] ?? 'Sin presentación personal disponible.';
$pdf->MultiCell(0,6,safe($presentacion));
$pdf->Ln(6);

// ---- EXPERIENCIA LABORAL ----
$pdf->SetFont('Montserrat','B',12);
$pdf->Cell(0,7,utf8_decode('EXPERIENCIA LABORAL'),0,1,'C');
$pdf->Linea();

if(count($data['experiencias'])==0){
    $pdf->SetFont('Montserrat','',10);
    $pdf->Cell(0,6,safe('Sin experiencias registradas.'),0,1,'L');
    $pdf->Ln(4);
} else {
    foreach($data['experiencias'] as $exp){
        $pdf->SetFont('Montserrat','B',11);
        $pdf->Cell(130,7,safe($exp['puesto'] ?: 'Puesto no especificado'),0,0,'L');
        $pdf->SetFont('Montserrat','',10);
        $periodo = fechaRango($exp['fecha_inicio'],$exp['fecha_fin']);
        $pdf->Cell(0,7,safe($periodo),0,1,'R');

        $pdf->SetFont('Montserrat','',10);
        $pdf->SetLeftMargin(25);
        $desc = $exp['descripcion'] ?: '';
        $empresa = $exp['empresa'] ?: '';
        $texto = '';
        if($empresa) $texto .= "Empresa: $empresa\n";
        if($desc) $texto .= $desc;
        if($texto==='') $texto = 'Sin descripción.';
        $pdf->MultiCell(0,6,safe($texto));
        $pdf->SetLeftMargin(20);
        $pdf->Ln(4);
    }
    $pdf->Ln(2);
}

// ---- EDUCACION ----
$pdf->SetFont('Montserrat','B',12);
$pdf->Cell(0,7,utf8_decode('EDUCACIÓN'),0,1,'C');
$pdf->Linea();

$pdf->SetFont('Montserrat','',10);
if(count($data['educacion_adicional'])==0){
    $pdf->Cell(0,6,safe('Sin educación adicional cargada.'),0,1,'L');
    $pdf->Ln(4);
} else {
    foreach($data['educacion_adicional'] as $edu){
        $pdf->Cell(130,6,safe($edu['institucion'] ?: 'Institución no especificada'),0,0,'L');
        $pdf->Cell(0,6,safe(fechaRango($edu['fecha_inicio'],$edu['fecha_fin'])),0,1,'R');
        $pdf->Cell(0,6,safe($edu['curso_realizado'] ?: ''),0,1,'L');
        $pdf->Ln(2);
    }
    $pdf->Ln(2);
}

// ---- CERTIFICACIONES ----
$pdf->SetFont('Montserrat','B',12);
$pdf->Cell(0,7,utf8_decode('CERTIFICACIONES Y COMPETENCIAS'),0,1,'C');
$pdf->Linea();

$pdf->SetFont('Montserrat','',10);
$pdf->SetLeftMargin(25);
if(count($data['titulos'])==0){
    $pdf->Cell(0,6,safe('- Sin títulos / certificaciones cargados.'),0,1);
} else {
    foreach($data['titulos'] as $t){
        $pdf->Cell(0,6,safe('- '.$t['titulo']),0,1);
    }
}
$pdf->SetLeftMargin(20);
$pdf->Ln(6);

// ---- INFORMACION ADICIONAL ----
$pdf->SetFont('Montserrat','B',12);
$pdf->Cell(0,7,utf8_decode('INFORMACIÓN ADICIONAL'),0,1,'C');
$pdf->Linea();

$pdf->SetFont('Montserrat','',10);
// Idiomas
$idiomas = array_map(function($i){ return $i['idioma']; }, $data['idiomas']);
if(count($idiomas)>0){
    $pdf->Cell(0,6,safe('- Idiomas: '.implode(', ',$idiomas)),0,1);
}
// Habilidades técnicas
$tec = array_map(function($h){ return $h['habilidad']; }, $data['habilidades_tecnicas']);
if(count($tec)>0){
    $pdf->Cell(0,6,safe('- Habilidades técnicas: '.implode(', ',$tec)),0,1);
}
// Habilidades personales
$pers = array_map(function($h){ return $h['habilidad']; }, $data['habilidades_personales']);
if(count($pers)>0){
    $pdf->Cell(0,6,safe('- Habilidades personales: '.implode(', ',$pers)),0,1);
}
// Proyectos
$proy = array_map(function($p){ return $p['proyecto']; }, $data['proyectos']);
if(count($proy)>0){
    $pdf->Cell(0,6,safe('- Proyectos: '.implode('; ',$proy)),0,1);
}
// Prácticas (adaptado al nuevo esquema: empresa, puesto, fechas, descripcion)
$pracList = [];
if(!empty($data['practicas']) && is_array($data['practicas'])){
    foreach($data['practicas'] as $p){
        $empresa = trim($p['empresa'] ?? '');
        $puesto  = trim($p['puesto'] ?? '');
        $fi = $p['fecha_inicio'] ?? null;
        $ff = $p['fecha_fin'] ?? null;
        $titulo = trim($empresa.($puesto? ' - '.$puesto : ''));
        $periodo = fechaRango($fi,$ff);
        $item = $titulo;
        if($periodo) $item = trim(($titulo? $titulo.' ' : '').'('.$periodo.')');
        if($item !== '') $pracList[] = $item;
    }
}
if(count($pracList)>0){
    $pdf->Cell(0,6,safe('- Prácticas: '.implode('; ',$pracList)),0,1);
}
// Disponibilidad
if(!empty($data['formulario']['disponibilidad'])){
    $pdf->Cell(0,6,safe('- Disponibilidad: '.$data['formulario']['disponibilidad']),0,1);
}
// Área pretendida
if(!empty($data['formulario']['area_pretendida'])){
    $pdf->Cell(0,6,safe('- Área pretendida: '.$data['formulario']['area_pretendida']),0,1);
}
if(!empty($data['formulario']['perfil_egresado'])){
    $pdf->Cell(0,6,safe('- Perfil egresado: '.$data['formulario']['perfil_egresado']),0,1);
}
if(count($idiomas)==0 && count($tec)==0 && count($pers)==0 && count($proy)==0 && count($pracList)==0 && empty($data['formulario']['disponibilidad'])){
    $pdf->Cell(0,6,safe('- Sin información adicional.'),0,1);
}

$pdf->Output('I','cv_recreado.pdf');
?>
