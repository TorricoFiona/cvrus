<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Preconexión a Google Fonts (correcta orden y atributos) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <!-- Iconos y fuentes -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

    <!-- Favicon -->
    <link rel="icon" href="views/assets/img/cvrus_icon.svg">
    <title>{{ APP_SECTION }} - {{ APP_NAME }}</title>
    <style>
        :root {
            /* Colores de fondo */
            --color-fondo-principal: {{ COLOR_FONDO_PRINCIPAL }};
            --color-fondo-secundario: {{ COLOR_FONDO_SECUNDARIO }};
            --color-fondo-tarjeta: {{ COLOR_FONDO_TARJETA }};
            --color-fondo-footer: {{ COLOR_FONDO_FOOTER }};
            /* Colores de texto */
            --color-texto-principal: {{ COLOR_TEXTO_PRINCIPAL }};
            --color-texto-secundario: {{ COLOR_TEXTO_SECUNDARIO }};
            --color-texto-gris: {{ COLOR_TEXTO_GRIS }};
            --color-texto-claro: {{ COLOR_TEXTO_CLARO }};
            /* Color primario */
            --color-primario: {{ COLOR_PRIMARIO }};
            --color-primario-dark: {{ COLOR_PRIMARIO_DARK }};
            /* Colores de bordes */
            --color-borde: {{ COLOR_BORDE }};
            /* Colores de fondo con opacidad */
            --color-fondo-icono: {{ COLOR_FONDO_ICONO }};
            --color-fondo-header: {{ COLOR_FONDO_HEADER }};
            /* Colores de sombras */
            --color-sombra-primaria: {{ COLOR_SOMBRA_PRIMARIA }};
            --color-sombra-hero: {{ COLOR_SOMBRA_HERO }};
            --color-sombra-negra-ligera: {{ COLOR_SOMBRA_NEGRA_LIGERA }};
            --color-sombra-negra-ligera-lg: {{ COLOR_SOMBRA_NEGRA_LIGERA_LG }};
            --color-sombra-negra-media: {{ COLOR_SOMBRA_NEGRA_MEDIA }};
            /* Colores de estados */
            --color-success: {{ COLOR_SUCCESS }}; 
            --color-warning: {{ COLOR_WARNING }};
            --color-error: {{ COLOR_ERROR }};
            /* Gradiente de Instagram */
            --color-instagram-1: {{ COLOR_INSTAGRAM_1 }};
            --color-instagram-2: {{ COLOR_INSTAGRAM_2 }};
            --color-instagram-3: {{ COLOR_INSTAGRAM_3 }};
            /* Bordes redondeados */
            --radius: {{ RADIUS }};
            --radius-lg: {{ RADIUS_LG }};
        }
    </style>
