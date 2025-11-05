@component(head)
<link rel="stylesheet" href="views/assets/css/profile.css">
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
    </div>
  </header>

  <main>
    <div class="container">
      <a href="?slug=panel" class="back-link">
        <span class="material-icons" style="font-size: 1.125rem;">arrow_back</span>
        Volver al Dashboard
      </a>

      <div class="page-header">
        <h1 class="page-title">Contanos sobre vos</h1>
        <p class="page-subtitle">Completá tu información para que tu CV refleje quién sos realmente</p>
      </div>

      <div class="progress-indicator">
        <div class="progress-bar-container">
          <div class="progress-fill" id="progressFill"></div>
        </div>
        <div class="progress-text">
          <span>Tu perfil está <span id="progressPercent">0%</span> completo</span>
          <span class="progress-percentage"><span id="filledFields">0</span>/15 campos</span>
        </div>
      </div>

      <!-- Sección: Presentación Personal -->
      <div class="section-card">
        <div class="section-header">
          <div class="section-icon">
            <span class="material-icons">person</span>
          </div>
          <div class="section-title-group">
            <h2>Tu presentación personal</h2>
            <p>Dale a conocer a los reclutadores quién sos</p>
          </div>
        </div>

        <div class="form-group">
          <label class="form-label">
            <span class="material-icons" style="font-size: 1rem;">image</span>
            Foto de perfil
            <span class="optional-badge">Opcional</span>
          </label>
          <div class="photo-upload">
            <div class="photo-preview" id="photoPreview">
              <span class="material-icons">add_photo_alternate</span>
            </div>
            <div>
              <button class="upload-btn" onclick="document.getElementById('photoInput').click()">
                <span class="material-icons" style="font-size: 1.125rem;">upload</span>
                Subir foto
              </button>
              <input type="file" id="photoInput" accept="image/*" style="display: none;">
              <p class="form-hint">
                <span class="material-icons" style="font-size: 0.875rem;">info</span>
                Una buena foto profesional aumenta tus chances
              </p>
            </div>
          </div>
        </div>

        <div class="form-group">
          <label class="form-label">
            <span class="material-icons" style="font-size: 1rem;">chat_bubble</span>
            Breve presentación
          </label>
          <textarea class="form-textarea" placeholder="Ej: Soy un estudiante apasionado por la tecnología, me encanta resolver problemas y aprender cosas nuevas. Siempre busco mejorar y dar lo mejor de mí en cada proyecto..."></textarea>
          <p class="form-hint">
            <span class="material-icons" style="font-size: 0.875rem;">lightbulb</span>
            Contá qué te motiva, qué te gusta hacer y qué buscás
          </p>
        </div>
      </div>

      <!-- Sección: Tu Trayectoria -->
      <div class="section-card">
        <div class="section-header">
          <div class="section-icon">
            <span class="material-icons">work</span>
          </div>
          <div class="section-title-group">
            <h2>Tu trayectoria profesional</h2>
            <p>Mostrá tu experiencia y lo que aprendiste</p>
          </div>
        </div>

        <div class="form-group">
          <label class="form-label">
            <span class="material-icons" style="font-size: 1rem;">business_center</span>
            Experiencia laboral
            <span class="optional-badge">Opcional</span>
          </label>
          <div class="dynamic-list" id="experienceList">
            <div class="list-item">
              <input type="text" class="form-input" placeholder="Ej: Atención al cliente en local de comida rápida (6 meses)">
              <button class="btn-remove" onclick="this.parentElement.remove(); updateProgress()">
                <span class="material-icons">close</span>
              </button>
            </div>
          </div>
          <button class="btn-add" onclick="addExperience()">
            <span class="material-icons" style="font-size: 1rem;">add</span>
            Agregar otra experiencia
          </button>
        </div>

        <div class="form-group">
          <label class="form-label">
            <span class="material-icons" style="font-size: 1rem;">school</span>
            Prácticas profesionalizantes
            <span class="optional-badge">Opcional</span>
          </label>
          <div class="dynamic-list" id="practicesList">
            <div class="list-item">
              <input type="text" class="form-input" placeholder="Ej: Pasantía en empresa de desarrollo de software - 3 meses">
              <button class="btn-remove" onclick="this.parentElement.remove(); updateProgress()">
                <span class="material-icons">close</span>
              </button>
            </div>
          </div>
          <button class="btn-add" onclick="addPractice()">
            <span class="material-icons" style="font-size: 1rem;">add</span>
            Agregar otra práctica
          </button>
        </div>
      </div>

      <!-- Sección: Educación -->
      <div class="section-card">
        <div class="section-header">
          <div class="section-icon">
            <span class="material-icons">menu_book</span>
          </div>
          <div class="section-title-group">
            <h2>Tu educación</h2>
            <p>Títulos, cursos y certificaciones</p>
          </div>
        </div>

        <div class="form-group">
          <label class="form-label">
            <span class="material-icons" style="font-size: 1rem;">workspace_premium</span>
            Títulos y certificaciones adicionales
            <span class="optional-badge">Opcional</span>
          </label>
          <div class="dynamic-list" id="titlesList">
            <div class="list-item">
              <input type="text" class="form-input" placeholder="Ej: Certificado de Inglés B2 - Cambridge">
              <button class="btn-remove" onclick="this.parentElement.remove(); updateProgress()">
                <span class="material-icons">close</span>
              </button>
            </div>
          </div>
          <button class="btn-add" onclick="addTitle()">
            <span class="material-icons" style="font-size: 1rem;">add</span>
            Agregar otro título
          </button>
        </div>

        <div class="form-group">
          <label class="form-label">
            <span class="material-icons" style="font-size: 1rem;">emoji_events</span>
            Perfil del egresado
            <span class="optional-badge">Solo si egresaste</span>
          </label>
          <select class="form-select">
            <option value="">Seleccioná tu especialidad</option>
            <option value="informatica">Técnico en Informática</option>
            <option value="electronica">Técnico en Electrónica</option>
            <option value="electromecanica">Técnico en Electromecánica</option>
            <option value="otro">Otra especialidad</option>
          </select>
        </div>
      </div>

      <!-- Sección: Habilidades -->
      <div class="section-card">
        <div class="section-header">
          <div class="section-icon">
            <span class="material-icons">psychology</span>
          </div>
          <div class="section-title-group">
            <h2>Tus superpoderes</h2>
            <p>Contanos qué sabés hacer bien</p>
          </div>
        </div>

        <div class="form-group">
          <label class="form-label">
            <span class="material-icons" style="font-size: 1rem;">code</span>
            Habilidades técnicas
          </label>
          <div class="dynamic-list" id="techSkillsList">
            <div class="list-item">
              <input type="text" class="form-input" placeholder="Ej: Python, JavaScript, HTML/CSS">
              <button class="btn-remove" onclick="this.parentElement.remove(); updateProgress()">
                <span class="material-icons">close</span>
              </button>
            </div>
          </div>
          <button class="btn-add" onclick="addTechSkill()">
            <span class="material-icons" style="font-size: 1rem;">add</span>
            Agregar más habilidades
          </button>
        </div>

        <div class="form-group">
          <label class="form-label">
            <span class="material-icons" style="font-size: 1rem;">favorite</span>
            Habilidades personales
          </label>
          <div class="dynamic-list" id="softSkillsList">
            <div class="list-item">
              <input type="text" class="form-input" placeholder="Ej: Trabajo en equipo, Creatividad, Resolución de problemas">
              <button class="btn-remove" onclick="this.parentElement.remove(); updateProgress()">
                <span class="material-icons">close</span>
              </button>
            </div>
          </div>
          <button class="btn-add" onclick="addSoftSkill()">
            <span class="material-icons" style="font-size: 1rem;">add</span>
            Agregar más habilidades
          </button>
          <p class="form-hint">
            <span class="material-icons" style="font-size: 0.875rem;">tips_and_updates</span>
            Pensá en lo que tus amigos o profes destacan de vos
          </p>
        </div>

        <div class="form-group">
          <label class="form-label">
            <span class="material-icons" style="font-size: 1rem;">translate</span>
            Idiomas
          </label>
          <div class="dynamic-list" id="languagesList">
            <div class="list-item">
              <input type="text" class="form-input" placeholder="Ej: Inglés - Intermedio">
              <button class="btn-remove" onclick="this.parentElement.remove(); updateProgress()">
                <span class="material-icons">close</span>
              </button>
            </div>
          </div>
          <button class="btn-add" onclick="addLanguage()">
            <span class="material-icons" style="font-size: 1rem;">add</span>
            Agregar otro idioma
          </button>
        </div>
      </div>

      <!-- Sección: Proyectos -->
      <div class="section-card">
        <div class="section-header">
          <div class="section-icon">
            <span class="material-icons">rocket_launch</span>
          </div>
          <div class="section-title-group">
            <h2>Tus proyectos</h2>
            <p>Mostrá en qué estuviste trabajando</p>
          </div>
        </div>

        <div class="form-group">
          <label class="form-label">
            <span class="material-icons" style="font-size: 1rem;">folder_special</span>
            Proyectos personales
            <span class="optional-badge">Opcional</span>
          </label>
          <div class="dynamic-list" id="projectsList">
            <div class="list-item">
              <input type="text" class="form-input" placeholder="Ej: App móvil para organizar tareas - React Native">
              <button class="btn-remove" onclick="this.parentElement.remove(); updateProgress()">
                <span class="material-icons">close</span>
              </button>
            </div>
          </div>
          <button class="btn-add" onclick="addProject()">
            <span class="material-icons" style="font-size: 1rem;">add</span>
            Agregar otro proyecto
          </button>
          <p class="form-hint">
            <span class="material-icons" style="font-size: 0.875rem;">auto_awesome</span>
            Incluí proyectos escolares, personales o colaborativos
          </p>
        </div>
      </div>

      <!-- Sección: Disponibilidad -->
      <div class="section-card">
        <div class="section-header">
          <div class="section-icon">
            <span class="material-icons">schedule</span>
          </div>
          <div class="section-title-group">
            <h2>Tu disponibilidad</h2>
            <p>Contanos cuándo podés trabajar</p>
          </div>
        </div>

        <div class="form-group">
          <label class="form-label">
            <span class="material-icons" style="font-size: 1rem;">calendar_today</span>
            Horarios disponibles
          </label>
          <textarea class="form-textarea" style="min-height: 80px;" placeholder="Ej: Lunes a viernes de 14 a 18hs. Fines de semana completo. Actualmente estoy cursando en el turno mañana."></textarea>
          <p class="form-hint">
            <span class="material-icons" style="font-size: 0.875rem;">info</span>
            Mencioná si tenés otras actividades o estudios
          </p>
        </div>

        <div class="form-group">
          <label class="form-label">
            <span class="material-icons" style="font-size: 1rem;">flight_takeoff</span>
            ¿Podés viajar por trabajo?
          </label>
          <div class="radio-group">
            <div class="radio-option">
              <input type="radio" id="travel-yes" name="travel" value="yes">
              <label for="travel-yes" class="radio-label">Sí, sin problemas</label>
            </div>
            <div class="radio-option">
              <input type="radio" id="travel-sometimes" name="travel" value="sometimes">
              <label for="travel-sometimes" class="radio-label">A veces</label>
            </div>
            <div class="radio-option">
              <input type="radio" id="travel-no" name="travel" value="no">
              <label for="travel-no" class="radio-label">Prefiero no viajar</label>
            </div>
          </div>
        </div>

        <div class="form-group">
          <label class="form-label">
            <span class="material-icons" style="font-size: 1rem;">work_outline</span>
            ¿Qué tipo de puesto buscás?
          </label>
          <input type="text" class="form-input" placeholder="Ej: Desarrollador Junior, Soporte Técnico, Diseño Gráfico">
          <p class="form-hint">
            <span class="material-icons" style="font-size: 0.875rem;">explore</span>
            Esto ayuda a que te encuentren las empresas correctas
          </p>
        </div>
      </div>

      <!-- Sección: Redes Sociales -->
      <div class="section-card">
        <div class="section-header">
          <div class="section-icon">
            <span class="material-icons">share</span>
          </div>
          <div class="section-title-group">
            <h2>Tu presencia digital</h2>
            <p>Compartí tus perfiles profesionales</p>
          </div>
        </div>

        <div class="form-group">
          <label class="form-label">
            <span class="material-icons" style="font-size: 1rem;">code</span>
            GitHub
            <span class="optional-badge">Opcional</span>
          </label>
          <input type="url" class="form-input" placeholder="https://github.com/tu-usuario">
        </div>

        <div class="form-group">
          <label class="form-label">
            <span class="material-icons" style="font-size: 1rem;">business</span>
            LinkedIn
            <span class="optional-badge">Opcional</span>
          </label>
          <input type="url" class="form-input" placeholder="https://linkedin.com/in/tu-perfil">
        </div>

        <div class="form-group">
          <label class="form-label">
            <span class="material-icons" style="font-size: 1rem;">language</span>
            Portfolio o sitio web
            <span class="optional-badge">Opcional</span>
          </label>
          <input type="url" class="form-input" placeholder="https://tu-portfolio.com">
        </div>

        <div class="form-group">
          <label class="form-label">
            <span class="material-icons" style="font-size: 1rem;">link</span>
            Otras redes
            <span class="optional-badge">Opcional</span>
          </label>
          <input type="text" class="form-input" placeholder="Ej: Instagram: @tu_usuario, Behance: tu_portfolio">
        </div>
      </div>

      <!-- Botones de acción -->
      <div class="action-buttons">
        <button class="btn-secondary">
          <span class="material-icons">save</span>
          Guardar borrador
        </button>
        <button class="btn-primary" id="submitBtn">
          <span class="material-icons">check_circle</span>
          Completar perfil
        </button>
      </div>
    </div>
  </main>

  <script src="views/assets/js/profile.js"></script>
</body>
</html>