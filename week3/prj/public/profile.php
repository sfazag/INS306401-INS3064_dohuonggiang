<?php
require_once "../includes/config.php";
require_once "../includes/auth.php";
require_once "../includes/functions.php";

$username = $_SESSION["user"];
$users = loadUsers();
$error = "";

foreach ($users as &$user) {
    if ($user["username"] === $username) {

        if ($_SERVER["REQUEST_METHOD"] === "POST") {

            // Update bio
            $user["bio"] = $_POST["bio"];

            // Handle avatar upload
            if (!empty($_FILES["avatar"]["name"])) {

                $allowedTypes = ["image/jpeg", "image/png", "image/gif"];

                if (in_array($_FILES["avatar"]["type"], $allowedTypes)) {

                    $filename = time() . "_" . basename($_FILES["avatar"]["name"]);
                    $target = UPLOAD_PATH . $filename;

                    if (move_uploaded_file($_FILES["avatar"]["tmp_name"], $target)) {
                        $user["avatar"] = "../assets/uploads/" . $filename;
                    } else {
                        $error = "Upload failed!";
                    }

                } else {
                    $error = "Only JPG, PNG, GIF allowed!";
                }
            }

            saveUsers($users);
        }

        break;
    }
}


$avatar = !empty($user["avatar"])
    ? $user["avatar"]
    : "../assets/default-avatar.png";
?>
<!DOCTYPE html>
<html>
<head>
    <title>Profile</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>

<div class="container">
    <h2>Welcome <?= escape($username) ?></h2>

    <?php if ($error): ?>
        <p class="error"><?= escape($error) ?></p>
    <?php endif; ?>

    <img src="<?= escape($avatar) ?>" class="avatar">

    <form method="POST" enctype="multipart/form-data">
        Bio:<br>
        <textarea name="bio"><?= escape($user["bio"]) ?></textarea><br>

        Avatar:
        <input type="file" name="avatar" accept="image/*"><br>

        <button type="submit">Save</button>
    </form>

    <a href="logout.php" class="logout">Logout</a>
</div>

</body>
</html>