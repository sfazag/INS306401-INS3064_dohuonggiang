<?php
require_once "../includes/config.php";
require_once "../includes/functions.php";

$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $username = trim($_POST["username"]);
    $email = trim($_POST["email"]);
    $password = $_POST["password"];
    $confirm = $_POST["confirm"];

    if ($password !== $confirm) {
        $error = "Passwords do not match!";
    } else {

        $users = loadUsers();

        foreach ($users as $user) {
            if ($user["username"] === $username) {
                $error = "Username already exists!";
            }
        }

        if ($error === "") {
            $users[] = [
                "username" => $username,
                "email" => $email,
                "password" => password_hash($password, PASSWORD_DEFAULT),
                "bio" => "",
                "avatar" => ""
            ];

            saveUsers($users);
            header("Location: login.php");
            exit();
        }
    }
}
?>

<h2>Register</h2>
<p style="color:red"><?= escape($error) ?></p>

<form method="POST">
Username: <input type="text" name="username" required><br>
Email: <input type="email" name="email" required><br>
Password: <input type="password" name="password" required><br>
Confirm: <input type="password" name="confirm" required><br>
<button type="submit">Register</button>
</form>