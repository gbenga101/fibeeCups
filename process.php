<?php
error_reporting(E_ALL);
ini_set('display_errors',1);

$errors = [];
$successMessage ="";

//Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_name = trim($_POST["user_name"] ?? '');
    $user_address = trim($_POST["user_address"] ?? '');
    $user_phone = trim($_POST["user_phone"] ?? '');
    $user_social = trim($_POST["user_social"] ?? '');
    $user_message = trim($_POST["user_message"] ?? '');


    // Validate fields
    if (empty($user_name)) $errors['user_name'] = "Name is required";
    if (empty($user_address)) $errors['user_address'] = "Office address is required";
    if (empty($user_phone)) {
        $errors['user_phone'] = "Phone number is required";
    } elseif (!preg_match("/^[0-9]{10,15}$/", $user_phone)) {
        $errors['user_phone'] = "Enter a valid phone number (10-15 digits)";
    }
    if (empty($user_social)) $errors['user_social'] = "Social media handle is required";
    if (empty($user_message)) $errors['user_message'] = "Message cannot be empty";

    // If no errors, send email
    if (empty($errors)) {
        $to = "fibeeCups@gmail.com";
        $subject = "New Contact Form Submission";
        $message = "Name: $user_name\n
            Office Address: $user_address\n
            Phone: $user_phone\n
            Message: $user_message\n";
        $headers = "From: noreply@fibeeCups.com";

        if (mail($to, $subject, $message, $headers)) {
            $successMessage = "Message sent successfully!";
        } else {
            $errors['mail'] = "Error sending message. Try again later.";
        }
    }
}
?>

<!-- if ($_SERVER["REQUEST_METHOD"] == "POST"){
    //validate Name
    if (empty($_POST["user_name"])) {
        $errors['user_name'] = "Name is required";
    }
    
    //validate Email
    if (empty($_POST["user_email"])) {
        $errors['user_email'] = "Your Email is required";
    }
    
    //validate user level
    if (empty($_POST["user_level"])) {
        $errors['user_level'] = "You must select your level";
    }

    //validate messge from user
    if (empty($_POST["user_message"])) {
        $errors['user_message'] = "Message cannot be empty";
    }

    //if no error process the form to the email below
    if (empty($errors)) {
        // Email sending functionality (demonstrate it)
        $to = "fagbenrogbenga001@gmail";
        $subject = "New Form Submission";
        $message = "";

        echo "<h2 style = 'color: green;'>Message sent successfully</h2>";
    } else {
        foreach ($errors as $key => $error) {
            echo "<h2 style = 'color: red;'>$error</h2>";
        }
    }
} -->