<?php
// test_utils.php
require_once 'utils.php';

function runTest($description, $result) {
    echo ($result ? "[PASS] " : "[FAIL] ") . $description . "\n";
}

echo "--- Starting Validation Tests ---\n\n";

// Test sanitize
$dirty = " <script>alert('hi');</script> ";
runTest("Sanitize removes tags/whitespace", sanitize($dirty) === "&lt;script&gt;alert(&#039;hi&#039;);&lt;/script&gt;");

// Test validateEmail
runTest("Valid email (test@example.com)", validateEmail("test@example.com") === true);
runTest("Invalid email (test@com)", validateEmail("test@com") === false);

// Test validateLength
runTest("Length valid (Hello, 3-10)", validateLength("Hello", 3, 10) === true);
runTest("Length too short (Hi, 5-10)", validateLength("Hi", 5, 10) === false);

// Test validatePassword
runTest("Password valid (Secret123!)", validatePassword("Secret123!") === true);
runTest("Password missing special char (Secret123)", validatePassword("Secret123") === false);
runTest("Password too short (!1a)", validatePassword("!1a") === false);

echo "\n--- Tests Complete ---";