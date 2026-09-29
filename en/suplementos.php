<?php
    $categoria_filtrada = 'suplementos';
    $pagina_tipo = 'guia';
    $meta_title = "Glucosamine and Chondroitin for Senior Dogs: Dosage and Trusted Brands — Tienda Texas";
    $meta_description = "How much glucosamine and chondroitin does your senior dog need? Dosage by weight, what the evidence says, and how to choose a trusted brand on Amazon.";
    $canonical = "https://tiendatexasllc.com/en/suplementos.php";
    
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
    style="background-image:linear-gradient(rgba(250,247,242,0.82), rgba(250,247,242,0.92)), url('https://images.unsplash.com/photo-1651777229439-beef9fda852f?fm=jpg&q=80&w=1400&auto=format&fit=crop'); background-size:cover; background-position:center;">
    <div class="wrap-article">
        <span class="kicker">Supplements</span>
        <h1><?php echo htmlspecialchars($meta_title); ?></h1>
        <p class="meta">Buyer's Guide · Updated 2026 · 8 min read</p>
    </div>
</div>

<div class="guide-banner">
    <img src="/publicos/images/suplementos/suplementos_p10.webp" alt="Senior dog active outdoors">
</div>

<article>
    <div class="wrap-article">

        <p>If you've ever searched for "joint supplement for dogs," you've probably seen dozens of products promising
            near-miraculous results. The reality is more nuanced, and we believe you deserve to know it before spending
            your money: the scientific evidence on glucosamine and chondroitin in dogs is <b>mixed</b>, not unanimous.
            Some studies show real improvement; others find no difference versus a placebo.</p>

        <p>That doesn't mean it's not worth trying — it means it's worth understanding what to actually expect, and how
            to tell whether it's working for your specific dog, instead of assuming a jar with the word "joints" on the
            label will fix everything.</p>

        <p>These products meet our criteria: exact dose stated in mg, NASC certification, and strong backing from real
            reviews. We've ordered them by track record (number of reviews), from highest to lowest.</p>

        <main class="contenedor-productos">

            <?php if (empty($productos_filtrados)): ?>
            <p style="text-align: center; color: #666; margin-top: 40px;">We'll be adding our detailed analyses to this
                section soon. Stay tuned!</p>
            <?php else: ?>

            <?php foreach ($productos_filtrados as $indice => $prod): $enlace_afiliado = obtener_enlace_amazon($prod['asin']);
$foto_inicial = !empty($prod['imagenes']) ? $prod['imagenes'][0] : '/publicos/images/suplementos/default.jpg';
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

        <h2>What the scientific evidence says</h2>

        <p>Several clinical trials in dogs with osteoarthritis have tested glucosamine and chondroitin combinations.
            Results are not consistent across studies:</p>

        <ul>
            <li><b>In favor:</b> one published trial showed statistically significant improvements in pain, weight
                bearing, and condition severity after 70 days of treatment, compared with placebo.</li>
            <li><b>Against:</b> another controlled trial with 23 dogs found no measurable improvement versus placebo,
                using objective gait force measurements.</li>
            <li><b>Important context:</b> a systematic review of animal studies concluded the evidence remains
                "controversial" — some dogs respond well, others show no change at all.</li>
        </ul>

        <div class="callout">
            <b>What this means in practice:</b> despite the mixed evidence, veterinarians still frequently recommend
            these supplements, mainly because the risk profile is very low (few side effects, usually just mild
            indigestion) compared with long-term anti-inflammatories. It's a low-risk bet, not a guarantee.
        </div>

        <h2>How long should you wait to see results?</h2>

        <p>This is a point almost no seller mentions: in the studies where improvement did occur, the effect took
            between <b>42 and 70 days</b> to become noticeable — this is not a fast-acting supplement like a painkiller.
            If you give your dog the supplement for two weeks and see no change, it's still too early to conclude it
            doesn't work.</p>

        <h2>What to look for when choosing a product</h2>

        <h3>1. Real dose, not just ingredient presence</h3>

        <p>Many budget products include glucosamine and chondroitin in amounts so low they're unlikely to have any real
            clinical effect. As a general reference (always check with your vet for the exact dose for your dog's
            weight), look for products that clearly state milligrams per serving — not just that they "contain" the
            ingredient.</p>

        <h3>2. A delivery format your dog will actually take</h3>

        <p>The best supplement in the world is useless if your dog spits out the pill every time. They come as powder
            (mixes into food), flavored chews, and liquid. If you already know your dog is difficult with pills,
            prioritize chews or powder from the start instead of fighting the wrong format.</p>

        <h3>3. Quality certification</h3>

        <p>Unlike medications, supplements aren't as tightly regulated. Look for seals like NASC (National Animal
            Supplement Council) when available — it's a sign the manufacturer follows good manufacturing practices,
            though it doesn't guarantee clinical efficacy.</p>

        <h3>4. Additional ingredients with their own evidence</h3>

        <p>Some products combine glucosamine/chondroitin with MSM (methylsulfonylmethane) or omega-3 fatty acids.
            Omega-3s in particular have somewhat more consistent evidence for reducing joint inflammation, so a product
            that includes them may offer added value beyond glucosamine alone.</p>

        <h2>Signs it IS working</h2>

        <p>After at least 6–8 weeks of consistent use, watch for:</p>

        <ul>
            <li>Less stiffness when getting up after sleeping</li>
            <li>More willingness to climb stairs or jump (within reason for their age)</li>
            <li>Less frequent or less pronounced limping during walks</li>
        </ul>

        <p>If after 2–3 months you see no change at all, it's reasonable to assume this particular supplement isn't
            having an effect on your dog — worth discussing with your vet before continuing to buy it out of habit.</p>

        <p class="pick-note">Note: the chondroitin in Vet's Best Advanced (50mg) is notably lower than in Cosequin
            (300mg) or PetNC (100mg). If chondroitin is your main priority, Cosequin or PetNC are better options.</p>

        <div class="callout">
            <b>Important:</b> this content is informational and does not replace your veterinarian's advice. Before
            starting any new supplement, especially if your dog takes other medications, check with your vet for the
            right dose for their weight and specific condition.
        </div>

    </div>
</article>

<?php require_once __DIR__ . '/../footer.php'; ?>