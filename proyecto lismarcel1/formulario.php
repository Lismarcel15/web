<?php
// Configuración para envío de correo
$destinatario = "info@lismarcel.com";
$asunto = "Nueva solicitud desde el sitio web";

// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recoger los datos del formulario
    $nombre = filter_var($_POST["nombre"], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
    $telefono = filter_var($_POST["telefono"], FILTER_SANITIZE_STRING);
    $tipo_evento = filter_var($_POST["tipo_evento"], FILTER_SANITIZE_STRING);
    $servicio = filter_var($_POST["servicio"], FILTER_SANITIZE_STRING);
    $fecha = filter_var($_POST["fecha"], FILTER_SANITIZE_STRING);
    $mensaje = filter_var($_POST["mensaje"], FILTER_SANITIZE_STRING);
    
    // Validar datos
    $errores = [];
    
    if (empty($nombre)) {
        $errores[] = "El nombre es obligatorio";
    }
    
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errores[] = "Email inválido o vacío";
    }
    
    if (empty($telefono)) {
        $errores[] = "El teléfono es obligatorio";
    }
    
    if (empty($tipo_evento)) {
        $errores[] = "Debe seleccionar un tipo de evento";
    }
    
    // Si no hay errores, enviar el correo
    if (empty($errores)) {
        // Construir el cuerpo del mensaje
        $cuerpo = "Has recibido una nueva solicitud desde el formulario web:\n\n";
        $cuerpo .= "Nombre: " . $nombre . "\n";
        $cuerpo .= "Email: " . $email . "\n";
        $cuerpo .= "Teléfono: " . $telefono . "\n";
        $cuerpo .= "Tipo de evento: " . $tipo_evento . "\n";
        $cuerpo .= "Servicio solicitado: " . $servicio . "\n";
        $cuerpo .= "Fecha del evento: " . $fecha . "\n";
        $cuerpo .= "Mensaje: " . $mensaje . "\n";
        
        // Cabeceras del correo
        $cabeceras = "From: " . $email . "\r\n";
        $cabeceras .= "Reply-To: " . $email . "\r\n";
        $cabeceras .= "X-Mailer: PHP/" . phpversion();
        
        // Enviar el correo
        $enviado = mail($destinatario, $asunto, $cuerpo, $cabeceras);
        
        if ($enviado) {
            $respuesta = "¡Gracias! Tu solicitud ha sido enviada correctamente.";
            // Redirigir a una página de confirmación
            header("Location: confirmacion.php?exito=1");
            exit;
        } else {
            $respuesta = "Lo sentimos, ha ocurrido un error al enviar tu solicitud.";
        }
    }
}
?>