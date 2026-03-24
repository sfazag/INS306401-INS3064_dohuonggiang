<?php
// Initialize variables and error messages
$errors = [];
$name = "";
$email = "";

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 1. Capture and sanitize inputs for the "sticky" effect
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    // 2. Perform Validations
    if (empty($name)) {
        $errors[] = "Name is required.";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    }

    if (strlen($password) < 8) {
        $errors[] = "Password too short (must be at least 8 characters).";
    }

    // 3. Success Logic
    if (empty($errors)) {
        echo "<h2>Form Submitted Successfully!</h2>";
        exit; // In a real app, you might redirect here
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Sticky Registration Form</title>
    <style>
        .error { color: red; margin-bottom: 20px; }
        .form-group { margin-bottom: 15px; }
    </style>
</head>
<body>

    <h2>Register</h2>

    <?php if (!empty($errors)): ?>
        <div class="error">
            <ul>
                <?php foreach ($errors as $error): ?>
                    <li><?php echo $error; ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form method="post" action="sticky.php">
        <div class="form-group">
            <label>Name:</label><br>
            <input type="text" name="name" value="<?php echo htmlspecialchars($name); ?>">
        </div>

        <div class="form-group">
            <label>Email:</label><br>
            <input type="text" name="email" value="<?php echo htmlspecialchars($email); ?>">
        </div>

        <div class="form-group">
            <label>Password:</label><br>
            <input type="password" name="password">
        </div>

        <button type="submit">Submit</button>
    </form>

</body>
</html>