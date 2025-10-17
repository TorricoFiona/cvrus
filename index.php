<!DOCTYPE html>
<html lang="es"><head>
        <meta charset="utf-8" />
        <meta content="width=device-width, initial-scale=1.0" name="viewport" />
        <title>CVrus - Tu Primer CV Profesional</title>
        <script
            src="https://cdn.tailwindcss.com?plugins=forms,typography"></script>
        <link
            href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&amp;display=swap"
            rel="stylesheet" />
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
            rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-xh6O6zvQfKfPHVQw58+ZzF6yHCBqRRbFjEZ+M3kmuZbwVx9f9AnITd6We9i8tRZf2Of1YF6a8g2jM+fJpF3gFQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
        <link rel="icon" type="image/svg" href="img/cvrus_logo_solo_blanco.svg">


        <style>
        .material-icons {
            font-family: 'Material Icons';
            font-weight: normal;
            font-style: normal;
            font-size: 24px;
            line-height: 1;
            letter-spacing: normal;
            text-transform: none;
            display: inline-block;
            white-space: nowrap;
            word-wrap: normal;
            direction: ltr;
            -webkit-font-feature-settings: 'liga';
            -webkit-font-smoothing: antialiased;
        }
    </style>
        <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        primary: "#007BFF", // Un azul profesional pero vibrante    
                        "background-light": "#F7F9FC",
                        "background-dark": "#121212",
                        "card-light": "#FFFFFF",
                        "card-dark": "#1E1E1E",
                        "text-light": "#2a3944",
                        "text-dark": "#E5E7EB",
                        "text-muted-light": "#6B7280",
                        "text-muted-dark": "#9CA3AF",
                        accent: "#FFC107", // Amarillo para acentos
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                    borderRadius: {
                        'lg': '0.75rem',
                        'xl': '1rem',
                        '2xl': '1.5rem',
                    },
                },
            },
        };
    </script>
    </head>
    <body
        class="bg-background-light dark:bg-background-dark text-text-light dark:text-text-dark font-sans antialiased">
        <header
            class="sticky top-0 z-50 bg-background-light/80 dark:bg-background-dark/80 backdrop-blur-sm">
            <div
                class="container mx-auto px-4 py-4 flex justify-between items-center">
                <div class="flex items-center space-x-2">
                    <img alt="CVrus Logo" class="h-8 w-8" src="img/cvrus_logo_solo.svg">

                    <span
                        class="text-2xl font-bold text-text-light dark:text-text-dark">CVrus</span>
                </div>
                <nav class="hidden md:flex items-center space-x-6">
                    <a
                        class="text-text-muted-light dark:text-text-muted-dark hover:text-primary dark:hover:text-primary transition-colors"
                        href="#que-es">¿Qué es?</a>
                    <a
                        class="text-text-muted-light dark:text-text-muted-dark hover:text-primary dark:hover:text-primary transition-colors"
                        href="#como-funciona">¿Cómo funciona?</a>
                    <a
                        class="text-text-muted-light dark:text-text-muted-dark hover:text-primary dark:hover:text-primary transition-colors"
                        href="#beneficios">Beneficios</a>
                    <a
                        class="text-text-muted-light dark:text-text-muted-dark hover:text-primary dark:hover:text-primary transition-colors"
                        href="#quienes-somos">Quiénes Somos</a>
                    <a
                        class="text-text-muted-light dark:text-text-muted-dark hover:text-primary dark:hover:text-primary transition-colors"
                        href="#contacto">Contacto</a>
                </nav>
                <a
                    class="bg-primary text-white px-6 py-2 rounded-lg font-semibold hover:bg-opacity-90 transition-all shadow-md"
                    href="#">
                    Generar mi CV
                </a>
            </div>
        </header>
        <main>
            <section class="py-20 md:py-32" id="hero">
                <div class="container mx-auto px-4 text-center">
                    <h1
                        class="text-4xl md:text-6xl font-bold mb-4 leading-tight text-text-light dark:text-text-dark">
                        Tu primer CV profesional, <br class="hidden md:block" />
                        <span class="text-primary">en un clic.</span>
                    </h1>
                    <p
                        class="max-w-2xl mx-auto text-lg md:text-xl text-text-muted-light dark:text-text-muted-dark mb-8">
                        CVrus es la plataforma institucional que te ayuda a
                        crear un currículum vitae de forma rápida y sencilla.
                    </p>
                    <a
                        class="inline-flex items-center justify-center bg-primary text-white px-8 py-4 rounded-lg font-bold text-lg hover:bg-opacity-90 transition-all shadow-lg transform hover:scale-105"
                        href="#">
                        Generar mi CV
                        <span class="material-icons ml-2">arrow_forward</span>
                    </a>
                </div>
            </section>
            <section class="py-20 bg-card-light dark:bg-card-dark" id="que-es">
                <div class="container mx-auto px-4">
                    <div class="max-w-3xl mx-auto text-center">
                        <h2
                            class="text-3xl md:text-4xl font-bold mb-4 text-text-light dark:text-text-dark">¿Qué
                            es CVrus?</h2>
                        <p
                            class="text-lg text-text-muted-light dark:text-text-muted-dark">
                            CVrus es una herramienta diseñada para los
                            estudiantes de la Escuela Técnica N°3. Nuestra
                            misión es simplificar la creación de tu primer
                            currículum vitae, utilizando la información
                            académica que la escuela ya posee y permitiéndote
                            añadir tus habilidades y experiencias personales. El
                            resultado es un CV profesional en formato PDF, listo
                            para abrirte las puertas al mundo laboral.
                        </p>
                    </div>
                </div>
            </section>
            <section class="py-20" id="como-funciona">
                <div class="container mx-auto px-4">
                    <h2
                        class="text-3xl md:text-4xl font-bold text-center mb-12 text-text-light dark:text-text-dark">¿Cómo
                        funciona?</h2>
                    <div class="grid md:grid-cols-3 gap-8 text-center">
                        <div class="flex flex-col items-center">
                            <div
                                class="bg-primary/10 dark:bg-primary/20 text-primary p-6 rounded-2xl mb-6 inline-block">
                                <span
                                    class="material-icons !text-4xl">school</span>
                            </div>
                            <h3
                                class="text-xl font-bold mb-2 text-text-light dark:text-text-dark">1.
                                La escuela ya tiene tus datos</h3>
                            <p
                                class="text-text-muted-light dark:text-text-muted-dark">
                                Inicia sesión y verás tu información académica
                                precargada desde la base de datos institucional.
                            </p>
                        </div>
                        <div class="flex flex-col items-center">
                            <div
                                class="bg-primary/10 dark:bg-primary/20 text-primary p-6 rounded-2xl mb-6 inline-block">
                                <span
                                    class="material-icons !text-4xl">edit_document</span>
                            </div>
                            <h3
                                class="text-xl font-bold mb-2 text-text-light dark:text-text-dark">2.
                                Completa lo que falta</h3>
                            <p
                                class="text-text-muted-light dark:text-text-muted-dark">
                                Añade tus habilidades, experiencias y datos de
                                contacto a través de un formulario simple y
                                guiado.
                            </p>
                        </div>
                        <div class="flex flex-col items-center">
                            <div
                                class="bg-primary/10 dark:bg-primary/20 text-primary p-6 rounded-2xl mb-6 inline-block">
                                <span
                                    class="material-icons !text-4xl">download_for_offline</span>
                            </div>
                            <h3
                                class="text-xl font-bold mb-2 text-text-light dark:text-text-dark">3.
                                Descargá tu CV profesional</h3>
                            <p
                                class="text-text-muted-light dark:text-text-muted-dark">
                                Elige una plantilla y descarga tu CV en formato
                                PDF, listo para enviar a empresas y
                                reclutadores.
                            </p>
                        </div>
                    </div>
                </div>
            </section>
            <section class="py-20 bg-card-light dark:bg-card-dark"
                id="beneficios">
                <div class="container mx-auto px-4">
                    <h2
                        class="text-3xl md:text-4xl font-bold text-center mb-12 text-text-light dark:text-text-dark">Beneficios</h2>
                    <div class="grid md:grid-cols-2 gap-8 max-w-4xl mx-auto">
                        <div
                            class="bg-background-light dark:bg-background-dark p-8 rounded-xl">
                            <h3
                                class="text-2xl font-bold mb-4 text-text-light dark:text-text-dark">Para
                                Estudiantes</h3>
                            <ul
                                class="space-y-3 text-text-muted-light dark:text-text-muted-dark">
                                <li class="flex items-start">
                                    <span
                                        class="material-icons text-primary mr-3">check_circle</span>
                                    <span>Ahorra tiempo y evita errores
                                        comunes.</span>
                                </li>
                                <li class="flex items-start">
                                    <span
                                        class="material-icons text-primary mr-3">check_circle</span>
                                    <span>Causa una excelente primera impresión
                                        profesional.</span>
                                </li>
                                <li class="flex items-start">
                                    <span
                                        class="material-icons text-primary mr-3">check_circle</span>
                                    <span>Totalmente gratuito y fácil de
                                        usar.</span>
                                </li>
                                <li class="flex items-start">
                                    <span
                                        class="material-icons text-primary mr-3">check_circle</span>
                                    <span>Plantillas modernas y aprobadas
                                        institucionalmente.</span>
                                </li>
                            </ul>
                        </div>
                        <div
                            class="bg-background-light dark:bg-background-dark p-8 rounded-xl">
                            <h3
                                class="text-2xl font-bold mb-4 text-text-light dark:text-text-dark">Para
                                Empresas Locales</h3>
                            <ul
                                class="space-y-3 text-text-muted-light dark:text-text-muted-dark">
                                <li class="flex items-start">
                                    <span
                                        class="material-icons text-primary mr-3">check_circle</span>
                                    <span>Recibe CVs estandarizados y fáciles de
                                        leer.</span>
                                </li>
                                <li class="flex items-start">
                                    <span
                                        class="material-icons text-primary mr-3">check_circle</span>
                                    <span>Accede a talento joven de la
                                        comunidad.</span>
                                </li>
                                <li class="flex items-start">
                                    <span
                                        class="material-icons text-primary mr-3">check_circle</span>
                                    <span>Verifica la información académica de
                                        los candidatos.</span>
                                </li>
                                <li class="flex items-start">
                                    <span
                                        class="material-icons text-primary mr-3">check_circle</span>
                                    <span>Fortalece el vínculo entre la escuela
                                        y el sector productivo.</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </section>
            <section class="py-20" id="quienes-somos">
                <div class="container mx-auto px-4">
                    <h2
                        class="text-3xl md:text-4xl font-bold text-center mb-12 text-text-light dark:text-text-dark">Nuestro
                        Equipo</h2>
                    <div class="max-w-md mx-auto mb-16 text-center">
                        <img alt="Foto del docente"
                            class="w-32 h-32 rounded-full mx-auto mb-4 object-cover"
                            src=""/>
                        <h3
                            class="text-2xl font-bold text-text-light dark:text-text-dark">Matias Baez</h3>
                        <p class="text-primary font-medium">Docente acompañante
                            del proyecto</p>
                    </div>
                    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-6">
                        <div class="bg-card-light dark:bg-card-dark p-4 rounded-xl text-center shadow-sm hover:shadow-lg transition-shadow">
                            <img alt="Foto del alumno"
                                class="w-24 h-24 rounded-full mx-auto mb-4 object-cover"
                                src=""/>
                            <h4
                                class="font-bold text-text-light dark:text-text-dark">Albini Francesco</h4>
                            <div
                                class="flex justify-center space-x-3 mt-3 text-text-muted-light dark:text-text-muted-dark">
                                <a><i class="fab fa-instagram text-xl"></i></a>
                                <a><i class="fab fa-github text-xl"></i></a>
                            </div>
                        </div>
                        <div
                            class="bg-card-light dark:bg-card-dark p-4 rounded-xl text-center shadow-sm hover:shadow-lg transition-shadow">
                            <img alt="Foto del alumno"
                                class="w-24 h-24 rounded-full mx-auto mb-4 object-cover"
                                src=""/>
                            <h4
                                class="font-bold text-text-light dark:text-text-dark">Alderete Thomas</h4>
                            <div
                                class="flex justify-center space-x-3 mt-3 text-text-muted-light dark:text-text-muted-dark">
                                <a><i class="fab fa-instagram text-xl"></i></a>
                                <a><i class="fab fa-github text-xl"></i></a>
                            </div>
                        </div>
                        <div
                            class="bg-card-light dark:bg-card-dark p-4 rounded-xl text-center shadow-sm hover:shadow-lg transition-shadow">
                            <img alt="Foto del alumno"
                                class="w-24 h-24 rounded-full mx-auto mb-4 object-cover"
                                src=""/>
                            <h4
                                class="font-bold text-text-light dark:text-text-dark">Ian Basly</h4>
                            <div
                                class="flex justify-center space-x-3 mt-3 text-text-muted-light dark:text-text-muted-dark">
                                <a><i class="fab fa-instagram text-xl"></i></a>
                                <a><i class="fab fa-github text-xl"></i></a>
                            </div>
                        </div>
                        <div
                            class="bg-card-light dark:bg-card-dark p-4 rounded-xl text-center shadow-sm hover:shadow-lg transition-shadow">
                            <img alt="Foto del alumno"
                                class="w-24 h-24 rounded-full mx-auto mb-4 object-cover"
                                src=""/>
                            <h4
                                class="font-bold text-text-light dark:text-text-dark">Carrizo Dylan</h4>
                            <div
                                class="flex justify-center space-x-3 mt-3 text-text-muted-light dark:text-text-muted-dark">
                                <a><i class="fab fa-instagram text-xl"></i></a>
                                <a><i class="fab fa-github text-xl"></i></a>
                            </div>
                        </div>
                        <div
                            class="bg-card-light dark:bg-card-dark p-4 rounded-xl text-center shadow-sm hover:shadow-lg transition-shadow">
                            <img alt="Foto del alumno"
                                class="w-24 h-24 rounded-full mx-auto mb-4 object-cover"
                                src=""/>
                            <h4
                                class="font-bold text-text-light dark:text-text-dark">Lorenzo Pernet</h4>
                            <div
                                class="flex justify-center space-x-3 mt-3 text-text-muted-light dark:text-text-muted-dark">
                                <a><i class="fab fa-instagram text-xl"></i></a>
                                <a><i class="fab fa-github text-xl"></i></a>
                            </div>
                        </div>
                        <div
                            class="bg-card-light dark:bg-card-dark p-4 rounded-xl text-center shadow-sm hover:shadow-lg transition-shadow">
                            <img alt="Foto del alumno"
                                class="w-24 h-24 rounded-full mx-auto mb-4 object-cover"
                                src=""/>
                            <h4
                                class="font-bold text-text-light dark:text-text-dark">Loza Leandro</h4>
                            <div
                                class="flex justify-center space-x-3 mt-3 text-text-muted-light dark:text-text-muted-dark">
                                <a><i class="fab fa-instagram text-xl"></i></a>
                                <a><i class="fab fa-github text-xl"></i></a>
                            </div>
                        </div>
                        <div
                            class="bg-card-light dark:bg-card-dark p-4 rounded-xl text-center shadow-sm hover:shadow-lg transition-shadow">
                            <img alt="Foto del alumno"
                                class="w-24 h-24 rounded-full mx-auto mb-4 object-cover"
                                src=""/>
                            <h4
                                class="font-bold text-text-light dark:text-text-dark">Torrico Fiona</h4>
                            <div
                                class="flex justify-center space-x-3 mt-3 text-text-muted-light dark:text-text-muted-dark">
                                <a><i class="fab fa-instagram text-xl"></i></a>
                                <a><i class="fab fa-github text-xl"></i></a>
                            </div>
                        </div>
                        <div class="bg-card-light dark:bg-card-dark p-4 rounded-xl text-center shadow-sm hover:shadow-lg transition-shadow">
                            <img alt="Foto del alumno"
                                class="w-24 h-24 rounded-full mx-auto mb-4 object-cover"
                                src=""/>
                            <h4
                                class="font-bold text-text-light dark:text-text-dark">Milan Facundo</h4>
                            <div
                                class="flex justify-center space-x-3 mt-3 text-text-muted-light dark:text-text-muted-dark">
                                <a><i class="fab fa-instagram text-xl"></i></a>
                                <a><i class="fab fa-github text-xl"></i></a>
                            </div>
                        </div>
                        <div class="bg-card-light dark:bg-card-dark p-4 rounded-xl text-center shadow-sm hover:shadow-lg transition-shadow">
                            <img alt="Foto del alumno"
                                class="w-24 h-24 rounded-full mx-auto mb-4 object-cover"
                                src=""/>
                            <h4 class="font-bold text-text-light dark:text-text-dark">Uriel Maza</h4>
                            <div
                                class="flex justify-center space-x-3 mt-3 text-text-muted-light dark:text-text-muted-dark">
                                <a><i class="fab fa-instagram text-xl"></i></a>
                                <a><i class="fab fa-github text-xl"></i></a>
                            </div>
                        </div>
                        <!-- <div
                            class="bg-card-light dark:bg-card-dark p-4 rounded-xl text-center shadow-sm hover:shadow-lg transition-shadow border-2 border-dashed border-gray-300 dark:border-gray-600 flex items-center justify-center">
                            <div class="text-center">
                                <div
                                    class="w-24 h-24 rounded-full mx-auto mb-4 bg-gray-200 dark:bg-gray-700"></div>
                                <h4
                                    class="font-bold text-text-light dark:text-text-dark">Editable</h4>
                            </div>
                        </div> -->
                    </div>
                </div>
            </section>
            <section class="py-20 bg-card-light dark:bg-card-dark"
                id="contacto">
                <div class="container mx-auto px-4 text-center">
                    <h2
                        class="text-3xl md:text-4xl font-bold mb-4 text-text-light dark:text-text-dark">¡Mantente
                        Conectado!</h2>
                    <p
                        class="text-lg text-text-muted-light dark:text-text-muted-dark mb-8 max-w-2xl mx-auto">
                        Sigue nuestro proyecto en redes sociales para no
                        perderte ninguna novedad, actualización o consejo
                        profesional.
                    </p>
                    <a
                        class="inline-flex items-center bg-gradient-to-r from-pink-500 via-red-500 to-yellow-500 text-white px-8 py-3 rounded-lg font-bold text-lg hover:opacity-90 transition-all shadow-lg transform hover:scale-105"
                        href="https://www.instagram.com/_cvrus_?" target="_blank">
                        <svg aria-hidden="true" class="w-7 h-7 mr-3"
                            fill="currentColor" viewBox="0 0 24 24"><path
                                d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.85s-.011 3.585-.069 4.85c-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07s-3.585-.012-4.85-.07c-3.252-.148-4.771-1.691-4.919-4.919-.058-1.265-.069-1.645-.069-4.85s.011-3.585.069-4.85c.149-3.225 1.664-4.771 4.919-4.919C8.415 2.175 8.796 2.163 12 2.163zm0 1.802c-3.116 0-3.482.01-4.695.067-2.61.121-3.834 1.344-3.956 3.956-.057 1.213-.066 1.576-.066 4.695s.009 3.482.066 4.695c.122 2.611 1.346 3.834 3.956 3.956 1.213.057 1.579.066 4.695.066 3.116 0 3.482-.01 4.695-.066 2.61-.122 3.833-1.345 3.956-3.956.057-1.213.066-1.576.066-4.695s-.009-3.482-.066-4.695c-.122-2.611-1.346-3.834-3.956-3.956C15.482 3.975 15.116 3.965 12 3.965zM12 6.848c-2.839 0-5.152 2.313-5.152 5.152s2.313 5.152 5.152 5.152 5.152-2.313 5.152-5.152S14.839 6.848 12 6.848zm0 8.498c-1.844 0-3.348-1.504-3.348-3.348s1.504-3.348 3.348-3.348 3.348 1.504 3.348 3.348-1.504 3.348-3.348 3.348zm4.908-8.212a1.212 1.212 0 100-2.424 1.212 1.212 0 000 2.424z"></path></svg>
                        @CVrus en Instagram
                    </a>
                </div>
            </section>
        </main>
        <footer class="bg-background-dark text-text-muted-dark">
            <div class="container mx-auto px-4 py-8">
                <div
                    class="flex flex-col md:flex-row justify-between items-center text-center md:text-left">
                    <div class="mb-4 md:mb-0">
                        <div
                            class="flex items-center justify-center md:justify-start space-x-2">
                            <img alt="CVrus Logo" class="h-8 w-8" src="img/cvrus_logo_solo_blanco.svg">
                            <span
                                class="text-xl font-bold text-text-dark">CVrus</span>
                        </div>
                        <p class="text-sm mt-2">Un proyecto de la Escuela
                            Técnica N°3.</p>
                    </div>
                    <div class="text-sm">
                        © 2025 CVrus. Todos los derechos reservados.
                    </div>
                </div>
            </div>
        </footer>

    </body></html>
