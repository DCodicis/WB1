<?php
require 'vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $message = $_POST["message"];

    $mail = new PHPMailer(true);
    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'alexaluf13@gmail.com';
        $mail->Password = 'rvfrglbicwlntasb';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        // Recipients
        $mail->setFrom($email, $name);
        $mail->addAddress('alexaluf13@gmail.com');

        // Content
        $mail->isHTML(false);
        $mail->Subject = 'New Message from Contact Form - ' . date('Y-m-d H:i:s');
        $mail->Body = "Name: {$name}\nEmail: {$email}\nPhone: {$phone}\n\nMessage:\n{$message}";

        $mail->send();
        header("Location: contact.html");
    } catch (Exception $e) {
        header("Location: error.html");
    }
} else {
    header("Location: index.html");
}
?>

