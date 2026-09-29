<?php
    $categoria_filtrada = 'rampas';
    $pagina_tipo = 'guia';
    $meta_title = "Best ramps for senior dogs: how to choose the right one — Tienda Texas";
    $meta_description = "We compare ramps for senior dogs: stability, weight capacity, price, and real ratings.";
    $canonical = "https://tiendatexasllc.com/en/rampas.php";
    
    require_once __DIR__ . '/../header.php';
    require_once __DIR__ . '/../config.php';
    $en_path = __DIR__ . '/../productos_en.json';
    $base_path = __DIR__ . '/../productos.json';
    
    if (!file_exists($base_path) || !file_exists($en_path)) {
        echo "<p class='contenedor-productos'>Error: The product file was not found.</p>";
        exit;
    }

    $base   = json_decode(file_get_contents($base_path), true);
    $en_raw = json_decode(file_get_contents($en_path), true);

    $en_by_asin = [];
    foreach ($en_raw as $e) {
        if (!empty($e['asin'])) { $en_by_asin[$e['asin']] = $e; }
    }

    $todos_los_productos = [];
    foreach ($base as $p) {
        $asin = $p['asin'] ?? null;
        if ($asin && isset($en_by_asin[$asin])) {
            $ov = $en_by_asin[$asin];
            foreach (['titulo','subtitulo','descripcion_corta','resena_larga','pros','contras','capacidad','estrellas'] as $k) {
                if (isset($ov[$k . '_en'])) { $p[$k] = $ov[$k . '_en']; }
            }
        }
        // Normaliza rutas de imagen a absolutas (el JSON las trae relativas)
        if (!empty($p['imagenes'])) {
            $p['imagenes'] = array_map(function($u) { return '/' . ltrim($u, '/'); }, (array)$p['imagenes']);
        }
        $todos_los_productos[] = $p;
    }

    $productos_filtrados = array_filter($todos_los_productos, function($p) use ($categoria_filtrada) {
        return isset($p['categoria']) && $p['categoria'] === $categoria_filtrada;
    });
?>

<div class="article-head"
    style="background-image:linear-gradient(rgba(250,247,242,0.82), rgba(250,247,242,0.92)), url('https://images.unsplash.com/photo-1587300003388-59208cc962cb?fm=jpg&q=80&w=1400&auto=format&fit=crop'); background-size:cover; background-position:center;">
    <div class="wrap-article">
        <span class="kicker">Mobility</span>
        <h1><?php echo htmlspecialchars($meta_title); ?></h1>
        <p class="meta">Buyer's Guide · Updated 2026 · 8 min read</p>
    </div>
</div>

<div class="guide-banner">
    <img src="/publicos/images/rampas/rampas_p1.webp" alt="Senior dog on steps">
</div>

<article>
    <div class="wrap-article">

        <p>If your senior dog has started hesitating before jumping on the couch, or you notice it pausing a couple of
            seconds longer in front of the car steps, it's probably telling you in its own way: its joints don't respond
            like they used to. A well-chosen ramp isn't a luxury — it's a direct way to reduce wear on its hips and
            knees every time it climbs up or down from a high place.</p>

        <p>The problem is that not every ramp works for every dog. A ramp that's too steep can intimidate a dog with
            joint pain, and one that's too long may not fit in your car or your home. Here I explain what to look at
            before buying, so you don't end up with a ramp your dog simply refuses to use.</p>

        <p>We updated this list after reviewing each product's review history: we replaced a poorly backed option with a
            more established brand. The first 3 models are designed for small and medium dogs, the fourth is premium,
            and the fifth is for large breeds.</p>

        <main class="contenedor-productos">

            <?php if (empty($productos_filtrados)): ?>
            <p style="text-align: center; color: #666; margin-top: 40px;">We'll be adding our detailed analyses to this
                section soon. Stay tuned!</p>
            <?php else: ?>

            <?php foreach ($productos_filtrados as $indice => $prod): $enlace_afiliado = obtener_enlace_amazon($prod['asin']);
    $foto_inicial = !empty($prod['imagenes']) ? $prod['imagenes'][0] : '/publicos/images/rampas/default.jpg';
    $id_visor_unico = "visor-" . $indice;
    ?>

            <article class="producto-card">
                <div class="galeria-amazon">
                    <div class="miniaturas-col">
                        <?php if (isset($prod['imagenes']) && count($prod['imagenes']) > 1): ?>
                        <?php foreach ($prod['imagenes'] as $sub_indice => $img_url): ?>
                        <img src="<?php echo htmlspecialchars($img_url); ?>"
                            class="miniatura-img <?php echo $sub_indice === 0 ? 'activa' : ''; ?>"
                            alt="Product view thumbnail"
                            onclick="cambiarImagenGaleria(this, '<?php echo $id_visor_unico; ?>')">
                        <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                    <div class="imagen-con-caption">
                        <div class="imagen-principal-box">
                            <h5>Illustrative photo</h5>
                            <img id="<?php echo $id_visor_unico; ?>"
                                src="<?php echo htmlspecialchars($foto_inicial); ?>"
                                alt="<?php echo htmlspecialchars($prod['titulo']); ?>" loading="lazy">
                        </div>
                    </div>
                </div>

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
                    <strong>Our analysis:</strong> <?php echo htmlspecialchars($prod['descripcion_corta']); ?>
                </p>

                <?php if (!empty($prod['resena_larga'])): ?>
                <p class="resena-texto"><?php echo htmlspecialchars($prod['resena_larga']); ?></p>
                <?php endif; ?>

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

                <a href="<?php echo $enlace_afiliado; ?>" class="btn-ver-amazon" target="_blank"
                    rel="noopener nofollow">
                    See price on Amazon →
                </a>
            </article>
            <?php endforeach; ?>
            <?php endif; ?>
        </main>
        <script src="/publicos/js/galeria.js"></script>

        <p class="pick-note">Note: Aodisman, EHEYCIGA, and Ahpmeoa are designed for small and medium dogs. PetSafe
            CozyUp is the premium option with the most recognized brand, and Fecuria is the only one on this list
            designed for large breeds.</p>

        <h2>How to help your dog get used to the ramp</h2>

        <p>Even if you buy the perfect ramp, many senior dogs need an adjustment period. Place it at a low angle first,
            use treats to encourage it to walk on it without weight (with the ramp resting on the floor), and only then
            practice with the real incline. Forcing a scared dog to use it from day one usually backfires: it will
            reject it completely.</p>

        <h2>Does your dog really need a ramp?</h2>

        <p>Not all senior dogs need one right away, but these signs usually indicate it's time:</p>

        <ul>
            <li>Visibly hesitates before getting on or off the couch, bed, or car</li>
            <li>Has been diagnosed with hip dysplasia, arthritis, or spine problems</li>
            <li>Is a large or long-backed breed (like a Basset Hound or Dachshund), prone to jumping injuries</li>
            <li>Recently recovered from surgery and needs to avoid impact</li>
        </ul>

        <h2>The 5 factors that really matter</h2>

        <h3>1. Weight capacity</h3>

        <p>This is the most common mistake: buying a ramp thinking only about the dog's size, without checking the
            maximum weight it supports. Always look for a margin of at least 20-30% above your dog's actual weight,
            because dynamic weight while walking creates more pressure than static weight.</p>

        <h3>2. Incline angle</h3>

        <p>The flatter the angle, the less effort your dog makes — but the longer (and less practical) the ramp is. For
            dogs with advanced arthritis or serious spine problems, a gentle angle matters more than saving space.</p>

        <h3>3. Non-slip surface</h3>

        <p>A senior dog that slips once on the ramp will probably never trust it again. Look for carpet- or
            rubber-textured surfaces, not smooth plastic — especially if you'll use it outdoors where it can get wet.
        </p>

        <h3>4. Foldable and portable, if you'll move it around</h3>

        <p>If you plan to use it for the car and at home, the ramp's weight and how easily it folds matter as much as
            the price. A 20 lb ramp that doesn't fold well becomes just another piece of furniture, not a tool you
            actually use every day.</p>

        <h3>5. Stability at the ends</h3>

        <p>The best models have raised edges on the sides and a base that doesn't shift when stepped on. This is key for
            dogs with reduced vision, which is very common in the senior stage.</p>

        <div class="callout">
            <b>Practical tip:</b> before buying, measure the exact height of where you'll use the ramp (couch, bed, car
            trunk). Most returns happen because the ramp turned out too short or too steep for that specific space.
        </div>

        <h2>Quick reference table</h2>

        <table>
            <tr>
                <th>Your dog's situation</th>
                <th>What to prioritize</th>
            </tr>
            <tr>
                <td>Advanced arthritis or joint pain</td>
                <td>Flattest angle possible</td>
            </tr>
            <tr>
                <td>Large breed (55+ lb)</td>
                <td>High weight capacity + wide base</td>
            </tr>
            <tr>
                <td>Car/travel use</td>
                <td>Lightweight and foldable</td>
            </tr>
            <tr>
                <td>Outdoor or wet-area use</td>
                <td>Rubber-type non-slip surface</td>
            </tr>
            <tr>
                <td>Dog with reduced vision</td>
                <td>Raised side edges</td>
            </tr>
        </table>

    </div>
</article>

<?php require_once __DIR__ . '/../footer.php'; ?>