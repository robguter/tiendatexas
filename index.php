<?php
  $meta_title = "Tienda Texas — Guías Especializadas para Perros Senior";
  $meta_description = "Comparativas honestas de productos para perros mayores. Analizamos las mejores rampas de movilidad, camas ortopédicas y suplementos avalados por veterinarios.";
  $canonical = "https://tiendatexasllc.com";

  // --- Suscripción al boletín: guarda el correo y avisa al administrador ---
  $aviso_boletin = "";
  $lead_registrado = false;
  if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["boletin_email"])) {
      $email = filter_var(trim($_POST["boletin_email"]), FILTER_SANITIZE_EMAIL);
      if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
          $guardado = false;
          $dir_privado = __DIR__ . "/privado";
          $archivo = $dir_privado . "/suscriptores.csv";
          if (!is_dir($dir_privado)) { @mkdir($dir_privado, 0755, true); }
          $fp = @fopen($archivo, "a");
          if ($fp) {
              if (!file_exists($archivo) || filesize($archivo) === 0) { fputcsv($fp, ["fecha", "email"]); }
              fputcsv($fp, [date("Y-m-d H:i:s"), $email]);
              fclose($fp);
              $guardado = true;
          }
          // Aviso al administrador (mismo patrón que contacto.php)
          @mail("admin@tiendatexasllc.com",
              "Nueva suscripción al boletín — Tienda Texas",
              "Se ha suscrito al boletín: $email\nFecha: " . date("Y-m-d H:i:s"),
              "From: web@tiendatexasllc.com\r\nX-Mailer: PHP/" . phpversion());
          if ($guardado) {
              $lead_registrado = true;
              $aviso_boletin = "¡Listo! Te avisaremos por correo cuando publiquemos nuevas guías.";
          } else {
              $aviso_boletin = "Tu correo es válido, pero no pudimos guardarlo. Escríbenos a admin@tiendatexasllc.com.";
          }
      } else {
          $aviso_boletin = "Ese correo no parece válido. Revísalo e inténtalo de nuevo.";
      }
  }

  require_once 'header.php';
  
?>
    <section class="hero">
      <div class="wrap hero-grid">
        <div>
          <span class="eyebrow">Cuidado Avanzado de Perros Mayores</span>
          <h1>Que los años se noten <em>menos</em> en sus patas y articulaciones.</h1>
          <p class="lead">Bienvenido a <strong>Tienda Texas</strong>. Creamos guías de compra honestas y análisis detallados para dueños de perros senior. Evaluamos colchones ortopédicos de alta densidad, suplementos articulares efectivos, arneses de elevación y rampas de movilidad para que la vejez de tu compañero sea digna, cómoda y segura.</p>
          <div class="cta-row">
            <a href="#guias" class="btn btn-primary">Ver guías de compra</a>
            <a href="#por-que" class="btn btn-ghost">¿Por qué confiar en nosotros?</a>
          </div>
        </div>
        
        <!-- Cronología de Edad Senior -->
        <div class="timeline-card">
          <span class="tag">¿Cuándo se considera senior a un perro?</span>
          <div class="timeline">
            <div class="timeline-item">
              <div class="age">Razas Pequeñas (Hasta 10 kg)</div>
              <div class="note">Etapa senior a partir de los 10 u 11 años.</div>
            </div>
            <div class="timeline-item">
              <div class="age">Razas Medianas (11 a 25 kg)</div>
              <div class="note">Etapa senior a partir de los 8 o 9 años.</div>
            </div>
            <div class="timeline-item">
              <div class="age">Razas Grandes y Gigantes (Más de 26 kg)</div>
              <div class="note">Etapa senior a partir de los 6 o 7 años.</div>
            </div>
          </div>
        </div>
        
      </div>
    </section>

    <div class="trust">
      <div class="wrap">
        <span>🛡️ Análisis basados en especificaciones técnicas de marcas oficiales</span>
        <span>📦 Enlaces de afiliación verificados y seguros hacia Amazon</span>
        <span>🔄 Catálogo actualizado con rangos de precios reales en 2026</span>
      </div>
    </div>

    <section class="section" id="guias">
      <div class="wrap">
        <div class="section-head">
            <h2>Guías más buscadas</h2>
            <p>Comparativas reales, no listas genéricas copiadas de otro sitio.</p>
        </div>
        <div class="guides">

          <div class="guide-card">
            <div class="guide-thumb">
              <img src="publicos/images/inicio/alfombras_p1.webp" alt="Guía de alfombras">
            </div>
            <div class="body">
              <span class="kicker">Seguridad en casa</span>
              <h3>Alfombras antideslizantes: guía práctica</h3>
              <p>Dónde colocarlas y qué buscar para evitar resbalones en pisos duros.</p>
              <a href="alfombras.php" class="readmore">Leer guía →</a>
            </div>
          </div>

          <div class="guide-card">
            <div class="guide-thumb">
              <img src="publicos/images/inicio/arnes_p1.webp" alt="Guía de arneses">
            </div>
            <div class="body">
              <span class="kicker">Movilidad</span>
              <h3>Arnés de soporte trasero: cómo elegir el correcto</h3>
              <p>Rear lift, delantero o cuerpo completo: cuál necesita tu perro y por qué.</p>
              <a href="arnes.php" class="readmore">Leer guía →</a>
            </div>
          </div>

          <div class="guide-card">
            <div class="guide-thumb">
              <img src="publicos/images/inicio/camas_p1.webp" alt="Guía de camas">
            </div>
            <div class="body">
              <span class="kicker">Descanso Ergonómico</span>
              <h3>Camas ortopédicas: cuáles valen la pena</h3>
              <p>Qué densidad de espuma viscoelástica (Memory Foam) buscar según el peso y los signos de displasia de cadera.</p>
              <a href="camas.php" class="readmore">Leer análisis detallado →</a>
            </div>
          </div>

          <div class="guide-card">
            <div class="guide-thumb">
              <img src="publicos/images/inicio/rampas_p1.webp" alt="Guía de rampas">
            </div>
            <div class="body">
              <span class="kicker">Movilidad Senior</span>
              <h3>Las mejores rampas para perros mayores</h3>
              <p>Comparamos la estabilidad, el peso máximo soportado y el ángulo de inclinación en modelos telescópicos y de espuma pura.</p>
              <a href="rampas.php" class="readmore">Leer análisis detallado →</a>
            </div>
          </div>

          <div class="guide-card">
            <div class="guide-thumb">
              <img src="publicos/images/inicio/suplementos_p1.webp" alt="Guía de suplementos">
            </div>
            <div class="body">
              <span class="kicker">Suplementos</span>
              <h3>Glucosamina y condroitina: guía sin humo</h3>
              <p>Qué dice la evidencia, y cómo elegir una marca confiable en Amazon.</p>
              <a href="suplementos.php" class="readmore">Leer guía →</a>
            </div>
          </div>

          <div class="guide-card">
            <div class="guide-thumb">
              <img src="publicos/images/inicio/halloween_p1.webp" alt="Guía de Halloween para perros senior">
            </div>
            <div class="body">
              <span class="kicker">Especial Halloween 🎃</span>
              <h3>Halloween con tu perro senior: guía de temporada</h3>
              <p>Disfraces cómodos, seguridad nocturna y cómo calmar la ansiedad del 31 de octubre.</p>
              <a href="halloween.php" class="readmore">Leer guía →</a>
            </div>
          </div>
          
        </div>
      </div>
    </section>

    <section class="section" id="por-que" style="background:var(--cream-2);">
      <div class="wrap split">
        <div>
          <h2>No somos otro blog genérico de mascotas</h2>
          <p style="margin-top:16px; color:rgba(30,42,56,0.75); max-width:48ch;">
            Nos enfocamos solo en perros senior porque sus necesidades son distintas: movilidad reducida, articulaciones sensibles, cambios de apetito. Cada recomendación parte de eso, no de "los 10 productos más vendidos para perros" sin contexto.
          </p>
          <div class="stat-row">
            <div class="stat"><span>Como dueños de perros senior, entendemos de primera mano los cambios que trae la edad, productos probados y comparados</span></div>
          </div>
        </div>
        <div class="timeline-card" style="background:#fff; padding:0; overflow:hidden;">
          <img src="https://images.unsplash.com/photo-1608469926865-b2d2200bb2f6?fm=jpg&q=80&w=800&auto=format&fit=crop" alt="Perro senior descansando en casa" style="width:100%; height:180px; object-fit:cover; display:block;">
          <div style="padding:26px 24px;">
            <span class="tag">Señales de que tu perro ya es senior</span>
            <ul style="margin:14px 0 0; padding-left:18px; color:rgba(30,42,56,0.75); font-size:0.94rem; line-height:1.9;">
              <li>Le cuesta más subir escaleras o al sofá</li>
              <li>Duerme más horas de lo habitual</li>
              <li>Menos entusiasmo en los paseos</li>
              <li>Cambios visibles de pelaje o peso</li>
            </ul>
          </div>
        </div>
      </div>
    </section>

    <section class="cta-band" id="newsletter">
      <div class="wrap">
        <div>
          <h2>Recibe las nuevas guías en tu correo</h2>
          <p>Cada guía que publiquemos y las mejores ofertas para perros senior. Sin spam, date de baja cuando quieras.</p>
        </div>
        <form class="newsletter-form" action="index.php#newsletter" method="POST">
          <input type="email" name="boletin_email" placeholder="tu@correo.com" required aria-label="Correo electrónico">
          <button type="submit" class="btn-primary">Suscribirme</button>
        </form>
      </div>
      <?php if ($aviso_boletin): ?>
      <div class="wrap">
        <p class="newsletter-aviso"><?php echo htmlspecialchars($aviso_boletin); ?></p>
      </div>
      <?php endif; ?>
      <?php if ($lead_registrado): ?>
      <script>fbq('track', 'Lead');</script>
      <?php endif; ?>
    </section>

    <div class="disclosure">
      <div class="wrap">
        Declaración de Transparencia:</strong> En calidad de Afiliado de Amazon, Tienda Texas LLC percibe ingresos por las compras adscritas que cumplen los requisitos aplicables. Al hacer clic en los botones de "Ver precio en Amazon", serás redirigido a la plataforma oficial para completar tu compra. Esto no incrementa el costo del producto para ti y nos ayuda a mantener nuestro portal financiado, libre de anuncios invasivos y con análisis 100% independientes.
      </div>
    </div>

    <?php require_once 'footer.php'; ?>

  </body>
</html>