<?php
// Load PHPMailer classes
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


// The path for Exception.php was inconsistent, fixing it to match the others.
require '/Users/Dell/Documents/JNK/phpmailer/src/Exception.php'; 
require '/Users/Dell/Documents/JNK/phpmailer/src/PHPMailer.php';
require '/Users/Dell/Documents/JNK/phpmailer/src/SMTP.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data and sanitize them
    $name = strip_tags(trim($_POST["name"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $subject = strip_tags(trim($_POST["subject"]));
    // The message body is used as raw content, but trimmed.
    $message_content = trim($_POST["message"]);

    // Simple validation
    if (empty($name) OR empty($message_content) OR !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Handle error: Not all fields were filled
        http_response_code(400);
        echo "Please complete the form and try again.";
        exit;
    }

    $mail = new PHPMailer(true);

    try {
        // --- Server settings (for sending via GMAIL SMTP) ---
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com'; 
        $mail->SMTPAuth   = true;
        // User's email and App Password (must use App Password for Gmail)
        $mail->Username   = 'samkeloboy243@gmail.com';
        $mail->Password   = 'uwaeqreosbchwmjy';
        
        // Use ENCRYPTION_SMTPS constant for better compatibility
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; 
        $mail->Port       = 465;

        // --- Recipients and Reply-To ---
        // Sender: From the user's input email, with the user's name
        $mail->setFrom($email, $name); 
        // Recipient: Your receiving Gmail address
        $mail->addAddress('samkeloboy243@gmail.com');
        // Set the Reply-To header so you can just hit 'Reply'
        $mail->addReplyTo($email, $name); 

        // --- File Attachment ---
        // Check if files were uploaded and iterate through them
        if (isset($_FILES['file']) && is_array($_FILES['file']['tmp_name'])) {
            for ($i = 0; $i < count($_FILES['file']['tmp_name']); $i++) {
                // Ensure the file was successfully uploaded (not empty path)
                if ($_FILES['file']['tmp_name'][$i] != "") {
                     $mail->addAttachment(
                        $_FILES['file']['tmp_name'][$i], // Path to the temporary file
                        $_FILES['file']['name'][$i]      // Name of the file for the email
                    );
                }
            }
        }
        
        // --- Content ---
        $mail->isHTML(true);                                    // Set email format to HTML
        $mail->Subject = 'Received New Message From: ' . $name . ' - Subject: ' . $subject;
        $mail->Body    = $message_content; 
        
        // Adding an AltBody is good practice for non-HTML mail clients
        $mail->AltBody = strip_tags($message_content); 

        // --- Send Message ---
        $mail->send();
        
        // Success response
        http_response_code(200);
        echo 'Message has been sent. Thank you!';

        // Optional: Redirect the user back to the form page
        // header("Location: index.html?success=1");
        // exit;

    } catch (Exception $e) {
        // Error response
        http_response_code(500);
        // Display the error message including the PHPMailer debug info
        echo "Oops! Something went wrong, and your message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }

} else {
    // If someone tries to access the PHP file directly
    http_response_code(403);
    echo "There was a problem with your submission, please try again.";
}
?>


