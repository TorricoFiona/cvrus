@component(head)
<link rel="stylesheet" href="views/assets/css/templates.css">
<body>
  <header>
    <div class="container">
      <div class="header-content">
        <div class="logo-section">
          <img alt="CVrus Logo" src="views/assets/img/cvrus_logo_solo.svg">
          <span>CVrus</span>
        </div>
        <div class="header-actions">
          <a class="nav-link" href="?slug=panel">Dashboard</a>
          <button class="icon-btn">
            <span class="material-icons">help_outline</span>
          </button>
          <button class="icon-btn logout-btn" title="Cerrar sesión">
            <span class="material-icons">logout</span>
          </button>
      </div>
    </div>
  </header>

  <main>
    <div class="container">
      <a href="?slug=panel" class="back-link">
        <span class="material-icons" style="font-size: 1.125rem;">arrow_back</span>
        Volver al Dashboard
      </a>

      <div class="page-header">
        <h1 class="page-title">Elegí tu CV</h1>
        <p class="page-subtitle">Seleccioná una plantilla para generar tu currículum profesional</p>
      </div>

      <div class="templates-grid">
        <div class="template-card selected" data-template="Harvard">
          <div class="check-badge">
            <span class="material-icons" style="font-size: 1.125rem;">check</span>
          </div>
          <div class="template-overlay">
            <div class="preview-badge">Vista Previa</div>
          </div>
          <a href="views/pdfs/modelo-ATS-hardvard-sencillo.php"><div class="template-preview" style="background-image: linear-gradient(to bottom, rgba(0,0,0,0.1), rgba(0,0,0,0.5)), url('views/assets/img/modelo-ATS-hardvard-sencillo.png');">
            <h3 class="template-name">Harvard</h3>
            <p class="template-description">Clásico y profesional</p>
          </div></a>
        </div>

        <div class="template-card" data-template="Modern">
          <div class="check-badge">
            <span class="material-icons" style="font-size: 1.125rem;">check</span>
          </div>
          <div class="template-overlay">
            <div class="preview-badge">Vista Previa</div>
          </div>
          <a href="views/pdfs/minimalista-moderno.php"><div class="template-preview" style="background-image: linear-gradient(to bottom, rgba(0,0,0,0.1), rgba(0,0,0,0.5)), url('views/assets/img/minimalista-moderno.png');">
            <h3 class="template-name">Modern</h3>
            <p class="template-description">Limpio y contemporáneo</p>
          </div></a>
        </div>

        <div class="template-card" data-template="Minimalist">
          <div class="check-badge">
            <span class="material-icons" style="font-size: 1.125rem;">check</span>
          </div>
          <div class="template-overlay">
            <div class="preview-badge">Vista Previa</div>
          </div>
          <a href="views/pdfs/modelo-ATS-hardvard-minimalista.php"><div class="template-preview" style="background-image: linear-gradient(to bottom, rgba(0,0,0,0.1), rgba(0,0,0,0.5)), url('views/assets/img/modelo-ATS-hardvard-minimalista.png');">
            <h3 class="template-name">Minimalist</h3>
            <p class="template-description">Simple y elegante</p>
          </div></a>
        </div>
      </div>


      <div class="action-section">
        <button class="btn-generate" id="generateBtn" disabled>
          <span class="material-icons">description</span>
          Generar CV
        </button>

        <div class="progress-container" id="progressContainer">
          <div class="progress-header">
            <span class="progress-title">Generando tu CV...</span>
            <span class="progress-percentage" id="progressPercentage">0%</span>
          </div>
          <div class="progress-bar-bg">
            <div class="progress-bar" id="progressBar" style="width: 0%;"></div>
          </div>
          <p class="progress-text">Por favor espera un momento. Esto no debería tomar mucho tiempo.</p>
        </div>
      </div>
    </div>
  </main>

  <script>
    let selectedTemplate = 'Harvard';
const templates = document.querySelectorAll('.template-card');
const generateBtn = document.getElementById('generateBtn');
const progressContainer = document.getElementById('progressContainer');
const progressBar = document.getElementById('progressBar');
const progressPercentage = document.getElementById('progressPercentage');

// Habilitar botón al cargar porque ya hay uno seleccionado por defecto
generateBtn.disabled = false;

templates.forEach(card => {
  card.addEventListener('click', () => {
    // Quitar selección previa
    templates.forEach(c => c.classList.remove('selected'));
    
    // Marcar este
    card.classList.add('selected');
    selectedTemplate = card.dataset.template;
    
    // Habilitar botón
    generateBtn.disabled = false;
    
    console.log('Template seleccionado:', selectedTemplate);
  });
});

generateBtn.addEventListener('click', () => {
  // Deshabilitar botón
  generateBtn.disabled = true;
  
  // Mostrar progreso
  progressContainer.classList.add('active');
  
  // Simular progreso
  let progress = 0;
  const interval = setInterval(() => {
    progress += 10;
    progressBar.style.width = progress + '%';
    progressPercentage.textContent = progress + '%';
    
    if (progress >= 100) {
      clearInterval(interval);
      setTimeout(() => {
        // Aquí rediriges a la página de descarga o vista previa
        alert('¡CV generado exitosamente!');
        progressContainer.classList.remove('active');
        generateBtn.disabled = false;
        progressBar.style.width = '0%';
        progressPercentage.textContent = '0%';
      }, 500);
    }
  }, 300);
});

// Animación de entrada
const observerOptions = {
  threshold: 0.1,
  rootMargin: '0px 0px -50px 0px'
};

const observer = new IntersectionObserver((entries) => {
  entries.forEach(entry => {
    if (entry.isIntersecting) {
      entry.target.style.opacity = '1';
      entry.target.style.transform = 'translateY(0)';
    }
  });
}, observerOptions);

document.querySelectorAll('.template-card').forEach(el => {
  el.style.opacity = '0';
  el.style.transform = 'translateY(20px)';
  el.style.transition = 'opacity 0.5s, transform 0.5s';
  observer.observe(el);
});
  </script>
</body>
</html>