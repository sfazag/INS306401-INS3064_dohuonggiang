<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Form Submission Result</title>
</head>
<body>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $fullname = trim($_POST["fullname"]);
    $email = trim($_POST["email"]);
    $phone = trim($_POST["phone"]);
    $message = trim($_POST["message"]);

    // Check if any field is empty
    if (empty($fullname) || empty($email) || empty($phone) || empty($message)) {
        echo "<h3 style='color:red;'>Missing Data</h3>";
    } else {
        echo "<h2>Submitted Information</h2>";
        echo "<ul>";
        echo "<li><strong>Full Name:</strong> " . htmlspecialchars($fullname) . "</li>";
        echo "<li><strong>Email:</strong> " . htmlspecialchars($email) . "</li>";
        echo "<li><strong>Phone Number:</strong> " . htmlspecialchars($phone) . "</li>";
        echo "<li><strong>Message:</strong> " . htmlspecialchars($message) . "</li>";
        echo "</ul>";
    }

} else {
    echo "<h3>Invalid Request</h3>";
}
?>

</body>
</html>