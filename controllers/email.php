<?php
// Asegúrate de incluir los namespaces de PHPMailer y cargar el autoload de Composer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Autoload de Composer para PHPMailer

class EmailController {
    private $mailer;

    // Constructor de la clase EmailController
    public function __construct() {
        $this->mailer = new PHPMailer(true); // Crea una nueva instancia de PHPMailer
        $this->configureMailer();            // Llama al método para configurar PHPMailer
    }

    // Método privado para configurar PHPMailer con los datos SMTP
    private function configureMailer() {
        $this->mailer->isSMTP();                                    // Configura para usar SMTP
        $this->mailer->Host       = 'smtp.hostinger.com';           // Servidor SMTP
        $this->mailer->SMTPAuth   = true;                           // Autenticación habilitada
        $this->mailer->Username   = 'jdc@tunjatienevoz.com';        // Usuario SMTP
        $this->mailer->Password   = 'Jdc.email.2024';               // Contraseña SMTP
        $this->mailer->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;    // Encriptación SMTP
        $this->mailer->Port       = 465;                            // Puerto para SMTPS
        $this->mailer->CharSet    = 'UTF-8';                        // Codificación de caracteres
        $this->mailer->Timeout    = 30;                             // Timeout de 30 segundos
        $this->mailer->setFrom('jdc@tunjatienevoz.com', 'cambio clave jdc'); // Remitente
        $this->mailer->isHTML(true);                                // Configura para enviar en formato HTML
    }

    // Método para enviar un correo con el código de recuperación de contraseña
    public function sendRecoveryCode($to, $code) {
        try {
            $this->mailer->addAddress($to);                      // Destinatario del correo
            $this->mailer->Subject = 'Código de Recuperación de Contraseña'; // Asunto del correo

            // Obtén la plantilla del correo con el código de recuperación
            $body = $this->getEmailTemplate($code);

            $this->mailer->Body    = $body;                       // Cuerpo del correo en HTML
            $this->mailer->AltBody = 'Tu código de recuperación es: ' . $code; // Texto plano

            $this->mailer->send();                                // Enviar el correo
            return true;  // Si se envía correctamente, retorna true
        } catch (Exception $e) {
            // Manejar el error en caso de que ocurra
            return false;  // Si hay un error, retorna false
        }
    }

    // Método que genera la plantilla del correo
    private function getEmailTemplate($code) {
        // Esta función devuelve el HTML del correo con el código de recuperación
        return "<html>
                    <body>
                        <h1>Código de Recuperación</h1>
                        <p>Tu código de recuperación es: <strong>{$code}</strong></p>
                        <p>Este código es válido por tiempo limitado.</p>
                    </body>
                </html>";
    }
}

// EJEMPLO DE USO:
// Creas una instancia del controlador y envías el código de recuperación
$emailController = new EmailController();

$to   = 'usuario@ejemplo.com';  // Correo del destinatario
$code = '123456';               // Código de recuperación

if ($emailController->sendRecoveryCode($to, $code)) {
    echo 'Correo enviado correctamente';
} else {
    echo 'Error al enviar el correo';
}