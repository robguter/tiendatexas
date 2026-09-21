        <?php
            $categoria_filtrada = 'rampas';
            
            $meta_title = "Las mejores rampas para perros senior: cómo elegir la correcta";
            $meta_description = "Comparamos rampas para perros senior: estabilidad, capacidad de peso, precio y calificaciones reales.";
            $canonical = "https://tiendatexasllc.com/rampas.php";
                
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

        <div class="article-head" style="background-image:linear-gradient(rgba(250,247,242,0.82), rgba(250,247,242,0.92)), url('https://images.unsplash.com/photo-1587300003388-59208cc962cb?fm=jpg&q=80&w=1400&auto=format&fit=crop'); background-size:cover; background-position:center;">
            <div class="wrap-article">
                <span class="kicker">Movilidad</span>
                <h1><?php echo htmlspecialchars($meta_title); ?></h1>
                <p class="meta">Guía de compra · Actualizado 2026 · 8 min de lectura</p>
            </div>
        </div>

        <div class="guide-banner">
            <img src="publicos/images/rampas/rampas_p1.webp" alt="Perro senior en escalones">
        </div>

        <article>
            <div class="wrap-article">

                <p>Si tu perro senior (mayor) empezó a dudar antes de saltar al sofá, o notas que se queda pensando dos segundos de más frente a las escaleras del auto, probablemente ya te lo está diciendo a su manera: sus articulaciones ya no responden como antes. Una rampa bien elegida no es un lujo, es una forma directa de reducir el desgaste en sus caderas y rodillas cada vez que sube o baja de un lugar alto.</p>

                <p>El problema es que no todas las rampas sirven para todos los perros. Una rampa demasiado empinada puede intimidar a un perro con dolor articular, y una demasiado larga puede no caber en tu auto o tu casa. Aquí te explico qué mirar antes de comprar, para que no termines con una rampa que tu perro simplemente se niega a usar.</p>

                
                <p>Actualizamos esta lista tras revisar el historial de reseñas de cada producto: reemplazamos una opción con poco respaldo por una marca más establecida. Los primeros 3 modelos están pensados para perros pequeños y medianos, el cuarto es premium y el quinto es para razas grandes.</p>
                <main class="contenedor-productos">
                    
                    <?php if (empty($productos_filtrados)): ?>
                        <p style="text-align: center; color: #666; margin-top: 40px;">Próximamente añadiremos nuestros análisis detallados para esta sección. ¡Mantente atento!</p>
                    <?php else: ?>
                    <?php foreach ($productos_filtrados as $indice => $prod): 
                        $enlace_afiliado = obtener_enlace_amazon($prod['asin']); 
                        // Usamos la primera imagen de la lista como foto inicial por defecto
                        $foto_inicial = !empty($prod['imagenes']) ? $prod['imagenes'][0] : 'publicos/images/rampas/default.jpg';
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

                <p class="pick-note">Nota: Aodisman, EHEYCIGA y Ahpmeoa están diseñados para perros pequeños y medianos. PetSafe CozyUp es la opción premium con mejor marca reconocida, y Fecuria es la única de esta lista pensada para razas grandes.</p>

                <h2>Cómo ayudar a tu perro a acostumbrarse a la rampa</h2>
                <p>Aunque compres la rampa perfecta, muchos perros senior necesitan un periodo de adaptación. Colócala en un ángulo bajo primero, usa premios para animarlo a caminar sobre ella sin peso (con la rampa apoyada en el piso), y solo después practica con la inclinación real. Forzar a un perro asustado a usarla desde el primer día suele generar el efecto contrario: que la rechace por completo.</p>





                <h2>¿Tu perro realmente necesita una rampa?</h2>
                <p>No todos los perros senior la necesitan de inmediato, pero estas señales suelen indicar que ya es momento:</p>
                <ul>
                <li>Duda visiblemente antes de subir o bajar del sofá, cama o auto</li>
                <li>Ha sido diagnosticado con displasia de cadera, artritis o problemas de columna</li>
                <li>Es una raza grande o de espalda larga (como Basset Hound o Dachshund), propensa a lesiones al saltar</li>
                <li>Se recuperó recientemente de una cirugía y necesita evitar impactos</li>
                </ul>

                <h2>Los 5 factores que realmente importan</h2>

                <h3>1. Capacidad de peso</h3>
                <p>Este es el error más común: comprar una rampa pensando solo en el tamaño del perro, sin revisar el peso máximo que soporta. Busca siempre un margen de al menos 20-30% por encima del peso real de tu perro, porque el peso dinámico al caminar genera más presión que el peso estático.</p>

                <h3>2. Ángulo de inclinación</h3>
                <p>Mientras más plano el ángulo, menos esfuerzo hace tu perro, pero más larga (y menos práctica) es la rampa. Para perros con artritis avanzada o problemas serios de columna, un ángulo suave es más importante que ahorrar espacio.</p>

                <h3>3. Superficie antideslizante</h3>
                <p>Un perro senior que resbala una vez en la rampa probablemente no vuelva a confiar en ella. Busca superficies con textura tipo alfombra o goma, no plástico liso, especialmente si la vas a usar en exteriores donde puede mojarse.</p>

                <h3>4. Plegable y portátil, si la vas a mover</h3>
                <p>Si planeas usarla para el auto y también en casa, el peso de la rampa y qué tan fácil se pliega importa tanto como el precio. Una rampa de 9 kg que no pliega bien se vuelve un mueble más, no una herramienta que realmente usas a diario.</p>

                <h3>5. Estabilidad en los extremos</h3>
                <p>Los mejores modelos tienen bordes elevados a los costados y una base que no se mueve al pisarla. Esto es clave para perros con visión reducida, algo muy común en la etapa senior.</p>

                <div class="callout">
                <b>Tip práctico:</b> antes de comprar, mide la altura exacta del lugar donde vas a usar la rampa (sofá, cama, cajuela del auto). La mayoría de las devoluciones ocurren porque la rampa resultó muy corta o muy empinada para ese espacio específico.
                </div>

                <h2>Tabla rápida de referencia</h2>
                <table>
                <tr><th>Situación de tu perro</th><th>Qué priorizar</th></tr>
                <tr><td>Artritis o dolor articular avanzado</td><td>Ángulo lo más plano posible</td></tr>
                <tr><td>Raza grande (+25 kg)</td><td>Capacidad de peso alta + base ancha</td></tr>
                <tr><td>Uso en auto/viajes</td><td>Ligera y plegable</td></tr>
                <tr><td>Uso en exterior o zonas húmedas</td><td>Superficie antideslizante tipo goma</td></tr>
                <tr><td>Perro con visión reducida</td><td>Bordes laterales elevados</td></tr>
                </table>

                
            </div>
        </article>

        <?php require_once 'footer.php'; ?>

    </body>
</html>
