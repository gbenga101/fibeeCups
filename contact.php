<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_name = urlencode($_POST['user_name']);
    $user_email = urlencode($_POST['user_email']);
    $user_phone = urlencode($_POST['user_number']);
    $user_message = urlencode($_POST['user_message']);

    // Your WhatsApp number (with country code)
    $whatsapp_number = "+2348123024462";

    // WhatsApp API Link
    $whatsapp_url = "https://wa.me/$whatsapp_number?text=Name:%20$user_name%0AEmail:%20$user_email%0APhone:%20$user_number%0AMessage:%20$user_message";

    // Redirect user to My WhatsApp
    header("Location: $whatsapp_url");
    exit();
}
?>