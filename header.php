<?php

$titulo_pagina = isset($meta_title) ? $meta_title : "Tienda Texas — Guías para el cuidado de perros senior";
$desc_pagina   = isset($meta_description) ? $meta_description : "Guías de compra honestas sobre cuidado de perros senior: rampas de movilidad, camas ortopédicas y suplementos articulares.";
$url_canonical = isset($canonical) ? $canonical : "https://tiendatexasllc.com/";
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <!-- 1. Declaraciones críticas para el navegador siempre arriba -->
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  <title><?php echo htmlspecialchars($titulo_pagina); ?></title>
  <meta name="description" content="<?php echo htmlspecialchars($desc_pagina); ?>">
  <link rel="canonical" href="<?php echo $url_canonical; ?>">
  
  <meta name="facebook-domain-verification" content="8qgojd6qcc9etr6xs0pl9rtlmee249" />
  <meta name="keywords" content="Tienda Texas LLC, Tienda Texas, Guías de compra, cuidado de perros, Perros senior, rampas para perros, camas ortopédicas para perros, suplementos articulares para perros, Mascotas senior" />
  <meta property="og:type" content="website">
  <meta property="og:title" content="<?php echo htmlspecialchars($titulo_pagina); ?>">
  <meta property="og:description" content="<?php echo htmlspecialchars($desc_pagina); ?>">
  <meta property="og:url" content="<?php echo $url_canonical; ?>">
  <meta property="og:image" content="https://tiendatexasllc.com/publicos/images/logo.webp">
  <meta property="og:locale" content="es_US">
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="<?php echo htmlspecialchars($titulo_pagina); ?>">
  <meta name="twitter:description" content="<?php echo htmlspecialchars($desc_pagina); ?>">
  <meta name="twitter:image" content="https://tiendatexasllc.com/publicos/images/logo.webp">
  
  <link rel="icon" type="image/x-icon" href="https://tiendatexasllc.com/tiendatexas.ico">

  <!-- 3. Conexiones externas y fuentes -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,400;9..144,600;9..144,700&family=Work+Sans:wght@400;500;600&display=swap" rel="stylesheet">
  
  <!-- Tus estilos corregidos guardados en la ruta que creaste -->
  <link rel="stylesheet" href="publicos/estilo/main.css">
  <link rel="stylesheet" href="publicos/estilo/estilo.css">

  <!-- 4. Scripts de analítica (Google Tag Manager) -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=G-VRCWHT1GMP"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());
    gtag('config', 'G-VRCWHT1GMP');
  </script>

  <!-- 4b. Píxel de Meta (Tienda Texas - Web) -->
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

  <!-- 5. Datos Estructurados globales válidos para Google (Sitio Web) -->
  <script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "WebSite",
    "name": "Tienda Texas - Guías de compra sobre cuidado de perros senior",
    "@id": "https://tiendatexasllc.com/",
    "url": "https://tiendatexasllc.com/",
    "description": "Guías de compra sobre cuidado de perros senior: rampas, camas ortopédicas y suplementos articulares."
  }
  </script>

  <!-- Datos Estructurados globales (Organización) -->
  <script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "Organization",
    "name": "Tienda Texas - Guías de compra sobre cuidado de perros senior",
    "url": "https://tiendatexasllc.com/",
    "logo": "https://tiendatexasllc.com/publicos/images/logo.webp",
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

<!-- header.php -->
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
        </div>
      </div>

      <a href="index.php#por-que">Por qué senior</a>
      <a href="index.php#newsletter">Boletín</a>
    </nav>
  </div>
</header>