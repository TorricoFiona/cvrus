<?php 
/**
 * 
 */
class Palta
{
    private $tpl_name;
    private $buffer_tpl;
    
    function __construct($name_view)
    {
        /* carga de la vista*/
        $this->buffer_tpl = file_get_contents('views/'.$name_view.'View.tpl.php');
        /* procesa todos los componentes de la plantilla */
        $this->processComponents();
        /* reemplaza las variables de html con valores de php*/
        $this->assign([
            "APP_NAME" => APP_NAME,
            "APP_DESCRIPTION" => APP_DESCRIPTION,
            "APP_AUTHOR" => APP_AUTHOR,
            "COLOR_FONDO_PRINCIPAL" => COLOR_FONDO_PRINCIPAL,
            "COLOR_FONDO_TARJETA" => COLOR_FONDO_TARJETA,
            "COLOR_FONDO_FOOTER" => COLOR_FONDO_FOOTER,
            "COLOR_TEXTO_PRINCIPAL" => COLOR_TEXTO_PRINCIPAL,
            "COLOR_TEXTO_SECUNDARIO" => COLOR_TEXTO_SECUNDARIO,
            "COLOR_TEXTO_GRIS" => COLOR_TEXTO_GRIS,
            "COLOR_TEXTO_CLARO" => COLOR_TEXTO_CLARO,
            "COLOR_PRIMARIO" => COLOR_PRIMARIO,
            "COLOR_BORDE" => COLOR_BORDE,
            "COLOR_FONDO_ICONO" => COLOR_FONDO_ICONO,
            "COLOR_FONDO_HEADER" => COLOR_FONDO_HEADER,
            "COLOR_SOMBRA_PRIMARIA" => COLOR_SOMBRA_PRIMARIA,
            "COLOR_SOMBRA_HERO" => COLOR_SOMBRA_HERO,
            "COLOR_SOMBRA_NEGRA_LIGERA" => COLOR_SOMBRA_NEGRA_LIGERA,
            "COLOR_SOMBRA_NEGRA_MEDIA" => COLOR_SOMBRA_NEGRA_MEDIA,
            "COLOR_INSTAGRAM_1" => COLOR_INSTAGRAM_1,
            "COLOR_INSTAGRAM_2" => COLOR_INSTAGRAM_2,
            "COLOR_INSTAGRAM_3" => COLOR_INSTAGRAM_3,
        ]);
    }

    /* procesa todos los componentes de la plantilla */
    private function processComponents()
    {
        preg_match_all('/@component\(([^)]+)\)/', $this->buffer_tpl, $matches);

        foreach ($matches[1] as $component_name) {
            $this->loadComponent(trim($component_name));
        }
    }

    /* seccion para cargar componentes*/
    private function loadComponent($component_name)
    {
        $component_path = 'views/components/' . $component_name . 'Component.tpl.php';
        $component_content = file_get_contents($component_path);
        $this->buffer_tpl = str_replace("@component({$component_name})", $component_content, $this->buffer_tpl);
        return $component_content;
    }

    /* recibe un array asociativo con la key de la variable a modificar y su valor a reemplazar*/
    /* $array_assoc = ["CANT_USERS" => 10, "APP_AUTHOR" => "matt", ...] */
    public function assign($array_assoc)
    {
        foreach ($array_assoc as $key => $value) {
            $this->buffer_tpl = str_replace("{{ ".$key." }}", $value, $this->buffer_tpl);
        }
    }
    
    public function printToScreen()
    {
        echo $this->buffer_tpl;
    }
}
?>