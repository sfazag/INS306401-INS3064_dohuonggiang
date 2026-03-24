<?php
$errors = [];
$form_data = ['username' => '', 'email' => ''];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $form_data['username'] = trim($_POST['username']);
    $form_data['email'] = trim($_POST['email']);

    // Validation Tasks
    if (empty($form_data['username'])) {
        $errors['username'] = "Username is required.";
    }

    if (!filter_var($form_data['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "A valid email address is required.";
    }

    // If empty($errors), proceed with database logic...
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        .alert-box { background: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; padding: 15px; margin-bottom: 20px; border-radius: 4px; }
        .error { border: 2px solid #dc3545 !important; background-color: #fff8f8; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; }
    </style>
</head>
<body>

    <?php if (!empty($errors)): ?>
        <div class="alert-box">
            <strong>Please fix the following errors:</strong>
            <ul>
                <?php foreach ($errors as $error): ?>
                    <li><?php echo htmlspecialchars($error); ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form method="POST" action="">
        <div class="form-group">
            <label>Username:</label>
            <input type="text" name="username" 
                   class="<?php echo isset($errors['username']) ? 'error' : ''; ?>"
                   value="<?php echo htmlspecialchars($form_data['username']); ?>">
        </div>

        <div class="form-group">
            <label>Email:</label>
            <input type="text" name="email" 
                   class="<?php echo isset($errors['email']) ? 'error' : ''; ?>"
                   value="<?php echo htmlspecialchars($form_data['email']); ?>">
        </div>

        <button type="submit">Submit</button>
    </form>

</body>
</html>