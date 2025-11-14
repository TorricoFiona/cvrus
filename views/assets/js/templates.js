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