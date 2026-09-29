<?php
    $categoria_filtrada = 'camas';
    $pagina_tipo = 'guia';
    $meta_title = "Best orthopedic bed for senior dogs and hip dysplasia — Tienda Texas";
    $meta_description = "We compare the best orthopedic beds for senior dogs, including hip dysplasia: what foam density to look for and when it's worth paying more.";
    $canonical = "https://tiendatexasllc.com/en/camas.php";
    
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
    style="background-image:linear-gradient(rgba(250,247,242,0.82), rgba(250,247,242,0.92)), url('https://images.unsplash.com/photo-1642303009699-7d7fd6d4a243?fm=jpg&q=80&w=1400&auto=format&fit=crop'); background-size:cover; background-position:center;">
    <div class="wrap-article">
        <span class="kicker">Rest</span>
        <h1>Orthopedic beds for senior dogs: which ones are the best</h1>
        <p class="meta">Buyer's Guide · Updated 2026 · 7 min read</p>
    </div>
</div>

<div class="guide-banner">
    <img src="/publicos/images/camas/camas_p1.webp" alt="Dog resting on a pet bed">
</div>

<article>
    <div class="wrap-article">

        <p>A senior dog can spend between 16 and 20 hours a day resting. That means the bed it sleeps on isn't just
            another accessory: it's probably the object that touches its body the longest, every single day. And yet,
            it's one of the last things most owners think about when adjusting for their dog's old age.</p>

        <p>The difference between just any bed and a real orthopedic bed isn't in the marketing — it's in the foam
            density and how it distributes body weight. Here I explain what to look for so you don't overpay for an
            "orthopedic" bed that really isn't one.</p>

        <main class="contenedor-productos">

            <?php if (empty($productos_filtrados)): ?>
            <p style="text-align: center; color: #666; margin-top: 40px;">We'll be adding our detailed analyses to this
                section soon. Stay tuned!</p>
            <?php else: ?>

            <?php foreach ($productos_filtrados as $indice => $prod): $enlace_afiliado = obtener_enlace_amazon($prod['asin']);
$foto_inicial = !empty($prod['imagenes']) ? $prod['imagenes'][0] : '/publicos/images/camas/default.jpg';
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

        <h2>Why does it matter so much for senior dogs?</h2>

        <p>With age, dogs lose muscle mass and protective fat over bones and joints. A bed that's too soft or thin lets
            hips, elbows, and shoulders press straight through the filling against the floor, creating pressure points
            that can lead to calluses and even worsen existing joint pain, like that caused by hip dysplasia or
            arthritis.</p>

        <h2>The 4 factors that separate a real bed from one that only looks like it</h2>

        <h3>1. High-density memory foam, not regular foam</h3>

        <p>Here's the most common marketing trick: many beds say "orthopedic" just because they use soft foam, not
            because they use real high-density memory foam (ideally 4-5 lb/ft³ or more). Regular foam compresses quickly
            and loses support within months; high-density foam keeps its shape for years.</p>

        <h3>2. Minimum 4-inch thickness for medium and large dogs</h3>

        <p>A thin layer of foam over a flat base doesn't offer real support. For medium and large breeds, look for at
            least 4 inches of foam; for small breeds, 2-3 inches is usually enough.</p>

        <h3>3. Removable, washable cover</h3>

        <p>Senior dogs are more prone to accidents (incontinence, vomiting, etc.). A zippered cover you can remove and
            machine-wash isn't a luxury — it's practically mandatory to keep the bed hygienic long-term.</p>

        <h3>4. Non-slip base</h3>

        <p>A dog with reduced mobility that pushes with its paws to get comfortable can end up sliding the bed all over
            the floor if it doesn't have a non-slip rubber base. This is especially important on wood or ceramic floors.
        </p>

        <div class="callout">
            <b>Red flag:</b> if a bed is advertised as "orthopedic" but doesn't mention foam density anywhere in the
            description, that's a red flag. Brands that do use quality foam almost always highlight it as a selling
            point.
        </div>

        <h2>What size should you choose?</h2>

        <table>
            <tr>
                <th>Situation</th>
                <th>Recommendation</th>
            </tr>
            <tr>
                <td>Dog that sleeps fully stretched out</td>
                <td>Bed 3-4 inches longer than its stretched-out body</td>
            </tr>
            <tr>
                <td>Dog with arthritis or hip dysplasia</td>
                <td>Higher-density memory foam — priority over size</td>
            </tr>
            <tr>
                <td>Small spaces or apartments</td>
                <td>Low-sided models, easier to fit in corners</td>
            </tr>
            <tr>
                <td>Dogs that scratch before lying down</td>
                <td>Reinforced, snag-resistant cover</td>
            </tr>
        </table>

        <div class="callout">
            <b>Something we discovered researching this:</b> in the $30-50 range, practically the entire market uses
            "egg-crate" foam, not solid memory foam. Real solid memory foam — the kind that gives the best support for
            advanced arthritis — usually starts above $200. It's not that the budget options are bad — they work well
            for most cases — but if your dog has severe joint pain, like that from diagnosed hip dysplasia, the price
            jump is worth considering.
        </div>

        <p class="pick-note">Note: the first 3 (budget) options cover most cases of healthy senior dogs or those with
            mild discomfort well. The 2 premium options make sense when the dog has a diagnosis of moderate to severe
            arthritis or dysplasia, where foam quality makes a real, lasting difference.</p>

        <h2>A detail almost nobody mentions: placement</h2>

        <p>Even the best orthopedic bed loses effectiveness if it's in a cold draft or far from where your dog spends
            the rest of its time. Senior dogs regulate body temperature worse, so placing the bed in a warm area of the
            house, away from doors or windows, complements the physical support the bed itself gives.</p>

    </div>
</article>

<?php require_once __DIR__ . '/../footer.php'; ?>