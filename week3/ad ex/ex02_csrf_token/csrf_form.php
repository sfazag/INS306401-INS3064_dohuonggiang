<?php
session_start();

// 1. GENERATE TOKEN: Only if one doesn't already exist in the session
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

$message = "";

// 2. VALIDATION: Check the token on POST submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $postedToken = $_POST['csrf_token'] ?? '';

    // Acceptance Criteria: Compare POST with stored token
    if (!hash_equals($_SESSION['csrf_token'], $postedToken)) {
        http_response_code(403);
        die("403 Forbidden: CSRF token mismatch.");
    } else {
        $message = "Success! The token matched.";
        // Optional: Regenerate token after successful use to prevent replay
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>CSRF Protection Form</title>
</head>
<body>
    <h2>Secure Form</h2>
    
    <?php if ($message): ?>
        <p style="color: green;"><?php echo $message; ?></p>
    <?php endif; ?>

    <form method="POST" action="csrf_form.php">
        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
        
        <label for="data">Enter some text:</label>
        <input type="text" name="data" id="data" required>
        
        <button type="submit">Submit Request</button>
    </form>
</body>
</html>