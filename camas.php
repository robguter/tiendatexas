        <?php
            $categoria_filtrada = 'camas'; 
            $meta_title = "La Mejor Cama Ortopédica para Perros Mayores y con Displasia de Cadera — Tienda Texas";
            $meta_description = "Comparamos las mejores camas ortopédicas para perros mayores, incluyendo displasia de cadera: qué densidad de espuma buscar y cuándo vale la pena pagar más.";
            $canonical = "https://tiendatexasllc.com/camas.php";
            
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

        <div class="article-head" style="background-image:linear-gradient(rgba(250,247,242,0.82), rgba(250,247,242,0.92)), url('https://images.unsplash.com/photo-1642303009699-7d7fd6d4a243?fm=jpg&q=80&w=1400&auto=format&fit=crop'); background-size:cover; background-position:center;">
        <div class="wrap-article">
            <span class="kicker">Descanso</span>
            <h1>Camas ortopédicas para perros senior (o "mayores"): cuáles son las mejores</h1>
            <p class="meta">Guía de compra · Actualizado 2026 · 7 min de lectura</p>
        </div>
        </div>

        <div class="guide-banner">
        <img src="publicos/images/camas/camas_p1.webp" alt="Perro descansando en cama para mascotas">
        </div>

        <article>
        <div class="wrap-article">

            <p>Un perro senior —o mayor, como también se le conoce— puede pasar entre 16 y 20 horas al día descansando. Eso significa que la cama donde duerme no es un accesorio más: es probablemente el objeto que más tiempo toca su cuerpo, todos los días. Y sin embargo, es de lo último en lo que la mayoría de los dueños piensa al hacer ajustes para la vejez de su perro.</p>

            <p>La diferencia entre una cama cualquiera y una cama ortopédica real no está en el marketing, está en la densidad de la espuma y cómo distribuye el peso del cuerpo. Aquí te explico qué mirar para no pagar de más por una cama "ortopédica" que en realidad no lo es.</p>

            
            
            <main class="contenedor-productos">
            <?php if (empty($productos_filtrados)): ?>
                <p style="text-align: center; color: #666; margin-top: 40px;">Próximamente añadiremos nuestros análisis detallados para esta sección. ¡Mantente atento!</p>
            <?php else: ?>
            <?php foreach ($productos_filtrados as $indice => $prod): 
                $enlace_afiliado = obtener_enlace_amazon($prod['asin']); 
                // Usamos la primera imagen de la lista como foto inicial por defecto
                $foto_inicial = !empty($prod['imagenes']) ? $prod['imagenes'][0] : 'publicos/images/camas/default.jpg';
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


            <h2>¿Por qué importa tanto en perros senior?</h2>
            <p>Con la edad, los perros pierden masa muscular y grasa protectora sobre huesos y articulaciones. Una cama demasiado blanda o delgada hace que las caderas, codos y hombros presionen directo contra el piso a través del relleno, generando puntos de presión que pueden derivar en callos, e incluso agravar dolor articular existente, como el que produce la displasia de cadera o la artritis.</p>

            <h2>Los 4 factores que separan una cama real de una que solo lo parece</h2>

            <h3>1. Espuma de memoria de alta densidad, no espuma común</h3>
            <p>Aquí está el truco de marketing más común: muchas camas dicen "ortopédica" solo porque usan espuma suave, no porque use espuma de memoria de densidad real (idealmente 4-5 lb/ft³ o más). La espuma común se comprime rápido y pierde soporte en pocos meses; la de alta densidad mantiene su forma por años.</p>

            <h3>2. Grosor mínimo de 4 pulgadas para perros medianos y grandes</h3>
            <p>Una capa delgada de espuma sobre una base plana no ofrece soporte real. Para razas medianas y grandes, busca al menos 4 pulgadas (10 cm) de espuma; para razas pequeñas, 2-3 pulgadas suele ser suficiente.</p>

            <h3>3. Funda removible y lavable</h3>
            <p>Los perros senior son más propensos a accidentes (incontinencia, vómito, etc.). Una funda con cierre que se pueda quitar y lavar en máquina no es un lujo, es prácticamente obligatorio para mantener la cama higiénica a largo plazo.</p>

            <h3>4. Base antideslizante</h3>
            <p>Un perro con movilidad reducida que empuja con las patas para acomodarse puede terminar moviendo la cama por todo el piso si no tiene una base de goma antideslizante. Esto es especialmente importante en pisos de madera o cerámica.</p>

            <div class="callout">
            <b>Señal de alerta:</b> si una cama se anuncia como "ortopédica" pero no menciona la densidad de la espuma en ningún lado de la descripción, es una bandera roja. Las marcas que sí usan espuma de calidad casi siempre lo destacan como argumento de venta.
            </div>

            <h2>¿Qué tamaño elegir?</h2>
            <table>
            <tr><th>Situación</th><th>Recomendación</th></tr>
            <tr><td>Perro que duerme estirado por completo</td><td>Cama 8-10 cm más larga que su cuerpo extendido</td></tr>
            <tr><td>Perro con artritis o displasia de cadera</td><td>Espuma de memoria de mayor densidad, prioridad sobre el tamaño</td></tr>
            <tr><td>Espacios reducidos o departamentos</td><td>Modelos con bordes bajos, más fáciles de acomodar en esquinas</td></tr>
            <tr><td>Perros que rascan antes de acostarse</td><td>Funda reforzada, resistente a enganches</td></tr>
            </table>

            <div class="callout">
            <b>Algo que descubrimos investigando esto:</b> en el rango de $30-50, prácticamente todo el mercado usa espuma tipo "egg-crate" (huevera), no espuma de memoria sólida. La espuma de memoria sólida real, la que da mejor soporte para artritis avanzada, suele empezar arriba de los $200. No es que las opciones económicas sean malas — cumplen bien para la mayoría de los casos — pero si tu perro tiene dolor articular severo, como el que produce una displasia de cadera diagnosticada, vale la pena considerar el salto de precio.
            </div>

            
            <p class="pick-note">Nota: las 3 primeras opciones (económicas) cubren bien la mayoría de los casos de perros senior sanos o con molestias leves. Las 2 opciones premium tienen sentido cuando el perro tiene un diagnóstico de artritis o displasia moderada a severa, donde la calidad de la espuma hace una diferencia real y sostenida en el tiempo.</p>

            <h2>Un detalle que casi nadie menciona: la ubicación</h2>
            <p>Incluso la mejor cama ortopédica pierde efectividad si está en un lugar con corriente de aire frío o lejos de donde tu perro pasa el resto del tiempo. Los perros senior regulan peor su temperatura corporal, así que ubicar la cama en una zona templada de la casa, alejada de puertas o ventanas, complementa el soporte físico que ya te da la cama en sí.</p>

        </div>
        </article>

        <?php require_once 'footer.php'; ?>

    </body>
</html>
