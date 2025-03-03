<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    $mail = new PHPMailer(true);

    try {
        // SMTP Settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'nehatabassum03102001@gmail.com';
        $mail->Password = ''; // Replace with your App Password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Email Headers
        $mail->setFrom('nehatabassum03102001@gmail.com', 'Contact Form');
        $mail->addReplyTo($email, $name);
        $mail->addAddress('nehatabassum03102001@gmail.com'); 

        // Email Content
        $mail->isHTML(true);
        $mail->Subject = "New Contact Form Submission from $name";
        $mail->Body = "<b>Name:</b> $name<br><b>Email:</b> $email<br><b>Message:</b><br>$message";

        $mail->send();
        echo json_encode(["status" => "success", "message" => "Message sent successfully!"]);
    } catch (Exception $e) {
        echo json_encode(["status" => "error", "message" => "Failed to send message. Error: " . $mail->ErrorInfo]);
    }
}
?>
