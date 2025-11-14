@component(head)
<link rel="stylesheet" href="views/assets/css/profile.css">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;900&display=swap" rel="stylesheet">
</head>

@component(header)
<main>
  <div class="container">
    <a href="?slug=panel" class="back-link">
      <span class="material-icons">arrow_back</span> Volver al Dashboard
    </a>

    <div class="page-header">
      <div class="header-badge">
        <span class="material-icons">rocket_launch</span>
        <span>Creá tu perfil profesional</span>
      </div>
      <h1 class="page-title">Contanos sobre vos</h1>
      <p class="page-subtitle">Completá tu información para que tu CV refleje quién sos realmente y destaque tus mejores habilidades</p>
    </div>

    <!-- Progress Indicator Mejorado -->
    <div class="progress-indicator">
      <div class="progress-header">
        <div class="progress-info">
          <h3>Progreso del perfil</h3>
          <p><span id="filledFields">0</span> campos completados</p>
        </div>
        <div class="progress-percentage-badge">
          <span id="progressPercent">0%</span>
        </div>
      </div>
      <div class="progress-bar-container">
        <div class="progress-fill" id="progressFill"></div>
        <div class="progress-shine"></div>
      </div>
    </div>

    <form action="?slug=profile" method="POST" enctype="multipart/form-data">
      <!-- DATOS PERSONALES -->
      <div class="section-card" data-section="personal">
        <div class="section-header">
          <div class="section-icon">
            <span class="material-icons">badge</span>
          </div>
          <div class="section-title-group">
            <h2>Datos Personales</h2>
            <p>Tu información básica de contacto</p>
          </div>
          <div class="section-badge">Esencial</div>
        </div>

        <div class="form-grid">
          <div class="form-group full-width">
            <label class="form-label">
              <span class="material-icons">add_a_photo</span> Foto de perfil
            </label>
            <input type="file" class="form-input" name="foto_perfil" accept="image/*">
            <div class="form-hint">
              <span class="material-icons">info</span>
              <span>Formatos: JPG, PNG. Tamaño máx. 2MB</span>
            </div>
          </div>

          <div class="form-group">
            <label class="form-label">
              <span class="material-icons">call</span> Teléfono
            </label>
            <input type="tel" class="form-input" name="telefono" placeholder="+54 11 2345 6789" value="<?= htmlspecialchars($perfil_usuario['telefono'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
          </div>

          <div class="form-group">
            <label class="form-label">
              <span class="material-icons">cake</span> Fecha de nacimiento
            </label>
            <input type="date" class="form-input" name="fecha_nacimiento" value="<?= htmlspecialchars($perfil_usuario['fecha_nacimiento'] ?? '', ENT_QUOTES, 'UTF-8') ?>" min="1900-01-01" max="<?= date('Y-m-d') ?>">
          </div>

          <div class="form-group">
            <label class="form-label">
              <span class="material-icons">home</span> Domicilio
            </label>
            <input type="text" class="form-input" name="domicilio" placeholder="Calle y número" value="<?= htmlspecialchars($perfil_usuario['domicilio'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
          </div>

          <div class="form-group">
            <label class="form-label">
              <span class="material-icons">location_city</span> Localidad
            </label>
            <input type="text" class="form-input" name="localidad" placeholder="Ej: Tortuguitas, Alberti" value="<?= htmlspecialchars($perfil_usuario['localidad'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
          </div>

          <div class="form-group">
            <label class="form-label">
              <span class="material-icons">flag</span> Nacionalidad
            </label>
            <select class="form-select" name="id_nacionalidad">
              <option value="">Seleccioná tu nacionalidad</option>
              <?php if(isset($nacionalidades)) foreach($nacionalidades as $n): $sel = (isset($perfil_usuario['id_nacionalidad']) && $perfil_usuario['id_nacionalidad']==$n['ID_NACIONALIDAD']) ? 'selected' : ''; ?>
                <option value="<?= $n['ID_NACIONALIDAD'] ?>" <?= $sel ?>><?= $n['nombre'] ?></option>
              <?php endforeach; ?>
            </select>
          </div>

          <div class="form-group">
            <label class="form-label">
              <span class="material-icons">workspaces</span> Modalidad
            </label>
            <select class="form-select" name="ID_MODALIDAD">
              <option value="">Seleccioná tu modalidad</option>
              <?php if(isset($modalidades)) foreach($modalidades as $m): $sel = (isset($perfil_usuario['ID_MODALIDAD']) && $perfil_usuario['ID_MODALIDAD']==$m['id_modalidad']) ? 'selected' : ''; ?>
                <option value="<?= $m['id_modalidad'] ?>" <?= $sel ?>><?= $m['nombre'] ?></option>
              <?php endforeach; ?>
            </select>
          </div>

          <div class="form-group full-width">
            <label class="form-label">
              <span class="material-icons">school</span> Curso
            </label>
            <select class="form-select" name="id_curso">
              <option value="">Seleccioná tu curso</option>
              <?php if(isset($cursos)) foreach($cursos as $c): $sel = (isset($perfil_usuario['id_curso']) && $perfil_usuario['id_curso']==$c['id_curso']) ? 'selected' : ''; ?>
                <option value="<?= $c['id_curso'] ?>" <?= $sel ?>><?= $c['nombre_curso'] ?> - <?= $c['turno'] ?></option>
              <?php endforeach; ?>
            </select>
          </div>
        </div>
      </div>

      <!-- PRESENTACIÓN PERSONAL -->
      <div class="section-card" data-section="presentation">
        <div class="section-header">
          <div class="section-icon">
            <span class="material-icons">person</span>
          </div>
          <div class="section-title-group">
            <h2>Tu presentación personal</h2>
            <p>Dale a conocer a los reclutadores quién sos</p>
          </div>
          <div class="section-badge">Destacado</div>
        </div>

        <div class="form-group">
          <label class="form-label">
            <span class="material-icons">chat_bubble</span> Breve presentación
          </label>
          <textarea class="form-textarea" name="presentacion" placeholder="Contá sobre vos..."><?= htmlspecialchars($formulario['presentacion'] ?? '', ENT_QUOTES, 'UTF-8') ?></textarea>
          <div class="form-hint">
            <span class="material-icons">lightbulb</span>
            <span>Consejo: Sé auténtico y menciona qué te motiva en tu área de estudio</span>
          </div>
        </div>
      </div>

      <!-- EXPERIENCIA LABORAL -->
      <div class="section-card" data-section="experience">
        <div class="section-header">
          <div class="section-icon">
            <span class="material-icons">business_center</span>
          </div>
          <div class="section-title-group">
            <h2>Experiencia laboral</h2>
            <p>Toda experiencia suma, aunque sea informal</p>
          </div>
          <div class="section-badge optional">Opcional</div>
        </div>

        <div class="dynamic-list" id="experienceList">
          <?php if(!empty($experiencias)): foreach($experiencias as $exp): ?>
          <div class="experience-item">
            <div class="form-grid">
              <div class="form-group full-width">
                <label class="form-label"><span class="material-icons">business</span> Empresa</label>
                <input type="text" class="form-input" name="empresa[]" value="<?= htmlspecialchars($exp['empresa'] ?? '', ENT_QUOTES, 'UTF-8') ?>" placeholder="Nombre de la empresa o negocio">
              </div>
              <div class="form-group full-width">
                <label class="form-label"><span class="material-icons">work</span> Puesto</label>
                <input type="text" class="form-input" name="puesto[]" value="<?= htmlspecialchars($exp['puesto'] ?? '', ENT_QUOTES, 'UTF-8') ?>" placeholder="Tu rol o posición">
              </div>
              <div class="form-group">
                <label class="form-label"><span class="material-icons">event</span> Fecha inicio</label>
                <input type="date" class="form-input" name="fecha_inicio[]" value="<?= htmlspecialchars($exp['fecha_inicio'] ?? '', ENT_QUOTES, 'UTF-8') ?>" min="1900-01-01" max="<?= date('Y-m-d') ?>">
              </div>
              <div class="form-group">
                <label class="form-label"><span class="material-icons">event_available</span> Fecha fin</label>
                <input type="date" class="form-input" name="fecha_fin[]" value="<?= htmlspecialchars($exp['fecha_fin'] ?? '', ENT_QUOTES, 'UTF-8') ?>" min="1900-01-01" max="<?= date('Y-m-d') ?>">
              </div>
              <div class="form-group full-width">
                <label class="form-label"><span class="material-icons">description</span> Descripción de tareas</label>
                <textarea class="form-textarea" name="descripcion[]" placeholder="¿Qué hacías en este trabajo?"><?= htmlspecialchars($exp['descripcion'] ?? '', ENT_QUOTES, 'UTF-8') ?></textarea>
              </div>
              <div class="form-group">
                <label class="form-label"><span class="material-icons">category</span> Tipo</label>
                <select class="form-select" name="tipo[]">
                  <option value="laboral" <?= (isset($exp['tipo']) && $exp['tipo']=='laboral')?'selected':''; ?>>Laboral</option>
                  <option value="otro" <?= (isset($exp['tipo']) && $exp['tipo']=='otro')?'selected':''; ?>>Otro (pasantía, voluntariado)</option>
                </select>
              </div>
            </div>
            <button type="button" class="btn-remove" onclick="this.closest('.experience-item').remove(); updateProgress()"><span class="material-icons">delete</span><span>Eliminar</span></button>
          </div>
          <?php endforeach; else: ?>
          <div class="experience-item">
            <div class="form-grid">
              <div class="form-group full-width"><label class="form-label"><span class="material-icons">business</span> Empresa</label><input type="text" class="form-input" name="empresa[]" placeholder="Nombre de la empresa o negocio"></div>
              <div class="form-group full-width"><label class="form-label"><span class="material-icons">work</span> Puesto</label><input type="text" class="form-input" name="puesto[]" placeholder="Tu rol o posición"></div>
              <div class="form-group"><label class="form-label"><span class="material-icons">event</span> Fecha inicio</label><input type="date" class="form-input" name="fecha_inicio[]"></div>
              <div class="form-group"><label class="form-label"><span class="material-icons">event_available</span> Fecha fin</label><input type="date" class="form-input" name="fecha_fin[]"></div>
              <div class="form-group full-width"><label class="form-label"><span class="material-icons">description</span> Descripción de tareas</label><textarea class="form-textarea" name="descripcion[]" placeholder="¿Qué hacías en este trabajo?"></textarea></div>
              <div class="form-group"><label class="form-label"><span class="material-icons">category</span> Tipo</label><select class="form-select" name="tipo[]"><option value="laboral">Laboral</option><option value="otro">Otro</option></select></div>
            </div>
            <button type="button" class="btn-remove" onclick="this.closest('.experience-item').remove(); updateProgress()"><span class="material-icons">delete</span><span>Eliminar</span></button>
          </div>
          <?php endif; ?>
        </div>
        <button type="button" class="btn-add" onclick="addExperienceFull()">
          <span class="material-icons">add_circle</span> Agregar otra experiencia
        </button>
      </div>

      <!-- EDUCACIÓN -->
      <div class="section-card" data-section="education">
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
            <span class="material-icons">workspace_premium</span> Títulos y certificaciones adicionales
            <span class="optional-badge">Opcional</span>
          </label>
          <div class="dynamic-list" id="titlesList">
            <?php if(!empty($titulos_form)): foreach($titulos_form as $t): ?>
              <div class="list-item">
                <input type="text" class="form-input" name="titulos[]" value="<?= htmlspecialchars($t, ENT_QUOTES, 'UTF-8') ?>">
                <button type="button" class="btn-remove-small" onclick="this.parentElement.remove(); updateProgress()"><span class="material-icons">close</span></button>
              </div>
            <?php endforeach; else: ?>
              <div class="list-item">
                <input type="text" class="form-input" name="titulos[]" placeholder="Ej: Certificado de Inglés B2 - Cambridge">
                <button type="button" class="btn-remove-small" onclick="this.parentElement.remove(); updateProgress()"><span class="material-icons">close</span></button>
              </div>
            <?php endif; ?>
          </div>
          <button type="button" class="btn-add-small" onclick="addTitle()">
            <span class="material-icons">add</span> Agregar otro título
          </button>
        </div>

        <div class="form-group">
          <label class="form-label">
            <span class="material-icons">emoji_events</span> Perfil del egresado
            <span class="optional-badge">Solo si egresaste</span>
          </label>
          <select class="form-select" name="perfil_egresado">
            <?php $pe = $formulario['perfil_egresado'] ?? ''; ?>
            <option value="" <?= $pe==''?'selected':''; ?>>Seleccioná tu especialidad</option>
            <option value="informatica" <?= $pe=='informatica'?'selected':''; ?>>Técnico en Informática</option>
            <option value="electronica" <?= $pe=='electronica'?'selected':''; ?>>Técnico en Electrónica</option>
            <option value="electromecanica" <?= $pe=='electromecanica'?'selected':''; ?>>Técnico en Electromecánica</option>
            <option value="otro" <?= $pe=='otro'?'selected':''; ?>>Otra especialidad</option>
          </select>
        </div>
      </div>

      <!-- EDUCACIÓN ADICIONAL -->
      <div class="section-card" data-section="extra-education">
        <div class="section-header">
          <div class="section-icon">
            <span class="material-icons">school</span>
          </div>
          <div class="section-title-group">
            <h2>Educación adicional</h2>
            <p>Cursos, talleres, formaciones externas</p>
          </div>
          <div class="section-badge optional">Opcional</div>
        </div>

        <div class="dynamic-list" id="extraEducationList">
          <?php if(!empty($educacion_adicional)): foreach($educacion_adicional as $edu): ?>
          <div class="education-item">
            <div class="form-grid">
              <div class="form-group full-width">
                <label class="form-label">
                  <span class="material-icons">account_balance</span> 
                    Institución
                </label>
                <input type="text" class="form-input" name="institucion[]" value="<?= htmlspecialchars($edu['institucion'] ?? '', ENT_QUOTES, 'UTF-8') ?>" placeholder="Nombre de la institución">
              </div>

              <div class="form-group full-width">
                <label class="form-label">
                  <span class="material-icons">auto_stories</span> 
                    Curso realizado
                </label>
                <input type="text" class="form-input" name="curso_realizado[]" value="<?= htmlspecialchars($edu['curso_realizado'] ?? '', ENT_QUOTES, 'UTF-8') ?>" placeholder="Nombre del curso o taller">
              </div>
              <div class="form-group">
                <label class="form-label">
                  <span class="material-icons">event</span>
                   Fecha inicio
                </label>
                <input type="date" class="form-input" name="edu_fecha_inicio[]" value="<?= htmlspecialchars($edu['fecha_inicio'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
              </div>
              <div class="form-group"><label class="form-label"><span class="material-icons">event_available</span> Fecha fin</label><input type="date" class="form-input" name="edu_fecha_fin[]" value="<?= htmlspecialchars($edu['fecha_fin'] ?? '', ENT_QUOTES, 'UTF-8') ?>"></div>
            </div>
            <button type="button" class="btn-remove" onclick="this.closest('.education-item').remove(); updateProgress()"><span class="material-icons">delete</span><span>Eliminar</span></button>
          </div>
          <?php endforeach; else: ?>
          <div class="education-item">
            <div class="form-grid">
              <div class="form-group full-width"><label class="form-label"><span class="material-icons">account_balance</span> Institución</label><input type="text" class="form-input" name="institucion[]" placeholder="Nombre de la institución"></div>
              <div class="form-group full-width"><label class="form-label"><span class="material-icons">auto_stories</span> Curso realizado</label><input type="text" class="form-input" name="curso_realizado[]" placeholder="Nombre del curso o taller"></div>
              <div class="form-group"><label class="form-label"><span class="material-icons">event</span> Fecha inicio</label><input type="date" class="form-input" name="edu_fecha_inicio[]"></div>
              <div class="form-group"><label class="form-label"><span class="material-icons">event_available</span> Fecha fin</label><input type="date" class="form-input" name="edu_fecha_fin[]"></div>
            </div>
            <button type="button" class="btn-remove" onclick="this.closest('.education-item').remove(); updateProgress()"><span class="material-icons">delete</span><span>Eliminar</span></button>
          </div>
          <?php endif; ?>
        </div>
        <button type="button" class="btn-add" onclick="addExtraEducation()">
          <span class="material-icons">add_circle</span> Agregar otra formación
        </button>
      </div>

      <!-- HABILIDADES -->
      <div class="section-card" data-section="skills">
        <div class="section-header">
          <div class="section-icon">
            <span class="material-icons">psychology</span>
          </div>
          <div class="section-title-group">
            <h2>Tus superpoderes</h2>
            <p>Contanos qué sabés hacer bien</p>
          </div>
        </div>

        <div class="skills-container">
          <div class="form-group">
            <label class="form-label">
              <span class="material-icons">code</span> Habilidades técnicas
            </label>
            <div class="dynamic-list" id="techSkillsList">
              <?php if(!empty($habilidades_tecnicas_form)): foreach($habilidades_tecnicas_form as $ht): ?>
              <div class="list-item"><input type="text" class="form-input" name="habilidades_tecnicas[]" value="<?= htmlspecialchars($ht, ENT_QUOTES, 'UTF-8') ?>"><button type="button" class="btn-remove-small" onclick="this.parentElement.remove(); updateProgress()"><span class="material-icons">close</span></button></div>
              <?php endforeach; else: ?>
              <div class="list-item"><input type="text" class="form-input" name="habilidades_tecnicas[]" placeholder="Ej: Python, JavaScript, HTML/CSS"><button type="button" class="btn-remove-small" onclick="this.parentElement.remove(); updateProgress()"><span class="material-icons">close</span></button></div>
              <?php endif; ?>
            </div>
            <button type="button" class="btn-add-small" onclick="addTechSkill()">
              <span class="material-icons">add</span> Agregar más
            </button>
          </div>

          <div class="form-group">
            <label class="form-label">
              <span class="material-icons">favorite</span> Habilidades personales
            </label>
            <div class="dynamic-list" id="softSkillsList">
              <?php if(!empty($habilidades_personales_form)): foreach($habilidades_personales_form as $hp): ?>
              <div class="list-item"><input type="text" class="form-input" name="habilidades_personales[]" value="<?= htmlspecialchars($hp, ENT_QUOTES, 'UTF-8') ?>"><button type="button" class="btn-remove-small" onclick="this.parentElement.remove(); updateProgress()"><span class="material-icons">close</span></button></div>
              <?php endforeach; else: ?>
              <div class="list-item"><input type="text" class="form-input" name="habilidades_personales[]" placeholder="Ej: Trabajo en equipo, Creatividad"><button type="button" class="btn-remove-small" onclick="this.parentElement.remove(); updateProgress()"><span class="material-icons">close</span></button></div>
              <?php endif; ?>
            </div>
            <button type="button" class="btn-add-small" onclick="addSoftSkill()">
              <span class="material-icons">add</span> Agregar más
            </button>
            <div class="form-hint">
              <span class="material-icons">tips_and_updates</span>
              <span>Pensá en lo que tus amigos o profes destacan de vos</span>
            </div>
          </div>

          <div class="form-group">
            <label class="form-label">
              <span class="material-icons">translate</span> Idiomas
            </label>
            <div class="dynamic-list" id="languagesList">
              <?php if(!empty($idiomas_form)): foreach($idiomas_form as $idi): ?>
              <div class="list-item"><input type="text" class="form-input" name="idiomas[]" value="<?= htmlspecialchars($idi, ENT_QUOTES, 'UTF-8') ?>"><button type="button" class="btn-remove-small" onclick="this.parentElement.remove(); updateProgress()"><span class="material-icons">close</span></button></div>
              <?php endforeach; else: ?>
              <div class="list-item"><input type="text" class="form-input" name="idiomas[]" placeholder="Ej: Inglés - Intermedio"><button type="button" class="btn-remove-small" onclick="this.parentElement.remove(); updateProgress()"><span class="material-icons">close</span></button></div>
              <?php endif; ?>
            </div>
            <button type="button" class="btn-add-small" onclick="addLanguage()">
              <span class="material-icons">add</span> Agregar idioma
            </button>
          </div>
        </div>
      </div>

      <!-- PROYECTOS -->
      <div class="section-card" data-section="projects">
        <div class="section-header">
          <div class="section-icon">
            <span class="material-icons">rocket_launch</span>
          </div>
          <div class="section-title-group">
            <h2>Tus proyectos</h2>
            <p>Mostrá en qué estuviste trabajando</p>
          </div>
          <div class="section-badge optional">Opcional</div>
        </div>

        <div class="form-group">
          <label class="form-label">
            <span class="material-icons">folder_special</span> Proyectos personales
          </label>
          <div class="dynamic-list" id="projectsList">
            <?php if(!empty($proyectos_form)): foreach($proyectos_form as $pr): ?>
            <div class="list-item"><input type="text" class="form-input" name="proyectos[]" value="<?= htmlspecialchars($pr, ENT_QUOTES, 'UTF-8') ?>"><button type="button" class="btn-remove-small" onclick="this.parentElement.remove(); updateProgress()"><span class="material-icons">close</span></button></div>
            <?php endforeach; else: ?>
            <div class="list-item"><input type="text" class="form-input" name="proyectos[]" placeholder="Ej: App móvil para organizar tareas - React Native"><button type="button" class="btn-remove-small" onclick="this.parentElement.remove(); updateProgress()"><span class="material-icons">close</span></button></div>
            <?php endif; ?>
          </div>
          <button type="button" class="btn-add-small" onclick="addProject()">
            <span class="material-icons">add</span> Agregar proyecto
          </button>
          <div class="form-hint">
            <span class="material-icons">auto_awesome</span>
            <span>Incluí proyectos escolares, personales o colaborativos</span>
          </div>
        </div>
      </div>

      <!-- PRÁCTICAS PROFESIONALES -->
      <div class="section-card" data-section="internships">
        <div class="section-header">
          <div class="section-icon">
            <span class="material-icons">school</span>
          </div>
          <div class="section-title-group">
            <h2>Prácticas profesionales</h2>
            <p>Agregá tus prácticas o pasantías realizadas</p>
          </div>
          <div class="section-badge optional">Opcional</div>
        </div>

        <div class="dynamic-list" id="internshipsList">
          <?php if(!empty($practicas)): foreach($practicas as $prac): ?>
          <div class="internship-item">
            <div class="form-grid">
              <div class="form-group full-width">
                <label class="form-label"><span class="material-icons">business</span> Empresa</label>
                <input type="text" class="form-input" name="practicas_empresa[]" value="<?= htmlspecialchars($prac['empresa'] ?? '', ENT_QUOTES, 'UTF-8') ?>" placeholder="Nombre de la empresa o institución">
              </div>
              <div class="form-group full-width">
                <label class="form-label"><span class="material-icons">work</span> Puesto</label>
                <input type="text" class="form-input" name="practicas_puesto[]" value="<?= htmlspecialchars($prac['puesto'] ?? '', ENT_QUOTES, 'UTF-8') ?>" placeholder="Tu rol o posición">
              </div>
              <div class="form-group">
                <label class="form-label"><span class="material-icons">event</span> Fecha inicio</label>
                <input type="date" class="form-input" name="practicas_fecha_inicio[]" value="<?= htmlspecialchars($prac['fecha_inicio'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
              </div>
              <div class="form-group">
                <label class="form-label"><span class="material-icons">event_available</span> Fecha fin</label>
                <input type="date" class="form-input" name="practicas_fecha_fin[]" value="<?= htmlspecialchars($prac['fecha_fin'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
              </div>
              <div class="form-group full-width">
                <label class="form-label"><span class="material-icons">description</span> Descripción de tareas</label>
                <textarea class="form-textarea" name="practicas_descripcion[]" placeholder="Qué tareas realizaste, proyectos en los que participaste, etc."><?= htmlspecialchars($prac['descripcion'] ?? '', ENT_QUOTES, 'UTF-8') ?></textarea>
              </div>
            </div>
            <button type="button" class="btn-remove" onclick="this.closest('.internship-item').remove(); updateProgress()"><span class="material-icons">delete</span><span>Eliminar</span></button>
          </div>
          <?php endforeach; else: ?>
          <div class="internship-item">
            <div class="form-grid">
              <div class="form-group full-width"><label class="form-label"><span class="material-icons">business</span> Empresa</label><input type="text" class="form-input" name="practicas_empresa[]" placeholder="Nombre de la empresa o institución"></div>
              <div class="form-group full-width"><label class="form-label"><span class="material-icons">work</span> Puesto</label><input type="text" class="form-input" name="practicas_puesto[]" placeholder="Tu rol o posición"></div>
              <div class="form-group"><label class="form-label"><span class="material-icons">event</span> Fecha inicio</label><input type="date" class="form-input" name="practicas_fecha_inicio[]"></div>
              <div class="form-group"><label class="form-label"><span class="material-icons">event_available</span> Fecha fin</label><input type="date" class="form-input" name="practicas_fecha_fin[]"></div>
              <div class="form-group full-width"><label class="form-label"><span class="material-icons">description</span> Descripción de tareas</label><textarea class="form-textarea" name="practicas_descripcion[]" placeholder="Qué tareas realizaste, proyectos en los que participaste, etc."></textarea></div>
            </div>
            <button type="button" class="btn-remove" onclick="this.closest('.internship-item').remove(); updateProgress()"><span class="material-icons">delete</span><span>Eliminar</span></button>
          </div>
          <?php endif; ?>
        </div>

        <button type="button" class="btn-add" onclick="addInternship()">
          <span class="material-icons">add_circle</span> Agregar otra práctica
        </button>
      </div>

      <!-- DISPONIBILIDAD -->
      <div class="section-card" data-section="availability">
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
            <span class="material-icons">calendar_today</span> Horarios disponibles
          </label>
          <textarea class="form-textarea" name="disponibilidad" placeholder="Ej: Lunes a viernes de 14 a 18hs..."><?= htmlspecialchars($formulario['disponibilidad'] ?? '', ENT_QUOTES, 'UTF-8') ?></textarea>
          <div class="form-hint">
            <span class="material-icons">info</span>
            <span>Mencioná si tenés otras actividades o estudios</span>
          </div>
        </div>

        <div class="form-group">
          <label class="form-label">
            <span class="material-icons">flight_takeoff</span> ¿Podés viajar por trabajo?
          </label>
          <div class="radio-group">
            <div class="radio-option">
              <input type="radio" id="travel-yes" name="disponibilidad_viaje" value="yes" <?= (isset($formulario['disponibilidad_viaje']) && $formulario['disponibilidad_viaje']==='yes') ? 'checked' : '' ?>>
              <label for="travel-yes" class="radio-label">
                <span class="material-icons">check_circle</span> Sí, sin problemas
              </label>
            </div>
            <div class="radio-option">
              <input type="radio" id="travel-sometimes" name="disponibilidad_viaje" value="sometimes" <?= (isset($formulario['disponibilidad_viaje']) && $formulario['disponibilidad_viaje']==='sometimes') ? 'checked' : '' ?>>
              <label for="travel-sometimes" class="radio-label">
                <span class="material-icons">help</span> A veces
              </label>
            </div>
            <div class="radio-option">
              <input type="radio" id="travel-no" name="disponibilidad_viaje" value="no" <?= (isset($formulario['disponibilidad_viaje']) && $formulario['disponibilidad_viaje']==='no') ? 'checked' : '' ?>>
              <label for="travel-no" class="radio-label">
                <span class="material-icons">cancel</span> Prefiero no viajar
              </label>
            </div>
          </div>
        </div>

        <div class="form-group">
          <label class="form-label">
            <span class="material-icons">work_outline</span> ¿Qué tipo de puesto buscás?
          </label>
          <input type="text" class="form-input" name="area_pretendida" placeholder="Ej: Desarrollador Junior, Soporte Técnico, Diseño Gráfico" value="<?= htmlspecialchars($formulario['area_pretendida'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
          <div class="form-hint">
            <span class="material-icons">explore</span>
            <span>Esto ayuda a que te encuentren las empresas correctas</span>
          </div>
        </div>
      </div>

      <!-- BOTONES DE ACCIÓN -->
      <div class="action-buttons">
        <button type="button" class="btn-secondary">
          <span class="material-icons">save</span>
          <span>Guardar borrador</span>
        </button>
        <button type="submit" class="btn-primary btn_guardar" id="submitBtn" name="btn_guardar">
          <span class="material-icons">check_circle</span>
          <span>Completar perfil</span>
        </button>
      </div>
    </form>
  </div>
</main>

<script src="views/assets/js/profile.js"></script>
</body>
</html>
