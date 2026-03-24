<?php
require_once "../includes/config.php";
require_once "../includes/functions.php";

if (!isset($_SESSION["attempts"])) {
    $_SESSION["attempts"] = 0;
}

$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    if ($_SESSION["attempts"] >= 3) {
        $error = "Too many failed attempts!";
    } else {

        $user = findUser($_POST["username"]);

        if ($user && password_verify($_POST["password"], $user["password"])) {
            $_SESSION["user"] = $user["username"];
            $_SESSION["attempts"] = 0;
            header("Location: profile.php");
            exit();
        }

        $_SESSION["attempts"]++;
        $error = "Invalid credentials!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <script src="../assets/js/main.js"></script>
</head>
<body>

<div class="container">
    <h2>Login</h2>

    <p class="error"><?= escape($error) ?></p>

    <form method="POST">
        Username:
        <input type="text" name="username" required>

        Password:
        <input type="password" name="password" id="password" required>

        <button type="button" onclick="togglePassword('password')">
            Show/Hide
        </button>

        <button type="submit">Login</button>
    </form>

    <p>Failed Attempts: <?= $_SESSION["attempts"] ?></p>
</div>

</body>
</html>