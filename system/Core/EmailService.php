<?php

namespace System\Core;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class EmailService
{
    protected PHPMailer $mailer;

    /**
     * EmailService constructor.
     * Initializes the PHPMailer object and configures the email protocol
     */
    public function __construct()
    {
        // Initialize PHPMailer instance
        $this->mailer = new PHPMailer(true);

        // Get the email protocol from environment variables
        $protocol = $_ENV['EMAIL_PROTOCOL'] ?? 'smtp';

        // Configure mailer based on the protocol
        $this->configureMailer($protocol);

        // Set sender's email and name from environment variables
        $this->mailer->setFrom($_ENV['EMAIL_FROM'], $_ENV['EMAIL_FROM_NAME']);
    }

    /**
     * Configure the mailer based on the email protocol.
     * @param string $protocol The email protocol (smtp, sendmail, or mail)
     */
    private function configureMailer(string $protocol): void
    {
        switch (strtolower($protocol)) {
            case 'smtp':
                $this->configureSmtp();
                break;
            case 'sendmail':
                $this->configureSendmail();
                break;
            case 'mail':
                $this->configureMail();
                break;
            default:
                throw new \Exception("Invalid email protocol specified in the .env file.");
        }
    }

    /**
     * Configure SMTP settings for PHPMailer.
     */
    private function configureSmtp(): void
    {
        $this->mailer->isSMTP();
        $this->mailer->Host = $_ENV['email.SMTPHost'] ?? throw new \Exception('SMTP Host is not set.');
        $this->mailer->SMTPAuth = true;
        $this->mailer->Username = $_ENV['email.SMTPUser'] ?? throw new \Exception('SMTP Username is not set.');
        $this->mailer->Password = $_ENV['email.SMTPPass'] ?? throw new \Exception('SMTP Password is not set.');
        $this->mailer->SMTPSecure = $_ENV['email.SMTPCrypto'] ?? PHPMailer::ENCRYPTION_STARTTLS;
        $this->mailer->Port = $_ENV['email.SMTPPort'] ?? 587;
    }

    /**
     * Configure Sendmail settings for PHPMailer.
     */
    private function configureSendmail(): void
    {
        $this->mailer->isSendmail();
        $this->mailer->Sendmail = $_ENV['SENDMAIL_PATH'] ?? '/usr/sbin/sendmail';  // Ensure path is set
    }

    /**
     * Configure PHP's mail() function for PHPMailer.
     */
    private function configureMail(): void
    {
        $this->mailer->isMail();
    }

    /**
     * Send an email to the specified recipient.
     *
     * @param string $to The recipient's email address.
     * @param string $subject The subject of the email.
     * @param string $message The body of the email.
     * @return bool|string Returns true on success, or an error message if sending fails.
     */
    public function sendEmail(string $to, string $subject, string $message)
    {
        try {
            // Add the recipient
            $this->mailer->addAddress($to);

            // Set email format to HTML or plain text
            $this->mailer->isHTML($_ENV['EMAIL_MAIL_TYPE'] === 'html');

            // Set email subject and body
            $this->mailer->Subject = $subject;
            $this->mailer->Body = $message;

            // Send the email
            $this->mailer->send();
            return true; // Success
        } catch (Exception $e) {
            // Log error and return the message
            error_log("Mailer Error: " . $e->getMessage());
            return 'Message could not be sent. Mailer Error: ' . $this->mailer->ErrorInfo;
        }
    }
}