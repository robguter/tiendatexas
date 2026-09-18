<?php
// config.php - Configuración unificada de afiliados para Tienda Texas LLC

define('AMAZON_TRACKING_ID', 'tiendatexasll-20');

/**
 * Genera el enlace de afiliado oficial para cualquier producto de Amazon.
 * Resuelve el problema de ámbito pasando la constante de forma global y segura.
 * 
 * @param string $asin_o_url Código ASIN de 10 dígitos o URL completa de Amazon.
 * @return string URL de afiliado corregida y lista para usar.
 */
function obtener_enlace_amazon($asin_o_url) {
    // Forzamos a PHP a leer la constante global tiendatexasll-20 sin errores de ámbito
    $tracking_id = AMAZON_TRACKING_ID;

    // Si se introduce una URL completa por error, extraemos el ASIN automáticamente
    if (strpos($asin_o_url, 'http') !== false) {
        preg_match('/\/([A-Z0-9]{10})(?:[\/?]|$)/i', $asin_o_url, $matches);
        $asin = !empty($matches[1]) ? $matches[1] : '';
    } else {
        $asin = trim($asin_o_url);
    }

    // RETORNA LA URL PERFECTAMENTE ESTRUCTURADA
    if (!empty($asin)) {
        return "https://amazon.com/dp/" . $asin . "?tag=" . $tracking_id;
    }
    
    // Enlace de respaldo por si el ASIN del JSON viene vacío o dañado
    return "https://amazon.com/?tag=" . $tracking_id;
}
?>