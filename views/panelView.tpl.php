@component(head)
<link rel="stylesheet" href="views/assets/css/panel.css">
</head>
<body>
  <header>
    <div class="container">
      <div class="header-content">
        <div class="logo-section">
          <img alt="CVrus Logo" src="./views/assets/img/cvrus_logo_solo.svg">
          <span>CVrus</span>
        </div>
        <div class="header-actions">
          <a class="nav-link" href="#dashboard">Dashboard</a>
          <button class="icon-btn" title="Ayuda">
            <span class="material-icons">help_outline</span>
          </button>
          <a href="?slug=logout" class="icon-btn logout-btn" title="Cerrar sesión">
            <span class="material-icons">logout</span>
          </a>
        </div>
      </div>
    </div>
  </header>

  <main id="dashboard">
    <div class="container">
      <div class="page-header">
        <h1 class="page-title">Bienvenido de vuelta</h1>
        <p class="page-subtitle">Gestiona tus currículums y mantén tu perfil actualizado</p>
      </div>

      <div class="stats-grid">
        <div class="stat-card">
          <div class="stat-header">
            <div class="stat-icon primary">
              <i class="material-icons">description</i>
            </div>
          </div>
          <div class="stat-value">3</div>
          <div class="stat-label">CVs Generados</div>
        </div>

        <div class="stat-card">
          <div class="stat-header">
            <div class="stat-icon success">
              <i class="material-icons">download</i>
            </div>
          </div>
          <div class="stat-value">12</div>
          <div class="stat-label">Descargas Totales</div>
        </div>

        <div class="stat-card">
          <div class="stat-header">
            <div class="stat-icon warning">
              <i class="material-icons">update</i>
            </div>
          </div>
          <div class="stat-value">Hace 2 días</div>
          <div class="stat-label">Última Actualización</div>
        </div>
      </div>

      <h2 class="section-title">Acciones Rápidas</h2>
      <div class="action-cards">
        <div class="action-card" onclick="window.location.href='?slug=templates'">
          <div class="action-icon primary">
            <i class="material-icons">add_circle</i>
          </div>
          <h3 class="action-title">Generar Nuevo CV</h3>
          <p class="action-description">Crea un currículum profesional en minutos usando nuestras plantillas</p>
          <button class="btn-primary">
            Comenzar
            <i class="material-icons">arrow_forward</i>
          </button>
        </div>

        <div class="action-card" onclick="window.location.href='?slug=profile'">
          <div class="action-icon secondary">
            <i class="material-icons">edit</i>
          </div>
          <h3 class="action-title">Actualizar Información</h3>
          <p class="action-description">Mantén tus datos personales y profesionales al día</p>
          <button class="btn-primary">
            Editar Perfil
            <i class="material-icons">arrow_forward</i>
          </button>
        </div>
      </div>

      <h2 class="section-title">Mis CVs Recientes</h2>
      <div class="recent-cvs">
        <div class="cv-list">
          <div class="cv-item">
            <div class="cv-info">
              <div class="cv-icon">
                <i class="material-icons">description</i>
              </div>
              <div class="cv-details">
                <h4>CV Harvard - Tech Position</h4>
                <p>Creado el 28 de octubre, 2025</p>
              </div>
            </div>
            <div class="cv-actions">
              <button class="btn-icon" title="Ver"><i class="material-icons">visibility</i></button>
              <button class="btn-icon" title="Descargar"><i class="material-icons">download</i></button>
              <button class="btn-icon" title="Compartir"><i class="material-icons">share</i></button>
            </div>
          </div>

          <div class="cv-item">
            <div class="cv-info">
              <div class="cv-icon">
                <i class="material-icons">description</i>
              </div>
              <div class="cv-details">
                <h4>CV Modern - General</h4>
                <p>Creado el 15 de octubre, 2025</p>
              </div>
            </div>
            <div class="cv-actions">
              <button class="btn-icon" title="Ver"><i class="material-icons">visibility</i></button>
              <button class="btn-icon" title="Descargar"><i class="material-icons">download</i></button>
              <button class="btn-icon" title="Compartir"><i class="material-icons">share</i></button>
            </div>
          </div>

          <div class="cv-item">
            <div class="cv-info">
              <div class="cv-icon">
                <i class="material-icons">description</i>
              </div>
              <div class="cv-details">
                <h4>CV Minimalist - Internship</h4>
                <p>Creado el 1 de octubre, 2025</p>
              </div>
            </div>
            <div class="cv-actions">
              <button class="btn-icon" title="Ver"><i class="material-icons">visibility</i></button>
              <button class="btn-icon" title="Descargar"><i class="material-icons">download</i></button>
              <button class="btn-icon" title="Compartir"><i class="material-icons">share</i></button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>

  <script src="./views/assets/js/panel.js"></script>
</body>
</html>
