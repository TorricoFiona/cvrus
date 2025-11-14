<?php
class Perfil extends DBAbstract {

    public $strings = [
        "presentacion","perfil_egresado","disponibilidad",
        "disponibilidad_viaje","area_pretendida","telefono",
        "fecha_nacimiento","domicilio","localidad",
        "ID_MODALIDAD","id_curso","id_nacionalidad"
    ];

    public $arrays = [
        "titulos" => ["tabla"=>"titulos_usuario","columna"=>"titulo"],
        "habilidades_tecnicas"=>["tabla"=>"habilidades_usuario","columna"=>"habilidad","tipo"=>"tecnica"],
        "habilidades_personales"=>["tabla"=>"habilidades_usuario","columna"=>"habilidad","tipo"=>"personal"],
        "idiomas"=>["tabla"=>"idiomas_usuario","columna"=>"idioma"],
        "proyectos"=>["tabla"=>"proyectos_usuario","columna"=>"proyecto"]
    ];

    public $experiencias = [];

    function __construct(){
        parent::__construct();
        foreach($this->strings as $c) $this->$c = "";
        foreach($this->arrays as $c=>$info) $this->$c=[];
        $this->experiencias=[];
    }

    public function guardar($form, $id_usuario){

        // Strings
        foreach($this->strings as $campo){
            $this->$campo = $form[$campo] ?? "";
        }

        // Arrays
        foreach($this->arrays as $campo=>$info){
            $this->$campo = $form[$campo] ?? [];
        }

        // Experiencias
        $this->experiencias = $form["experiencias"] ?? [];

        // UPDATE usuario con prepare, chequeando si existe id_nacionalidad antes de armar el SQL
        if (method_exists($this, 'hasColumn') && $this->hasColumn('usuario','id_nacionalidad')) {
            $stmt = $this->db->prepare(
                "UPDATE usuario SET\n".
                "    telefono=?,\n".
                "    fecha_nacimiento=?,\n".
                "    domicilio=?,\n".
                "    localidad=?,\n".
                "    id_curso=?,\n".
                "    ID_MODALIDAD=?,\n".
                "    id_nacionalidad=?\n".
                "WHERE id_usuario=?"
            );
            $stmt->bind_param(
                "ssssiiii",
                $this->telefono,
                $this->fecha_nacimiento,
                $this->domicilio,
                $this->localidad,
                $this->id_curso,
                $this->ID_MODALIDAD,
                $this->id_nacionalidad,
                $this->$id_usuario
            );
            $stmt->execute();
            $stmt->close();
        } else {
            $stmt = $this->db->prepare(
                "UPDATE usuario SET\n".
                "    telefono=?,\n".
                "    fecha_nacimiento=?,\n".
                "    domicilio=?,\n".
                "    localidad=?,\n".
                "    id_curso=?,\n".
                "    ID_MODALIDAD=?\n".
                "WHERE id_usuario=?"
            );
            $stmt->bind_param(
                "ssssiii",
                $this->telefono,
                $this->fecha_nacimiento,
                $this->domicilio,
                $this->localidad,
                $this->id_curso,
                $this->ID_MODALIDAD,
                $id_usuario
            );
            $stmt->execute();
            $stmt->close();
        }

        // Insert/Update formulariocomplementario
        $res = $this->db->query("SELECT id_formulario FROM formulariocomplementario WHERE id_usuario='$id_usuario'");
        if($res && $res->num_rows>0){
            $query="UPDATE formulariocomplementario SET
                presentacion='$this->presentacion',
                perfil_egresado='$this->perfil_egresado',
                disponibilidad='$this->disponibilidad',
                disponibilidad_viaje='$this->disponibilidad_viaje',
                area_pretendida='$this->area_pretendida'
                WHERE id_usuario='$id_usuario'";
        } else {
            $query="INSERT INTO formulariocomplementario
                (presentacion,perfil_egresado,disponibilidad,disponibilidad_viaje,area_pretendida,id_usuario)
                VALUES ('$this->presentacion','$this->perfil_egresado','$this->disponibilidad','$this->disponibilidad_viaje','$this->area_pretendida','$id_usuario')";
        }
        $this->db->query($query);

        // Tablas relacionadas
        foreach($this->arrays as $campo=>$info){
            $tabla = $info["tabla"];
            $columna = $info["columna"];
            $tipo = $info["tipo"] ?? null;

            $this->db->query("DELETE FROM $tabla WHERE id_usuario='$id_usuario'");

            foreach($this->$campo as $v){
                if(trim($v)==="") continue;
                if($tipo)
                    $this->db->query("INSERT INTO $tabla (id_usuario,tipo,$columna) VALUES ('$id_usuario','$tipo','$v')");
                else
                    $this->db->query("INSERT INTO $tabla (id_usuario,$columna) VALUES ('$id_usuario','$v')");
            }
        }

        // Experiencias
        $this->db->query("DELETE FROM experiencia_usuario WHERE id_usuario='$id_usuario'");
        foreach($this->experiencias as $exp){
            $this->db->query("\r
                INSERT INTO experiencia_usuario\r
                (id_usuario,empresa,puesto,fecha_inicio,fecha_fin,descripcion,tipo)\r
                VALUES\r
                ('$id_usuario','{$exp['empresa']}','{$exp['puesto']}','{$exp['fecha_inicio']}','{$exp['fecha_fin']}','{$exp['descripcion']}','{$exp['tipo']}')\r
            ");
        }

        // Educación adicional
        $this->db->query("DELETE FROM educacionadicional WHERE id_usuario='".$this->db->real_escape_string($id_usuario)."'");
        if(isset($form['institucion'])){
            $instituciones = $form['institucion'] ?? [];
            $cursosRealizados = $form['curso_realizado'] ?? [];
            $fechasIni = $form['edu_fecha_inicio'] ?? [];
            $fechasFin = $form['edu_fecha_fin'] ?? [];

            $stmtEdu = $this->db->prepare("INSERT INTO educacionadicional (id_usuario, institucion, curso_realizado, fecha_inicio, fecha_fin) VALUES (?,?,?,?,?)");
            if($stmtEdu){
                for($i=0; $i<count($instituciones); $i++){
                    $inst = trim($instituciones[$i] ?? '');
                    $curso = trim($cursosRealizados[$i] ?? '');
                    $fi = $fechasIni[$i] ?? null;
                    $ff = $fechasFin[$i] ?? null;
                    if($inst==='' && $curso==='') continue;
                    $stmtEdu->bind_param("issss", $id_usuario, $inst, $curso, $fi, $ff);
                    $stmtEdu->execute();
                }
                $stmtEdu->close();
            }
        }

        // Prácticas profesionalizantes
        $this->db->query("DELETE FROM practicas_usuario WHERE id_usuario='".$this->db->real_escape_string($id_usuario)."'");
        if(isset($form['practicas_empresa'])){
            $empresas = $form['practicas_empresa'] ?? [];
            $puestos = $form['practicas_puesto'] ?? [];
            $fini = $form['practicas_fecha_inicio'] ?? [];
            $ffin = $form['practicas_fecha_fin'] ?? [];
            $descs = $form['practicas_descripcion'] ?? [];
            $stmtPrac = $this->db->prepare("INSERT INTO practicas_usuario (id_usuario, empresa, puesto, fecha_inicio, fecha_fin, descripcion) VALUES (?,?,?,?,?,?)");
            if($stmtPrac){
                for($i=0;$i<count($empresas);$i++){
                    $empresa = trim($empresas[$i] ?? '');
                    $puesto = trim($puestos[$i] ?? '');
                    $fi = $fini[$i] ?? null;
                    $ff = $ffin[$i] ?? null;
                    $desc = trim($descs[$i] ?? '');
                    if($empresa==='' && $puesto==='' && $desc==='') continue; // evitar filas vacías
                    $stmtPrac->bind_param("isssss", $id_usuario, $empresa, $puesto, $fi, $ff, $desc);
                    $stmtPrac->execute();
                }
                $stmtPrac->close();
            }
        }

        return ["errno"=>201,"error"=>"OK"];
    }

    /**
     * Obtiene todos los datos necesarios para armar el CV de un usuario
     * Devuelve un arreglo asociativo con claves:
     * - usuario, formulario, experiencias, educacion_adicional,
     *   habilidades_tecnicas, habilidades_personales, idiomas,
     *   proyectos, titulos, practicas
     */
    public function obtenerPerfil($id_usuario){
        $out = [];

        // Datos básicos del usuario (incluir id_nacionalidad solo si existe en el esquema)
        $cols = "id_usuario, nombre, apellido, email, telefono, fecha_nacimiento, domicilio, localidad, id_curso, ID_MODALIDAD";
        if (method_exists($this, 'hasColumn') && $this->hasColumn('usuario','id_nacionalidad')) {
            $cols .= ", id_nacionalidad";
        }
        $res = $this->consultar("SELECT $cols FROM usuario WHERE id_usuario='".$this->db->real_escape_string($id_usuario)."' LIMIT 1");
        $out['usuario'] = $res[0] ?? [];

        // Formulario complementario
        $res = $this->consultar("SELECT presentacion, perfil_egresado, disponibilidad, disponibilidad_viaje, area_pretendida FROM formulariocomplementario WHERE id_usuario='".$this->db->real_escape_string($id_usuario)."' LIMIT 1");
        $out['formulario'] = $res[0] ?? [];

        // Experiencias
        $out['experiencias'] = $this->consultar("SELECT tipo, empresa, puesto, fecha_inicio, fecha_fin, descripcion FROM experiencia_usuario WHERE id_usuario='".$this->db->real_escape_string($id_usuario)."' ORDER BY COALESCE(fecha_fin, fecha_inicio) DESC");

        // Educación adicional
        $out['educacion_adicional'] = $this->consultar("SELECT institucion, curso_realizado, fecha_inicio, fecha_fin FROM educacionadicional WHERE id_usuario='".$this->db->real_escape_string($id_usuario)."' ORDER BY COALESCE(fecha_fin, fecha_inicio) DESC");

        // Habilidades
        $out['habilidades_tecnicas'] = $this->consultar("SELECT habilidad FROM habilidades_usuario WHERE id_usuario='".$this->db->real_escape_string($id_usuario)."' AND tipo='tecnica'");
        $out['habilidades_personales'] = $this->consultar("SELECT habilidad FROM habilidades_usuario WHERE id_usuario='".$this->db->real_escape_string($id_usuario)."' AND tipo='personal'");

        // Idiomas
        $out['idiomas'] = $this->consultar("SELECT idioma FROM idiomas_usuario WHERE id_usuario='".$this->db->real_escape_string($id_usuario)."'");

        // Proyectos
        $out['proyectos'] = $this->consultar("SELECT proyecto FROM proyectos_usuario WHERE id_usuario='".$this->db->real_escape_string($id_usuario)."'");

        // Títulos
        $out['titulos'] = $this->consultar("SELECT titulo FROM titulos_usuario WHERE id_usuario='".$this->db->real_escape_string($id_usuario)."'");

    // Prácticas profesionalizantes
    $out['practicas'] = $this->consultar("SELECT empresa, puesto, fecha_inicio, fecha_fin, descripcion FROM practicas_usuario WHERE id_usuario='".$this->db->real_escape_string($id_usuario)."' ORDER BY COALESCE(fecha_fin, fecha_inicio) DESC");

        return $out;
    }
}
?>
