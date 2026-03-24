<?php
session_start();
if (isset($_SESSION["user"])) {
    header("Location: profile.php");
} else {
    header("Location: login.php");
}
exit();