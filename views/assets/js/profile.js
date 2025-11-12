// Manejo de foto
    document.getElementById('photoInput').addEventListener('change', function(e) {
      const file = e.target.files[0];
      if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
          document.getElementById('photoPreview').innerHTML = `<img src="${e.target.result}" alt="Preview">`;
          updateProgress();
        };
        reader.readAsDataURL(file);
      }
    });

    // Funciones para agregar campos dinámicos
    function addExperience() {
      const list = document.getElementById('experienceList');
      const item = document.createElement('div');
      item.className = 'list-item';
      item.innerHTML = `
        <input type="text" class="form-input" placeholder="Ej: Ayudante en local familiar - 1 año">
        <button class="btn-remove" onclick="this.parentElement.remove(); updateProgress()">
          <span class="material-icons">close</span>
        </button>
      `;
      list.appendChild(item);
      item.querySelector('input').addEventListener('input', updateProgress);
    }

    function addPractice() {
      const list = document.getElementById('practicesList');
      const item = document.createElement('div');
      item.className = 'list-item';
      item.innerHTML = `
        <input type="text" class="form-input" placeholder="Ej: Mantenimiento de equipos en empresa local">
        <button class="btn-remove" onclick="this.parentElement.remove(); updateProgress()">
          <span class="material-icons">close</span>
        </button>
      `;
      list.appendChild(item);
      item.querySelector('input').addEventListener('input', updateProgress);
    }

    function addTitle() {
      const list = document.getElementById('titlesList');
      const item = document.createElement('div');
      item.className = 'list-item';
      item.innerHTML = `
        <input type="text" class="form-input" placeholder="Ej: Curso de Desarrollo Web - Udemy">
        <button class="btn-remove" onclick="this.parentElement.remove(); updateProgress()">
          <span class="material-icons">close</span>
        </button>
      `;
      list.appendChild(item);
      item.querySelector('input').addEventListener('input', updateProgress);
    }

    function addTechSkill() {
      const list = document.getElementById('techSkillsList');
      const item = document.createElement('div');
      item.className = 'list-item';
      item.innerHTML = `
        <input type="text" class="form-input" placeholder="Ej: Photoshop, Excel avanzado, Arduino">
        <button class="btn-remove" onclick="this.parentElement.remove(); updateProgress()">
          <span class="material-icons">close</span>
        </button>
      `;
      list.appendChild(item);
      item.querySelector('input').addEventListener('input', updateProgress);
    }

    function addSoftSkill() {
      const list = document.getElementById('softSkillsList');
      const item = document.createElement('div');
      item.className = 'list-item';
      item.innerHTML = `
        <input type="text" class="form-input" placeholder="Ej: Comunicación efectiva, Liderazgo, Adaptabilidad">
        <button class="btn-remove" onclick="this.parentElement.remove(); updateProgress()">
          <span class="material-icons">close</span>
        </button>
      `;
      list.appendChild(item);
      item.querySelector('input').addEventListener('input', updateProgress);
    }

    function addLanguage() {
      const list = document.getElementById('languagesList');
      const item = document.createElement('div');
      item.className = 'list-item';
      item.innerHTML = `
        <input type="text" class="form-input" placeholder="Ej: Portugués - Básico">
        <button class="btn-remove" onclick="this.parentElement.remove(); updateProgress()">
          <span class="material-icons">close</span>
        </button>
      `;
      list.appendChild(item);
      item.querySelector('input').addEventListener('input', updateProgress);
    }

    function addProject() {
      const list = document.getElementById('projectsList');
      const item = document.createElement('div');
      item.className = 'list-item';
      item.innerHTML = `
        <input type="text" class="form-input" placeholder="Ej: Sistema de gestión para biblioteca escolar">
        <button class="btn-remove" onclick="this.parentElement.remove(); updateProgress()">
          <span class="material-icons">close</span>
        </button>
      `;
      list.appendChild(item);
      item.querySelector('input').addEventListener('input', updateProgress);
    }

    // Actualizar progreso
    function updateProgress() {
      const inputs = document.querySelectorAll('.form-input, .form-textarea, .form-select');
      const radios = document.querySelectorAll('input[type="radio"]:checked');
      const photo = document.querySelector('#photoPreview img');
      
      let filled = 0;
      let total = 15; // Total de campos importantes
      
      // Contar inputs llenos
      inputs.forEach(input => {
        if (input.value.trim() !== '') filled++;
      });
      
      // Contar radios seleccionados
      if (radios.length > 0) filled++;
      
      // Contar foto
      if (photo) filled++;
      
      const percentage = Math.round((filled / total) * 100);
      
      document.getElementById('progressFill').style.width = percentage + '%';
      document.getElementById('progressPercent').textContent = percentage + '%';
      document.getElementById('filledFields').textContent = filled;
    }

    // Event listeners para actualizar progreso
    document.querySelectorAll('.form-input, .form-textarea, .form-select').forEach(input => {
      input.addEventListener('input', updateProgress);
      input.addEventListener('change', updateProgress);
    });

    document.querySelectorAll('input[type="radio"]').forEach(radio => {
      radio.addEventListener('change', updateProgress);
    });

    // Animación de entrada para las secciones
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

    document.querySelectorAll('.section-card').forEach(el => {
      el.style.opacity = '0';
      el.style.transform = 'translateY(20px)';
      el.style.transition = 'opacity 0.5s, transform 0.5s';
      observer.observe(el);
    });

    // Manejo del botón de envío
    document.getElementById('submitBtn').addEventListener('click', function() {
      const percentage = parseInt(document.getElementById('progressPercent').textContent);
      
      if (percentage < 40) {
        alert('¡Completá al menos el 40% de tu perfil para continuar! 😊');
        return;
      }
      
      // Aquí iría la lógica para enviar el formulario
      alert('¡Perfil guardado exitosamente! 🎉');
      window.location.href = '?slug=templates';
    });

    // Scroll suave al hacer clic en los enlaces
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