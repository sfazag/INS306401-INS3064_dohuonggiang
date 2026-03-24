<?php
// Check if the final submit button was pressed
$is_final_step = isset($_POST['finish']);

if ($is_final_step) {
    // Collect all data
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);
    $bio = htmlspecialchars($_POST['bio']);
    $location = htmlspecialchars($_POST['location']);
} else {
    // Just coming from Step 1 - capture these for the hidden fields
    $username = htmlspecialchars($_POST['username'] ?? '');
    $password = htmlspecialchars($_POST['password'] ?? '');
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Registration - Step 2</title>
</head>
<body>

    <?php if (!$is_final_step): ?>
        <h2>Step 2: Profile Information</h2>
        <form action="step2.php" method="POST">
            <input type="hidden" name="username" value="<?php echo $username; ?>">
            <input type="hidden" name="password" value="<?php echo $password; ?>">

            <label>Bio:</label><br>
            <textarea name="bio" required></textarea><br><br>
            
            <label>Location:</label><br>
            <input type="text" name="location" required><br><br>
            
            <button type="submit" name="finish">Complete Registration</button>
        </form>

    <?php else: ?>
        <h2>Registration Complete!</h2>
        <p><strong>Summary of your data:</strong></p>
        <table border="1" cellpadding="10">
            <tr><td>Username</td><td><?php echo $username; ?></td></tr>
            <tr><td>Password</td><td><?php echo str_repeat("*", strlen($password)); ?> (Hidden for safety)</td></tr>
            <tr><td>Bio</td><td><?php echo $bio; ?></td></tr>
            <tr><td>Location</td><td><?php echo $location; ?></td></tr>
        </table>
        <br>
        <a href="step1.php">Start Over</a>
    <?php endif; ?>

</body>
</html>