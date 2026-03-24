<?php
// 1. Logic Phase: Check if the form was submitted
$submitted = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Collect and sanitize input
    $name = htmlspecialchars($_POST['name'] ?? '');
    $email = htmlspecialchars($_POST['email'] ?? '');
    $message = htmlspecialchars($_POST['message'] ?? '');

    // In a real app, you'd send an email or save to a database here.
    
    // Set flag to true to trigger the "Thank You" view
    $submitted = true;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Contact Us</title>
    <style>
        body { font-family: sans-serif; margin: 2rem; line-height: 1.5; }
        .form-group { margin-bottom: 1rem; }
        label { display: block; font-weight: bold; }
        input, textarea { width: 100%; max-width: 400px; padding: 8px; }
        button { padding: 10px 15px; background: #007bff; color: white; border: none; cursor: pointer; }
    </style>
</head>
<body>

    <?php if ($submitted): ?>
        <h2>Thank You, <?= $name ?>!</h2>
        <p>Your message has been received. We'll get back to you at <strong><?= $email ?></strong> soon.</p>
        <p><a href="contact_self.php">Send another message</a></p>

    <?php else: ?>
        <h2>Contact Us</h2>
        <form action="contact_self.php" method="POST">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required>
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>

            <div class="form-group">
                <label for="message">Message:</label>
                <textarea id="message" name="message" rows="4" required></textarea>
            </div>

            <button type="submit">Submit</button>
        </form>
    <?php endif; ?>

</body>
</html>