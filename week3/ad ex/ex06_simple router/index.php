<?php
// 1. Get the 'page' parameter, default to 'home' if it's missing or empty
$page = $_GET['page'] ?? 'home';

// 2. Define the path to the requested file
$file = "pages/{$page}.php";

// 3. Security & Routing Logic
// Check if the file exists within our pages directory
if (file_exists($file)) {
    include $file;
} else {
    // 4. Handle 404s
    http_response_code(404);
    echo "<h1>404: Page Not Found</h1>";
    echo "<p>Sorry, the page '" . htmlspecialchars($page) . "' does not exist.</p>";
}
?>