<?php
  $categoria_filtrada = 'alfombras'; 
  // 1. Configuras el SEO específico para este artículo antes de llamar al header
  $meta_title = "Alfombras antideslizantes para perros senior: guía práctica — Tienda Texas";
  $meta_description = "Cómo elegir alfombras y tapetes antideslizantes para perros senior en pisos de madera o cerámica resbalosos.";
  $canonical = "https://tiendatexasllc.com/alfombras.php";
  
  $pagina_tipo = 'guia'; // Activa el CSS de productos en el header
  require_once 'header.php';
  require_once 'config.php'; 
  
  $json_path = 'productos.json';
  if (!file_exists($json_path)) {
      echo "<p class='contenedor-productos'>Error: No se encontró el archivo de productos.</p>";
      exit;
  }

  $json_data = file_get_contents($json_path);
  $todos_los_productos = json_decode($json_data, true);
  
  $productos_filtrados = array_filter($todos_los_productos, function($p) use ($categoria_filtrada) {
      return isset($p['categoria']) && $p['categoria'] === $categoria_filtrada;
  });
?>

<div class="article-head" style="background-image:linear-gradient(rgba(250,247,242,0.82), rgba(250,247,242,0.92)), url('https://images.unsplash.com/photo-1679108797373-4f0b8253d9bf?fm=jpg&q=80&w=1400&auto=format&fit=crop'); background-size:cover; background-position:center;">
  <div class="wrap-article">
    <span class="kicker">Seguridad en casa</span>
    <h1>Alfombras antideslizantes para perros senior (mayor): guía práctica</h1>
    <p class="meta">Guía de compra · Actualizado 2026 · 6 min de lectura</p>
  </div>
</div>

<div class="guide-banner">
  <img src="publicos/images/alfombras/alfombras_p1.webp" alt="Perro sobre alfombra en casa">
</div>

<article>
  <div class="wrap-article">

    <p>Los pisos de madera, cerámica o laminado son hermosos para nosotros, pero para un perro senior (mayor) con menos masa muscular y peor propiocepción (el sentido de dónde están sus propias patas), pueden ser una fuente constante de resbalones — cada uno de los cuales pone estrés extra en articulaciones ya sensibles.</p>

    <p>La buena noticia es que esta es una de las soluciones más económicas de toda esta serie de guías. La mala noticia, que preferimos decirte de una vez: las alfombras solas no son una solución perfecta, y aquí te explicamos por qué, junto con cómo sacarles el mejor provecho.</p>

    
    <p>Ambas opciones confirman respaldo de goma real (no solo textura decorativa) y son lavables, cumpliendo los dos criterios técnicos más importantes de esta guía.</p>

    
    
    <main class="contenedor-productos">
      <?php if (empty($productos_filtrados)): ?>
          <p style="text-align: center; color: #666; margin-top: 40px;">Próximamente añadiremos nuestros análisis detallados para esta sección. ¡Mantente atento!</p>
      <?php else: ?>
      <?php foreach ($productos_filtrados as $indice => $prod): 
          $enlace_afiliado = obtener_enlace_amazon($prod['asin']); 
          // Usamos la primera imagen de la lista como foto inicial por defecto
          $foto_inicial = !empty($prod['imagenes']) ? $prod['imagenes'][0] : 'publicos/images/alfombras/default.jpg';
          $id_visor_unico = "visor-" . $indice;
      ?>
        <!-- TARJETA DE PRODUCTO MODERNA -->
        <article class="producto-card">
            
            <!-- GALERÍA ESTILO AMAZON -->
            <div class="galeria-amazon">
                <!-- Miniaturas laterales (Solo se dibujan si hay más de 1 imagen) -->
                <div class="miniaturas-col">
                    <?php if (isset($prod['imagenes']) && count($prod['imagenes']) > 1): ?>
                        <?php foreach ($prod['imagenes'] as $sub_indice => $img_url): ?>
                            <img src="<?php echo htmlspecialchars($img_url); ?>" 
                                  class="miniatura-img <?php echo $sub_indice === 0 ? 'activa' : ''; ?>" 
                                  alt="Miniatura de vista del producto"
                                  onclick="cambiarImagenGaleria(this, '<?php echo $id_visor_unico; ?>')">
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
                
                <!-- Contenedor e Imagen Principal -->
                <div class="imagen-con-caption">
                    <div class="imagen-principal-box">
                        <img id="<?php echo $id_visor_unico; ?>" 
                            src="<?php echo htmlspecialchars($foto_inicial); ?>" 
                            alt="<?php echo htmlspecialchars($prod['titulo']); ?>" 
                            loading="lazy">
                    </div>
                    <a href="<?php echo $enlace_afiliado; ?>" class="foto-caption" target="_blank" rel="noopener nofollow">
                        Foto ilustrativa — Ver foto real en Amazon →
                    </a>
                </div>

            </div>

            <!-- ENCABEZADO E INFORMACIÓN -->
            <div class="producto-encabezado">
                <h3 class="producto-titulo"><?php echo htmlspecialchars($prod['titulo']); ?></h3>
                <?php if (!empty($prod['subtitulo'])): ?>
                    <span class="badge-marca"><?php echo htmlspecialchars($prod['subtitulo']); ?></span>
                <?php endif; ?>
            </div>

            <div class="meta-info">
                <span class="meta-precio"><?php echo htmlspecialchars($prod['precio']); ?></span>
                <span class="meta-resenas"><?php echo htmlspecialchars($prod['estrellas']); ?></span>
                <?php if (!empty($prod['capacidad'])): ?>
                    <span class="meta-capacidad"><?php echo htmlspecialchars($prod['capacidad']); ?></span>
                <?php endif; ?>
            </div>

            <p class="resena-texto">
                <strong>Nuestro análisis:</strong> <?php echo htmlspecialchars($prod['descripcion_corta']); ?>
            </p>
            
            <?php if (!empty($prod['resena_larga'])): ?>
                <p class="resena-texto"><?php echo htmlspecialchars($prod['resena_larga']); ?></p>
            <?php endif; ?>

            <!-- TABLA DE PROS Y CONTRAS -->
            <?php if (!empty($prod['pros']) || !empty($prod['contras'])): ?>
                <div class="tabla-pros-contras">
                    <ul class="col-pros">
                        <?php foreach (($prod['pros'] ?? []) as $pro): ?>
                            <li><?php echo htmlspecialchars($pro); ?></li>
                        <?php endforeach; ?>
                    </ul>
                    <ul class="col-contras">
                        <?php foreach (($prod['contras'] ?? []) as $contra): ?>
                            <li><?php echo htmlspecialchars($contra); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <!-- BOTÓN LLAMATIVO CON TU ENLACE TIENDATEXASLL-20 -->
            <a href="<?php echo $enlace_afiliado; ?>" class="btn-ver-amazon" target="_blank" rel="noopener nofollow">
                Ver precio en Amazon →
            </a>
        </article>
        <?php endforeach; ?>
        <?php endif; ?>
      </main>

      <script src="publicos/js/galeria.js"></script>


    <h2>La limitación honesta de las alfombras</h2>
    <p>Las alfombras y tapetes son estacionarios — cubren un área fija, pero tu perro se mueve por toda la casa. Es común que un perro camine fuera del área cubierta y resbale de todas formas en el tramo sin alfombra. Por eso, la estrategia más efectiva casi nunca es "una alfombra grande en la sala", sino cubrir las **rutas específicas** que tu perro usa con más frecuencia.</p>

    <div class="callout">
      <b>Estrategia real que funciona mejor:</b> en vez de una sola alfombra grande, coloca tapetes o corredores estratégicamente en las rutas que tu perro recorre más — desde su cama hasta la puerta, desde el comedero hasta su lugar de descanso, y en la base de cualquier escalón o rampa.
    </div>

    <h2>¿Dónde priorizar?</h2>
    <ul>
      <li>La ruta desde donde duerme hasta la puerta de salida (especialmente si tiene incontinencia y necesita salir rápido)</li>
      <li>Alrededor de sus platos de comida y agua</li>
      <li>En la base de rampas o escaleras que uses</li>
      <li>Cualquier esquina donde el perro tenga que girar — los giros son donde más resbalones ocurren</li>
    </ul>

    <h2>Qué buscar al elegir</h2>

    <h3>1. Respaldo de goma real, no solo textura arriba</h3>
    <p>El agarre real viene del respaldo de la alfombra contra el piso, no de la textura de la superficie donde camina el perro. Busca específicamente "rubber backing" o "non-slip backing" en la descripción — una alfombra decorativa sin este respaldo se desliza igual que el piso desnudo.</p>

    <h3>2. Que se pueda lavar</h3>
    <p>Va a acumular pelo, tierra de las patas, y posiblemente accidentes si tu perro tiene incontinencia. Prioriza opciones lavables a máquina sobre las que solo se pueden aspirar.</p>

    <h3>3. Corredores largos para pasillos, tapetes para zonas puntuales</h3>
    <p>Para rutas largas (pasillos), los corredores tipo "runner" cubren más terreno por menos dinero que varias alfombras pequeñas. Para zonas específicas (frente a la cama, junto al plato de comida), un tapete individual es suficiente.</p>

    <h2>Cuándo combinar con otra solución</h2>
    <p>Si después de poner alfombras tu perro sigue resbalando notablemente, existen soluciones complementarias que atacan el problema desde otro ángulo: recortar el pelo entre las almohadillas de las patas (el pelo largo ahí reduce tracción), o productos como grips/calcetines antideslizantes que van directo en las patas del perro, en vez de depender de cubrir todo el piso. Ninguna solución es mutuamente excluyente — muchos dueños combinan alfombras en zonas clave con grips para el resto de la casa.</p>


    <p class="pick-note">Nota: recuerda la estrategia real que funciona mejor — coloca estos corredores en las rutas específicas que tu perro usa más (de su cama a la puerta, en la base de rampas), en vez de cubrir toda la casa con una sola alfombra grande.</p>

  </div>
</article>

<?php require_once 'footer.php'; ?>

</body>
</html>
