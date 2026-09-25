<?php
  $categoria_filtrada = 'halloween';
  $meta_title = "Halloween con tu perro senior: disfraces cómodos y seguridad nocturna — Tienda Texas";
  $meta_description = "Guía de Halloween para perros mayores: disfraces cómodos que no molestan articulaciones, collar LED para paseos nocturnos y cómo calmar la ansiedad del 31 de octubre.";
  $canonical = "https://tiendatexasllc.com/halloween.php";

  $pagina_tipo = 'guia';
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


<div class="article-head" style="background-image:linear-gradient(rgba(250,247,242,0.82), rgba(250,247,242,0.92)), url('publicos/images/halloween/halloween_01.webp'); background-size:cover; background-position:center;">
  <div class="wrap-article">
    <span class="kicker">Especial Halloween 🎃</span>
    <h1>Halloween con tu perro senior: disfraces cómodos y seguridad nocturna</h1>
    <p class="meta">Guía estacional · Actualizado octubre 2026 · 6 min de lectura</p>
  </div>
</div>

<div class="guide-banner">
  <img src="publicos/images/halloween/halloween_p1.webp" alt="Perro con disfraz de calabaza para Halloween">
</div>

<article>
  <div class="wrap-article">

    <p>Halloween puede ser una noche divertida con tu perro senior — siempre que la adaptes a su edad. Un perro mayor no tolera igual un disfraz incómodo, los paseos nocturnos entre multitudes ni el timbre sonando cada cinco minutos. La buena noticia: con tres decisiones simples (disfraz cómodo, visibilidad nocturna y un plan contra la ansiedad) el 31 de octubre pasa de ser una noche estresante a una más del calendario.</p>

    <p>Esta guía está pensada específicamente para perros mayores: cada recomendación prioriza comodidad, movilidad y calma por encima de la foto graciosa.</p>

    <p>Estas son nuestras selecciones verificadas para la temporada, con precio y reseñas reales.</p>




    <main class="contenedor-productos">

      <?php if (empty($productos_filtrados)): ?>
          <p style="text-align: center; color: #666; margin-top: 40px;">Próximamente añadiremos nuestros análisis detallados para esta sección. ¡Mantente atento!</p>
      <?php else: ?>
      <?php foreach ($productos_filtrados as $indice => $prod):
          $enlace_afiliado = obtener_enlace_amazon($prod['asin']);
          // Usamos la primera imagen de la lista como foto inicial por defecto
          $foto_inicial = !empty($prod['imagenes']) ? $prod['imagenes'][0] : 'publicos/images/halloween/halloween_p1.webp';
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

            <!-- ENCABEDADO E INFORMACIÓN -->
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



    <h2>Disfraces para perros senior: la comodidad va primero</h2>
    <p>Un perro mayor tiene menos paciencia para la incomodidad — y razones físicas reales: articulaciones rígidas, piel más sensible y menor tolerancia al calor. Antes de comprar, aplica estas reglas:</p>
    <ul>
      <li><b>Velcro antes que mangas:</b> evita disfraces donde haya que meter las patas por aberturas estrechas. Con artritis, forzar una pata puede doler de verdad.</li>
      <li><b>Cara despejada:</b> nada que cubra ojos, hocico u orejas. Un perro senior que no ve bien se estresa mucho más.</li>
      <li><b>Prueba previa:</b> pónselo unos días antes, por ratos cortos y con premios. Si a los 10 minutos sigue incómodo, ese disfraz no es para él.</li>
      <li><b>Sesión corta de fotos:</b> la foto graciosa dura 5 minutos; el disfraz no tiene por qué durar toda la noche.</li>
    </ul>

    <div class="callout">
      <b>Importante:</b> si tu perro muestra señales de estrés (jadeo excesivo, bostezo repetido, intentar quitarse el disfraz, esconderse), quítaselo sin insistir. Ninguna foto vale una noche de ansiedad.
    </div>

    <h2>La noche del 31: visibilidad y paseos inteligentes</h2>
    <p>El 31 de octubre oscurece igual que siempre, pero las calles tienen más peatones distraídos, niños corriendo y autos parando a cada rato. Para un perro senior, que ya camina más lento y reacciona más tarde:</p>
    <ul>
      <li><b>Paseo temprano:</b> sal antes de que empiece el movimiento fuerte de "trick or treat". Menos gente, menos sustos.</li>
      <li><b>Collar LED:</b> que te vean los conductores y no pierdas de vista a tu perro si se asusta y se aleja unos metros.</li>
      <li><b>Correa corta:</b> esa noche no es para correa extensible. Mantén el control cerca de la calzada.</li>
    </ul>

    <h2>El timbre, los disfraces ajenos y la ansiedad</h2>
    <p>Para muchos perros senior, lo peor de Halloween no es su disfraz: es el timbre sonando cada cinco minutos y gente con disfraces extraños en la puerta. Un plan simple:</p>
    <ul>
      <li><b>Zona tranquila:</b> prepara una habitación alejada de la puerta con su cama, agua y algo de ruido de fondo (TV o música suave).</li>
      <li><b>Premios calmantes:</b> los masticables con ingredientes calmantes funcionan mejor si se empiezan unos días antes, no solo esa noche.</li>
      <li><b>Reparte tú los dulces afuera:</b> si puedes, atiende la puerta desde el porche o el jardín y deja a tu perro adentro, tranquilo.</li>
    </ul>

    <h2>Dulces peligrosos: qué mantener lejos de su alcance</h2>
    <p>Esto aplica a todos los perros, pero en un senior las consecuencias pueden ser más graves:</p>
    <ul>
      <li><b>Chocolate:</b> tóxico para perros; el chocolate oscuro y el de repostería son los más peligrosos.</li>
      <li><b>Xilitol (abedul azucarado):</b> presente en chicles y dulces "sin azúcar". Extremadamente tóxico incluso en pequeñas cantidades.</li>
      <li><b>Pasas y uvas:</b> algunas golosinas las incluyen; pueden causar daño renal.</li>
    </ul>
    <p>Guarda la bolsa de dulces en un lugar alto y cerrado. Si sospechas que comió algo de esto, llama a tu veterinario o a una línea de emergencias toxicológicas de inmediato — no esperes a ver síntomas.</p>

    <p class="pick-note">Nota: esta es una guía estacional que actualizamos cada octubre con precios y disponibilidad vigentes. Los precios de Amazon pueden variar.</p>

    <div class="callout">
      <b>Importante:</b> este contenido es informativo, no reemplaza el consejo de un veterinario. Si tu perro tiene una condición de salud, consulta antes de usar disfraces o suplementos calmantes.
    </div>

  </div>
</article>

<?php require_once 'footer.php'; ?>