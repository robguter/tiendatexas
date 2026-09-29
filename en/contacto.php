<?php
    $meta_title = "Contact & Support — Tienda Texas";
    $meta_description = "Official Tienda Texas LLC contact form. Write to us with questions, suggestions, or partnerships about senior dog care.";
    $canonical = "https://tiendatexasllc.com/en/contacto.php";
    require_once __DIR__ . '/../header.php';

    $mensaje_resultado = ""; // Variable to display on-screen alerts

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nombre = strip_tags(trim($_POST["nombre"]));
        $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
        $mensaje = strip_tags(trim($_POST["mensaje"]));
        $destinatario = "admin@tiendatexasllc.com";
        $asunto = "New support message on Tienda Texas: $nombre";
        $contenido_email = "You have received a new message from your website's contact form.\n\n";
        $contenido_email .= "Name: $nombre\n";
        $contenido_email .= "Email: $email\n\n";
        $contenido_email .= "Message:\n$mensaje\n";
        $cabeceras = "From: web@tiendatexasllc.com\r\n";
        $cabeceras .= "Reply-To: $email\r\n";
        $cabeceras .= "X-Mailer: PHP/" . phpversion();
        if (mail($destinatario, $asunto, $contenido_email, $cabeceras)) {
            $mensaje_resultado = "<div style='background: #d4edda; color: #155724; padding: 15px; border-radius: 6px; margin-bottom: 20px; text-align: center; font-weight: bold;'>Message sent successfully! We'll get back to you very soon.</div>";
        } else {
            $mensaje_resultado = "<div style='background: #f8d7da; color: #721c24; padding: 15px; border-radius: 6px; margin-bottom: 20px; text-align: center; font-weight: bold;'>Error: The server couldn't send your message. Please try again later.</div>";
        }
    }
?>
<main class="contenedor-productos">
    <h1>Contact & Support</h1>
    <p class="resena-texto" style="text-align: center; max-width: 600px; margin: 0 auto 30px auto;">
        Have questions about our guides or want to suggest a product for senior dogs? Fill out the form below and our
        Tienda Texas LLC team will reply within 48 business hours.
    </p>

    <?php echo $mensaje_resultado; ?>

    <div class="producto-card" style="max-width: 600px; margin: 0 auto 40px auto;">

        <form action="contacto.php" method="POST" style="display: flex; flex-direction: column; gap: 20px;">

            <div style="display: flex; flex-direction: column; gap: 5px;">
                <label style="font-weight: 600; font-size: 0.95rem;">Full Name:</label>
                <input type="text" name="nombre" required>
            </div>

            <div style="display: flex; flex-direction: column; gap: 5px;">
                <label style="font-weight: 600; font-size: 0.95rem;">Email Address:</label>
                <input type="email" name="email" required
                    style="padding: 12px; border: 1px solid var(--gris-borde); border-radius: 6px; font-family: inherit;">
            </div>

            <div style="display: flex; flex-direction: column; gap: 5px;">
                <label style="font-weight: 600; font-size: 0.95rem;">Your Message or Question:</label>
                <textarea name="mensaje" rows="6" required
                    style="padding: 12px; border: 1px solid var(--gris-borde); border-radius: 6px; font-family: inherit; resize: vertical;"></textarea>
            </div>

            <button type="submit" class="btn-ver-amazon" style="border: none; cursor: pointer; width: 100%;">
                Send Message →
            </button>

        </form>

    </div>

</main>

<?php require_once __DIR__ . '/../footer.php'; ?>