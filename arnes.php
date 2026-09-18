<?php
  $categoria_filtrada = 'arnes'; 
  // 1. Configuras el SEO específico para este artículo antes de llamar al header
  $meta_title = "Arnés de soporte trasero para perros senior: guía práctica — Tienda Texas";
  $meta_description = "Cómo elegir un arnés de soporte trasero para perros senior con debilidad en las patas traseras: tipos, tallas y cuándo usarlo.";
  $canonical = "https://tiendatexasllc.com/arnes.php";
  
  $pagina_tipo = 'guia'; // Activa el CSS de productos en el header
  require_once 'header.php';
  require_once 'config.php'; 

  // 1. Leer el archivo JSON unificado
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


<div class="article-head" style="background-image:linear-gradient(rgba(250,247,242,0.82), rgba(250,247,242,0.92)), url('https://images.unsplash.com/photo-1621291235186-58f624ea79f8?fm=jpg&q=80&w=1400&auto=format&fit=crop'); background-size:cover; background-position:center;">
  <div class="wrap-article">
    <span class="kicker">Movilidad</span>
    <h1>Arnés de soporte trasero para perros senior (mayor): cómo elegir el correcto</h1>
    <p class="meta">Guía de compra · Actualizado 2026 · 7 min de lectura</p>
  </div>
</div>

<div class="guide-banner">
  <img src="publicos/images/arnes/arnes_p10.webp" alt="Perro con arnés">
</div>

<article>
  <div class="wrap-article">

    <p>Si tu perro senior (mayor) empieza a tambalearse al levantarse, arrastra las patas traseras al caminar, o necesita ayuda para subir al auto, un arnés de soporte trasero (también llamado "lift harness") puede ser justo la herramienta que le falta — sin llegar todavía a una silla de ruedas.</p>

    <p>El problema es que "arnés de soporte" es una categoría amplia con productos muy distintos entre sí. Comprar el tipo equivocado no ayuda en nada: un arnés trasero no sirve de nada si la debilidad de tu perro está en las patas delanteras, y viceversa.</p>

    
    <p>Estas opciones cubren distintos niveles de soporte y presupuesto, verificadas con precio y reseñas reales.</p>
    

    
    
    <main class="contenedor-productos">
      
      <?php if (empty($productos_filtrados)): ?>
          <p style="text-align: center; color: #666; margin-top: 40px;">Próximamente añadiremos nuestros análisis detallados para esta sección. ¡Mantente atento!</p>
      <?php else: ?>
      <?php foreach ($productos_filtrados as $indice => $prod): 
          $enlace_afiliado = obtener_enlace_amazon($prod['asin']); 
          // Usamos la primera imagen de la lista como foto inicial por defecto
          $foto_inicial = !empty($prod['imagenes']) ? $prod['imagenes'][0] : 'publicos/images/arnes/default.jpg';
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



    <h2>Primero: identifica dónde está la debilidad</h2>
    <p>Este es el paso que determina todo lo demás:</p>
    <ul>
      <li><b>Arnés de soporte trasero (rear lift):</b> para debilidad en caderas, rodillas o patas traseras — el caso más común en perros senior, generalmente por displasia de cadera o artritis.</li>
      <li><b>Arnés de soporte delantero (front support):</b> para problemas de hombros o codos — menos común, pero existe.</li>
      <li><b>Arnés de cuerpo completo:</b> para perros con debilidad generalizada en las cuatro patas, o razas grandes que necesitan soporte en ambos extremos.</li>
    </ul>
    <p>Si no estás seguro de cuál necesita tu perro, obsérvalo de cerca al levantarse y caminar durante unos días, y si tienes dudas, pregúntale a tu veterinario antes de comprar — es la única forma de acertar a la primera.</p>

    <div class="callout">
      <b>Importante:</b> un arnés de soporte ayuda con la movilidad, pero no trata la causa de la debilidad. Si tu perro está perdiendo movilidad de forma progresiva, eso debe evaluarlo un veterinario — el arnés es la herramienta para el día a día mientras se maneja la causa real.
    </div>

    <h2>Cuándo usarlo (y cuándo no es suficiente)</h2>
    <p>Un arnés de soporte trasero funciona bien para:</p>
    <ul>
      <li>Ayudar a tu perro a levantarse desde el piso</li>
      <li>Dar estabilidad en escaleras o al subir/bajar del auto</li>
      <li>Apoyo temporal durante recuperación post-quirúrgica</li>
      <li>Paseos cortos donde tu perro necesita un poco de ayuda, no cargarlo por completo</li>
    </ul>
    <p>Si tu perro ya no puede sostener su propio peso en las patas traseras en absoluto, un arnés no va a ser suficiente — en ese punto la conversación con tu veterinario probablemente sea sobre una silla de ruedas para perros, no sobre un arnés.</p>

    <h2>Cómo elegir la talla correcta</h2>
    <p>Un arnés mal ajustado puede lastimar en vez de ayudar. Mide a tu perro antes de comprar:</p>
    <ul>
      <li><b>Contorno de pecho:</b> alrededor de la parte más ancha del pecho, justo detrás de las patas delanteras</li>
      <li><b>Contorno abdominal/cadera:</b> justo delante de las patas traseras, para los modelos de soporte trasero</li>
      <li><b>Peso actual:</b> úsalo como verificación cruzada contra la tabla de tallas del fabricante, no como único dato</li>
    </ul>
    <p>Como regla general: el arnés debe quedar ajustado pero no apretado — debes poder pasar dos dedos por debajo de cualquier correa sin esfuerzo.</p>

    <h2>Qué buscar en el diseño</h2>

    <h3>1. Correas anchas y acolchadas</h3>
    <p>Correas delgadas concentran presión en un área pequeña, lo cual puede lastimar la piel con el uso repetido. Busca correas anchas con relleno, especialmente en la zona de las asas de agarre.</p>

    <h3>2. Puntos de ajuste múltiples</h3>
    <p>Más puntos de ajuste (algunos modelos tienen hasta 10) significan un ajuste más personalizado — importante porque cada perro tiene proporciones distintas, no solo tamaño.</p>

    <h3>3. Que tu perro pueda hacer sus necesidades sin quitárselo</h3>
    <p>Si planeas que tu perro use el arnés varias horas al día, verifica que el diseño no bloquee el área necesaria para orinar o defecar — algunos diseños mal pensados sí lo hacen, y terminarás quitándolo y poniéndolo constantemente.</p>

    <h3>4. Funda o forro lavable</h3>
    <p>Al ser una prenda que probablemente use a diario, la posibilidad de limpiarlo fácilmente importa más de lo que parece al principio.</p>


    <p class="pick-note">Nota: recuerda que estos son arneses de soporte trasero/cuerpo completo, distintos entre sí en estructura. Mide a tu perro antes de comprar y revisa la tabla de tallas de cada fabricante — el ajuste correcto importa más que la marca específica.</p>

    <div class="callout">
      <b>Importante:</b> este contenido es informativo, no reemplaza el consejo de un veterinario. La elección del tipo correcto de arnés depende del diagnóstico específico de tu perro.
    </div>

  </div>
</article>

<?php require_once 'footer.php'; ?>

</body>
</html>
