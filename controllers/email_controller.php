<?php
// Simple mail function
function sendEmail($to, $subject, $message, $headers) {
    if (mail($to, $subject, $message, $headers)) {
        return true;
    }
    return false;
}

function sendPoemCompletionEmail($customer_email, $subject, $message) {
    $headers = "From: no-reply@customquills.com\r\n";
    $headers .= "Reply-To: no-reply@customquills.com\r\n";
    $headers .= "Content-type: text/plain; charset=UTF-8\r\n";

    // Send email
    return mail($customer_email, $subject, $message, $headers);
}


?>
