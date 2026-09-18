        <?php
            $categoria_filtrada = 'suplementos'; 
            $meta_title = "Glucosamina y Condroitina para Perros Senior: Dosis y Marcas Confiables — Tienda Texas";
            $meta_description = "¿Cuánta glucosamina y condroitina necesita tu perro senior? Dosis según su peso, qué dice la evidencia, y cómo elegir una marca confiable en Amazon.";
            $canonical = "https://tiendatexasllc.com/suplementos.php";

            // Carga de componentes centrales
            $pagina_tipo = 'guia'; // Activa el CSS de productos en el header
            require_once 'header.php';
            require_once 'config.php'; 
            
            $json_path = 'productos.json';
            if (!file_exists($json_path)) {
                echo "<p class='contenedor-productos'>Error: No se encontró el archivo de productos.</p>";
                exit;
            }

            $json_data = file_get_contents($json_path);
            $todos_los_productos = json_decode($json_data, true);
            
            $productos_filtrados = array_filter($todos_los_productos, function($p) use ($categoria_filtrada) {
                return isset($p['categoria']) && $p['categoria'] === $categoria_filtrada;
            });
        ?>

        <div class="article-head" style="background-image:linear-gradient(rgba(250,247,242,0.82), rgba(250,247,242,0.92)), url('https://images.unsplash.com/photo-1651777229439-beef9fda852f?fm=jpg&q=80&w=1400&auto=format&fit=crop'); background-size:cover; background-position:center;">
        <div class="wrap-article">
            <span class="kicker">Suplementos</span>
            <h1>Glucosamina y Condroitina para Perros Senior: Dosis y Marcas Confiables. ¿Qué dice la evidencia realmente?</h1>
            <p class="meta">Guía de compra · Actualizado 2026 · 8 min de lectura</p>
        </div>
        </div>

        <div class="guide-banner">
        <img src="publicos/images/suplementos/suplementos_p10.webp" alt="Perro senior activo al aire libre">
        </div>

        <article>
        <div class="wrap-article">

            <p>Si buscaste "suplemento articular para perros" alguna vez, probablemente viste decenas de productos prometiendo resultados casi milagrosos. La realidad es más matizada, y creemos que mereces conocerla antes de gastar tu dinero: la evidencia científica sobre glucosamina y condroitina en perros es <b>mixta</b>, no unánime. Algunos estudios muestran mejoría real, otros no encuentran diferencia frente a un placebo.</p>

            <p>Eso no significa que no valga la pena probarlo — significa que conviene entender qué esperar realmente, y cómo saber si está funcionando en tu perro específico, en vez de asumir que un bote con la palabra "articulaciones" en la etiqueta va a resolver todo.</p>

            
            <p>Estos productos cumplen nuestros criterios: dosis exacta declarada en mg, certificación NASC, y buen respaldo de reseñas reales. 
            Los ordenamos por track record (número de reseñas), de mayor a menor.</p>

            
            <main class="contenedor-productos">
            <?php if (empty($productos_filtrados)): ?>
                <p style="text-align: center; color: #666; margin-top: 40px;">Próximamente añadiremos nuestros análisis detallados para esta sección. ¡Mantente atento!</p>
            <?php else: ?>
            <?php foreach ($productos_filtrados as $indice => $prod): 
                $enlace_afiliado = obtener_enlace_amazon($prod['asin']); 
                // Usamos la primera imagen de la lista como foto inicial por defecto
                $foto_inicial = !empty($prod['imagenes']) ? $prod['imagenes'][0] : 'publicos/images/suplementos/default.jpg';
                $id_visor_unico = "visor-" . $indice;
            ?>
                <!-- TARJETA DE PRODUCTO MODERNA -->
                <article class="producto-card">
                    
                    <!-- GALERÍA ESTILO AMAZON -->
                    <div class="galeria-amazon">
                        <!-- Miniaturas laterales (Solo se dibujan si hay más de 1 imagen) -->
                        <div class="miniaturas-col">
                            <?php if (isset($prod['imagenes']) && count($prod['imagenes']) > 1): ?>
                                <?php foreach ($prod['imagenes'] as $sub_indice => $img_url): ?>
                                    <img src="<?php echo htmlspecialchars($img_url); ?>" 
                                        class="miniatura-img <?php echo $sub_indice === 0 ? 'activa' : ''; ?>" 
                                        alt="Miniatura de vista del producto"
                                        onclick="cambiarImagenGaleria(this, '<?php echo $id_visor_unico; ?>')">
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                
                        <!-- Contenedor e Imagen Principal -->
                        <div class="imagen-con-caption">
                            <div class="imagen-principal-box">
                                <img id="<?php echo $id_visor_unico; ?>" 
                                    src="<?php echo htmlspecialchars($foto_inicial); ?>" 
                                    alt="<?php echo htmlspecialchars($prod['titulo']); ?>" 
                                    loading="lazy">
                            </div>
                            <a href="<?php echo $enlace_afiliado; ?>" class="foto-caption" target="_blank" rel="noopener nofollow">
                                Foto ilustrativa — Ver foto real en Amazon →
                            </a>
                        </div>

                    </div>

                    <!-- ENCABEZADO E INFORMACIÓN -->
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
                        <strong>Nuestro análisis:</strong> <?php echo htmlspecialchars($prod['descripcion_corta']); ?>
                    </p>
                    
                    <?php if (!empty($prod['resena_larga'])): ?>
                        <p class="resena-texto"><?php echo htmlspecialchars($prod['resena_larga']); ?></p>
                    <?php endif; ?>

                    <!-- TABLA DE PROS Y CONTRAS -->
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

                    <!-- BOTÓN LLAMATIVO CON TU ENLACE TIENDATEXASLL-20 -->
                    <a href="<?php echo $enlace_afiliado; ?>" class="btn-ver-amazon" target="_blank" rel="noopener nofollow">
                        Ver precio en Amazon →
                    </a>
                </article>
                <?php endforeach; ?>
                <?php endif; ?>
            </main>

            <script src="publicos/js/galeria.js"></script>


            <h2>Qué dice la evidencia científica</h2>
            <p>Varios ensayos clínicos en perros con osteoartritis han probado combinaciones de glucosamina y condroitina. Los resultados no son consistentes entre estudios:</p>
            <ul>
            <li><b>A favor:</b> un ensayo publicado mostró mejoras estadísticamente significativas en dolor, apoyo de peso y severidad de la condición después de 70 días de tratamiento, comparado con placebo.</li>
            <li><b>En contra:</b> otro ensayo controlado con 23 perros no encontró ninguna mejora medible frente a placebo, usando mediciones objetivas de fuerza al caminar.</li>
            <li><b>Contexto importante:</b> una revisión sistemática de estudios en animales concluyó que la evidencia sigue siendo "controversial" — algunos perros responden bien, otros no muestran cambio alguno.</li>
            </ul>

            <div class="callout">
            <b>Lo que esto significa en la práctica:</b> a pesar de la evidencia mixta, veterinarios siguen recomendando estos suplementos con frecuencia, principalmente porque el perfil de riesgo es muy bajo (pocos efectos secundarios, generalmente solo indigestión leve) comparado con antiinflamatorios de uso prolongado. Es una apuesta de bajo riesgo, no una garantía.
            </div>

            <h2>¿Cuánto tiempo hay que esperar para ver resultados?</h2>
            <p>Este es un punto que casi ningún vendedor menciona: en los estudios donde sí hubo mejoría, el efecto tardó entre <b>42 y 70 días</b> en notarse — no es un suplemento de efecto inmediato como un analgésico. Si le das el suplemento a tu perro por dos semanas y no ves cambio, todavía es demasiado pronto para concluir que no funciona.</p>

            <h2>Qué buscar al elegir un producto</h2>

            <h3>1. Dosis real, no solo presencia del ingrediente</h3>
            <p>Muchos productos económicos incluyen glucosamina y condroitina en cantidades tan bajas que es poco probable que tengan efecto clínico real. Como referencia general (consulta siempre con tu veterinario para la dosis exacta según el peso de tu perro), busca productos que especifiquen claramente los miligramos por porción, no solo que "contiene" el ingrediente.</p>

            <h3>2. Forma de administración que tu perro realmente tome</h3>
            <p>El mejor suplemento del mundo no sirve si tu perro escupe la pastilla cada vez. Existen en polvo (se mezcla con la comida), masticables con sabor, y líquido. Si ya sabes que tu perro es difícil con pastillas, prioriza masticables o polvo desde el inicio en vez de pelear con el formato equivocado.</p>

            <h3>3. Certificación de calidad</h3>
            <p>A diferencia de los medicamentos, los suplementos no están tan regulados. Busca sellos como NASC (National Animal Supplement Council) cuando estén disponibles — es una señal de que el fabricante sigue buenas prácticas de manufactura, aunque no garantiza eficacia clínica.</p>

            <h3>4. Ingredientes adicionales con más evidencia propia</h3>
            <p>Algunos productos combinan glucosamina/condroitina con MSM (metilsulfonilmetano) o ácidos grasos omega-3. Los omega-3 en particular tienen evidencia algo más consistente para reducir inflamación articular, así que un producto que los incluya puede ofrecer valor adicional más allá de la glucosamina sola.</p>

            <h2>Señales de que SÍ está funcionando</h2>
            <p>Después de al menos 6-8 semanas de uso constante, observa si notas:</p>
            <ul>
            <li>Menos rigidez al levantarse después de dormir</li>
            <li>Más disposición a subir escaleras o saltar (dentro de lo razonable para su edad)</li>
            <li>Cojera menos frecuente o menos marcada durante los paseos</li>
            </ul>
            <p>Si después de 2-3 meses no ves ningún cambio, es razonable asumir que este suplemento en particular no está teniendo efecto en tu perro — vale la pena hablarlo con tu veterinario antes de seguir comprándolo por costumbre.</p>
            
            

            
            <p class="pick-note">Nota: la condroitina en Vet's Best Advanced (50mg) es notablemente menor que en Cosequin (300mg) o PetNC (100mg). Si la condroitina es tu prioridad principal, Cosequin o PetNC son mejores opciones.</p>

            <div class="callout">
            <b>Importante:</b> este contenido es informativo, no reemplaza el consejo de un veterinario. Antes de empezar cualquier suplemento nuevo, especialmente si tu perro toma otros medicamentos, consulta con tu veterinario la dosis adecuada para su peso y condición específica.
            </div>

        </div>
        </article>

        <?php require_once 'footer.php'; ?>

    </body>
</html>
