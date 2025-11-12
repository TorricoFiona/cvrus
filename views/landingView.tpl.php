@component(head)
<link rel="stylesheet" href="views/assets/css/landing.css">
</head>
<body>
    <header>
        <div class="container">
            <div class="header-content">
                <div class="logo-section">
                    <img alt="CVrus Logo" src="./views/assets/img/cvrus_logo_solo.svg">
                    <span>CVrus</span>
                </div>
                <nav>
                    <a href="#que-es">¿Qué es?</a>
                    <a href="#como-funciona">¿Cómo funciona?</a>
                    <a href="#beneficios">Beneficios</a>
                    <a href="#quienes-somos">Quiénes Somos</a>
                    <a href="#contacto">Contacto</a>
                </nav>
                <a class="btn-primary" href="?slug=login">Ingresar</a>
            </div>
        </div>
    </header>

    <main>
        <section id="hero">
            <div class="container">
                <h1>
                    Tu CV<br />
                    <span class="highlight">en un clic.</span>
                </h1>
                <p>
                    CVrus es la plataforma que te ayuda a crear un currículum vitae de forma rápida y sencilla.
                </p>
                <a class="btn-hero" href="?slug=login">
                    Generar mi CV
                    <span class="material-icons">arrow_forward</span>
                </a>
            </div>
        </section>

        <section class="bg-card" id="que-es">
            <div class="container">
                <div class="max-w-3xl text-center">
                    <h2>¿Qué es CVrus?</h2>
                    <p>
                        CVrus es una herramienta diseñada para los estudiantes de la Escuela Técnica N°3. 
                        Nuestra misión es simplificar la creación de tu primer currículum vitae, utilizando 
                        la información académica que la escuela ya posee y permitiéndote añadir tus habilidades 
                        y experiencias personales. El resultado es un CV profesional en formato PDF, listo para 
                        abrirte las puertas al mundo laboral.
                    </p>
                </div>
            </div>
        </section>

        <section id="como-funciona">
            <div class="container">
                <h2>¿Cómo funciona?</h2>
                <div class="grid-3">
                    <div class="step-card">
                        <div class="step-icon">
                            <span class="material-icons">school</span>
                        </div>
                        <h3>1. La escuela ya tiene tus datos</h3>
                        <p>
                            Inicia sesión y verás tu información académica precargada desde la base de datos institucional.
                        </p>
                    </div>
                    <div class="step-card">
                        <div class="step-icon">
                            <span class="material-icons">edit_document</span>
                        </div>
                        <h3>2. Completa lo que falta</h3>
                        <p>
                            Añade tus habilidades, experiencias y datos de contacto a través de un formulario simple y guiado.
                        </p>
                    </div>
                    <div class="step-card">
                        <div class="step-icon">
                            <span class="material-icons">download_for_offline</span>
                        </div>
                        <h3>3. Descargá tu CV profesional</h3>
                        <p>
                            Elige una plantilla y descarga tu CV en formato PDF, listo para enviar a empresas y reclutadores.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <section class="bg-card" id="beneficios">
            <div class="container">
                <h2>Beneficios</h2>
                <div class="grid-2">
                    <div class="benefit-card">
                        <h3>Para Estudiantes</h3>
                        <ul>
                            <li>
                                <span class="material-icons">check_circle</span>
                                <span>Ahorra tiempo y evita errores comunes.</span>
                            </li>
                            <li>
                                <span class="material-icons">check_circle</span>
                                <span>Causa una excelente primera impresión profesional.</span>
                            </li>
                            <li>
                                <span class="material-icons">check_circle</span>
                                <span>Totalmente gratuito y fácil de usar.</span>
                            </li>
                            <li>
                                <span class="material-icons">check_circle</span>
                                <span>Plantillas modernas y aprobadas institucionalmente.</span>
                            </li>
                        </ul>
                    </div>
                    <div class="benefit-card">
                        <h3>Para Empresas Locales</h3>
                        <ul>
                            <li>
                                <span class="material-icons">check_circle</span>
                                <span>Recibe CVs estandarizados y fáciles de leer.</span>
                            </li>
                            <li>
                                <span class="material-icons">check_circle</span>
                                <span>Accede a talento joven de la comunidad.</span>
                            </li>
                            <li>
                                <span class="material-icons">check_circle</span>
                                <span>Verifica la información académica de los candidatos.</span>
                            </li>
                            <li>
                                <span class="material-icons">check_circle</span>
                                <span>Fortalece el vínculo entre la escuela y el sector productivo.</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <section id="quienes-somos">
            <div class="container">
                <h2>Nuestro Equipo</h2>
                <div class="teacher-card">
                    <img alt="Foto del docente" src=""/>
                    <h3>Matias Baez</h3>
                    <p class="role">Docente acompañante del proyecto</p>
                </div>
                <div class="team-grid">
                    <div class="team-card">
                        <img alt="Foto del alumno" src=""/>
                        <h4>Ian Basly</h4>
                        <div class="social-links">
                            <a href="https://www.instagram.com/ian_basly07" target="_blank">
                                <i class="fab fa-instagram"></i>
                            </a>
                            <a href="https://www.github.com/lozaedf" target="_blank">
                                <i class="fab fa-github"></i>
                            </a>
                        </div>
                    </div>
                    <div class="team-card">
                        <img alt="Foto del alumno" src=""/>
                        <h4>Lorenzo Pernet</h4>
                        <div class="social-links">
                            <a href="https://www.instagram.com/tomaslorenzop/" target="_blank">
                                <i class="fab fa-instagram"></i>
                            </a>
                            <a><i class="fab fa-github"></i></a>
                        </div>
                    </div>
                    <div class="team-card">
                        <img alt="Foto del alumno" src=""/>
                        <h4>Loza Leandro</h4>
                        <div class="social-links">
                            <a href="https://www.instagram.com/leandroloza36/" target="_blank">
                                <i class="fab fa-instagram"></i>
                            </a>
                            <a href="https://github.com/lozalen341" target="_blank">
                                <i class="fab fa-github"></i>
                            </a>
                        </div>
                    </div>
                    <div class="team-card">
                        <img alt="Foto del alumno" src=""/>
                        <h4>Torrico Fiona</h4>
                        <div class="social-links">
                            <a href="https://www.instagram.com/fio_nnaah/" target="_blank">
                                <i class="fab fa-instagram"></i>
                            </a>
                            <a href="https://github.com/TorricoFiona" target="_blank">
                                <i class="fab fa-github"></i>
                            </a>
                        </div>
                    </div>
                    <div class="team-card">
                        <img alt="Foto del alumno" src=""/>
                        <h4>Uriel Maza</h4>
                        <div class="social-links">
                            <a href="https://www.instagram.com/urielmazaa_" target="_blank">
                                <i class="fab fa-instagram"></i>
                            </a>
                            <a><i class="fab fa-github"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="bg-card" id="contacto">
            <div class="container text-center">
                <h2>¡Mantente Conectado!</h2>
                <p style="max-width: 42rem; margin: 0 auto 2rem; color: #6B7280;">
                    Sigue nuestro proyecto en redes sociales para no perderte ninguna novedad, actualización o consejo profesional.
                </p>
                <a class="btn-instagram" href="https://www.instagram.com/_cvrus_?" target="_blank">
                    <svg fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.85s-.011 3.585-.069 4.85c-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07s-3.585-.012-4.85-.07c-3.252-.148-4.771-1.691-4.919-4.919-.058-1.265-.069-1.645-.069-4.85s.011-3.585.069-4.85c.149-3.225 1.664-4.771 4.919-4.919C8.415 2.175 8.796 2.163 12 2.163zm0 1.802c-3.116 0-3.482.01-4.695.067-2.61.121-3.834 1.344-3.956 3.956-.057 1.213-.066 1.576-.066 4.695s.009 3.482.066 4.695c.122 2.611 1.346 3.834 3.956 3.956 1.213.057 1.579.066 4.695.066 3.116 0 3.482-.01 4.695-.066 2.61-.122 3.833-1.345 3.956-3.956.057-1.213.066-1.576.066-4.695s-.009-3.482-.066-4.695c-.122-2.611-1.346-3.834-3.956-3.956C15.482 3.975 15.116 3.965 12 3.965zM12 6.848c-2.839 0-5.152 2.313-5.152 5.152s2.313 5.152 5.152 5.152 5.152-2.313 5.152-5.152S14.839 6.848 12 6.848zm0 8.498c-1.844 0-3.348-1.504-3.348-3.348s1.504-3.348 3.348-3.348 3.348 1.504 3.348 3.348-1.504 3.348-3.348 3.348zm4.908-8.212a1.212 1.212 0 100-2.424 1.212 1.212 0 000 2.424z"></path>
                    </svg>
                    @CVrus en Instagram
                </a>
            </div>
        </section>
    </main>
    @component(footer)

    <script>
        // Smooth scroll para los enlaces de navegación
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
    </script>
</body>
</html>