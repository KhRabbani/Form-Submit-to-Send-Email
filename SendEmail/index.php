<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Include PHPMailer dependencies
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

$message = '';

// Check if the form is submitted
if (!empty($_POST["send"])) {
    $userName = $_POST["userName"];
    $userEmail = $_POST["userEmail"];
    $userPhone = $_POST["userPhone"];
    $userMessage = $_POST["userMessage"];
    $toEmail = "khrabbani07@gmail.com";
    $subject = "New Contact Form Submission - " . $userName;

    // Create a new PHPMailer instance
    $mail = new PHPMailer(true);

    try {
        $mail->SMTPDebug = 0; // Set to 2 for debugging
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Replace with your SMTP host
        $mail->SMTPAuth = true;
        $mail->Username = 'rsrabbani07@gmail.com'; // Replace with your SMTP username
        $mail->Password = 'ofsnkwqervdlqnwk'; // Replace with your SMTP password
        $mail->SMTPSecure = 'ssl'; // Use 'tls' or 'ssl' (depending on your server)
        $mail->Port = 465; // Use 587 for 'tls' and 465 for 'ssl'

        $mail->setFrom($userEmail, $userName);
        $mail->addAddress($toEmail);

        $mail->isHTML(false);
        $mail->Subject = $subject;
        $mail->Body = "Name: $userName\r\nEmail: $userEmail\r\nPhone: $userPhone\r\nMessage: $userMessage\r\n";

        $mail->send();
        $message = "Your contact information is received successfully.";
    } catch (Exception $e) {
        $message = "Error: Unable to send email. {$mail->ErrorInfo}";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=1">
    <title>Form Submit to Send Email</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>

<?php
// Example: Setting a variable for the H1 content
$h1Content = "Form Submit to Send Email";
?>

<!-- The rest of your HTML content goes here -->

<div class="form-container" style="background: #9fd2a1;">
    <form name="contactFormEmail" method="post" action="">
        <h1 style="display: flex; align-items: center; justify-content: center;"><?php echo $h1Content; ?></h1>
        <div class="input-row">
            <label>Name </label>
            <input type="text" name="userName" required id="userName">
        </div>
        <div class="input-row">
            <label>Email </label>
            <input type="email" name="userEmail" required id="userEmail">
        </div>
        <div class="input-row">
            <label>Phone </label>
            <input type="text" name="userPhone" required id="userPhone">
        </div>
        <div class="input-row">
            <label>Message </label>
            <textarea name="userMessage" required id="userMessage"></textarea>
        </div>
        <div class="input-row">
            <input type="submit" name="send" value="Submit">
            <?php if (!empty($message)) { ?>
                <div class='success'>
                    <strong><?php echo $message; ?></strong>
                </div>
            <?php } ?>
        </div>
    </form>
</div>

</body>
</html>
