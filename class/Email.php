<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// go to root project folder 
require $_SERVER['DOCUMENT_ROOT'] . '/booking/vendor/autoload.php';

class Email
{
    public $vendor;
    private $email;
    private $subject;
    private $message;
    private $headers;

    public function __construct($vendor)
    {
        $this->vendor = $vendor;
    }

    public function sendEmail($to, $subject, $type, $message)
    {
        $mail = new PHPMailer(true);

        try {
            // Server settings
            $mail->isSMTP();
            $mail->SMTPAuth = true;
            $mail->SMTPSecure = 'tls';
            $mail->Host = 'smtp.gmail.com';
            $mail->Port = 587;
            $mail->Username = 'officialnexuslink@gmail.com';
            $mail->Password = 'ypqsfuzaqdgwndjx';
            $mail->isHTML(true);

            // Recipients
            $mail->setFrom('villadelosreyesresort@gmail.com', 'Villa De Los Reyes Resort');
            $mail->addAddress($to);
            $mail->addReplyTo('officialnexuslink@gmail.com', 'Villa De Los Reyes Resort');

            // Generate notification message using template
            $mail->Subject = $subject;

            // send email notification to user add template notification using html css
            $mail->Body = '
            <!DOCTYPE html>
                <html>
                <head>
                    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
                    <title>Villa De Los Reyes Resort Notification</title>
                    <!-- Bootstrap CSS -->
                    <style>
                    .container {
                        max-width: 800px;
                        margin: 0 auto;
                    }
                    .card {
                        border: 1px solid #ccc;
                        border-radius: 5px;
                        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                        margin: 20px;
                        padding: 20px;
                    }
                    .btn {
                        background-color: #007bff;
                        border: none;
                        color: white;
                        padding: 10px 20px;
                        text-align: center;
                        text-decoration: none;
                        display: inline-block;
                        font-size: 16px;
                        margin: 4px 2px;
                        cursor: pointer;
                        border-radius: 5px;
                    }
                    .btn-primary {
                        background-color: #007bff;
                        border: none;
                        color: white;
                        padding: 10px 20px;
                        text-align: center;
                        text-decoration: none;
                        display: inline-block;
                        font-size: 16px;
                        margin: 4px 2px;
                        cursor: pointer;
                        border-radius: 5px;
                    }
                    .btn-primary:hover {
                        background-color: #0056b3;
                    }
                    .mt-3 {
                        margin-top: 1rem !important;
                    }
                    .mt-5 {
                        margin-top: 3rem !important;
                    }
                    .text-center {
                        text-align: center;
                    }
                    .text-left {
                        text-align: left;
                    }
                    
                    </style>
                </head>
                <body>
                    <div class="container mt-5">
                    <div class="card">
                        <div class="card-body">
                        <div class="text-center">
                            <h1 class="mt-3">Villa De Los Reyes Resort</h1>
                        </div>
                        <hr />
                        <h2 class="text-center">' . $subject . '</h2>
                        <p class="text-center">Dear valued guest,</p>
                        <p class="text-center">
                            ' . $message . '
                        </p>
                        <div class="text-center">
                            <a
                            href="https://villadelosreyesresort.com/offers"
                            class="btn btn-primary btn-lg"
                            >View Offers</a
                            >
                        </div>
                        <hr />
                        <div class="text-center">
                            <p class="mb-0">
                            Thank you for choosing Villa De Los Reyes Resort.
                            </p>
                            <p class="mb-0">We look forward to welcoming you soon!</p>
                        </div>
                        </div>
                    </div>
                    </div>
                </body>
                </html>
            ';

            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->send();

            return true;

        } catch (Exception $error) {
            return false;
        }
    }
}