<?php
    $meta_title = "Tienda Texas — Specialized Guides for Senior Dogs";
    $meta_description = "Honest product comparisons for senior dogs. We review the best mobility ramps, orthopedic beds, and vet-approved joint supplements.";
    $canonical = "https://tiendatexasllc.com/en";

    $aviso_boletin = "";
    $lead_registrado = false;
    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["boletin_email"])) {
        $email = filter_var(trim($_POST["boletin_email"]), FILTER_SANITIZE_EMAIL);
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $guardado = false;
            $dir_privado = __DIR__ . "/../privado"; // English form reuses the protected Spanish dir (has .htaccess denying web access)
            $archivo = $dir_privado . "/suscriptores.csv";
            if (!is_dir($dir_privado)) { @mkdir($dir_privado, 0755, true); }
            $fp = @fopen($archivo, "a");
            if ($fp) {
                if (!file_exists($archivo) || filesize($archivo) === 0) { fputcsv($fp, ["fecha", "email"]); }
                fputcsv($fp, [date("Y-m-d H:i:s"), $email]);
                fclose($fp);
                $guardado = true;
            }
            @mail("admin@tiendatexasllc.com",
            "New newsletter subscription — Tienda Texas",
            "New newsletter subscriber: $email\nDate: " . date("Y-m-d H:i:s"),
            "From: web@tiendatexasllc.com\r\nX-Mailer: PHP/" . phpversion());
            if ($guardado) {
                $lead_registrado = true;
                $aviso_boletin = "Done! We'll email you when we publish new guides.";
            } else {
                $aviso_boletin = "Your email is valid, but we couldn't save it. Write to us at admin@tiendatexasllc.com.";
            }
        } else {
            $aviso_boletin = "That email doesn't look valid. Please check it and try again.";
        }
    }
    require_once __DIR__ . '/../header.php';

?>
<section class="hero">
    <div class="wrap hero-grid">
        <div>
            <span class="eyebrow">Advanced Senior Dog Care</span>
            <h1>Make the years show <em>less</em> on their paws and joints.</h1>
            <p class="lead">Welcome to <strong>Tienda Texas</strong>. We create honest buying guides and in-depth
                reviews for senior dog owners. We evaluate high-density orthopedic mattresses, effective joint
                supplements, lifting harnesses, and mobility ramps so your companion's golden years are dignified,
                comfortable, and safe.</p>
            <div class="cta-row">
                <a href="#guias" class="btn btn-primary">See buying guides</a>
                <a href="#por-que" class="btn btn-ghost">Why trust us?</a>
            </div>
        </div>
        <div class="timeline-card">
            <span class="tag">When is a dog considered senior?</span>
            <div class="timeline">
                <div class="timeline-item">
                    <div class="age">Small Breeds (Up to 22 lbs)</div>
                    <div class="note">Senior stage starting at 10 or 11 years.</div>
                </div>
                <div class="timeline-item">
                    <div class="age">Medium Breeds (24 to 55 lbs)</div>
                    <div class="note">Senior stage starting at 8 or 9 years.</div>
                </div>
                <div class="timeline-item">
                    <div class="age">Large and Giant Breeds (Over 57 lbs)</div>
                    <div class="note">Senior stage starting at 6 or 7 years.</div>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="trust">
    <div class="wrap">
        <span>🛡️ Reviews based on official brands' technical specs</span>
        <span>📦 Verified, secure affiliate links to Amazon</span>
        <span>🔄 Catalog updated with real 2026 price ranges</span>
    </div>
</div>
<section class="section" id="guias">
    <div class="wrap">
        <div class="section-head">
            <h2>Most popular guides</h2>
            <p>Real comparisons, not generic lists copied from other sites.</p>
        </div>
        <div class="guides">
            <div class="guide-card">
                <div class="guide-thumb">
                    <img src="/publicos/images/inicio/alfombras_p1.webp" alt="Rug guide">
                </div>
                <div class="body">
                    <span class="kicker">Safety at home</span>
                    <h3>Non-slip rugs: practical guide</h3>
                    <p>Where to place them and what to look for to prevent slipping on hard floors.</p>
                    <a href="/en/alfombras.php" class="readmore">Read guide →</a>
                </div>
            </div>
            <div class="guide-card">
                <div class="guide-thumb">
                    <img src="/publicos/images/inicio/arnes_p1.webp" alt="Harness guide">
                </div>
                <div class="body">
                    <span class="kicker">Mobility</span>
                    <h3>Rear support harness: how to choose the right one</h3>
                    <p>Rear lift, front, or full-body: which one your dog needs and why.</p>
                    <a href="/en/arnes.php" class="readmore">Read guide →</a>
                </div>
            </div>
            <div class="guide-card">
                <div class="guide-thumb">
                    <img src="/publicos/images/inicio/camas_p1.webp" alt="Bed guide">
                </div>
                <div class="body">
                    <span class="kicker">Ergonomic rest</span>
                    <h3>Orthopedic beds: which ones are worth it</h3>
                    <p>What memory foam density to look for based on weight and signs of hip dysplasia.</p>
                    <a href="/en/camas.php" class="readmore">Read in-depth review →</a>
                </div>
            </div>
            <div class="guide-card">
                <div class="guide-thumb">
                    <img src="/publicos/images/inicio/rampas_p1.webp" alt="Ramp guide">
                </div>
                <div class="body">
                    <span class="kicker">Senior mobility</span>
                    <h3>The best ramps for senior dogs</h3>
                    <p>We compare stability, max supported weight, and incline angle in telescoping and solid-foam
                        models.</p>
                    <a href="/en/rampas.php" class="readmore">Read in-depth review →</a>
                </div>
            </div>
            <div class="guide-card">
                <div class="guide-thumb">
                    <img src="/publicos/images/inicio/suplementos_p1.webp" alt="Supplement guide">
                </div>
                <div class="body">
                    <span class="kicker">Supplements</span>
                    <h3>Glucosamine and chondroitin: a no-nonsense guide</h3>
                    <p>What the evidence says, and how to choose a trustworthy brand on Amazon.</p>
                    <a href="/en/suplementos.php" class="readmore">Read guide →</a>
                </div>
            </div>
            <div class="guide-card">
                <div class="guide-thumb">
                    <img src="/publicos/images/inicio/halloween_p1.webp" alt="Halloween guide for senior dogs">
                </div>
                <div class="body">
                    <span class="kicker">Halloween Special 🎃</span>
                    <h3>Halloween with your senior dog: seasonal guide</h3>
                    <p>Comfortable costumes, nighttime safety, and how to ease October 31st anxiety.</p>
                    <a href="/en/halloween.php" class="readmore">Read guide →</a>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="section" id="por-que" style="background:var(--cream-2);">
    <div class="wrap split">
        <div>
            <h2>We're not another generic pet blog</h2>
            <p style="margin-top:16px; color:rgba(30,42,56,0.75); max-width:48ch;">
                We focus only on senior dogs because their needs are different: reduced mobility, sensitive joints,
                appetite changes. Every recommendation starts there — not from context-free "top 10 products for dogs"
                lists.
            </p>
            <div class="stat-row">
                <div class="stat"><span>As senior dog owners, we understand firsthand the changes that age brings —
                        tested and compared products</span></div>
            </div>
        </div>
        <div class="timeline-card" style="background:#fff; padding:0; overflow:hidden;">
            <img src="https://images.unsplash.com/photo-1608469926865-b2d2200bb2f6?fm=jpg&q=80&w=800&auto=format&fit=crop"
                alt="Senior dog resting at home" style="width:100%; height:180px; object-fit:cover; display:block;">
            <div style="padding:26px 24px;">
                <span class="tag">Signs your dog is already senior</span>
                <ul
                    style="margin:14px 0 0; padding-left:18px; color:rgba(30,42,56,0.75); font-size:0.94rem; line-height:1.9;">
                    <li>They struggle more with stairs or the couch</li>
                    <li>They sleep more hours than usual</li>
                    <li>Less enthusiasm on walks</li>
                    <li>Visible coat or weight changes</li>
                </ul>
            </div>
        </div>
    </div>
</section>
<section class="section" id="newsletter">
    <div class="wrap">
        <div>
            <h2>Get new guides in your inbox</h2>
            <p>Every guide we publish and the best deals for senior dogs. No spam, unsubscribe anytime.</p>
        </div>
        <form method="POST">
            <input type="email" name="boletin_email" placeholder="you@email.com" required aria-label="Email address">
            <button type="submit" class="btn-primary">Subscribe</button>
        </form>
    </div>
    <?php if ($aviso_boletin): ?>
    <div class="wrap">
        <?php echo $aviso_boletin; ?>
    </div>
    <?php endif; ?>
    <?php if ($lead_registrado): ?>
    <script>
    fbq('track', 'Lead');
    </script>
    <?php endif; ?>
</section>
<div class="disclosure">
    <div class="wrap">
        <strong>Transparency Disclosure:</strong> As an Amazon Associate, Tienda Texas LLC earns from qualifying
        purchases. When you click the "See price on Amazon" buttons, you'll be redirected to the official platform to
        complete your purchase. This doesn't increase the product's cost for you and helps us keep our site funded, free
        of intrusive ads, and with 100% independent reviews.
    </div>
</div>
<?php require_once __DIR__ . '/../footer.php'; ?>