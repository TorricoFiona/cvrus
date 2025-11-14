<?php 
    
    $seccion = "Registro";
    $error_register = "";

    /* se presiono el boton de ingresar */
    if(isset($_POST['btn_registrar'])){
    
        /* se instancia la clase usuario */
        $usuario = new Usuario();

        /* se prueba si se puede loguear */
        $response = $usuario->register($_POST);

        // en el caso que el registro sea valido (201 creado)
        if($response["errno"]==201){
            header("Location: ?slug=panel");
        }else{
            $error_register = $response["error"];
        }
        
    }

    /* IMPRIMO LA VISTA */
    $tpl = new Palta("register");

    $tpl->assign([
        "ERROR_REGISTER" => $error_register,
        "APP_SECTION" => $seccion,
    ]);

    $tpl->printToScreen();
    
 ?>