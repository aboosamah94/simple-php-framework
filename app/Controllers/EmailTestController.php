<?php

namespace App\Controllers;


class EmailTestController extends BaseController
{
    public function sendContactEmail()
    {
        $emailService = $this->emailService;

        $to = 'user@example.com';
        $subject = 'Contact Form Submission';

        // HTML email content
        $message = '
        <html>
        <head>
            <title>Contact Form Submission</title>
            <style>
                body { font-family: Arial, sans-serif; }
                .header { color: #4CAF50; }
                .content { margin-top: 20px; }
            </style>
        </head>
        <body>
            <h1 class="header">Contact Form Submission</h1>
            <p class="content">This is a message from the contact form:</p>
            <p class="content">Hello,</p>
            <p class="content">Thank you for reaching out! We have received your message and will get back to you shortly.</p>
            <p class="content">Best regards,</p>
            <p class="content">Your Company Team</p>
        </body>
        </html>';

        // Send email
        $result = $emailService->sendEmail($to, $subject, $message);

        if ($result === true) {
            echo 'Email sent successfully!';
        } else {
            echo 'Error: ' . $result;
        }
    }

}
