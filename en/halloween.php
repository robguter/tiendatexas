<?php
    $categoria_filtrada = 'halloween';
    $pagina_tipo = 'guia';
    $meta_title = "Halloween with your senior dog: comfortable costumes and night safety — Tienda Texas";
    $meta_description = "Halloween guide for older dogs: comfortable costumes that don't bother their joints, LED collar for night walks, and how to calm October 31st anxiety.";
    $canonical = "https://tiendatexasllc.com/en/halloween.php";

    require_once __DIR__ . '/../header.php';
    require_once __DIR__ . '/../config.php';
    $json_path = __DIR__ . '/../productos_en.json';

    if (!file_exists($json_path)) {
        echo "<p class='contenedor-productos'>Error: The product file was not found.</p>";
        exit;
    }

    $json_data = file_get_contents($json_path);
    $todos_los_productos = json_decode($json_data, true);

    $productos_filtrados = array_filter($todos_los_productos, function($p) use ($categoria_filtrada) {
        return isset($p['categoria']) && $p['categoria'] === $categoria_filtrada;
    });
?>

<div class="article-head"
    style="background-image:linear-gradient(rgba(250,247,242,0.82), rgba(250,247,242,0.92)), url('/publicos/images/halloween/halloween_01.webp'); background-size:cover; background-position:center;">
    <div class="wrap-article">
        <span class="kicker">Halloween Special 🎃</span>
        <h1><?php echo htmlspecialchars($meta_title); ?></h1>
        <p class="meta">Seasonal Guide · Updated October 2026 · 6 min read</p>
    </div>
</div>

<div class="guide-banner">
    <img src="/publicos/images/halloween/halloween_p1.webp" alt="Dog in a pumpkin costume for Halloween">
</div>

<article>
    <div class="wrap-article">

        <p>Halloween can be a fun night with your senior dog — as long as you adapt it to their age. An older dog
            doesn't tolerate an uncomfortable costume, crowded night walks, or the doorbell ringing every five minutes
            the same way. The good news: with three simple decisions (a comfortable costume, nighttime visibility, and
            an anti-anxiety plan), October 31st goes from a stressful night to just another one on the calendar.</p>

        <p>This guide is designed specifically for older dogs: every recommendation prioritizes comfort, mobility, and
            calm over the funny photo.</p>

        <p>These are our verified picks for the season, with real prices and reviews.</p>

        <main class="contenedor-productos">

            <?php if (empty($productos_filtrados)): ?>
            <p style="text-align: center; color: #666; margin-top: 40px;">We'll be adding our detailed analyses to this
                section soon. Stay tuned!</p>
            <?php else: ?>

            <?php foreach ($productos_filtrados as $indice => $prod): $enlace_afiliado = obtener_enlace_amazon($prod['asin']);
// Use the first image in the list as the default initial photo
$foto_inicial = !empty($prod['imagenes']) ? $prod['imagenes'][0] : '/publicos/images/halloween/halloween_p1.webp';
$id_visor_unico = "visor-" . $indice;
?>
            <!-- MODERN PRODUCT CARD -->
            <article class="producto-card">
                <!-- AMAZON-STYLE GALLERY -->
                <div class="galeria-amazon">
                    <!-- Side thumbnails (only drawn if there is more than 1 image) -->
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
                    <!-- Main container and image -->
                    <div class="imagen-con-caption">
                        <div class="imagen-principal-box">
                            <h5>Illustrative photo</h5>
                            <img id="<?php echo $id_visor_unico; ?>"
                                src="<?php echo htmlspecialchars($foto_inicial); ?>"
                                alt="<?php echo htmlspecialchars($prod['titulo']); ?>" loading="lazy">
                        </div>
                    </div>
                </div>

                <!-- HEADING AND INFO -->
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

                <!-- PROS AND CONS TABLE -->
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

                <!-- EYE-CATCHING BUTTON WITH YOUR TIENDATEXASLL-20 LINK -->
                <a href="<?php echo $enlace_afiliado; ?>" class="btn-ver-amazon" target="_blank"
                    rel="noopener nofollow">
                    See price on Amazon →
                </a>
            </article>
            <?php endforeach; ?>
            <?php endif; ?>
        </main>
        <script src="/publicos/js/galeria.js"></script>

        <h2>Costumes for senior dogs: comfort comes first</h2>

        <p>An older dog has less patience for discomfort — and real physical reasons: stiff joints, more sensitive skin,
            and lower heat tolerance. Before buying, apply these rules:</p>

        <ul>
            <li><b>Velcro over sleeves:</b> avoid costumes where you have to push their legs through narrow openings.
                With arthritis, forcing a leg can genuinely hurt.</li>
            <li><b>Face clear:</b> nothing covering eyes, snout, or ears. A senior dog that can't see well gets much
                more stressed.</li>
            <li><b>Trial run:</b> put it on a few days before, for short periods and with treats. If after 10 minutes
                they're still uncomfortable, that costume isn't for them.</li>
            <li><b>Short photo session:</b> the funny photo takes 5 minutes; the costume doesn't have to last all night.
            </li>
        </ul>

        <div class="callout">
            <b>Important:</b> if your dog shows signs of stress (excessive panting, repeated yawning, trying to take the
            costume off, hiding), take it off without insisting. No photo is worth a night of anxiety.
        </div>

        <h2>October 31st night: visibility and smart walks</h2>

        <p>October 31st gets dark like always, but the streets have more distracted pedestrians, running kids, and cars
            stopping constantly. For a senior dog, who already walks slower and reacts later:</p>

        <ul>
            <li><b>Early walk:</b> go out before the heavy "trick or treat" traffic starts. Fewer people, fewer scares.
            </li>
            <li><b>LED collar:</b> make sure drivers see you, and don't lose sight of your dog if they get startled and
                wander a few yards.</li>
            <li><b>Short leash:</b> that night is not for retractable leashes. Keep control close to the road.</li>
        </ul>

        <h2>The doorbell, other people's costumes, and anxiety</h2>

        <p>For many senior dogs, the worst part of Halloween isn't their costume: it's the doorbell ringing every five
            minutes and strangers in weird costumes at the door. A simple plan:</p>

        <ul>
            <li><b>Quiet zone:</b> set up a room away from the door with their bed, water, and some background noise (TV
                or soft music).</li>
            <li><b>Calming treats:</b> chews with calming ingredients work better if started a few days before, not just
                that night.</li>
            <li><b>Hand out candy yourself outside:</b> if you can, greet trick-or-treaters from the porch or yard and
                leave your dog inside, calm.</li>
        </ul>

        <h2>Dangerous candy: what to keep out of reach</h2>

        <p>This applies to all dogs, but in a senior the consequences can be more serious:</p>

        <ul>
            <li><b>Chocolate:</b> toxic to dogs; dark and baking chocolate are the most dangerous.</li>
            <li><b>Xylitol (birch sugar):</b> found in gum and "sugar-free" candy. Extremely toxic even in small
                amounts.</li>
            <li><b>Raisins and grapes:</b> some treats include them; they can cause kidney damage.</li>
        </ul>

        <p>Keep the candy bag up high and closed. If you suspect they ate any of this, call your vet or a pet poison
            emergency line immediately — don't wait for symptoms.</p>

        <p class="pick-note">Note: this is a seasonal guide we update every October with current prices and
            availability. Amazon prices may vary.</p>

        <div class="callout">
            <b>Important:</b> this content is informational and does not replace your veterinarian's advice. If your dog
            has a health condition, check before using costumes or calming supplements.
        </div>

    </div>
</article>

<?php require_once __DIR__ . '/../footer.php'; ?>