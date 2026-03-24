<?php
$errors = [];
$success = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    // 1. Username Validation: Alphanumeric only
    if (empty($username)) {
        $errors[] = "Username is required.";
    } elseif (!preg_match('/^[a-zA-Z0-9]+$/', $username)) {
        $errors[] = "Username must contain only alphanumeric characters.";
    }

    // 2. Password Validation: Individual checks for specific feedback
    if (empty($password)) {
        $errors[] = "Password is required.";
    } else {
        if (!preg_match('/[A-Z]/', $password)) {
            $errors[] = "Password missing uppercase letter.";
        }
        if (!preg_match('/[a-z]/', $password)) {
            $errors[] = "Password missing lowercase letter.";
        }
        if (!preg_match('/[0-9]/', $password)) {
            $errors[] = "Password missing number.";
        }
        if (!preg_match('/[^a-zA-Z0-9]/', $password)) {
            $errors[] = "Password missing symbol.";
        }
    }

    // Success check
    if (empty($errors)) {
        $success = "Registration successful!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Registration Form</title>
    <style>
        body { font-family: sans-serif; margin: 40px; }
        .error { color: #d9534f; margin-bottom: 5px; }
        .success { color: #5cb85c; font-weight: bold; }
        .field { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; }
    </style>
</head>
<body>

    <h2>Create Account</h2>

    <?php if ($success): ?>
        <p class="success"><?php echo $success; ?></p>
    <?php endif; ?>

    <?php if (!empty($errors)): ?>
        <div style="margin-bottom: 20px;">
            <?php foreach ($errors as $error): ?>
                <div class="error">• <?php echo $error; ?></div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <form method="post" action="">
        <div class="field">
            <label for="username">Username</label>
            <input type="text" name="username" id="username" value="<?php echo htmlspecialchars($username ?? ''); ?>">
        </div>
        <div class="field">
            <label for="password">Password</label>
            <input type="password" name="password" id="password">
        </div>
        <button type="submit">Register</button>
    </form>

</body>
</html>