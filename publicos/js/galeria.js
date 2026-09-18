/**
 * Intercambia la imagen principal de una galería al hacer clic en una miniatura.
 * @param {HTMLElement} miniatura - El elemento de la miniatura clickeada.
 * @param {string} idPrincipal - El ID de la etiqueta <img> principal que va a cambiar.
 */
function cambiarImagenGaleria(miniatura, idPrincipal) {
    const imagenGrande = document.getElementById(idPrincipal);
    if (!imagenGrande) return;

    // 1. Cambiar la imagen del visor grande
    imagenGrande.src = miniatura.src;
    
    // 2. Buscar todas las miniaturas dentro de la misma columna para limpiar el borde naranja
    const columnaMiniaturas = miniatura.parentElement;
    const todasLasMiniaturas = columnaMiniaturas.getElementsByClassName('miniatura-img');
    
    for (let i = 0; i < todasLasMiniaturas.length; i++) {
        todasLasMiniaturas[i].classList.remove('activa');
    }
    
    // 3. Resaltar la miniatura actual
    miniatura.classList.add('activa');
}