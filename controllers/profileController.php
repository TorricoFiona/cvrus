<?php 
session_start();
if(!isset($_SESSION['user_email'])){
    header("Location: ?slug=login");
    exit;
}

$seccion = "Actualiza tus datos";

if(isset($_POST['btn_guardar'])){
    require_once "models/ProfileModel.php";

    $perfil = new Perfil();

    // Experiencias
    $experiencias = [];
    if(isset($_POST["empresa"])){
        for($i=0;$i<count($_POST["empresa"]);$i++){
            if(trim($_POST["empresa"][$i])=="" && trim($_POST["puesto"][$i])=="") continue;
            $experiencias[] = [
                "empresa"=>$_POST["empresa"][$i],
                "puesto"=>$_POST["puesto"][$i],
                "fecha_inicio"=>$_POST["fecha_inicio"][$i],
                "fecha_fin"=>$_POST["fecha_fin"][$i],
                "descripcion"=>$_POST["descripcion"][$i],
                "tipo"=>$_POST["tipo"][$i]
            ];
        }
    }
    $_POST["experiencias"] = $experiencias;

    // Manejo de foto de perfil
    if(isset($_FILES['foto_perfil']) && $_FILES['foto_perfil']['error'] === UPLOAD_ERR_OK){
        $tmp = $_FILES['foto_perfil']['tmp_name'];
        $nombreOriginal = $_FILES['foto_perfil']['name'];
        $ext = strtolower(pathinfo($nombreOriginal, PATHINFO_EXTENSION));
        $permitidas = ['jpg','jpeg','png'];
        if(in_array($ext,$permitidas)){
            if($_FILES['foto_perfil']['size'] <= 2*1024*1024){ // 2MB
                $destDir = __DIR__ . '/../views/assets/img/uploads';
                if(!is_dir($destDir)) mkdir($destDir,0775,true);
                $destino = $destDir . '/profile_' . $_SESSION['user_id'] . '.' . $ext;
                // Borrar versiones anteriores con otras extensiones
                foreach(['jpg','jpeg','png'] as $e){
                    $old = $destDir . '/profile_' . $_SESSION['user_id'] . '.' . $e;
                    if(file_exists($old) && $old !== $destino) @unlink($old);
                }
                if(move_uploaded_file($tmp,$destino)){
                    $_SESSION['profile_photo_path'] = $destino;
                }
            } else {
                $error_profile = 'La imagen excede el tamaño máximo (2MB).';
            }
        } else {
            $error_profile = 'Formato de imagen no permitido.';
        }
    }

    $response = $perfil->guardar($_POST, $_SESSION['user_id']);

    if($response["errno"]==201){
        header("Location: ?slug=templates");
        exit;
    } else {
        $error_profile = $response["error"];
    }
}

// Si es GET, precargar datos existentes
if(!isset($_POST['btn_guardar'])){
    require_once "models/ProfileModel.php";
    $perfilLoader = new Perfil();
    $datos = $perfilLoader->obtenerPerfil($_SESSION['user_id']);

    // Mapear a estructuras simples para el formulario
    $perfil_usuario = $datos['usuario'] ?? [];
    $formulario = $datos['formulario'] ?? [];
    $experiencias = $datos['experiencias'] ?? [];
    $educacion_adicional = $datos['educacion_adicional'] ?? [];
    $titulos = array_map(function($t){ return $t['titulo']; }, $datos['titulos'] ?? []);
    $habilidades_tecnicas = array_map(function($h){ return $h['habilidad']; }, $datos['habilidades_tecnicas'] ?? []);
    $habilidades_personales = array_map(function($h){ return $h['habilidad']; }, $datos['habilidades_personales'] ?? []);
    $idiomas = array_map(function($i){ return $i['idioma']; }, $datos['idiomas'] ?? []);
    $proyectos = array_map(function($p){ return $p['proyecto']; }, $datos['proyectos'] ?? []);
    $practicas = $datos['practicas'] ?? [];

    // Listas de opciones: nacionalidades y modalidades
    $modalidades = $perfilLoader->consultar("SELECT id_modalidad, nombre FROM modalidad WHERE 1");
    $nacionalidades = $perfilLoader->consultar("SELECT ID_NACIONALIDAD, nombre FROM nacionalidad WHERE 1");

} else {
    // Después de guardar, si hubo error y no redirige, rearmar variables mínimas para repintar
    $perfil_usuario = [
        'telefono'=>$_POST['telefono'] ?? '',
        'fecha_nacimiento'=>$_POST['fecha_nacimiento'] ?? '',
        'domicilio'=>$_POST['domicilio'] ?? '',
        'localidad'=>$_POST['localidad'] ?? '',
        'id_curso'=>$_POST['id_curso'] ?? '',
        'ID_MODALIDAD'=>$_POST['ID_MODALIDAD'] ?? ''
    ];
    $formulario = [
        'presentacion'=>$_POST['presentacion'] ?? '',
        'perfil_egresado'=>$_POST['perfil_egresado'] ?? '',
        'disponibilidad'=>$_POST['disponibilidad'] ?? '',
        'disponibilidad_viaje'=>$_POST['disponibilidad_viaje'] ?? '',
        'area_pretendida'=>$_POST['area_pretendida'] ?? ''
    ];
    // Reconstruir arrays
    $titulos = $_POST['titulos'] ?? [];
    $habilidades_tecnicas = $_POST['habilidades_tecnicas'] ?? [];
    $habilidades_personales = $_POST['habilidades_personales'] ?? [];
    $idiomas = $_POST['idiomas'] ?? [];
    $proyectos = $_POST['proyectos'] ?? [];
    // Prácticas reconstruidas
    $practicas = [];
    if(isset($_POST['practicas_empresa'])){
        for($i=0;$i<count($_POST['practicas_empresa']);$i++){
            $practicas[] = [
                'empresa'=>$_POST['practicas_empresa'][$i] ?? '',
                'puesto'=>$_POST['practicas_puesto'][$i] ?? '',
                'fecha_inicio'=>$_POST['practicas_fecha_inicio'][$i] ?? '',
                'fecha_fin'=>$_POST['practicas_fecha_fin'][$i] ?? '',
                'descripcion'=>$_POST['practicas_descripcion'][$i] ?? ''
            ];
        }
    }
    // Experiencias reconstruidas
    $experiencias = [];
    if(isset($_POST['empresa'])){
        for($i=0;$i<count($_POST['empresa']);$i++){
            $experiencias[] = [
                'empresa'=>$_POST['empresa'][$i] ?? '',
                'puesto'=>$_POST['puesto'][$i] ?? '',
                'fecha_inicio'=>$_POST['fecha_inicio'][$i] ?? '',
                'fecha_fin'=>$_POST['fecha_fin'][$i] ?? '',
                'descripcion'=>$_POST['descripcion'][$i] ?? '',
                'tipo'=>$_POST['tipo'][$i] ?? ''
            ];
        }
    }
    $educacion_adicional = [];
    if(isset($_POST['institucion'])){
        for($i=0;$i<count($_POST['institucion']);$i++){
            $educacion_adicional[] = [
                'institucion'=>$_POST['institucion'][$i] ?? '',
                'curso_realizado'=>$_POST['curso_realizado'][$i] ?? '',
                'fecha_inicio'=>$_POST['edu_fecha_inicio'][$i] ?? '',
                'fecha_fin'=>$_POST['edu_fecha_fin'][$i] ?? ''
            ];
        }
    }
    // Listas de opciones también en repintado tras error
    $perfilLoader = new Perfil();
    $modalidades = $perfilLoader->consultar("SELECT id_modalidad, nombre FROM modalidad WHERE 1");
    $nacionalidades = $perfilLoader->consultar("SELECT ID_NACIONALIDAD, nombre FROM nacionalidad WHERE 1");
}

// Cargar plantilla
$tpl = new Palta("profile");
$tpl->assign([
    "APP_SECTION"=>$seccion,
    "perfil_usuario"=>$perfil_usuario ?? [],
    "formulario"=>$formulario ?? [],
    "experiencias"=>$experiencias ?? [],
    "educacion_adicional"=>$educacion_adicional ?? [],
    "titulos_form"=>$titulos ?? [],
    "habilidades_tecnicas_form"=>$habilidades_tecnicas ?? [],
    "habilidades_personales_form"=>$habilidades_personales ?? [],
    "idiomas_form"=>$idiomas ?? [],
    "proyectos_form"=>$proyectos ?? [],
    "practicas"=>$practicas ?? [],
    "modalidades"=>$modalidades ?? [],
    "nacionalidades"=>$nacionalidades ?? []
]);
$tpl->printToScreen();
