<?php

namespace App\Core;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class EmailService
{
    protected $mailer;

    public function __construct()
    {
        // Initialize PHPMailer instance
        $this->mailer = new PHPMailer(true);

        // Get the email protocol from environment variables
        $protocol = $_ENV['EMAIL_PROTOCOL'] ?? 'smtp';

        // Configure mailer based on the protocol
        switch ($protocol) {
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

        // Set sender's email and name from environment variables
        $this->mailer->setFrom($_ENV['EMAIL_FROM'], $_ENV['EMAIL_FROM_NAME']);
    }

    // Configure SMTP
    private function configureSmtp()
    {
        $this->mailer->isSMTP();
        $this->mailer->Host = $_ENV['email.SMTPHost'];
        $this->mailer->SMTPAuth = true;
        $this->mailer->Username = $_ENV['email.SMTPUser'];
        $this->mailer->Password = $_ENV['email.SMTPPass'];
        $this->mailer->SMTPSecure = $_ENV['email.SMTPCrypto'];
        $this->mailer->Port = $_ENV['email.SMTPPort'];
    }

    // Configure Sendmail
    private function configureSendmail()
    {
        $this->mailer->isSendmail();
        $this->mailer->Sendmail = $_ENV['SENDMAIL_PATH'] ?? '/usr/sbin/sendmail';  // Ensure path is set
    }

    // Configure Mail (PHP's mail() function)
    private function configureMail()
    {
        $this->mailer->isMail();
    }

    // Send the email
    public function sendEmail($to, $subject, $message)
    {
        try {
            // Add the recipient
            $this->mailer->addAddress($to);

            // Set email format to HTML or plain text
            $this->mailer->isHTML($_ENV['EMAIL_MAIL_TYPE'] == 'html');

            // Set email subject and body
            $this->mailer->Subject = $subject;
            $this->mailer->Body = $message;

            // Send the email
            $this->mailer->send();
            return true; // Success
        } catch (Exception $e) {
            // Handle any errors
            return 'Message could not be sent. Mailer Error: ' . $this->mailer->ErrorInfo;
        }
    }
}
