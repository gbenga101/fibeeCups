<?php
error_reporting(E_ALL);
ini_set('display_errors',1);

$errors = [];
$successMessage ="";

//Check if the form is submitted and send it to my Whatsapp
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_name = urlencode($_POST['user_name']);
    $user_email = urlencode($_POST['user_email']);
    $user_number = urlencode($_POST['user_number']);
    $user_message = urlencode($_POST['user_message']);

    $whatsapp_number = "+2348123024462";
    $whatsapp_url = "https://wa.me/$whatsapp_number?text=Name:%20$user_name%0AEmail:%20$user_email%0APhone:%20$user_number%0AMessage:%20$user_message";

        // Validate fields
    if (empty($user_name)) $errors['user_name'] = "Name is required";
    if (empty($user_address)) $errors['user_address'] = "Office address is required";
    if (empty($user_number)) {
        $errors['user_number'] = "Phone number is required";
    } elseif (!preg_match("/^[0-9]{10,15}$/", $user_number)) {
        $errors['user_number'] = "Enter a valid phone number (10-15 digits)";
    }
    
    if (empty($user_message)) $errors['user_message'] = "Message cannot be empty";
    
    header("Location: $whatsapp_url");
    exit();

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./assets/fibeeLogo2.jpg" type="image/x-icon">
    <link rel="stylesheet" href="css/style.css">
    <title>FibeeCups</title>
</head>
<body>
    <marquee behavior="scroll" direction="left">
        <h4>FIBEECUPS: The Cup that Cares<span><a href="https://wa.me/+2348107796118" target="_blank">Click here to Order yours Today!</a></span>
        </h4>
    </marquee>
    <header>
        <nav>
            <div class="logo">
                <!-- <img src="./assets/fibeeLogo.png" alt="FibeeCups"> -->
            </div>
        </nav>
    </header>
    <main>
        <h1>Contact Us</h1>
        <section class="assign">
            <div class="first">
                <h3>FibeeCups: The Cup That Cares</h3>
                <p>We would love to hear from you! Whether you have any questions, feedback or wants to place an order, FibeeCups is here for you</p>
                <p>Got a craving or a special request? Drop us a message, and we'll be happy to help. Because at <strong>FibeeCups</strong>, every cup is made with care!</p>
            </div>
            <div class="second">

            <?php if ($successMessage): ?>
                <p class="success"><?= $successMessage; ?></p>
            <?php endif; ?>

                <form method="POST">
                    <label for="name"></label>
                    <input type="text" name="user_name" alt="name" id="name" placeholder="Your Name" value="<?= htmlspecialchars($user_name ?? '') ?>" required>
                    <p class="error"><?= $errors['user_name'] ?? '' ?></p>
                    
                    <label for="address"></label>
                    <input type="text" name="user_address" alt="name" id="name" placeholder="Your Office / Home Address" value="<?= htmlspecialchars($user_address ?? '') ?>" required>
                    <p class="error"><?= $errors['user_address'] ?? '' ?></p>

                    <label for="email"></label>
                    <input type="email" name="user_email" id="email" placeholder="Your Email" value="<?= htmlspecialchars($user_email ?? '') ?>" required>
                    <p class="error"><?= $errors['user_email'] ?? '' ?></p>

                    <label for="number"></label>
                    <input type="number" name="user_number" id="number" placeholder="Your Phone Number" value="<?= htmlspecialchars($user_number ?? '') ?>" required>
                    <p class="error"><?= $errors['user_number'] ?? '' ?></p>

                    <textarea name="user_message" required><?= htmlspecialchars($user_message ?? '') ?>How would you like us serve you better?</textarea>
                    <p class="error"><?= $errors['user_message'] ?? '' ?></p>

                    <input type="submit" value="Send Message" class="btn">.
                </form>
            </div>
        </section>
    </main>
</body>
</html>