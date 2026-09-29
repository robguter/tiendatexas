<?php
// footer.php — Footer compartido ES/EN. $lang viene de header.php (siempre se incluye antes).
if (!isset($lang)) { $lang = 'es'; }
$pref = ($lang === 'en') ? '/en' : '';
$en = ($lang === 'en');

$T = [
  'bio'        => $en ? 'Portal specialized in technical analysis and recommendations for mobility, rest, and health products to optimize the senior years of aging pets.'
                      : 'Portal especializado en el análisis técnico y recomendaciones de productos de movilidad, descanso y salud para optimizar la vejez de mascotas de edad avanzada.',
  'guias'      => $en ? 'Specialized Guides' : 'Guías Especializadas',
  'soporte'    => $en ? 'Transparency & Support' : 'Transparencia y Soporte',
  'social'     => $en ? 'Social Media' : 'Redes Sociales',
  'contacto'   => $en ? 'Contact & Support' : 'Contacto y Soporte',
  'privacidad' => $en ? 'Privacy Policy' : 'Política de Privacidad',
  'terminos'   => $en ? 'Terms of Service' : 'Términos del Servicio',
  'derechos'   => $en ? 'All rights reserved.' : 'Todos los derechos reservados.',
  'disclosure' => $en ? 'As an Amazon Associate, we earn from qualifying purchases.'
                      : 'Como Afiliado de Amazon, ganamos por las compras que califican.',
];
$G = [
  [$pref . '/alfombras.php',   $en ? 'Non-Slip Mats 🧱' : 'Alfombras Antideslizantes 🧱'],
  [$pref . '/arnes.php',       $en ? 'Lift Harnesses 🐕' : 'Arneses de Elevación 🐕'],
  [$pref . '/camas.php',       $en ? 'Orthopedic Beds 🛏️' : 'Camas Ortopédicas 🛏️'],
  [$pref . '/rampas.php',      $en ? 'Mobility Ramps 🐾' : 'Rampas de Movilidad 🐾'],
  [$pref . '/suplementos.php', $en ? 'Glucosamine & Chondroitin 🧪' : 'Glucosamina y condroitina 🧪'],
  [$pref . '/halloween.php',   $en ? 'Halloween Special 🎃' : 'Especial Halloween 🎃'],
];
?>
<!-- footer.php -->
<footer class="site-footer">
    <div class="wrap">
        <div class="wrap footer-grid">

            <div class="footer-brand">
                <h5>Tienda Texas LLC</h5>
                <ul>
                    <li>
                        <p class="footer-bio"><?php echo htmlspecialchars($T['bio']); ?></p>
                    </li>
                </ul>
            </div>

            <div class="footer-col">
                <h5><?php echo htmlspecialchars($T['guias']); ?></h5>
                <ul>
                    <?php foreach ($G as $link): ?>
                    <li><a
                            href="<?php echo htmlspecialchars($link[0]); ?>"><?php echo htmlspecialchars($link[1]); ?></a>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <div class="footer-col">
                <h5><?php echo htmlspecialchars($T['soporte']); ?></h5>
                <ul>
                    <li><a href="<?php echo $pref; ?>/contacto.php"><?php echo htmlspecialchars($T['contacto']); ?></a>
                    </li>
                    <li><a
                            href="<?php echo $pref; ?>/privacidad.php"><?php echo htmlspecialchars($T['privacidad']); ?></a>
                    </li>
                    <li><a href="<?php echo $pref; ?>/terminos.php"><?php echo htmlspecialchars($T['terminos']); ?></a>
                    </li>
                </ul>
            </div>

            <div class="footer-col">
                <h5><?php echo htmlspecialchars($T['social']); ?></h5>
                <ul>
                    <li><a href="https://www.facebook.com/tiendatexasllc" target="_blank"
                            rel="noopener nofollow">Facebook</a></li>
                    <li><a href="https://www.instagram.com/tiendatexasllc" target="_blank"
                            rel="noopener nofollow">Instagram</a></li>
                </ul>
            </div>

        </div>

        <div class="footer-bottom">
            <span>&copy; <?php echo date("Y"); ?> Tienda Texas LLC.
                <?php echo htmlspecialchars($T['derechos']); ?></span>
            <span><?php echo htmlspecialchars($T['disclosure']); ?></span>
        </div>
    </div>
</footer>
</body>

</html>