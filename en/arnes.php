<?php
    $categoria_filtrada = 'arnes';
    $pagina_tipo = 'guia';
    $meta_title = "Rear support harness for senior dogs: practical guide — Tienda Texas";
    $meta_description = "How to choose a rear support harness for senior dogs with hind leg weakness: types, sizes and when to use it.";
    $canonical = "https://tiendatexasllc.com/arnes.php";
    
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
    style="background-image:linear-gradient(rgba(250,247,242,0.82), rgba(250,247,242,0.92)), url('https://images.unsplash.com/photo-1621291235186-58f624ea79f8?fm=jpg&q=80&w=1400&auto=format&fit=crop'); background-size:cover; background-position:center;">
    <div class="wrap-article">
        <span class="kicker">Mobility 🐕</span>
        <h1>Rear support harness for senior dogs: how to choose the right one</h1>
        <p class="meta">Buyer's Guide · Updated 2026 · 7 min read</p>
    </div>
</div>

<div class="guide-banner">
    <img src="/publicos/images/arnes/arnes_p10.webp" alt="Dog with harness">
</div>

<article>
    <div class="wrap-article">

        <p>If your senior dog starts to wobble when getting up, drags its hind legs when walking, or needs help getting
            into the car, a rear support harness (also called a "lift harness") may be just the tool it needs — without
            quite reaching the point of a wheelchair.</p>

        <p>The problem is that "support harness" is a broad category with very different products. Buying the wrong type
            won't help at all: a rear harness is useless if your dog's weakness is in their front legs, and vice versa.
        </p>


        <p>These options cover different levels of support and budget, verified with real price and reviews.</p>




        <main class="contenedor-productos">

            <?php if (empty($productos_filtrados)): ?>
            <p style="text-align: center; color: #666; margin-top: 40px;">We'll be adding our detailed analyses to this
                section soon. Stay tuned!</p>
            <?php else: ?>
            <?php foreach ($productos_filtrados as $indice => $prod): 
          $enlace_afiliado = obtener_enlace_amazon($prod['asin']); 
          
          $foto_inicial = !empty($prod['imagenes']) ? $prod['imagenes'][0] : '/publicos/images/arnes/default.jpg';
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
                            <h5>Foto ilustrativa</h5>
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



        <h2>First: identify where the weakness is</h2>
        <p>This is the step that determines everything else:</p>
        <ul>
            <li><b>Rear lift harness:</b> for weakness in hips, knees or hind legs — the most common case in senior
                dogs, usually due to hip dysplasia or arthritis.</li>
            <li><b>Front support harness:</b> for shoulder or elbow problems — less common, but it exists.</li>
            <li><b>Full body harness:</b> for dogs with generalized weakness in all four legs, or large breeds that need
                support at both ends.</li>
        </ul>
        <p>If you're unsure which one your dog needs, observe him closely as it gets up and walks for a few days, and if
            you have any doubts, ask your vet before buying—it's the only way to get it right the first time.</p>

        <div class="callout">
            <b>Important:</b> A support harness helps with mobility, but it doesn't treat the underlying cause of
            weakness. If your dog is progressively losing mobility, this needs to be evaluated by a veterinarian—the
            harness is a tool for day-to-day support while the real cause is being addressed.
        </div>

        <h2>When to use it (and when it's not enough)</h2>
        <p>A back support harness works well for:</p>
        <ul>
            <li>Help your dog get up from the floor</li>
            <li>To provide stability on stairs or when getting in/out of the car</li>
            <li>Temporary support during post-surgical recovery</li>
            <li>Short walks where your dog needs a little help, don't carry him completely</li>
        </ul>
        <p>If your dog can no longer support its own weight on its hind legs at all, a harness isn't going to cut it —
            at that point, the conversation with your vet is probably about a dog wheelchair, not a harness.</p>

        <h2>How to choose the right size</h2>
        <p>A poorly fitted harness can cause harm instead of helping. Measure your dog before buying:</p>
        <ul>
            <li><b>Chest circumference:</b> around the widest part of the chest, just behind the front legs.</li>
            <li><b>Abdominal/hip circumference:</b> Just in front of the hind legs, for rear-support models</li>
            <li><b>Current weight:</b> Use this as a cross-check against the manufacturer's size chart, not as the sole
                data point</li>
        </ul>
        <p>As a general rule: the harness should fit snugly but not tightly — you should be able to pass two fingers
            under any strap without effort.</p>

        <h2>What to look for in design</h2>

        <h3>1. Wide, padded straps</h3>
        <p>Thin straps concentrate pressure on a small area, which can irritate the skin with repeated use. Look for
            wide straps with padding, especially in the handle area.</p>

        <h3>2. Multiple adjustment points</h3>
        <p>More adjustment points (some models have up to 10) mean a more customized fit — important because every dog
            ​​has different proportions, not just size.</p>

        <h3>3. That your dog can relieve himself without having to take it away</h3>
        <p>If you plan for your dog to wear the harness for several hours a day, check that the design doesn't block the
            area needed to urinate or defecate—some poorly designed harnesses do, and you'll end up constantly taking it
            off and putting it back on.</p>

        <h3>4. Washable cover or lining</h3>
        <p>Since it's a garment that you'll probably wear every day, the ability to clean it easily matters more than it
            might seem at first.</p>


        <p class="pick-note">Note: Remember that these are full-body/back support harnesses, which vary in structure.
            Measure your dog before purchasing and check each manufacturer's size chart—the correct fit matters more
            than the specific brand.</p>

        <div class="callout">
            <b>Important:</b> This content is for informational purposes only and does not replace the advice of a
            veterinarian. Choosing the right type of harness depends on your dog's specific diagnosis.
        </div>

    </div>
</article>

<?php require_once __DIR__ . '/../footer.php'; ?>