<?php
// contact.php

// 1. மெயில் அனுப்ப வேண்டிய முகவரி (Your Email)
$to = "Santhoshxox@gmail.com"; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // ஃபார்மில் இருந்து வரும் தகவல்கள்
    $name = strip_tags(trim($_POST["name"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $subject = trim($_POST["subject"]);
    $message = trim($_POST["message"]);

    // செக்கிங் (எல்லாம் சரியாக உள்ளதா என பார்க்க)
    if (empty($name) || empty($message) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>alert('Please fill all fields correctly.'); window.history.back();</script>";
        exit;
    }

    // மெயில் உள்ளடக்கத்தை தயார் செய்தல்
    $email_content = "Name: $name\n";
    $email_content .= "Email: $email\n\n";
    $email_content .= "Subject: $subject\n\n";
    $email_content .= "Message:\n$message\n";

    // ஹெடர்ஸ்
    $email_headers = "From: $name <$email>";

    // மெயில் அனுப்புதல் (Sending Mail)
    if (mail($to, $subject, $email_content, $email_headers)) {
        echo "<script>alert('Message Sent Successfully!'); window.location.href='index.html';</script>";
    } else {
        echo "<script>alert('Message sending failed.'); window.history.back();</script>";
    }

} else {
    // நேரடியாக இந்த ஃபைலை ஓபன் செய்தால் HTML-க்கு திருப்பி அனுப்பும்
    header("Location: index.html");
    exit;
}
?>