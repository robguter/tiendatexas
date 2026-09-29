<?php
// ===== Raíz en español, inglés en /en/ =====
$uri        = $_SERVER['REQUEST_URI'] ?? '/';
$en_version = (strpos($uri, '/en/') === 0 || $uri === '/en');
$lang       = $en_version ? 'en' : 'es';

// Auto-redirect por idioma: solo primera visita (sin cookie) y nunca a bots
if (!isset($_COOKIE['tt_lang'])) {
    $ua     = $_SERVER['HTTP_USER_AGENT'] ?? '';
    $es_bot = preg_match('/bot|crawl|slurp|spider|mediapartners/i', $ua);
    if (!$es_bot) {
        $al = strtolower(substr($_SERVER['HTTP_ACCEPT_LANGUAGE'] ?? 'es', 0, 2));
        if ($al !== 'es' && !$en_version) {
            header('Location: /en' . $uri, true, 302);
            exit;
        }
    }
}

// ===== Tus variables (sin cambios) =====
$titulo_pagina = isset($meta_title) ? $meta_title 
                                    : "Tienda Texas — Guías para el cuidado de perros senior";
$desc_pagina   = isset($meta_description) ? $meta_description 
                                          : "Guías de compra honestas sobre cuidado de perros senior: rampas de movilidad, camas ortopédicas y suplementos articulares.";
$url_canonical = isset($canonical) ? $canonical 
                                   : "https://tiendatexasllc.com/";

// ===== URLs por idioma derivadas de LA CANONICAL de cada página =====
if (strpos($url_canonical, '/en/') !== false || substr($url_canonical, -3) === '/en') {
    $url_en = $url_canonical;
    $url_es = preg_replace('#/en(?=/|$)#', '', $url_canonical, 1);
} else {
    $url_es = $url_canonical;
    $url_en = preg_replace('#^(https?://[^/]+)#', '$1/en', $url_canonical, 1);
}
$canonical_out = ($lang === 'en') ? $url_en 
                                  : $url_es;
$og_locale     = ($lang === 'en') ? 'en_US' 
                                  : 'es_US';
$json_name     = ($lang === 'en') ? "Tienda Texas - Buying guides for senior dog care"
                                  : "Tienda Texas - Guías de compra sobre cuidado de perros senior";
$json_desc     = ($lang === 'en') ? "Honest buying guides for senior dog care: mobility ramps, orthopedic beds and joint supplements."
                                  : "Guías de compra sobre cuidado de perros senior: rampas, camas ortopédicas y suplementos articulares.";
$main = ($lang === 'en') ? "/publicos/estilo/main.css" 
                         : "publicos/estilo/main.css";
$styl = ($lang === 'en') ? "/publicos/estilo/estilo.css" 
                         : "publicos/estilo/estilo.css";
$logo = ($lang === 'en') ? "/publicos/images/logo.webp" 
                         : "publicos/images/logo.webp";
?>
<!DOCTYPE html>
<html lang="<?php echo $lang; ?>">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  <title><?php echo htmlspecialchars($titulo_pagina); ?></title>
  <meta name="description" content="<?php echo htmlspecialchars($desc_pagina); ?>">
  
  <link rel="canonical" href="<?php echo htmlspecialchars($canonical_out); ?>">
  <link rel="alternate" hreflang="es" href="<?php echo htmlspecialchars($url_es); ?>">
  <link rel="alternate" hreflang="en" href="<?php echo htmlspecialchars($url_en); ?>">
  <link rel="alternate" hreflang="x-default" href="<?php echo htmlspecialchars($url_en); ?>">
  
  <meta name="facebook-domain-verification" content="8qgojd6qcc9etr6xs0pl9rtlmee249" />
  <meta name="keywords" content="Tienda Texas LLC, Tienda Texas, Guías de compra, cuidado de perros, Perros senior, rampas para perros, camas ortopédicas para perros, suplementos articulares para perros, Mascotas senior" />
  <meta property="og:type" content="website">
  <meta property="og:title" content="<?php echo htmlspecialchars($titulo_pagina); ?>">
  <meta property="og:description" content="<?php echo htmlspecialchars($desc_pagina); ?>">

  <meta property="og:url" content="<?php echo htmlspecialchars($canonical_out); ?>">
  <meta property="og:locale" content="<?php echo $og_locale; ?>">

  <meta property="og:image" content="<?php echo htmlspecialchars($logo); ?>">
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="<?php echo htmlspecialchars($titulo_pagina); ?>">
  <meta name="twitter:description" content="<?php echo htmlspecialchars($desc_pagina); ?>">
  <meta name="twitter:image" content="<?php echo htmlspecialchars($logo); ?>">
  
  <link rel="icon" type="image/x-icon" href="https://tiendatexasllc.com/tiendatexas.ico">
  
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,400;9..144,600;9..144,700&family=Work+Sans:wght@400;500;600&display=swap" rel="stylesheet">
  
  <link rel="stylesheet" href="<?php echo htmlspecialchars($main); ?>">
  <link rel="stylesheet" href="<?php echo htmlspecialchars($styl); ?>">
  
  <script async src="https://www.googletagmanager.com/gtag/js?id=G-VRCWHT1GMP"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());
    gtag('config', 'G-VRCWHT1GMP');
  </script>
  
  <script>
  !function(f,b,e,v,n,t,s)
  {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
  n.callMethod.apply(n,arguments):n.queue.push(arguments)};
  if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
  n.queue=[];t=b.createElement(e);t.async=!0;
  t.src=v;s=b.getElementsByTagName(e)[0];
  s.parentNode.insertBefore(t,s)}(window, document,'script',
  'https://connect.facebook.net/en_US/fbevents.js');
  fbq('init', '4163066897323802');
  fbq('track', 'PageView');
  </script>
  <noscript><img height="1" width="1" style="display:none"
  src="https://www.facebook.com/tr?id=4163066897323802&ev=PageView&noscript=1"
  /></noscript>
  
  <script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "WebSite",
    "name": <?php echo $json_name; ?>,
    "@id": "https://tiendatexasllc.com/",
    "url": "https://tiendatexasllc.com/",
    "description": <?php echo $json_desc; ?>
  }
  </script>
  
  <script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "Organization",
    "name": "Tienda Texas - Guías de compra sobre cuidado de perros senior",
    "url": "https://tiendatexasllc.com/",
    "logo": "<?php echo htmlspecialchars($logo); ?>",
    "description": "Guías de compra sobre cuidado de perros senior: rampas, camas ortopédicas y suplementos articulares.",
    "sameAs": [
      "https://www.facebook.com/tiendatexasllc",
      "https://www.instagram.com/tiendatexasllc"
    ],
    "contactPoint": {
      "@type": "ContactPoint",
      "telephone": "+1 214-394-5533",
      "contactType": "customer service",
      "areaServed": "US",
      "availableLanguage": ["Spanish"]
    }
  }
  </script>
</head>
<body>
  
<header>
  <div class="wrap nav">
    <div class="logo-wrap">
      <img src="publicos/images/logo.webp" alt="Tienda Texas LLC" class="logo-img">
      <span class="logo-tag">Perros Senior</span>
    </div>

    <input type="checkbox" id="menu-toggle" class="menu-toggle-input">
    
    <label for="menu-toggle" class="hamburger-menu">
      <span></span>
      <span></span>
      <span></span>
    </label>

    <nav class="navlinks">
      <a href="index.php">Inicio</a>
      
      <div class="dropdown">
        <button class="dropdown-btn">Guías de Compra <span class="arrow">&#9656;</span></button>
        <div class="dropdown-content">
          <a href="rampas.php">🐾 Rampas de Movilidad</a>
          <a href="camas.php">🛏️ Camas Ortopédicas</a>
          <a href="suplementos.php">🧪 Suplementos Articulares</a>
          <a href="arnes.php">🐕 Arneses de Soporte</a>
          <a href="alfombras.php">🧱 Alfombras Antideslizantes</a>
          <a href="halloween.php">🎃 Especial Halloween</a>
        </div>
      </div>

      <a href="index.php#por-que">Por qué senior</a>
      <a href="index.php#newsletter">Boletín</a>
      <div class="lang-switch">
        <a href="<?php echo htmlspecialchars($url_es); ?>" onclick="document.cookie='tt_lang=es;path=/;max-age=31536000'">ES</a>
        <span>|</span>
        <a href="<?php echo htmlspecialchars($url_en); ?>" onclick="document.cookie='tt_lang=en;path=/;max-age=31536000'">EN</a>
      </div>
    </nav>
  </div>
</header>