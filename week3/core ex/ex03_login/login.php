<?php
session_start();

// Hardcoded credentials
$correct_user = "admin";
$correct_pass = "123456";

// Khởi tạo biến
$message = "";
$failed_attempts = 0;

// Nếu chưa có session attempts thì tạo mới
if (!isset($_SESSION['attempts'])) {
    $_SESSION['attempts'] = 0;
}

// Xử lý khi submit form
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = $_POST["username"] ?? "";
    $password = $_POST["password"] ?? "";

    if ($username === $correct_user && $password === $correct_pass) {
        $message = "Login Successful";
        $_SESSION['attempts'] = 0; // reset sau khi đăng nhập đúng
    } else {
        $_SESSION['attempts']++;
        $message = "Invalid Credentials";
    }

    $failed_attempts = $_SESSION['attempts'];
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Simple Login</title>
</head>
<body>

<h2>Login Form</h2>

<form method="POST" action="login.php">
    Username:
    <input type="text" name="username" required><br><br>

    Password:
    <input type="password" name="password" required><br><br>

    <input type="submit" value="Login">
</form>

<?php
if ($message != "") {
    echo "<p><strong>$message</strong></p>";
    echo "<p>Failed Attempts: $failed_attempts</p>";
}
?>

</body>
</html>